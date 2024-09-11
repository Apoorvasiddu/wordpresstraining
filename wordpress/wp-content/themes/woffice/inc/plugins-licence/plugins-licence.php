<?php
if (!defined('FW')) {
	die('Forbidden');
}

if (!class_exists('WofficePluginsLicence')) :

	class WofficePluginsLicence
	{

		protected static $_instance = null;

		public static function instance()
		{
			if (is_null(self::$_instance)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function __construct()
		{
			add_action('admin_enqueue_scripts', array($this, 'woffice_related_script'));
			add_action('wp_ajax_woffice_plugins_licence_activate', array($this, 'woffice_plugins_licence_activate'));
			add_action('wp_ajax_nopriv_woffice_plugins_licence_activate', array($this, 'woffice_plugins_licence_activate'));
			add_action('wp_ajax_woffice_plugins_licence_deactivate', array($this, 'woffice_plugins_licence_deactivate'));
			add_action('wp_ajax_nopriv_woffice_plugins_licence_deactivate', array($this, 'woffice_plugins_licence_deactivate'));
		}
		public function woffice_related_script($hook)
		{
			wp_enqueue_script('woffice-licence-plugins-js',  get_template_directory_uri() . '/js/licence-plugins.min.js', array('jquery'));
			wp_localize_script('woffice-licence-plugins-js', 'licencedata', array('ajax_url' => admin_url('admin-ajax.php'),'nonce' => wp_create_nonce('license-nonce')));
		}

		/**
		 * Activate licence Ajax
		 *
		 */
		public function woffice_plugins_licence_activate()
		{

			if ( !wp_verify_nonce( $_POST['nonce'], 'license-nonce' ) ) {
				die( __('Sorry! Direct Access is not allowed.', "woffice"));
			}
			
			$plugins_key =	$_POST['plugins_key'];
			$plugins_slug =	$_POST['plugins_slug'];
			if ($plugins_slug) {
				switch ($plugins_slug) {

					case 'woffice_cpt_key':

						$get_db_woffice_cpt_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_cpt_key) {
							$license = trim($get_db_woffice_cpt_key);
							$Woffice_Wo_CPT_License = new Woffice_Wo_CPT_License();
							// data to send in our API request
							$wocpt_licence_deactivate = $Woffice_Wo_CPT_License->wocpt_licence_activate($license);
							woffice_echo_output($wocpt_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the activate.', 'woffice');
							$response = array("type" => 'success', 'message' => $message, 'license_data' => $license_data,"plugins_slug" => 'woffice_cpt_key');
							echo json_encode($response);
							exit();
						}
						break;
						
					case 'woffice_woae':

						$get_db_woffice_woae_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_woae_key) {
							$license = trim($get_db_woffice_woae_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_woae_License = new Plugin_Item_Activator();
							$woffice_woae_licence_activate = $woffice_woae_License->licence_activate();
							woffice_echo_output($woffice_woae_licence_activate);
							exit();
						} else {
							$message = __('New licence key must be save before the activate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_wosubscribe_key':

						$get_db_woffice_wosubscribe_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_wosubscribe_key) {
							$license = trim($get_db_woffice_wosubscribe_key);
							$Woffice_wosubscribe_License = new Woffice_Wosubscribe_License();
							// data to send in our API request
							$wosubscribe_licence_deactivate = $Woffice_wosubscribe_License->wowcps_licence_activate($license);
							woffice_echo_output($wosubscribe_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the activate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;

					case 'woffice_hr_bundle':
						$get_db_wpjm_stat_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_wpjm_stat_key) {
							$license = trim($get_db_wpjm_stat_key);
							update_option($plugins_slug,$plugins_key);
							$Woffice_wpjm_stat_License = new Plugin_Item_Activator();
							$wpjm_stat_activate = $Woffice_wpjm_stat_License->licence_activate();
							woffice_echo_output($wpjm_stat_licence_activate);
							exit();
						} else {
							$message = __('New licence key must be save before the activate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'wokss_kanban':
						$get_db_wokss_kanban_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_wokss_kanban_key) {
							$license = trim($get_db_wokss_kanban_key);
							update_option($plugins_slug,$plugins_key);
							$Woffice_wokss_kanban_License = new Plugin_Item_Activator();
							$wokss_kanban_licence_activate = $Woffice_wokss_kanban_License->licence_activate();
							woffice_echo_output($wokss_kanban_licence_activate);
							exit();
						} else {
							$message = __('New licence key must be save before the activate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;

					case 'advanced_tasks_for_woffice':
						$get_db_advanced_tasks_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_advanced_tasks_key) {
							$license = trim($get_db_advanced_tasks_key);
							update_option($plugins_slug,$plugins_key);
							$Woffice_advanced_tasks_License = new Plugin_Item_Activator();
							$wokss_advanced_tasks_activate = $Woffice_advanced_tasks_License->licence_activate();
							woffice_echo_output($wokss_advanced_tasks_activate);
							exit();
						} else {
							$message = __('New licence key must be save before the activate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'docs_to_wiki':
						$get_db_docs_to_wiki_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_docs_to_wiki_key) {
							$license = trim($get_db_docs_to_wiki_key);
							update_option($plugins_slug,$plugins_key);
							$Woffice_docs_to_wiki_License = new Plugin_Item_Activator();
							$docs_to_wiki_licence_activate = $Woffice_docs_to_wiki_License->licence_activate();
							woffice_echo_output($docs_to_wiki_licence_activate);
							exit();
						} else {
							$message = __('New licence key must be save before the activate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_timeline':
						$get_db_woffice_timeline_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_timeline_key) {
							$license = trim($get_db_woffice_timeline_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_timeline_License = new Plugin_Item_Activator();
							$woffice_timeline_licence_activate = $woffice_timeline_License->licence_activate();
							woffice_echo_output($woffice_timeline_licence_activate);
							exit();
						} else {
							$message = __('New licence key must be save before the activate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_adreporting':
						$get_db_woffice_adreporting_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_adreporting_key) {
							$license = trim($get_db_woffice_adreporting_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_adreporting_License = new Plugin_Item_Activator();
							$woffice_adreporting_licence_activate = $woffice_adreporting_License->licence_activate();
							woffice_echo_output($woffice_adreporting_licence_activate);
							exit();
						} else {
							$message = __('New licence key must be save before the activate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_tmv':
						$get_db_woffice_tmv_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_tmv_key) {
							$license = trim($get_db_woffice_tmv_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_tmv_License = new Plugin_Item_Activator();
							$woffice_tmv_licence_activate = $woffice_tmv_License->licence_activate();
							woffice_echo_output($woffice_tmv_licence_activate);
							exit();
						} else {
							$message = __('New licence key must be save before the activate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_pm':
						$get_db_woffice_pm_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_pm_key) {
							$license = trim($get_db_woffice_pm_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_pm_License = new Plugin_Item_Activator();
							$woffice_pm_licence_activate = $woffice_pm_License->licence_activate();
							woffice_echo_output($woffice_pm_licence_activate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_okr':
						$get_db_woffice_okr_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_okr_key) {
							$license = trim($get_db_woffice_okr_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_okr_License = new Plugin_Item_Activator();
							$woffice_okr_licence_activate = $woffice_okr_License->licence_activate();
							woffice_echo_output($woffice_okr_licence_activate);
							exit();
						} else {
							$message = __('New licence key must be save before the activate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_crm':
						$get_db_woffice_crm_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_crm_key) {
							$license = trim($get_db_woffice_crm_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_crm_License = new Plugin_Item_Activator();
							$woffice_crm_licence_activate = $woffice_crm_License->licence_activate();
							woffice_echo_output($woffice_crm_licence_activate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_crm_enhancements':
						$get_db_woffice_crm_enhancements_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_crm_enhancements_key) {
							$license = trim($get_db_woffice_crm_enhancements_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_crm_enhancements_License = new Plugin_Item_Activator();
							$woffice_crm_enhancements_licence_activate = $woffice_crm_enhancements_License->licence_activate();
							woffice_echo_output($woffice_crm_enhancements_licence_activate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'advanced_events':
						$get_db_woffice_advanced_events_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_advanced_events_key) {
							$license = trim($get_db_woffice_advanced_events_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_advanced_events_License = new Plugin_Item_Activator();
							$woffice_advanced_events_licence_activate = $woffice_advanced_events_License->licence_activate();
							woffice_echo_output($woffice_advanced_events_licence_activate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					default:

						$message = __('An error occurred, please try again.', 'woffice');
						break;
				}
				
			} else {
				$response = array("type" => 'unsuccessful', 'message' => 'Slug Missing', 'license_data' => '');
				echo json_encode($response);
				exit();
			}
		}
		/**
		 * Deactivate licence Ajax
		 *
		 */
		public function woffice_plugins_licence_deactivate()
		{
			if ( !wp_verify_nonce( $_POST['nonce'], 'license-nonce' ) ) {
				die( __('Sorry! Direct Access is not allowed.', "woffice"));
			}

			$plugins_key =	$_POST['plugins_key'];
			$plugins_slug =	$_POST['plugins_slug'];
			
			if ($plugins_slug) {
				switch ($plugins_slug) {

					case 'woffice_cpt_key':

						$get_db_woffice_cpt_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_cpt_key) {
							$license = trim($get_db_woffice_cpt_key);
							$Woffice_Wo_CPT_License = new Woffice_Wo_CPT_License();
							// data to send in our API request
							$wocpt_licence_deactivate = $Woffice_Wo_CPT_License->wocpt_licence_deactivate($license);
							woffice_echo_output($wocpt_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '',"plugins_slug" => 'woffice_cpt_key');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_woae':

						$get_db_woffice_woae_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_woae_key) {
							$license = trim($get_db_woffice_woae_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_woae_License = new Plugin_Item_Activator();
							$woffice_woae_licence_deactivate = $woffice_woae_License->licence_deactivate();
							woffice_echo_output($woffice_woae_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_wosubscribe_key':

						$get_db_woffice_wosubscribe_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_wosubscribe_key) {
							$license = trim($get_db_woffice_wosubscribe_key);
							$Woffice_wosubscribe_License = new Woffice_Wosubscribe_License();
							// data to send in our API request
							$wosubscribe_licence_deactivate = $Woffice_wosubscribe_License->wowcps_licence_deactivate($license);
							woffice_echo_output($wosubscribe_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_hr_bundle':
						$get_db_wpjm_stat_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_wpjm_stat_key) {
							$license = trim($get_db_wpjm_stat_key);
							update_option($plugins_slug,$plugins_key);
							$Woffice_wpjm_stat_License = new Plugin_Item_Activator();
							$wpjm_stat_licence_deactivate = $Woffice_wpjm_stat_License->licence_deactivate();
							woffice_echo_output($wpjm_stat_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'wokss_kanban':
						$get_db_wokss_kanban_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_wokss_kanban_key) {
							$license = trim($get_db_wokss_kanban_key);
							update_option($plugins_slug,$plugins_key);
							$Woffice_wokss_kanban_License = new Plugin_Item_Activator();
							$wokss_kanban_licence_deactivate = $Woffice_wokss_kanban_License->licence_deactivate();
							woffice_echo_output($wokss_kanban_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'advanced_tasks_for_woffice':
						$get_db_advanced_tasks_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_advanced_tasks_key) {
							$license = trim($get_db_advanced_tasks_key);
							update_option($plugins_slug,$plugins_key);
							$Woffice_advanced_tasks_License = new Plugin_Item_Activator();
							$advanced_tasks_licence_deactivate = $Woffice_advanced_tasks_License->licence_deactivate();
							woffice_echo_output($advanced_tasks_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'docs_to_wiki':
						$get_docs_to_wiki_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_docs_to_wiki_key) {
							$license = trim($get_docs_to_wiki_key);
							update_option($plugins_slug,$plugins_key);
							$Woffice_docs_to_wiki_License = new Plugin_Item_Activator();
							$docs_to_wiki_licence_deactivate = $Woffice_docs_to_wiki_License->licence_deactivate();
							woffice_echo_output($docs_to_wiki_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_timeline':
						$get_db_woffice_timeline_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_timeline_key) {
							$license = trim($get_db_woffice_timeline_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_timeline_License = new Plugin_Item_Activator();
							$woffice_timeline_licence_deactivate = $woffice_timeline_License->licence_deactivate();
							woffice_echo_output($woffice_timeline_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_adreporting':
						$get_db_woffice_adreporting_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_adreporting_key) {
							$license = trim($get_db_woffice_adreporting_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_adreporting_License = new Plugin_Item_Activator();
							$woffice_adreporting_licence_deactivate = $woffice_adreporting_License->licence_deactivate();
							woffice_echo_output($woffice_adreporting_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_tmv':
						$get_db_woffice_tmv_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_tmv_key) {
							$license = trim($get_db_woffice_tmv_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_tmv_License = new Plugin_Item_Activator();
							$woffice_tmv_licence_deactivate = $woffice_tmv_License->licence_deactivate();
							woffice_echo_output($woffice_tmv_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_pm':
						$get_db_woffice_pm_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_pm_key) {
							$license = trim($get_db_woffice_pm_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_pm_License = new Plugin_Item_Activator();
							$woffice_pm_licence_deactivate = $woffice_pm_License->licence_deactivate();
							woffice_echo_output($woffice_pm_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_okr':
						$get_db_woffice_okr_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_okr_key) {
							$license = trim($get_db_woffice_okr_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_okr_License = new Plugin_Item_Activator();
							$woffice_okr_licence_deactivate = $woffice_okr_License->licence_deactivate();
							woffice_echo_output($woffice_okr_licence_deactivate);
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_crm':
						$get_db_woffice_crm_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_crm_key) {
							$license = trim($get_db_woffice_crm_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_crm_License = new Plugin_Item_Activator();
							$woffice_crm_licence_deactivate = $woffice_crm_License->licence_deactivate();
							woffice_echo_output($woffice_crm_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					case 'woffice_crm_enhancements':
						$get_db_woffice_crm_enhancements_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_crm_enhancements_key) {
							$license = trim($get_db_woffice_crm_enhancements_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_crm_enhancements_License = new Plugin_Item_Activator();
							$woffice_crm_enhancements_licence_deactivate = $woffice_crm_enhancements_License->licence_deactivate();
							woffice_echo_output($woffice_crm_enhancements_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
										
					case 'advanced_events':
						$get_db_woffice_advanced_events_key = fw_get_db_settings_option($plugins_slug);
						if ($plugins_key == $get_db_woffice_advanced_events_key) {
							$license = trim($get_db_woffice_advanced_events_key);
							update_option($plugins_slug,$plugins_key);
							$woffice_advanced_events_License = new Plugin_Item_Activator();
							$woffice_advanced_events_licence_deactivate = $woffice_advanced_events_License->licence_deactivate();
							woffice_echo_output($woffice_advanced_events_licence_deactivate);
							exit();
						} else {
							$message = __('New licence key must be save before the deactivate.', 'woffice');
							$response = array("type" => 'unsuccessful', 'message' => $message, 'license_data' => '');
							echo json_encode($response);
							exit();
						}
						break;
					default:
						$message = __('An error occurred, please try again.', 'woffice');
						break;
				}
			} else {
				$response = array("type" => 'unsuccessful', 'message' => 'Slug Missing', 'license_data' => '');
				echo json_encode($response);
				exit();
			}
		}
	}
endif;

function WOFFICERELATED()
{
	return WofficePluginsLicence::instance();
}

WOFFICERELATED();
