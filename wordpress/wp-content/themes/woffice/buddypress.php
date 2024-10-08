<?php
/**
 * The template for displaying BUDDYPRESS
 */

get_header();  
?>

	<?php // Start the Loop.
	while ( have_posts() ) : the_post(); ?>
	
		<div id="left-content">

			<?php  //GET THEME HEADER CONTENT
				woffice_top_navbar();
			 ?> 	

			<!-- START THE CONTENT CONTAINER -->
			<div id="content-container">

				<!-- START CONTENT -->
				<div id="content">
					<?php 
					if(!bp_is_user()){
						the_title('<h1 class="post-title">','</h1>');
					}

					if (woffice_is_user_allowed_buddypress('view')) { ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php 
							
							// THE CONTENT
							the_content();
							//DISABLED IN THIS THEME
							wp_link_pages(array('echo'  => 0));
							//EDIT LINK
							edit_post_link( __( 'Edit', 'woffice' ), '<span class="edit-link">', '</span>' );
							?>
						</article>
					<?php 
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