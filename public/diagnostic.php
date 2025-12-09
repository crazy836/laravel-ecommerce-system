<?php
// Simple diagnostic script
echo "<h1>Laravel E-Commerce Diagnostic</h1>";

// Check PHP version
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";

// Check if Laravel's autoload exists
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo "<p><strong>Composer Autoload:</strong> Found</p>";
} else {
    echo "<p><strong>Composer Autoload:</strong> Missing</p>";
}

// Check storage permissions
echo "<p><strong>Storage Directory Writable:</strong> " . (is_writable(__DIR__ . '/../storage') ? 'Yes' : 'No') . "</p>";

// Check env file
if (file_exists(__DIR__ . '/../.env')) {
    echo "<p><strong>.env File:</strong> Found</p>";
} else {
    echo "<p><strong>.env File:</strong> Missing</p>";
}

// Try to load Laravel
try {
    require __DIR__.'/../vendor/autoload.php';
    echo "<p><strong>Laravel Bootstrap:</strong> Success</p>";
    
    // Try to create Laravel app
    $app = require_once __DIR__.'/../bootstrap/app.php';
    echo "<p><strong>Laravel App:</strong> Created</p>";
    
} catch (Exception $e) {
    echo "<p><strong>Laravel Bootstrap Error:</strong> " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<p><strong>Diagnostic Complete</strong></p>";