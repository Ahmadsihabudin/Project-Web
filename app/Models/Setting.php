<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
   use HasFactory;

   public $timestamps = false;

   protected $fillable = [
      'key',
      'value',
      'description',
      'category',
      'type',
      'is_public',
      'is_encrypted',
      'validation_rules',
      'default_value'
   ];

   protected $casts = [
      'is_public' => 'boolean',
      'is_encrypted' => 'boolean'
   ];

   /**
    * Get the decrypted value
    */
   public function getDecryptedValueAttribute()
   {
      if ($this->is_encrypted) {
         try {
            return decrypt($this->value);
         } catch (\Exception $e) {
            return $this->value;
         }
      }

      return $this->value;
   }

   /**
    * Scope for public settings
    */
   public function scopePublic($query)
   {
      return $query->where('is_public', true);
   }

   /**
    * Scope for encrypted settings
    */
   public function scopeEncrypted($query)
   {
      return $query->where('is_encrypted', true);
   }

   /**
    * Scope by category
    */
   public function scopeByCategory($query, $category)
   {
      return $query->where('category', $category);
   }

   /**
    * Scope by type
    */
   public function scopeByType($query, $type)
   {
      return $query->where('type', $type);
   }
}
