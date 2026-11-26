<?php
/**
 * Landing: kroki (1, 2, 3).
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
    <!-- ===== LANDING: KROKI ===== -->
    <section id="<?php echo esc_attr( $lp_id ); ?>" class="lp-section max-width" aria-labelledby="<?php echo esc_attr( $lp_id ); ?>-title">
      <?php doginvoice_landing_head( $lp_section, $lp_id . '-title' ); ?>

      <ol class="lp-steps lp-steps--<?php echo esc_attr( count( $lp_items ) ); ?>">
        <?php foreach ( $lp_items as $lp_index => $lp_item ) : ?>
          <li class="lp-step" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $lp_index * 100 ); ?>">
            <span class="lp-step-number" aria-hidden="true"><?php echo esc_html( $lp_index + 1 ); ?></span>
            <h3 class="lp-step-title typography--h4"><?php echo esc_html( $lp_item['title'] ?? '' ); ?></h3>
            <?php if ( ! empty( $lp_item['description'] ) ) : ?>
              <p class="lp-step-description typography--body-md" data-remove-orphans>
                <?php echo esc_html( $lp_item['description'] ); ?>
              </p>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ol>
    </section>
