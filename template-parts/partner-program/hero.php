<?php
/**
 * Program partnerski: Hero + kalkulator prowizji
 *
 * Stawki (prowizja 50% bezterminowo od kwoty faktycznie zapłaconej,
 * zniżka 50% na pierwszy okres rozliczeniowy udzielana wyłącznie przez
 * partnera) pochodzą z DECISIONS.md D21 — nie zmieniać bez źródła.
 *
 * @package doginvoice
 */
?>
    <!-- ===== HERO + KALKULATOR ===== -->
    <section id="kalkulator" class="partner-hero max-width" aria-labelledby="partner-hero-title">
      <div class="partner-hero-content">
        <div class="partner-hero-content-badge badge badge--light" data-aos="fade-up">
          <span class="badge-text">Program partnerski DogInvoice</span>
        </div>
        <h1
          id="partner-hero-title"
          class="partner-hero-content-title typography--h1"
          data-aos="fade-up"
          data-aos-delay="100"
          data-remove-orphans>
          Twoi klienci Ci ufają. Niech to zaufanie płaci co miesiąc.
        </h1>
        <p
          class="partner-hero-content-subtitle typography--body-xl"
          data-aos="fade-up"
          data-aos-delay="150"
          data-remove-orphans>
          Polecasz DogInvoice, klient zakłada konto z Twoim kodem. Dostajesz połowę każdej jego płatności, tak długo jak on płaci.
        </p>
        <div class="partner-hero-content-cta" data-aos="fade-up" data-aos-delay="200">
          <a href="#zgloszenie" class="partner-hero-content-cta-button btn" size="bg" color="green">
            <span class="btn-title">Zostań partnerem</span>
          </a>
          <a
            href="https://calendar.app.google/TrvZSUXYfkFGZcBe8"
            target="_blank"
            rel="noopener"
            class="partner-hero-content-cta-button btn"
            size="bg"
            color="white">
            <span class="btn-title">Umów rozmowę</span>
          </a>
        </div>
        <ul class="partner-hero-content-facts standard-list" data-aos="fade-up" data-aos-delay="250">
          <li><strong>50% od każdej płatności klienta, bezterminowo.</strong> Ta sama stawka na każdym planie, przy rozliczeniu miesięcznym i rocznym.</li>
          <li><strong>Nie prosimy o listę Twoich klientów.</strong> Ty piszesz do swoich, my rozliczamy konta założone z Twoim kodem.</li>
        </ul>
      </div>

      <!-- KALKULATOR PROWIZJI -->
      <div class="partner-calc" data-aos="fade-up" data-aos-delay="150">
        <h2 class="partner-calc-title typography--h4">Policz to na swoich klientach</h2>
        <p class="partner-calc-subtitle typography--body-sm">Przesuń suwak, wybierz plan. Kwoty netto, prowizja 50%.</p>

        <div class="partner-calc-field">
          <label for="partner-calc-clients" class="partner-calc-field-label typography--body-sm">
            Ilu klientów polecisz: <span class="partner-calc-field-label-value" id="partner-calc-clients-value">10</span>
          </label>
          <input
            type="range"
            id="partner-calc-clients"
            class="partner-calc-range"
            min="1"
            max="50"
            step="1"
            value="10"
            aria-describedby="partner-calc-out" />
          <div class="partner-calc-range-scale typography--body-sm" aria-hidden="true">
            <span>1</span>
            <span>50</span>
          </div>
        </div>

        <p class="partner-calc-plan-label typography--body-sm">Plan klienta</p>
        <div class="partner-calc-plan-toggle" role="group" aria-label="Plan klienta">
          <button type="button" class="partner-calc-plan-toggle-button" data-price="149" aria-pressed="true">
            Professional
            <span>149 zł netto / mies.</span>
          </button>
          <button type="button" class="partner-calc-plan-toggle-button" data-price="299" aria-pressed="false">
            Business
            <span>299 zł netto / mies.</span>
          </button>
        </div>

        <div class="partner-calc-out" id="partner-calc-out" aria-live="polite">
          <div class="partner-calc-out-row partner-calc-out-row--big">
            <div class="partner-calc-out-row-label typography--body-sm">Twoja prowizja co miesiąc</div>
            <div class="partner-calc-out-row-value" id="partner-calc-month">745 zł</div>
          </div>
          <div class="partner-calc-out-row">
            <div class="partner-calc-out-row-label typography--body-sm">Twoja prowizja przez pierwszy rok</div>
            <div class="partner-calc-out-row-value" id="partner-calc-year">8 568 zł</div>
          </div>
        </div>
      </div>
    </section>
