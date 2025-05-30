<section class="container-fw faq-section iso-bg">
    <div class="container">
        <div class="row center-title">
            <?php $faq_title = get_field('faq_title', 'option');
            if ($faq_title) {
                echo '<h2>' . esc_html($faq_title) . '</h2>';
            } ?>
        </div>
    </div>
    <div class="container">
        <div class="row faq-container">
            <?php
            $args = array(
                'post_type'      => 'faq',
                'posts_per_page' => -1,
                'orderby'        => 'date',
                'order'          => 'ASC',
            );
            $faq_query = new WP_Query($args);

            if( $faq_query->have_posts() ) :
                while( $faq_query->have_posts() ) : $faq_query->the_post(); ?>
                    <div class="faq-item">
                        <div class="faq-question" data-toggle="faq">
                            <h3><?php the_title(); ?></h3>
                            <i class="fa fa-plus"></i> <!-- Plus icon for collapsed state -->
                        </div>
                        <div class="faq-answer" style="display: none;">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile;
            endif;
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>