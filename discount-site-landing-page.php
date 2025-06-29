<?php
/**
 * Template Name: Discount Site Landing Page
 * Description: Custom landing page using Lovable layout and ACF fields
 */

get_header();
?>

<main id="primary" class="site-main">

  <!-- Hero Section -->
  <section class="container home-hero">
    <div class="row">
      <div class="col-md-6 hero-content">
        <div class="limited-badge">
          <?php if ($badge = get_field('hero_badge')) echo '<span class="badge">' . esc_html($badge) . '</span>'; ?>
        </div>
        <h1 class="site-tagline">Professional WordPress Website</h1>
        <h2><?php echo wp_kses_post(get_field('hero_heading')); ?></h2>
        <div class="intro">
          <?php if ($intro = get_field('hero_intro')) echo wp_kses_post($intro); ?>
        </div>
        <div class="button-box">
          <?php if ($btn = get_field('hero_button_primary')) echo '<a class="button primary" href="' . esc_url($btn['url']) . '">' . esc_html($btn['title']) . '</a>'; ?>
          <?php if ($btn2 = get_field('hero_button_secondary')) echo '<a class="button secondary" href="' . esc_url($btn2['url']) . '">' . esc_html($btn2['title']) . '</a>'; ?>
        </div>
      </div>
      <div class="col-md-6 hero-image">
        <?php 
        $hero_image = get_field('hero_image');
        if ($hero_image) {
            $image_url = $hero_image['url'];
            $alt_text = !empty($hero_image['alt']) ? $hero_image['alt'] : 'Website preview';
            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($alt_text) . '">';
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Icons Row -->
  <?php if (have_rows('icon_row')): ?>
  <section class="container icon-section py-4">
    <div class="row justify-content-center">
      <?php while (have_rows('icon_row')): the_row(); ?>
        <div class="col-md-4 col-sm-6 text-center icon-box mb-4">
          <?php if ($icon = get_sub_field('icon')): ?>
            <img src="<?php echo esc_url($icon['url']); ?>" alt="" class="icon-img mb-2">
          <?php endif; ?>
          <p class="icon-label font-weight-bold"><?php the_sub_field('label'); ?></p>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- Features Section -->
  <?php if (have_rows('features_grid')): ?>
  <section class="container features py-5 bg-light">
    <div class="row">
      <?php while (have_rows('features_grid')): the_row(); ?>
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="feature-box p-4 bg-white h-100 shadow-sm">
            <h3 class="h5 font-weight-bold mb-2"><?php the_sub_field('title'); ?></h3>
            <p><?php the_sub_field('description'); ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- Testimonials Section -->
  <?php if (have_rows('testimonials')): ?>
  <section class="container testimonials py-5">
    <div class="row">
      <?php while (have_rows('testimonials')): the_row(); ?>
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="testimonial-box bg-white p-3 shadow-sm h-100">
            <blockquote class="mb-2">“<?php the_sub_field('quote'); ?>”</blockquote>
            <strong><?php the_sub_field('author'); ?></strong>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- Portfolio Section -->
  <?php if (have_rows('portfolio_items')): ?>
  <section class="container portfolio py-5">
    <div class="row">
      <?php while (have_rows('portfolio_items')): the_row(); ?>
        <div class="col-md-3 col-sm-6 mb-4">
          <?php $img = get_sub_field('image'); ?>
          <?php if ($img): ?>
            <div class="portfolio-item text-center">
              <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" class="img-fluid mb-2">
              <p class="small text-muted"><?php the_sub_field('title'); ?></p>
            </div>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- CTA Strip -->
  <section class="container-fluid cta-strip py-5 bg-primary text-white text-center">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h2 class="h4 mb-3"><?php the_field('cta_strip_heading'); ?></h2>
        <?php if ($cta_btn = get_field('cta_strip_button')): ?>
          <a href="<?php echo esc_url($cta_btn['url']); ?>" class="button button-light">
            <?php echo esc_html($cta_btn['title']); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- FAQ Section -->
  <?php if (have_rows('faq_items')): ?>
  <section class="container faqs py-5">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <h2 class="h4 mb-4 text-center">Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordion">
          <?php $i = 0; while (have_rows('faq_items')): the_row(); $i++; ?>
            <div class="card mb-2">
              <div class="card-header" id="heading<?php echo $i; ?>">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
                    <?php the_sub_field('question'); ?>
                  </button>
                </h5>
              </div>
              <div id="collapse<?php echo $i; ?>" class="collapse" aria-labelledby="heading<?php echo $i; ?>" data-parent="#faqAccordion">
                <div class="card-body">
                  <?php the_sub_field('answer'); ?>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- Sticky Mobile CTA -->
  <?php if ($sticky = get_field('sticky_mobile_cta')): ?>
    <div class="mobile-sticky-cta visible-xs fixed-bottom text-center p-3 bg-primary">
      <a class="button text-white font-weight-bold" href="<?php echo esc_url($sticky['url']); ?>">
        <?php echo esc_html($sticky['label']); ?>
      </a>
    </div>
  <?php endif; ?>

</main>

<?php get_footer(); ?>
