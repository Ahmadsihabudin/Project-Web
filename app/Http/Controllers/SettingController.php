<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      return view('admin.settings.index');
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
}
