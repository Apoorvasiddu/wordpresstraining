<?php
/**
 * Woffice custom member template
 *
 * @since 2.8.0
 */

/**
 * You can hide the role of users displayed in the members loop page
 *
 * @param bool
 */
$members_role_enabled = apply_filters('woffice_enable_member_role_on_members_page', true);

/**
 * You can hide the last activity of users displayed in the members loop page
 *
 * @param bool
 */
$last_activity_enabled = apply_filters('woffice_enable_member_last_activity_on_members_page', true);
?>

<ul id="members-list" class="<?php bp_nouveau_loop_classes(); ?>">
	<div class="row">
	<?php while ( bp_members() ) : bp_the_member(); 

		$user_id   = (int) bp_get_member_user_id();
		$the_cover = woffice_get_cover_image($user_id);
				
	?>
		<div class="col-xs-12 col-sm-12 col-md-4">
			<li <?php bp_member_class(); ?> data-bp-item-id="<?php bp_member_user_id(); ?>" data-bp-item-component="members">
				<div class="bp-profile-card">
					<?php $role = woffice_get_user_role($user_id); ?>
					<?php if ($members_role_enabled && !empty($role)): ?>
						<span class="profile-card-badge is-<?php echo esc_html($role); ?>" data-template="woffice"><?php echo esc_html($role); ?></span>
					<?php endif; ?>
					<div class="card-top d-flex">
						<div class="profile-thumb">
							<a href="<?php bp_member_permalink(); ?>">
								<?php bp_member_avatar( bp_nouveau_avatar_args() ); ?>
							</a>	
						</div>
						<div class="profile-title">
							<h2 class="list-title member-name">
								<a href="<?php bp_member_permalink(); ?>">
									<?php echo woffice_get_name_to_display($user_id); ?>
								</a>
							</h2>
							<?php if ( bp_nouveau_member_has_meta() && $last_activity_enabled ) : ?>
								<p class="item-meta last-activity">
									<?php bp_nouveau_member_meta(); ?>
								</p><!-- #item-meta -->
							<?php endif; ?>
						</div>
					</div>
					<div class="card-content">
						<?php
							/**
							 * Before the list of custom member fields, in the members page (card layout)
							 */
							do_action('woffice_before_list_xprofile_fields');

							woffice_list_xprofile_fields(bp_get_member_user_id());

							/**
							 * After the list of custom member fields, in the members page (card layout)
							 */
							do_action('woffice_after_list_xprofile_fields'); 
						?>
					</div>
					<div class="card-bottom">
						<a href="<?php bp_member_permalink(); ?>" class="btn btn-primary mb-0 d-block" data-template="woffice">
							<?php _e('Profile', 'woffice') ?>
							<i class="fas fa-arrow-right pl-2 pr-0"></i>
						</a>
						<?php
							bp_nouveau_members_loop_buttons(
								array(
									'container'      => 'ul',
									'button_element' => 'button',
								)
							);
						?>
					</div>
				</div>
			</li>
		</div>
		<?php endwhile; ?>
	</div>
</ul>