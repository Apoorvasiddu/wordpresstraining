<?php
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'woffice-okr' => array(
		'title'   => __( 'Woffice OKR', 'woffice' ),
		'type'    => 'tab',
		'options' => array(
			'woffice-ok-box' => array(
				'title'   => __( 'Main Options', 'woffice' ),
				'type'    => 'box',
				'options' => array(
					'okr_progress_notification'    => array(
						'label' => __( 'OKR Notification For Users', 'woffice' ),
						'desc'  => __( 'OKR Daily/Weekly/Monthly Notification Reminder', 'woffice' ),
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
					'okr_notification_type'    => array(
						'label' => __( 'Notification Frequency for Users', 'woffice' ),
						'desc'  => __( 'Send notification daily,weekly or monthly', 'woffice' ),
						'type'  => 'select',
						'value' => 'classic',
						'choices' => array(
							'daily' => __( 'Daily', 'woffice' ),
							'weekly' => __( 'Weekly', 'woffice' ),
							'monthly' => __( 'Monthly', 'woffice' ),
						)
					),
					'okr_objective_notification_subject'    => array(
						'label' => __('Objective Notification Subject', 'woffice' ),
						'desc'  => __('This is the subject for OKR Objective notificatio.', 'woffice' ),
						'type'  => 'text',
						'value' => 'OKR Reminder',
					),
					'okr_objective_notification_content'    => array(
						'label' => __('Objective Notification Content', 'woffice' ),
						'desc'  => __( 'This is the content of the email before the task name. Dynamic variables that will be replaced automatically: {objective_list}', 'woffice' ),
						'type'  => 'wp-editor',
						'value' => 'Hey {user_name},<br/> <p>You have a below Objectives in your bucket.</p> <p> Your Objectives are as below.</p> {objective_list}',
					),
					'okr_keyres_notification_subject'    => array(
						'label' => __('Key result Notification Subject', 'woffice' ),
						'desc'  => __('This is the subject for OKR Key result notificatio.', 'woffice' ),
						'type'  => 'text',
						'value' => 'OKR Reminder',
					),
					'okr_keyres_notification_content'    => array(
						'label' => __('Key result Notification Content', 'woffice' ),
						'desc'  => __( 'This is the content of the email before the task name. Dynamic variables that will be replaced automatically: {keyresult_list}', 'woffice' ),
						'type'  => 'wp-editor',
						'value' => 'Hey {user_name},<br/> <p>You have a below Key Result in your bucket.</p> <p>Your Key Result are as below.</p> {keyresult_list}.',
					),
				),
			),
			'woffice-ok-style-settings' => array(
				'title'   => __( 'Style settings', 'woffice' ),
				'type'    => 'box',
				'options' => array(
					'okr_okrfront_icon'    => array(
						'label' => __( 'OKR Icon', 'woffice' ),
						'desc'  => __( 'Select icon which is show on OKR', 'woffice' ),
						'type'         => 'icon'
						),
					'okr_objective_icon'    => array(
						'label' => __( 'Objective Icon', 'woffice' ),
						'desc'  => __( 'Select icon which is show on Objective', 'woffice' ),
						'type'         => 'icon'
					),
				),
			),
		)
	)
);