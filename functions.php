<?php
/**
 * US Three functions and definitions
 *
 * @package US Three
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Customizer
require_once get_template_directory() . '/inc/theme-customizer.php';
// Theme Options
require_once get_template_directory() . '/inc/theme-options.php';
// Custom Post Types
require_once get_template_directory() . '/inc/cpts.php';
// Widgets
require get_template_directory() . '/inc/widgets.php';
// Navwalker
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

function us_three_theme_setup() {
    // Add theme support for Automatic Feed Links
    add_theme_support( 'automatic-feed-links' );

    // Add theme support for Post Thumbnails
    add_theme_support( 'post-thumbnails' );

    // Register Navigation Menu
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'us-three' ),
    ) );

    // Add theme support for HTML5 and Title Tag
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'custom-fields' ) );
    add_theme_support( 'title-tag' );

    // Custom Logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    add_image_size('portfolio_slider', 810, 810, true); // true for hard crop mode
}

add_action('after_setup_theme', 'us_three_theme_setup');

/**
 * Enqueue scripts and styles.
 */
function us_three_scripts_styles() {
    // Enqueue Owl Carousel & Magnific Popup Stuff
    wp_enqueue_style('owl-carousel-css', get_template_directory_uri() . '/library/owl-carousel/css/owl.carousel.min.css');
    wp_enqueue_style('magnific-popup-css', get_template_directory_uri() . '/library/magnific-popup/magnific-popup.css');
    wp_enqueue_style('owl-carousel-theme', get_template_directory_uri() . '/library/owl-carousel/css/owl.theme.default.min.css');
    wp_enqueue_script('magnific-popup-js', get_template_directory_uri() . '/library/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), null, true);
    wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/library/owl-carousel/js/owl.carousel.min.js', array('jquery'), '2.3.4', true);
    
    // FontAwesome
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/library/font-awesome/font-awesome-5-15-4l.min.css');

    // Theme CSS
    wp_enqueue_style( 'us-three-style', get_template_directory_uri() . '/dist/css/main.min.css', array(), '1.0.0', 'all');

    // Theme JS
    wp_enqueue_script('us-three-main-js', get_template_directory_uri() . '/dist/js/main.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('chris-hurst-smart-header-js', get_template_directory_uri() . '/dist/js/smart-header.min.js', array(), '1.0.0', true);

    // Check if we are on a single post or the single-portfolio.php template
    if (is_single() && (is_singular('post') || is_singular('portfolio'))) {
        // Enqueue the progress-bar.js script
        wp_enqueue_script('my-progress-bar', get_template_directory_uri() . '/dist/js/progress-bar.min.js', array(), '1.0.0', true);
    }

    if (is_singular('portfolio')) {
        wp_enqueue_script('single-portfolio-js', get_template_directory_uri() . '/js/single-portfolio.js', array('jquery', 'owl-carousel-js', 'magnific-popup-js'), '1.0.0', true);
    }
    // Register and Enqueue a Script
    // wp_enqueue_script( 'us-three-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20201208', true );
}

add_action( 'wp_enqueue_scripts', 'us_three_scripts_styles' );

function us_three_admin_styles() {
    wp_enqueue_style('us-three-admin-styles', get_template_directory_uri() . '/dist/css/admin-styles.min.css');
    wp_enqueue_media();
    wp_enqueue_script('portfolio-thumbnail-uploader', get_template_directory_uri() . '/dist/js/portfolio-thumbnail-uploader.min.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'us_three_admin_styles');


// SVG upload compatibility
function custom_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'custom_mime_types');
  
function fix_svg_thumb_display() {
    echo '
      <style>
        td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {
          width: 100% !important;
          height: auto !important;
        }
      </style>
    ';
}
add_action('admin_head', 'fix_svg_thumb_display');

// Customizer CSS
function ccs_custom_css() {
  $hero_btn_bg_color   = get_theme_mod('hero_button_bg_color');
  $hero_btn_text_color = get_theme_mod('hero_button_text_color');
  $cta_btn_bg_color    = get_theme_mod('button_background_color');
  $cta_btn_text_color  = get_theme_mod('button_text_color');
  // ... any other theme_mod values
 
  $custom_css = "
      /* Customizer CSS */
      .hero-button {
          background-color: $hero_btn_bg_color !important;
          border: 1px solid $hero_btn_bg_color !important;
      }

      .hero-button span {
          color: $hero_btn_text_color !important;
      }

      .hero-button:hover {
          background-color: $hero_btn_text_color !important;
          border: 1px solid $hero_btn_text_color !important;
      }

      .hero-button:hover span {
          color: $hero_btn_bg_color !important;
      }

      .cta-button:hover {
          background-color: $cta_btn_text_color !important;
      }
      .cta-button:hover span {
          color: $cta_btn_bg_color !important;
      }
      /* ... any other custom CSS */
  ";

  wp_add_inline_style( 'ccs-customizer-css', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'ccs_custom_css', 20 );

function ccs_enqueue_scripts_and_styles() {
  wp_enqueue_style( 'ccs-customizer-css', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'ccs_enqueue_scripts_and_styles' );

add_filter('acf/settings/remove_wp_meta_box', '__return_false');

// Custom Image for Portfolio Grid
function us_three_add_portfolio_thumbnail_meta_box() {
    add_meta_box(
        'portfolio_thumbnail_meta_box', // ID of the meta box
        __('Portfolio Thumbnail Image', 'textdomain'), // Title of the meta box
        'us_three_portfolio_thumbnail_meta_box_html', // Callback function to display the meta box
        'portfolio', // Post type
        'side', // Context ('normal', 'side', and 'advanced')
        'low' // Priority
    );
}

add_action('add_meta_boxes', 'us_three_add_portfolio_thumbnail_meta_box');

function us_three_portfolio_thumbnail_meta_box_html($post) {
    $thumbnail_id = get_post_meta($post->ID, '_portfolio_thumbnail_id', true);
    echo '<input type="hidden" id="portfolio_thumbnail_id" name="portfolio_thumbnail_id" value="' . esc_attr($thumbnail_id) . '">';
    echo '<button id="portfolio_thumbnail_button" class="button">' . __('Select Image', 'textdomain') . '</button>';
    echo '<p class="description">' . __('Select an image for the portfolio thumbnail.', 'textdomain') . '</p>';
    // Display the image preview
    if ($thumbnail_id) {
        echo wp_get_attachment_image($thumbnail_id, 'thumbnail');
    }
    // Add nonce for security
    wp_nonce_field('portfolio_thumbnail_nonce_action', 'portfolio_thumbnail_nonce');
}

function us_three_save_portfolio_thumbnail($post_id) {
    // Verify the nonce before proceeding.
    if (!isset($_POST['portfolio_thumbnail_nonce']) || !wp_verify_nonce($_POST['portfolio_thumbnail_nonce'], 'portfolio_thumbnail_nonce_action')) {
        return;
    }

    // Check if the current user has permission to edit the post.
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['portfolio_thumbnail_id'])) {
        update_post_meta($post_id, '_portfolio_thumbnail_id', sanitize_text_field($_POST['portfolio_thumbnail_id']));
    }
}

add_action('save_post_portfolio', 'us_three_save_portfolio_thumbnail');

function register_random_posts_widget() {
    register_widget('Random_Posts_Widget');
    register_widget('Random_Portfolio_Widget');
}
add_action('widgets_init', 'register_random_posts_widget');

function register_landing_pages_cpt() {
    // Get the custom slug from the options page
    $custom_slug = get_field('landing_page_slug', 'option'); 

    if( empty($custom_slug) ) {
        $custom_slug = 'default-slug'; // Fallback in case no slug is set
    }

    $args = array(
        'label'               => 'Landing Pages',
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array(
            'slug' => $custom_slug, // Use the dynamic slug here
            'with_front' => false,
        ),
        'supports'            => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('landing_pages', $args);
}

add_action('init', 'register_landing_pages_cpt');

add_action('acf/save_post', 'flush_rewrite_rules_after_options_save', 20);
function flush_rewrite_rules_after_options_save( $post_id ) {
    // Only flush rewrite rules if it's the options page
    if ( $post_id === 'options' ) {
        flush_rewrite_rules();
    }
}

function get_visitor_location() {
    $api_key = '9d38980ad55111';  // Replace with your IPinfo API key
    $ip_address = $_SERVER['REMOTE_ADDR'];
    
    // Check if the IP is local (127.0.0.1 or ::1 for IPv6), use a test IP instead
    if ($ip_address == '127.0.0.1' || $ip_address == '::1') {
        $ip_address = '8.8.8.8';  // Use a public IP for testing, e.g., Google's DNS
    }
    
    // Fetch location data from the API
    $response = wp_remote_get("https://ipinfo.io/{$ip_address}/json?token={$api_key}");
    
    if( is_wp_error( $response ) ) {
        return false;
    }
    
    $data = json_decode(wp_remote_retrieve_body($response));
    
    if (isset($data->city)) {
        return $data->city . ', ' . $data->region;
    } else {
        return 'Your Location';
    }
}

// Usage Example
$location = get_visitor_location();

