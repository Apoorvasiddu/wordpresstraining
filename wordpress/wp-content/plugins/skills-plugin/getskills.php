<?php
/*
Plugin Name: Custom Skills Plugin
Description: A plugin to add and rate skills with suggestions from an API.
Version: 1.1
Author: Your Name
*/

// Enqueue scripts and styles
function csp_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-slider');
    wp_enqueue_style('jquery-ui-style', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css');
    wp_enqueue_script('csp-custom-skills', plugin_dir_url(__FILE__) . 'js/custom-skills.js', array('jquery', 'jquery-ui-slider'), null, true);
    wp_enqueue_style('csp-custom-skills', plugin_dir_url(__FILE__) . 'css/custom-skills.css');
    wp_localize_script(
        'csp-custom-skills',
        'csp_ajax_object',
        array(
            'home_url' => home_url(),
            'get_url' => esc_url(rest_url('custom/v1/skills')),
            'save_url' => esc_url(rest_url('custom/v1/saveskills')),
            'edit_delete_url' => esc_url(rest_url('custom/v1/editordelete')),
            'get_all_skills' => esc_url(rest_url('custom/v1/allskills')),
            'user_id' => get_current_user_id(),
        )
    );
}
add_action('wp_enqueue_scripts', 'csp_enqueue_scripts');

// Shortcode to display the skills form and skills table
function csp_skills_form_shortcode() {
    global $wpdb;
    $user_id = get_current_user_id();
    $skills_list = get_option('csp_skills_list', '');
    $skills_array = array_map('trim', explode(',', $skills_list));
    ob_start();
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="skills_div">
        <!-- <form id="csp-skills-form">
            <button type="button" class="csp-open-modal-btn">Manage Skills</button>
        </form> -->
        <div id="csp-response-message"></div>

        <div id="csp-skill-modal" class="csp-modal">
            <?php 
            include(plugin_dir_path(__FILE__) . 'alertbox.html');
            ?>
            <div class="csp-modal-content">
                <span class="csp-close-modal">&times;</span>
                <h2 id="modal-title">SKILLS</h2>
                <form id="csp-skill-form">
                    <input type="hidden" id="csp-skill-id" name="skill_id">
                    <input type="hidden" id="user_id" value="<?php echo get_current_user_id(); ?>">
                    <div class="select_drop">
                        <div class="form-group">
                            <label for="csp-skill-dropdown">Skill</label>
                            <select id="csp-skill-dropdown" name="skill_name">
                                <option value="" disabled selected>Select a skill</option>
                                <?php foreach ($skills_array as $skill) : ?>
                                    <option value="<?php echo esc_attr($skill); ?>"><?php echo esc_html($skill); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="csp-skill-rating">Rating</label>
                            <select id="csp-skill-rating" name="skill_rating">
                                <option value="" disabled selected>Select a rating</option>
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="cancel_edit" style = "display : none;">Cancel</button>
                    <button type="button" class="save_skills" id="save_button">Save</button>
                    
                </form>
                <table id="csp-skill-table">
                    <thead>
                        <tr>
                            <th>Skill Name</th>
                            <th>Rating</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Skill rows will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Loader -->
        <div id="csp-loader" class="csp-loader" style="display: none;">
            <div class="csp-loader-content">
                <div class="csp-loader-spinner"></div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('csp_skills_form', 'csp_skills_form_shortcode');

// API's
add_action('rest_api_init', function () {
    register_rest_route(
        'custom/v1',
        '/skills',
        array(
            'methods' => 'POST',
            'callback' => 'get_skills',
            'permission_callback' => '__return_true'
        )
    );
});

function get_skills(WP_REST_Request $request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'skills';
    $user_id = $request->get_param('user_id');
    if (empty($user_id)) {
        return new WP_Error('no_user_id', 'User ID is required', array('status' => 400));
    }
    $skills = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE user_id = %d", $user_id));
    return new WP_REST_Response($skills, 200);
}

// fetch all skills
// add_action('rest_api_init', function () {
//     register_rest_route(
//         'custom/v1',
//         '/allskills',
//         array(
//             'methods' => 'POST',
//             'callback' => 'get_all_skills',
//             'permission_callback' => '__return_true'
//         )
//     );
// });

// function get_all_skills(WP_REST_Request $request) {
//     global $wpdb;
//     $table_name = $wpdb->prefix . 'skills';
//     $user_id = $request->get_param('user_id');
//     if (empty($user_id)) {
//         return new WP_Error('no_user_id', 'User ID is required', array('status' => 400));
//     }
//     $all_skills = $wpdb->get_results("SELECT DISTINCT skill_name FROM $table_name");
//     $user_skills = $wpdb->get_col($wpdb->prepare("SELECT skill_name FROM $table_name WHERE user_id = %d", $user_id));
//     $filtered_skills = array_filter($all_skills, function($skill) use ($user_skills) {
//         return !in_array($skill->skill_name, $user_skills);
//     });
//     return new WP_REST_Response(array_values($filtered_skills), 200);
// }

// Save skills
add_action('rest_api_init', function () {
    register_rest_route(
        'custom/v1',
        '/saveskills',
        array(
            'methods' => 'POST',
            'callback' => 'save_skills',
            'permission_callback' => '__return_true'
        )
    );
});

function save_skills(WP_REST_Request $request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'skills';

    // Get data from the request
    $skills = $request->get_param('skills');
    $user_id = $request->get_param('user_id');

    // Validate user ID
    if (empty($user_id)) {
        return new WP_Error('no_user_id', 'User ID is required', array('status' => 400));
    }

    // Validate skills data
    if (!is_array($skills) || empty($skills)) {
        return new WP_Error('no_skills', 'Skills data is required', array('status' => 400));
    }

    $saved_skills = array();

    foreach ($skills as $skill) {
        // Validate skill data
        if (!isset($skill['skill_name']) || !isset($skill['skill_rating'])) {
            return new WP_Error('invalid_skill_data', 'Invalid skill data', array('status' => 400));
        }

        $skill_name = sanitize_text_field($skill['skill_name']);
        $skill_rating = intval($skill['skill_rating']);

        // Check for existing skill
        $existing_skill = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE user_id = %d AND skill_name = %s",
            $user_id,
            $skill_name
        ), ARRAY_A);

        if ($existing_skill) {
            // Update existing skill
            $wpdb->update(
                $table_name,
                array('ratings' => $skill_rating),
                array('Id' => $existing_skill['Id'])
            );
            $saved_skills[] = array('skill_name' => $skill_name, 'skill_rating' => $skill_rating, 'status' => 'updated');
        } else {
            // Insert new skill
            $wpdb->insert(
                $table_name,
                array(
                    'user_id' => $user_id,
                    'skill_name' => $skill_name,
                    'ratings' => $skill_rating
                )
            );
            $saved_skills[] = array('skill_name' => $skill_name, 'skill_rating' => $skill_rating, 'status' => 'added');
        }
    }

    return new WP_REST_Response($saved_skills, 200);
}

// Edit or delete skills
add_action('rest_api_init', function () {
    register_rest_route(
        'custom/v1',
        '/editordelete',
        array(
            'methods' => 'POST',
            'callback' => 'edit_or_delete_skill',
            'permission_callback' => '__return_true'
        )
    );
});

function edit_or_delete_skill(WP_REST_Request $request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'skills';

    // Get data from the request
    $skill_id = $request->get_param('skill_id');
    $user_id = $request->get_param('user_id');

    $wpdb->delete($table_name, array('Id' => $skill_id, 'user_id' => $user_id));
    return new WP_REST_Response(array('status' => 'deleted', 'skill_id' => $skill_id), 200);
}
?>
