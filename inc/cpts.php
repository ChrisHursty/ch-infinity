<?php
/**
 * Urban Spark Custom Post Types
 *
 * @package CH Infinity
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Testimonials CPT
function ch_infinity_testimonials_cpt() {
    $labels = array(
        'name'               => _x( 'Testimonials', 'post type general name', 'ch-infinity' ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name', 'ch-infinity' ),
        'menu_name'          => _x( 'Testimonials', 'admin menu', 'ch-infinity' ),
        'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'ch-infinity' ),
        'add_new'            => _x( 'Add New', 'testimonial', 'ch-infinity' ),
        'add_new_item'       => __( 'Add New Testimonial', 'ch-infinity' ),
        'new_item'           => __( 'New Testimonial', 'ch-infinity' ),
        'edit_item'          => __( 'Edit Testimonial', 'ch-infinity' ),
        'view_item'          => __( 'View Testimonial', 'ch-infinity' ),
        'all_items'          => __( 'All Testimonials', 'ch-infinity' ),
        'search_items'       => __( 'Search Testimonials', 'ch-infinity' ),
        'not_found'          => __( 'No testimonials found.', 'ch-infinity' ),
        'not_found_in_trash' => __( 'No testimonials found in Trash.', 'ch-infinity' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable'  => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'testimonials', $args );
}
add_action( 'init', 'ch_infinity_testimonials_cpt' );

// Portfolio Custom Post Type
function portfolio() {

	$labels = array(
		'name'                  => _x( 'Portfolio', 'Post Type General Name', 'ch-infinity' ),
		'singular_name'         => _x( 'Portfolio Item', 'Post Type Singular Name', 'ch-infinity' ),
		'menu_name'             => __( 'Portfolio', 'ch-infinity' ),
		'name_admin_bar'        => __( 'Portfolio', 'ch-infinity' ),
		'archives'              => __( 'Portfolio Archives', 'ch-infinity' ),
		'attributes'            => __( 'Item Attributes', 'ch-infinity' ),
		'parent_item_colon'     => __( 'Parent Item:', 'ch-infinity' ),
		'all_items'             => __( 'All Portfolio Items', 'ch-infinity' ),
		'add_new_item'          => __( 'Add New Portfolio Item', 'ch-infinity' ),
		'add_new'               => __( 'Add New Portfolio Item', 'ch-infinity' ),
		'new_item'              => __( 'New Item', 'ch-infinity' ),
		'edit_item'             => __( 'Edit Item', 'ch-infinity' ),
		'update_item'           => __( 'Update Item', 'ch-infinity' ),
		'view_item'             => __( 'View Item', 'ch-infinity' ),
		'view_items'            => __( 'View Items', 'ch-infinity' ),
		'search_items'          => __( 'Search Item', 'ch-infinity' ),
		'not_found'             => __( 'Not found', 'ch-infinity' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'ch-infinity' ),
		'featured_image'        => __( 'Featured Image', 'ch-infinity' ),
		'set_featured_image'    => __( 'Set featured image', 'ch-infinity' ),
		'remove_featured_image' => __( 'Remove featured image', 'ch-infinity' ),
		'use_featured_image'    => __( 'Use as featured image', 'ch-infinity' ),
		'insert_into_item'      => __( 'Insert into item', 'ch-infinity' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'ch-infinity' ),
		'items_list'            => __( 'Items list', 'ch-infinity' ),
		'items_list_navigation' => __( 'Items list navigation', 'ch-infinity' ),
		'filter_items_list'     => __( 'Filter items list', 'ch-infinity' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio Item', 'ch-infinity' ),
		'description'           => __( 'Post Type Description', 'ch-infinity' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'taxonomies'            => array( 'post_tag', 'genres' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
        'menu_icon'             => 'dashicons-portfolio',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'portfolio', 0 );

// Genre Custom Taxonomy
function ch_infinity_create_genre_taxonomy() {
    $labels = array(
        'name'          => _x('Genres', 'Taxonomy General Name', 'ch-infinity'),
        'singular_name' => _x('Genre', 'Taxonomy Singular Name', 'ch-infinity'),
    );

    $args = array(
        'labels'       => $labels,
        'hierarchical' => true,
        'public'       => true,
        'show_in_rest' => true,
    );

    register_taxonomy('genre', array('portfolio'), $args);
}

add_action('init', 'ch_infinity_create_genre_taxonomy');

function company_post_type() {
    $labels = array(
        'name'                  => _x('Companies', 'Post Type General Name', 'ch-infinity'),
        'singular_name'         => _x('Company', 'Post Type Singular Name', 'ch-infinity'),
        'menu_name'             => __('Companies', 'ch-infinity'),
        'name_admin_bar'        => __('Company', 'ch-infinity'),
        'archives'              => __('Company Archives', 'ch-infinity'),
        'attributes'            => __('Company Attributes', 'ch-infinity'),
        'parent_item_colon'     => __('Parent Company:', 'ch-infinity'),
        'all_items'             => __('All Companies', 'ch-infinity'),
        'add_new_item'          => __('Add New Company', 'ch-infinity'),
        'add_new'               => __('Add New', 'ch-infinity'),
        'new_item'              => __('New Company', 'ch-infinity'),
        'edit_item'             => __('Edit Company', 'ch-infinity'),
        'update_item'           => __('Update Company', 'ch-infinity'),
        'view_item'             => __('View Company', 'ch-infinity'),
        'view_items'            => __('View Companies', 'ch-infinity'),
        'search_items'          => __('Search Company', 'ch-infinity'),
        'not_found'             => __('Not found', 'ch-infinity'),
        'not_found_in_trash'    => __('Not found in Trash', 'ch-infinity'),
        'featured_image'        => __('Featured Image', 'ch-infinity'),
        'set_featured_image'    => __('Set featured image', 'ch-infinity'),
        'remove_featured_image' => __('Remove featured image', 'ch-infinity'),
        'use_featured_image'    => __('Use as featured image', 'ch-infinity'),
        'insert_into_item'      => __('Insert into company', 'ch-infinity'),
        'uploaded_to_this_item' => __('Uploaded to this company', 'ch-infinity'),
        'items_list'            => __('Companies list', 'ch-infinity'),
        'items_list_navigation' => __('Companies list navigation', 'ch-infinity'),
        'filter_items_list'     => __('Filter companies list', 'ch-infinity'),
    );

    $args = array(
        'label'               => __('Company', 'ch-infinity'),
        'description'         => __('Post Type Description', 'ch-infinity'),
        'labels'              => $labels,
        'supports'            => array('title', 'thumbnail'),
        'taxonomies'          => array('category', 'post_tag'),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-building',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
    );

    register_post_type('company', $args);
}

add_action('init', 'company_post_type');

function ch_infinity_faq_cpt() {
    $labels = array(
        'name'               => _x( 'FAQs', 'post type general name', 'ch-infinity' ),
        'singular_name'      => _x( 'FAQ', 'post type singular name', 'ch-infinity' ),
        'menu_name'          => _x( 'FAQs', 'admin menu', 'ch-infinity' ),
        'name_admin_bar'     => _x( 'FAQ', 'add new on admin bar', 'ch-infinity' ),
        'add_new'            => _x( 'Add New', 'faq', 'ch-infinity' ),
        'add_new_item'       => __( 'Add New FAQ', 'ch-infinity' ),
        'new_item'           => __( 'New FAQ', 'ch-infinity' ),
        'edit_item'          => __( 'Edit FAQ', 'ch-infinity' ),
        'view_item'          => __( 'View FAQ', 'ch-infinity' ),
        'all_items'          => __( 'All FAQs', 'ch-infinity' ),
        'search_items'       => __( 'Search FAQs', 'ch-infinity' ),
        'not_found'          => __( 'No FAQs found.', 'ch-infinity' ),
        'not_found_in_trash' => __( 'No FAQs found in Trash.', 'ch-infinity' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable'  => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'faq' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor' ),
        'menu_icon'          => 'dashicons-editor-help', // Choose the appropriate Dashicon for FAQ
    );

    register_post_type( 'faq', $args );
}
add_action( 'init', 'ch_infinity_faq_cpt' );

// Services CPT
function ch_infinity_services_cpt() {
    $labels = array(
        'name'               => _x( 'Services', 'post type general name', 'ch-infinity' ),
        'singular_name'      => _x( 'Service', 'post type singular name', 'ch-infinity' ),
        'menu_name'          => _x( 'Services', 'admin menu', 'ch-infinity' ),
        'name_admin_bar'     => _x( 'Service', 'add new on admin bar', 'ch-infinity' ),
        'add_new'            => _x( 'Add New', 'service', 'ch-infinity' ),
        'add_new_item'       => __( 'Add New Service', 'ch-infinity' ),
        'new_item'           => __( 'New Service', 'ch-infinity' ),
        'edit_item'          => __( 'Edit Service', 'ch-infinity' ),
        'view_item'          => __( 'View Service', 'ch-infinity' ),
        'all_items'          => __( 'All Services', 'ch-infinity' ),
        'search_items'       => __( 'Search Services', 'ch-infinity' ),
        'not_found'          => __( 'No services found.', 'ch-infinity' ),
        'not_found_in_trash' => __( 'No services found in Trash.', 'ch-infinity' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'services' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-hammer',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'services', $args );
}
add_action( 'init', 'ch_infinity_services_cpt' );

