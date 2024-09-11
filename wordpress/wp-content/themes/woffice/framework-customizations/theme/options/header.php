<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'header' => array(
		'title'   => __( 'Header bar', 'woffice' ),
		'type'    => 'tab',
		'options' => array(
			'header-box' => array(
				'title'   => __( 'Main options', 'woffice' ),
				'type'    => 'box',
				'options' => array(
					'header_logo' => array(
						'label' => __( 'Main Logo', 'woffice' ),
						'desc'  => __( 'Upload your image for the logo (white color advised)', 'woffice' ),
						'type'  => 'upload',
						'images_only' => true
					),
					'header_width' => array(
						'label' => __( 'Logo Width', 'woffice' ),
						'type'  => 'short-text',
						'value' => '180',
						'desc' => __('A number please','woffice'),
						'help' => __('No need to set px','woffice'),
					),
					'header_height' => array(
						'label' => __( 'Navigation Bar Height', 'woffice' ),
						'type'  => 'short-text',
						'value' => '60',
						'desc' => __('A number please','woffice'),
						'help' => __('No need to set px','woffice'),
					),
					'header_logo_hide' => array(
						'label' => __( 'Do you want to hide the logo ?', 'woffice' ),
						'type'  => 'checkbox',
						'value' => false
					),
					'header_search'    => array(
						'label' => __( 'Search icon in the menu ?', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'yep',
							'label' => __( 'Yep', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'nope',
							'label' => __( 'Nope', 'woffice' )
						),
						'value'        => 'yep',
						'desc' => __('Do you want to show the seacrh icon at the end of the menu.','woffice'),
					),
					'header_user'    => array(
						'label' => __( 'User box ?', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'yep',
							'label' => __( 'Yep', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'nope',
							'label' => __( 'Nope', 'woffice' )
						),
						'value'        => 'yep',
						'desc' => __('Do you want to show the user box in the navbar ?','woffice'),
					),
					'header_login'    => array(
						'label' => __( 'Login link ?', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'yep',
							'label' => __( 'Yep', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'nope',
							'label' => __( 'Nope', 'woffice' )
						),
						'value'        => 'yep',
						'desc' => __('If the page is accessible do you want to display a link to your login page ?','woffice'),
					),
				)
			),
		)
	)
);