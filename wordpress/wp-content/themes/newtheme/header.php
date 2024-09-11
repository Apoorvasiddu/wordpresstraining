<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php bloginfo('name'); ?><?php wp_title('|', true, 'left'); ?></title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <script type="text/javascript">
        var myScriptVars = <?php echo json_encode(array(
            'restUrl' => esc_url_raw(rest_url('custom/v1/')),
            'homeUrl' => esc_url(home_url('/'))
        )); ?>;
        console.log('myScriptVars:', myScriptVars);
    </script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="headerbanner">
    <div class="sticky">
        <header class="site-header">
            <span style="font-size: x-large;font-family: cursive;"> <a href="<?php echo home_url('/welcome/'); ?>"> Learning Application </a></span>
            <span style = "display: flex;">
                <?php if (current_user_can('manage_options')) : ?>
                    <a href="<?php echo esc_url(admin_url('admin-post.php?action=download_employee_skills_csv')); ?>" class="download-link" title="Download Employee Skills">
                        <i class="fa fa-download"></i>
                    </a>
                <?php endif;
                wp_nav_menu(array(
                    'theme_location'  => 'header', // The location in the theme to be used for this menu
                    'menu_class'      => 'headerMenu', // The CSS class for the ul element which forms the menu
                    'container'       => 'nav', // The container element that holds the menu
                    'container_class' => 'headerMenuContainer', // The class that is applied to the container
                    'fallback_cb'     => false, // The function to call if the menu does not exist
                ));
                ?>
            </span>
        </header>
    </div>

    <!-- Rest of your content -->
    
    <?php wp_footer(); ?>
</body>

</html>
