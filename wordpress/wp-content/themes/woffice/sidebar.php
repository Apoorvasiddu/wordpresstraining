<?php
/**
 * The Content Sidebar
 */
$class = "";
if( isset($_COOKIE['Woffice_hassidebar_position']) && $_COOKIE['Woffice_hassidebar_position'] === 'has-sidebar-hidden' || apply_filters( 'Woffice_hassidebar_position', false ) ) {
   $class = 'has-sidebar-hidden';
}
?>
    <div class="col-md-3 col-lg-2 is-right-sidebar <?php echo esc_attr($class);?>">
	<!-- RIGHT SIDE -> SIDEBAR-->
	<aside id="right-sidebar" role="complementary">
    <?php
                            // CHECK FROM OPTIONS
    $header_user = woffice_get_settings_option('header_user');
    if (is_user_logged_in()) :
        if ($header_user == "yep") : ?>
            <div class="container sidebar-userinfo">
                <div id="mobile-menu-canvas-close">
                    <div class="mobile-canvas-header">
                        <button type="button" class="close-navmenu" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 p-0">
                        <a href="javascript:void(0);" id="user-thumb">
                            <?php // GET CURRENT USER ID
                                $user_ID = get_current_user_id();
                                echo get_avatar($user_ID);
                            ?>
                        </a>
                    </div>
                    <div class="col-md-9 user-infodetail">
                        <?php
                            $name_to_display = woffice_get_name_to_display();
                            $user_info = get_userdata($user_ID);
                            $user_email = $user_info->user_email;
                        ?>
                        <h5 class="mb-0 user-name"><?php  echo $name_to_display; ?></h5>
                        <small class="user-email"><?php  echo $user_email; ?></small>
                        <span class="user-profile-trigger">
                            <a href="javascript:void(0)"><i class="fa fa-angle-down"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div id="nav-user" class="clearfix <?php echo (function_exists('bp_is_active')) ? 'bp_is_active' : ''; ?>">
                <a href="<?php echo wp_logout_url() ?>" id="user-login"><i class="fa fa-sign-out-alt"></i></a>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <div id="nav-user" class="clearfix <?php echo (function_exists('bp_is_active')) ? 'bp_is_active' : ''; ?>">
            <?php // SHOW LOGIN BUTTON
            $header_login = woffice_get_settings_option('header_login');
            if (!empty($header_login) && $header_login == "yep") {
                echo '<a href="'.wp_login_url().'" id="user-login"><i class="fa fa-sign-in-alt"></i></a>';
            } ?>
        </div>
    <?php endif; ?>
		<?php
        /**
         * You can override the slug of the sidebar loaded
         *
         * @param string $slug
         */
        $sidebar_slug = apply_filters('woffice_override_content_sidebar', 'content');

        dynamic_sidebar( $sidebar_slug ); ?>

	</aside>
    <?php // CHECK FROM OPTIONS
        $header_user = woffice_get_settings_option('header_user');
        if ($header_user == "yep" && function_exists('bp_is_active')) :
            woffice_user_sidebar();
        endif; 
    ?>
</div> <!---End of right side--->