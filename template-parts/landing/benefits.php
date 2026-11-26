<?php
/**
 * Landing: korzyści (kafelki). Kafelki mają wygląd sekcji „Dlaczego DogInvoice?”
 * ze strony głównej (src/scss/_why-us.scss).
 *
 * @package doginvoice
 */

$lp_section = $args['section'];
$lp_id      = $args['id'];
$lp_items   = array_values( array_filter( (array) ( $lp_section['items'] ?? array() ) ) );

if ( ! $lp_items ) {
	return;
}

// 2 i 4 kafelki układają się w dwie kolumny, pozostałe liczby w trzy.
$lp_count = count( $lp_items );
?>
    <!-- ===== LANDING: KORZYŚCI ===== -->
    <section id="<?php echo esc_attr( $lp_id ); ?>" class="lp-section max-width" aria-labelledby="<?php echo esc_attr( $lp_id ); ?>-title">
      <?php doginvoice_landing_head( $lp_section, $lp_id . '-title' ); ?>

      <ul class="why-us-grid<?php echo 2 === $lp_count || 4 === $lp_count ? ' lp-grid--two' : ''; ?>">
        <?php foreach ( $lp_items as $lp_index => $lp_item ) : ?>
          <li
            class="why-us-grid-item"
            data-aos="fade-up"
            data-aos-delay="<?php echo esc_attr( ( $lp_index % 3 ) * 100 ); ?>">
            <?php if ( ! empty( $lp_item['icon']['url'] ) ) : ?>
              <span class="why-us-grid-item-icon">
                <img
                  src="<?php echo esc_url( $lp_item['icon']['url'] ); ?>"
                  alt=""
                  width="48"
                  height="48"
                  loading="lazy" />
              </span>
            <?php endif; ?>
            <h3 class="why-us-grid-item-title typography--h4"><?php echo esc_html( $lp_item['title'] ?? '' ); ?></h3>
            <?php if ( ! empty( $lp_item['description'] ) ) : ?>
              <p class="why-us-grid-item-description typography--body-md" data-remove-orphans>
                <?php echo esc_html( $lp_item['description'] ); ?>
              </p>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
