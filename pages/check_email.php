<?php
// Include your database connection file
include_once('../config/config.php');

// Check if the email and number parameters are set in the POST request
if(isset($_POST['email']) && isset($_POST['number'])) {
    // Sanitize and escape the email and number parameters to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);

    // Query to check if the email already exists in the database
    $check_query = "SELECT * FROM `user` WHERE `email` = '$email' OR `number` = '$number'";
    $result = mysqli_query($conn, $check_query);

    // If the query returns any rows, it means the email or number already exists
    if(mysqli_num_rows($result) > 0) {
        $response = array('status' => 'exists', 'message' => 'Email or number already exists.');
    } else {
        // Email and number do not exist
        $response = array('status' => 'not_exists');
    }
} else {
    $response = array('status' => 'error', 'message' => 'Email or number parameter is not set');
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>

