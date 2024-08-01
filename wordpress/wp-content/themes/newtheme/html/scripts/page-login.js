jQuery(document).ready(function($) {

    // Register form submission handler
    $('#register_form').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        var username = $("#signup-username").val().trim();
        var password = $("#signup-password").val().trim();
        var re_password = $("#signup-repeat-password").val().trim();
        var email = $("#signup-email").val().trim();

        // Validation
        if (!username || !password || !email || !re_password) {
            var missingFields = [];
            if (!username) missingFields.push("User Name");
            if (!password) missingFields.push("Password");
            if (!re_password) missingFields.push("Confirm Password");
            if (!email) missingFields.push("Email ID");

            showCustomAlert("Please enter your " + missingFields.join(", "));
            return false;
        } 

        var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        if (!passwordPattern.test(password)) {
            showCustomAlert('Password must be at least 8 characters long, contain at least one special character, one uppercase letter, one lowercase letter, and one number.');
            return false;
        }

        if (password !== re_password) {
            showCustomAlert("Passwords do not match.");
            return false;
        }
        
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            showCustomAlert('Please enter a valid email address.');
            return false;
        }

        // Prepare data for AJAX request
        var data = {
            username: username,
            password: password,
            email: email,
            re_password: re_password
        };

        // AJAX request
        $.ajax({
            url: myScriptVars.restUrl + 'register',
            method: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function(response) {
                alert("Success");
                // Optionally, clear the form or redirect
            },
            error: function(xhr) {
                alert("Failed: " + (xhr.responseJSON.message || 'Unknown error'));
            }
        });

        return false;
    });

    // Login form submission handler
    $('#login_form').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        var username = $("#username").val().trim();
        var password = $("#password").val().trim();
        var remember = $('#rememberme').is(':checked');
        
        // Validation
        if (!username || !password) {
            var missingFields = [];
            if (!username) missingFields.push("User Name");
            if (!password) missingFields.push("Password");
            showCustomAlert("Please enter your " + missingFields.join(", "));
            return false;
        }

        // Prepare data for AJAX request
        var data = {
            username: username,
            password: password,
            remember: remember
        };

        // Debugging
        if (typeof myScriptVars === 'undefined') {
            console.error('myScriptVars is not defined.');
            return false;
        }

        // AJAX request
        $.ajax({
            url: myScriptVars.restUrl + 'login',
            method: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function(response) {
                // Redirect to home page
                window.location.href = myScriptVars.homeUrl;
            },
            error: function(xhr) {
                showCustomAlert("Failed: " + (xhr.responseJSON.message || 'Unknown error'));
            }
        });

        return false;
    });

});

 // Password strength checker
 document.addEventListener('DOMContentLoaded', function() {
    var passwordField = document.getElementById('signup-password');
    var strengthMessage = document.getElementById('strength-message');
    $("#strength-message").hide();
    $("#matching-pass").hide();

    passwordField.addEventListener('input', function() {
        $("#strength-message").show();
        var password = passwordField.value;
        var strength = getPasswordStrength(password);
        strengthMessage.textContent = 'Password strength: ' + strength;
    });
    $("#strength-message").hide();

    // var passwordre = document.getElementById('signup-repeat-password');
    // passwordre.addEventListener('input', function() {
    //     var repassword = passwordre.value;
    //     if(password!=repassword){
    //         document.getElementById('matching-pass').textContent = 'Password is not matching'; 
    //         $("#matching-pass").show();
    //     } else {
    //         $("#matching-pass").hide();
    //     }
    // });

    function getPasswordStrength(password) {
        var strength = 0;
        if (password.length >= 8) strength += 1;
        if (password.match(/[A-Z]/)) strength += 1;
        if (password.match(/[a-z]/)) strength += 1;
        if (password.match(/\d/)) strength += 1;
        if (password.match(/[\W_]/)) strength += 1;

        switch (strength) {
            case 5:
                $("#strength-message").css("color", "chartreuse");
                return 'Strong';
            case 4:
                $("#strength-message").css("color", "yellow");
                return 'Medium';
            case 3:
                $("#strength-message").css("color", "orange");
                return 'Weak';
            default:
                $("#strength-message").css("color", "red");
                return 'Very Weak';
        }
    }
});

function showCustomAlert(message) {
    console.log(message);
    document.getElementById('custom-alert-message').innerText = message;
    document.getElementById('custom-alert').style.display = "block";
}

function closeCustomAlert() {
    document.getElementById('custom-alert').style.display = "none";
}
