<?php
// Simple database connection test
echo "<h1>Database Connection Test</h1>";

// Get database configuration from environment
$db_host = getenv('DB_HOST');
$db_port = getenv('DB_PORT');
$db_database = getenv('DB_DATABASE');
$db_username = getenv('DB_USERNAME');
$db_password = getenv('DB_PASSWORD');
$db_connection = getenv('DB_CONNECTION');

echo "<p><strong>DB_CONNECTION:</strong> " . ($db_connection ?: 'Not set') . "</p>";
echo "<p><strong>DB_HOST:</strong> " . ($db_host ?: 'Not set') . "</p>";
echo "<p><strong>DB_PORT:</strong> " . ($db_port ?: 'Not set') . "</p>";
echo "<p><strong>DB_DATABASE:</strong> " . ($db_database ?: 'Not set') . "</p>";
echo "<p><strong>DB_USERNAME:</strong> " . ($db_username ?: 'Not set') . "</p>";
// Don't display password for security

// Try to connect to database
if ($db_host && $db_database && $db_username) {
    try {
        $dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_database}";
        $pdo = new PDO($dsn, $db_username, $db_password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        echo "<p style='color: green;'><strong>Database Connection:</strong> SUCCESS</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'><strong>Database Connection Failed:</strong> " . $e->getMessage() . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }
} else {
    echo "<p style='color: orange;'><strong>Database Configuration:</strong> Incomplete - missing required variables</p>";
}

echo "<p><strong>Test Complete</strong></p>";