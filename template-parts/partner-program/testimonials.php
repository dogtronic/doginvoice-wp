<?php

/**
 * Program partnerski: Opinie
 *
 * Te same opinie co na stronie głównej — pobierane z ACF strony ustawionej
 * jako "Twoja strona główna" (Ustawienia > Czytanie), nie duplikowane.
 *
 * @package doginvoice
 */
?>
<?php
$partner_testimonials_source_id = (int) get_option('page_on_front');
$testimonials_badge             = get_field('testimonials_badge', $partner_testimonials_source_id);
$testimonials_title             = get_field('testimonials_title', $partner_testimonials_source_id);
$testimonial_avatar_colors      = array('lime', 'green', 'teal', 'mint');
$testimonial_index              = 0;
?>
<!-- ===== OPINIE ===== -->
<section
  id="opinie"
  class="testimonials"
  aria-labelledby="partner-testimonials-title">
  <header class="testimonials-header">
    <div
      class="testimonials-header-badge badge badge--light"
      data-aos="fade-up">
      <span class="badge-text">Opinie</span>
    </div>
    <h2
      id="partner-testimonials-title"
      class="testimonials-header-title typography--h2"
      data-remove-orphans
      data-aos="fade-up">
      Co mówią o DogInvoice klienci?
    </h2>
  </header>

  <div class="testimonials-swiper swiper" data-aos="fade-up">
    <div class="swiper-wrapper">
      <?php while (have_rows('testimonials_items', $partner_testimonials_source_id)) : the_row(); ?>
        <?php
        $testimonial_name   = get_sub_field('name');
        $testimonial_rating = (int) get_sub_field('rating');
        $testimonial_body   = array_filter(array_map('trim', explode("\n", (string) get_sub_field('body'))));

        $name_words = preg_split('/\s+/', trim((string) $testimonial_name));
        $initials   = '';
        foreach (array_slice($name_words, 0, 2) as $word) {
          $initials .= mb_substr($word, 0, 1);
        }
        $initials = mb_strtoupper($initials);

        $avatar_color = $testimonial_avatar_colors[$testimonial_index % count($testimonial_avatar_colors)];
        $testimonial_index++;
        ?>
        <article class="testimonials-card swiper-slide">
          <img
            class="testimonials-card-quote"
            src="<?php echo get_template_directory_uri(); ?>/src/assets/images/quote.svg"
            alt=""
            width="61"
            height="46"
            aria-hidden="true" />
          <header class="testimonials-card-header">
            <span
              class="testimonials-card-avatar testimonials-card-avatar--<?php echo esc_attr($avatar_color); ?>"
              aria-hidden="true"><?php echo esc_html($initials); ?></span>
            <div class="testimonials-card-meta">
              <h3 class="testimonials-card-name typography--body-lg">
                <?php echo esc_html($testimonial_name); ?>
              </h3>
              <p class="testimonials-card-company typography--body-sm">
                <?php echo esc_html(get_sub_field('company')); ?>
              </p>
            </div>
          </header>
          <div class="testimonials-card-body typography--body-md">
            <?php foreach ($testimonial_body as $paragraph) : ?>
              <p><?php echo esc_html($paragraph); ?></p>
            <?php endforeach; ?>
          </div>
          <div class="testimonials-card-stars" aria-label="Ocena: <?php echo esc_attr($testimonial_rating); ?> na 5">
            <?php for ($star = 0; $star < $testimonial_rating; $star++) : ?>
              <span aria-hidden="true">★</span>
            <?php endfor; ?>
          </div>
        </article>
      <?php endwhile; ?>
    </div>
  </div>
</section>