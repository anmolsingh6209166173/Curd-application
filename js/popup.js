function validateForm() {
  var firstName = document.getElementById("firstName").value;
  var lastName = document.getElementById("lastName").value;
  var email = document.getElementById("email").value;
  var number = document.getElementById("number").value;
  var message = document.getElementById("message").value;
  var profilePicture = document.getElementById("profileImage").getAttribute("src");
  
  var errorFlag = false;

  // Check if fields are empty
  if (firstName.trim() === "") {
    document.querySelector(".error-names").innerText = "First name is required";
    errorFlag = true;
  } else if (!/^[a-zA-Z]+$/.test(firstName.trim())) {
    document.querySelector(".error-names").innerText = "Only alphabets are allowed in first name";
    errorFlag = true;
  } else {
    document.querySelector(".error-names").innerText = "";
  }

  if (lastName.trim() === "") {
    document.querySelector(".error-lastname").innerText = "Last name is required";
    errorFlag = true;
  } else if (!/^[a-zA-Z]+$/.test(lastName.trim())) {
    document.querySelector(".error-lastname").innerText = "Only alphabets are allowed in last name";
    errorFlag = true;
  } else {
    document.querySelector(".error-lastname").innerText = "";
  }

  if (email.trim() === "") {
    document.querySelector(".error-emails").innerText = "Email is required";
    errorFlag = true;
  } else if (!/\S+@\S+\.\S+/.test(email.trim())) {
    document.querySelector(".error-emails").innerText = "Please enter a valid email address";
    errorFlag = true;
  } else {
    document.querySelector(".error-emails").innerText = "";
  }

  if (number.trim() === "") {
    document.querySelector(".error-phones").innerText = "Mobile number is required";
    errorFlag = true;
  } else if (!/^\d{10}$/.test(number.trim())) {
    document.querySelector(".error-phones").innerText = "Please enter a valid 10-digit mobile number";
    errorFlag = true;
  } else {
    document.querySelector(".error-phones").innerText = "";
  }

  if (message.trim() === "") {
    document.querySelector(".error-messages").innerText = "About Us is required";
    errorFlag = true;
  } else {
    document.querySelector(".error-messages").innerText = "";
  }

  if (profilePicture.trim() === "" || profilePicture === "http://window.location.hostname/CRUD/img/") {
    document.querySelector(".error-image").innerText = "Profile picture is required";
    errorFlag = true;
  } else {
    document.querySelector(".error-image").innerText = "";
  }

  if (errorFlag) {
    return false; // Prevent form submission if there are errors
  } else {
    return true; // Proceed with form submission
  }
  
}
