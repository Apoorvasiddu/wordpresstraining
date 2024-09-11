<?php
$project_status = (function_exists('fw_get_db_post_option')) ? fw_get_db_post_option(get_the_ID(), 'project_current_status') : 'planned';

if ($project_status == 'archived') {
	$project_status_icon = 'fa-archive';
	$project_status_label = __('Archived','woffice');
} else if ($project_status == 'done') {
	$project_status_icon = 'fa-check-square';
	$project_status_label = __('Done','woffice');
} else if ($project_status == 'in_progress') {
	$project_status_icon = 'fa-sync';
	$project_status_label = __('In progress','woffice');
} else if ($project_status == 'in_review') {
	$project_status_icon = 'fa-cog';
	$project_status_label = __('In review','woffice');
} else {
	$project_status_icon = 'fa-book';
	$project_status_label = __('Planned','woffice');
}
$projects_layout = woffice_get_settings_option('projects_layout');
if($projects_layout == 'grid') {
	$projects_gird_class = "item col-md-4";
}
?>

<li class="content <?php echo (isset($archived_class)) ? $archived_class : ''; echo (isset($projects_gird_class)) ? $projects_gird_class : ''; ?>">
	<div class="d-flex h-100 p-3 card-wrapper">
		<div class="card card-parent p-0 w-100">
			<div class="card h-100 pb-3">
				<div class="card-body p-3">
					<?php echo '<span class="project-status badge badge-pill '. esc_attr($project_status) . '"><i class="fa '. esc_attr($project_status_icon) .' pr-2"></i>'. esc_html($project_status_label) . '</span>';?>
					<h2 class="project-title"><?php the_title() ?></h2>
					<ul class="list-group list-group-horizontal-sm p-0">
						<li class="list-group-item p-0 mr-auto">
							<?php
								// DATE
								woffice_projects_loop_render_dates( $post->ID );
							?>
						</li>
						<li class="list-group-item p-0 pr-2">
							<?php
								// MEMBERS
								$project_members = woffice_get_project_members();
								echo '<span class="project-members"><i class="fa fa-users"></i> '.count($project_members).'</span>';
							?>
						</li>
						<li class="list-group-item p-0 pr-2">
							<?php
								if (get_comment_count(get_the_ID()) > 0):
									echo '<span class="project-comments"><i class="fa fa-comments"></i> '.get_comments_number( '0', '1', '%' ).'</span>';
								endif;
							?>
						</li>
					</ul>
					<div class="mt-4">
						<?php // THE PROGRESS BAR 
							woffice_project_progressbar();
						?>
					</div>
					<div class="mt-4 mb-4 post-cateogry project-cateogry">
						<?php
							// CATEGORY
							if( has_term('', 'project-category')):
								echo '<span class="project-cateogry-badge">';
								echo wp_strip_all_tags(get_the_term_list( $post->ID, 'project-category', '', ', ' ));
								echo '</span>';
							endif;
						?>
					</div>
				</div>
				<div class="card-footer border-0 bg-white">
					<a href="<?php the_permalink(); ?>" class="btn btn-default d-block"><?php esc_html_e("See Project","woffice")?></a>
				</div>
			</div>
		</div>
	</div>
</li>