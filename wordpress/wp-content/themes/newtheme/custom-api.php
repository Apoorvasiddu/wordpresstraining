<?php

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

    return new WP_REST_Response(array('message' => 'Login successful', 'user_id' => $user->ID), 200);
}