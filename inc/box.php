<?php
/**
 * Doginvoice Box: funkcje landing page'a urządzenia.
 *
 * 1. doginvoice_box_outline() — wstawianie rysunków konturowych SVG.
 * 2. Podgląd strony przy udostępnianiu (Open Graph).
 *
 * Wtyczka „Open Graph” bierze domyślnie tytuł strony i obrazek wyróżniający.
 * Landing Boxa dostaje własny tytuł, opis i grafikę 1200×630
 * (src/assets/images/box/og-doginvoice-box.jpg — jest na niej cena
 * przedsprzedażowa, więc po zmianie ceny trzeba ją wygenerować na nowo).
 *
 * @package doginvoice
 */

/**
 * Zwraca rysunek konturowy Boxa jako inline SVG (kolor linii ustawia CSS).
 *
 * @param string $file  Nazwa pliku w src/assets/images/box/.
 * @param string $class Klasa nadawana elementowi <svg>.
 * @return string Kod SVG bez prologu XML i sztywnych wymiarów.
 */
function doginvoice_box_outline( $file, $class ) {
	$svg = @file_get_contents( get_template_directory() . '/src/assets/images/box/' . $file );
	if ( ! $svg ) {
		return '';
	}

	$svg = preg_replace(
		array( '/<\?xml[^>]*\?>\s*/', '/<svg /', '/\s(width|height)="[\d.]+"/' ),
		array( '', '<svg class="' . esc_attr( $class ) . '" data-box-inview aria-hidden="true" focusable="false" ', '' ),
		$svg,
		1
	);

	// pathLength="1" pozwala „dorysować” każdą linię tą samą animacją CSS,
	// niezależnie od jej długości (stroke-dashoffset 1 → 0).
	return str_replace( '<path ', '<path pathLength="1" ', $svg );
}

add_filter(
	'opengraph_metadata',
	function ( $metadata ) {
		if ( ! is_page_template( 'page-doginvoice-box.php' ) ) {
			return $metadata;
		}

		$image_path = '/src/assets/images/box/og-doginvoice-box.jpg';
		$image_url  = add_query_arg(
			'v',
			(string) @filemtime( get_template_directory() . $image_path ),
			get_template_directory_uri() . $image_path
		);

		$metadata['og:title']       = 'Doginvoice Box – klient zapłacił? Usłyszysz „ka-ching”';
		$metadata['og:description'] = 'Mały ekran na biurko, który pokazuje wpłaty, faktury z KSeF, terminy i wynik miesiąca.';
		$metadata['og:image']       = array( $image_url );
		$metadata['og:type']        = 'product';
		$metadata['twitter:card']   = 'summary_large_image';

		return $metadata;
	}
);

/**
 * Adres filmu lub dźwięku Boxa w Cloudflare R2 (bucket „doginvoice-media”,
 * domena media.doginvoice.com).
 *
 * Serwer strony wysyła większe pliki bez Content-Length i bez obsługi żądań
 * zakresowych (Range), przez co Safari na iPhonie nie odtwarza z niego wideo.
 * R2 odpowiada poprawnie. Plik w motywie zostaje źródłem: po jego podmianie
 * trzeba wgrać go ponownie pod tę samą nazwę:
 *
 *   npx wrangler r2 object put doginvoice-media/box/<nazwa> --file <plik> --remote
 *
 * Parametr „v” (data lokalnego pliku) omija cache po podmianie.
 *
 * @param string $name Nazwa pliku w R2, w katalogu box/.
 * @param string $path Ścieżka pliku źródłowego względem katalogu motywu.
 * @return string
 */
function doginvoice_box_media_url( $name, $path ) {
	$url  = 'https://media.doginvoice.com/box/' . $name;
	$file = get_template_directory() . $path;

	return file_exists( $file ) ? add_query_arg( 'v', (string) filemtime( $file ), $url ) : $url;
}

/**
 * Adres strony Doginvoice Box (strona z szablonem page-doginvoice-box.php).
 * Szukany po szablonie, nie po slugu, żeby zmiana adresu w WP adminie
 * nie psuła linków w motywie.
 *
 * @return string
 */
function doginvoice_box_page_url() {
	static $url = null;
	if ( null === $url ) {
		$pages = get_pages(
			array(
				'meta_key'   => '_wp_page_template',
				'meta_value' => 'page-doginvoice-box.php',
				'number'     => 1,
			)
		);
		$url   = $pages ? get_permalink( $pages[0] ) : home_url( '/doginvoice-box/' );
	}
	return $url;
}

/**
 * Oferta Doginvoice Box: jedyne miejsce, w którym zmienia się ceny i daty.
 * Korzystają z niej landing (page-doginvoice-box.php) i strona podziękowania
 * (page-doginvoice-box-dziekujemy.php).
 *
 * Wysyłka podana przez Marka 14.11.2026, ceny Boxa zmienione 16.11.2026;
 * koniec przedsprzedaży i 30 dni na zwrot zatwierdzone 15.11.2026.
 * Cena planu Professional wg template-parts/partner-program/product.php.
 *
 * @return array
 */
function doginvoice_box_offer() {
	return array(
		'price'        => 249,           // cena w przedsprzedaży, zł
		'price_normal' => 349,           // cena po przedsprzedaży, zł
		'presale_end'  => '27.12.2026',  // ostatni dzień ceny przedsprzedażowej
		'shipping'     => '28.12.2026',
		'plan_price'   => '75 zł netto', // Professional, miesięcznie, po darmowym miesiącu
		'return_days'  => 30,
	);
}

/**
 * Cena Boxa obowiązująca dziś: przedsprzedażowa do końca dnia presale_end,
 * potem zwykła. Trafia jako wartość do zdarzenia Purchase.
 *
 * @return int
 */
function doginvoice_box_current_price() {
	$offer = doginvoice_box_offer();

	return doginvoice_box_presale_active() ? $offer['price'] : $offer['price_normal'];
}

/**
 * Czy trwa przedsprzedaż Boxa (do końca dnia presale_end).
 * Steruje ceną w zdarzeniu Purchase i paskiem nad nagłówkiem (header.php).
 *
 * @return bool
 */
function doginvoice_box_presale_active() {
	$offer = doginvoice_box_offer();
	$end   = DateTime::createFromFormat( 'd.m.Y', $offer['presale_end'], wp_timezone() );

	return ! $end || current_datetime() <= $end->setTime( 23, 59, 59 );
}

/**
 * Czy pokazać pasek przedsprzedaży nad nagłówkiem: trwa przedsprzedaż,
 * a strona nie jest landingiem kampanii z ukrytym paskiem (inc/landing.php).
 *
 * @return bool
 */
function doginvoice_box_bar_visible() {
	return doginvoice_box_presale_active() && ! doginvoice_landing_setting( 'lp_hide_box_bar', true );
}

// Strona podziękowania po zakupie nie powinna trafić do wyszukiwarek.
add_filter(
	'wp_robots',
	function ( $robots ) {
		if ( is_page_template( 'page-doginvoice-box-dziekujemy.php' ) ) {
			$robots['noindex']  = true;
			$robots['nofollow'] = true;
		}
		return $robots;
	}
);
