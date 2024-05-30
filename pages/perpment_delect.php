<?php
include_once('../config/config.php');

if(isset($_POST['id'])) {
    // Sanitize the input to prevent SQL injection
    $userId = mysqli_real_escape_string($conn, $_POST['id']);
    
    // You need to replace 'deleted_by_user' with the actual identifier of the user who performed the deletion
    $deletedBy = 'deleted_by_user';

    // Delete all records associated with the specified ID from the database
    $deleteQuery = "DELETE FROM user WHERE id = '$userId'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        echo "Data deleted successfully.";
    } else {
        echo "Failed to delete data.";
    }
} else {
    echo "Invalid request.";
}
?>

