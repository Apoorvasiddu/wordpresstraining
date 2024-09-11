<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'menu' => array(
		'title'   => __( 'Menu', 'woffice' ),
		'type'    => 'tab',
		'options' => array(
			'menu-box' => array(
				'title'   => __( 'Main options', 'woffice' ),
				'type'    => 'box',
				'options' => array(
					'menu_background' => array(
					    'type'  => 'color-picker',
					    'value' => '#f7f8fa',
					    'label'  => __('Background color', 'woffice'),
						'desc' => __('The background color of the menu','woffice')
					),
					'menu_color2' => array(
					    'type'  => 'color-picker',
					    'value' => '#ffffff',
					    'label'  => __('Menu color #2', 'woffice'),
						'desc' => __('Used for the text color','woffice')
					),
					'menu_icon_color' => array(
					    'type'  => 'color-picker',
					    'value' => '#fd7a38',
					    'label'  => __('Menu Icon color', 'woffice'),
						'desc' => __('Used for the icon color','woffice')
					),
					'menu_default'    => array(
						'label' => __( 'Menu Default State', 'woffice' ),
						'desc'  => __( 'Choose the default state of the menu when the user has not clicked yet on the toggle button.', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'open',
							'label' => __( 'Open', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'close',
							'label' => __( 'Close', 'woffice' )
						),
						'value'        => 'open',
					),
                    'menu_threshold' => array(
                        'label' => __( '[BETA] Mobile menu threshold', 'woffice' ),
                        'type'  => 'short-text',
                        'value' => '992',
                        'desc' => __("A number please (This options is still a BETA version, so we cannot ensure that it will works well in every layout).",'woffice'),
                        'help' => __('No need to set px','woffice'),
                    ),
				)
			),
		)
	)
);