<?php
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$columns_values = array(
		'0' => array(
			'title' => 'TODO',
			'color' => '#0275d8',
		),
		'1' => array(
			'title' => 'Active',
			'color' => '#5bc0de',
		),
		'2' => array(
			'title' => 'Urgent',
			'color' => '#f0ad4e',
		),
		'3' => array(
			'title' => 'Completed',
			'color' => '#5cb85c',
		),
	);

$options = array(
	'woffice-team-view' => array(
		'title'   => __( 'Woffice Team View', 'woffice' ),
		'type'    => 'tab',
		'options' => array(
			'team-view-box' => array(
				'title'   => __( 'Main Options', 'woffice' ),
				'type'    => 'box',
				'options' => array(
					'team_progress_notification'    => array(
						'label' => __( 'Team Progress Notification For Users', 'woffice' ),
						'desc'  => __( 'Team Progress Daily/Weekly Notification Reminder', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'active',
							'label' => __( 'Active', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'disabled',
							'label' => __( 'Disabled', 'woffice' )
						),
						'value'        => 'disabled',
					),
					'team_notification_type'    => array(
						'label' => __( 'Notification Frequency for Users', 'woffice' ),
						'desc'  => __( 'Send notification daily or weekly', 'woffice' ),
						'type'         => 'select',
						'value'        => 'classic',
						'choices' => array(
							'daily' => __( 'Daily', 'woffice' ),
							'weekly' => __( 'Weekly', 'woffice' ),
						)
					),
					'team_progress_admin_notification'    => array(
						'label' => __( 'Team Progress Notification for Admin', 'woffice' ),
						'desc'  => __( 'Team Progress Daily/Weekly Notification Reminder to admin', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'active',
							'label' => __( 'Active', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'Disabled',
							'label' => __( 'Disabled', 'woffice' )
						),
						'value'        => 'disabled',
					),
					'team_notification_type_admin'    => array(
						'label' => __( 'Notification Frequency for admin', 'woffice' ),
						'desc'  => __( 'Send notification daily or weekly to admin', 'woffice' ),
						'type'         => 'select',
						'value'        => 'classic',
						'choices' => array(
							'daily' => __( 'Daily', 'woffice' ),
							'weekly' => __( 'Weekly', 'woffice' ),
						)
					),
				),
			),
		)
	)
);