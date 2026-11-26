<?php
/**
 * Landing: góra strony (hero).
 *
 * @package doginvoice
 */

$lp_hero_badge     = trim( (string) get_field( 'lp_hero_badge' ) );
$lp_hero_title     = trim( (string) get_field( 'lp_hero_title' ) );
$lp_hero_subtitle  = trim( (string) get_field( 'lp_hero_subtitle' ) );
$lp_hero_points    = array_slice( doginvoice_landing_lines( get_field( 'lp_hero_points' ) ), 0, 3 );
$lp_hero_secondary = get_field( 'lp_hero_secondary' );
$lp_hero_image     = get_field( 'lp_hero_image' );
$lp_hero_cta       = doginvoice_landing_cta();
?>
    <!-- ===== LANDING: HERO ===== -->
    <section class="lp-hero max-width" aria-labelledby="lp-hero-title">
      <div class="lp-hero-content">
        <?php if ( $lp_hero_badge ) : ?>
          <div class="badge badge--light" data-aos="fade-up">
            <span class="badge-text"><?php echo esc_html( $lp_hero_badge ); ?></span>
          </div>
        <?php endif; ?>
        <h1 id="lp-hero-title" class="lp-hero-title typography--h1" data-remove-orphans data-aos="fade-up">
          <?php echo esc_html( $lp_hero_title ? $lp_hero_title : get_the_title() ); ?>
        </h1>
        <?php if ( $lp_hero_subtitle ) : ?>
          <p class="lp-hero-subtitle typography--body-xl" data-remove-orphans data-aos="fade-up">
            <?php echo esc_html( $lp_hero_subtitle ); ?>
          </p>
        <?php endif; ?>
        <div class="lp-hero-cta" data-aos="fade-up">
          <?php doginvoice_landing_cta_button( 'hero' ); ?>
          <?php if ( ! empty( $lp_hero_secondary['url'] ) && ! empty( $lp_hero_secondary['title'] ) ) : ?>
            <a
              href="<?php echo esc_url( $lp_hero_secondary['url'] ); ?>"
              <?php echo ! empty( $lp_hero_secondary['target'] ) ? 'target="_blank" rel="noopener"' : ''; ?>
              class="btn"
              size="bg"
              color="white">
              <span class="btn-title"><?php echo esc_html( $lp_hero_secondary['title'] ); ?></span>
            </a>
          <?php endif; ?>
        </div>
        <?php if ( $lp_hero_cta['note'] ) : ?>
          <p class="lp-hero-note typography--body-sm" data-aos="fade-up"><?php echo esc_html( $lp_hero_cta['note'] ); ?></p>
        <?php endif; ?>
        <?php if ( $lp_hero_points ) : ?>
          <ul class="lp-hero-points standard-list" data-aos="fade-up">
            <?php foreach ( $lp_hero_points as $lp_hero_point ) : ?>
              <li><?php echo esc_html( $lp_hero_point ); ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>

      <?php if ( $lp_hero_image ) : ?>
        <?php // Zielona poświata za obrazem, taka jak w hero strony głównej (.hero-middle). ?>
        <div class="lp-hero-glow" aria-hidden="true"></div>
        <div class="lp-hero-media" data-aos="fade-up">
          <?php
          echo wp_get_attachment_image(
            $lp_hero_image['ID'],
            'full',
            false,
            array(
              'sizes'         => '(min-width: 1280px) 1180px, 100vw',
              'loading'       => 'eager',
              'fetchpriority' => 'high',
            )
          );
          ?>
        </div>
      <?php endif; ?>
    </section>
