<?php

/**
 * Template Name: Doginvoice Box – podziękowanie
 *
 * Strona, na którą Stripe odsyła po opłaceniu zamówienia Doginvoice Box.
 * W Stripe (Payment Link → Po płatności → Przekieruj klientów na swoją
 * stronę) trzeba wpisać adres tej strony z identyfikatorem sesji:
 *
 *   https://doginvoice.com/<adres-strony>/?session_id={CHECKOUT_SESSION_ID}
 *
 * Zdarzenie Purchase (Meta Pixel) idzie tylko wtedy, gdy w adresie jest
 * session_id ze Stripe, i tylko raz na sesję (odświeżenie strony nie liczy
 * zakupu drugi raz). Wartość to cena Boxa obowiązująca w dniu zakupu
 * (inc/box.php); strona nie zna liczby sztuk z koszyka Stripe.
 *
 * Treść jest wpisana wprost w szablon (bez ACF), jak na landingu Boxa.
 *
 * @package doginvoice
 */

$box_offer    = doginvoice_box_offer();
$box_purchase = array(
  'value'    => doginvoice_box_current_price(),
  'currency' => 'PLN',
);

get_header();
?>
<main class="box-page box-thanks">
  <section class="box-hero max-width" aria-labelledby="box-thanks-title">
    <div class="box-hero-content">
      <div class="badge badge--light" data-aos="fade-up">
        <span class="badge-text">Zamówienie przyjęte</span>
      </div>
      <h1
        id="box-thanks-title"
        class="box-hero-content-title typography--h1"
        data-aos="fade-up"
        data-remove-orphans>
        Dziękujemy! Twój Box jest zarezerwowany
      </h1>
      <p
        class="box-hero-content-subtitle typography--body-xl"
        data-aos="fade-up"
        data-aos-delay="100"
        data-remove-orphans>
        Płatność do nas dotarła. Już niedługo wpłaty, faktury z KSeF, terminy i wynik miesiąca zobaczysz na żywo na swoim biurku.
      </p>
      <div class="box-hero-content-cta" data-aos="fade-up" data-aos-delay="150">
        <a href="https://app.doginvoice.com/register" class="btn" size="bg" color="green" target="_blank" rel="noopener">
          <span class="btn-title">Załóż konto Doginvoice</span>
        </a>
        <a href="<?php echo esc_url(doginvoice_box_page_url()); ?>" class="btn" size="bg" color="white">
          <span class="btn-title">Wróć do strony Boxa</span>
        </a>
      </div>
    </div>
  </section>

  <section class="box-steps max-width" aria-labelledby="box-thanks-next-title">
    <header class="box-head">
      <div class="badge badge--light" data-aos="fade-up">
        <span class="badge-text">Co dalej</span>
      </div>
      <h2 id="box-thanks-next-title" class="box-head-title typography--h2" data-aos="fade-up" data-remove-orphans>
        Trzy rzeczy, które warto wiedzieć
      </h2>
    </header>

    <ol class="box-steps-grid" data-box-inview>
      <li class="box-card box-card--text box-step" data-aos="fade-up" data-aos-delay="50">
        <span class="box-step-number" aria-hidden="true">1</span>
        <h3 class="box-card-title typography--h4">Wysyłka od <?php echo esc_html($box_offer['shipping']); ?></h3>
        <p class="box-card-description typography--body-lg" data-remove-orphans>Kupujesz w przedsprzedaży, więc na paczkę trzeba chwilę poczekać. Gdy Twój Box wyruszy w drogę, damy Ci znać mailem.</p>
      </li>
      <li class="box-card box-card--text box-step" data-aos="fade-up" data-aos-delay="100">
        <span class="box-step-number" aria-hidden="true">2</span>
        <h3 class="box-card-title typography--h4">Miesiąc Professional gratis</h3>
        <p class="box-card-description typography--body-lg" data-remove-orphans>Box pokazuje dane z konta Doginvoice w planie Professional. Razem z Boxem dostajesz 1 miesiąc tego planu za darmo.</p>
      </li>
      <li class="box-card box-card--text box-step" data-aos="fade-up" data-aos-delay="150">
        <span class="box-step-number" aria-hidden="true">3</span>
        <h3 class="box-card-title typography--h4">Załóż konto już teraz</h3>
        <p class="box-card-description typography--body-lg" data-remove-orphans>Nie masz jeszcze konta? Załóż je i pobierz pierwsze faktury. Box będzie miał co pokazywać od pierwszej minuty.</p>
      </li>
    </ol>

    <p class="box-thanks-note typography--body-md" data-aos="fade-up" data-remove-orphans>
      Masz pytanie o zamówienie albo chcesz coś w nim zmienić? Napisz na
      <a href="mailto:hello@doginvoice.com">hello@doginvoice.com</a>.
      A jeśli Box nie przypadnie Ci do gustu, masz <?php echo esc_html($box_offer['return_days']); ?> dni na zwrot bez podawania powodu.
    </p>
  </section>
</main>

<script>
  // Meta Pixel: Purchase po powrocie ze Stripe (fbq ładuje header.php).
  (function() {
    var purchase = <?php echo wp_json_encode($box_purchase); ?>;
    var params = new URLSearchParams(window.location.search);
    var session = params.get('session_id') || '';

    // Identyfikator sesji Stripe Checkout: cs_live_… albo cs_test_…
    if (!/^cs_(live|test)_[A-Za-z0-9]+$/.test(session)) return;

    var key = 'box_purchase_' + session;
    var seen = false;
    try {
      seen = localStorage.getItem(key) === '1';
    } catch (e) {}

    if (!seen && typeof fbq === 'function') {
      // eventID = sesja Stripe: po dodaniu Conversions API (webhook Stripe)
      // Meta połączy oba zgłoszenia w jeden zakup.
      fbq('track', 'Purchase', {
        value: purchase.value,
        currency: purchase.currency,
        content_name: 'Doginvoice Box',
        content_type: 'product',
        content_ids: ['doginvoice-box'],
        num_items: 1
      }, {
        eventID: session
      });
      try {
        localStorage.setItem(key, '1');
      } catch (e) {}
    }

    // Adres bez session_id: odświeżenie i udostępnienie linku są czyste.
    params.delete('session_id');
    var query = params.toString();
    history.replaceState(null, '', window.location.pathname + (query ? '?' + query : '') + window.location.hash);
  })();
</script>
<?php
get_footer();
