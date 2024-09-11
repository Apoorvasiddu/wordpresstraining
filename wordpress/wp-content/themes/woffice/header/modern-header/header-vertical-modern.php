<?php

    //IF Fixed we add a nav class
    $header_fixed = woffice_get_settings_option('header_fixed');
    $extra_navbar_class = ( $header_fixed == "yep" ) ? 'has_fixed_navbar' :'';

    $nav_opened_state = woffice_get_navigation_state();
    $sidebar_state = woffice_get_sidebar_state();
    $sidebar_show_class = ($sidebar_state != 'show') ? 'sidebar-hidden' : '';

	$is_blank_template = woffice_is_current_page_using_blank_template();
	$blank_template_class = ($is_blank_template) ? 'is-blank-template' : '';
	$navigation_toggle_class = woffice_get_navigation_toggle_class();
    $hentry_class = apply_filters('woffice_hentry_class', 'hentry');
    // We add a class if the menu is closed by default
    $navigation_hidden_class = woffice_get_navigation_class();

	$nav_toggle_class = woffice_get_navigation_toggle_class();
	$content_class = '';
	$main_content_class = woffice_main_content_classes();
	if($nav_toggle_class === 'has-navigation-hidden'){
		$content_class = "col-md-10 col-lg-10";
	}
	$copyright = '';
	if(function_exists('fw')){
		$copyright = woffice_get_settings_option('footer_copyright_content');
	}
?>
		<div id="page-wrapper" <?php echo (!$nav_opened_state) ? 'class="menu-is-closed"':''; ?>>
		<div class="container-fluid"> <!-- Main container start---->
                <div class="row"> <!-- Main row start---->
                    <div class="col-md-3 col-lg-2 is-left-sidebar <?php echo esc_attr($navigation_toggle_class);?>"> <!-- Left col---->
<?php
			/*
             * The header part is removed on the blank template
             */
			if(!$is_blank_template): ?>

                <!-- STARTING THE MAIN NAVIGATION (left side) -->
                <nav id="navigation" class="<?php echo esc_attr($navigation_hidden_class); ?> mobile-hidden">
                <?php // CHECK IF LOGO NEEDS TO BE SHOW
                        $header_logo_hide = woffice_get_settings_option('header_logo_hide');
                        if ($header_logo_hide == false) { ?>
                            <!-- START LOGO -->
                            <div class="stellar-nav-logo">
                                <div id="nav-logo">
                                    <?php
                                    /**
                                    * The url of the logo in the header. By default, returns the home url
                                    *
                                    * @param string $url
                                    */
                                    $logo_link = apply_filters('woffice_logo_link_to', home_url( '/' ) );
                                    ?>

                                    <a href="<?php echo esc_url( $logo_link ); ?>">
                                        <?php
                                        $header_logo = woffice_get_settings_option('header_logo');
                                        // IF THERE IS A LOGO :
                                        if(!empty($header_logo)) :
                                            echo'<img src="'. esc_url($header_logo["url"]) .'" alt="Logo Image">';
                                        else:
                                            echo'<img src="'. get_template_directory_uri() .'/images/logo.png" alt="Logo Image">';
                                        endif; ?>
                                    </a>
                                </div>
                            </div>
                        <?php }
					?>
					<div id="mobile-menu-canvas-close">
						<div class="mobile-canvas-header">
							<button type="button" class="close-navmenu" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
					</div>
					<?php
                    /*
                     * Display the menu
                     */
                    if ( !is_user_logged_in() && has_nav_menu('public')) :
                        $settings_menu_public = array('theme_location' => 'public','menu_class' => 'main-modern-menu', 'menu' => '','container' => '','menu_id' => 'main-modern-menu');
                        wp_nav_menu( $settings_menu_public );
                    else :
                        if ( has_nav_menu('primary') ) :
							$settings_menu_on = array('theme_location' => 'primary','menu_class' => 'main-modern-menu', 'menu' => '','container' => '','menu_id' => 'main-modern-menu');
                            wp_nav_menu( $settings_menu_on );
                        else :
                            wp_page_menu(array('menu_id' => 'main-modern-menu', 'menu_class'  => 'main-modern-menu', 'show_home' => true));
                        endif;
                    endif; ?>
					<div class="footer-copyright">
						<p><?php echo $copyright;?></p>
					</div>
                </nav>
                <!-- END MAIN NAVIGATION -->
				</div> <!--End of left col--->

                <!-- STARTING THE SIDEBAR (right side) + content behind -->
                <?php
                // FETCHING SIDEBAR POSITION
                if ($sidebar_state == "show"){
                    $class = 'with-sidebar';
                } elseif ($sidebar_state == "hide") {
                    /*We need to check if the user has already clicked the button*/
                    if( !isset($_COOKIE['Woffice_sidebar_position']) || ! apply_filters( 'woffice_cookie_sidebar_enabled', false ) ) {
                        $class = 'sidebar-hidden';
                    }
                    else {
                        $class = '';
                    }
                } else {
                    $class = 'full-width';
                }
                ?>

                <!-- START CONTENT -->
				<div class="is-center-content <?php echo esc_attr($content_class) .' ' .esc_attr($main_content_class);?>">
                <section id="main-content" class="<?php echo esc_attr($class) .' '.esc_attr($navigation_hidden_class) .' '. esc_attr($hentry_class); ?>">

			<!-- END SIDEBAR -->
			<!-- END CONTENT -->
    <?php else:

		echo '<section id="main-content" class="full-width navigation-hidden '. esc_attr($hentry_class) .'">';

	endif;
