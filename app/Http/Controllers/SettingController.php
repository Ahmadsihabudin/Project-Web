<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SettingController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      return redirect()->route('admin.settings.info-ujian.index');
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      return view('admin.settings.create');
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      try {
         $validator = Validator::make($request->all(), [
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'required|string',
            'description' => 'nullable|string',
            'category' => 'required|in:general,exam,security,notification,email,system',
            'type' => 'required|in:string,integer,boolean,json,array',
            'is_public' => 'boolean',
            'is_encrypted' => 'boolean',
            'validation_rules' => 'nullable|string',
            'default_value' => 'nullable|string'
         ]);

         if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'message' => 'Validasi gagal',
               'errors' => $validator->errors()
            ], 422);
         }

         $settingData = $request->all();
         if ($request->is_encrypted) {
            $settingData['value'] = encrypt($request->value);
         }

         $setting = Setting::create($settingData);

         return response()->json([
            'success' => true,
            'message' => 'Pengaturan berhasil ditambahkan',
            'data' => $setting
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
      try {
         $setting = Setting::findOrFail($id);
         if ($setting->is_encrypted) {
            try {
               $setting->value = decrypt($setting->value);
            } catch (\Exception $e) {
            }
         }

         return response()->json([
            'success' => true,
            'data' => $setting
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Pengaturan tidak ditemukan'
         ], 404);
      }
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(string $id)
   {
      return view('admin.settings.edit', compact('id'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, string $id)
   {
      try {
         $setting = Setting::findOrFail($id);

         $validator = Validator::make($request->all(), [
            'value' => 'required|string',
            'description' => 'nullable|string',
            'category' => 'required|in:general,exam,security,notification,email,system',
            'type' => 'required|in:string,integer,boolean,json,array',
            'is_public' => 'boolean',
            'is_encrypted' => 'boolean',
            'validation_rules' => 'nullable|string',
            'default_value' => 'nullable|string'
         ]);

         if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'message' => 'Validasi gagal',
               'errors' => $validator->errors()
            ], 422);
         }

         $settingData = $request->all();
         if ($request->is_encrypted) {
            $settingData['value'] = encrypt($request->value);
         }

         $setting->update($settingData);

         return response()->json([
            'success' => true,
            'message' => 'Pengaturan berhasil diperbarui',
            'data' => $setting
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
      try {
         $setting = Setting::findOrFail($id);
         $setting->delete();

         return response()->json([
            'success' => true,
            'message' => 'Pengaturan berhasil dihapus'
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Reset to default value
    */
   public function reset(Request $request, string $id)
   {
      try {
         $setting = Setting::findOrFail($id);

         if (!$setting->default_value) {
            return response()->json([
               'success' => false,
               'message' => 'Tidak ada nilai default untuk pengaturan ini'
            ], 400);
         }

         $setting->update(['value' => $setting->default_value]);

         return response()->json([
            'success' => true,
            'message' => 'Pengaturan berhasil direset ke nilai default',
            'data' => $setting
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get data for DataTables
    */
   public function data()
   {
      try {
         $settings = Setting::all();

         $transformedSettings = $settings->map(function ($setting) {
            $displayValue = $setting->value;
            if ($setting->is_encrypted) {
               try {
                  $displayValue = decrypt($setting->value);
               } catch (\Exception $e) {
                  $displayValue = '[ENCRYPTED]';
               }
            }

            return [
               'id' => $setting->id,
               'key' => $setting->key,
               'value' => $displayValue,
               'description' => $setting->description,
               'category' => $setting->category,
               'type' => $setting->type,
               'is_public' => $setting->is_public,
               'is_encrypted' => $setting->is_encrypted,
               'validation_rules' => $setting->validation_rules,
               'default_value' => $setting->default_value,
               'created_at' => $setting->created_at,
               'updated_at' => $setting->updated_at
            ];
         });

         return response()->json([
            'success' => true,
            'data' => $transformedSettings
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get statistics
    */
   public function stats()
   {
      try {
         $totalSettings = Setting::count();
         $publicSettings = Setting::where('is_public', true)->count();
         $encryptedSettings = Setting::where('is_encrypted', true)->count();
         $byCategory = Setting::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();
         $byType = Setting::select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->get();

         return response()->json([
            'success' => true,
            'data' => [
               'total' => $totalSettings,
               'public' => $publicSettings,
               'encrypted' => $encryptedSettings,
               'by_category' => $byCategory,
               'by_type' => $byType
            ]
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get public settings for frontend
    */
   public function getPublicSettings()
   {
      try {
         $settings = Setting::where('is_public', true)->get();

         $publicSettings = [];
         foreach ($settings as $setting) {
            $value = $setting->value;
            if ($setting->is_encrypted) {
               try {
                  $value = decrypt($setting->value);
               } catch (\Exception $e) {
                  continue;
               }
            }
            switch ($setting->type) {
               case 'integer':
                  $value = (int) $value;
                  break;
               case 'boolean':
                  $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                  break;
               case 'json':
                  $value = json_decode($value, true);
                  break;
               case 'array':
                  $value = json_decode($value, true);
                  break;
            }

            $publicSettings[$setting->key] = $value;
         }

         return response()->json([
            'success' => true,
            'data' => $publicSettings
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get or update info ujian settings
    */
   public function infoUjian(Request $request)
   {
      try {
         $keys = [
            'warning_waktu' => 'exam.warning.waktu',
            'warning_integritas' => 'exam.warning.integritas',
            'warning_navigasi' => 'exam.warning.navigasi',
            'warning_konfirmasi' => 'exam.warning.konfirmasi'
         ];

         // Default values
         $defaults = [
            'warning_waktu' => 'Waktu Terbatas: Ujian memiliki batas waktu yang ketat. Pastikan koneksi internet stabil dan tidak ada gangguan.',
            'warning_integritas' => 'Integritas Ujian: Dilarang keras melakukan kecurangan, membuka tab lain, atau menggunakan bantuan eksternal.',
            'warning_navigasi' => 'Navigasi Terbatas: Setelah memulai ujian, Anda tidak dapat kembali ke halaman sebelumnya atau mengubah jawaban yang sudah dikirim.',
            'warning_konfirmasi' => 'Konfirmasi Jawaban: Pastikan semua jawaban sudah benar sebelum mengirim. Tidak ada kesempatan untuk mengubah setelah submit.'
         ];

         if ($request->isMethod('POST')) {
            // Update settings
            $data = [];
            $requestData = $request->json()->all();
            
            foreach ($keys as $formKey => $settingKey) {
               if (isset($requestData[$formKey])) {
                  $value = $requestData[$formKey];
                  
                  // Find or create setting
                  $setting = Setting::firstOrNew(['key' => $settingKey]);
                  $setting->value = $value;
                  $setting->description = 'Info ujian - ' . ucfirst(str_replace('warning_', '', $formKey));
                  $setting->category = 'exam';
                  $setting->type = 'string';
                  $setting->is_public = true;
                  $setting->is_encrypted = false;
                  $setting->save();

                  $data[$formKey] = $value;
               }
            }

            return response()->json([
               'success' => true,
               'message' => 'Info ujian berhasil diperbarui',
               'data' => $data
            ]);
         } else {
            // Get settings
            $data = [];
            foreach ($keys as $formKey => $settingKey) {
               $setting = Setting::where('key', $settingKey)->first();
               $data[$formKey] = $setting ? $setting->value : $defaults[$formKey];
            }

            return response()->json([
               'success' => true,
               'data' => $data
            ]);
         }
      } catch (\Exception $e) {
         \Log::error('Error in infoUjian method: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
         ]);
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Handle logo and app name settings
    */
   public function logo(Request $request)
   {
      try {
         if ($request->isMethod('post')) {
            // Upload logo
            $validator = Validator::make($request->all(), [
               'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
               return response()->json([
                  'success' => false,
                  'message' => 'Validasi gagal: ' . $validator->errors()->first()
               ], 422);
            }

            // Delete old logo if exists
            $oldLogo = Setting::where('key', 'app.logo')->first();
            if ($oldLogo && $oldLogo->value) {
               $oldPath = str_replace('/storage/', '', $oldLogo->value);
               if (Storage::disk('public')->exists($oldPath)) {
                  Storage::disk('public')->delete($oldPath);
               }
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            // Generate full URL using current request host
            $filename = basename($logoPath);
            $logoUrl = $request->getSchemeAndHttpHost() . '/storage/logos/' . $filename;

            // Save to settings
            $setting = Setting::firstOrNew(['key' => 'app.logo']);
            $setting->value = $logoUrl;
            $setting->type = 'string';
            $setting->category = 'system';
            $setting->is_public = true;
            $setting->is_encrypted = false;
            $setting->save();

            return response()->json([
               'success' => true,
               'message' => 'Logo berhasil diupload',
               'data' => [
                  'logo_path' => $logoUrl
               ]
            ]);
         } else if ($request->isMethod('put')) {
            // Update app name
            $validator = Validator::make($request->all(), [
               'app_name' => 'required|string|max:50'
            ]);

            if ($validator->fails()) {
               return response()->json([
                  'success' => false,
                  'message' => 'Validasi gagal: ' . $validator->errors()->first()
               ], 422);
            }

            // Save app name
            $setting = Setting::firstOrNew(['key' => 'app.name']);
            $setting->value = $request->app_name;
            $setting->type = 'string';
            $setting->category = 'system';
            $setting->is_public = true;
            $setting->is_encrypted = false;
            $setting->save();

            return response()->json([
               'success' => true,
               'message' => 'Nama aplikasi berhasil disimpan',
               'data' => [
                  'app_name' => $request->app_name
               ]
            ]);
         } else {
            // Get settings
            $logo = Setting::where('key', 'app.logo')->first();
            $appName = Setting::where('key', 'app.name')->first();
            
            // Ensure logo path is correct URL
            $logoPath = null;
            if ($logo && $logo->value) {
               // If it's already a full URL, use it; otherwise convert to full URL
               if (strpos($logo->value, 'http') === 0) {
                  $logoPath = $logo->value;
               } else {
                  // Remove leading slash if present and add storage prefix
                  $logoPath = $request->getSchemeAndHttpHost() . '/storage/' . ltrim(str_replace('storage/', '', $logo->value), '/');
               }
            }

            return response()->json([
               'success' => true,
               'data' => [
                  'logo_path' => $logoPath,
                  'app_name' => $appName ? $appName->value : 'Ujian Online'
               ]
            ]);
         }
      } catch (\Exception $e) {
         \Log::error('Error in logo method: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
         ]);
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Reset logo to default
    */
   public function resetLogo(Request $request)
   {
      try {
         // Delete current logo
         $logo = Setting::where('key', 'app.logo')->first();
         if ($logo && $logo->value) {
            $oldPath = str_replace('/storage/', '', $logo->value);
            if (Storage::disk('public')->exists($oldPath)) {
               Storage::disk('public')->delete($oldPath);
            }
            $logo->delete();
         }

         return response()->json([
            'success' => true,
            'message' => 'Logo berhasil direset ke default'
         ]);
      } catch (\Exception $e) {
         \Log::error('Error in resetLogo method: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
         ]);
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Create database backup
    */
   public function createBackup(Request $request)
   {
      try {
         $database = config('database.connections.mysql.database');
         $username = config('database.connections.mysql.username');
         $password = config('database.connections.mysql.password');
         $host = config('database.connections.mysql.host');
         $port = config('database.connections.mysql.port');

         // Create backup directory if not exists
         $backupDir = storage_path('app/backups');
         if (!file_exists($backupDir)) {
            mkdir($backupDir, 0755, true);
         }

         // Generate backup filename with timestamp
         $timestamp = date('Y-m-d_His');
         $filename = "backup_{$database}_{$timestamp}.sql";
         $filepath = $backupDir . '/' . $filename;

         // Build mysqldump command
         // For Windows, try to find mysqldump in common locations
         $mysqldump = 'mysqldump';
         if (PHP_OS_FAMILY === 'Windows') {
            // Try common Laragon/MySQL paths
            $possiblePaths = [
               'C:\\laragon\\bin\\mysql\\mysql-8.0.30\\bin\\mysqldump.exe',
               'C:\\xampp\\mysql\\bin\\mysqldump.exe',
               'C:\\wamp64\\bin\\mysql\\mysql8.0.27\\bin\\mysqldump.exe',
               'mysqldump.exe'
            ];
            
            foreach ($possiblePaths as $path) {
               if (file_exists($path)) {
                  $mysqldump = $path;
                  break;
               }
            }
         }

         $command = sprintf(
            '%s --host=%s --port=%s --user=%s --password=%s %s > %s',
            escapeshellarg($mysqldump),
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($database),
            escapeshellarg($filepath)
         );

         // Execute backup command
         $output = [];
         $returnCode = 0;
         exec($command . ' 2>&1', $output, $returnCode);

         if ($returnCode !== 0 || !file_exists($filepath)) {
            $errorMsg = implode("\n", $output);
            throw new \Exception('Gagal membuat backup. Pastikan mysqldump tersedia dan konfigurasi database benar. Error: ' . $errorMsg);
         }

         // Check if file was created and has content
         if (filesize($filepath) === 0) {
            unlink($filepath);
            throw new \Exception('File backup kosong. Pastikan database tidak kosong.');
         }

         return response()->json([
            'success' => true,
            'message' => 'Backup database berhasil dibuat.',
            'data' => [
               'filename' => $filename,
               'size' => filesize($filepath),
               'created_at' => date('Y-m-d H:i:s')
            ]
         ]);
      } catch (\Exception $e) {
         \Log::error('Error in createBackup method: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
         ]);
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * List all backups
    */
   public function listBackups(Request $request)
   {
      try {
         $backupDir = storage_path('app/backups');
         
         if (!file_exists($backupDir)) {
            return response()->json([
               'success' => true,
               'data' => []
            ]);
         }

         $files = [];
         $items = scandir($backupDir);
         
         foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;
            
            $filepath = $backupDir . '/' . $item;
            if (is_file($filepath) && pathinfo($filepath, PATHINFO_EXTENSION) === 'sql') {
               $files[] = [
                  'filename' => $item,
                  'name' => $item,
                  'size' => filesize($filepath),
                  'created_at' => date('Y-m-d H:i:s', filemtime($filepath)),
                  'date' => date('Y-m-d H:i:s', filemtime($filepath))
               ];
            }
         }

         // Sort by date descending (newest first)
         usort($files, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
         });

         return response()->json([
            'success' => true,
            'data' => $files
         ]);
      } catch (\Exception $e) {
         \Log::error('Error in listBackups method: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
         ]);
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Download backup file
    */
   public function downloadBackup($filename)
   {
      try {
         $backupDir = storage_path('app/backups');
         $filepath = $backupDir . '/' . basename($filename);

         // Security: prevent directory traversal
         if (!file_exists($filepath) || !is_file($filepath)) {
            abort(404, 'File backup tidak ditemukan.');
         }

         // Check if file is a SQL backup
         if (pathinfo($filepath, PATHINFO_EXTENSION) !== 'sql') {
            abort(403, 'File tidak valid.');
         }

         return response()->download($filepath, $filename, [
            'Content-Type' => 'application/sql',
         ]);
      } catch (\Exception $e) {
         \Log::error('Error in downloadBackup method: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
         ]);
         abort(500, 'Gagal mendownload backup.');
      }
   }

   /**
    * Delete backup file
    */
   public function deleteBackup($filename)
   {
      try {
         $backupDir = storage_path('app/backups');
         $filepath = $backupDir . '/' . basename($filename);

         // Security: prevent directory traversal
         if (!file_exists($filepath) || !is_file($filepath)) {
            return response()->json([
               'success' => false,
               'message' => 'File backup tidak ditemukan.'
            ], 404);
         }

         // Check if file is a SQL backup
         if (pathinfo($filepath, PATHINFO_EXTENSION) !== 'sql') {
            return response()->json([
               'success' => false,
               'message' => 'File tidak valid.'
            ], 403);
         }

         if (unlink($filepath)) {
            return response()->json([
               'success' => true,
               'message' => 'Backup berhasil dihapus.'
            ]);
         } else {
            throw new \Exception('Gagal menghapus file backup.');
         }
      } catch (\Exception $e) {
         \Log::error('Error in deleteBackup method: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
         ]);
         return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
      }
   }
}
