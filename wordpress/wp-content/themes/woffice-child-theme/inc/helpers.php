<?php

if ( !function_exists( 'woffice_put_revslider' ) ) {
	/**
	 * Display the HTML markup for the title bar in Woffice pages
	 * It handles features images, BP titles, breadcrumbs, search bars, archives...
	 * @param string $title - the headline title
	 * @return void - the markup
	 */
	function woffice_put_revslider() {
		// The current post slug
		$page_id         = ( is_home() && get_option( 'page_for_posts' ) ) ? get_option( 'page_for_posts' ) : get_the_ID();
		$slider_featured = '';
		if ( ( function_exists( 'bp_is_groups_directory' ) && bp_is_groups_directory() ) || ( function_exists( 'bp_is_members_directory' ) && bp_is_members_directory() ) || ( function_exists( 'bp_is_activity_directory' ) && bp_is_activity_directory() ) || is_page() || is_singular( 'post' ) || ( is_home() && get_option( 'page_for_posts' ) ) ) {

			if ( woffice_bp_is_buddypress() ) {
				$bp_post_id = woffice_get_relative_current_buddypress_page_id();

				if ( $bp_post_id ) {
					$page_id = $bp_post_id;
				}
			}

			$slider_featured = woffice_get_post_option( $page_id, 'revslider_featured' );
		}
		if ( isset( $slider_featured ) && !empty( $slider_featured ) ) {
			echo '<!-- START FEATURED IMAGE AND TITLE -->';
			echo '<header id="featuredbox" class="centered ">';
			if ( function_exists( 'putRevSlider' ) ) {
				putRevSlider( $slider_featured );
			}
			echo '</header>';
		}
		// Quote of the day - Plugin shortcode
		echo do_shortcode( '[cw_daily_quotes]' );
		echo '<div class="go-to-dashboard-page"><a href="my-v2connect"><button class="dashboard-btn">Go To Dashboard <i class="fa fa-arrow-right"></i></button></a></div>';
	}
}

if ( !function_exists( 'woffice_top_navbar' ) ) {
	function woffice_top_navbar() {

		//IF Fixed we add a nav class
		$header_fixed       = woffice_get_settings_option( 'header_fixed' );
		$extra_navbar_class = ( $header_fixed == "yep" ) ? 'has_fixed_navbar' : '';

		$nav_opened_state   = woffice_get_navigation_state();
		$sidebar_state      = woffice_get_sidebar_state();
		$sidebar_show_class = ( $sidebar_state != 'show' ) ? 'sidebar-hidden' : '';

		$is_blank_template    = woffice_is_current_page_using_blank_template();
		$blank_template_class = ( $is_blank_template ) ? 'is-blank-template' : '';

		$hentry_class = apply_filters( 'woffice_hentry_class', 'hentry' );
		// We add a class if the menu is closed by default
		$navigation_hidden_class = woffice_get_navigation_class();

		?>
        <!-- START HEADER -->
		<?php // CHECK FROM OPTIONS
		$header_user       = woffice_get_settings_option( 'header_user' );
		$header_user_class = ( $header_user == "yep" ) ? 'has-user' : 'user-hidden';
		?>

		<!-- user avatar and name display -->
		<?php if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $first_name = $current_user->user_firstname;
                $last_name = $current_user->user_lastname;
                $display_name = $current_user->display_name;
            }
            
            function get_user_photo() {
                if ( !is_user_logged_in() ) return '';
            
                $user = wp_get_current_user();
                $user_id = $user->data->ID;
            
                $photo = get_user_meta( $user_id, 'v2soft_profile_photo_content' );
                if ( !empty( $photo ) ) {
                    $photo_content = $photo[0];
                    return '<img src="data:image/png;base64,' . $photo_content . '" class="user-photo-header" />';
                } else {
                    return '<img src="/wp-content/themes/woffice-child-theme/images/profile-pic.jpg" class="user-photo-header" />';
                }
            }
        ?>
        <div class="profile-name loggedin-user-name">
            <span class="profile-photo loggedin-user-photo"><?php echo get_user_photo(); ?></span>
            <span class="first-name"><?php echo $first_name; ?></span>
        </div>
        <!-- user avatar and name display -->

        <header id="main-header"
                class="<?php echo esc_attr( $navigation_hidden_class ) . ' ' . esc_attr( $header_user_class ) . ' ' . esc_attr( $sidebar_show_class ); ?>">
            <nav class="navbar navbar-expand-lg p-0">
                <div class="navbar-collapse" id="navbarColor02">
                    <div class="stellar-nav-logo">
                        <div id="header-logo-img">
							<?php
							if ( is_user_logged_in() ) {
								$site_url = site_url( '/my-v2connect' );
							} else {
								$site_url = site_url( '/' );
							} ?>
                            <a href="<?php echo $site_url; ?>">
								<?php
								$header_logo = woffice_get_settings_option( 'header_logo' );
								// IF THERE IS A LOGO :
								if ( !empty( $header_logo ) ) :
									echo '<img src="' . esc_url( $header_logo["url"] ) . '" alt="Logo Image">';
								else:
									echo '<img src="' . get_template_directory_uri() . '/images/logo.png" alt="Logo Image">';
								endif; ?>
                            </a>
                        </div>
                    </div>
					<?php // CHECK FROM OPTIONS
					$header_search = woffice_get_settings_option( 'header_search' );
					if ( $header_search == "yep" ) : ?>
                        <!-- START SEARCH CONTAINER - WAITING FOR FIRING -->
						<?php if ( is_user_logged_in() ) { ?>
                            <div id="main-search">
								<?php //GET THE SEARCH FORM
								get_search_form(); ?>
                            </div>
						<?php } ?>
					<?php endif; ?>
                    
                    <ul class="ml-auto mb-0 p-0">
                        <div id="nav-buttons">
							<?php // Notification
							if ( woffice_bp_is_active( 'notifications' ) && is_user_logged_in() ) : ?>
                                <!-- <a href="javascript:void(0)" id="nav-notification-trigger"
                                   title="<?php _e( 'View your notifications', 'woffice' ); ?>"
                                   class="<?php echo ( bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ) >= 1 ) ? "" : "" ?>">
                                    <i class="fa fa-bell"></i>
                                    <span class="count_badge"><?php
										echo _e( bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ) ); ?></span>
                                </a> -->
								<!-- <a href="<?php echo site_url('/members/'. wp_get_current_user()->data->user_nicename . '/messages'); ?>" id="nav-inbox-trigger"
                                   title="<?php _e( 'View your inbox', 'woffice' ); ?>">
                                    <i class="fa fa-envelope"></i>
                                </a> -->
							<?php endif; ?>
							<?php if ( woffice_bp_is_active( 'notifications' ) && is_user_logged_in() ) {
								woffice_notifications_menu();
							} ?>
							<div class="toggle-menu-btn">
								<span></span>
								<span></span>
								<span></span>
							</div>
                            <div class="header-topright-btns">
								<?php echo do_shortcode( '[v2soft-header-nav-btn/]' ); ?>
                            </div>
							<?php // WOOCOMMERCE CART TRIGGER
							/**
							 * You can disable the minicart in the header form there
							 * @param bool
							 */
							$minicart_header_enabled = apply_filters( 'woffice_show_minicart_in_header', TRUE );

							if ( function_exists( 'is_woocommerce' ) && $minicart_header_enabled ) : ?>
								<?php //is cart empty ?
								if ( WC()->cart->get_cart_contents_count() > 0 ) :
									$cart_url_topbar = "javascript:void(0)";
									$cart_classes    = 'active cart-content';
								else :
									$cart_url_topbar = get_permalink( wc_get_page_id( 'shop' ) );
									$cart_classes    = "";
								endif; ?>
                                <a href="<?php echo esc_url( $cart_url_topbar ); ?>"
                                   id="nav-cart-trigger"
                                   title="<?php _e( 'View your shopping cart', 'woffice' ); ?>"
                                   class="<?php echo esc_attr( $cart_classes ); ?>">
                                    <i class="fa fa-shopping-cart"></i>
									<?php echo ( WC()->cart->get_cart_contents_count() > 0 ) ? WC()->cart->get_cart_subtotal() : ''; ?>
                                </a>
							<?php endif; ?>
							<?php // FETCHING SIDEBAR INFO
							if ( $sidebar_state == 'show' || $sidebar_state == 'hide' ) : ?>
                                <!-- SIDEBAR TOGGLE -->
                                <a href="javascript:void(0)" id="nav-sidebar-trigger"><i class="fa fa-arrow-right"></i></a>
							<?php endif; ?>
                        </div>
                    </ul>
                </div>
            </nav>
			<?php // WOOCOMMERCE CART CONTENT
			if ( function_exists( 'is_woocommerce' ) ) {
				Woffice_WooCommerce::print_mini_cart();
			} ?>
			<?php
			/*
			 * We render the alerts
			 */
			woffice_alerts_render(); ?>
        </header>

        <!-- END NAVBAR -->
		<?php
	}
}
