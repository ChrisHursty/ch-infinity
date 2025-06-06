<?php

/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package CH Infinity
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <!-- DNS Prefetch -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <meta name="description" content="<?php echo esc_attr(get_field('meta_description', 'option')); ?>">
    <?php wp_head(); ?>
    
    <?php
    $primary_color = get_field('primary_color', 'option');
    $secondary_color = get_field('secondary_color', 'option');
    $light_primary_color = get_field('light_primary_color', 'option');
    $dark_primary_color = get_field('dark_primary_color', 'option');
    $background_image = get_field('isometric_bg_image', 'option');
    ?>
    <style>
    :root {
        --primary-color: <?php echo esc_attr($primary_color); ?>;
        --secondary-color: <?php echo esc_attr($secondary_color); ?>;
        --light-primary-color: <?php echo esc_attr($light_primary_color); ?>;
        --dark-primary-color: <?php echo esc_attr($dark_primary_color); ?>;
    }
    .iso-bg::before {
        background: url('<?php echo esc_url($background_image); ?>');
        background-size: 8px 8px;
    }
    </style>
</head>

<body <?php body_class(); ?>>
    <?php do_action('wp_body_open'); ?>
    <div class="site" id="page">

        <!-- ******************* The Navbar Area ******************* -->
        <header id="masthead" class="site-header">
            <div class="container">
            <div class="site-branding">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    $default_logo_url = get_template_directory_uri() . '/dist/images/default-header-logo.svg';
                    echo '<a href="' . esc_url(home_url('/')) . '" rel="home"><img src="' . esc_url($default_logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '"></a>';
                }
                ?>
            </div>
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="hamburger fas fa-bars"></span>
                    <span class="screen-reader-text">Open Menu</span>
                </button>
                <nav role="navigation" aria-label="Main menu" id="site-navigation" class="main-navigation">
                    <button class="menu-close fas fa-times"><span class="screen-reader-text">Close Menu</span></button> <!-- Close Button -->
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'menu-list',
                        'container'      => false,
                    ));
                    ?>
                    <!-- Hamburger Socials -->
                    <div class="social-media">
                        <?php
                        if (have_rows('social_profiles', 'option')) {
                            while (have_rows('social_profiles', 'option')) {
                                the_row();
                                $profile_url = get_sub_field('profile_url');
                                $icon_type   = get_sub_field('icon_type');
                                $icon_color  = get_sub_field('icon_color');

                                echo '<a href="' . esc_url($profile_url) . '" style="color:' . esc_attr($icon_color) . ';" target="_blank" rel=noopener noreferrer>';

                                if ($icon_type === 'fontawesome') {
                                    $fontawesome_class = get_sub_field('fontawesome_class');
                                    echo '<i class="fab ' . esc_attr($fontawesome_class) . '"></i>';
                                } else if ($icon_type === 'svg') {
                                    $svg_icon_url = get_sub_field('svg_icon');
                                    echo '<img src="' . esc_url($svg_icon_url) . '" alt="Social Icon" style="fill:' . esc_attr($icon_color) . ';">';
                                }

                                echo '</a>';
                            }
                        }
                        ?>
                    </div>
                </nav>
            </div>
        </header>
        <div class="header-spacer"></div>