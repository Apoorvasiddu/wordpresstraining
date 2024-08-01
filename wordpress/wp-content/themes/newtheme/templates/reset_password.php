<?php
/*
Template Name: Custom Password Reset
*/
include(get_template_directory() . '/html/custom_alert_box.html');
?>
<script type="text/javascript">
    var myScriptVars = <?php echo json_encode(array(
        'restUrl' => esc_url_raw(rest_url('custom/v1/')),
        'homeUrl' => esc_url(home_url('/')),
        'loginUrl' => esc_url(home_url('/custom-login'))
    )); ?>;
    console.log('myScriptVars:', myScriptVars);
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/html/css/reset-password.css">
<script src="<?php echo get_template_directory_uri(); ?>/html/scripts/page-login.js"></script>
<div class="reset-wrap">
    <div class="reset-form">
        <form id="reset_password" method="post" action="">
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
                <input id="password" name="password" type="password" class="input">
            </div>
            <div class="group">
                <label for="confirm_password" class="label">Confirm Password</label>
                <input id="confirm_password" name="confirm_password" type="password" class="input">
            </div>
            <div class="group">
                <input type="submit" name="reset_password" class="button" value="Reset Password">
            </div>
        </form>
    </div>
</div>
