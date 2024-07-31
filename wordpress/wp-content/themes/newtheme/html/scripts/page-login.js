jQuery(document).ready(function($) {
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

            alert("Please enter your " + missingFields.join(", "));
            return false;
        } else if (password != re_password){
			alert("Password and Repeate password both are not matching");
            return false;
		}

        // Prepare data for AJAX request
        var data = {
            name: name,
            phone: phone,
            email: email,
            message: message
        };

        // AJAX request
        $.ajax({
            url: myScriptVars.restUrl + 'contact',
            method: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function(response) {
                alert("Success");
            },
            error: function(xhr) {
                alert("Failed: " + xhr.responseJSON.message);
            }
        });

        return false;

    });
});
