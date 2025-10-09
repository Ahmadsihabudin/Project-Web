<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Helpers\SecurityHelper;

class StaffSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      $staffs = [
         [
            'nama' => 'Admin Utama',
            'email' => 'admin@ujian.com',
            'password' => 'admin123',
            'role' => 'admin'
         ],
         [
            'nama' => 'Staff Proktor',
            'email' => 'proktor@ujian.com',
            'password' => 'staff123',
            'role' => 'staff'
         ],
         [
            'nama' => 'Staff Teknis',
            'email' => 'teknis@ujian.com',
            'password' => 'staff123',
            'role' => 'staff'
         ],
         [
            'nama' => 'Staff Laporan',
            'email' => 'laporan@ujian.com',
            'password' => 'staff123',
            'role' => 'staff'
         ]
      ];

      foreach ($staffs as $staff) {
         User::updateOrCreate(
            ['email' => $staff['email']],
            [
               'nama' => $staff['nama'],
               'password' => SecurityHelper::hashPassword($staff['password']),
               'role' => $staff['role'],
               'login_attempts' => 0,
               'locked_until' => null
            ]
         );
      }
   }
}
