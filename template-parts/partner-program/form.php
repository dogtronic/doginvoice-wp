<?php

/**
 * Program partnerski: Zgłoszenie (formularz Contact Form 7)
 *
 * Formularz "Program Partnerski — Zgłoszenie" (post ID 221) skonfigurowany
 * w wp-admin > Contact > Contact Forms. Wysyłka trafia na
 * kamil.sobkowicz@dogtronic.io.
 *
 * @package doginvoice
 */
?>
<!-- ===== ZGŁOSZENIE ===== -->
<section id="zgloszenie" class="partner-form max-width" aria-labelledby="partner-form-title">
  <header class="partner-form-head">
    <div class="partner-form-head-badge badge badge--light" data-aos="fade-up">
      <span class="badge-text">Zgłoszenie</span>
    </div>
    <h2
      id="partner-form-title"
      class="partner-form-head-title typography--h2"
      data-aos="fade-up"
      data-remove-orphans>
      Zgłoś się do programu partnerskiego
    </h2>
    <p class="partner-form-head-description typography--body-lg" data-aos="fade-up" data-remove-orphans>
      Zostaw kontakt. Odezwiemy się w ciągu jednego dnia roboczego i umówimy krótką rozmowę.
    </p>
  </header>

  <div class="partner-form-grid">
    <div class="partner-form-card" data-aos="fade-up">
      <?php echo do_shortcode('[contact-form-7 id="d43f86a" title="Program Partnerski — Zgłoszenie"]'); ?>
    </div>

    <aside class="partner-form-aside" data-aos="fade-up" data-aos-delay="100">
      <h3 class="partner-form-aside-title typography--h4">Wolisz od razu porozmawiać?</h3>
      <p class="partner-form-aside-description typography--body-md">
        Wybierz termin w kalendarzu. Piętnaście minut wystarczy, żeby ustalić, czy program ma dla Ciebie sens, i zobaczyć aplikację na żywo.
      </p>
      <a
        href="https://calendar.app.google/TrvZSUXYfkFGZcBe8"
        target="_blank"
        rel="noopener"
        class="partner-form-aside-cta btn"
        size="bg"
        color="green">
        <span class="btn-title">Wybierz termin rozmowy</span>
      </a>
      <span class="partner-form-aside-mail typography--body-md">
        Albo napisz wprost:<br />
        <a href="mailto:kamil.sobkowicz@dogtronic.io">kamil.sobkowicz@dogtronic.io</a>
      </span>
    </aside>
  </div>
</section>