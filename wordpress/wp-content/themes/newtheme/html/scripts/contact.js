jQuery(document).ready(function($) {
    $('#contact-form').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        var name = $("#Name").val().trim();
        var phone = $("#phone").val().trim();
        var email = $("#Email").val().trim();
        var message = $("#Feedback").val().trim();

        // Validation
        if (!name || !phone || !email || !message) {
            var missingFields = [];
            if (!name) missingFields.push("Name");
            if (!phone) missingFields.push("Phone Number");
            if (!email) missingFields.push("Email ID");
            if (!message) missingFields.push("Message");

            alert("Please enter your " + missingFields.join(", "));
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
