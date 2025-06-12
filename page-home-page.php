<?php

/**
 * Template Name: Home Page 2025
 *
 * @package CH Infinity
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();

$background_image = get_field('hero_bg_image');
?>
<style>
    .home-hero::before {
        background: url('<?php echo esc_url($background_image); ?>');
    }
</style>
<section class="container-fw home-hero">
    <div class="container">
        <div class="row align-center text-center">
            <div class="col-sm-12 col-md-10 hero-content">
                <h1 class="site-tagline"><?php echo esc_html(get_bloginfo('description')); ?></h1>
                <h2><?php echo wp_kses_post(get_field('hero_heading')); ?></h2>
                <div class="intro">
                    <?php
                    $hero_intro = get_field('hero_intro');
                    if ($hero_intro) {
                        echo wp_kses_post($hero_intro);
                    }
                    ?>
                </div>
                <div class="button-box">
                    <?php $calendly_code = get_field('calendly_code', 'option');
                    if ($calendly_code) {
                        echo $calendly_code;
                    }; ?>
                </div>
            </div>
        </div><!-- .row -->
    </div>
</section>

<!-- Home Carousel -->
<?php
$gallery = get_field('home_page_slideshow');
if ($gallery): ?>
    <section class="container-fw home-carousel-section">
        <div class="container">
            <div class="row align-center text-center">
                <div class="col-md-2"></div>
                <div class="col-sm-12 col-md-8">
                    <div class="owl-carousel home-page-carousel owl-theme">
                        <?php foreach ($gallery as $image): ?>
                            <div class="carousel-item">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Why Me Block -->
<section class="container-fw why-me-section">
    <div class="container">
        <div class="row center-title">
            <?php $why_me_title = get_field('why_me_title');
            if ($why_me_title) {
                echo '<h2>' . esc_html($why_me_title) . '</h2>';
            } ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 why-me-content-big-container">
                <h3><?php echo wp_kses_post(get_field('why_me_big_heading')); ?></h3>
                <div class="why-me-content-big">
                    <?php
                    $why_me_content = get_field('why_me_content');
                    if ($why_me_content) {
                        echo wp_kses_post($why_me_content);
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-8 why-me-list-container">
                <?php $why_me_repeater_list = get_field('why_me_list');
                if ($why_me_repeater_list): ?>
                    <ul class="why-me-list">
                        <?php foreach ($why_me_repeater_list as $item): ?>
                            <li>
                                <div class="icon">
                                    <i class="far fa-check-circle"></i>
                                </div>
                                <div class="content">
                                    <h4><?php echo esc_html($item['list_item']); ?></h4>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Services -->
<section class="container-fw dark-bg home-services">
    <div class="container">
        <div class="row center-title">
            <h2>Services</h2>
        </div>
    </div>
    <div class="container">
        <div class="row grid-row">
            <?php
            $args = array(
                'post_type'      => 'services',
                'posts_per_page' => 6,
                'meta_key'       => 'add_to_homepage',
                'meta_value'     => true,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            );
            $home_services = new WP_Query($args);

            if ($home_services->have_posts()) :
                while ($home_services->have_posts()) : $home_services->the_post();
                    $icon = get_field('service_icon');
            ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 service-card">
                        <div class="card-inner align-center text-center">
                            <?php if (!empty($icon)) : ?>
                                <div class="service-icon">
                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? 'Service Icon'); ?>" class="service-icon-img" />
                                </div>
                            <?php endif; ?>
                            <h2 class="service-title"><?php the_title(); ?></h2>
                            <?php if (get_field('service_excerpt')) : ?>
                                <p class="service-excerpt"><?php the_field('service_excerpt'); ?></p>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="infinity-btn btn"><span>Learn More</span></a>
                        </div>
                    </div>
            <?php endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
        <a href="/services" class="home-services-link infinity-btn center-title" role="link"><span>ALL SERVICES</span></a>
    </div>
</section>

<!-- Testimonials -->
<div class="container-fw testimonials-container">
    <div class="container">
        <div class="row center-title">
            <?php $testimonials_title = get_field('testimonials_title', 'option');
            if ($testimonials_title) {
                echo '<h2>' . esc_html($testimonials_title) . '</h2>';
            } ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php
            // Query the Testimonials CPT
            $args = array(
                'post_type'      => 'testimonials',
                'posts_per_page' => 6,
                'orderby'        => 'date',
                'order'          => 'ASC',
            );

            $testimonials_query = new WP_Query($args);

            if ($testimonials_query->have_posts()) : ?>
                <div class="testimonials-section">
                    <?php while ($testimonials_query->have_posts()) : $testimonials_query->the_post(); ?>
                        <div class="testimonial">
                            <div class="testimonial-content">
                                <?php
                                // ACF Fields
                                $headline = get_field('headline');
                                $video = get_field('video');
                                $headshot = get_the_post_thumbnail_url();

                                if ($video): ?>
                                    <div class="testimonial-video">
                                        <video width="100%" controls>
                                            <source src="<?php echo esc_url($video['url']); ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                <?php else: ?>
                                    <div class="testimonial-text">
                                        <h3><?php echo esc_html($headline); ?></h3>
                                        <div class="testimonial-body"><?php the_content(); ?></div>
                                    </div>
                                <?php endif; ?>

                                <div class="testimonial-meta">
                                    <div class="testimonial-headshot">
                                        <img src="<?php echo esc_url($headshot); ?>" alt="<?php the_title(); ?>" class="headshot">
                                    </div>
                                    <div class="testimonial-info">
                                        <h4 class="testimonial-name"><?php the_title(); ?></h4>
                                        <div class="testimonial-stars">
                                            <i class="fa fa-star" style="color: #a5ff00;"></i>
                                            <i class="fa fa-star" style="color: #a5ff00;"></i>
                                            <i class="fa fa-star" style="color: #a5ff00;"></i>
                                            <i class="fa fa-star" style="color: #a5ff00;"></i>
                                            <i class="fa fa-star" style="color: #a5ff00;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</div>

<section class="container-fw blog-preview-section">
    <div class="container">
        <div class="row blog-grid">
            <?php
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'orderby'        => 'rand',
            );
            $random_posts = new WP_Query($args);
            $fallback_img = get_field('portfolio_bg_image', 'option');

            if ($random_posts->have_posts()) :
                while ($random_posts->have_posts()) : $random_posts->the_post();
                    $categories = get_the_category();
                    $category_name = $categories ? esc_html($categories[0]->name) : 'Blog';
                    $thumbnail_id = get_post_thumbnail_id();
                    $image_url = $thumbnail_id
                        ? wp_get_attachment_image_url($thumbnail_id, 'medium_large')
                        : esc_url(is_array($fallback_img) ? $fallback_img['url'] : $fallback_img);
            ?>
                    <div class="col-sm-12 col-md-4 blog-card">
                        <div class="card h-100 d-flex flex-column">
                            <?php if ($image_url): ?>
                                <div class="card-img">
                                    <img src="<?php echo $image_url; ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <span class="post-category"><?php echo $category_name; ?></span>
                                    <h3 class="post-title"><?php the_title(); ?></h3>
                                    <p class="post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="read-more-btn mt-auto">Read More</a>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>



<!-- FAQ's -->
<?php get_template_part('template-parts/faqs'); ?>
<!-- Logo Ticker -->
<section class="cta">
    <?php get_template_part('template-parts/company-ticker'); ?>
</section>
<section class="calendly-cta-container container-fw dark-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 content">
                <h2><?php echo the_field('cta_heading'); ?></h2>
                <div class="cta-content">
                    <?php
                    $cta_content = get_field('cta_content');
                    if ($cta_content) {
                        echo wp_kses_post($cta_content);
                    }
                    ?>
                </div>

                <div class="button-box">
                    <?php $calendly_code = get_field('calendly_code', 'option');
                    if ($calendly_code) {
                        echo $calendly_code;
                    }; ?>
                </div>
            </div>
            <div class="col-md-6 align-center">
                <?php
                $calendly_content = get_field('calendly_code');
                if ($calendly_content) {
                    echo wp_kses_post($calendly_content);
                }
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Call To Action -->
<section class="cta">
    <?php get_template_part('template-parts/call-to-action'); ?>
</section>

<?php
get_footer();
