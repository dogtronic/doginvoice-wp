<?php

/**
 * Template Name: Doginvoice Box
 *
 * Landing page urządzenia Doginvoice Box. Treść sekcji jest wpisana wprost
 * w template-parts/box/*.php (bez ACF). Style: src/scss/_box.scss,
 * skrypt: src/js/box.js.
 *
 * Do uzupełnienia, gdy będzie znany sklep: $box_shop_url poniżej trafia do
 * wszystkich przycisków „Kup”. Dopóki jest pusty, przyciski przewijają do
 * sekcji #kup.
 *
 * @package doginvoice
 */

$box_shop_url = 'https://buy.stripe.com/3cIeV7diL1Fy1vx4X0asg00';

// Ceny i daty: doginvoice_box_offer() w inc/box.php.
$box_offer = doginvoice_box_offer();

$box_args = array(
  'buy_url' => $box_shop_url ? $box_shop_url : '#kup',
  'assets'  => get_template_directory_uri() . '/src/assets',
  'offer'   => $box_offer,
);

// Ten sam adres dla przycisku w sekcji CTA nad stopką (footer.php).
set_query_var('box_buy_url', $box_args['buy_url']);

get_header();
?>
<main id="gora" class="box-page">
  <?php get_template_part('template-parts/box/hero', null, $box_args); ?>
  <?php get_template_part('template-parts/box/till', null, $box_args); ?>
  <?php get_template_part('template-parts/box/shows', null, $box_args); ?>
  <?php get_template_part('template-parts/box/who', null, $box_args); ?>

  <?php get_template_part('template-parts/box/duo', null, $box_args); ?>
  <?php get_template_part('template-parts/box/steps', null, $box_args); ?>
  <?php get_template_part('template-parts/box/buy', null, $box_args); ?>
  <?php get_template_part('template-parts/box/faq', null, $box_args); ?>
  <?php get_template_part('template-parts/box/sticky', null, $box_args); ?>
</main>
<?php
// Dane produktu dla wyszukiwarek (cena i dostępność z $box_offer).
$box_date    = static function ( $pl_date ) {
  $date = DateTime::createFromFormat( 'd.m.Y', $pl_date );
  return $date ? $date->format( 'Y-m-d' ) : '';
};
$box_product = array(
  '@context'    => 'https://schema.org',
  '@type'       => 'Product',
  'name'        => 'Doginvoice Box',
  'description' => 'Mały ekran na biurko, który pokazuje wpłaty, faktury z KSeF, terminy i wynik miesiąca z konta Doginvoice.',
  'image'       => $box_args['assets'] . '/images/box/01-hero.jpg',
  'brand'       => array(
    '@type' => 'Brand',
    'name'  => 'Doginvoice',
  ),
  'offers'      => array(
    '@type'                   => 'Offer',
    'url'                     => get_permalink(),
    'price'                   => (string) $box_offer['price'],
    'priceCurrency'           => 'PLN',
    'priceValidUntil'         => $box_date( $box_offer['presale_end'] ),
    'availability'            => 'https://schema.org/PreOrder',
    'availabilityStarts'      => $box_date( $box_offer['shipping'] ),
    'hasMerchantReturnPolicy' => array(
      '@type'                => 'MerchantReturnPolicy',
      'applicableCountry'    => 'PL',
      'returnPolicyCategory' => 'https://schema.org/MerchantReturnFiniteReturnWindow',
      'merchantReturnDays'   => $box_offer['return_days'],
    ),
  ),
);
?>
<script type="application/ld+json">
  <?php echo wp_json_encode( $box_product, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?>
</script>
<?php
get_footer();
