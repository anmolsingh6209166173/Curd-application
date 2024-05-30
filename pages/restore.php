<?php
include_once('../config/config.php');

if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Update the is_deleted flag to 0, and clear deleted_at and deleted_by
    $restoreQuery = "UPDATE user SET is_deleted = 0, deleted_at = NULL, deleted_by = NULL WHERE id = $userId";
    $restoreResult = mysqli_query($conn, $restoreQuery);

    if ($restoreResult) {
        echo "User restored successfully.";
    } else {
        echo "Failed to restore user.";
    }
} else {
    echo "Invalid request.";
}
?>
