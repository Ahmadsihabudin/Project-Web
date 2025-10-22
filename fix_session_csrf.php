<?php
// Script untuk memperbaiki masalah session dan CSRF
// Jalankan dengan: php fix_session_csrf.php

echo "=== DIAGNOSTIC SESSION & CSRF ===\n\n";

// 1. Check APP_KEY
echo "1. Checking APP_KEY...\n";
$appKey = env('APP_KEY');
if (empty($appKey)) {
    echo "❌ APP_KEY tidak ada! Generate dengan: php artisan key:generate\n";
} else {
    echo "✅ APP_KEY: " . substr($appKey, 0, 10) . "...\n";
}

// 2. Check Session Configuration
echo "\n2. Checking Session Configuration...\n";
echo "Session Driver: " . env('SESSION_DRIVER', 'file') . "\n";
echo "Session Lifetime: " . env('SESSION_LIFETIME', 120) . " minutes\n";
echo "Session Encrypt: " . (env('SESSION_ENCRYPT', false) ? 'Yes' : 'No') . "\n";

// 3. Check Database Connection
echo "\n3. Checking Database Connection...\n";
try {
    $pdo = new PDO(
        'mysql:host=' . env('DB_HOST', 'localhost') . ';dbname=' . env('DB_DATABASE', 'ujian_online'),
        env('DB_USERNAME', 'root'),
        env('DB_PASSWORD', '')
    );
    echo "✅ Database connection successful\n";
    
    // Check sessions table
    $stmt = $pdo->query("SHOW TABLES LIKE 'sessions'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Sessions table exists\n";
        
        // Check sessions table structure
        $stmt = $pdo->query("DESCRIBE sessions");
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo "Sessions table columns: " . implode(', ', $columns) . "\n";
    } else {
        echo "❌ Sessions table does not exist!\n";
        echo "Create with: php artisan session:table\n";
    }
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
}

// 4. Check Cache
echo "\n4. Checking Cache...\n";
$cacheDriver = env('CACHE_DRIVER', 'file');
echo "Cache Driver: " . $cacheDriver . "\n";

// 5. Recommendations
echo "\n=== RECOMMENDATIONS ===\n";
echo "1. Clear all caches:\n";
echo "   php artisan cache:clear\n";
echo "   php artisan config:clear\n";
echo "   php artisan session:clear\n";
echo "   php artisan view:clear\n\n";

echo "2. If using database sessions, ensure table exists:\n";
echo "   php artisan session:table\n";
echo "   php artisan migrate\n\n";

echo "3. Generate new APP_KEY if needed:\n";
echo "   php artisan key:generate\n\n";

echo "4. Restart web server after changes\n";
echo "   php artisan serve\n\n";

echo "5. Test CSRF endpoint:\n";
echo "   GET http://localhost:8000/debug/csrf\n";
echo "   POST http://localhost:8000/debug/csrf-test\n\n";

echo "=== DIAGNOSTIC COMPLETE ===\n";
?>
