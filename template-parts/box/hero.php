<?php

/**
 * Doginvoice Box: Hero + film
 *
 * @package doginvoice
 */

$buy_url = $args['buy_url'];
$assets  = $args['assets'];

// Film i okładka bywają podmieniane pod tą samą nazwą: wersja z daty pliku omija cache.
$film_path   = '/videos/produkt_16x9.mp4';
$poster_path = '/images/box/produkt_16x9_okladka.jpg';
$film_ver    = (string) @filemtime(get_template_directory() . '/src/assets' . $film_path);
$film_url    = doginvoice_box_media_url('produkt_16x9.mp4', '/src/assets' . $film_path); // film z R2, patrz inc/box.php
$poster_url  = add_query_arg('v', $film_ver, $assets . $poster_path);
?>
<!-- ===== HERO ===== -->
<section class="box-hero max-width" aria-labelledby="box-hero-title">
  <div class="box-hero-content">
    <h1
      id="box-hero-title"
      class="box-hero-content-title typography--h1"
      data-aos="fade-up"
      data-remove-orphans>
      Twoje finanse. Na biurku. Na żywo.
    </h1>
    <p
      class="box-hero-content-subtitle typography--body-xl"
      data-aos="fade-up"
      data-aos-delay="100"
      data-remove-orphans>
      <span class="highlight">Doginvoice Box to pierwsze takie urządzenie</span>, które informuje Cię na bieżąco co dzieje się w Twojej firmie. Wyniki, płatności, przelewy, KSeF.
    </p>
    <div class="box-hero-content-cta" data-aos="fade-up" data-aos-delay="150">
      <a href="<?php echo esc_url($buy_url); ?>" class="btn" size="bg" color="green" data-box-order="hero">
        <span class="btn-title">Zamów</span>
      </a>
      <a href="#co" class="btn" size="bg" color="white">
        <span class="btn-title">Funkcje</span>
        <svg class="btn-icon" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M6 4.5l12 7.5-12 7.5 3.5-7.5z" />
        </svg>
      </a>
    </div>
  </div>

  <div class="box-hero-stage" data-aos="fade-up" data-aos-delay="200">
    <div class="box-hero-film-wrap">
      <div class="box-hero-new">
        <svg viewBox="0 0 100 100" aria-hidden="true">
          <polygon points="50.0,0.0 57.4,8.1 67.1,3.0 71.2,13.2 82.1,11.7 82.6,22.7 93.3,25.0 89.9,35.5 99.2,41.3 92.5,50.0 99.2,58.7 89.9,64.5 93.3,75.0 82.6,77.3 82.1,88.3 71.3,86.8 67.1,97.0 57.4,91.9 50.0,100.0 42.6,91.9 32.9,97.0 28.7,86.8 17.9,88.3 17.4,77.3 6.7,75.0 10.1,64.5 0.8,58.7 7.5,50.0 0.8,41.3 10.1,35.5 6.7,25.0 17.4,22.7 17.9,11.7 28.8,13.2 32.9,3.0 42.6,8.1" />
        </svg>
        <span class="box-hero-new-text">Nowość</span>
      </div>
      <div class="box-hero-film">
        <video
          id="box-film"
          autoplay
          muted
          loop
          playsinline
          preload="metadata"
          poster="<?php echo esc_url($poster_url); ?>"
          aria-label="Doginvoice Box pokazuje pulpit, wpłatę i fakturę z KSeF">
          <source src="<?php echo esc_url($film_url); ?>" type="video/mp4" />
        </video>
        <button class="box-hero-film-sound" id="box-film-sound" type="button" aria-pressed="false">Włącz dźwięk</button>
      </div>
    </div>
  </div>

  <div class="box-hero-offer" data-aos="fade-up">
    <?php get_template_part('template-parts/box/offer', null, $args); ?>
  </div>
</section>