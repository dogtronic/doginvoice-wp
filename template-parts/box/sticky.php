<?php

/**
 * Doginvoice Box: przyklejony pasek zakupu na mobile
 *
 * Pokazuje się po przewinięciu hero, chowa przy sekcji „Kup” i stopce
 * (src/js/box.js). Na desktopie ukryty w CSS.
 *
 * @package doginvoice
 */

$offer = $args['offer'];
?>
<div class="box-sticky" id="box-sticky" aria-hidden="true">
  <div class="box-sticky-info">
    <span class="box-sticky-name">Doginvoice Box</span>
    <span class="box-sticky-price">
      <strong><?php echo esc_html( $offer['price'] ); ?> zł</strong>
      <s><?php echo esc_html( $offer['price_normal'] ); ?> zł</s>
      <span>do <?php echo esc_html( substr( $offer['presale_end'], 0, 5 ) ); ?></span>
    </span>
  </div>
  <a href="<?php echo esc_url( $args['buy_url'] ); ?>" class="box-sticky-button btn" size="bg" color="green" tabindex="-1" data-box-order="pasek">
    <span class="btn-title">Zamów</span>
  </a>
</div>
