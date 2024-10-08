<?php
include get_template_directory() . '/templates/custom-reset-password-email.php';
$plugin_dir = WP_PLUGIN_DIR . '/jwt-authentication-for-wp-rest-api/includes/vendor/autoload.php';

// Check if the file exists and include it
if (file_exists($plugin_dir)) {
    require_once $plugin_dir;
} else {
    // Optionally handle the error if the file does not exist
    error_log('JWT Authentication autoload.php file not found: ' . $plugin_dir);
}
use Firebase\JWT\JWT;
// Contact form API call

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/contact', array(
        'methods' => 'POST',
        'callback' => 'handle_contact_form_submission',
        'permission_callback' => '__return_true'
    ));
});

function handle_contact_form_submission($request) {
    $name = sanitize_text_field($request['name']);
    $phone = sanitize_text_field($request['phone']);
    $email = sanitize_email($request['email']);
    $message = sanitize_textarea_field($request['message']);

    if (empty($name) || empty($phone) || empty($email) || empty($message)) {
        return new WP_Error('missing_fields', 'Please fill in all required fields.', array('status' => 400));
    }

    if (!is_email($email)) {
        return new WP_Error('invalid_email', 'Invalid email address.', array('status' => 400));
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'contactform';

    $wpdb->insert($table_name,array('name' => $name,'phone' => $phone,'email' => $email,'message' => $message,),
            array('%s','%s','%s','%s'));

    return new WP_REST_Response('Success', 200);
}

// login API

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/login', array(
        'methods' => 'POST',
        'callback' => 'submit_login',
        'permission_callback' => '__return_true'
    ));
});

function submit_login($request) {
    $username = sanitize_text_field($request['username']);
    $password = sanitize_text_field($request['password']);
    $remember = filter_var($request['remember'], FILTER_VALIDATE_BOOLEAN);

    if (empty($username) || empty($password)) {
        return new WP_Error('missing_fields', 'Please fill in all required fields.', array('status' => 400));
    }

    if (!is_email($username)) {
        return new WP_Error('invalid_email', 'Invalid email address.', array('status' => 400));
    }

    $creds = array(
        'user_login'    => $username,
        'user_password' => $password,
        'remember'      => $remember,
    );

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        return new WP_Error('login_failed', $user->get_error_message(), array('status' => 403));
    }

    $user_id = $user->ID;
    $has_skills = user_has_skills($user_id);

    $redirect_url = $has_skills ? home_url() : home_url('/skills');

    return new WP_REST_Response(array(
        'message' => 'Login successful',
        'user_id' => $user_id,
        'redirect_url' => $redirect_url
    ), 200);
}

// Forgot password API

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/forgotpass', array(
        'methods' => 'POST',
        'callback' => 'forgot_password',
        'permission_callback' => '__return_true'
    ));
});

function forgot_password($request) {
    $username = sanitize_text_field($request['username']);

    if (empty($username)) {
        return new WP_Error('missing_fields', 'Please fill in all required fields.', array('status' => 400));
    }

    if (!is_email($username)) {
        return new WP_Error('invalid_email', 'Invalid email address.', array('status' => 400));
    }

    $user = get_user_by('email', $username);

    if (!$user) {
        return new WP_Error('invalid_user', 'Invalid email address.', array('status' => 400));
    }

    // Generate a password reset key
    $reset_key = get_password_reset_key($user);
    if (is_wp_error($reset_key)) {
        return new WP_Error('reset_key_error', $reset_key->get_error_message(), array('status' => 500));
    }

    $reset_link = network_site_url("forgot-password?action=rp&key=$reset_key&login=" . rawurlencode($user->user_login) . "&email=" . rawurlencode($user->user_email), 'login');
    $email_content = custom_reset_password_email_template($reset_link, $user->user_login);
    $headers = array('Content-Type: text/html; charset=UTF-8');

    // Send the email
    if (wp_mail($user->user_email, 'Password Reset', $email_content, $headers)) {
        return new WP_REST_Response(array('message' => 'Check your email for the confirmation link.'), 200);
    } else {
        return new WP_Error('email_failed', 'Failed to send the email.', array('status' => 500));
    }
}

// Register API
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/register', array(
        'methods' => 'POST',
        'callback' => 'user_register',
        'permission_callback' => '__return_true'
    ));
});

function user_register($request) {
    $username = sanitize_text_field($request['username']);
    $password = sanitize_text_field($request['password']);
    $email = sanitize_email($request['email']);
    // $first_name = sanitize_text_field($request['first_name']);
    // $last_name = sanitize_text_field($request['last_name']);  

    if (empty($username) || empty($password) || empty($email)) {
        return new WP_Error('missing_fields', 'Please fill in all required fields.', array('status' => 400));
    }

    if (!is_email($email)) {
        return new WP_Error('invalid_email', 'Invalid email address.', array('status' => 400));
    }

    // Check if username already exists
    if (username_exists($username)) {
        return new WP_Error('username_exists', 'Username already exists.', array('status' => 400));
    }

    // Check if email already exists
    if (email_exists($email)) {
        return new WP_Error('email_exists', 'Email already exists.', array('status' => 400));
    }

    // Create the user
    $user_id = wp_create_user($username, $password, $email);

    // Check for errors
    if (is_wp_error($user_id)) {
        return $user_id; // Return the error
    }

    // Set the user's role to "Subscriber"
    $user = new WP_User($user_id);
    $user->set_role('subscriber');

    // Set the first and last name if provided
    // if (!empty($first_name)) {
    //     update_user_meta($user_id, 'first_name', $first_name);
    // }
    // if (!empty($last_name)) {
    //     update_user_meta($user_id, 'last_name', $last_name);
    // }

    // // Set the display name
    // if (!empty($first_name) && !empty($last_name)) {
    //     wp_update_user(array(
    //         'ID' => $user_id,
    //         'display_name' => $first_name . ' ' . $last_name
    //     ));
    // }

    // Return a success response
    return new WP_REST_Response(array('message' => 'Registration successful', 'user_id' => $user_id), 200);
}

// Register REST API route for password reset
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/resetpassword', array(
        'methods' => 'POST',
        'callback' => 'reset_forgot_password',
        'permission_callback' => '__return_true'
    ));
});

function reset_forgot_password(WP_REST_Request $request) {
    // Get key, login, password, and confirm_password from request
    $key = sanitize_text_field($request->get_param('key'));
    $login = sanitize_text_field($request->get_param('login'));
    $password = sanitize_text_field($request->get_param('password'));
    $confirm_password = sanitize_text_field($request->get_param('confirm_password'));

    // Check if the key and login are valid
    $user = check_password_reset_key($key, $login);
    if (is_wp_error($user)) {
        return new WP_Error('invalid_key', 'Invalid password reset key or login.', array('status' => 400));
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        return new WP_Error('password_mismatch', 'Passwords do not match.', array('status' => 400));
    }

    // Reset the password
    reset_password($user, $password);

    // Return success response
    return new WP_REST_Response(array('message' => 'Password has been reset. You can now log in.'), 200);
}

// Get Skills

// DBC task

add_action('rest_api_init', function () {
    register_rest_route('jwt-auth/v1', '/trigger-notifications', array(
        'methods' => 'POST',
        'callback' => 'handle_trigger_notifications',
        'permission_callback' => 'check_jwt_authentication',
    ));
});

// define('AUTH_KEY', 'rR$4V> &DLO4uAb>|)UxsQXxq@@Y}lZbL*:}!{[:SaurkT4NvKes<~`Tr@-I6vg~');
function check_jwt_authentication(WP_REST_Request $request) {
    // Ensure the JWT Auth plugin is available
    if (!class_exists('Jwt_Auth_Public')) {
        return new WP_Error('jwt_auth_plugin_not_active', 'JWT Auth plugin is not active', array('status' => 403));
    }

    // Validate the JWT token
    $auth_header = $request->get_header('authorization');
    if (!$auth_header) {
        return new WP_Error('authorization_header_missing', 'Authorization header is missing', array('status' => 403));
    }

    list($token_type, $token) = explode(' ', $auth_header);
    if (strtolower($token_type) !== 'bearer' || !$token) {
        return new WP_Error('authorization_header_invalid', 'Authorization header is invalid', array('status' => 403));
    }

    try {
        return true;
    } catch (Exception $e) {
        return new WP_Error('invalid_token', $e->getMessage(), array('status' => 403));
    }
}
function handle_trigger_notifications(WP_REST_Request $request) {
    // Verify the JWT token
    $errors = array();
    $senderExternalUserId = sanitize_text_field($request->get_param('senderExternalUserId'));
    $deepLinkPageUrl = esc_url_raw($request->get_param('deepLinkPageUrl'));
    $notificationMessage = sanitize_textarea_field($request->get_param('notificationMessage'));

    if (empty($senderExternalUserId)) {
        $errors[] = 'Sender External User ID is required!';
    }
    if (empty($deepLinkPageUrl) || !filter_var($deepLinkPageUrl, FILTER_VALIDATE_URL)) {
        $errors[] = 'A valid Deep Link Page URL is required!';
    }
    if (empty($notificationMessage)) {
        $errors[] = 'Notification Message is required!';
    }

    if (!empty($errors)) {
        return new WP_Error('validation_error', implode(', ', $errors), array('status' => 400));
    }

    // Store the notification data
    global $wpdb;
    $table_name = $wpdb->prefix . 'trigger_notification';

    $result = $wpdb->insert(
        $table_name,
        array(
            'sender_external_user_id' => $senderExternalUserId,
            'deep_link_page_url' => $deepLinkPageUrl,
            'notification_message' => $notificationMessage,
        ),
        array(
            '%s',
            '%s',
            '%s'
        )
    );

    if ($result === false) {
        return new WP_Error('db_insert_error', 'Failed to insert notification into the database!', array('status' => 500));
    }

    return new WP_REST_Response('Notification triggered and stored successfully!', 200);
}



