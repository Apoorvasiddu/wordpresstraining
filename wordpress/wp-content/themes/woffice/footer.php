<?php
/**
 * The template for displaying the footer
 */
?>
				
<?php
$is_blank_template = woffice_is_current_page_using_blank_template();
?>
				<?php // DISPLAY SCROLL
				if(!$is_blank_template) {
					$sidebar_scroll_inner = woffice_get_settings_option( 'sidebar_scroll_inner' );
					if ( $sidebar_scroll_inner == "yep" ) :
						//echo '<a href="javascript:void(0)" id="can-scroll"><i class="fa fa-angle-double-down"></i></a>';
					endif;
				}?>

            <?php
            /**
             * Action 'woffice_main_container_end'
             *
             * Used to output content within the #main-content div
             *
             */
            do_action('woffice_main_container_end');
            ?>
			
			</section>
			</div>  <!-- END of col-8 -->
				<?php // GET SIDEBAR
					$sidebar_state = woffice_get_sidebar_state();
					$sidebar_show_class = ($sidebar_state != 'show') ? 'sidebar-hidden' : '';	
					if($sidebar_state == 'show' || $sidebar_state == 'hide') :
						get_sidebar();
					endif; 
				?>
			</div>  <!-- END row -->
			</div>  <!-- END container -->
		</div>  <!-- END Wrapper -->
		<!-- JAVSCRIPTS BELOW AND FILES LOADED BY WORDPRESS -->
		<?php wp_footer(); ?>
	</body>
	<!-- END BODY -->
</html>