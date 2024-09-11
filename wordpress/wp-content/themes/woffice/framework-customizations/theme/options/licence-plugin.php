<?php if (!defined('FW')) {
    die('Forbidden');
}

$woffice_wo_cpt = false;
$isinstalled_woffice_cpt = WP_PLUGIN_DIR . '/custom-post-type-support-for-woocommerce/custom-post-type-support-for-woocommerce.php';
$get_db_woffice_cpt_key = fw_get_db_settings_option('woffice_cpt_key');
$woffice_cpt_key = 'woffice_cpt_key';
$woffice_wo_cpt['woffice_wo_cpt_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  ' <div class="woffice-addon-image-wrapper"><a href="https://woffice.io/downloads/custom-post-type-support-for-woocommerce/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/posttypes.png').'"></a></div>',
);
if (class_exists('WofficeCustomPostTypesupportforWooCommerce')) {
    
    $status  = get_option('Woffice_Wo_CPT_license_status');

    $woffice_wo_cpt['woffice_cpt_key'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice_plugin_license woffice-wo-cpt-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button..', 'woffice'),
    );
    $woffice_wo_cpt['woffice_cpt_key_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wo-cpt-activate-button'),
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'woffice_cpt_key\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_wo_cpt['woffice_cpt_key_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wo-cpt-deactivate-button'),
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'woffice_cpt_key\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_wo_cpt['woffice_cpt_key_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-wo-cpt-status'),
        'value' => $status,
    );
} elseif (file_exists($isinstalled_woffice_cpt)) {

    $woffice_wo_cpt['woffice_cpt_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wo-cpt-not-active'),
        'label' => __('Woffice Woo Custom Post Type', 'woffice'),
        'html'  =>  __('Please activate <span class="highlight"> Woffice Woocommerce Custom Post Type</span> to create post product. <a href="../wp-admin/plugins.php">Click Here</a>', 'woffice'),
    );
} else {
    $woffice_wo_cpt['woffice_cpt_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wo-cpt-not-active'),
        'label' => __('Woffice Woo Custom Post Type', 'woffice'),
        'html'  =>  __('Please download <span class="highlight"> Woffice Woocommerce Custom Post Type</span> to create post product. <a class="woffice-propurchase-btn" href="https://woffice.io/downloads/custom-post-type-support-for-woocommerce?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1" target="_blank">Buy Now</a>','woffice'),
    );
}

$woffice_wo_cpt['woffice_cpt_key_activate_message'] = array(
    'type'  => 'hidden',
    'attr'  => array('class' => 'woffice-wo-cpt-activate-message'),
    'value' => '',
    'desc'  => __('Activating..', 'woffice'),
);
$woffice_wo_cpt['woffice_cpt_key_deactivate_message'] = array(
    'type'  => 'hidden',
    'attr'  => array('class' => 'woffice-wo-cpt-deactivate-message'),
    'value' => '',
    'desc'  => __('Deactivating..', 'woffice'),
);
$woffice_wo_cpt['woffice_cpt_loading_extra_message'] = array(
    'type'  => 'hidden',
    'attr'  => array('class' => 'woffice-wo-cpt-activate-message'),
    'value' => '',
    'desc'  => __('This may take a few moments.', 'woffice'),
);

// woofice advaned email
$woffice_advanced_email = false;
$isinstalled_woffice_woae = WP_PLUGIN_DIR . '/woffice-advanced-email/woffice-advanced-email.php';
$get_db_woffice_woae = fw_get_db_settings_option('woffice_woae');
$woffice_wpae_key = 'woffice_woae';
$woffice_advanced_email['woffice_advanced_email_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  ' <div class="woffice-addon-image-wrapper"><a href="https://woffice.io/downloads/woffice-advanced-emails/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/emails.png').'"></a></div>',
);

if (class_exists('WOAE')) {
    
    $woffice_woae_old_status  = get_option('Woffice_woae_license_status');

    if(!empty($woffice_woae_old_status)) {
        $woffice_woae_status = $woffice_woae_old_status;
    } else {
        $woffice_woae_status  = get_option('Woffice_woae_status');
    }

    $woffice_advanced_email['woffice_woae'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-woae-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button.', 'woffice'),
    );
    $woffice_advanced_email['woffice_woae_activate'] = array(
        'type'  => 'html',
        'label' => '',
        'attr'  => array('class' => 'woffice-woae-activate-button'),
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'woffice_woae\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_advanced_email['woffice_woae_deactivate'] = array(
        'type'  => 'html',
        'label' => '',
        'attr'  => array('class' => 'woffice-woae-deactivate-button'),
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'woffice_woae\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_advanced_email['woffice_woae_status'] = array(
        'type'  => 'hidden',
        'label' => '',
        'attr'  => array('class' => 'woffice-woae-status'),
        'value' => $woffice_woae_status,
    );
} elseif (file_exists($isinstalled_woffice_woae)) {

    $woffice_advanced_email['woffice_woae_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-woae-not-active'),
        'label' => __('Woffice Advanced email', 'woffice'),
        'html'  =>  __('Please activate <span class="highlight"> Woffice Advanced Email</span> to create post product. <a href="../wp-admin/plugins.php">Click Here</a>', 'woffice'),
    );
} else {
    $woffice_advanced_email['woffice_woae_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-woae-not-active'),
        'label' => __('Woffice Advanced email;', 'woffice'),
        'html'  =>  __('Please download <span class="highlight"> Woffice Advanced Email</span> to create email template. <a class="woffice-propurchase-btn" href="https://woffice.io/downloads/woffice-advanced-email?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1" target="_blank">Buy Now </a>','woffice'),
    );
}

// woofice subscription
$woffice_subscription = false;
$isinstalled_woffice_wosubscription = WP_PLUGIN_DIR . '/woffice-subscription/woffice-subscription.php';
$get_db_woffice_woae = fw_get_db_settings_option('woffice_wosubscribe_key');
$woffice_wosubscribe_key = 'woffice_wosubscribe_key';
$woffice_subscription['woffice_subscription_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  ' <div class="woffice-addon-image-wrapper"><a href="https://woffice.io/downloads/woffice-subscription/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/subscriptions.png').'"></a></div>',
);
if (class_exists('WOFFICE_SUBSCRIPTION')) {
    
    $woffice_wosubscribe_status  = get_option('Woffice_wosubscribe_license_status');

    $woffice_subscription['woffice_wosubscribe_key'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-wosubscribe-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button.', 'woffice'),
    );
    $woffice_subscription['woffice_wosubscribe_key_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wosubscribe-activate-button'),
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'woffice_wosubscribe_key\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_subscription['woffice_wosubscribe_key_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wosubscribe-deactivate-button'),
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'woffice_wosubscribe_key\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_subscription['woffice_wosubscribe_key_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-wosubscribe-status'),
        'value' => $woffice_wosubscribe_status,
    );
} elseif (file_exists($isinstalled_woffice_wosubscription)) {

    $woffice_subscription['woffice_wosubscribe_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wosubscribe-not-active'),
        'label' => __('Woffice Subscription', 'woffice'),
        'html'  =>  __('Please activate <span class="highlight"> Subscriptions for WooCommerce & Woffice </span> to create post product. <a href="../wp-admin/plugins.php">Click Here</a>', 'woffice'),
    );
} else {
    $woffice_subscription['woffice_wosubscribe_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wosubscribe-not-active'),
        'label' => __('Woffice Subscription', 'woffice'),
        'html'  =>  __('Please download <span class="highlight"> Subscriptions for WooCommerce & Woffice </span> to create email template. <a class="woffice-propurchase-btn" href="https://woffice.io/downloads/woffice-subscription?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1" target="_blank">Buy Now</a>','woffice'),
    );
}

// Woffice HR BUNDLE

$woffice_hr_bundle = false;
$isinstalled_woffice_hr_bundle = WP_PLUGIN_DIR . '/wp-job-manager-stats/wp-job-manager-stats.php';
$get_db_woffice_hr_bundle = fw_get_db_settings_option('woffice_hr_bundle_status');
$woffice_hr_bundle_key = 'wpjm_hr_bundle_key';
$woffice_hr_bundle['woffice_hr_bundle_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  ' <div class="woffice-addon-image-wrapper"><a href="https://woffice.io/downloads/wp-job-manager-hr-bundle/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/hrbundle.png').'"></a></div>',
);
if(function_exists('wpjms_stats') || class_exists('WP_Job_Manager_Company_Listings') || class_exists('WP_Job_Manager_Reviews') || class_exists('AFJ_Auto_Job_Suggest') || function_exists('afj_job_styles_css') || defined('WPJM_LISTING_LABELS_SLUG') || function_exists('astoundify_wpjmlp_get_user_packages') || class_exists('WP_Job_Manager_Products')) {
    $woffice_hr_bundle_status  = get_option('woffice_hr_bundle_status');

    $woffice_hr_bundle['woffice_hr_bundle'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-wpjm-product-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button.', 'woffice'),
    );
    $woffice_hr_bundle['woffice_hr_bundle_file'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-wpjm-product-key-file'),
        'value' => $isinstalled_woffice_hr_bundle,
    );
    $woffice_hr_bundle['woffice_hr_bundle_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wpjm-product-activate-button'),
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'woffice_hr_bundle\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_hr_bundle['woffice_hr_bundle_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wpjm-product-deactivate-button'),
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'woffice_hr_bundle\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_hr_bundle['woffice_hr_bundle_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-product-labels-status'),
        'value' => $woffice_hr_bundle_status,
    );    
} else {
    $woffice_hr_bundle['woffice_hr_bundle_key_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wpjm-product-not-active'),
        'label' => __(' Woffice HR Bundle', 'woffice'),
        'html'  =>  __("Please download <span class='highlight'> Woffice HR Bundle </span> Add to Woffice the Option to handle a complete HR Suite. <a class='woffice-propurchase-btn' href='https://woffice.io/downloads/wp-job-manager-hr-bundle?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1' target='_blank'>Buy Now</a>",'woffice'),
    );
}

// Woffice Kanban

$woffice_wokss_kanban = false;
$isinstalled_wokss_kanban = WP_PLUGIN_DIR . '/woffice-kanban-style-shorting/woffice-kanban-style-shorting.php';
$get_db_woffice_wokss_kanban = fw_get_db_settings_option('wokss_kanban_status');
$woffice_wokss_kanban_key = 'wokss_kanban_key';
$woffice_wokss_kanban['woffice_kanban_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  ' <div><a href="https://woffice.io/downloads/woffice-kanban/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/kanban.png').'"></a></div>',
);

if(class_exists('WOKSS_KANBAN')) {
    $woffice_wokss_kanban_status  = get_option('wokss_kanban_status');

    $woffice_wokss_kanban['wokss_kanban'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-wpjm-product-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button.', 'woffice'),
    );
    $woffice_wokss_kanban['wokss_kanban_file'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-wokss-kanban-key-file'),
        'value' => $isinstalled_wokss_kanban,
    );
    $woffice_wokss_kanban['wokss_kanban_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wokss-kanban-activate-button'),
        'label' => '',
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'wokss_kanban\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_wokss_kanban['wokss_kanban_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wokss-kanban-deactivate-button'),
        'label' => '',
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'wokss_kanban\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_wokss_kanban['wokss_kanban_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-wokss-status'),
        'value' => $woffice_wokss_kanban_status,
    );    
} elseif (file_exists($isinstalled_wokss_kanban)) {

    $woffice_wokss_kanban['wokss_kanban_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wokss-not-active'),
        'label' => __(' Woffice Kanban Style Shorting', 'woffice'),
        'html'  =>  __("Please activate <span class='highlight'> Woffice Kanban Style Shorting </span> Woffice Kanban Style Shorting allows you to short out your Tasks in a better Kanban style view. Have the options to switch at different states and help organize your view better. <a href='../wp-admin/plugins.php'>Click Here</a>", 'woffice'),
    );
} else {
    $woffice_wokss_kanban['wokss_kanban_key_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wokss-not-active'),
        'label' => __(' Woffice Kanban Style Shorting', 'woffice'),
        'html'  =>  __("Please download <span class='highlight'> Woffice Kanban Style Shorting </span> Woffice Kanban Style Shorting allows you to short out your Tasks in a better Kanban style view. Have the options to switch at different states and help organize your view better. <a class='woffice-propurchase-btn' href='https://woffice.io/downloads/woffice-kanban?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1' target='_blank'>Buy Now</a>",'woffice'),
    );
}

// Woffice Woffice Advanced Tasks

$woffice_advanced_tasks = false;
$isinstalled_advanced_tasks_for_woffice = WP_PLUGIN_DIR . '/advanced-tasks-for-woffice/advanced-tasks-for-woffice.php';
$get_db_woffice_advanced_tasks_for_woffice = fw_get_db_settings_option('advanced_tasks_for_woffice');
$woffice_advanced_tasks_for_woffice_key = 'advanced_tasks_for_woffice_key';
$woffice_advanced_tasks['advanced_tasks_for_woffice_image'] = array(
    'type'  => 'html',
    'attr'  => array('class' => 'woffice-timeline-deactivate-button'),
    'label' => '',
    'html'  =>  ' <div class="woffice-addon-image-wrapper"><a href="https://woffice.io/downloads/advanced-tasks-for-woffice/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/advancedtasks.png').'"></a></div>',
);
if(class_exists('Woffice_Advanced_Tasks')) {
    $woffice_advanced_tasks_status  = get_option('advanced_tasks_for_woffice');

    $woffice_advanced_tasks['advanced_tasks_for_woffice'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-wpjm-product-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button.', 'woffice'),
    );
    $woffice_advanced_tasks['advanced_tasks_for_woffice_file'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-wokss-kanban-key-file'),
        'value' => $isinstalled_advanced_tasks_for_woffice,
    );
    $woffice_advanced_tasks['advanced_tasks_for_woffice_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wokss-kanban-activate-button'),
        'label' => '',
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'advanced_tasks_for_woffice\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_advanced_tasks['advanced_tasks_for_woffice_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-advanced-tasks-for-woffice-deactivate-button'),
        'label' => '',
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'advanced_tasks_for_woffice\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_advanced_tasks['advanced_tasks_for_woffice_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-wokss-status'),
        'value' => $woffice_advanced_tasks_status,
    );    
} elseif (file_exists($isinstalled_advanced_tasks_for_woffice)) {

    $woffice_advanced_tasks['advanced_tasks_for_woffice_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wokss-not-active'),
        'label' => __(' Advanced tasks for woffice ', 'woffice'),
        'html'  =>  __("Please activate <span class='highlight'> Advanced tasks for woffice </span> Advanced Tasks for Woffice is a Woffice Plugin that enhance the UI of Woffice tasks and adding more features for the end user. <a href='../wp-admin/plugins.php'>Click Here</a>", 'woffice'),
    );
} else {
    $woffice_advanced_tasks['advanced_tasks_for_woffice_key_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-wokss-not-active'),
        'label' => __(' Advanced tasks for woffice', 'woffice'),
        'html'  =>  __("Please download <span class='highlight'> Advanced tasks for woffice </span> Advanced Tasks for Woffice is a Woffice Plugin that enhance the UI of Woffice tasks and adding more features for the end user. <a class='woffice-propurchase-btn' href='https://woffice.io/downloads/advanced-tasks-for-woffice?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1' target='_blank'>Buy Now</a>",'woffice'),
    );
}
// Woffice docs_to_wiki

$woffice_docs_to_wiki = false;
$isinstalled_docs_to_wiki = WP_PLUGIN_DIR . '/docs-to-wiki/docs-to-wiki.php';
$get_db_woffice_docs_to_wiki = fw_get_db_settings_option('docs_to_wiki_status');
$woffice_docs_to_wiki_key = 'docs_to_wiki_key';
$woffice_docs_to_wiki['docs_to_wiki_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  ' <div class="woffice-addon-image-wrapper"><a href="https://woffice.io/downloads/docs-to-wiki/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/doctowiki.png').'"></a></div>',
);

if(class_exists('docs_to_wiki')) {
    $woffice_docs_to_wiki_status  = get_option('docs_to_wiki_status');

    $woffice_docs_to_wiki['docs_to_wiki'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-wpjm-product-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button.', 'woffice'),
    );
    $woffice_docs_to_wiki['docs_to_wiki_file'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-docs-to-wiki-key-file'),
        'value' => $isinstalled_docs_to_wiki,
    );
    $woffice_docs_to_wiki['docs_to_wiki_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-docs-to-wiki-activate-button'),
        'label' => '',
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'docs_to_wiki\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_docs_to_wiki['docs_to_wiki_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-docs-to-wiki-deactivate-button'),
        'label' => '',
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'docs_to_wiki\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_docs_to_wiki['docs_to_wiki_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-docstowiki-status'),
        'value' => $woffice_docs_to_wiki_status,
    );    
} elseif (file_exists($isinstalled_docs_to_wiki)) {

    $woffice_docs_to_wiki['docs_to_wiki_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-docstowiki-not-active'),
        'label' => __(' Woffice Doc To Wiki', 'woffice'),
        'html'  =>  __("Please activate <span class='highlight'> Woffice Doc To Wiki </span> it allows you to display google doc on your site. <a href='../wp-admin/plugins.php'>Click Here</a>", 'woffice'),
    );
} else {
    $woffice_docs_to_wiki['docs_to_wiki_key_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-docstowiki-not-active'),
        'label' => __(' Woffice Doc To Wiki', 'woffice'),
        'html'  =>  __("Please download <span class='highlight'> Woffice Doc To Wiki </span> it allows you to display google doc on your site. <a class='woffice-propurchase-btn' href='https://woffice.io/downloads/docs-to-wiki?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1' target='_blank'>Buy Now</a>",'woffice'),
    );
}
// Woffice Timeline
$woffice_timeline = false;
$isinstalled_woffice_timeline = WP_PLUGIN_DIR . '/woffice-timeline/woffice-timeline.php';
$get_db_woffice_woffice_timeline = fw_get_db_settings_option('woffice_timeline_status');
$woffice_timeline_key = 'woffice_timeline_key';
$woffice_timeline['woffice_timeline_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  ' <div class="woffice-addon-image-wrapper"><a href="https://woffice.io/downloads/woffice-timeline/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/woffice-timeline.png').'"></a></div>',
);

if(class_exists('Woffice_Timeline')) {
    $woffice_timeline_status  = get_option('woffice_timeline_status');

    $woffice_timeline['woffice_timeline'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-timeline-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button.', 'woffice'),
    );
    $woffice_timeline['woffice_timeline_file'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-timeline-key-file'),
        'value' => $isinstalled_woffice_timeline,
    );
    $woffice_timeline['woffice_timeline_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-timeline-activate-button'),
        'label' => '',
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'woffice_timeline\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_timeline['woffice_timeline_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-timeline-deactivate-button'),
        'label' => '',
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'woffice_timeline\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_timeline['woffice_timeline_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-timeline-status'),
        'value' => $woffice_timeline_status,
    );    
} elseif (file_exists($isinstalled_woffice_timeline)) {

    $woffice_timeline['woffice_timeline_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-timeline-not-active'),
        'label' => __(' Woffice Timeline', 'woffice'),
        'html'  =>  __("Please activate <span class='highlight'> Woffice Timeline </span> it allows you to display google doc on your site. <a href='../wp-admin/plugins.php'>Click Here</a>", 'woffice'),
    );
} else {
    $woffice_timeline['woffice_timeline_key_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-timeline-not-active'),
        'label' => __(' Woffice Timeline', 'woffice'),
        'html'  =>  __("Please download <span class='highlight'> Woffice Timeline </span> it allows you to display google doc on your site. <a class='woffice-propurchase-btn' href='https://woffice.io/downloads/woffice-timeline?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1' target='_blank'>Buy Now</a>",'woffice'),
    );
}

// Woffice Advanced Reporting
$woffice_adreporting = false;
$isinstalled_woffice_adreporting = WP_PLUGIN_DIR . '/woffice-advanced-reporting/woffice-advanced-reporting.php';
$get_db_woffice_woffice_adreporting = fw_get_db_settings_option('woffice_adreporting_status');
$woffice_adreporting_key = 'woffice_adreporting_key';
$woffice_adreporting['woffice_adreporting_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  ' <div class="woffice-addon-image-wrapper"><a href="https://woffice.io/downloads/woffice-advanced-reporting/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/advanced-reporting.png').'"></a></div>',
);

if(class_exists('Woffice_Advanced_Reporting')) {
    $woffice_adreporting_status  = get_option('woffice_adreporting_status');

    $woffice_adreporting['woffice_adreporting'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-adreporting-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button.', 'woffice'),
    );
    $woffice_adreporting['woffice_adreporting_file'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-adreporting-key-file'),
        'value' => $isinstalled_woffice_adreporting,
    );
    $woffice_adreporting['woffice_adreporting_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-adreporting-activate-button'),
        'label' => '',
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'woffice_adreporting\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_adreporting['woffice_adreporting_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-adreporting-deactivate-button'),
        'label' => '',
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'woffice_adreporting\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_adreporting['woffice_adreporting_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-adreporting-status'),
        'value' => $woffice_adreporting_status,
    );    
} elseif (file_exists($isinstalled_woffice_adreporting)) {

    $woffice_adreporting['woffice_adreporting_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-adreporting-not-active'),
        'label' => __('Woffice Advanced Reporting', 'woffice'),
        'html'  =>  __("Please activate <span class='highlight'> Woffice Advanced Reporting </span> allows you to review your Team Performance, Project Status and Total Tasks review. We keep adding new widgets monthly <a href='../wp-admin/plugins.php'>Click Here</a>", 'woffice'),
    );
} else {
    $woffice_adreporting['woffice_adreporting_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-adreporting-not-active'),
        'label' => __('Woffice Advanced Reporting', 'woffice'),
        'html'  =>  __("Please download <span class='highlight'> Woffice Advanced Reporting </span> allows you to review your Team Performance, Project Status and Total Tasks review. We keep adding new widgets monthly <a class='woffice-propurchase-btn' href='https://woffice.io/downloads/woffice-advanced-reporting?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1' target='_blank'>Buy Now</a>",'woffice'),
    );
}

// Woffice Team View
$woffice_team_view = false;
$isinstalled_woffice_team_view = WP_PLUGIN_DIR . '/woffice-team-view/woffice-team-view.php';
$get_db_woffice_woffice_team_view = fw_get_db_settings_option('woffice_tmv_status');
$woffice_team_view_key = 'woffice_tmv_key';
$woffice_team_view['woffice_team_view_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  ' <div class="woffice-addon-image-wrapper"><a href="https://woffice.io/downloads/woffice-team-view/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/woffice-team-view.png').'"></a></div>',
);
if(class_exists('Woffice_Team_View')) {
    $woffice_team_view_status = get_option('woffice_tmv_status');

    $woffice_team_view['woffice_tmv'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-tmv-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button.', 'woffice'),
    );
    $woffice_team_view['woffice_tmvfile'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-tmv-key-file'),
        'value' => $isinstalled_woffice_team_view,
    );
    $woffice_team_view['woffice_tmv_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-tmv-activate-button'),
        'label' => '',
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'woffice_tmv\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_team_view['woffice_tmv_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-tmv-deactivate-button'),
        'label' => '',
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'woffice_tmv\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_team_view['woffice_tmv_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-woffice-tmv-status'),
        'value' => $woffice_team_view_status,
    );    
} elseif (file_exists($isinstalled_woffice_team_view)) {

    $woffice_team_view['woffice_woffice_tmv_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-woffice_tmv-not-active'),
        'label' => __('Woffice Team View', 'woffice'),
        'html'  =>  __("Please activate <span class='highlight'> Woffice Team View </span> allows you to keep a full control of your Team and Manage their Process & Progress. <a href='../wp-admin/plugins.php'>Click Here</a>", 'woffice'),
    );
} else {
    $woffice_team_view['woffice_woffice_tmv_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-woffice_tmv-not-active'),
        'label' => __('Woffice Team View', 'woffice'),
        'html'  =>  __("Please download <span class='highlight'> Woffice Team View </span> allows you to keep a full control of your Team and Manage their Process & Progress. <a class='woffice-propurchase-btn' href='https://woffice.io/downloads/woffice-team-view?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1' target='_blank'>Buy Now</a>",'woffice'),
    );
}
// Woffice Private Messages
$isinstalled_woffice_private_messages = WP_PLUGIN_DIR . '/wp-private-messages/private-messages.php';
$get_db_woffice_woffice_private_messages = fw_get_db_settings_option('woffice_pm_status');
$woffice_private_messages_key = 'woffice_pm_key';
$woffice_private_messages['woffice_private_messages_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  ' <div class="woffice-addon-image-wrapper"><a href="https://woffice.io/downloads/private-messages/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/woffice-private-message.png').'"></a></div>',
);

if(class_exists('Private_Messages')) {
    $woffice_private_messages_status = get_option('woffice_pm_status');

    $woffice_private_messages['woffice_pm'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-pm-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
    );
    
    $woffice_private_messages['woffice_pmfile'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-pm-key-file'),
        'value' => $isinstalled_woffice_private_messages,
    );
    $woffice_private_messages['woffice_pm_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-pm-activate-button'),
        'label' => '',
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'woffice_pm\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_private_messages['woffice_pm_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-pm-deactivate-button'),
        'label' => '',
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'woffice_pm\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_private_messages['woffice_pm_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-woffice-pm-status'),
        'value' => $woffice_private_messages_status,
    );    
} elseif (file_exists($isinstalled_woffice_private_messages)) {

    $woffice_private_messages['woffice_woffice_pm_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-woffice_pm-not-active'),
        'label' => __('Woffice Private Messages', 'woffice'),
        'html'  =>  __("Please activate <span class='highlight'> Woffice Private Messages </span> allows you to keep a full control of your Team and Manage their Process & Progress. <a href='../wp-admin/plugins.php'>Click Here</a>", 'woffice'),
    );
} else {
    $woffice_private_messages['woffice_woffice_pm_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-woffice_pm-not-active'),
        'label' => __('Woffice Private Messages', 'woffice'),
        'html'  =>  __("Please download <span class='highlight'> Woffice Private Messages </span> allows you to keep a full control of your Team and Manage their Process & Progress. <a class='woffice-propurchase-btn' href='https://woffice.io/downloads/private-messages?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1' target='_blank'>Buy Now</a>",'woffice'),
    );
}


// Woffice OKR
$woffice_okr = false;
$isinstalled_woffice_okr = WP_PLUGIN_DIR . '/woffice-okr/woffice-okrs.php';
$get_db_woffice_woffice_okr = fw_get_db_settings_option('woffice_okr_status');
$woffice_okr_key = 'woffice_okr_key';
$woffice_okr['woffice_okr_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  ' <div class="woffice-addon-image-wrapper"><a href="https://woffice.io/downloads/woffice-okr/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/woffice-okr.png').'"></a></div>',
);
if(class_exists('woffice_okr')) {
    $woffice_okr_status = get_option('woffice_okr_status');

    $woffice_okr['woffice_okr'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-okr-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button.', 'woffice'),
    );
    $woffice_okr['woffice_okr_file'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-okr-key-file'),
        'value' => $isinstalled_woffice_okr,
    );
    $woffice_okr['woffice_okr_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-okr-activate-button'),
        'label' => '',
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'woffice_okr\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_okr['woffice_okr_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-okr-deactivate-button'),
        'label' => '',
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'woffice_okr\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_okr['woffice_okr_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-woffice-okr-status'),
        'value' => $woffice_okr_status,
    );    
} elseif (file_exists($isinstalled_woffice_okr)) {

    $woffice_okr['woffice_woffice_okr_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-woffice_okr-not-active'),
        'label' => __('Woffice Team View', 'woffice'),
        'html'  =>   __("Please activate <span class='highlight'> Woffice OKRs </span> allow you to Plan OKRs', Objects and link them with the appropriate tasks. <a href='../wp-admin/plugins.php'>Click Here</a>",'woffice'),
    );
} else {
    $woffice_okr['woffice_woffice_okr_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-woffice_okr-not-active'),
        'label' => __('Woffice Team View', 'woffice'),
        'html'  =>  __("Please download <span class='highlight'> Woffice OKRs </span> allow you to Plan OKRs', Objects and link them with the appropriate tasks. <a class='woffice-propurchase-btn' href='https://woffice.io/downloads/woffice-okr?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1' target='_blank'>Buy Now</a>",'woffice'),
    );
}

// Woffice CRM

$woffice_crm = false;
$isinstalled_woffice_crm = WP_PLUGIN_DIR . '/woffice-crm/woffice-crm.php';
$woffice_crm_key = 'crm_key';
$woffice_crm['woffice_crm_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  '<div><a href="https://woffice.io/downloads/woffice-crm/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/woffice-crm.png').'"></a></div>',
);

if(class_exists('Woffice_CRMS')) {
    $woffice_crm_status  = get_option('woffice_crm_status');

    $woffice_crm['woffice_crm'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-wpjm-product-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button.', 'woffice'),
    );
    $woffice_crm['woffice_crm_file'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-crm-key-file'),
        'value' => $isinstalled_woffice_crm,
    );
    $woffice_crm['woffice_crm_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-crm-activate-button'),
        'label' => '',
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'woffice_crm\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_crm['woffice_crm_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-crm-deactivate-button'),
        'label' => '',
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'woffice_crm\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_crm['woffice_crm_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-crm-status'),
        'value' => $woffice_crm_status,
    );    
} elseif (file_exists($isinstalled_woffice_crm)) {

    $woffice_crm['woffice_crm_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-crm-not-active'),
        'label' => __(' Woffice CRM', 'woffice'),
        'html'  =>  __("Please activate <span class='highlight'> Woffice CRM </span> Woffice CRM is contact relationship management to increase productivity in gaining clients and business relationships. <a href='../wp-admin/plugins.php'>Click Here</a>", 'woffice'),
     );
} else {
    $woffice_crm['woffice_crm_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'crm-not-active'),
        'label' => __(' Woffice CRM', 'woffice'),
        'html'  =>  __("Please download <span class='highlight'> Woffice CRM </span> Woffice CRM is contact relationship management to increase productivity in gaining clients and business relationships. <a class='woffice-propurchase-btn' href='https://woffice.io/downloads/woffice-crm?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1' target='_blank'>Buy Now</a>", 'woffice'),
    );
}

// Woffice CRM Enhancements

$woffice_crm_enhancements = false;
$isinstalled_woffice_crm_enhancements = WP_PLUGIN_DIR . '/woffice-crm-enhancements/woffice-crm-enhancements.php';
$woffice_crm_enhancements_key = 'crm_enhancements_key';
$woffice_crm_enhancements['woffice_crm_enhancements_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  '<div><a href="https://woffice.io/downloads/woffice-crm-enhancements/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/woffice-crm-enhancements.png').'"></a></div>',
);

if(class_exists('Woffice_Crm_Enhancements')) {
    $woffice_crm_enhancements_status  = get_option('woffice_crm_enhancements_status');

    $woffice_crm_enhancements['woffice_crm_enhancements'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-wpjm-product-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button.', 'woffice'),
    );
    $woffice_crm_enhancements['woffice_crm_enhancements_file'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-crm-enhancements-key-file'),
        'value' => $isinstalled_woffice_crm_enhancements,
    );
    $woffice_crm_enhancements['woffice_crm_enhancements_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-crm-enhancements-activate-button'),
        'label' => '',
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'woffice_crm_enhancements\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $woffice_crm_enhancements['woffice_crm_enhancements_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-crm-enhancements-deactivate-button'),
        'label' => '',
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'woffice_crm_enhancements\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $woffice_crm_enhancements['woffice_crm_enhancements_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-crm-enhancements-status'),
        'value' => $woffice_crm_enhancements_status,
    );    
} elseif (file_exists($isinstalled_woffice_crm_enhancements)) {

    $woffice_crm_enhancements['woffice_crm_enhancements_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-crm-enhancements-not-active'),
        'label' => __(' Woffice CRM Enhancements', 'woffice'),
        'html'  =>  __("Please activate <span class='highlight'> Woffice CRM Enhancements</span> Woffice CRM Enhancements is advance version of Woffice CRM plugin which use to increase productivity in gaining clients and business relationships. <a href='../wp-admin/plugins.php'>Click Here</a>", 'woffice'),
    );
} else {
    $woffice_crm_enhancements['woffice_crm_enhancements_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'crm-enhancements-not-active'),
        'label' => __(' Woffice CRM Enhancements', 'woffice'),
        'html'  =>  __("Please download <span class='highlight'> Woffice CRM Enhancements</span> Woffice CRM Enhancements is advance version of Woffice CRM plugin which use to increase productivity in gaining clients and business relationships. <a class='woffice-propurchase-btn' href='https://woffice.io/downloads/woffice-crm-enhancements?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1' target='_blank'>Buy Now</a>", 'woffice'),
    );
}


//  Advance Events

$advanced_events = false;
$isinstalled_advanced_events = WP_PLUGIN_DIR . '/advanced-events/advanced-events.php';
$advanced_events_key = 'advanced_events_key';
$advanced_events['advanced_events_image'] = array(
    'type'  => 'html',
    'label' => '',
    'html'  =>  '<div><a href="https://woffice.io/downloads/advanced-events/" target="_blank"><img class="woffice-addon-image" src="'.esc_url(get_template_directory_uri() .'/images/addons/woffice-advanced-events.png').'"></a></div>',
);

if(class_exists('Advanced_Events')) {
    $advanced_events_status  = get_option('advanced_events_status');

    $advanced_events['advanced_events'] = array(
        'label' => __('Licence Key', 'woffice'),
        'attr'  => array('class' => 'woffice-plugin-license woffice-wpjm-product-active', 'autocomplete' => 'false'),
        'type'         => 'text',
        'value' => '',
        'desc' =>   __('Enter Licence Key. After Activating/Deactivating please click on "Save Changes" Button.', 'woffice'),
    );
    $advanced_events['advanced_events_file'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-advanced-events-key-file'),
        'value' => $isinstalled_advanced_events,
    );
    $advanced_events['advanced_events_activate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-advanced-events-activate-button'),
        'label' => '',
        'desc' =>   __('Click to activate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptLicenceActivate(\'advanced_events\');" class="button-large submit-button-save woffice_licence_activate_btn">Activate</button>',
    );
    $advanced_events['advanced_events_deactivate'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-advanced-events-deactivate-button'),
        'label' => '',
        'desc' =>   __('Click to deactivate licence', 'woffice'),
        'html'  =>  '<button type="button" onclick="WocptDeActivateLicenceKey(\'advanced_events\');" class="button-large submit-button-save woffice_licence_deactivate_btn">Deactivate</button>',
    );
    $advanced_events['advanced_events_status'] = array(
        'type'  => 'hidden',
        'attr'  => array('class' => 'woffice-advanced-events-status'),
        'value' => $advanced_events_status,
    );    
} elseif (file_exists($isinstalled_advanced_events)) {

    $advanced_events['advanced_events_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'woffice-advanced-events-not-active'),
        'label' => __(' Advanced Events', 'woffice'),
        'html'  =>  __("Please activate <span class='highlight'> Advanced Events</span> Advanced Events is plugin help user display the today's tasks and todos on calendar page. Which help user to see current events and todos on calendar page. <a href='../wp-admin/plugins.php'>Click Here</a>", 'woffice'),
    );
} else {
    $advanced_events['advanced_events_message_key'] = array(
        'type'  => 'html',
        'attr'  => array('class' => 'advanced-events-not-active'),
        'label' => __('Advanced Events', 'woffice'),
        'html'  =>  __("Please download <span class='highlight'> Advanced Events</span> Advanced Events is plugin help user display the today's tasks and todos on calendar page. Which help user to see current events and todos on calendar page. <a class='woffice-propurchase-btn' href='https://woffice.io/downloads/advanced-events?utm_source=themeforest&utm_medium=theme-settings&utm_campaign=promo-theme&utm_id=1' target='_blank'>Buy Now</a>", 'woffice'),
    );
}

$options = array(
    'plugin-licence' => array(
        'title'   => __('Plugins', 'woffice'),
        'type'    => 'tab',
        'options' => array(
            'advanced-events-box' => array(
                'title'   => __('Advanced Events', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $advanced_events,
                )
            ),
            'woffice-crm-enhancements-box' => array(
                'title'   => __('Woffice CRM Enhancements', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_crm_enhancements,
                )
            ),
            'woffice-crm-box' => array(
                'title'   => __('Woffice CRM', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_crm,
                )
            ),
            'woffice-okr-box' => array(
                'title'   => __('Woffice OKRs', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_okr,
                )
            ),
            'woffice-private-messages-box' => array(
                'title'   => __('Woffice Private Messages', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_private_messages,
                )
            ),
			'woffice-team-view-box' => array(
                'title'   => __('Woffice Team View', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_team_view,
                )
            ),
            'woffice-adreporting-box' => array(
                'title'   => __('Woffice Advanced Reporting', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_adreporting,
                )
            ),
            'woffice-timeline-box' => array(
                'title'   => __('Woffice Timeline', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_timeline,
                )
            ),
            'woffice-docs-to-wiki-box' => array(
                'title'   => __('Woffice Docs To Wiki', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_docs_to_wiki,
                )
            ),
            'woffice-advanced-task-box' => array(
                'title'   => __('Advanced Tasks For Woffice', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_advanced_tasks,
                )
            ),
            'woffice-wokss-kanban-box' => array(
                'title'   => __('Woffice Kanban Style Shorting', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_wokss_kanban,
                )
            ),
            'woffice-plugins-box' => array(
                'title'   => __('Woo Custom Post Type Manager', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_wo_cpt,
                )
            ),
            'woffice-woae-box' => array(
                'title'   => __('Woffice Advanced Email', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_advanced_email,
                )
            ),
            'woffice-wosubscribe-box' => array(
                'title'   => __('Subscriptions for WooCommerce & Woffice', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_subscription,
                )
            ),
            'woffice-hr-bundle-box' => array(
                'title'   => __('Woffice HR Bundle', 'woffice'),
                'type'    => 'box',
                'options' => array(
                    $woffice_hr_bundle,
                )
            ),
        )
    )
);