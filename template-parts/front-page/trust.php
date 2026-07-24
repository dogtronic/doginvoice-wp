<?php
/**
 * Front page section: Trust bar / logotypy klientów
 *
 * @package doginvoice
 */
?>
    <!-- ===== PASEK ZAUFANIA / LOGO KLIENTÓW ===== -->
    <section class="trust" aria-label="Zaufali nam">
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
