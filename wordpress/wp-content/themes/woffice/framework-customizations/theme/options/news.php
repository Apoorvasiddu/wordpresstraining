<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'news' => array(
		'title'   => __( 'Blog', 'woffice' ),
		'type'    => 'tab',
		'options' => array(
			'blog-box' => array(
				'title'   => __( 'Main options', 'woffice' ),
				'type'    => 'box',
				'options' => array(
					'blog_number' => array(
						'label' => __( 'Number of posts displayed per page', 'woffice' ),
						'type'  => 'short-text',
						'value' => '10',
						'desc' => __('A number please','woffice')
					),
					'index_title' => array(
						'label' => __( 'Blog Page Title', 'woffice' ),
						'desc'  => __( 'It is the default Wordpress page here', 'woffice' ),
						'type'         => 'text',
						'value'        => 'News',
					),
					'blog_fullwidth' => array(
						'label' => __( 'Display Sidebar ?', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'show',
							'label' => __( 'With Sidebar', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'hide',
							'label' => __( 'Full Width', 'woffice' )
						),
						'value'        => 'show',
					),
                    'blog_listing_content'    => array(
                        'label' => __( 'Blog listing content', 'woffice' ),
                        'desc'  => __( 'Define what show in blog listing.', 'woffice' ),
                        'type'         => 'switch',
                        'right-choice' => array(
                            'value' => 'excerpt',
                            'label' => __( 'Excerpt', 'woffice' )
                        ),
                        'left-choice'  => array(
                            'value' => 'content',
                            'label' => __( 'Content', 'woffice' )
                        ),
                        'value'        => 'excerpt',
                    ),
                    'hide_author_box_single_post'    => array(
                        'label' => __( 'Hide Author box', 'woffice' ),
                        'desc'  => __( 'Hide author box section below blog posts.', 'woffice' ),
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
                    ),
                    'hide_like_counter_inside_author_box'    => array(
                        'label' => __( 'Hide Like Counter', 'woffice' ),
                        'desc'  => __( 'Hide like counter inside author box', 'woffice' ),
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
                    ),
					'auto_height_featured_image' => array(
						'label' => __( 'Height of featured image of elements', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'fixed',
							'label' => __( 'Fixed', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'auto',
							'label' => __( 'Auto', 'woffice' )
						),
						'value'        => 'fixed',
						'desc' => __('This is the featured image of elements like as blog posts, projects, etc. This option does not work in masonry layout.','woffice')
					),
				)
			),
		)
	)
);