<?php

/**
 * Doginvoice Box: Kasa — przykładowe powiadomienie o wpłacie
 *
 * Powiadomienia pokazują się na ekranie konturowego Boxa: same co kilka
 * sekund, a po kliknięciu z dźwiękiem i konfetti (src/js/box.js).
 *
 * @package doginvoice
 */

$assets = $args['assets'];
?>
<!-- ===== KASA ===== -->
<section class="box-till" aria-labelledby="box-till-title">
  <div class="box-till-inner max-width">
    <div class="box-till-badge badge badge--dark" data-aos="fade-up">
      <span class="badge-text">Powiadomienia</span>
    </div>
    <h2 id="box-till-title" class="box-till-title typography--h2" data-aos="fade-up" data-remove-orphans>
      Wpłaty, których nie przegapisz
    </h2>
    <p class="box-till-description typography--body-xl" data-aos="fade-up" data-remove-orphans>
      Doginvoice sprawdza w Twoim banku, <br />czy faktura jest już opłacona
    </p>
    <button
      type="button"
      class="box-till-button"
      id="box-till"
      data-sound="<?php echo esc_url($assets . '/audio/ka-ching.mp3'); ?>">
      <span class="box-till-device">
        <?php
        // Rysunek konturowy Boxa (kolor linii ustawia CSS). To wersja „prosty”:
        // 05-przod-kontur.svg po zdjęciu perspektywy (widok na wprost, ekran 3:2).
        // Ekran w SVG: x 268–1110, y 174–735 w viewBox 1378.67×964.34 — stąd pozycja .box-till-screen.
        echo doginvoice_box_outline( '05-przod-kontur-prosty.svg', 'box-till-outline' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        ?>
        <span class="box-till-led" aria-hidden="true"></span>
        <span class="box-till-screen">
          <svg class="box-till-smile" viewBox="0 0 48 48" aria-hidden="true">
            <circle cx="24" cy="24" r="24" fill="#4fd15f" />
            <circle cx="17" cy="19" r="2.6" fill="#fff" />
            <circle cx="31" cy="19" r="2.6" fill="#fff" />
            <path d="M15 27.5c2 4.2 5.2 6.3 9 6.3s7-2.1 9-6.3" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" />
          </svg>
          <span class="box-till-sum" id="box-till-sum">+4 920 zł</span>
          <span class="box-till-who" id="box-till-who">Agencja Kreatywna Sowa</span>
          <span class="box-till-invoice" id="box-till-invoice">FV 2026/10/045</span>
        </span>
      </span>
      <span class="box-till-tap btn" size="bg" color="green">
        <svg class="btn-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3A4.5 4.5 0 0 0 14 7.97v8.05A4.48 4.48 0 0 0 16.5 12zM14 3.23v2.06a7 7 0 0 1 0 13.42v2.06a9 9 0 0 0 0-17.54z" />
        </svg>
        <span class="btn-title">Kliknij</span>
      </span>
    </button>
  </div>
</section>