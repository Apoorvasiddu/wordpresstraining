<?php

// Onboarding videos consent
//https://v2connectpilot.v2soft.com/video-category/offshore-on-boarding/?accept_terms=on&submit_form=Submit
if (isset($_REQUEST['accept_terms']) && isset($_REQUEST['submit_form'])) {
	if (is_user_logged_in()) {
		$user = wp_get_current_user();
		$user_id = $user->data->ID;
		update_user_meta($user_id, 'v2c_onboarding_videos_consent', TRUE);
		$link = site_url('/') . 'video-category/offshore-on-boarding/';
		echo "<script>window.location.href = '$link'</script>";
		exit;
	} else {
		$link = site_url('/') . 'video-category/offshore-on-boarding/';
		echo "<script>window.location.href = '$link'</script>";
	}
}

// Custom application redirection
if ((isset($_REQUEST['src']) && isset($_REQUEST['enc_data'])) || (isset($_COOKIE['sso_redirect_src']) && isset($_COOKIE['sso_redirect_enc_data']))) {
	$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if (is_user_logged_in()) {
		$vc = new V2_Connect_Backstage();

		// Check if cookie exists
		if (isset($_COOKIE['sso_redirect_src']) || isset($_COOKIE['sso_redirect_enc_data'])) {
			$_REQUEST['src'] = $_COOKIE['sso_redirect_src'];
			$_REQUEST['enc_data'] = $_COOKIE['sso_redirect_enc_data'];
			unset($_COOKIE['sso_redirect_src']);
			unset($_COOKIE['sso_redirect_enc_data']);
			setcookie('sso_redirect_src', "", time() - 3600, "/");
			setcookie('sso_redirect_enc_data', "", time() - 3600, "/");
		}

		// Insert into loggin session table
		global $wpdb;
		$user = wp_get_current_user();
		$user_id = $user->data->ID;
		$user_email = $user->data->user_email;
		$username = $user->data->user_login;

		$user_session = "INSERT INTO `v2connect_useronline`(`timestamp`, `user_type`, `user_id`, `user_name`, `user_ip`, `page_url`, `referral`) VALUES (now(), 'member', '$user_id', '$username', 0, '/', '/' )";
		$wpdb->query($user_session);

		// Generate URL
		switch ($_REQUEST['src']) {
			case 'timesheet':
				$quicklink['title'] = "timesheet";
				$link = $vc->get_custom_links($quicklink, TRUE) . "&enc_data={$_REQUEST['enc_data']}";
				echo "<script>window.location.href = '$link'</script>";
				exit;
				break;
			default:
				break;
		}
	} else {
		if (!(isset($_COOKIE['sso_redirect_src']) || isset($_COOKIE['sso_redirect_enc_data']))) {
			setcookie('sso_redirect_src', $_REQUEST['src'], time() + 300, "/");
			setcookie('sso_redirect_enc_data', $_REQUEST['enc_data'], time() + 300, "/");
			echo "<script>window.location.href = '" . site_url('/') . "login'</script>";
			exit;
		}
	}
}

function woffice_child_scripts()
{
	if (!is_admin() && !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))) {
		$theme_info = wp_get_theme();
		wp_enqueue_style('woffice-child-stylesheet', get_stylesheet_uri(), array(), WOFFICE_THEME_VERSION);
	}

	if (is_rtl()) {
		wp_enqueue_style('woffice-child-rtl', get_template_directory_uri() . '/rtl.css', array(), WOFFICE_THEME_VERSION);
	}

}

add_action('wp_enqueue_scripts', 'woffice_child_scripts', 30);

function my_custom_scripts()
{
	wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), '', TRUE);
}

add_action('wp_enqueue_scripts', 'my_custom_scripts');

add_action('after_setup_theme', function () {

	// Load custom translation file for the parent theme
	load_theme_textdomain('woffice', get_stylesheet_directory() . '/languages/');

	// Load translation file for the child theme
	load_child_theme_textdomain('woffice', get_stylesheet_directory() . '/languages');
});

/**
 * Change the token's expire value.
 * @param int $expire The default "exp" value in timestamp.
 * @param int $issued_at The "iat" value in timestamp.
 * @return int The "nbf" value.
 */
add_filter('jwt_auth_expire', function ($expire, $issued_at) {
	// Modify the "expire" here.
	return time() + 1200;
}, 10, 2);

/**
 * Modify the validation of token. No-empty values block token validation.
 * @param array $response An empty value ''.
 * @param WP_User $user The authenticated user.
 * @param string $token The raw token.
 * @param array $payload The token data.
 * .
 * @return array The valid token response.
 */
add_filter('jwt_auth_extra_token_check', function ($response, $user, $token, $payload) {
	$user = $user->user_login;
	if ($user !== 'api_admin_user') {
		// Modify the response here.
		$response = array(
			'success' => FALSE,
			'statusCode' => 403,
			'code' => 'jwt_auth_valid_token',
			'message' => __('Token is invalid', 'jwt-auth'),
			'data' => array(),
		);
	}
	return $response;
}, 10, 4);

/**
 * Modify the response of valid credential.
 * @param array $response The default valid credential response.
 * @param WP_User $user The authenticated user.
 * .
 * @return array The valid credential response.
 */
add_filter('jwt_auth_valid_credential_response', function ($response, $user) {
	$user = $user->user_login;
	if ($user !== 'api_admin_user') {
		// Modify the response here.
		$response = array(
			'success' => FALSE,
			'statusCode' => 403,
			'code' => 'jwt_auth_valid_credential',
			'message' => __('User is not privileged', 'jwt-auth'),
			'data' => array(),
		);
	}
	return $response;
}, 10, 2);

//add_filter( 'jwt_auth_iss', function () {
//	// Default value is get_bloginfo( 'url' );
//	return site_url('/');
//} );


// Contact form 7 - Text field validation only alphabet
add_filter('wpcf7_validate_text*', 'custom_text_validation_filter', 20, 2);

function custom_text_validation_filter($result, $tag)
{
	if ('first-name' == $tag->name) {
		$re = '/^[a-zA-Z ]*$/';
		if (!preg_match($re, $_POST['first-name'], $matches)) {
			$result->invalidate($tag, "This is not a valid name!");
		}
	}
	if ('last-name' == $tag->name) {
		$re = '/^[a-zA-Z ]*$/';
		if (!preg_match($re, $_POST['last-name'], $matches)) {
			$result->invalidate($tag, "This is not a valid name!");
		}
	}
	return $result;
}

add_action('wp_logout', 'auto_redirect_after_logout');
function auto_redirect_after_logout()
{
	wp_safe_redirect(site_url('/'));
	exit;
}

function tribe_attachment_404_fix()
{
	if (class_exists('Tribe__Events__Main')) {
		remove_action('init', array(Tribe__Events__Main::instance(), 'init'), 10);
		add_action('init', array(Tribe__Events__Main::instance(), 'init'), 1);
	}
}

add_action('after_setup_theme', 'tribe_attachment_404_fix');

// Remove p tag from the contact form
//add_filter('wpcf7_autop_or_not', false);

// Adding Analytics Scripts
add_action('wp_head', function () {
	?>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-48G2YC6DMN"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}

		gtag('js', new Date());
		gtag('config', 'G-48G2YC6DMN');
	</script>
	<?php
}, 11);

// Redirecting the BP profile page
function bp_profile_custom_redirect()
{
	// if bp profile page, redirect to home page, adjust as needed
	if (bp_is_user()) {
		wp_safe_redirect(home_url('/page-not-found'));
		exit;
	}
}

add_action('wp_loaded', 'bp_profile_custom_redirect', 1, 50);

// Redirecting the BP profile page
function v2c_first_login()
{
	if (is_user_logged_in()) {
		$user = wp_get_current_user();
		$user_id = $user->data->ID;
		if (get_user_meta($user_id, 'v2soft_first_login')[0]) {
			global $gw_activate_template;
			extract($gw_activate_template->result);
			$url = is_multisite() ? get_blogaddress_by_id((int) $blog_id) : home_url('', 'http');
			$adt_rp_key = get_password_reset_key($user);
			$user_login = $user->user_login;
			$rp_link = network_site_url("wp-login.php?action=rp&key=$adt_rp_key&login=" . rawurlencode($user_login), 'login');

			$sessions = WP_Session_Tokens::get_instance($user_id);
			$sessions->destroy_all();
			wp_safe_redirect($rp_link);
			exit;
		}
	}
}

add_action('wp_loaded', 'v2c_first_login', 1, 50);

function password_reset_consultants($errors)
{
	$user_email = $_POST['user_login'];
	if (!$user_email)
		return $errors;

	$userdata = get_user_by('email', $user_email) ?? get_user_by('login', $user_email);
	if (empty($userdata)) {
		return $errors;
	}

	if (get_user_meta($userdata->data->ID, 'v2soft_user_type')[0] !== 'Consultant') {
		$errors->add('ldap_user_error', '<strong>ERROR:</strong>Ldap users are not allowed to reset password here<strong>');
	}
}

add_action('lostpassword_post', 'password_reset_consultants');

add_action('after_password_reset', 'after_password_reset_action', 10, 2);
function after_password_reset_action($user, $new_pass)
{
	// user email. $user return full user info
	$user_id = $user->data->ID;
	delete_user_meta($user_id, 'v2soft_first_login');
}

function v2c_modified_tour()
{
	wp_dequeue_script('simple-tour-guide');
	wp_deregister_script('simple-tour-guide');
	wp_enqueue_script('v2c-custom-tour', get_stylesheet_directory_uri() . '/js/main.js', array(), '', TRUE);

	// pass plugin options
	global $post;
	$content = isset($post->post_content) ? $post->post_content : '';
	$script_params = array(
		'counter' => simple_tour_guide_get_steps_count(),
		'tour_object' => simple_tour_guide_get_escaped_tour_object_input(),
		'tour_settings' => simple_tour_guide_get_escaped_tour_settings_input(),
		'is_admin' => is_admin(),
		'is_logged_in' => is_user_logged_in(),
		'has_tour' => has_shortcode($content, 'stg_kef'),
		'strings' => array(
			'close' => __('Close', 'simple-tour-guide'),
			'back' => __('Back', 'simple-tour-guide'),
			'next' => __('Next', 'simple-tour-guide'),
			'finish' => __('Finish', 'simple-tour-guide'),
		),
	);
	wp_localize_script('v2c-custom-tour', 'scriptParams', $script_params);
}

//add_action( 'wp_enqueue_scripts', 'v2c_modified_tour' );


// Hide the few widgets for USA and IND consultant user in MyV2Connect page
add_filter('vc_after_init', 'hide_wpbakery_content_for_consultant');

function hide_wpbakery_content_for_consultant()
{
	if (!is_user_logged_in())
		return;

	$current_user = wp_get_current_user();
	$user_country = get_user_meta($current_user->ID, 'v2soft_user_country', TRUE);
	$user_type = get_user_meta($current_user->ID, 'v2soft_user_type', TRUE);

	// Check if user meta data exists and if the user type is 'Consultant'
	if (empty($user_country) || empty($user_type) || $user_type !== 'Consultant')
		return;

	// Add jQuery script to hide WPBakery columns content
	add_action('wp_footer', 'hide_wpbakery_columns_content_with_jquery');
}

function hide_wpbakery_columns_content_with_jquery()
{
	?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			// Add your specific WPBakery columns selector here
			$('.for-consultant-hide').hide();
			$('.for-consultant-hide-margin > .vc_column-inner').css('margin-top', '-21px');
		});
	</script>
	<?php
}


// Show the form link for IND users in offshore-on-boarding page
add_action('wp_head', 'hide_button_based_on_user_country');

function hide_button_based_on_user_country()
{
	// Check if the user is logged in
	if (is_user_logged_in()) {
		$user_id = get_current_user_id();

		// Get the user's country meta
		$current_user = wp_get_current_user();
		$user_country = get_user_meta($current_user->ID, 'v2soft_user_country', true);

		// Check if the user's country is set to "USA"
		if ($user_country === 'USA') {
			// Output CSS to hide the button with the specified class
			echo '<style>.wpb_row.onboarding-form-link { display: none; }</style>';
		}
	}
}


// Onboarding videos form in the popup
function get_logged_in_user_info()
{
	// Check if user is logged in
	if (is_user_logged_in()) {
		// Get current user ID
		$user_id = get_current_user_id();

		// Get user's full name from user meta
		$full_name = get_user_meta($user_id, 'first_name', TRUE);

		// Split full name into first name and last name
		$name_array = explode(' ', trim($full_name), 2);
		$first_name = $name_array[0];
		$last_name = isset($name_array[1]) ? $name_array[1] : '';

		// Get user's email
		$email = get_userdata($user_id)->user_email;

		// Create a table to display user info
		$output = '<div class="onboarding-form-fields logged-in-user-info">';

		$output .= '<form method="post" action="">'; // Form start
		$output .= '<table class="user-info-table">';

		// First Name row
		$output .= '<tr><td class="firstname"><strong>First Name:</strong></td><td>' . esc_html($first_name) . '</td></tr>';

		// Last Name row
		$output .= '<tr><td class="lastname"><strong>Last Name:</strong></td><td>' . esc_html($last_name) . '</td></tr>';

		// Email row
		$output .= '<tr><td class="email"><strong>Email:</strong></td><td>' . esc_html($email) . '</td></tr>';
		$output .= '</table>';

		// Acceptance checkbox row
		$output .= '<div class="acceptance-checkbox"><input type="checkbox" id="accept_terms" name="accept_terms" required> ';
		$output .= "<label for='accept_terms' class='acceptance-text'>I have completed reviewing all the onboarding videos thoroughly, ensuring that I've grasped the essential concepts and guidelines presented in them. The videos have provided me with a comprehensive understanding of the onboarding process and its key components. I am now equipped with the necessary knowledge and insights to proceed confidently and effectively in implementing the onboarding procedures.</label></div>";

		// Submit button row
		$output .= '<input type="submit" name="submit_form" value="Submit" class="submit-button">';
		$output .= '</form>'; // Form end
		$output .= '</div>';

		return $output;
	} else {
		return '<p>You need to be logged in to view this information.</p>';
	}
}

add_shortcode('onboarding-video-form-popup', 'get_logged_in_user_info');



function custom_skill_form_shortcode()
{
	ob_start(); // Start output buffering

	// Fetch saved skills from the database
	global $wpdb;
	$table_name = $wpdb->prefix . 'employee_skills_matrix';
	$user_id = get_current_user_id();
	$user_info = get_userdata($user_id);
	$first_name = $user_info->first_name ?? null;
	$last_name = $user_info->last_name ?? n_idull;
	$email = $user_info->user_email ?? null;


	$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE user_id = %d", $user_id));

	// Fetch the skills from the options table 
	$skills_list = get_option('skills_list', '');
	$skills_array = array_map('trim', explode(',', $skills_list)); // Convert comma-separated string into an array
	sort($skills_array);

	?>
	<form id="skill-form">
		<div class="skill-dropdown-fields">
			<div class="technology-skills-div">
				<label for="technology-skill">Your Skill:</label>
				<select name="technology-skill" id="technology-skill" required>
					<option value="">Select a skill</option>
					<?php foreach ($skills_array as $skill): ?>
						<option value="<?php echo esc_attr($skill); ?>"><?php echo esc_html($skill); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="skills-rating-div">
				<label for="skill-rating">Rate your skill (1-10):</label>
				<select name="skill-rating" id="skill-rating" required>
					<option value="">Select a rating</option>
					<?php for ($i = 1; $i <= 10; $i++): ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php endfor; ?>
				</select>
			</div>
		</div>
		<div>
			<button type="button" id="add-skill">Add Skill</button>
		</div>
	</form>

	<h5>Submitted Skills:</h5>
	<table border="1" cellspacing="0" cellpadding="10" style="width: 100%; border-collapse: collapse;"
		class="submitted-skill-table" id="skill-table">
		<thead>
			<tr>
				<th>Technology Skill</th>
				<th>Skill Rating</th>
				<th>Edit / Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($results as $row): ?>
				<tr data-id="<?php echo esc_attr($row->id); ?>">
					<td><?php echo esc_html($row->technology_skill); ?></td>
					<td><?php echo esc_html($row->skill_rating); ?></td>
					<td>
						<button type="button" class="edit-skill" data-id="<?php echo esc_attr($row->id); ?>"
							style="border: none; background: none;"><i class="fas fa-edit"></i></button>
						<button type="button" class="delete-skill" data-id="<?php echo esc_attr($row->id); ?>"
							style="border: none; background: none;"><i class="fas fa-trash"></i></button>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<form id="save-form" action="" method="post" style="display:none;">
		<input type="hidden" name="saved_skills" id="saved-skills">
		<button type="submit" id="save-skills">Submit</button>
	</form>

	<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script> <!-- Adjust path if needed -->
	<?php

	// Handle AJAX request
	if (isset($_POST['action']) && $_POST['action'] === 'save_skills') {
		$saved_skills = isset($_POST['saved_skills']) ? json_decode(stripslashes($_POST['saved_skills']), true) : [];

		if (is_array($saved_skills)) {
			// Clear existing skills for the user
			$wpdb->delete($table_name, ['user_id' => $user_id]);

			// Insert new skills
			foreach ($saved_skills as $skill) {
				$wpdb->insert($table_name, [
					'user_id' => $user_id,
					'first_name' => sanitize_text_field($first_name),
					'last_name' => sanitize_text_field($last_name),
					'email_id' => sanitize_text_field($email),
					'technology_skill' => sanitize_text_field($skill['technology_skill']),
					'skill_rating' => intval($skill['skill_rating']),
					'submitted_at' => current_time('mysql') // Insert current timestamp
				]);
			}
			wp_send_json_success('Skills saved successfully!');
		} else {
			wp_send_json_error('An error occurred while saving skills.');
		}
	}

	return ob_get_clean();
}
add_shortcode('custom_skill_form', 'custom_skill_form_shortcode');





// menu  pages for view  skills and manage skills

function skills_submissions_admin_page()
{
	add_menu_page(
		'Skill Matrix',
		'Skill Matrix',
		'manage_options',
		'skill-matrix',
		'render_skills_submissions_page',
		'dashicons-welcome-lear_idn-more',
		20
	);

	add_submenu_page(
		'skill-matrix',
		'View Skill Matrix',
		'View Skill Matrix',
		'manage_options',
		'skill-matrix',
		'render_skills_submissions_page'
	);

	add_submenu_page(
		'skill-matrix',
		'Manage Skills',
		'Manage Skills',
		'manage_options',
		'manage-skills',
		'render_manage_skills_page'
	);
}
add_action('admin_menu', 'skills_submissions_admin_page');





//enq datatable library

function enqueue_datatables_assets()
{
	wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
	wp_enqueue_style('datatables-css', 'https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css');
	wp_enqueue_script('jquery');
	wp_enqueue_script('datatables-js', 'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js', array('jquery'), null, true);
	wp_enqueue_script('datatables-bootstrap-js', 'https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js', array('datatables-js'), null, true);


}
add_action('admin_enqueue_scripts', 'enqueue_datatables_assets');

//datatable  data population from db 

function render_skills_submissions_page()
{
	?>
	<div class="wrap">
		<h1>Employees Skill Matrix</h1>

		<a href="<?php echo esc_url(admin_url('admin-post.php?action=download_skills_csv')); ?>"
			class="button button-primary">Download CSV</a>
		<br><br>
		<div class="table-container" style="position: relative;">
			<table id="user-skills-table" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Skill</th>
						<th>Rating</th>
						<th>Last Updated On</th>
					</tr>
				</thead>
				<tbody>
					<!-- Data will be loaded via AJAX -->
				</tbody>
			</table>
		</div>

		<!-- Loader styling -->


		<script>
			jQuery(document).ready(function ($) {
				var table = $('#user-skills-table').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "<?php echo admin_url('admin-ajax.php?action=load_skill_matrix_data'); ?>",
						"type": "POST",
					},
					"paging": true,
					"searching": true,
					"ordering": true,
					"info": true,
					"columns": [
						{ "data": "first_name" },
						{ "data": "last_name" },
						{ "data": "email_id" },
						{ "data": "technology_skill" },
						{ "data": "skill_rating" },
						{ "data": "submitted_at" }
					],
					"language": {
						"processing": "<div style='display: flex; justify-content: center; align-items: center; width: 80vw; height: 10vh; background-color: rgba(255, 255, 255, 0.8);'><div class='spinner-border m-5' role='status'></div>"
					}
					,
					"initComplete": function () {
						$('.table-container').removeClass('loading');
					},
					"drawCallback": function () {
						$('.table-container').removeClass('loading');
					},
					"preDrawCallback": function () {
						$('.table-container').addClass('loading');
					}
				});
			});
		</script>
		<?php
}

function load_skill_matrix_data()
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'employee_skills_matrix';

	// Params sent by Dtble
	$limit = intval($_POST['length']);
	$start = intval($_POST['start']);
	$search_value = $_POST['search']['value'];
	$order_column = $_POST['order'][0]['column'];
	$order_dir = $_POST['order'][0]['dir'];

	$columns = ['first_name', 'last_name', 'email_id', 'technology_skill', 'skill_rating', 'submitted_at'];

	$query = "SELECT * FROM $table_name";

	if (!empty($search_value)) {
		$query .= " WHERE first_name LIKE '%$search_value%' OR last_name LIKE '%$search_value%' OR email_id LIKE '%$search_value%' OR technology_skill LIKE '%$search_value%' OR skill_rating LIKE '%$search_value%' OR submitted_at LIKE '%$search_value%'";
	}

	$query .= " ORDER BY {$columns[$order_column]} $order_dir";
	$query .= " LIMIT $start, $limit";

	// Get the data
	$results = $wpdb->get_results($query);
	// Get the total records without any filtering
	$total_records = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");

	$total_filtered = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE first_name LIKE '%$search_value%' OR last_name LIKE '%$search_value%' OR email_id LIKE '%$search_value%' OR technology_skill LIKE '%$search_value%' OR skill_rating LIKE '%$search_value%' OR submitted_at LIKE '%$search_value%'");
	$data = [];
	foreach ($results as $row) {
		$data[] = [
			"first_name" => esc_html($row->first_name),
			"last_name" => esc_html($row->last_name),
			"email_id" => esc_html($row->email_id),
			"technology_skill" => esc_html($row->technology_skill),
			"skill_rating" => esc_html($row->skill_rating),
			"submitted_at" => esc_html($row->submitted_at),
		];
	}

	$response = [
		"draw" => intval($_POST['draw']),
		"recordsTotal" => intval($total_records),
		"recordsFiltered" => intval($total_filtered),
		"data" => $data,
	];

	echo json_encode($response);
	wp_die();
}
add_action('wp_ajax_load_skill_matrix_data', 'load_skill_matrix_data');


// for adding skills dynamically from wp-admin


function render_manage_skills_page()
{
	if (isset($_POST['skills_list'])) {
		$skills_list = sanitize_text_field($_POST['skills_list']);
		update_option('skills_list', $skills_list);
		echo '<div class="updated"><p>Skills updated successfully!</p></div>';
	}

	$skills_list = get_option('skills_list', '');
	?>
		<div class="wrap">
			<h1>Manage Skills</h1>
			<form method="post">
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Skills</th>
						<td>
							<textarea name="skills_list" rows="10" cols="50"
								class="large-text"><?php echo esc_textarea($skills_list); ?></textarea>
							<p class="description">Enter skills separated by commas.</p>
						</td>
					</tr>
				</table>
				<?php submit_button('Save Skills'); ?>
			</form>
		</div>
		<?php
}
// for download the report as csv file

function download_skills_csv()
{
	if (!current_user_can('manage_options')) {
		return;
	}
	global $wpdb;
	$table_name = $wpdb->prefix . 'employee_skills_matrix';
	$results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment;filename=skills_matrix.csv');

	$output = fopen('php://output', 'w');
	fputcsv($output, array('First Name', 'Last Name', 'Email', 'Skill', 'Rating', 'Last Updated On'));
	foreach ($results as $row) {
		// Check each field and use a hyphen if it's empty
		$row_data = [
			!empty($row['first_name']) ? $row['first_name'] : '-',
			!empty($row['last_name']) ? $row['last_name'] : '-',
			!empty($row['email']) ? $row['email'] : '-',
			!empty($row['technology_skill']) ? $row['technology_skill'] : '-',
			!empty($row['skill_rating']) ? $row['skill_rating'] : '-',
			!empty($row['submitted_at']) ? $row['submitted_at'] : '-',
		];
		fputcsv($output, $row_data);
	}
	fclose($output);
	exit;
}
add_action('admin_post_download_skills_csv', 'download_skills_csv');







// Updated export function to include last name and email
// function export_skills_to_csv($data)
// {
// 	if (empty($data)) {
// 		return;
// 	}

// 	// Set headers for file download
// 	$filename = 'skills_submissions_' . date('Y-m-d') . '.csv';
// 	header('Content-Type: text/csv; charset=utf-8');
// 	header('Content-Disposition: attachment; filename=' . $filename);

// 	// Open output stream to generate CSV
// 	$output = fopen('php://output', 'w');
// 	fputcsv($output, array('First Name', 'Last Name', 'Email ID', 'Technology Skill', 'Skill Rating', 'Submission Time')); // CSV headers

// 	// Loop through the data and write to CSV
// 	foreach ($data as $row) {
// 		fputcsv($output, array($row->first_name, $row->last_name, $row->email, $row->technology_skill, $row->skill_rating, $row->submitted_at));
// 	}

// 	fclose($output);
// 	exit;
// }
