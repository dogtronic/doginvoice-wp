<?php

/**
 * Doginvoice Box: Kup — zdjęcie + specyfikacja
 *
 * Cena i termin wysyłki: template-parts/box/offer.php.
 *
 * @package doginvoice
 */

$buy_url = $args['buy_url'];
$img     = $args['assets'] . '/images/box';
?>
<!-- ===== KUP ===== -->
<section id="kup" class="box-buy" aria-labelledby="box-buy-title">
  <div class="box-buy-inner max-width">
    <img
      class="box-buy-photo"
      src="<?php echo esc_url($img . '/04-prawy-800.webp'); ?>"
      srcset="<?php echo esc_url($img . '/04-prawy-800.webp'); ?> 800w, <?php echo esc_url($img . '/04-prawy-1600.webp'); ?> 1600w"
      sizes="(min-width: 768px) 45vw, 100vw"
      alt="Doginvoice Box z pulpitem na ekranie, widziany z góry"
      width="2400"
      height="1600"
      loading="lazy"
      data-aos="fade-up" />
    <div class="box-buy-content" data-aos="fade-up" data-aos-delay="100">
      <h2 id="box-buy-title" class="box-buy-content-title typography--h2" data-remove-orphans>Postaw firmę na biurku</h2>
      <p class="box-buy-content-lead typography--body-lg" data-remove-orphans>
        Pierwsze w Polsce urządzenie, które pokazuje jak działą Twoja firma.
      </p>
      <dl class="box-buy-specs">
        <div class="box-buy-specs-row">
          <dt>Ekran</dt>
          <dd>dotykowy 3,5″</dd>
        </div>
        <div class="box-buy-specs-row">
          <dt>Zasilanie</dt>
          <dd>USB-C</dd>
        </div>
        <div class="box-buy-specs-row">
          <dt>Wymaga</dt>
          <dd>konta Doginvoice Professional</dd>
        </div>
      </dl>
      <p class="box-buy-note typography--body-md" data-remove-orphans>
        Przy zakupie Doginvoice Box dostajesz 1 miesiąc konta Professional w Doginvoice za darmo. Potem <?php echo esc_html($args['offer']['plan_price']); ?> miesięcznie (w planie rocznym).
      </p>
      <div class="box-buy-content-offer">
        <?php get_template_part('template-parts/box/offer', null, $args); ?>
      </div>
      <a href="<?php echo esc_url($buy_url); ?>" class="btn" size="bg" color="green" data-box-order="kup">
        <span class="btn-title">Zamów</span>
      </a>
      <p class="box-buy-guarantee typography--body-md">
        <?php echo esc_html($args['offer']['return_days']); ?> dni na zwrot bez podawania powodu.
      </p>
    </div>
  </div>
</section>