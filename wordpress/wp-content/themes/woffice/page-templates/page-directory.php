<?php
/**
* Template Name: Directory
*/

$process_result = array();
$is_user_allowed   = woffice_is_user_allowed();
$slider_featured = woffice_get_post_option($page_id, 'revslider_featured');
$page_id      = (is_home() && get_option('page_for_posts')) ? get_option('page_for_posts') : get_the_ID();


if (woffice_bp_is_buddypress()) {
	$bp_post_id = woffice_get_relative_current_buddypress_page_id();

	if ($bp_post_id) {
		$page_id = $bp_post_id;
	}
}

$slider_featured = woffice_get_post_option($page_id, 'revslider_featured');

if (function_exists( 'woffice_directory_extension_on' )){

	$directory_create = woffice_get_settings_option('directory_create'); 				
	if (Woffice_Frontend::role_allowed($directory_create)):

        $process_result = Woffice_Frontend::frontend_process('directory');
		
	endif;
	
}

get_header();  
?>

	<?php // Start the Loop.
	while ( have_posts() ) : the_post(); ?>

		<div id="left-content">

			<?php  //GET THEME HEADER CONTENT

				$title = get_the_title();
				woffice_top_navbar();
			?> 	

			<!-- START THE CONTENT CONTAINER -->
			<div id="content-container">
				<!-- START CONTENT -->
				<div id="content">
					<?php
						$map_enabled = (is_page_template("page-templates/page-directory.php") || is_tax('directory-category')) && $is_user_allowed && empty($slider_featured);
						$map_enabled = apply_filters( 'woffice_directory_page_map_enabled', $map_enabled);
						if ($map_enabled) {
							$final_image = false;
							echo '<div id="map-directory"></div>';
						}
					?>
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<?php the_title('<h1 class="post-title">','</h1>'); ?>
						</div>
						<div>
							<?php  get_search_form(); ?>
						</div>
					</div>
					
                    <?php if ( woffice_directory_content_exists() ): ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div id="directory-page-content" class="box content">
                                <div class="intern-padding">
                                    <?php
                                        // THE PAGE CONTENT
                                        the_content();
                                        //DISABLED IN THIS THEME
                                        wp_link_pages(array('echo'  => 0));
                                        //EDIT LINK
                                        edit_post_link( __( 'Edit', 'woffice' ), '<span class="edit-link">', '</span>' );
                                        
                                        // The directory filter
                                        if (function_exists( 'woffice_directory_extension_on' )) {
                                            woffice_directory_filter();
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
					<?php if (woffice_is_user_allowed()): ?>
					<?php /* If the directory extension is one we display the items */
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = array(
						'post_type' => 'directory',
						'paged' => $paged,
					);

                      /**
                       * Filter the args of the query for directory items
                       *
                       * @param array
                       */
					$directory_query = new WP_Query(apply_filters('woffice_directory_loop_args', $args, $paged));
					?>
					<div class="row">
					<?php
					if ( $directory_query->have_posts() && function_exists('woffice_directory_extension_on')) :
					
						// echo '<div id="directory" class="masonry-layout">';
						
						while($directory_query->have_posts()) : $directory_query->the_post();
					?>
							<div class="col-md-4 directory-col">
								<div class="directory-list-wrapper d-flex h-100 p-3">
									<div class="card">
										<div class="directory-thumb">
											<?php
												if ( has_post_thumbnail() ) :
													Woffice_Frontend::render_featured_image_single_post($post->ID, '', $post->ID);
												endif; 
											?>
										</div>
										<div class="card-body">
											<h5 class="card-title">
												<?php
													echo'<h3 class="directory-title"><a href="'. get_the_permalink() .'">'.get_the_title().'</a></h3>';
												?>
											</h5>
											<div>
												<?php
													/* Categories */
													if( has_term('', 'directory-category')): 
														echo '<span class="directory-category"><i class="fa fa-thumb-tack"></i>';
														echo get_the_term_list( $post->ID, 'directory-category', '', ', ' );
														echo '</span>';
													endif;

													/* Comments */
													if (comments_open() || get_comments_number()){
														echo'<span class="directory-comments"><i class="fa fa-comments"></i> ';
															echo'<a href="'. get_the_permalink().'#respond">'. get_comments_number( '0', '1', '%' ) .'</a>';
															echo'</span>';	
													}
												?>
											</div>
											<?php
												/* Excerpt */
												echo '<p>';
													echo woffice_directory_get_excerpt();
												echo '</p>';
											?>
											<?php woffice_directory_single_fields('page');?>
										</div>
									</div>
								</div>
							</div>
						<?php
						endwhile;
								
						wp_reset_postdata();
						
						echo '</div>';
                        woffice_paging_nav($directory_query);
					
					else :
						
						get_template_part( 'content', 'none' );
						
					endif;  ?>
					
					<?php // CHECK IF USER CAN CREATE DIRECTORY ITEM
					$directory_create = woffice_get_settings_option('directory_create'); 
					if (Woffice_Frontend::role_allowed($directory_create)):  ?>
					
						<div class="box frontend-wrapper">
						
							<div class="center intern-padding" id="directory-bottom">
								<a href="#" class="btn btn-default frontend-wrapper__toggle" data-action="display" data-type="create" id="show-directory-create"><i class="fa fa-plus-square"></i> <?php _e("Create an item", "woffice"); ?></a>
							</div>
							
							<?php Woffice_Frontend::frontend_render('directory',$process_result); ?>
							
						</div>
						
					<?php endif; ?>

				<?php
				else:
					get_template_part( 'content', 'private' );
				endif;
				?>
				</div>
				</div>
					
			</div><!-- END #content-container -->

	<?php // END THE LOOP 
	endwhile; ?>

<?php 
get_footer();