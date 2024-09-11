<?php
/**
 * The template for displaying the footer
 */
?>

<?php
$is_blank_template = woffice_is_current_page_using_blank_template();
?>
<?php // DISPLAY SCROLL
if ( !$is_blank_template ) {
	$sidebar_scroll_inner = woffice_get_settings_option( 'sidebar_scroll_inner' );
	if ( $sidebar_scroll_inner == "yep" ) :
		//echo '<a href="javascript:void(0)" id="can-scroll"><i class="fa fa-angle-double-down"></i></a>';
	endif;
} ?>

<?php
/**
 * Action 'woffice_main_container_end'
 * Used to output content within the #main-content div
 */
do_action( 'woffice_main_container_end' );
?>

</section>
</div>  <!-- END of col-8 -->
<?php // GET SIDEBAR
$sidebar_state      = woffice_get_sidebar_state();
$sidebar_show_class = ( $sidebar_state != 'show' ) ? 'sidebar-hidden' : '';
if ( $sidebar_state == 'show' || $sidebar_state == 'hide' ) :
	get_sidebar();
endif;
?>
</div>  <!-- END row -->
</div>  <!-- END container -->

<div class="row footer_copyright">
    <div class="col-md-12">
        <p class="footer-left">Copyright <?php echo Date( 'Y' ); ?> &copy; V2Soft. All rights reserved</p>
    </div>
    <!-- <div class="col-md-6">
		<p class="footer-right">
			<a href="#">Branding</a> |
			<a href="#">FAQ</a> |
			<a href="#">Privacy Policy</a> |
			<a href="#">TOS</a></p>
	</div> -->
</div>
</div>  <!-- END Wrapper -->
<!-- JAVSCRIPTS BELOW AND FILES LOADED BY WORDPRESS -->
<?php wp_footer(); ?>
<?php echo do_shortcode( '[v2connect-floating-social-icons]' ); ?>
<?php if ( is_user_logged_in() ) : ?>
	<?php if ( is_page( 'my-v2connect' ) ) : ?>
        <div class="floating-tour-btn">
            <button id="web-tour-button" class="webtour-button" data-placement="right" data-toggle="tooltip" title=""
                    data-original-title="Take a website tour">
                        <span>
                            <img src="/wp-content/themes/woffice-child-theme/images/exploration-icon.png">
                        </span>
            </button>
        </div>
	<?php endif; ?>
<?php endif; ?>
<?php

// Check if consent is already provided and disable the button dynamically
if ( is_user_logged_in() && ( stripos( $_SERVER['REQUEST_URI'], "/video-category/offshore-on-boarding" ) !== FALSE ) ) {
	$user         = wp_get_current_user();
	$user_id      = $user->data->ID;
	$user_consent = get_user_meta( $user_id, 'v2c_onboarding_videos_consent' );
	if ( !empty( $user_consent ) ) {
		?>
        <script>
            jQuery("document").ready(function ($) {
                jQuery("button.mega-uae-btn.model-popup-btn").remove();
            });
        </script>
		<?php
	}
}

?>
</body>
<!-- END BODY -->
</html>