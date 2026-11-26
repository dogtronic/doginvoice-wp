<?php
/**
 * Landing kampanii reklamowej (typ treści „Landingi”, adres /lp/nazwa/).
 *
 * Góra strony (hero) jest zawsze pierwsza, dalej idą sekcje w kolejności
 * ustawionej w kokpicie. Każda sekcja to plik template-parts/landing/<nazwa>.php
 * i dostaje swoją treść w $args['section']. Sekcja kończąca z przyciskiem
 * jest w footer.php. Pola ACF i funkcje pomocnicze: inc/landing.php.
 *
 * @package doginvoice
 */

// Sekcje pobierane w całości ze strony głównej (te same pliki co w front-page.php).
$landing_front_parts = array(
	'testimonials' => array( 'testimonials' ),
	'pricing'      => array( 'pricing', 'pricing-modal' ),
);

$landing_sections = function_exists( 'get_field' ) ? get_field( 'lp_sections' ) : array();

get_header();
?>
  <main id="gora" class="lp">
    <?php get_template_part( 'template-parts/landing/hero' ); ?>

    <?php
    foreach ( (array) $landing_sections as $landing_index => $landing_section ) {
      $landing_layout = $landing_section['acf_fc_layout'] ?? '';

      if ( isset( $landing_front_parts[ $landing_layout ] ) ) {
        foreach ( $landing_front_parts[ $landing_layout ] as $landing_front_part ) {
          doginvoice_landing_front_part( $landing_front_part );
        }
        continue;
      }

      get_template_part(
        'template-parts/landing/' . str_replace( '_', '-', $landing_layout ),
        null,
        array(
          'section' => $landing_section,
          'id'      => 'lp-sekcja-' . ( $landing_index + 1 ),
        )
      );
    }
    ?>
  </main>
<?php
get_footer();
