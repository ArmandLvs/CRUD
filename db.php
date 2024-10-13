<?php
// Get database credentials from environment variables
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$port = getenv('DB_PORT') ?: '5432';  // PostgreSQL default port

// Attempt to connect to the PostgreSQL database
try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Set error mode to exception
} catch (PDOException $e) {
    // If the connection fails, display an error message
    echo "Connection failed: " . $e->getMessage();
    exit;  // Stop the script if connection fails
}
?>
