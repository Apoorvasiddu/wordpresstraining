<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'footer' => array(
		'title'   => __( 'Footer & Extrafooter', 'woffice' ),
		'type'    => 'tab',
		'options' => array(
			'footer-box' => array(
				'title'   => __( 'Footer Options', 'woffice' ),
				'type'    => 'box',
				'options' => array(

					'footer_copyright_content' => array(
						'label' => __( 'Copyright Content', 'woffice' ),
						'type'  => 'textarea',
						'value' => '&#169; 2021 all rights reserved. Powered by <a href="//themeforest.net/user/2Fwebd">Woffice</a>.'
					),					
				)
			),
		)
	)
);