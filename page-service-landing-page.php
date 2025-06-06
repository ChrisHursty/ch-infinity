<?php

/**
 * Template Name: Service Landing Page 2025
 *
 * @package CH Infinity
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
// Schema
$business_name = get_field('business_name');
$business_address = get_field('business_address');
$business_phone = get_field('business_phone');
$business_state = get_field('business_state');
$business_zip = get_field('business_zip');
$service_type = get_field('service_type');
$location = get_visitor_location(); // Using the location from IP-based geolocation

// Featured Image Background and Title for a landing page
$post_id = get_the_ID();
$featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
$page_title = get_field('page_title');
$service = get_field('service');
$location = get_field('location');
$service_content = get_field('service_content');
// Fetch common content from the Landing Options page
$about_text = get_field('about_section_text', 'option');
$cta_image = get_field('cta_image', 'option');

// Define a default image URL
$default_image_url = get_template_directory_uri() . '/dist/images/default-hero-img.webp';

// Use the featured image if available, otherwise use the default
$background_image_url = $featured_image_url ? $featured_image_url : $default_image_url;

echo '<section class="container-fw hero-title-area" style="background-image: url(' . esc_url($background_image_url) . ');">';
echo '<div class="container"><div class="row"><div class="col-12 align-center text-center">';
echo '<h1>' . $page_title . '</h1>';
echo '</div></div></div></section>';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "<?php echo esc_html($business_name); ?>",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "<?php echo esc_html($business_address); ?>",
    "addressLocality": "<?php echo esc_html($location); ?>",
    "addressRegion": "<?php echo esc_html($business_state); ?>",
    "postalCode": "<?php echo esc_html($business_zip); ?>"
  },
  "telephone": "<?php echo esc_html($business_phone); ?>",
}
</script>
<section class="container content-bg">
    <div class="row">
        <div class="col-12 align-center content">
            <p>Service: <?php echo esc_html($service); ?></p>
            <p>Location: <?php echo esc_html($location); ?></p>
            <div class="content-div">
                <?php 
                $location = get_visitor_location(); 
                ?>
                <h1>WordPress Developer Near <?php echo $location; ?></h1>
                <p>Looking for the best WordPress development services in <?php echo $location; ?>? You're in the right place!</p>

                <?php echo wp_kses_post($service_content); ?>
            </div>
        </div>
    
        <div class="col-12">
            <div class="common-section">
                <p><?php echo wp_kses_post($about_text); ?></p>
                <?php if ($cta_image) : ?>
                    <img src="<?php echo esc_url($cta_image['url']); ?>" alt="<?php echo esc_attr($cta_image['alt']); ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Randomized Testimonials Section -->
<section class="container-fw testimonials-container dark-bg">
    <div class="container">
        <div class="row">
            <div class="col-12 align-center text-center">
                <h2><?php echo esc_html(get_field('testimonials_section_title', 'option')); // Dynamic title ?></h2>
            </div>
        </div>
        <div class="row">
            <?php
            // Query Testimonials CPT for 3 random testimonials
            $args = array(
                'post_type' => 'testimonials',
                'posts_per_page' => 3,
                'orderby' => 'rand', // Randomize the output
            );

            $testimonials_query = new WP_Query($args);

            if ($testimonials_query->have_posts()) :
                while ($testimonials_query->have_posts()) : $testimonials_query->the_post();

                // Get ACF fields (headline, video, featured image)
                $headline = get_field('headline');
                $video = get_field('video');
                $headshot = get_the_post_thumbnail_url();
                ?>

                <div class="col-md-4 testimonial">
                    <div class="testimonial-content">
                        <?php if ($video) : ?>
                            <!-- Display video testimonial -->
                            <div class="testimonial-video">
                                <video width="100%" controls>
                                    <source src="<?php echo esc_url($video['url']); ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        <?php else : ?>
                            <!-- Display text testimonial -->
                            <h3><?php echo esc_html($headline); ?></h3>
                            <div class="testimonial-body"><?php the_content(); ?></div>
                        <?php endif; ?>

                        <!-- Headshot, Name, and Stars Layout -->
                        <div class="testimonial-meta">
                            <div class="testimonial-headshot">
                                <img src="<?php echo esc_url($headshot); ?>" alt="<?php the_title(); ?>" class="headshot">
                            </div>
                            <div class="testimonial-info">
                                <h4 class="testimonial-name"><?php the_title(); ?></h4>
                                <div class="testimonial-stars">
                                    <i class="fa fa-star" style="color: #FFD700;"></i>
                                    <i class="fa fa-star" style="color: #FFD700;"></i>
                                    <i class="fa fa-star" style="color: #FFD700;"></i>
                                    <i class="fa fa-star" style="color: #FFD700;"></i>
                                    <i class="fa fa-star" style="color: #FFD700;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
                endwhile;
            endif;

            wp_reset_postdata(); // Reset the query
            ?>
        </div>
    </div>
</section>

<!-- FAQ's -->
<?php get_template_part('template-parts/faqs'); ?>

<!-- Call To Action -->
<section class="cta">
    <?php get_template_part('template-parts/call-to-action'); ?>
</section>

<?php
get_footer();
