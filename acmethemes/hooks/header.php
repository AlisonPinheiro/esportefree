<?php
/**
 * Setting global variables for all theme options saved values
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('supermag_set_global')):

    function supermag_set_global()
    {
        /*Getting saved values start*/
        $supermag_saved_theme_options = supermag_get_theme_options();
        $GLOBALS['supermag_customizer_all_values'] = $supermag_saved_theme_options;
        /*Getting saved values end*/
    }
endif;
add_action('supermag_action_before_head', 'supermag_set_global', 0);

/**
 * Doctype Declaration
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('supermag_doctype')):
    function supermag_doctype()
    {
        ?>
        <!DOCTYPE html>
        <html <?php language_attributes(); ?>>
        <?php
    }
endif;
add_action('supermag_action_before_head', 'supermag_doctype', 10);

/**
 * Code inside head tage but before wp_head funtion
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('supermag_before_wp_head')):

    function supermag_before_wp_head()
    {
        ?>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="<?php echo esc_url('http://gmpg.org/xfn/11') ?>">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php
    }
endif;
add_action('supermag_action_before_wp_head', 'supermag_before_wp_head', 10);

/**
 * Add body class
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('supermag_body_class')):

    function supermag_body_class($supermagbody_classes)
    {
        $supermag_customizer_all_values = supermag_get_theme_options();
        if ('boxed' == $supermag_customizer_all_values['supermag-default-layout']) {
            $supermagbody_classes[] = 'boxed-layout';
        }
        if (1 == $supermag_customizer_all_values['supermag-enable-box-shadow']) {
            $supermagbody_classes[] = 'supermag-enable-box-shadow';
        }

        if ('no-image' == $supermag_customizer_all_values['supermag-blog-archive-layout']) {
            $supermagbody_classes[] = 'blog-no-image';
        }
        if ($supermag_customizer_all_values['supermag-blog-archive-layout'] == 'large-image') {
            $supermagbody_classes[] = 'blog-large-image';
        }
        if ($supermag_customizer_all_values['supermag-single-post-layout'] == 'large-image') {
            $supermagbody_classes[] = 'single-large-image';
        }
        if (1 == $supermag_customizer_all_values['supermag-disable-image-zoom']) {
            $supermagbody_classes[] = 'blog-disable-image-zoom';
        }
        $supermag_header_logo_menu_display_position = $supermag_customizer_all_values['supermag-header-logo-ads-display-position'];
        $supermagbody_classes[] = esc_attr($supermag_header_logo_menu_display_position);

        $supermagbody_classes[] = supermag_sidebar_selection();

        if (1 == $supermag_customizer_all_values['supermag-enable-sticky-sidebar']) {
            $supermagbody_classes[] = 'at-sticky-sidebar';
        }
        return $supermagbody_classes;
    }
endif;
add_action('body_class', 'supermag_body_class', 10, 1);

/**
 * Page start
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */


/**
 * Skip to content
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */

/**
 * Main header
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('supermag_header')):

    function supermag_header()
    {
        $supermag_customizer_all_values = supermag_get_theme_options();
        $supermag_header_media_position = $supermag_customizer_all_values['supermag-header-media-position'];
        if ('very-top' == $supermag_header_media_position) {
            supermag_header_markup();
        }
        ?>
        <header id="masthead" class="site-header" role="banner">
            <div class="header-wrapper container">
                <div class="header-container">
                    <?php
                    if ('above-logo' == $supermag_header_media_position) {
                        supermag_header_markup();
                    }
                    ?>


                    <?php if ('disable' != $supermag_customizer_all_values['supermag-header-id-display-opt']): ?>

                        <?php
                        if ('logo-only' == $supermag_customizer_all_values['supermag-header-id-display-opt']):
                            if (function_exists('the_custom_logo')):
                                the_custom_logo();
                            else:
                                if (!empty($supermag_customizer_all_values['supermag-header-logo'])):
                                    $supermag_header_alt = get_bloginfo('name');
                                    ?>
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <img src="<?php echo esc_url($supermag_customizer_all_values['supermag-header-logo']); ?>"
                                            alt="<?php echo esc_attr($supermag_header_alt); ?>">
                                    </a>
                                    <?php
                                endif; /*supermag-header-logo*/
                            endif;
                        else: /*else is title-only or title-and-tagline*/
                            if (is_front_page() && is_home()): ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                        </h1>
                    <?php else: ?>
                        <p class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                        </p>
                    <?php endif;
                            if ('title-and-tagline' == $supermag_customizer_all_values['supermag-header-id-display-opt']):
                                $description = get_bloginfo('description', 'display');
                                if ($description || is_customize_preview()): ?>
                        <?php endif;
                            endif;
                        endif; ?>
                        <!--site-logo-->
                    <?php endif;

                    ?>



                    <nav id="site-navigation" class="main-navigation " role="navigation">
                        <div class="header-main-menu ">
                            <?php
                            wp_nav_menu(array('theme_location' => 'primary', 'container' => 'div', 'container_class' => 'acmethemes-nav'));

                            echo " <button class='js-toggle-menu header-mobile__button header-mobile__button--close'>
                                <svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' width='50' height='50' viewBox='0 0 50 50'>
                                <path d='M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z'></path>
                                </svg>
                            </button>
                            
                            </div>
                            <div class='header-mobile__overlay js-toggle-menu'></div>";


                            if (isset($supermag_customizer_all_values['supermag-menu-show-search']) && $supermag_customizer_all_values['supermag-menu-show-search'] == 1):

                                $supermag_menu_search_type = $supermag_customizer_all_values['supermag-menu-search-type'];
                                if ('dropdown-search' == $supermag_menu_search_type) {
                                    echo '<a class="fa fa-search icon-menu search-icon-menu" href="#"></a>';
                                    echo "<div class='menu-search-toggle'>";
                                    echo "<div class='menu-search-inner'>";
                                }
                                get_search_form();

                                if ('dropdown-search' == $supermag_menu_search_type) {
                                    echo '</div>'; /*menu-search-inner*/
                                    echo '</div>'; /*menu-search-toggle*/
                                }
                            endif;
                            ?>
                            <button class="js-toggle-menu header-mobile__button">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path d="M2 11H22V13H2zM2 5H22V7H2zM2 17H22V19H2z"></path>
                                </svg>
                            </button>

                        </div>

                    </nav>
                    <!-- #site-navigation -->
                </div>
                <!-- .header-container -->
            </div>
            <!-- header-wrapper-->
        </header>
        <?php
    }
endif;
add_action('supermag_action_header', 'supermag_header', 10);

/**
 * Before main content
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('supermag_before_content')):

    function supermag_before_content()
    {
        ?>
        <main class=" content-wrapper container">
            <?php
            $supermag_customizer_all_values = supermag_get_theme_options();
            $supermag_enable_feature = $supermag_customizer_all_values['supermag-enable-feature'];
            if (is_front_page() && 1 == $supermag_enable_feature) {
                echo '<div class="slider-feature-wrap clearfix">';
                /*Slide*/
                /**
                 * supermag_action_feature_slider
                 * @since SuperMag 1.1.0
                 *
                 * @hooked supermag_feature_slider -  0
                 */
                do_action('supermag_action_feature_slider');

                /*Featured Post Beside Slider*/
                /**
                 * supermag_action_feature_side
                 * @since SuperMag 1.1.0
                 *
                 * @hooked supermag_feature_side-  0
                 */
                do_action('supermag_action_feature_side');
                echo "</div>";
                $supermag_content_id = "home-content";
            } else {
                $supermag_content_id = "content";
            }
            ?>
            <div id="<?php echo esc_attr($supermag_content_id); ?>" class="site-content">
                <?php
                $sidebar_layout = supermag_sidebar_selection(get_the_ID());
                if ('both-sidebar' == $sidebar_layout) {
                    echo '<div id="primary-wrap" class="clearfix">';
                }
                if (1 == $supermag_customizer_all_values['supermag-show-breadcrumb'] && !is_front_page()) {
                    supermag_breadcrumbs();
                }
    }
endif;
add_action('supermag_action_after_header', 'supermag_before_content', 10);