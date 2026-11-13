<?php
/**
 * Front page section: Modal promocyjny z CTA do rejestracji
 *
 * Każdy wariant to osobny panel; promo-modal.js losuje jeden i pokazuje go
 * przy zamiarze wyjścia (desktop) albo po czasie / scrollu (mobile).
 * Linki są w markupie (nie wstawiane z JS), żeby zadziałała podmiana na
 * link partnerski z header.php i event Lead z front-meta-events.js.
 *
 * @package doginvoice
 */

$promo_register_url = 'https://app.doginvoice.com/register';
$promo_demo_url     = 'https://app.doginvoice.com/demo';

$promo_variants = array(
	array(
		'id'        => 'invoices',
		'badge'     => 'Czy wiesz, że…',
		'title'     => 'Przetworzyliśmy już ponad 50 000 faktur',
		'text'      => 'DogInvoice sam pobiera faktury z KSeF, maila i zdjęć, odczytuje je i kategoryzuje. Załóż darmowe konto i wgraj pierwszą jeszcze dziś.',
		'cta_label' => 'Załóż konto za darmo',
		'cta_url'   => $promo_register_url,
	),
	array(
		'id'        => 'yearly',
		'badge'     => 'Czy wiesz, że…',
		'title'     => 'Plan roczny jest o 50% tańszy',
		'text'      => 'Zacznij za darmo, a gdy DogInvoice się sprawdzi, przejdź na plan roczny i płać połowę ceny miesięcznej.',
		'cta_label' => 'Zacznij za darmo',
		'cta_url'   => $promo_register_url,
	),
	array(
		'id'        => 'multi-company',
		'badge'     => 'Czy wiesz, że…',
		'title'     => 'Na jednym koncie obsłużysz kilka firm',
		'text'      => 'Przełączaj się między firmami jednym kliknięciem – bez wylogowywania i bez osobnych kont.',
		'cta_label' => 'Załóż konto za darmo',
		'cta_url'   => $promo_register_url,
	),
	array(
		'id'        => 'demo',
		'badge'     => 'Bez zakładania konta',
		'title'     => 'Sprawdź DogInvoice na żywo w wersji demo',
		'text'      => 'Kliknij i zobacz faktury, płatności i bilans na przykładowych danych – bez rejestracji i bez podawania e-maila.',
		'cta_label' => 'Otwórz demo',
		'cta_url'   => $promo_demo_url,
	),
	array(
		'id'        => 'no-card',
		'badge'     => 'Bez ryzyka',
		'title'     => 'Konto założysz bez podawania karty',
		'text'      => 'Plan darmowy zostaje darmowy. Nic się samo nie odnowi i nic nie zejdzie z konta.',
		'cta_label' => 'Załóż konto za darmo',
		'cta_url'   => $promo_register_url,
	),
	array(
		'id'        => 'ksef',
		'badge'     => 'KSeF',
		'title'     => 'Faktury z KSeF pobierają się same',
		'text'      => 'Kosztowe i przychodowe trafiają do DogInvoice automatycznie, a XML zamienia się w czytelny PDF.',
		'cta_label' => 'Połącz z KSeF za darmo',
		'cta_url'   => $promo_register_url,
	),
	array(
		'id'        => 'no-commitment',
		'badge'     => 'Bez zobowiązań',
		'title'     => 'Zrezygnujesz, kiedy chcesz',
		'text'      => 'Bez umowy i okresu wypowiedzenia. Faktury układają się na Twoim Dysku Google, więc archiwum zawsze zostaje u Ciebie.',
		'cta_label' => 'Wypróbuj za darmo',
		'cta_url'   => $promo_register_url,
	),
	array(
		'id'        => 'speed',
		'badge'     => 'Czy wiesz, że…',
		'title'     => 'Start zajmie Ci 3 minuty',
		'text'      => 'Zakładasz konto, podłączasz KSeF lub skrzynkę mailową i od razu widzisz swoje faktury w jednym miejscu.',
		'cta_label' => 'Zacznij teraz',
		'cta_url'   => $promo_register_url,
	),
	array(
		'id'        => 'payments',
		'badge'     => 'Płatności',
		'title'     => 'DogInvoice sam upomni się o Twoje pieniądze',
		'text'      => 'Sprawdza na wyciągu, kto zapłacił, a spóźnialskim wysyła przypomnienia po 3, 7, 14 i 30 dniach od terminu.',
		'cta_label' => 'Załóż konto za darmo',
		'cta_url'   => $promo_register_url,
	),
	array(
		'id'        => 'integrations',
		'badge'     => 'Integracje',
		'title'     => 'Zostajesz przy swoich narzędziach',
		'text'      => 'DogInvoice łączy się z inFakt, Fakturownią, wFirmą, BaseLinkerem, Gmailem i Dyskiem Google.',
		'cta_label' => 'Połącz swoje narzędzia',
		'cta_url'   => $promo_register_url,
	),
	array(
		'id'        => 'accountant',
		'badge'     => 'Czy wiesz, że…',
		'title'     => 'Do księgowej trafia tylko to, co zaakceptujesz',
		'text'      => 'W KSeF fakturę na Twoją firmę wystawi każdy, kto zna jej NIP. W DogInvoice odrzucisz błędne, zanim trafią do kosztów.',
		'cta_label' => 'Załóż konto za darmo',
		'cta_url'   => $promo_register_url,
	),
);

// Opinie: maksymalnie 3 pierwsze z sekcji "Opinie" (ACF), każda jako osobny wariant.
$promo_testimonials = array();
if ( function_exists( 'have_rows' ) && have_rows( 'testimonials_items' ) ) {
	while ( have_rows( 'testimonials_items' ) ) {
		the_row();
		if ( count( $promo_testimonials ) >= 3 ) {
			continue;
		}
		$promo_testimonial_body = trim( (string) get_sub_field( 'body' ) );
		if ( '' === $promo_testimonial_body ) {
			continue;
		}
		$promo_testimonials[] = array(
			'name'    => (string) get_sub_field( 'name' ),
			'company' => (string) get_sub_field( 'company' ),
			'rating'  => (int) get_sub_field( 'rating' ),
			'body'    => $promo_testimonial_body,
		);
	}
}
?>
    <!-- ===== PROMO MODAL ===== -->
    <div class="promo-modal" aria-hidden="true">
      <div
        class="promo-modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-label="DogInvoice">
        <button
          class="promo-modal-close"
          type="button"
          aria-label="Zamknij"
          data-promo-modal-close></button>

        <?php foreach ( $promo_variants as $promo_variant ) : ?>
          <div class="promo-modal-variant" data-promo-variant="<?php echo esc_attr( $promo_variant['id'] ); ?>" hidden>
            <div class="promo-modal-badge badge badge--light">
              <span class="badge-text"><?php echo esc_html( $promo_variant['badge'] ); ?></span>
            </div>
            <p class="promo-modal-title typography--h3"><?php echo esc_html( $promo_variant['title'] ); ?></p>
            <p class="promo-modal-text typography--body-lg"><?php echo esc_html( $promo_variant['text'] ); ?></p>
            <div class="promo-modal-actions">
              <a
                href="<?php echo esc_url( $promo_variant['cta_url'] ); ?>"
                class="promo-modal-cta btn"
                size="bg"
                color="green"
                data-promo-modal-cta>
                <span class="btn-title"><?php echo esc_html( $promo_variant['cta_label'] ); ?></span>
              </a>
              <button type="button" class="promo-modal-dismiss typography--body-md" data-promo-modal-close>
                Nie teraz
              </button>
            </div>
          </div>
        <?php endforeach; ?>

        <?php foreach ( $promo_testimonials as $promo_index => $promo_testimonial ) : ?>
          <div class="promo-modal-variant promo-modal-variant--testimonial" data-promo-variant="testimonial-<?php echo esc_attr( $promo_index + 1 ); ?>" hidden>
            <div class="promo-modal-stars" aria-label="Ocena: <?php echo esc_attr( $promo_testimonial['rating'] ); ?> na 5">
              <?php for ( $promo_star = 0; $promo_star < $promo_testimonial['rating']; $promo_star++ ) : ?>
                <span aria-hidden="true">★</span>
              <?php endfor; ?>
            </div>
            <blockquote class="promo-modal-quote typography--body-lg">
              <?php echo esc_html( $promo_testimonial['body'] ); ?>
            </blockquote>
            <p class="promo-modal-author typography--body-md">
              <strong><?php echo esc_html( $promo_testimonial['name'] ); ?></strong><?php if ( '' !== $promo_testimonial['company'] ) : ?>, <?php echo esc_html( $promo_testimonial['company'] ); ?><?php endif; ?>
            </p>
            <div class="promo-modal-actions">
              <a
                href="<?php echo esc_url( $promo_register_url ); ?>"
                class="promo-modal-cta btn"
                size="bg"
                color="green"
                data-promo-modal-cta>
                <span class="btn-title">Wypróbuj za darmo</span>
              </a>
              <button type="button" class="promo-modal-dismiss typography--body-md" data-promo-modal-close>
                Nie teraz
              </button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="promo-modal-backdrop" data-promo-modal-close></div>
