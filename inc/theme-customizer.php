<?php
/**
 * US Three functions and definitions
 *
 * @package CH Infinity
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Global CTA
function ch_infinity_customize_register( $wp_customize ) {
  // Add a new panel for 'Call To Action'
  $wp_customize->add_panel( 'call_to_action_panel', array(
      'title'       => __( 'Custom Call To Action', 'ch-infinity' ),
      'description' => 'Global Call To Action', // Optional description
      'priority'    => 30, // Adjust the priority to position it
  ));

  // Add a section within the panel
  $wp_customize->add_section( 'call_to_action_section', array(
      'title' => __( 'Settings', 'ch-infinity' ),
      'panel' => 'call_to_action_panel',
  ));

  // Add settings to the section
  ch_infinity_add_customizer_setting( $wp_customize, 'call_to_action_section', 'heading', 'Heading', 'text' );
  ch_infinity_add_customizer_setting( $wp_customize, 'call_to_action_section', 'text', 'Text', 'textarea' );
  ch_infinity_add_customizer_setting( $wp_customize, 'call_to_action_section', 'button_text', 'Button Text', 'text' );
  ch_infinity_add_customizer_setting( $wp_customize, 'call_to_action_section', 'button_url', 'Button URL', 'url' );
  ch_infinity_add_customizer_setting( $wp_customize, 'call_to_action_section', 'background_color', 'Background Color', 'color' );
  ch_infinity_add_customizer_setting( $wp_customize, 'call_to_action_section', 'text_color', 'Text Color', 'color' );
  ch_infinity_add_customizer_setting( $wp_customize, 'call_to_action_section', 'button_background_color', 'Button Background Color', 'color' );
  ch_infinity_add_customizer_setting( $wp_customize, 'call_to_action_section', 'button_text_color', 'Button Text Color', 'color' );

    // Add a new panel for the Footer
    $wp_customize->add_panel('footer_panel', array(
        'title' => __('Custom Footer', 'ch-infinity'),
        'priority' => 90, // Adjust the priority to position it
    ));

    // Add a section within the panel
    $wp_customize->add_section('footer_settings_section', array(
        'title' => __('Footer Settings', 'ch-infinity'),
        'panel' => 'footer_panel',
        'priority' => 90, // Adjust the priority to position it
    ));

    // Add settings for logo upload
    $wp_customize->add_setting('footer_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
        'label' => __('Footer Logo', 'ch-infinity'),
        'section' => 'footer_settings_section',
        'settings' => 'footer_logo',
    )));

    // Add settings for the text area
    $wp_customize->add_setting('footer_text', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('footer_text', array(
        'type' => 'textarea',
        'label' => __('Footer Text', 'ch-infinity'),
        'section' => 'footer_settings_section',
    ));

    // Footer Copyright
    $wp_customize->add_setting('footer_copyright_text', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('footer_copyright_text', array(
        'type' => 'textarea',
        'label' => __('Footer Copyright Text', 'ch-infinity'),
        'section' => 'footer_settings_section',
    ));
}

add_action( 'customize_register', 'ch_infinity_customize_register' );

function ch_infinity_add_customizer_setting( $wp_customize, $section, $setting_id, $label, $type ) {
  $wp_customize->add_setting( $setting_id, array(
      'default' => '',
      'sanitize_callback' => 'wp_kses_post',
  ));

  $control_type = 'WP_Customize_Control';
  if ( $type === 'textarea' ) {
      $control_type = 'WP_Customize_Control';
      $type = 'textarea';
  } elseif ( $type === 'color' ) {
      $control_type = 'WP_Customize_Color_Control';
  }

  $wp_customize->add_control( new $control_type( $wp_customize, $setting_id, array(
      'label' => $label,
      'section' => $section,
      'settings' => $setting_id,
      'type' => $type,
  )));
}


