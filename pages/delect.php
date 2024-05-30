<?php
include_once('../config/config.php');

if(isset($_GET['id'])) {
    $userId = $_GET['id'];
    
    // Get the current timestamp
    $deletedAt = date('Y-m-d H:i:s');
    
    // You need to replace 'deleted_by_user' with the actual identifier of the user who performed the deletion
    $deletedBy = 'deleted_by_user';

    // Update the is_deleted flag and set the deleted_at and deleted_by columns
    $updateQuery = "UPDATE user SET is_deleted = 1, deleted_at = '$deletedAt', deleted_by = '$deletedBy' WHERE id = $userId";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo "Data deleted successfully.";
    } else {
        echo "Failed to Data delete user.";
    }
} else {
    echo "Invalid request.";
}
?>

