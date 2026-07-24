<?php
/**
 * Front page section: Trust bar / logotypy klientów
 *
 * @package doginvoice
 */
$trust_heading = get_field( 'trust_heading' );
?>
    <!-- ===== PASEK ZAUFANIA / LOGO KLIENTÓW ===== -->
    <section class="trust" aria-label="Zaufali nam">
      <?php if ( $trust_heading ) : ?>
        <p class="trust-heading typography--body-sm" data-aos="fade-up">
          <?php echo esc_html( $trust_heading ); ?>
        </p>
      <?php endif; ?>
      <div class="trust-logos swiper">
        <div class="swiper-wrapper">
          <?php while ( have_rows( 'trust_logos' ) ) : the_row(); ?>
            <?php $trust_logo = get_sub_field( 'logo' ); ?>
            <div class="trust-logos-item swiper-slide">
              <img
                class="trust-logos-item-image"
                src="<?php echo esc_url( $trust_logo['url'] ); ?>"
                alt="<?php echo esc_attr( $trust_logo['alt'] ); ?>" />
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </section>
