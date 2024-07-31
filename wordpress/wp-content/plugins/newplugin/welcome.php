<?php
/*
Plugin Name: Welcome page
Description: Welcome page demonstration
Version: 1.0
Author: Apoorva
*/

// Shortcode handler to display the welcome message
function welcome_message() {
    ob_start();
    ?>
    <div class="welcome-container">
        <marquee><h2>Welcome to Our Learning Application</h2></marquee>
        <p>Your journey to mastering new skills starts here. Explore our courses and enhance your knowledge today.</p>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('welcome_message', 'welcome_message');
?>
