<?php
/**
 * BuddyPress - Groups Loop
 *
 * @since 3.0.0
 * @version 3.1.0
 */

bp_nouveau_before_loop(); ?>

<?php if ( bp_get_current_group_directory_type() ) : ?>
	<p class="current-group-type"><?php bp_current_group_directory_type_message(); ?></p>
<?php endif; ?>

<?php if ( bp_has_groups( bp_ajax_querystring( 'groups' ) ) ) : ?>

	<ul id="group-list" class="<?php bp_nouveau_loop_classes(); ?>">
		<div class="row">
		<?php while ( bp_groups() ) :
				bp_the_group();
			  $status = bp_get_group_status(false);
			  if($status === 'hidden'){
				continue;
			  }
		?>
			<div class="col-xs-12 col-sm-12 col-md-4 group-item-parent">
				<li <?php bp_group_class(); ?> data-bp-item-id="<?php bp_group_id(); ?>" data-bp-item-component="groups">
					<div class="bp-group-card">
						<div class="card-top d-flex">
							<div class="group-thumb">
								<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
									<?php
									/**
									 * We get the cover image if it exists
									 * @since 2.3.0
									 */
									$group_cover_image_url = bp_attachments_get_attachment('url', array(
										'object_dir' => 'groups',
										'item_id' => bp_get_group_id(),
									));
									if(!empty($group_cover_image_url)) {
										$cover_style = 'style="background-image: url('.$group_cover_image_url.')"';
										$cover_class = 'has-cover';
									} else {
										$cover_style = '';
										$cover_class = '';
									}
									?>
									<div class="item-avatar <?php echo esc_url($cover_class); ?>" <?php echo wp_kses_post($cover_style); ?> data-template="woffice">
										<a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( bp_nouveau_avatar_args() ); ?></a>
									</div>
								<?php endif; ?>
							</div>
							<div class="group-title">
								<h2 class="list-title groups-title"><?php bp_group_link(); ?></h2>
								<p class="last-activity item-meta">
									<?php
									printf(
									/* translators: %s = last activity timestamp (e.g. "active 1 hour ago") */
										__( 'active %s', 'woffice' ),
										bp_get_group_last_active()
									);
									?>
								</p>
							</div>
						</div>
						<div class="card-content">
							<?php if ( bp_nouveau_group_has_meta() ) : ?>
								<p class="item-meta group-details">
									<?php 
										if(function_exists('bp_nouveau_the_group_meta')) {
											bp_nouveau_the_group_meta();
										} else {
											bp_nouveau_group_meta();
										}
									?>
								</p>
							<?php endif; ?>
							<?php bp_nouveau_groups_loop_item(); ?>
							<div class="group-desc">
								<?php bp_nouveau_group_description_excerpt(); ?>
							</div>
						</div>
						<div class="card-bottom">
							<?php bp_nouveau_groups_loop_buttons(); ?>
						</div>
					</div>
				</li>
			</div>
			<?php endwhile; ?>
		</div>
	</ul>
<?php bp_nouveau_pagination( 'bottom' ); ?>

<?php else : ?>

<?php bp_nouveau_user_feedback( 'groups-loop-none' ); ?>

<?php endif; ?>

<?php
	bp_nouveau_after_loop();
?>