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
