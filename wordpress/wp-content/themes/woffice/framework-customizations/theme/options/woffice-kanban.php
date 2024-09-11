<?php
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$columns_values = array(
		array(
			'title' => 'TODO',
			'status_slug' => 'todo',
			'color' => '#0275d8',
		),
		array(
			'title' => 'Active',
			'status_slug' => 'working',
			'color' => '#5bc0de',
		),
		array(
			'title' => 'Urgent',
			'status_slug' => 'urgent',
			'color' => '#f0ad4e',
		),
		array(
			'title' => 'Completed',
			'status_slug' => 'compeleted',
			'color' => '#5cb85c',
		),
	);

$options = array(
	'woffice-kanban' => array(
		'title'   => __( 'Woffice Kanban', 'woffice' ),
		'type'    => 'tab',
		'options' => array(
			'kanban-box' => array(
				'title'   => __( 'Main Options', 'woffice' ),
				'type'    => 'box',
				'options' => array(
					'kanban-columns' => array(
						'type' => 'addable-popup',
						'value' => $columns_values,
						'label' => __('Column Settings', 'woffice'),
						'desc'  => __('Title is used as Kanban column title and color is used as column background color.', 'woffice'),
						'template' => '{{- title }}',
						'popup-title' => null,
						'size' => 'small', // small, medium, large
						'limit' => 6, // limit the number of popup`s that can be added
						'add-button-text' => __('Add', 'woffice'),
					    'sortable' => true,
						'popup-options' => array(
							'title' => array(
								'type'  => 'text',
								'label'  => __('Column Title', 'woffice'),
								'attr'  => array('autocomplete' => 'off'),
								'desc' => __('This is your background color (used in the column title background color).','woffice')
							),
							'status_slug' => array(
								'type'  => 'hidden',
								'label'  => __('Column slug', 'woffice'),
								'attr'  => array('autocomplete' => 'off'),
								'desc' => __('This is your backend slug (used in the column).','woffice')
							),
							'color' => array(
								'type'  => 'color-picker',
								'attr'  => array('autocomplete' => 'off'),
								'label'  => __('Column Background color', 'woffice'),
								'desc' => __('This is your background color (used in the column title background color).','woffice')
							),
						),
					),
					'kanban-box1' => array(
						'title'   => __( 'Notification Options', 'woffice' ),
						'type'    => 'box',
						'options' => array(
							'kanban_status_notification_subject'    => array(
								'label' => __('Kanban Status Changed Notification Subject', 'woffice' ),
								'desc'  => __('This is the subject when status is changed.', 'woffice' ),
								'type'         => 'text',
								'value'        => 'Your task status is changed',
							),
							'kanban_status_notification_content'    => array(
								'label' => __('Kanban Status change Notification Content', 'woffice' ),
								'desc'  => __( 'This is the content of the email before the task name. Dynamic variables that will be replaced automatically: {user_name}, {project_url}, {todo_title}', 'woffice' ),
								'type'  => 'wp-editor',
								'value' => 'Hey {user_name}, <br> Your task status is changed from <b>{old_status}</b> to <b>{new_status}</b> in task {task_title} in project {project_url}.',
							),
						),
					),
				),
			),
		)
	)
);