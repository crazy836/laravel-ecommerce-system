<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/health', function () {
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
            'message' => 'Application is running successfully'
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