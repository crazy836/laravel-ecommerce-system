<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

Route::get('/health', function () {
    try {
        // Simple health check without database
        return response()->json([
            'status' => 'OK',
            'message' => 'Application is running',
            'timestamp' => now()->toISOString()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'ERROR',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});

Route::get('/health-db', function () {
    try {
        // Test database connection
        DB::connection()->getPdo();
        
        // Get environment info
        $envInfo = [
            'APP_ENV' => env('APP_ENV', 'Not set'),
            'APP_DEBUG' => env('APP_DEBUG', 'Not set'),
            'DB_CONNECTION' => env('DB_CONNECTION', 'Not set')
        ];
        
        return response()->json([
            'status' => 'OK',
            'database' => 'Connected',
            'environment' => $envInfo,
            'message' => 'Application and database are running successfully'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'ERROR',
            'database' => 'Disconnected',
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});

// TEMPORARY: Route to run migrations
Route::get('/migrate', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Migrations completed successfully',
            'output' => Artisan::output()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'ERROR',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});