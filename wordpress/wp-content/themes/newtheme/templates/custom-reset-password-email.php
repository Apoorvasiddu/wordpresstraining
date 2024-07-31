<?php
function custom_reset_password_email_template($reset_link, $user_login) {
    ob_start();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            /* Add your custom styles here */
            body { font-family: Arial, sans-serif; color: #333; }
            .container { padding: 20px; background-color: #f9f9f9; border: 1px solid #e0e0e0; border-radius: 5px; }
            .button { display: inline-block; padding: 10px 20px; background-color: #0073aa; color: #fff; text-decoration: none; border-radius: 5px; }
            .button:hover { background-color: #005177; }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Password Reset Request</h2>
            <p>Hi <?php echo esc_html($user_login); ?>,</p>
            <p>You recently requested to reset your password for your account. Click the link below to reset it:</p>
            <p><a href="<?php echo esc_url($reset_link); ?>" class="button">Reset Password</a></p>
            <p>If you did not request a password reset, please ignore this email.</p>
            <p>Thanks,</p>
            <p>Your Company Name</p>
        </div>
    </body>
    </html>
    <?php
    return ob_get_clean();
}
