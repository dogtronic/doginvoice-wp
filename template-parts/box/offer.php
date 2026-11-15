<?php

/**
 * Doginvoice Box: plakietka oferty przedsprzedażowej (cena + wysyłka)
 *
 * Używana w hero i w sekcji „Kup”. Ceny i daty przychodzą z $box_offer
 * w page-doginvoice-box.php — zmieniać tylko tam.
 *
 * @package doginvoice
 */

$offer = $args['offer'];
?>
<div class="box-offer" role="group" aria-label="Oferta przedsprzedażowa">
  <span class="box-offer-tag">Przedsprzedaż</span>
  <div class="box-offer-cell">
    <span class="box-offer-cell-label">Cena do <?php echo esc_html( $offer['presale_end'] ); ?></span>
    <span class="box-offer-cell-prices">
      <strong class="box-offer-cell-value box-offer-cell-value--price"><?php echo esc_html( $offer['price'] ); ?> zł</strong>
    </span>
    <span class="box-offer-cell-after">Potem <?php echo esc_html( $offer['price_normal'] ); ?> zł</span>
  </div>
  <div class="box-offer-cell">
    <span class="box-offer-cell-label">Wysyłka</span>
    <strong class="box-offer-cell-value"><?php echo esc_html( $offer['shipping'] ); ?></strong>
  </div>
</div>
