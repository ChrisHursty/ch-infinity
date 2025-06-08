<?php
/**
 * Single Service Template
 *
 * @package CH Infinity
 */

defined('ABSPATH') || exit;

get_header();

// Vars
$post_id            = get_the_ID();
$default_image_url  = get_template_directory_uri() . '/dist/images/default-hero-img.webp';
$featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
$featured_image_url = $featured_image_url ?: $default_image_url;
?>

<section class="container-fw hero-title-area" style="background-image: url('<?php echo esc_url($featured_image_url); ?>');">
    <div class="container">
        <div class="row">
            <div class="align-center text-center">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="container content-bg slim-page">
    <div class="row">
        <div class="col-12 align-center content">
            <div class="content-area">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<!-- Ninja Form Section (Edit form ID as needed) -->
<section class="container-fw contact-form-section">
    <div class="container">    
        <div class="row">
            <div class="col-8 align-center text-center">
                <h2>Ready to Get Started?</h2>
                <p>Fill out the form below and I’ll be in touch with a quote.</p>
                <?php echo do_shortcode('[ninja_form id=1]'); ?>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="container-fw testimonials-container dark-bg">
    <div class="container">
        <div class="row">
            <div class="col-12 align-center text-center">
                <h2><?php echo esc_html(get_field('testimonials_section_title', 'option')); ?></h2>
            </div>
        </div>
        <div class="row">
            <?php
            $args = array(
                'post_type'      => 'testimonials',
                'posts_per_page' => 3,
                'orderby'        => 'rand',
            );

            $testimonials_query = new WP_Query($args);

            if ($testimonials_query->have_posts()) :
                while ($testimonials_query->have_posts()) : $testimonials_query->the_post();

                    $headline = get_field('headline');
                    $video    = get_field('video');
                    $headshot = get_the_post_thumbnail_url();
            ?>
                    <div class="col-md-4 testimonial">
                        <div class="testimonial-content">
                            <?php if ($video) : ?>
                                <div class="testimonial-video">
                                    <video width="100%" controls>
                                        <source src="<?php echo esc_url($video['url']); ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            <?php else : ?>
                                <h3><?php echo esc_html($headline); ?></h3>
                                <div class="testimonial-body"><?php the_content(); ?></div>
                            <?php endif; ?>

                            <div class="testimonial-meta">
                                <div class="testimonial-headshot">
                                    <img src="<?php echo esc_url($headshot); ?>" alt="<?php the_title(); ?>" class="headshot">
                                </div>
                                <div class="testimonial-info">
                                    <h4 class="testimonial-name"><?php the_title(); ?></h4>
                                    <div class="testimonial-stars">
                                        <?php for ($i = 0; $i < 5; $i++) : ?>
                                            <i class="fa fa-star" style="color: #FFD700;"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
            endif;

            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<?php get_template_part('template-parts/faqs'); ?>

<!-- CTA Section -->
<section class="cta">
    <?php get_template_part('template-parts/call-to-action'); ?>
</section>

<?php get_footer();
