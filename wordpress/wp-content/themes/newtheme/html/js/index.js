$(document).ready(function(){
	$(".mobileLinkToggle").click(function(){
		$(".headerMenu").toggle();
	})
})

/*contct form*/

$(document).on("click", ".sub-btn", function (e) {
	var name1 = $(".Name").val();
	var phone1=$(".phone").val();
	var email1 = $(".Email").val();
	var txt = $(".Feedback").val();
	alert("hi");
	/*if (($(".Name").val() == "") && ($(".Email").val() == "") && ($(".Feedback").val() == "") && ($(".phone").val() == "")) {
		$(".alert-msg").html('Please enter your Name, Email ID, Message and accept Terms and Conditions');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		return false;
	}
	if (($(".Email").val() == "") && ($(".Feedback").val() == "") && ($(".phone").val() == "")) {
		$(".alert-msg").html('Please enter your Email ID, Message and accept Terms and Conditions');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		return false;
	}
	if (($(".Email").val().indexOf("@") == -1 || $(".Email").val().indexOf(".") == -1) && ($(".Feedback").val() == "") && ($(".phone").val() == "")) {
		$(".alert-msg").html('Please enter your valid Email ID, Message and accept Terms and Conditions');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		return false;
	}
	if (($(".fname").val() == "") && ($(".Email").val() == "") && ($(".Feedback").val() == "")) {
		$(".alert-msg").html('Please enter your Name, Email ID and Message');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		return false;
	}
	if (($(".Email").val() == "") && ($(".Feedback").val() == "")) {
		$(".alert-msg").html('Please enter your  Email ID and Message');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		return false;
	}
	if (($(".fname").val() == "") && ($(".Feedback").val() == "")) {
		$(".alert-msg").html('Please enter your Name and Message');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		return false;
	}

	if (($(".fname").val() == "") && ($(".Email").val() == "")) {
		$(".alert-msg").html('Please enter your Name and Email ID ');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		return false;
	}
	if (($(".Email").val() == "") && ($(".phone").val() == "")) {
		$(".alert-msg").html('Please enter your Email ID and accept Terms and Conditions');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		return false;
	}
	if (($(".fname").val() == "") && ($(".phone").val() == "")) {
		$(".alert-msg").html('Please enter your Name  and accept Terms and Conditions');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		return false;
	}
	if (($(".Feedback").val() == "") && ($(".phone").val() == "")) {
		$(".alert-msg").html('Please enter your Message  and accept Terms and Conditions');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		return false;
	}

	if (($(".Email").val().indexOf("@") == -1 || $(".Email").val().indexOf(".") == -1) && ($(".Feedback").val() == "")) {
		$(".alert-msg").html('Please enter your valid Email ID and Message');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		return false;
	}
	if ($(".fname").val() == "") {
		$(".fname").focus();
		$(".alert-msg").html('Please enter your Name');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		return false;
	}

	if ($(".Email").val() == "") {
		$(".alert-msg").html('Please enter your Email ID');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		$(".Email").focus();
		return false;
	}

	if ($(".Email").val().indexOf("@") == -1 || $(".Email").val().indexOf(".") == -1) {
		$(".Email").focus();
		$(".alert-msg").html('Please enter your valid Email ID');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		return false;

	}

	if ($(".Feedback").val() == "") {
		$(".alert-msg").html('Please enter your Message');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		$(".Email").focus();
		return false;
	}

	if ($(".phone").val() == "") {
		$(".alert-msg").html('Please accept Terms and Conditions');
		$(".alert-popup").delay(5000).addClass("active");
		$(".popup_overlay").show();
		$(".phone").focus();
		return false;
	} /*else {
		/* Email the administrator 

		var data = {
			'action': 'email_administrator',
			'user_name': name1,
			'user_email': email1,
			'user_message': txt
		};

		var ajaxUrl = '/wp-admin/admin-ajax.php';

		jQuery.post(ajaxUrl, data)
			.success(function (response) {
				if (response == 1) {
					$(".alert-msg").html('Thank you for contacting us, we will get back to you shortly.');
					$(".alert-popup").delay(5000).addClass("active");
					$(".popup_overlay").show();
					$("#contact-form").trigger('reset');
				} else {
					$(".alert-msg").html('Something went wrong, please try after sometime!');
					$(".alert-popup").delay(5000).addClass("active");
					$(".popup_overlay").show();
					$("#contact-form").trigger('reset');
				}
			})
			.fail(function (response) {
				$(".alert-msg").html('Something went wrong, please try after sometime! ');
				$(".alert-popup").delay(5000).addClass("active");
				$(".popup_overlay").show();
				$("#contact-form").trigger('reset');
			})
		return false;
	}*/


});

