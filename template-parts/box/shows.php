<?php

/**
 * Doginvoice Box: Co pokazuje Box
 *
 * @package doginvoice
 */

$img = $args['assets'] . '/images/box';
?>
<!-- ===== CO POKAZUJE BOX ===== -->
<section id="co" class="box-shows max-width" aria-labelledby="box-shows-title">
  <header class="box-head">
    <div class="badge badge--light" data-aos="fade-up">
      <span class="badge-text">Co pokazuje Box</span>
    </div>
    <h2 id="box-shows-title" class="box-head-title typography--h2" data-aos="fade-up" data-remove-orphans>
      Najważniejsze dane masz na biurku, nie w dziesięciu programach.
    </h2>
    <p class="box-head-description typography--body-xl" data-aos="fade-up" data-remove-orphans>
      Zero logowania. Zero klikania.
    </p>
  </header>

  <div class="box-shows-grid">
    <article class="box-card" data-aos="fade-up" data-aos-delay="50">
      <div class="box-card-pic">
        <div class="box-card-zoom">
        <img src="<?php echo esc_url($img . '/05-przod-pusty-800.webp'); ?>" srcset="<?php echo esc_url($img . '/05-przod-pusty-800.webp'); ?> 800w, <?php echo esc_url($img . '/05-przod-pusty-1600.webp'); ?> 1600w" sizes="(min-width: 768px) 45vw, 100vw" alt="Doginvoice Box z animacją pulpitu: wynik miesiąca" width="2400" height="1600" loading="lazy" />
        <picture>
          <source media="(prefers-reduced-motion: reduce)" srcset="<?php echo esc_url($img . '/animacje/jasny/miesiac.webp'); ?>" />
          <img class="box-card-anim" src="<?php echo esc_url($img . '/animacje/jasny/miesiac.gif'); ?>" alt="" width="420" height="280" loading="lazy" decoding="async" />
        </picture>
        </div>
      </div>
      <h3 class="box-card-title typography--h4">Aktualne wyniki Twojej firmy</h3>
      <p class="box-card-description typography--body-lg" data-remove-orphans>Przychody, koszty i zysk. Liczą się automatycznie.</p>
    </article>

    <article class="box-card" data-aos="fade-up" data-aos-delay="100">
      <div class="box-card-pic">
        <div class="box-card-zoom">
        <img src="<?php echo esc_url($img . '/05-przod-pusty-800.webp'); ?>" srcset="<?php echo esc_url($img . '/05-przod-pusty-800.webp'); ?> 800w, <?php echo esc_url($img . '/05-przod-pusty-1600.webp'); ?> 1600w" sizes="(min-width: 768px) 45vw, 100vw" alt="Doginvoice Box z animacją powiadomienia o wpłacie" width="2400" height="1600" loading="lazy" />
        <picture>
          <source media="(prefers-reduced-motion: reduce)" srcset="<?php echo esc_url($img . '/animacje/jasny/wplaty.webp'); ?>" />
          <img class="box-card-anim" src="<?php echo esc_url($img . '/animacje/jasny/wplaty.gif'); ?>" alt="" width="420" height="280" loading="lazy" decoding="async" />
        </picture>
        </div>
      </div>
      <h3 class="box-card-title typography--h4">Wpłaty na Twój rachunek</h3>
      <p class="box-card-description typography--body-lg" data-remove-orphans>Analizujemy przelewy na Twoim koncie bankowe. Dopasowujemy je do faktur.</p>
    </article>

    <article class="box-card" data-aos="fade-up" data-aos-delay="50">
      <div class="box-card-pic">
        <div class="box-card-zoom">
        <img src="<?php echo esc_url($img . '/05-przod-pusty-800.webp'); ?>" srcset="<?php echo esc_url($img . '/05-przod-pusty-800.webp'); ?> 800w, <?php echo esc_url($img . '/05-przod-pusty-1600.webp'); ?> 1600w" sizes="(min-width: 768px) 45vw, 100vw" alt="Doginvoice Box z animacją nowej faktury z KSeF" width="2400" height="1600" loading="lazy" />
        <picture>
          <source media="(prefers-reduced-motion: reduce)" srcset="<?php echo esc_url($img . '/animacje/jasny/ksef.webp'); ?>" />
          <img class="box-card-anim" src="<?php echo esc_url($img . '/animacje/jasny/ksef.gif'); ?>" alt="" width="420" height="280" loading="lazy" decoding="async" />
        </picture>
        </div>
      </div>
      <h3 class="box-card-title typography--h4">Faktury z KSeF</h3>
      <p class="box-card-description typography--body-lg" data-remove-orphans>Kosztowe i sprzedażowe – w chwili, gdy trafią do systemu poinformujemy Cię o tym.</p>
    </article>

    <article class="box-card" data-aos="fade-up" data-aos-delay="100">
      <div class="box-card-pic">
        <div class="box-card-zoom">
        <img src="<?php echo esc_url($img . '/05-przod-pusty-800.webp'); ?>" srcset="<?php echo esc_url($img . '/05-przod-pusty-800.webp'); ?> 800w, <?php echo esc_url($img . '/05-przod-pusty-1600.webp'); ?> 1600w" sizes="(min-width: 768px) 45vw, 100vw" alt="Doginvoice Box z animacją ekranu należności i terminów" width="2400" height="1600" loading="lazy" />
        <picture>
          <source media="(prefers-reduced-motion: reduce)" srcset="<?php echo esc_url($img . '/animacje/jasny/naleznosci.webp'); ?>" />
          <img class="box-card-anim" src="<?php echo esc_url($img . '/animacje/jasny/naleznosci.gif'); ?>" alt="" width="420" height="280" loading="lazy" decoding="async" />
        </picture>
        <span class="box-card-led" aria-hidden="true"></span>
        </div>
      </div>
      <h3 class="box-card-title typography--h4">
        Terminy płatności
        <span class="box-card-leds" aria-hidden="true">
          <i style="--led: #4fd15f"></i><i style="--led: #f5a524"></i><i style="--led: #ef4444"></i>
        </span>
      </h3>
      <p class="box-card-description typography--body-lg" data-remove-orphans>Dioda: zielona – spokój, pomarańczowa – płatność dziś lub jutro, czerwona – coś po terminie. Już nic nie przegagpisz.</p>
    </article>
  </div>
</section>