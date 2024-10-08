<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 */
get_header();  ?>

	<div id="left-content">
	<?php  //GET THEME HEADER CONTENT
		$title = '';
		if ( is_day() ) :
			$title = sprintf( __( 'Daily Archives: <span>%s</span>', 'woffice' ), get_the_date() );
		elseif ( is_month() ) :
			$title = sprintf( __( 'Monthly Archives: <span>%s</span>', 'woffice' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'woffice' ) ) );
		elseif ( is_year() ) :
			$title = sprintf( __( 'Yearly Archives: <span>%s</span>', 'woffice' ), get_the_date( _x( 'Y', 'yearly archives date format', 'woffice' ) ) );
		elseif ( is_tax() ) :
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$title =  $term->name . __(' Archives','woffice'); 		
		elseif (is_post_type_archive('wiki')) :
			$title = __( 'Wiki Articles', 'woffice' );
		elseif (is_post_type_archive('project')) :
			$title = __( 'Projects', 'woffice' );
		else :
			$title = __( 'Archives', 'woffice' );
		endif;
			woffice_top_navbar();
		?> 
		<?php  //GET THEME HEADER CONTENT
		$title = sprintf( __( 'Category Archives: <span>%s</span>', 'woffice' ), single_cat_title( '', false ));
		?> 	

		<!-- START THE CONTENT CONTAINER -->
		<div id="content-container">
			<!-- START CONTENT -->
			<div id="content">
				<div class="post-title pb-5">
					<?php echo sprintf($title); ?>
				</div>
				<div class="row">
                <?php
                $blog_layout = 'classic';
                $content_type = 'content';
                if(get_post_type() == 'post'){

                    $blog_layout = woffice_get_settings_option('blog_layout');
	                $blog_layout = (isset($_GET['blog_masonry'])) ? 'masonry' : $blog_layout;

	                $masonry_columns = woffice_get_settings_option('masonry_columns');
	                $masonry_columns_class = 'masonry-layout--'.$masonry_columns.'-columns';

                    echo ('masonry' === $blog_layout) ? '<div id="directory" class="masonry-layout '. $masonry_columns_class .'">' : '';
	                $content_type = ('masonry' === $blog_layout) ? 'content-masonry' : 'content';
                }
                ?>

                <?php
                /**
                 * Reset the query before displaying the post
                 * A loop must be unclosed before this call
                 * See: WOF-161
                 */
                wp_reset_query(); ?>

				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php // We check for the role : 
						if (woffice_is_user_allowed()) { ?>
							<?php get_template_part( $content_type ); ?>
						<?php } ?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>

                <?php echo ('masonry' === $blog_layout) ? '</div>' : ''; ?>

				<!-- THE NAVIGATION --> 
				<?php woffice_paging_nav(); ?>
			</div>
			</div>
		</div><!-- END #content-container -->

	</div><!-- END #left-content -->

<?php 
get_footer();
