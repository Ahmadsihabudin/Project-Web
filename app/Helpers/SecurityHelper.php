<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SecurityHelper
{
   /**
    * Generate secure random code untuk peserta
    */
   public static function generateSecureCode($prefix = 'P', $length = 8)
   {
      // Generate random string dengan karakter yang aman
      $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; // Exclude confusing characters
      $code = $prefix;

      for ($i = 0; $i < $length - 1; $i++) {
         $code .= $characters[random_int(0, strlen($characters) - 1)];
      }

      return $code;
   }

   /**
    * Hash password dengan bcrypt
    */
   public static function hashPassword($password)
   {
      return Hash::make($password);
   }

   /**
    * Verify password using hashing when applicable.
    * Falls back to plain-text comparison when the stored value
    * is not a bcrypt/argon hash (useful for participant kode_akses
    * that may be stored as plain text in legacy data).
    */
   public static function verifyPasswordFlexible(string $plainInput, string $storedValue): bool
   {
      // Detect common hash prefixes
      $isHashed = str_starts_with($storedValue, '$2y$')
         || str_starts_with($storedValue, '$2a$')
         || str_starts_with($storedValue, '$argon2');

      if ($isHashed) {
         try {
            return Hash::check($plainInput, $storedValue);
         } catch (\Throwable $e) {
            // If hashing check fails unexpectedly, fall back to safe compare
         }
      }

      // Constant-time comparison for non-hashed legacy values
      return hash_equals((string) $storedValue, (string) $plainInput);
   }

   /**
    * Generate random soal order
    */
   public static function randomizeSoalOrder($soalIds)
   {
      $shuffled = $soalIds;
      shuffle($shuffled);
      return $shuffled;
   }

   /**
    * Generate random jawaban order (A,B,C,D -> B,D,A,C)
    */
   public static function randomizeJawabanOrder()
   {
      $options = ['a', 'b', 'c', 'd'];
      shuffle($options);
      return $options;
   }

   /**
    * Check if account is locked due to too many login attempts
    */
   public static function isAccountLocked($loginAttempts, $lockedUntil)
   {
      if ($loginAttempts >= 5 && $lockedUntil && Carbon::now()->lt($lockedUntil)) {
         return true;
      }
      return false;
   }

   /**
    * Calculate lock duration based on attempts
    */
   public static function getLockDuration($attempts)
   {
      // Progressive lock: 5 min, 15 min, 30 min, 1 hour
      $durations = [5, 15, 30, 60];
      $index = min($attempts - 5, count($durations) - 1);
      return $durations[$index];
   }

   /**
    * Generate secure session token
    */
   public static function generateSessionToken()
   {
      return Str::random(64);
   }

   /**
    * Validate IP address format
    */
   public static function isValidIP($ip)
   {
      return filter_var($ip, FILTER_VALIDATE_IP) !== false;
   }

   /**
    * Get device info from user agent
    */
   public static function getDeviceInfo($userAgent)
   {
      $deviceInfo = [
         'browser' => 'Unknown',
         'os' => 'Unknown',
         'device' => 'Unknown'
      ];

      // Simple browser detection
      if (strpos($userAgent, 'Chrome') !== false) {
         $deviceInfo['browser'] = 'Chrome';
      } elseif (strpos($userAgent, 'Firefox') !== false) {
         $deviceInfo['browser'] = 'Firefox';
      } elseif (strpos($userAgent, 'Safari') !== false) {
         $deviceInfo['browser'] = 'Safari';
      }

      // Simple OS detection
      if (strpos($userAgent, 'Windows') !== false) {
         $deviceInfo['os'] = 'Windows';
      } elseif (strpos($userAgent, 'Mac') !== false) {
         $deviceInfo['os'] = 'macOS';
      } elseif (strpos($userAgent, 'Linux') !== false) {
         $deviceInfo['os'] = 'Linux';
      } elseif (strpos($userAgent, 'Android') !== false) {
         $deviceInfo['os'] = 'Android';
      } elseif (strpos($userAgent, 'iPhone') !== false) {
         $deviceInfo['os'] = 'iOS';
      }

      return $deviceInfo;
   }
}
