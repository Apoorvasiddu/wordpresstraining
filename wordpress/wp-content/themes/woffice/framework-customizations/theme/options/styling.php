<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'styling' => array(
		'title'   => __( 'Styling', 'woffice' ),
		'type'    => 'tab',
		'options' => array(
			'font-box' => array(
				'title'   => __( 'Fonts options', 'woffice' ),
				'type'    => 'box',
				'options' => array(
					'font_main_typography' => array(
						'type'  => 'typography',
					    'value' => array(
					        'family' => 'Inter',
					        'style' => '400',
					        'size' => 14,
					    ),
					    'components' => array(
					        'family' => true,
					        'size'   => true,
        					'color'  => false
					    ),
					    'label' => __('Main font Family', 'woffice'),
					    'desc'  => __('Used for the main texts (content, menu, footer ...).', 'woffice'),
					),
					'font_headline_typography' => array(
						'type'  => 'typography',
					    'value' => array(
					        'family' => 'Inter',
					        'style' => '400',
					        'size' => 14,
					    ),
					    'components' => array(
					        'family' => true,
					        'size'   => true,
        					'color'  => false
					    ),
					    'label' => __('Headlines font Family', 'woffice'),
					    'desc'  => __('Used for all the headlines. The size set here does not matters.', 'woffice'),
					),
					'font_extentedlatin' => array(
						'label' => __( 'Extended latin ?', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'nope',
							'label' => __( 'Yep', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'nope',
							'label' => __( 'Nope', 'woffice' )
						),
						'value'        => 'nope',
						'help' => __('This is for some fonts in some language (polish for example).','woffice'),
					),
					'font_headline_bold' => array(
						'label' => __( 'Bold Headlines ?', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'nope',
							'label' => __( 'Yep', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'nope',
							'label' => __( 'Nope', 'woffice' )
						),
						'value'        => 'yep',
						'help' => __('This is a global option for most of the titles, you will have something similar to the demo.','woffice'),
					),
					'font_headline_uppercase' => array(
						'label' => __( 'Uppercase Headlines ?', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'yep',
							'label' => __( 'Yep', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'nope',
							'label' => __( 'Nope', 'woffice' )
						),
						'value'        => 'nope',
						'help' => __('This is a global option for most of the titles, you will have something similar to the demo.','woffice'),
					),
				)
			),
		)
	)
);