<?php
/*
Plugin Name: My Custom About Plugin
Description: About page
Version: 1.0
Author: Apoorva
*/

// Shortcode handler to display the form
function my_about_form() {
    ob_start();
    ?>
     <main class="about_main">
        <section class="about">
            <h2>Welcome to Learning Application</h2>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;Our Learning Application is designed to provide an innovative and user-friendly platform for individuals seeking to enhance their skills and knowledge. Whether you're a student, professional, or hobbyist, our app offers a variety of resources and tools to help you achieve your learning goals.</p>

            <h3>Features:</h3>
            <ul>
                <li><strong>Interactive Courses:</strong> Engage with comprehensive and interactive courses on various topics.</li>
                <li><strong>Progress Tracking:</strong> Monitor your progress and achievements with our intuitive tracking system.</li>
                <li><strong>Expert Instructors:</strong> Learn from industry experts and experienced educators.</li>
                <li><strong>Flexible Learning:</strong> Access content anytime, anywhere, and at your own pace.</li>
            </ul>

            <h3>Our Mission</h3>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;Our mission is to make learning accessible and enjoyable for everyone. We believe that education should be engaging, flexible, and tailored to individual needs. By providing high-quality resources and a supportive learning environment, we aim to empower our users to reach their full potential.</p>

            <h3>Get in Touch</h3>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;If you have any questions or feedback, feel free to <a href="<?php echo home_url('/contact-us/'); ?>">contact us</a>. We would love to hear from you and assist you in any way we can.</p>
        </section>
    </main>
    <?php
    return ob_get_clean(); // Return the output instead of printing it directly
}

add_shortcode('my_about_form', 'my_about_form');
?>
