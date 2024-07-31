<?php
/*
Plugin Name: My Custom Plugin
Description: A plugin to demonstrate tutorials
Version: 1.0
Author: Apoorva
*/

// Shortcode handler to display the form
function my_tutorial_form() {
    ob_start();
    ?>
    <main id="content" class="site-content">
        <section class="tutorials-section">
            <div class="tutorials-grid">
            <?php
            $tutorials_query = new WP_Query(array(
                'post_type' => 'tutorials',
                'posts_per_page' => -1,
            ));

            if ($tutorials_query->have_posts()) :
                $count = 0;
                while ($tutorials_query->have_posts()) : $tutorials_query->the_post();
                    $tutorial_url = get_post_meta(get_the_ID(), '_tutorial_url', true);
                    if ($count % 4 == 0 && $count != 0) {
                        echo '</div><div class="tutorials-grid">';
                    }
                    ?>
                    <div class="tutorial-item">
                        <p><?php the_content() ?></p>
                        <a href="<?php echo esc_url($tutorial_url); ?>" target="_blank"><?php the_title(); ?></a>
                    </div>
                    <?php
                    $count++;
                endwhile;
                wp_reset_postdata();
                echo '</div>';
            else :
                ?>
                <div class="tutorial-item">No tutorials found.</div>
                <?php
            endif;
            ?>
            </div>
        </section>
    </main>
    <?php
    return ob_get_clean(); // Return the output instead of printing it directly
}

add_shortcode('my_tutorial_form', 'my_tutorial_form');
?>