<?php

/**
 * Template Name: Marketing Landing Page 2025
 *
 * @package CH Infinity
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header('landing');
?>

<section class="container home-hero">
    <div class="row">
        <div class="col-md-6 hero-content">
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
                };?>
            </div>
        </div>
        <div class="col-md-6 hero-image">
        <?php 
        $hero_image = get_field('hero_image');
        if ($hero_image) {
            $image_url = $hero_image['url'];
            $alt_text = !empty($hero_image['alt']) ? $hero_image['alt'] : 'Chris Hurst, Marketing and Web Development'; // Fallback alt text if none is provided
            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($alt_text) . '">';
        }
        ?>
        </div>
    </div><!-- .row -->
</section>
<!-- Problem -->
<section class="container-fw problem-container dark-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-3 problem-image">
                <?php 
                $problem_image = get_field('problem_image');
                if ($problem_image) {
                    $image_url = $problem_image['url'];
                    $alt_text = !empty($problem_image['alt']) ? $problem_image['alt'] : 'Chris Hurst, Marketing and Web Development'; // Fallback alt text if none is provided
                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($alt_text) . '">';
                }
                ?>
            </div>
            <div class="col-md-9 problem-content">
                <?php 
                    $problem_content = get_field('problem_content');
                    if ($problem_content) {
                        echo wp_kses_post($problem_content);
                    }
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Solution -->
<section class="container-fw solution-container iso-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-7 solution-content">
                <?php 
                    $solution_content = get_field('solution_content');
                    if ($solution_content) {
                        echo wp_kses_post($solution_content);
                    }
                ?>
            </div>
            <div class="col-md-5 solution-image">
                <?php 
                $solution_image = get_field('solution_image');
                if ($solution_image) {
                    $image_url = $solution_image['url'];
                    $alt_text = !empty($solution_image['alt']) ? $solution_image['alt'] : 'Chris Hurst, Marketing and Web Development'; // Fallback alt text if none is provided
                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($alt_text) . '">';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Problem -->
<section class="container-fw results-container dark-bg">
    <div class="container">
        <div class="row">
            <h2><?php echo the_field('results_heading'); ?></h2>
        </div>
    </div>
    <div class="container">
    <?php if( have_rows('results_columns') ): ?>
        <div class="row">
            <?php 
            // Get total number of rows (columns)
            $column_count = count(get_field('results_columns'));

            // Set column class based on the count
            if ($column_count == 1) {
                $column_class = 'col-md-8 align-center';
            } elseif ($column_count == 2) {
                $column_class = 'col-md-6';
            } else {
                $column_class = 'col-md-4';
            }

            // Loop through repeater
            while ( have_rows('results_columns') ) : the_row(); ?>
                <div class="<?php echo esc_attr($column_class); ?>">
                    <?php 
                    $icon = get_sub_field('icon');
                    $heading = get_sub_field('heading');
                    $content = get_sub_field('content');
                    ?>
                    <div class="result-icon">
                        <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
                    </div>
                    <div class="result-heading">
                        <h3><?php echo esc_html($heading); ?></h3>
                    </div>
                    <div class="result-content">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    </div>
</section>

<!-- Action Plan -->
<section class="container-fw action-plan-container iso-bg">
    <div class="container">
        <div class="row center-title">
            <h2><?php echo the_field('action_plan_heading'); ?></h2>
        </div>
    </div>
    <div class="container">
        <?php if( have_rows('action_plan_steps') ): ?>
        <div class="action-plan-steps">
            <?php 
            $row_number = 0;
            while ( have_rows('action_plan_steps') ) : the_row(); 
                $row_number++; // Increment the row number
                $icon = get_sub_field('icon');
                $heading = get_sub_field('heading');
                $content = get_sub_field('content');
                $image = get_sub_field('image'); // Using ACF image field
            ?>

            <?php if ($row_number % 2 != 0): // Odd rows ?>
                <div class="row step-<?php echo esc_attr($row_number); ?>">
                    <div class="col-md-6 step-content-left">
                        <div class="step-icon">
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
                        </div>
                        <div class="step-heading">
                            <div class="step-number"><?php echo esc_html($row_number); ?></div>
                            <h2><?php echo esc_html($heading); ?></h2>
                        </div>
                        <div class="step-content">
                            <?php echo wp_kses_post($content); ?>
                        </div>
                    </div>
                    <div class="col-md-6 step-image">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="Step Image" />
                    </div>
                </div>

            <?php else: // Even rows ?>
                <div class="row step-<?php echo esc_attr($row_number); ?>">
                    <div class="col-md-6 step-image">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="Step Image" />
                    </div>
                    <div class="col-md-6 step-content-right">
                        <div class="step-icon">
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
                        </div>
                        <div class="step-heading">
                        <div class="step-number"><?php echo esc_html($row_number); ?></div>
                            <h2><?php echo esc_html($heading); ?></h2>
                        </div>
                        <div class="step-content">
                            <?php echo wp_kses_post($content); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

    </div>
</section>

<div class="container-fw testimonials-container dark-bg">
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

            if( $testimonials_query->have_posts() ) : ?>
                <div class="testimonials-section">
                    <?php while( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); ?>
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
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</div>

<!-- FAQ's -->
<section class="cta">
    <?php get_template_part('template-parts/faqs'); ?>
</section>

<section class="calendly-cta-container container-fw dark-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 content">
                <h2><?php echo the_field('cta_heading') ;?></h2>
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
                    };?>
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
