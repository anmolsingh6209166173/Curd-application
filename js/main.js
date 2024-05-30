function openPopup(
  firstName,
  lastName,
  email,
  number,
  message,
  profilePicture,
  facebook,
  instagram,
  twitter,
  linkedin,
  whatsapp,
  id,
  is_deleted
) {
  var editDisplay = is_deleted == 1 ? "none" : "flex";

  var popupContent = `
    <div class="container">
      <h5 class="update text-center" id="label">Your Data</h5>
      <div class="edit" style="display: ${editDisplay};">
        <a href="javascript:void(0);" class="edit-icon" onclick="openEditForm()">
          <i class="fa-solid fa-user-pen"></i>
        </a>
      </div>
      <div class="row align-items-start">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6">
              <div class="row">
                <div class="col-lg-12 mb-3">
                  <label for="firstName" class="form-label">First Name</label>
                  <input class="form-control" name="firstName" type="text" id="firstName" value="${firstName}" disabled>
                  <span class="error-names text-danger"></span>
                </div>
                <div class="col-lg-12 mb-3">
                  <label for="lastName" class="form-label">Last Name</label>
                  <input class="form-control" name="lastName" type="text" id="lastName" value="${lastName}" disabled>
                  <span class="error-lastname text-danger"></span>
                </div>
                <div class="col-lg-12 mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input class="form-control" type="email" name="email" id="email" value="${email}" disabled>
                  <span class="error-emails text-danger"></span>
                </div>
                <div class="col-lg-12 mb-3">
                  <label for="number" class="form-label">Mobile Number</label>
                  <input type="text" name="number" class="form-control" value="${number}" id="number" placeholder="Enter Mobile Number" disabled>
                  <span class="error-phones text-danger"></span>
                </div>
             
    <div class="col-lg-12 mb-3">
        <label for="facebook" class="form-label">Facebook</label>
        <input type="url" name="facebook" class="form-control" value="${facebook}" id="facebook" placeholder="Enter facebook url" disabled>
        <span class="error-facebook text-danger"></span>
    </div>



<div class="col-lg-12 mb-3">
    <label for="instagram" class="form-label">Instagram</label>
    <input type="url" name="instagram" class="form-control" value="${instagram}" id="instagram" placeholder="Enter instagram url" disabled>
    <span class="error-instagram text-danger"></span>
</div>






    <div class="col-lg-12 mb-3">
        <label for="twitter" class="form-label">Twitter</label>
        <input type="url" name="twitter" class="form-control" value="${twitter}" id="twitter" placeholder="Enter twitter url" disabled>
        <span class="error-twitter text-danger"></span>
    </div>



    <div class="col-lg-12 mb-3">
        <label for="linkedin" class="form-label">Linkedin</label>
        <input type="url" name="linkedin" class="form-control" value="${linkedin}" id="linkedin" placeholder="Enter linkedin url" disabled>
        <span class="error-linkedin text-danger"></span>
    </div>



    <div class="col-lg-12 mb-3">
        <label for="whatsapp" class="form-label">Whatsapp</label>
        <input type="url" name="whatsapp" class="form-control" value="${whatsapp}" id="whatsapp" placeholder="Enter whatsapp url" disabled>
        <span class="error-whatsapp text-danger"></span>
    </div>


                <div class="col-lg-12 mb-3">
                  <label for="message" class="form-label">About Us</label>
                  <textarea name="message" class="form-control" id="message" cols="30" rows="3" disabled maxlength="200">${message}</textarea>
                  <span class="error-messages text-danger"></span>
                </div>
              </div>
            </div>
            <div class="col-lg-6 mb-3">
              <div id="imageDiv" style="width: 350px; height: 260px;">
                <img id="profileImage" src="http://${window.location.hostname}/CRUD/img/${profilePicture}" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                <input type="file" id="fileInput" name="uploadImage" accept="image/x-png,image/jpeg">
                <span class="error-image text-danger"></span>
                <input type="hidden" value="${id}" id="updateId">
              </div>
            </div>
          </div>
        </div>
      </div>
      <input type="submit" name="submit" value="Submit" id="save-btn" class="btn btn-primary">
    </div>
  `;
  //  console.log('Instagram:', instagram);
  document.getElementById("popupContent").innerHTML = popupContent;
  document.getElementById("myModal").style.display = "block";
  // Get all input fields
  const inputs = document.querySelectorAll('input[type="url"]');

  // Loop through each input field
  inputs.forEach(function (input) {
    // Check if input value is empty
    if (input.value.trim() === "") {
      // Hide the parent column if value is empty
      input.closest(".col-lg-12.mb-3").classList.add("d-none");
    } else {
      // Show the parent column if value is not empty
      input.closest(".col-lg-12.mb-3").classList.remove("d-none");
    }
  });
}

// Close the modal when the close button is clicked
document.getElementsByClassName("close")[0].onclick = function () {
  document.getElementById("myModal").style.display = "none";
};

function deleteUser(userId) {
  if (confirm("Are you sure you want to delete this user?")) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "pages/delect.php?id=" + userId, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        alert(xhr.responseText);
        window.location.reload(); // Reload the page
        // You can handle UI update or refresh here
      }
    };
    xhr.send();
  }
}

function permentDlect(id) {
  // Confirm deletion with the user
  if (confirm("Are you sure you want to permanently delete this data?")) {
    // Send an AJAX request to delete the data
    $.ajax({
      type: "POST", // Change to POST method
      url: "pages/perpment_delect.php",
      data: { id: id },
      success: function (response) {
        // Handle success (optional)
        alert(response); // Display the response from the server
        // Optionally, you can reload the page or update the UI
        window.location.reload();
      },
      error: function (xhr, status, error) {
        // Handle errors (optional)
        console.error("AJAX request failed:", error);
      },
    });
  }
}

function openEditForm() {
  // Saare input fields ko enable karna
  var message = document.getElementById("message");
  var imageData = document.getElementById("fileInput");
  var saveBtn = document.getElementById("save-btn");
  var inputFields = document.querySelectorAll("input");
  var messageBox = document.querySelectorAll("textarea");
  inputFields.forEach(function (field) {
    field.removeAttribute("disabled");
  });
  messageBox.forEach(function (field) {
    field.removeAttribute("disabled");
  });

  $("#label").html("Update Your Data");
  message.style.display = "block";
  imageData.style.display = "block";
  saveBtn.style.display = "block";
  document
    .getElementById("fileInput")
    .addEventListener("change", function (event) {
      var file = event.target.files[0];
      var reader = new FileReader();

      reader.onload = function (e) {
        var profileImage = document.getElementById("profileImage");
        profileImage.src = e.target.result;
      };

      reader.readAsDataURL(file);
    });
}

document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("popupContent"); // Get the form element
  if (form) {
    // Check if form exists
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      // Prevent form submission
      // Check if form data is valid
      if (validateForm()) {
        var updateID = document.querySelector("#updateId");
        //  console.log(updateID);
        var firstNameInput = document.querySelector("input[name='firstName']"); // Get first name input field
        var lastNameInput = document.querySelector("input[name='lastName']"); // Get last name input field
        var emailInput = document.querySelector("input[name='email']"); // Get email input field
        var numberInput = document.querySelector("input[name='number']"); // Get number input field
        var messageBox = document.querySelector("textarea[name='message']"); // Get message input field
        var facebookUrl = document.querySelector("#facebook");
        var instagramUrl = document.querySelector("#instagram");
        var linkedinUrl = document.querySelector("#linkedin");
        var whatsappUrl = document.querySelector("#whatsapp");
        var twitterUrl = document.querySelector("#twitter");
        var fileInput = document.getElementById("fileInput"); // Get file input field
        // Check if input fields exist
        if (
          firstNameInput &&
          lastNameInput &&
          emailInput &&
          numberInput &&
          messageBox &&
          facebookUrl &&
          instagramUrl &&
          linkedinUrl &&
          whatsappUrl &&
          twitterUrl
        ) {
          var id = updateID.value;
          var firstName = firstNameInput.value;
          var lastName = lastNameInput.value;
          var email = emailInput.value;
          var number = numberInput.value;
          var message = messageBox.value;
          var facebook = facebookUrl.value;
          var instagram = instagramUrl.value;
          var linkedin = linkedinUrl.value;
          var whatsapp = whatsappUrl.value;
          var twitter = twitterUrl.value;
          var formData = new FormData(); // Create a new FormData object

          // Append regular form data
          formData.append("updateId", id);
          formData.append("firstName", firstName);
          formData.append("lastName", lastName);
          formData.append("email", email);
          formData.append("number", number);
          formData.append("message", message);
          formData.append("facebook", facebook);
          formData.append("instagram", instagram);
          formData.append("linkedin", linkedin);
          formData.append("whatsapp", whatsapp);
          formData.append("twitter", twitter);
          // Check if a file is selected
          if (fileInput.files.length > 0) {
            var file = fileInput.files[0]; // Get the file

            // Append the file to FormData
            formData.append("profilePicture", file);
          }

          // Send AJAX request
          $.ajax({
            type: "POST",
            url: "pages/update.php", // Path to your PHP script
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
              alert("Data updated successfully");
              $("#myModal").hide(); // Close the modal
              window.location.reload(); // Reload the page
              // Handle success
            },
            error: function (xhr, status, error) {
              console.error("AJAX request failed:", error);
            },
          }); // Close the $.ajax() function
        } else {
          console.error("One or more input fields not found.");
        }
      } else {
        console.log("anmol.");
      }
    }); // Close the form.addEventListener() function
  } else {
    console.error("Form element not found.");
  }
});

function restoreFunction(userId) {
  // Ask for confirmation from the user
  var confirmRestore = confirm("Do you want to restore this user's data?");

  // If user confirms, proceed with the restore operation
  if (confirmRestore) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "pages/restore.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Show the response from the server
        // alert(xhr.responseText);
        alert("Data Restore successfully");
        // Reload the page after successful restoration
        location.reload();
      }
    };

    // Send the user_id as a parameter in the POST request
    xhr.send("user_id=" + userId);
  } else {
    // If user cancels, do nothing
    alert("User data was not restored.");
  }
}

// JavaScript to handle search functionality
document.getElementById("searchBtn").addEventListener("click", function (e) {
  e.preventDefault(); // Prevent the default form submission behavior
  search();
});

// Function to handle search
function search() {
  const searchQuery = document.getElementById("searchInput").value.trim();
  // Redirect to the same page with search query as parameter
  const baseUrl = window.location.href.split("?")[0];
  const queryParams = searchQuery
    ? `?q=${encodeURIComponent(searchQuery)}`
    : "";
  window.location.href = `${baseUrl}${queryParams}`;
}

// Listen for 'keydown' event on search input
document
  .getElementById("searchInput")
  .addEventListener("keydown", function (e) {
    if (e.key === "Enter") {
      e.preventDefault(); // Prevent the default form submission behavior
      search(); // Initiate search
    }
  });
