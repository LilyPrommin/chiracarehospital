<?php
error_reporting(E_ALL); // Enable all error reporting
ini_set('display_errors', 1); // Show errors on the screen

// Include your database connection
include 'db_connection.php';

header('Content-Type: application/json');

try {
    // Query to get the count of patients that need tracking today
    $query = "SELECT COUNT(*) as total FROM patients WHERE monitor_date = CURDATE()";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        throw new Exception('Database query error: ' . mysqli_error($conn));
    }

    $data = mysqli_fetch_assoc($result);
    echo json_encode($data);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
