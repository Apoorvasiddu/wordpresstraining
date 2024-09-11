<?php
require get_template_directory() . '/custom-api.php';
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

function redirect_non_admin_users() {
    if (is_admin() && !current_user_can('administrator') && !(defined('DOING_AJAX') && DOING_AJAX)) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('admin_init', 'redirect_non_admin_users');


// skills

function custom_enqueue_scripts() {
    wp_enqueue_script('custom-autocomplete', get_template_directory_uri() . '/html/js/access_skill.js', array('jquery'), null, true);
    wp_localize_script('custom-autocomplete', 'custom_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');

function fetch_skills_callback() {
    $query = sanitize_text_field($_POST['query']);
    
    // Make the API request
    $api_url = 'http://localhost/wordpresstraining/wordpress/wp-json/custom/v1/skills?query=' . urlencode($query);

    $response = wp_remote_get($api_url);
    
    if (is_wp_error($response)) {
        echo json_encode([]);
    } else {
        $skills = wp_remote_retrieve_body($response);
        echo $skills;
    }
    
    wp_die(); // Important to stop execution
}
add_action('wp_ajax_fetch_skills', 'fetch_skills_callback');
add_action('wp_ajax_nopriv_fetch_skills', 'fetch_skills_callback');


// Function to check if the user has skills
function user_has_skills($user_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'skills';
    $skills = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE user_id = %d", $user_id));

    return !empty($skills);
}



// file export


function export_employee_skills_to_csv() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    global $wpdb;

    // Set the headers to force download of the CSV file
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=employee_skills.csv');

    // Create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // Output the column headings
    fputcsv($output, array('Employee ID', 'Employee Name', 'Employee Email', 'Skills'));

    $users = get_users(array('fields' => array('ID', 'display_name', 'user_email')));

    foreach ($users as $user) {
        $user_id = $user->ID;
        $skills = $wpdb->get_results($wpdb->prepare(
            "SELECT skill_name, ratings FROM {$wpdb->prefix}skills WHERE user_id = %d",
            $user_id
        ));
        $formatted_skills = array();
        foreach ($skills as $skill) {
            $formatted_skills[] = "{" . $skill->skill_name . ": " . $skill->ratings . "}";
        }
        $formatted_skills_string = implode(', ', $formatted_skills);
        if(empty($formatted_skills_string)){
            $formatted_skills_string = 'No skills added yet!';
        }

        fputcsv($output, array($user_id, $user->display_name, $user->user_email, $formatted_skills_string));
    }

    fclose($output);
    exit;
}

function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

function handle_csv_export() {
    export_employee_skills_to_csv();
}
add_action('admin_post_download_employee_skills_csv', 'handle_csv_export');



// Register the settings and settings field

function csp_register_settings() {
    // Register the setting with a unique option group
    register_setting('csp_settings', 'csp_skills_list');

    // Add the settings section
    add_settings_section(
        'csp_settings_section',
        'Skills Settings',
        'csp_settings_section_callback',
        'csp-settings'
    );

    // Add the settings field
    add_settings_field(
        'csp_skills_list',
        'Skills List',
        'csp_skills_list_callback',
        'csp-settings',
        'csp_settings_section'
    );
}
add_action('admin_init', 'csp_register_settings');

// Callback for the settings section
function csp_settings_section_callback() {
    echo '<p>Enter the comma-separated list of skills below:</p>';
}

// Callback for the skills list field
function csp_skills_list_callback() {
    $skills = get_option('csp_skills_list', '');
    echo '<textarea id="csp_skills_list" name="csp_skills_list" rows="5" class="large-text">' . esc_textarea($skills) . '</textarea>';
}

// Add a settings page link under Settings menu
// function csp_add_settings_link() {
//     add_options_page(
//         'Skills Settings',
//         'Skills',
//         'manage_options',
//         'csp-settings',
//         'csp_settings_page'
//     );
// }
// add_action('admin_menu', 'csp_add_settings_link');

// Display the settings page
function csp_settings_page() {
    ?>
    <div class="wrap">
        <h1>Skills Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('csp_settings');
            do_settings_sections('csp-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// custom menu
function skill_data_menu_page() {
    // Add the main menu page
    add_menu_page(
        'Skill Data',                    
        'Skill Data',                    
        'manage_options',                
        'skill-data-main-slug',          
        'skill_data_menu_page_html',     
        'dashicons-welcome-learn-more',  
        6                                
    );

    
    add_submenu_page(
        'skill-data-main-slug',        
        'View Skills Data',            
        'View Skills Data',            
        'manage_options',              
        'skill-data-main-slug',              
        'skill_data_menu_page_html' 
    );

    
    add_submenu_page(
        'skill-data-main-slug',        
        'Manage Skills Data',          
        'Manage Skills Data',          
        'manage_options',              
        'submenu-slug-2',              
        'csp_settings_page'            
    );
}
add_action( 'admin_menu', 'skill_data_menu_page' );

function enqueue_datatables_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'datatables-js', 'https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js', array( 'jquery' ), null, true );
    wp_enqueue_style( 'datatables-css', 'https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css' );
    wp_enqueue_style('skills-data', get_template_directory_uri() .'/html/css/style.css');
}
add_action( 'admin_enqueue_scripts', 'enqueue_datatables_scripts' );
function skill_data_menu_page_html() {
    global $wpdb;

    if ( !current_user_can( 'manage_options' ) ) {
        return;
    }

    ?>
    <div class="wrap">
        <h1><?php echo esc_html( 'View Skills Data' ); ?></h1>

        <!-- Download CSV Button -->
        <button class="button-primary" style="margin-bottom: 10px;">
            <a href="<?php echo esc_url(admin_url('admin-post.php?action=download_employee_skills_csv')); ?>" class="download-link" title="Download Employee Skills" style="color: white; text-decoration: none;">Download CSV</a>
        </button>

        <table id="skills-table" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Skill Name</th>
                    <th>Ratings</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded via AJAX -->
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#skills-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo esc_url(admin_url('admin-ajax.php')); ?>",
                    "type": "POST",
                    "data": {
                        "action": "fetch_skills_data"
                    }
                },
                "columns": [
                    { "data": "display_name" },
                    { "data": "user_email" },
                    { "data": "skill_name" },
                    { "data": "ratings" }
                ],
                "pageLength": 10
            });
        });
    </script>
    <?php
}

add_action('wp_ajax_fetch_skills_data', 'fetch_skills_data');
add_action('wp_ajax_nopriv_fetch_skills_data', 'fetch_skills_data'); // If you want to allow non-logged in users

function fetch_skills_data() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'skills';
    $user_table = $wpdb->prefix . 'users';

    // Get the total number of records
    $total_records = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");

    // Prepare query for filtering, sorting, and pagination
    $search_value = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';
    $order_column = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0; // Default to first column
    $order_dir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc'; // Default to ascending
    $length = isset($_POST['length']) ? intval($_POST['length']) : 10; // Number of records to display
    $start = isset($_POST['start']) ? intval($_POST['start']) : 0; // Start position for pagination

    // Map DataTable column index to database columns
    $columns = ['display_name', 'user_email', 'skill_name', 'ratings'];
    $order_column = $columns[$order_column]; // Get the correct column name

    // Construct the query with filtering and sorting
    $query = "
        SELECT s.skill_name, s.ratings, u.display_name, u.user_email
        FROM $table_name s
        JOIN $user_table u ON s.user_id = u.ID
        WHERE u.display_name LIKE %s
        OR u.user_email LIKE %s
        OR s.skill_name LIKE %s
    ";

    $search_query = $wpdb->prepare($query, '%' . $wpdb->esc_like($search_value) . '%', '%' . $wpdb->esc_like($search_value) . '%', '%' . $wpdb->esc_like($search_value) . '%');

    $total_filtered_records = $wpdb->get_var("SELECT COUNT(*) FROM ($search_query) AS subquery");

    // Append order and limit for pagination
    $search_query .= " ORDER BY $order_column $order_dir LIMIT %d OFFSET %d";
    $query_with_limit = $wpdb->prepare($search_query, $length, $start);
    
    // Execute the query
    $data = $wpdb->get_results($query_with_limit, ARRAY_A);

    // Prepare response
    $response = [
        'draw' => intval($_POST['draw']),
        'recordsTotal' => intval($total_records),
        'recordsFiltered' => intval($total_filtered_records),
        'data' => $data
    ];

    echo json_encode($response);
    wp_die(); // Required to terminate and return a proper response
}


// code from other

?>