<?php
/**
 * Landing: obraz + tekst. Układ .box-split jest wspólny z zapowiedzią Boxa
 * na stronie głównej (src/scss/_box.scss).
 *
 * @package doginvoice
 */

$lp_section = $args['section'];
$lp_id      = $args['id'];
$lp_image   = $lp_section['image'] ?? null;
$lp_points  = doginvoice_landing_lines( $lp_section['points'] ?? '' );
$lp_badge   = trim( (string) ( $lp_section['badge'] ?? '' ) );
$lp_classes = 'box-split lp-split';

if ( 'right' === ( $lp_section['side'] ?? 'left' ) ) {
	$lp_classes .= ' lp-split--reverse';
}
if ( 'contain' === ( $lp_section['fit'] ?? 'cover' ) ) {
	$lp_classes .= ' lp-split--contain';
}
?>
    <!-- ===== LANDING: OBRAZ + TEKST ===== -->
    <section id="<?php echo esc_attr( $lp_id ); ?>" class="lp-section max-width" aria-labelledby="<?php echo esc_attr( $lp_id ); ?>-title">
      <div class="<?php echo esc_attr( $lp_classes ); ?>" data-aos="fade-up">
        <div class="box-split-photo">
          <?php
          if ( ! empty( $lp_image['ID'] ) ) {
            echo wp_get_attachment_image(
              $lp_image['ID'],
              'large',
              false,
              array(
                'sizes'   => '(min-width: 768px) 50vw, 100vw',
                'loading' => 'lazy',
              )
            );
          }
          ?>
        </div>
        <div class="box-split-text">
          <?php if ( $lp_badge ) : ?>
            <div class="badge badge--green">
              <span class="badge-text"><?php echo esc_html( $lp_badge ); ?></span>
            </div>
          <?php endif; ?>
          <h2 id="<?php echo esc_attr( $lp_id ); ?>-title" class="box-split-text-title typography--h3" data-remove-orphans>
            <?php echo esc_html( $lp_section['title'] ?? '' ); ?>
          </h2>
          <?php if ( ! empty( $lp_section['description'] ) ) : ?>
            <p class="box-split-text-description typography--body-lg" data-remove-orphans>
              <?php echo esc_html( $lp_section['description'] ); ?>
            </p>
          <?php endif; ?>
          <?php if ( $lp_points ) : ?>
            <ul class="box-split-text-list standard-list">
              <?php foreach ( $lp_points as $lp_point ) : ?>
                <li><?php echo esc_html( $lp_point ); ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
          <?php if ( ! empty( $lp_section['show_cta'] ) ) : ?>
            <div class="box-split-text-cta">
              <?php doginvoice_landing_cta_button( 'obraz-tekst' ); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
