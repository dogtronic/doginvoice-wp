<?php
/**
 * Landing: ciemny baner z głównym przyciskiem.
 *
 * @package doginvoice
 */

$lp_section = $args['section'];
$lp_id      = $args['id'];
$lp_cta     = doginvoice_landing_cta();
?>
    <!-- ===== LANDING: BANER Z PRZYCISKIEM ===== -->
    <section id="<?php echo esc_attr( $lp_id ); ?>" class="lp-section max-width" aria-labelledby="<?php echo esc_attr( $lp_id ); ?>-title">
      <div class="lp-banner" data-aos="fade-up">
        <h2 id="<?php echo esc_attr( $lp_id ); ?>-title" class="lp-banner-title typography--h3" data-remove-orphans>
          <?php echo esc_html( $lp_section['title'] ?? '' ); ?>
        </h2>
        <?php if ( ! empty( $lp_section['description'] ) ) : ?>
          <p class="lp-banner-description typography--body-lg" data-remove-orphans>
            <?php echo esc_html( $lp_section['description'] ); ?>
          </p>
        <?php endif; ?>
        <div class="lp-banner-cta">
          <?php doginvoice_landing_cta_button( 'baner' ); ?>
        </div>
        <?php if ( $lp_cta['note'] ) : ?>
          <p class="lp-banner-note typography--body-sm"><?php echo esc_html( $lp_cta['note'] ); ?></p>
        <?php endif; ?>
      </div>
    </section>
