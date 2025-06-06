<?php
/**
 * Archive Template for Services
 *
 * @package CH Infinity
 */

defined('ABSPATH') || exit;
get_header();
?>

<section class="container-fw hero-title-area" style="background-image: url('<?php the_field('archive_bg_image', 'option'); ?>');">
    <div class="container">
        <div class="row">
            <div class="col-12 align-center text-center">
                <h1><?php post_type_archive_title(); ?></h1>
                <p>Browse the services I offer to help grow your business.</p>
            </div>
        </div>
    </div>
</section>

<section class="container content-bg">
    <div class="row grid-row">
        <?php
        // Custom query to respect menu_order
        $args = array(
            'post_type'      => 'services',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        );
        $services_query = new WP_Query($args);

        if ($services_query->have_posts()) :
            while ($services_query->have_posts()) : $services_query->the_post(); ?>
                <div class="col-sm-12 col-md-6 col-lg-4 service-card">
                    <div class="card-inner align-center text-center">
                        <?php $icon = get_field('service_icon');
                        if (!empty($icon)) : ?>
                            <div class="service-icon">
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? 'Service Icon'); ?>" class="service-icon-img" />
                            </div>
                        <?php endif; ?>

                        <h2 class="service-title"><?php the_title(); ?></h2>

                        <?php if (get_field('service_excerpt')) : ?>
                            <p class="service-excerpt"><?php the_field('service_excerpt'); ?></p>
                        <?php endif; ?>

                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            <?php endwhile;
        else : ?>
            <div class="col-12">
                <p>No services found.</p>
            </div>
        <?php endif;

        wp_reset_postdata();
        ?>
    </div>
</section>

<?php get_footer();
