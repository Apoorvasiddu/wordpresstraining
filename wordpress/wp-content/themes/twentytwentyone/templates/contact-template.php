<?php
/**
 * Template Name: Contact Page Template
 */?>
<html>
    <head>Contact Form
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
        <script type="text/javascript" src="../wp-content/themes/training/html/scripts/contact.js"></script>
    </head>
    <body>
        <form id="contact-form">
            <div class="form-group">
                <label class="custom_form_label  form-left">Name:</label><br>
                <input type="text" name="Name" value="" id="Name" placeholder="Name"><br>
            </div>
            <div class="form-group">
                <label class="custom_form_label  form-left">Phone Number:</label><br>
                <input type="text" name="phone" value="" id="phone" placeholder="Phone Number"><br>
            </div>
            <div class="form-group">
                <label class="custom_form_label  form-left">Email Id:</label><br>
                <input type="text" name="Email" value="" id="Email" placeholder="Email Id"><br>
            </div>
            <div class="form-group">
                <label class="custom_form_label  form-left">Message:</label><br>
                <input type="text" name="Feedback" value="" id="Feedback" placeholder="Enter your message"><br>
            </div>
            <div class="form-group">
                <button type="submit" name="sub-btn" id="sub-btn" >SUBMIT</button>
        </form>
        <!--<script type="text/javascript">
            function contactfun(){
                onclick="contactfun()"
                $name1 = $(".Name").val();
	            var phone1=$(".phone").val();
	            var email1 = $(".Email").val();
	            var txt = $(".Feedback").val();
                alert($name1);
            }
        </script>-->
    </body>
</html>
