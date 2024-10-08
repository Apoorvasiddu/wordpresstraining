<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 */

get_header();
?>



	<div id="left-content">

		<?php  //GET THEME HEADER CONTENT
			woffice_top_navbar();
		 ?>


		<?php // Start the Loop.
		while ( have_posts() ) : the_post(); ?>

		<!-- START THE CONTENT CONTAINER -->
		<div id="content-container">

			<!-- START CONTENT -->
			<div id="content">
				<?php the_title('<h1 class="post-title">','</h1>'); ?>
				<?php
				if (woffice_is_user_allowed()) {
					get_template_part( 'content', 'page' );

					$page_comments = woffice_get_settings_option('page_comments');
					// If comments are open or we have at least one comment, load up the comment template.
					if ( $page_comments == "show"){
						if ( comments_open() || get_comments_number()) {
							comments_template();
						}
					}
				}
				else {
					get_template_part( 'content', 'private' );
				}
				?>
			</div>

		</div><!-- END #content-container -->

	</div><!-- END #left-content -->

<?php // END THE LOOP
endwhile; ?>

<?php
get_footer();
