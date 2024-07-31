<?php
// add_action('rest_api_init', function(){
// 	register_rest_route('customapi/v1','display/customer/',[
// 		'methods' => 'GET',
// 		'callback' => 'custom_display_customer',
// 		// 'permission_callback' => '_return_true'
// 	]);
// });

// function custom_display_customer(){
// 	echo json_encode(['message'=>'Create custome api!!!']);
// 	exit;
// }

function my_theme_setup() {
    // Register navigation menus
    register_nav_menus(array(
        'header' => __('Header Menu', 'your-theme-textdomain'),
    ));
}
add_action('after_setup_theme', 'my_theme_setup');

// Function to enqueue styles
function custom_theme_assets() {
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'custom_theme_assets');

// Register custom REST API endpoint
add_action('rest_api_init', function() {
    register_rest_route('customapi/v1', 'display/customer/', [
        'methods' => 'GET',
        'callback' => 'custom_display_customer',
        // 'permission_callback' => '_return_true' // Uncomment if you want to set permission callback
    ]);
});

function custom_display_customer() {
    return new WP_REST_Response(['message' => 'Create custom API!!!'], 200);
}

// Change the login logo image
function hd_login_footer_message() {
	
	// output our message in the login footer area.
	?>
	<p style="border-top: 1px solid #0085ba; margin: 0 auto; width: 320px; padding-top: 10px;">Use your @highrise.digital email address to login here.</p>
	<?php

}

add_action( 'login_footer', 'hd_login_footer_message' );

function hd_title_here( $title,$post ) {

	// set a new string for the placeholder text.
	if ( $post->post_type == 'tutorials' ) {
		$title = __( 'Enter tutorial name here.', 'text-domain' );
	}

	// return the title back to the hook.
	return $title;

}
add_action( 'enter_title_here', 'hd_title_here', 10, 2 );


$login_header_text = "Edited by Appu";
apply_filters( 'login_headertext', $login_header_text );


function modify_lost_password_link() {
    // Generate the new HTML link
    $html_link = sprintf(
        '<a class="wp-login-lost-password" href="%s">%s</a>',
        esc_url( wp_lostpassword_url() ),
        __( 'Lost your code?', 'text-domain' )
    );

    // Output the link
    echo $html_link;
}
add_action( 'lost_password_html_link', 'modify_lost_password_link' );


// Tutorials point
function create_tutorials_post_type() {
    register_post_type('tutorials',
        array(
            'labels'      => array(
                'name'          => __('Tutorial Details'),
                'singular_name' => __('Tutorial Detail'),
            ),
            'public'      => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-welcome-learn-more',
            'supports'    => array('title', 'editor', 'custom-fields'),
        )
    );
}
add_action('init', 'create_tutorials_post_type');

function add_tutorial_meta_box() {
    add_meta_box(
        'tutorial_meta_box', // ID
        'tutorial URL', // Title
        'display_tutorial_meta_box', // Callback function
        'tutorials', // Post type
        'normal', // Context
        'high' // Priority
    );
}
add_action('add_meta_boxes', 'add_tutorial_meta_box');

function display_tutorial_meta_box($post) {
    $tutorial_url = get_post_meta($post->ID, '_tutorial_url', true);
    ?>
    <label for="tutorial_url">URL</label>
    <input type="text" name="tutorial_url" id="tutorial_url" value="<?php echo esc_attr($tutorial_url); ?>" size="30" />
    <?php
}

function save_tutorial_meta_box($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['tutorial_url'])) {
        update_post_meta($post_id, '_tutorial_url', sanitize_text_field($_POST['tutorial_url']));
    }
}
add_action('save_post', 'save_tutorial_meta_box');

// Edit Heading
function custom_admin_script() {
    global $pagenow, $typenow;

    if ( $pagenow == 'post-new.php' && $typenow == 'tutorials' ) { // Change 'tutorials' to your custom post type if needed
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var heading = document.querySelector('.wrap h1');
                if (heading) {
                    heading.textContent = 'Add New Tutorial'; // Change the text here
                }
            });
        </script>
        <?php
    }
}
add_action('admin_head', 'custom_admin_script');

function custom_title_script() {
    global $pagenow, $typenow;
	if($typenow == 'tutorials') {
		?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                // Change the "Add New" button text in the post listing screen
                var addNewLink = document.querySelector('a.page-title-action');
                if (addNewLink) {
                    addNewLink.textContent = 'Add New Tutorial'; // Change the text here
                }

                // Change the "Add New Post" heading in the add new post screen
                if (<?php echo json_encode($pagenow); ?> === 'post-new.php') {
                    var heading = document.querySelector('.wrap h1');
                    if (heading) {
                        heading.textContent = 'Add New Tutorial'; // Change the text here
                    }
                }
            });
        </script>
        <?php
	}
}
add_action('add_new', 'custom_title_script');

function my_contact_form_shortcode() {
    ob_start();
    // Include the template file
    get_template_part('templates/contact-template');
    return ob_get_clean();
}

add_shortcode('my_contact_form', 'my_contact_form_shortcode');

// Enqueue your JavaScript file
function enqueue_custom_scripts() {
    // Enqueue the custom script
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/html/scripts/contact.js', array('jquery'), null, true);

    // Pass PHP variables to the script
    wp_localize_script('custom-script', 'myScriptVars', array(
        'restUrl' => esc_url_raw(rest_url('myplugin/v1/'))
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Contact form API call

add_action('rest_api_init', function () {
    register_rest_route('myplugin/v1', '/contact', array(
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

// Custom Login 

add_action('init', 'custom_login_redirect');
function custom_login_redirect() {
    global $pagenow;
    if ('wp-login.php' == $pagenow && !is_user_logged_in()) {
        wp_redirect(home_url('/custom-login/'));
        exit();
    }
}

function custom_password_reset_email( $message, $key, $user_login, $user_data ) {
    $reset_link = network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' );
    $message = "Hi there,\n\n";
    $message .= "You recently requested to reset your password for your account. Click the link below to reset it:\n\n";
    $message .= $reset_link . "\n\n";
    $message .= "If you did not request a password reset, please ignore this email.\n\n";
    $message .= "Thanks.";

    return $message;
}
add_filter( 'retrieve_password_message', 'custom_password_reset_email', 10, 4 );

add_action('phpmailer_init', 'custom_smtp_settings');
function custom_smtp_settings($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = SMTP_HOST;
    $phpmailer->SMTPAuth   = SMTP_AUTH;
    $phpmailer->Port       = SMTP_PORT;
    $phpmailer->Username   = SMTP_USER;
    $phpmailer->Password   = SMTP_PASSWORD;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->From       = SMTP_FROM;
    $phpmailer->FromName   = SMTP_FROMNAME;
}

?>
