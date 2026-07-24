<?php
/**
 * Front page section: Wszystkie funkcje
 *
 * @package doginvoice
 */
?>
    <?php
    $features_badge = get_field( 'features_badge' );
    $features_title = get_field( 'features_title' );
    ?>
    <!-- ===== WSZYSTKIE FUNKCJE ===== -->
    <section
      id="features"
      class="features"
      aria-labelledby="features-head-title">
      <header class="features-head">
        <div class="features-head-badge badge badge--dark" data-aos="fade-up">
          <span class="badge-text"><?php echo esc_html( $features_badge ); ?></span>
        </div>
        <h2
          id="features-head-title"
          class="features-head-title typography--h2"
          data-remove-orphans
          data-aos="fade-up">
          <?php echo esc_html( $features_title ); ?>
        </h2>
      </header>

      <div class="features-swiper swiper">
        <div class="swiper-wrapper">
          <?php while ( have_rows( 'features_items' ) ) : the_row(); ?>
            <?php $feature_icon = get_sub_field( 'icon' ); ?>
            <div class="features-swiper-item swiper-slide">
              <span class="features-swiper-item-icon">
                <img
                  src="<?php echo esc_url( $feature_icon['url'] ); ?>"
                  alt="<?php echo esc_attr( $feature_icon['alt'] ); ?>"
                  width="48"
                  height="48" />
              </span>
              <h3 class="features-swiper-item-title typography--h4">
                <?php echo esc_html( get_sub_field( 'title' ) ); ?>
              </h3>
              <p class="features-swiper-item-description typography--body-md">
                <?php echo esc_html( get_sub_field( 'description' ) ); ?>
              </p>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </section>
