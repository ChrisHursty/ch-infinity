<?php
/**
 * Urban Spark Custom Post Types
 *
 * @package US Three
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Testimonials CPT
function us_three_testimonials_cpt() {
    $labels = array(
        'name'               => _x( 'Testimonials', 'post type general name', 'us-three' ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name', 'us-three' ),
        'menu_name'          => _x( 'Testimonials', 'admin menu', 'us-three' ),
        'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'us-three' ),
        'add_new'            => _x( 'Add New', 'testimonial', 'us-three' ),
        'add_new_item'       => __( 'Add New Testimonial', 'us-three' ),
        'new_item'           => __( 'New Testimonial', 'us-three' ),
        'edit_item'          => __( 'Edit Testimonial', 'us-three' ),
        'view_item'          => __( 'View Testimonial', 'us-three' ),
        'all_items'          => __( 'All Testimonials', 'us-three' ),
        'search_items'       => __( 'Search Testimonials', 'us-three' ),
        'not_found'          => __( 'No testimonials found.', 'us-three' ),
        'not_found_in_trash' => __( 'No testimonials found in Trash.', 'us-three' )
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
add_action( 'init', 'us_three_testimonials_cpt' );

// Portfolio Custom Post Type
function portfolio() {

	$labels = array(
		'name'                  => _x( 'Portfolio', 'Post Type General Name', 'us-three' ),
		'singular_name'         => _x( 'Portfolio Item', 'Post Type Singular Name', 'us-three' ),
		'menu_name'             => __( 'Portfolio', 'us-three' ),
		'name_admin_bar'        => __( 'Portfolio', 'us-three' ),
		'archives'              => __( 'Portfolio Archives', 'us-three' ),
		'attributes'            => __( 'Item Attributes', 'us-three' ),
		'parent_item_colon'     => __( 'Parent Item:', 'us-three' ),
		'all_items'             => __( 'All Portfolio Items', 'us-three' ),
		'add_new_item'          => __( 'Add New Portfolio Item', 'us-three' ),
		'add_new'               => __( 'Add New Portfolio Item', 'us-three' ),
		'new_item'              => __( 'New Item', 'us-three' ),
		'edit_item'             => __( 'Edit Item', 'us-three' ),
		'update_item'           => __( 'Update Item', 'us-three' ),
		'view_item'             => __( 'View Item', 'us-three' ),
		'view_items'            => __( 'View Items', 'us-three' ),
		'search_items'          => __( 'Search Item', 'us-three' ),
		'not_found'             => __( 'Not found', 'us-three' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'us-three' ),
		'featured_image'        => __( 'Featured Image', 'us-three' ),
		'set_featured_image'    => __( 'Set featured image', 'us-three' ),
		'remove_featured_image' => __( 'Remove featured image', 'us-three' ),
		'use_featured_image'    => __( 'Use as featured image', 'us-three' ),
		'insert_into_item'      => __( 'Insert into item', 'us-three' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'us-three' ),
		'items_list'            => __( 'Items list', 'us-three' ),
		'items_list_navigation' => __( 'Items list navigation', 'us-three' ),
		'filter_items_list'     => __( 'Filter items list', 'us-three' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio Item', 'us-three' ),
		'description'           => __( 'Post Type Description', 'us-three' ),
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
function us_three_create_genre_taxonomy() {
    $labels = array(
        'name'          => _x('Genres', 'Taxonomy General Name', 'us-three'),
        'singular_name' => _x('Genre', 'Taxonomy Singular Name', 'us-three'),
    );

    $args = array(
        'labels'       => $labels,
        'hierarchical' => true,
        'public'       => true,
        'show_in_rest' => true,
    );

    register_taxonomy('genre', array('portfolio'), $args);
}

add_action('init', 'us_three_create_genre_taxonomy');

function company_post_type() {
    $labels = array(
        'name'                  => _x('Companies', 'Post Type General Name', 'us-three'),
        'singular_name'         => _x('Company', 'Post Type Singular Name', 'us-three'),
        'menu_name'             => __('Companies', 'us-three'),
        'name_admin_bar'        => __('Company', 'us-three'),
        'archives'              => __('Company Archives', 'us-three'),
        'attributes'            => __('Company Attributes', 'us-three'),
        'parent_item_colon'     => __('Parent Company:', 'us-three'),
        'all_items'             => __('All Companies', 'us-three'),
        'add_new_item'          => __('Add New Company', 'us-three'),
        'add_new'               => __('Add New', 'us-three'),
        'new_item'              => __('New Company', 'us-three'),
        'edit_item'             => __('Edit Company', 'us-three'),
        'update_item'           => __('Update Company', 'us-three'),
        'view_item'             => __('View Company', 'us-three'),
        'view_items'            => __('View Companies', 'us-three'),
        'search_items'          => __('Search Company', 'us-three'),
        'not_found'             => __('Not found', 'us-three'),
        'not_found_in_trash'    => __('Not found in Trash', 'us-three'),
        'featured_image'        => __('Featured Image', 'us-three'),
        'set_featured_image'    => __('Set featured image', 'us-three'),
        'remove_featured_image' => __('Remove featured image', 'us-three'),
        'use_featured_image'    => __('Use as featured image', 'us-three'),
        'insert_into_item'      => __('Insert into company', 'us-three'),
        'uploaded_to_this_item' => __('Uploaded to this company', 'us-three'),
        'items_list'            => __('Companies list', 'us-three'),
        'items_list_navigation' => __('Companies list navigation', 'us-three'),
        'filter_items_list'     => __('Filter companies list', 'us-three'),
    );

    $args = array(
        'label'               => __('Company', 'us-three'),
        'description'         => __('Post Type Description', 'us-three'),
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

function us_three_faq_cpt() {
    $labels = array(
        'name'               => _x( 'FAQs', 'post type general name', 'us-three' ),
        'singular_name'      => _x( 'FAQ', 'post type singular name', 'us-three' ),
        'menu_name'          => _x( 'FAQs', 'admin menu', 'us-three' ),
        'name_admin_bar'     => _x( 'FAQ', 'add new on admin bar', 'us-three' ),
        'add_new'            => _x( 'Add New', 'faq', 'us-three' ),
        'add_new_item'       => __( 'Add New FAQ', 'us-three' ),
        'new_item'           => __( 'New FAQ', 'us-three' ),
        'edit_item'          => __( 'Edit FAQ', 'us-three' ),
        'view_item'          => __( 'View FAQ', 'us-three' ),
        'all_items'          => __( 'All FAQs', 'us-three' ),
        'search_items'       => __( 'Search FAQs', 'us-three' ),
        'not_found'          => __( 'No FAQs found.', 'us-three' ),
        'not_found_in_trash' => __( 'No FAQs found in Trash.', 'us-three' )
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
add_action( 'init', 'us_three_faq_cpt' );


