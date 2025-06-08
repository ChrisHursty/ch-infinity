<section class="container-fw faq-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 faq-content-big-container">
                <h2>
                    <?php $faq_title = get_field('faq_title', 'option');
                    if ($faq_title) {
                        echo esc_html($faq_title);
                    } ?>
                </h2>
                <p>
                    <?php $faq_description = get_field('faq_intro', 'option');
                    if ($faq_description) {
                        echo wp_kses_post($faq_description);
                    } else {
                        echo 'Here are some frequently asked questions to help you understand more about my services.';
                    } ?>
                </p>
            </div>
            <div class="col-sm-12 col-md-8 faq-content-big">
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
    </div>
</section>