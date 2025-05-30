<?php

/**
 * The header for the markting landing page
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package US Three
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
        background: url('<?php echo esc_url($background_image); ?>') repeat-y top/cover;
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
                <div class="button-box">
                <?php $calendly_code = get_field('calendly_code', 'option');
                    if ($calendly_code) {
                        echo $calendly_code;
                    };?>
                </div>
            </div>
        </header>
        <div class="header-spacer"></div>