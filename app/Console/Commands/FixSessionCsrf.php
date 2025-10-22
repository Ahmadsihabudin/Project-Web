<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixSessionCsrf extends Command
{
    protected $signature = 'fix:session-csrf';
    protected $description = 'Fix session and CSRF issues';

    public function handle()
    {
        $this->info('=== FIXING SESSION & CSRF ISSUES ===');
        
        // 1. Check APP_KEY
        $this->info('1. Checking APP_KEY...');
        $appKey = config('app.key');
        if (empty($appKey)) {
            $this->error('APP_KEY is empty! Generating new key...');
            Artisan::call('key:generate');
            $this->info('✅ New APP_KEY generated');
        } else {
            $this->info('✅ APP_KEY exists: ' . substr($appKey, 0, 10) . '...');
        }

        // 2. Clear all caches
        $this->info('2. Clearing caches...');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        $this->info('✅ All caches cleared');

        // 3. Check sessions table
        $this->info('3. Checking sessions table...');
        if (!Schema::hasTable('sessions')) {
            $this->warn('Sessions table does not exist. Creating...');
            Artisan::call('session:table');
            Artisan::call('migrate');
            $this->info('✅ Sessions table created');
        } else {
            $this->info('✅ Sessions table exists');
        }

        // 4. Clear sessions
        $this->info('4. Clearing sessions...');
        DB::table('sessions')->truncate();
        $this->info('✅ Sessions cleared');

        // 5. Test CSRF token
        $this->info('5. Testing CSRF token...');
        $token = csrf_token();
        if (!empty($token)) {
            $this->info('✅ CSRF token generated: ' . substr($token, 0, 10) . '...');
        } else {
            $this->error('❌ CSRF token generation failed');
        }

        // 6. Check session configuration
        $this->info('6. Session configuration:');
        $this->line('   Driver: ' . config('session.driver'));
        $this->line('   Lifetime: ' . config('session.lifetime') . ' minutes');
        $this->line('   Encrypt: ' . (config('session.encrypt') ? 'Yes' : 'No'));

        $this->info('=== FIX COMPLETE ===');
        $this->info('Please restart your web server: php artisan serve');
    }
}
