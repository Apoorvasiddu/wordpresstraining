<?php
/**
* Template Name: Wiki
*/

$wiki_create = woffice_get_settings_option('wiki_create');
$woffice_role_allowed = Woffice_Frontend::role_allowed($wiki_create, 'wiki');
$process_result = array();

if (function_exists( 'woffice_wiki_extension_on' )){

	if ($woffice_role_allowed):

        $process_result = Woffice_Frontend::frontend_process('wiki');
		
	endif;

}

get_header();  
?>

	<?php // Start the Loop.

    // We check for excluded categories
    
    /*If it's not a child only*/

	while ( have_posts() ) : the_post(); ?>

		<div id="left-content">
			<?php woffice_top_navbar(); ?>
			<?php  //GET THEME HEADER CONTENT

			 ?> 	

			<!-- START THE CONTENT CONTAINER -->
			<div id="content-container">

				<!-- START CONTENT -->
				<div id="content">
					<?php if (woffice_is_user_allowed()) { ?>
						<?php 
						// CUSTOM CLASSES ADDED BY THE THEME
						$post_classes = array('content');
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>

							<div id="wiki-page-content" class="w9ki-page-content">
								<?php 
								the_title('<h1 class="post-title">','</h1>');
								// THE PAGE CONTENT
								the_content();
								//DISABLED IN THIS THEME
								wp_link_pages(array('echo'  => 0));
								//EDIT LINK
								edit_post_link( __( 'Edit', 'woffice' ), '<span class="edit-link">', '</span>' );

								?>
								<div class="row align-items-center">
									<div class="col-md-4">
											<?php  get_search_form(); ?>
									</div>
									<div class="col-md-8">
										<?php 
											if (function_exists('woffice_wiki_sort_by_like')) {
												woffice_wiki_sort_by_like();
											}
										?>
									</div>
								</div>
								<div class="row">
									<?php
										$wiki_display = new Woffice_Wiki_Display_Manager(0);
		
										$wiki_display->displayCategories();

										woffice_wiki_display_actions_buttons();
									?>
								</div>
								<?php 
								if (function_exists( 'woffice_wiki_extension_on' )){
									// CHECK IF USER CAN CREATE WIKI PAGE
									if ($woffice_role_allowed):  ?>

										<div class="frontend-wrapper">

											<?php Woffice_Frontend::frontend_render('wiki',$process_result); ?>

										</div>
										
									<?php endif; 
								} ?>
							</div>
							
						</article>

					<?php
					} else { 
						get_template_part( 'content', 'private' );
					}
					?>
				</div>
					
			</div><!-- END #content-container -->
	
	<?php // END THE LOOP 
	endwhile; ?>

<?php 
get_footer();



