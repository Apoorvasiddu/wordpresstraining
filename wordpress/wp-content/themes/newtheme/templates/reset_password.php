<?php
/*
Template Name: Custom Password Reset
*/

if ( isset( $_GET['key'] ) && isset( $_GET['login'] ) ) {
    $key = sanitize_text_field( $_GET['key'] );
    $login = sanitize_text_field( $_GET['login'] );

    $user = check_password_reset_key( $key, $login );

    if ( is_wp_error( $user ) ) {
        wp_redirect( home_url() );
        exit;
    }

    if ( isset( $_POST['reset_password'] ) ) {
        if ( isset( $_POST['password'] ) && isset( $_POST['confirm_password'] ) ) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ( $password === $confirm_password ) {
                reset_password( $user, $password );
                echo '<p>Password has been reset. You can <a href="' . esc_url( wp_login_url() ) . '">login</a> now.</p>';
                exit;
            } else {
                echo '<p>Passwords do not match.</p>';
            }
        }
    }
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/html/css/reset-password.css">
<script src="<?php echo get_template_directory_uri(); ?>/html/scripts/page-login.js"></script>
<div class="reset-wrap">
    <div class="reset-form">
        <form method="post" action="">
        <?php 
            $email = '';
            if (isset($_GET['email'])) {
                $email = urldecode($_GET['email']);
            }
        ?>
        <div class="group">
                <label for="username" class="label">User Name</label>
                <input id="username" name="username" type="email" class="input" value="<?php echo esc_attr($email); ?>" readonly>
            </div>
            <div class="group">
                <label for="password" class="label">New Password</label>
                <input id="password" name="password" type="password" class="input" required>
            </div>
            <div class="group">
                <label for="confirm_password" class="label">Confirm Password</label>
                <input id="confirm_password" name="confirm_password" type="password" class="input" required>
            </div>
            <div class="group">
                <input type="submit" name="reset_password" class="button" value="Reset Password">
            </div>
        </form>
    </div>
</div>
