<?php
/**
 * Template Name: Full Width
 */

get_header();  
?>

	<?php // Start the Loop.
	while ( have_posts() ) : the_post(); ?>

		<div id="left-content">

			<?php  //GET THEME HEADER CONTENT
			woffice_top_navbar(); ?> 	

			<!-- START THE CONTENT CONTAINER -->
			<div id="content-container">

				<!-- START CONTENT -->
				<div id="content">
					<?php if (woffice_is_user_allowed()) { ?>
						<?php
						// Include the page content template.
						get_template_part( 'content', 'page' );
						?>
					<?php } else { 
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


