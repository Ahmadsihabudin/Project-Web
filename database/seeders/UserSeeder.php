<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      // Clear existing users
      User::query()->delete();

      // Create Super Admin
      User::create([
         'name' => 'Super Admin',
         'email' => 'admin@ujianonline.com',
         'password' => Hash::make('admin123'),
         'role' => 'admin',
         'email_verified_at' => now(),
      ]);

      // Create Staff
      User::create([
         'name' => 'Staff Ujian',
         'email' => 'staff@ujianonline.com',
         'password' => Hash::make('staff123'),
         'role' => 'staff',
         'email_verified_at' => now(),
      ]);

      // Create additional staff
      User::create([
         'name' => 'Guru Matematika',
         'email' => 'guru.matematika@ujianonline.com',
         'password' => Hash::make('guru123'),
         'role' => 'staff',
         'email_verified_at' => now(),
      ]);

      User::create([
         'name' => 'Guru Bahasa Indonesia',
         'email' => 'guru.bahasa@ujianonline.com',
         'password' => Hash::make('guru123'),
         'role' => 'staff',
         'email_verified_at' => now(),
      ]);

      $this->command->info('Users created successfully!');
      $this->command->info('Super Admin: admin@ujianonline.com / admin123');
      $this->command->info('Staff: staff@ujianonline.com / staff123');
      $this->command->info('Guru Matematika: guru.matematika@ujianonline.com / guru123');
      $this->command->info('Guru Bahasa: guru.bahasa@ujianonline.com / guru123');
   }
}
