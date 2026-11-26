<?php
/**
 * Landing: pasek logotypów firm wgranych dla tej kampanii. Te same klasy
 * i skrypt co pasek zaufania na stronie głównej (src/scss/_logos.scss,
 * src/js/logos-swiper.js). Bez wgranych logotypów sekcja się nie wyświetla.
 *
 * @package doginvoice
 */

$lp_section = $args['section'];
$lp_logos   = array_values( array_filter( (array) ( $lp_section['items'] ?? array() ) ) );
$lp_heading = trim( (string) ( $lp_section['heading'] ?? '' ) );

if ( ! $lp_logos ) {
	return;
}
?>
    <!-- ===== LANDING: LOGOTYPY ===== -->
    <section class="trust" aria-label="<?php echo esc_attr( $lp_heading ? $lp_heading : 'Logotypy firm' ); ?>">
      <?php if ( $lp_heading ) : ?>
        <p class="trust-heading typography--body-sm" data-aos="fade-up"><?php echo esc_html( $lp_heading ); ?></p>
      <?php endif; ?>
      <div class="trust-logos swiper">
        <div class="swiper-wrapper">
          <?php foreach ( $lp_logos as $lp_logo ) : ?>
            <div class="trust-logos-item swiper-slide">
              <img
                class="trust-logos-item-image"
                src="<?php echo esc_url( $lp_logo['url'] ?? '' ); ?>"
                alt="<?php echo esc_attr( $lp_logo['alt'] ?? '' ); ?>" />
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
