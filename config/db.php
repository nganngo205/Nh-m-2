<?php
$host = getenv('DB_HOST') ?: 'localhost'; // Use environment variables
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$db = getenv('DB_NAME') ?: 'quangba_tmu';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable exception handling

try {
    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset("utf8mb4"); // Set character set
} catch (mysqli_sql_exception $e) {
    error_log("Database connection error: " . $e->getMessage());
    // Display a user-friendly error message (in a production environment, you might redirect to an error page)
    echo "A database error occurred. Please try again later.";
    exit;
}
?>
