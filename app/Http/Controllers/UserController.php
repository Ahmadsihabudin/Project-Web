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

         // Add is_active status (simplified - you can add is_active column later)
         $users = $users->map(function ($user) {
            $user->is_active = true; // For now, all users are considered active
            return $user;
         });

         // Calculate statistics
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
    * Store a newly created user
    */
   public function store(Request $request)
   {
      // Check if user is admin (only admin can create new users)
      if (session('user_type') !== 'admin') {
         return response()->json([
            'success' => false,
            'message' => 'Anda tidak memiliki izin untuk menambah user baru'
         ], 403);
      }

      $validator = Validator::make($request->all(), [
         'name' => 'required|string|max:255',
         'email' => 'required|email|unique:users,email',
         'password' => 'required|string|min:6',
         'role' => 'required|in:admin,staff'
      ]);

      if ($validator->fails()) {
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
            'password' => SecurityHelper::hashPassword($request->password),
            'role' => $request->role,
            'login_attempts' => 0,
            'locked_until' => null
         ]);

         // Log activity
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

         $user->is_active = true; // For now, all users are considered active

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

         $user->is_active = true; // For now, all users are considered active

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
      // Check if user is admin (only admin can update users)
      if (session('user_type') !== 'admin') {
         return response()->json([
            'success' => false,
            'message' => 'Anda tidak memiliki izin untuk mengupdate user'
         ], 403);
      }

      $validator = Validator::make($request->all(), [
         'name' => 'required|string|max:255',
         'email' => 'required|email|unique:users,email,' . $id,
         'password' => 'nullable|string|min:6',
         'role' => 'required|in:admin,staff'
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

         // Only update password if provided
         if ($request->filled('password')) {
            $updateData['password'] = SecurityHelper::hashPassword($request->password);
         }

         $user->update($updateData);

         // Log activity
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
      // Check if user is admin (only admin can delete users)
      if (session('user_type') !== 'admin') {
         return response()->json([
            'success' => false,
            'message' => 'Anda tidak memiliki izin untuk menghapus user'
         ], 403);
      }

      try {
         $user = User::findOrFail($id);
         $userName = $user->name;

         // Prevent deleting the last admin
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

         // Log activity
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

         // Add is_active status (simplified - you can add is_active column later)
         $users = $users->map(function ($user) {
            $user->is_active = true; // For now, all users are considered active
            return $user;
         });

         // Calculate statistics
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
