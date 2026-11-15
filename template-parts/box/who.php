<?php

/**
 * Doginvoice Box: Dla kogo
 *
 * Ciemna sekcja z rysunkiem konturowym Boxa w tle
 * (06-gora-kontur-logo.svg, kolor linii w CSS).
 *
 * @package doginvoice
 */
?>
<!-- ===== DLA KOGO ===== -->
<section id="dla-kogo" class="box-who" aria-labelledby="box-who-title">
  <?php echo doginvoice_box_outline( '06-gora-kontur-logo.svg', 'box-who-drawing' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
  <div class="box-who-inner max-width">
    <div class="box-who-content">
      <div class="box-who-badge badge badge--dark" data-aos="fade-up">
        <span class="badge-text">Dla kogo</span>
      </div>
      <h2 id="box-who-title" class="box-who-title typography--h2" data-aos="fade-up" data-remove-orphans>
        Dla każdego, kto pilnuje pieniędzy w firmie
      </h2>

      <ul class="box-who-list">
        <li class="box-who-item" data-aos="fade-up" data-aos-delay="50">
          <h3 class="box-who-item-title typography--h4">Dla Ciebie</h3>
          <p class="box-who-item-description typography--body-lg" data-remove-orphans>
            Prowadzisz firmę i chcesz na bieżąco znać jej wyniki. Box pokaże je bez logowania i przypomni o płatności, zanim minie termin.
          </p>
        </li>
        <li class="box-who-item" data-aos="fade-up" data-aos-delay="100">
          <h3 class="box-who-item-title typography--h4">Dla Twojego menedżera</h3>
          <p class="box-who-item-description typography--body-lg" data-remove-orphans>
            Odpowiada za wynik i chce wiedzieć, ile brakuje do celu. Box pokaże mu to każdego dnia, a nie dopiero w raporcie na koniec miesiąca.
          </p>
        </li>
        <li class="box-who-item" data-aos="fade-up" data-aos-delay="150">
          <h3 class="box-who-item-title typography--h4">Dla Twojej administracji</h3>
          <p class="box-who-item-description typography--body-lg" data-remove-orphans>
            Pilnuje faktur i terminów, często kilku naraz. Box pokaże nową fakturę i każdą wpłatę od razu, więc nic jej nie umknie.
          </p>
        </li>
      </ul>
    </div>
  </div>
</section>
