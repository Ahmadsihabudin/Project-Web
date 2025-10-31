<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use App\Helpers\SecurityHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
   /**
    * Display a listing of users with statistics
    */
   public function index()
   {
      try {
         $users = User::select('id', 'name', 'email', 'role', 'last_login_at')
            ->orderBy('id', 'desc')
            ->get();
         $users = $users->map(function ($user) {
            $user->is_active = true;
            return $user;
         });
         $stats = [
            'total' => $users->count(),
            'active' => $users->where('is_active', true)->count(),
            'admin' => $users->where('role', 'admin')->count(),
            'staff' => $users->where('role', 'staff')->count(),
         ];

         return response()->json([
            'success' => true,
            'data' => $users,
            'stats' => $stats
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat data user: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Show the form for creating a new user
    */
   public function create()
   {
      return view('admin.users.create');
   }

   /**
    * Store a newly created user
    */
   public function store(Request $request)
   {
      if (session('user_type') !== 'admin') {
         return response()->json([
            'success' => false,
            'message' => 'Anda tidak memiliki izin untuk menambah user baru'
         ], 403);
      }

      $validator = Validator::make($request->all(), [
         'name' => 'required|string|max:255|min:2',
         'email' => 'required|email|max:255|unique:users,email',
         'username' => 'required|string|max:255|min:3',
         'password' => 'required|string|min:6|max:255',
         'password_confirmation' => 'required|string|min:6|max:255',
         'role' => 'required|in:admin,staff,supervisor',
         'status' => 'nullable|in:active,inactive',
         'phone' => 'nullable|string|max:20',
         'address' => 'nullable|string|max:500',
         'notes' => 'nullable|string|max:1000'
      ], [
         'name.required' => 'Nama lengkap harus diisi',
         'name.min' => 'Nama minimal 2 karakter',
         'email.required' => 'Email harus diisi',
         'email.email' => 'Format email tidak valid',
         'email.unique' => 'Email sudah digunakan',
         'username.required' => 'Username harus diisi',
         'username.min' => 'Username minimal 3 karakter',
         'username.unique' => 'Username sudah digunakan',
         'password.required' => 'Password harus diisi',
         'password.min' => 'Password minimal 6 karakter',
         'password_confirmation.required' => 'Konfirmasi password harus diisi',
         'password_confirmation.min' => 'Konfirmasi password minimal 6 karakter',
         'role.required' => 'Role harus diisi',
         'role.in' => 'Role harus admin, staff, atau supervisor',
         'status.in' => 'Status harus active atau inactive',
         'phone.max' => 'Nomor telepon maksimal 20 karakter',
         'address.max' => 'Alamat maksimal 500 karakter',
         'notes.max' => 'Catatan maksimal 1000 karakter'
      ]);
      if ($request->password !== $request->password_confirmation) {
         $validator->errors()->add('password_confirmation', 'Konfirmasi password tidak sesuai');
      }
      $existingUsername = User::where('username', $request->username)
         ->whereNotNull('username')
         ->exists();

      if ($existingUsername) {
         $validator->errors()->add('username', 'Username sudah digunakan');
      }

      if ($validator->fails()) {
         \Log::error('User validation failed', [
            'errors' => $validator->errors()->toArray(),
            'input' => $request->all()
         ]);

         return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
         ], 400);
      }

      try {
         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => SecurityHelper::hashPassword($request->password),
            'role' => $request->role,
            'status' => $request->status ?: 'active',
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $request->notes
         ]);
         ActivityLog::create([
            'user_type' => 'admin',
            'user_id' => session('user_id'),
            'action' => 'create_user',
            'description' => "Created new {$request->role}: {$user->name}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'metadata' => SecurityHelper::getDeviceInfo($request->userAgent())
         ]);

         return response()->json([
            'success' => true,
            'message' => 'Staff berhasil ditambahkan',
            'data' => $user
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal menambahkan staff: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Show the form for editing the specified user
    */
   public function edit($id)
   {
      try {
         $user = User::select('id', 'name', 'email', 'role', 'last_login_at')
            ->findOrFail($id);

         $user->is_active = true;

         return view('admin.users.edit', compact('user'));
      } catch (\Exception $e) {
         return redirect()->route('admin.users.index')
            ->with('error', 'User tidak ditemukan');
      }
   }

   /**
    * Display the specified user
    */
   public function show($id)
   {
      try {
         $user = User::select('id', 'name', 'email', 'role', 'last_login_at')
            ->findOrFail($id);

         $user->is_active = true;

         return response()->json([
            'success' => true,
            'data' => $user
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'User tidak ditemukan'
         ], 404);
      }
   }

   /**
    * Update the specified user
    */
   public function update(Request $request, $id)
   {
      if (session('user_type') !== 'admin') {
         return response()->json([
            'success' => false,
            'message' => 'Anda tidak memiliki izin untuk mengupdate user'
         ], 403);
      }

      $validator = Validator::make($request->all(), [
         'name' => 'required|string|max:255|min:2',
         'email' => 'required|email|unique:users,email,' . $id,
         'password' => 'nullable|string|min:6',
         'role' => 'required|in:admin,staff'
      ], [
         'name.required' => 'Nama lengkap harus diisi',
         'name.min' => 'Nama minimal 2 karakter',
         'email.required' => 'Email harus diisi',
         'email.email' => 'Format email tidak valid',
         'email.unique' => 'Email sudah digunakan',
         'password.min' => 'Password minimal 6 karakter',
         'role.required' => 'Role harus diisi',
         'role.in' => 'Role harus admin atau staff'
      ]);

      if ($validator->fails()) {
         return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
         ], 400);
      }

      try {
         $user = User::findOrFail($id);
         $oldData = $user->toArray();

         $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
         ];
         if ($request->filled('password')) {
            $updateData['password'] = SecurityHelper::hashPassword($request->password);
         }

         $user->update($updateData);
         ActivityLog::create([
            'user_type' => 'admin',
            'user_id' => session('user_id'),
            'action' => 'update_user',
            'description' => "Updated user: {$user->name}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'metadata' => SecurityHelper::getDeviceInfo($request->userAgent())
         ]);

         return response()->json([
            'success' => true,
            'message' => 'Staff berhasil diupdate',
            'data' => $user
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal mengupdate staff: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Remove the specified user
    */
   public function destroy(Request $request, $id)
   {
      if (session('user_type') !== 'admin') {
         return response()->json([
            'success' => false,
            'message' => 'Anda tidak memiliki izin untuk menghapus user'
         ], 403);
      }

      try {
         $user = User::findOrFail($id);
         $userName = $user->name;
         if ($user->role === 'admin') {
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount <= 1) {
               return response()->json([
                  'success' => false,
                  'message' => 'Tidak dapat menghapus admin terakhir'
               ], 400);
            }
         }

         $user->delete();
         ActivityLog::create([
            'user_type' => 'admin',
            'user_id' => session('user_id'),
            'action' => 'delete_user',
            'description' => "Deleted user: {$userName}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'metadata' => SecurityHelper::getDeviceInfo($request->userAgent())
         ]);

         return response()->json([
            'success' => true,
            'message' => 'Staff berhasil dihapus'
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus staff: ' . $e->getMessage()
         ], 500);
      }
   }

   /**
    * Get user data for API
    */
   public function data()
   {
      return $this->index();
   }

   /**
    * Get user statistics for API
    */
   public function stats()
   {
      try {
         $users = User::select('id', 'name', 'email', 'role', 'last_login_at')
            ->orderBy('id', 'desc')
            ->get();
         $users = $users->map(function ($user) {
            $user->is_active = true;
            return $user;
         });
         $stats = [
            'total' => $users->count(),
            'active' => $users->where('is_active', true)->count(),
            'admin' => $users->where('role', 'admin')->count(),
            'staff' => $users->where('role', 'staff')->count(),
         ];

         return response()->json([
            'success' => true,
            'stats' => $stats
         ]);
      } catch (\Exception $e) {
         return response()->json([
            'success' => false,
            'message' => 'Gagal memuat statistik user: ' . $e->getMessage()
         ], 500);
      }
   }
}
