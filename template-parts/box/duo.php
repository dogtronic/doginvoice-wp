<?php

/**
 * Doginvoice Box: Box + Doginvoice
 *
 * @package doginvoice
 */

$img = $args['assets'] . '/images/box';
?>
<!-- ===== BOX + DOGINVOICE ===== -->
<section id="doginvoice" class="box-duo max-width" aria-labelledby="box-duo-title">
  <header class="box-head">
    <div class="badge badge--light" data-aos="fade-up">
      <span class="badge-text">Box + Doginvoice</span>
    </div>
    <h2 id="box-duo-title" class="box-head-title typography--h2" data-aos="fade-up" data-remove-orphans>
      Doginvoice oszczędza Twój czas
    </h2>
    <p class="box-head-description typography--body-xl" data-aos="fade-up" data-remove-orphans>
      Fakturami, KSeF, analityką i płatnościami zajmuje się aplikacja. <br /> Box pokazuje Ci efekt.
    </p>
  </header>

  <div class="box-split" data-aos="fade-up">
    <div class="box-split-photo">
      <img src="<?php echo esc_url($img . '/01-hero-800.webp'); ?>" srcset="<?php echo esc_url($img . '/01-hero-800.webp'); ?> 800w, <?php echo esc_url($img . '/01-hero-1600.webp'); ?> 1600w" sizes="(min-width: 768px) 45vw, 100vw" alt="Doginvoice Box z pulpitem na ekranie" width="2400" height="1600" loading="lazy" />
    </div>
    <div class="box-split-text">
      <div class="badge badge--green" style="display: none;">
        <span class="badge-text">Jak to połączyć</span>
      </div>
      <h3 class="box-split-text-title typography--h3">Nowoczesna aplikacja, która pilnuje finansów Twojej firmy</h3>
      <p class="box-split-text-description typography--body-lg" data-remove-orphans>

        Od wpływu faktury, przez odczyt danych, po rozliczenie płatności.
      </p>
      <ul class="box-split-text-list standard-list">
        <li>Analityka finansowa - pulpit aktualizowany na żywo</li>
        <li>Faktury z KSeF pobierają się automatycznie</li>
        <li>Doginvoice dopasowuje wpłaty do faktur</li>

      </ul>
      <div class="box-split-text-cta">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn" size="bg" color="green">
          <span class="btn-title">Poznaj Doginvoice</span>
        </a>
        <a href="<?php echo esc_url(home_url('/#price')); ?>" class="btn" size="bg" color="border">
          <span class="background"></span>
          <span class="btn-title">Zobacz cennik</span>
        </a>
      </div>
    </div>
  </div>
</section>