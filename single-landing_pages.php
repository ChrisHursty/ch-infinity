<?php

/**
 * Single Post Template
 *
 * @package US Three
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header(); ?>

<?php
// Initialize variables
$post_id            = get_the_ID();
$default_image_url  = get_template_directory_uri() . '/dist/images/default-hero-img.webp';
$featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
$category_terms     = get_the_terms($post_id, 'category');

// Use default image if no featured image is set
if (!$featured_image_url) {
    $featured_image_url = $default_image_url;
}

// Output the section only if we have an image URL (which will always be true at this point)
echo '<section class="container-fw hero-title-area" style="background-image: url(' . esc_url($featured_image_url) . ');">';
echo '<div class="container"><div class="row"><div class="align-center text-center">';
echo '<h1>' . get_the_title() . '</h1></div>';

// Check if there are categories and they are not WP errors
if (!empty($category_terms) && !is_wp_error($category_terms)) {
    echo '<div class="genre-container">'; // Changed class name from genre-container to category-container for clarity
    foreach ($category_terms as $category_term) {
        $category_link = get_term_link($category_term->term_id, 'category'); // Get category link
        if (!is_wp_error($category_link)) {
            echo '<div class="text-center genre-link"><a href="' . esc_url($category_link) . '">' . esc_html($category_term->name) . '</a></div>';
        }
    }
    echo '</div>'; // Close category-container div
}

echo '</div></div></section>';
?>
+
<section class="container content-bg slim-page">
    <div class="row">
        <div class="col-12 align-center content">
            <div class="content-area">
                <?php the_content(); ?>
            </div>
        </div>
    </div><!-- .row -->
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
