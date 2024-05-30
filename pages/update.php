<?php
include_once('../config/config.php');

// Check if form data is submitted via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set
    if (isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['updateId'], $_POST['message'], $_POST['facebook'], $_POST['instagram'], $_POST['whatsapp'], $_POST['linkedin'], $_POST['twitter'])) {
        // Get form data
        $updateid = $_POST['updateId'];
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];
        $whatsapp = $_POST['whatsapp'];
        $linkedin = $_POST['linkedin'];
        $twitter = $_POST['twitter'];

        // Check if a new profile picture is uploaded
        if ($_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
            // Get file details
            $profile = $_FILES['profilePicture']['name'];
            $temp_profile = $_FILES['profilePicture']['tmp_name'];

            // Set the destination folder where the image will be saved
            $profile_folder = "../img/";

            // Move the uploaded file to the desired folder
            $moved = move_uploaded_file($temp_profile, $profile_folder . $profile);

            // Check if file move is successful
            if ($moved) {
                // Update the database record with the new profile picture
                $update_query = "UPDATE `user` SET `first_name`='$first_name', `last_name`='$last_name', `email`='$email', `profile_picture`='$profile', `message`='$message', `facebook`='$facebook', `instagram`='$instagram', `whatsapp`='$whatsapp', `linkedin`='$linkedin', `twitter`='$twitter' WHERE `id`='$updateid'";
            } else {
                // Display error message if file move fails
                echo "File upload failed.";
                exit(); // Exit script if file move fails
            }
        } else {
            // Update the database record without changing the profile picture
            $update_query = "UPDATE `user` SET `first_name`='$first_name', `last_name`='$last_name', `email`='$email', `message`='$message', `facebook`='$facebook', `instagram`='$instagram', `whatsapp`='$whatsapp', `linkedin`='$linkedin', `twitter`='$twitter' WHERE `id`='$updateid'";
        }

        // Execute the update query
        $res = mysqli_query($conn, $update_query);

        if ($res) {
            // Return success message
            echo "Data updated successfully.";
        } else {
            // Return error message
            echo "Database update failed.";
        }
    } else {
        // Return error message if form fields are not set
        echo "One or more form fields are missing.";
    }
} else {
    // Return error message if request method is not POST
    echo "Invalid request method.";
}
?>
