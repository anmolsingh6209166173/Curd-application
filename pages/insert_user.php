<?php
include_once('../config/config.php');

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $message = $_POST['message'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];
    $whatsapp = $_POST['whatsapp'];
    $twitter = $_POST['twitter'];
    $profile = $_FILES['profile_picture']['name'];
    $temp_profile = $_FILES['profile_picture']['tmp_name'];

    // Set the destination folder where the image will be saved
    $profile_folder = "../img/";

    // Move the uploaded file to the desired folder
    $moved = move_uploaded_file($temp_profile, $profile_folder . $profile);

    if ($moved) {
        // Construct the path to the saved image

        // Perform the database insertion with the image path
        $insert = "INSERT INTO `user`(`first_name`, `last_name`, `email`, `profile_picture`,`number`,`message`,`facebook`,`instagram`,`linkedin`,`whatsapp`,`twitter`) VALUES ('$first_name','$last_name','$email','$profile','$number','$message','$facebook','$instagram','$linkedin','$whatsapp','$twitter')";
        $res = mysqli_query($conn, $insert);

        if ($res) {
            // Redirect or display success message
            header("location:../index.php");
        } else {
            // Display error message
            echo "Database insertion failed.";
        }
    } else {
        // Display error message if file move fails
        echo "File upload failed.";
    }
}