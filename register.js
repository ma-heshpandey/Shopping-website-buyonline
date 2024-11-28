// Name: Mahesh Pandey Id: 105108938 Main function: userRegistration

function userRegistration() {
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var repassword = document.getElementById('repassword').value;
    var phone = document.getElementById('phone').value;
    var phonePattern = /^0\d{1}\s?\d{8}$/;

    // Client-side validation
    if (password !== repassword) {
        document.getElementById('msg').innerText = "Passwords do not match!";
        return false;
    }
    if (phone !== "" && !phonePattern.test(phone)) {
        document.getElementById('msg').innerText = "Invalid phone number format!";
        return false;
    }

    // Create the XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    // Open a POST request to the PHP script
    xhr.open("POST", "register.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // When the request completes
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText.includes("successful")) {
                // Hide the form
                document.getElementById('registrationForm').style.display = 'none';

                // Display the success message and customer ID
                document.getElementById('msg').innerHTML = xhr.responseText + '<br><br><a href="buyonline.htm">Go to BuyOnline</a>';
            } else {
                // Display error message if registration failed
                document.getElementById('msg').innerText = xhr.responseText;
            }
        }
    };

    // Encode and send the form data
    var data = "fname=" + encodeURIComponent(fname) +
               "&lname=" + encodeURIComponent(lname) +
               "&email=" + encodeURIComponent(email) +
               "&password=" + encodeURIComponent(password) +
               "&phone=" + encodeURIComponent(phone);

    xhr.send(data); // Send the request

    return false; // Prevent default form submission
}
