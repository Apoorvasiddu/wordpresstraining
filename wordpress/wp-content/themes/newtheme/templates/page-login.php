<?php
/*
Template Name: Custom Login
*/

if ( is_user_logged_in() ) {
    wp_redirect( home_url() );
    exit;
}

$error = '';
$success = '';

// if ( isset( $_POST['login_submit'] ) ) {
//     $username = sanitize_user( $_POST['username'] );
//     $password = $_POST['password'];
//     $remember = isset( $_POST['rememberme'] ) ? true : false;

//     if ( empty( $username ) || empty( $password ) ) {
//         $error = 'Username and password are required.';
//     } else {
//         $creds = array(
//             'user_login'    => $username,
//             'user_password' => $password,
//             'remember'      => $remember,
//         );

//         $user = wp_signon( $creds, false );

//         if ( is_wp_error( $user ) ) {
//             $error = $user->get_error_message();
//         } else {
//             wp_redirect( home_url() );
//             exit;
//         }
//     }
// }

if ( isset( $_POST['reset_password_submit'] ) ) {
    $user_login = sanitize_user( $_POST['user_login'] );

    if ( empty( $user_login ) ) {
        $error = 'Username or Email is required.';
    } else {
        $user = get_user_by( 'login', $user_login );?>
        <script>
          console.log(<?php $user ?>)
        </script><?php
        if ( ! $user ) {
            $user = get_user_by( 'email', $user_login );
        }

        if ( ! $user ) {
            $error = 'Invalid username or email.';
        } else {
            include get_template_directory() . '/templates/custom-reset-password-email.php';
            $reset_key = get_password_reset_key($user);
            $reset_link = network_site_url("forgot-password?action=rp&key=$reset_key&login=" . rawurlencode($user->user_login) . "&email=" . rawurlencode($user->user_email), 
            'login');
            
            // Include the custom email template
            $email_content = custom_reset_password_email_template($reset_link, $user->user_login);
            
            // Set the email headers to send HTML email
            $headers = array('Content-Type: text/html; charset=UTF-8');
            
            // Send the email
            wp_mail($user->user_email, 'Password Reset', $email_content, $headers);
            $success = 'Check your email for the confirmation link.';
        }
    }
}
include(get_template_directory() . '/html/custom_alert_box.html');
?>
<script type="text/javascript">
    var myScriptVars = <?php echo json_encode(array(
        'restUrl' => esc_url_raw(rest_url('custom/v1/')),
        'homeUrl' => esc_url(home_url('/'))
    )); ?>;
    console.log('myScriptVars:', myScriptVars);
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/html/css/page-login.css">
<script src="<?php echo get_template_directory_uri(); ?>/html/scripts/page-login.js"></script>
<div class="login-wrap">
  <div class="login-html">
      <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
      <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
      <input id="tab-3" type="radio" name="tab" class="forgot-password"><label for="tab-3" class="tab">Forgot Password</label>
      <div class="login-form">
          <div class="sign-in-htm">
              <form id="login_form" method="post" action="">
                  <div class="group">
                      <label for="username" class="label">Username</label>
                      <input id="username" name="username" type="text" class="input">
                  </div>
                  <div class="group">
                      <label for="password" class="label">Password</label>
                      <input id="password" name="password" type="password" class="input" data-type="password">
                  </div>
                  <div class="group">
                      <input id="rememberme" name="rememberme" type="checkbox" class="check" checked>
                      <label for="rememberme"><span class="icon"></span> Keep me Signed in</label>
                  </div>
                  <div class="group">
                      <input type="submit" name="login_submit" class="button" value="Sign In">
                  </div>
                  <div class="hr"></div>
                  <div class="foot-lnk">
                      <label for="tab-2">New User?</label>
                  </div>
                  <div class="foot-lnk">
                      <label for="tab-3">Forgot Password?</label>
                  </div>
              </form>
          </div>
          <div class="sign-up-htm">
              <form id="register_form" method="post" action="">
                  <div class="group">
                      <label for="signup-username" class="label">Username</label>
                      <input id="signup-username" name="signup_username" type="text" class="input">
                  </div>
                  <div class="group">
                      <label for="signup-password" class="label">Password &nbsp;&nbsp;<p id="strength-message">Password strength: </p></label> 
                      <input id="signup-password" name="signup_password" type="password" class="input" data-type="password">
                  </div>
                  <div class="group">
                      <label for="signup-repeat-password" class="label">Repeat Password &nbsp;&nbsp;<p id="matching-pass"></p></label>
                      <input id="signup-repeat-password" name="signup_repeat_password" type="password" class="input" data-type="password">
                  </div>
                  <div class="group">
                      <label for="signup-email" class="label">Email Address</label>
                      <input id="signup-email" name="signup_email" type="text" class="input">
                  </div>
                  <div class="group">
                      <input type="submit" class="button" value="Sign Up">
                  </div>
                  <div class="hr"></div>
                  <div class="foot-lnk">
                      <label for="tab-1">Already Member?</label>
                  </div>
              </form>
          </div>
          <div class="forgot-pass-htm">
              <form method="post" action="">
                  <div class="group">
                      <label for="user_login" class="label">Username or Email</label>
                      <input id="user_login" name="user_login" type="text" class="input">
                  </div>
                  <div class="group">
                      <input type="submit" name="reset_password_submit" class="button" value="Forgot Password">
                  </div>
                  <div class="hr"></div>
                  <?php if ( ! empty( $error ) ) : ?>
                      <div class="error-msg"><?php echo esc_html( $error ); ?></div>
                  <?php endif; ?>
                  <?php if ( ! empty( $success ) ) : ?>
                      <div class="success-msg"><?php echo esc_html( $success ); ?></div>
                  <?php endif; ?>
                  <div class="foot-lnk">
                      <label for="tab-1">Login</label>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
