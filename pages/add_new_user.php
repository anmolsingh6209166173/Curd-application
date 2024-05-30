<?php include_once('../inc/header.php'); ?>
<?php include_once('../config/config.php'); ?>
<div class="container-fluid" id="mycontainer">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mx-auto">
                <div class="card p-3 my-3">
                    <form id="myForm" action="insert_user.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>First Name:</label>
                                    <input type="text" name="first_name" class="form-control" id="names" placeholder="Enter First Name">
                                    <span class="error-names text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Last Name:</label>
                                    <input type="text" name="last_name" class="form-control" id="lastname" placeholder="Enter Last Name">
                                    <span class="error-lastname text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" name="email" class="form-control" id="emails" placeholder="Enter Email">
                                    <span class="error-emails text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Mobile Number:</label>
                                    <input type="text" name="number" class="form-control" id="phones" placeholder="Enter Mobile Number">
                                    <span class="error-phones text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>About Us:</label>
                            <textarea name="message" class="form-control" id="message" cols="30" rows="3" maxlength="200"></textarea>
                            <span class="error-messages text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Profile Image:</label>
                            <input type="file" name="profile_picture" class="form-control" id="imageupload" accept="image/x-png,image/jpeg" value="">
                            <span class="error-image text-danger"></span>
                        </div>
                        <div id="inputGroupsContainer">
                            <!-- Initial Input Group -->
                            <div class="form-group">
                                <label>Social Media: <span class="optional">(optional)</span></label>
                                <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text add-icon"><i class="fa-solid fa-plus"></i></div>
                                    </div>
                                    <input type="url" class="form-control" id="faceBook" name="facebook" placeholder="Facebook">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-info" id="add-user" onclick="return validForm()">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/vaildition.js"></script>
<script>
    $(document).ready(function() {
        // Array of placeholder values and unique names
        var placeholders = ['Instagram', 'LinkedIn', 'WhatsApp', 'Twitter'];
        var uniqueNames = ['instagram', 'linkedin', 'whatsapp', 'twitter'];

        // Initialize index for cycling through placeholders
        var currentIndex = 0;

        // Array to keep track of appended placeholders
        var appendedPlaceholders = new Array(placeholders.length).fill(false);

        // Function to add new input group
        function addInputGroup() {
            // Find the next placeholder to append
            var nextIndex = findNextPlaceholderIndex();

            // If all placeholders are appended, return
            if (nextIndex === -1) {
                return;
            }

            // Get the placeholder at nextIndex
            var currentPlaceholder = placeholders[nextIndex];
            var currentName = uniqueNames[nextIndex];

            // Mark the placeholder as appended
            appendedPlaceholders[nextIndex] = true;

            // Generate unique ID for the input field
            var uniqueId = 'input_' + currentName;

            // Create new input group with current placeholder and unique ID
            var newInputGroup = $('<div class="form-group">' +
                '<label class="sr-only" for="' + uniqueId + '">Username</label>' +
                '<div class="input-group mb-2 mr-sm-2">' +
                '<div class="input-group-prepend">' +
                '<div class="input-group-text remove-icon"><i class="fa-solid fa-minus "></i></div>' +
                '</div>' +
                '<input type="url" class="form-control" id="' + uniqueId + '" name="' + currentName + '" placeholder="' + currentPlaceholder + '">' +
                '</div>' +
                '</div>');

            // Append the new input group
            $('#inputGroupsContainer').append(newInputGroup);
        }

        // Function to find the index of the next placeholder to append
        function findNextPlaceholderIndex() {
            for (var i = 0; i < appendedPlaceholders.length; i++) {
                if (!appendedPlaceholders[i]) {
                    return i;
                }
            }
            return -1; // All placeholders are appended
        }

        // Add new input group when plus icon is clicked
        $(document).on('click', '.add-icon', function() {
            addInputGroup();
        });

        // Remove input group when minus icon is clicked
        $(document).on('click', '.remove-icon', function() {
            // Find the index of the placeholder associated with the removed input group
            var removedPlaceholder = $(this).closest('.form-group').find('input').attr('placeholder');
            var removedIndex = placeholders.indexOf(removedPlaceholder);

            // Mark the removed placeholder as not appended
            appendedPlaceholders[removedIndex] = false;

            // Remove the input group
            $(this).closest('.form-group').remove();
        });
    });
</script>





<?php include_once('../inc/footer.php'); ?>