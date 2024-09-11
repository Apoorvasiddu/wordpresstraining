<?php
/**
 * The template used for displaying post content
 */
?>
<?php 
// CUSTOM CLASSES ADDED BY THE THEME
$post_classes = array('content', 'entry-content');
$blog_listing_content = woffice_get_settings_option('blog_listing_content','excerpt');
$hide_image_single_post = woffice_get_settings_option('hide_image_single_post', 'nope');
$hide_author_box = woffice_get_settings_option('hide_author_box_single_post', 'nope');
$hide_like_counter = woffice_get_settings_option('hide_like_counter_inside_author_box', 'nope');
$hide_learndash_meta = woffice_get_settings_option('hide_learndash_meta', 'nope');

if(get_post_status() == 'draft')
    array_push($post_classes, 'is-draft');
?>
	<div class="col-md-4 blog-col">
		<div class="blog-card-wrapper d-flex h-100 mb-3">
			<div class="card">
				<div class="blog-thumb">
					<?php if (has_post_thumbnail() && (!is_single() || is_single() && $hide_image_single_post == 'nope')) : ?>
						<!-- THUMBNAIL IMAGE -->
						<?php /*GETTING THE POST THUMBNAIL URL*/
							$featured_height = (function_exists('fw_get_db_post_option')) ? fw_get_db_post_option(get_the_ID(), 'featured_height') : '';
							Woffice_Frontend::render_featured_image_single_post($post->ID, $featured_height);
						?>
						<?php else: ?>
						<img src="<?php echo get_stylesheet_directory_uri() ?>/images/blog.png">
					<?php endif; ?>
				</div>
				<div class="card-body">
					<div class="blog-title">
						<?php if (strpos(get_post_type(), 'sfwd') === FALSE || is_search()) : ?>
							<div class="intern-padding heading-container">
								<?php if (!is_single()): ?>
									<?php // THE TITLE
									if (is_sticky()):
										the_title( '<div class="heading"><h2><a href="' . esc_url( get_permalink() ) . '" class="font-weight-bold" rel="bookmark"><i class="fa fa-star text-yellow"></i>', '</a></h2></div>' );
									else: 
										the_title( '<div class="heading"><h2><a href="' . esc_url( get_permalink() ) . '" class="font-weight-bold" rel="bookmark">', '</a></h2></div>' );
									endif; ?>
								<?php else : ?>
									<?php // THE TITLE
									the_title( '<div class="heading"><h2>', '</h2></div>' ); ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="post-meta">
						<?php // We display the post meta in the top only for the blog articles
							if ($post->post_type == "post") : ?>
								<div class="intern-box">
									<?php // THE POST META
									woffice_postmetas(); ?>
								</div>
						<?php endif; ?>
					</div>
					<div class="blog-content">
						<?php if (is_single() || $blog_listing_content == 'content'): ?>
							<?php the_content(''); ?>
						<?php else : ?>
							<?php //the_excerpt(5); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="card-footer border-0 bg-transparent">
					<?php if (!is_single()): ?>
						<div class="blog-button">
							<a href="<?php the_permalink(); ?>" class="btn btn-default mb-0"><i class="fa fa-arrow-right"></i> <?php _e('Read More','woffice'); ?></a>
						</div>	
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</article>
