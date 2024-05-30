function validForm() {
  var name = $("#names").val();
  var lastname = $("#lastname").val();
  var email = $("#emails").val();
  var image = $("#imageupload").val();
  var phone = $("#phones").val();
  var message = $("#message").val();
  let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  $(".error-names, .error-lastname, .error-emails, .error-phones, .error-messages, .error-image").empty();

  if (name == "") {
    $("#names").focus();
    $(".error-names").text("Please fill your name");
    return false;
  } else if (name.indexOf(' ') >= 0) {
    $("#names").focus();
    $(".error-names").text("Please do not include your last name");
    return false;
  } else if (lastname == "") {
    $("#lastname").focus();
    $(".error-lastname").text("Please fill your lastname");
    return false;
  } else if (email == "") {
    $("#emails").focus();
    $(".error-emails").text("Please fill email");
    return false;
  } else if (!regex.test(email)) {
    $("#emails").focus();
    $(".error-emails").text("Please fill valid email");
    return false;
  } else if (phone == "") {
    $("#phones").focus();
    $(".error-phones").text("Please fill number");
    return false;
  } else if (phone.charAt(0) === '0') {
    $("#phones").focus();
    $(".error-phones").text("Please remove '0' from the beginning");
    return false; 
  } else if (phone.length !== 10) {
    $("#phones").focus();
    $(".error-phones").text("Please fill valid number");
    return false;
} else if (!/^\d{10}$/.test(phone)) {
  $("#phones").focus();
  $(".error-phones").text("Please fill a valid 10-digit number");
  return false;
} else if (message == '') {
    $("#message").focus();
    $(".error-messages").text("Please fill message");
    return false;
  } else if (/[^a-zA-Z0-9 ]/.test($("#message").val())) {
    $("#message").focus();
    $(".error-messages").text("Special characters are not allowed.");
    return false;
} else if (image == "") {
    $("#imageupload").focus();
    $(".error-image").text("Please select image");
    return false;
  }
  return true; // Prevent form submission
}