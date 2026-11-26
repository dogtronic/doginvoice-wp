<?php
/**
 * Landing: liczby.
 *
 * @package doginvoice
 */

$lp_section = $args['section'];
$lp_id      = $args['id'];
$lp_items   = array_values( array_filter( (array) ( $lp_section['items'] ?? array() ) ) );

if ( ! $lp_items ) {
	return;
}
?>
    <!-- ===== LANDING: LICZBY ===== -->
    <section id="<?php echo esc_attr( $lp_id ); ?>" class="lp-section max-width" aria-labelledby="<?php echo esc_attr( $lp_id ); ?>-title">
      <?php doginvoice_landing_head( $lp_section, $lp_id . '-title' ); ?>

      <dl class="lp-stats" data-aos="fade-up">
        <?php foreach ( $lp_items as $lp_item ) : ?>
          <div class="lp-stat">
            <dt class="lp-stat-label typography--body-md"><?php echo esc_html( $lp_item['label'] ?? '' ); ?></dt>
            <dd class="lp-stat-value ff-special"><?php echo esc_html( $lp_item['value'] ?? '' ); ?></dd>
          </div>
        <?php endforeach; ?>
      </dl>
    </section>
