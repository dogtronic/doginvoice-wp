<?php
/**
 * Landing: blok tekstu (np. warunki promocji).
 *
 * @package doginvoice
 */

$lp_section = $args['section'];
$lp_id      = $args['id'];
$lp_title   = trim( (string) ( $lp_section['title'] ?? '' ) );
$lp_text    = (string) ( $lp_section['text'] ?? '' );

if ( '' === trim( wp_strip_all_tags( $lp_text ) ) ) {
	return;
}
?>
    <!-- ===== LANDING: TEKST ===== -->
    <section id="<?php echo esc_attr( $lp_id ); ?>" class="lp-section max-width">
      <div class="lp-note" data-aos="fade-up">
        <?php if ( $lp_title ) : ?>
          <h2 class="lp-note-title typography--h4"><?php echo esc_html( $lp_title ); ?></h2>
        <?php endif; ?>
        <div class="lp-note-text typography--body-md">
          <?php echo wp_kses_post( $lp_text ); ?>
        </div>
      </div>
    </section>
