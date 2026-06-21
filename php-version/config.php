<?php
// PHP Version: Configuration file for Database Connection (PDO)
// Configure your database connection details here.
// Compatible with local XAMPP, hosting environments, and Docker setups.

$host = 'localhost';
$db   = 'webdesa_sukamaju';
$user = 'root';
$pass = ''; // Leave blank by default for local XAMPP/MAMP setups
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // Elegant fallback to show error or proceed with mock static arrays if database isn't connected yet (for instant preview mode)
     $db_connected = false;
     $db_error = $e->getMessage();
}

/**
 * Helper function to generate safe random Tracking IDs
 */
function generateTrackingID($prefix) {
    return 'WD-' . strtoupper($prefix) . '-' . rand(1000, 9999);
}

/**
 * Filter input helper
 */
function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}
?>
