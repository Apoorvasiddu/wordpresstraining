<?php
/**
 * Template Name: Contact Page Template
 */
?>

<form id="contact-form" method="post" action="#">
    <div class="form-group">
        <label class="form-label" for="Name">Name:</label>
        <input type="text" name="name" id="Name" placeholder="Enter your name">
    </div>
    <div class="form-group">
        <label class="form-label" for="phone">Phone Number:</label>
        <input type="text" name="phone" id="phone" placeholder="Enter your phone number">
    </div>
    <div class="form-group">
        <label class="form-label" for="Email">Email Id:</label>
        <input type="email" name="email" id="Email" placeholder="Enter your email address">
    </div>
    <div class="form-group">
        <label class="form-label" for="Feedback">Message:</label>
        <textarea name="message" id="Feedback" placeholder="Enter your message"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" name="sub-btn" id="sub-btn">SUBMIT</button>
    </div>
</form>

