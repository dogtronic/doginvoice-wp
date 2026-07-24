<?php
/**
 * ACF field group registrations for the front-page.php template.
 *
 * Fields are registered per section so front-page.php can be wired up
 * incrementally. All field keys are prefixed field_doginvoice_ to avoid
 * collisions with fields added elsewhere.
 *
 * @package doginvoice
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

add_action( 'acf/init', 'doginvoice_acf_hero_fields' );
add_action( 'acf/init', 'doginvoice_acf_trust_fields' );
add_action( 'acf/init', 'doginvoice_acf_offer_fields' );
add_action( 'acf/init', 'doginvoice_acf_features_fields' );
add_action( 'acf/init', 'doginvoice_acf_payments_fields' );
add_action( 'acf/init', 'doginvoice_acf_why_us_fields' );
add_action( 'acf/init', 'doginvoice_acf_pricing_fields' );
add_action( 'acf/init', 'doginvoice_acf_integrations_fields' );
add_action( 'acf/init', 'doginvoice_acf_testimonials_fields' );
add_action( 'acf/init', 'doginvoice_acf_faq_fields' );
add_action( 'acf/init', 'doginvoice_acf_notfound_fields' );
add_action( 'acf/init', 'doginvoice_acf_text_page_fields' );

/**
 * Hero section fields (front-page.php, <section class="hero">).
 */
function doginvoice_acf_hero_fields() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_doginvoice_hero',
			'title'    => 'Front Page — Hero',
			'fields'   => array(
				array(
					'key'           => 'field_doginvoice_hero_title',
					'label'         => 'Nagłówek (H1)',
					'name'          => 'hero_title',
					'type'          => 'text',
					'default_value' => 'Panuj nad finansami firmy',
					'required'      => 1,
				),
				array(
					'key'           => 'field_doginvoice_hero_subtitle',
					'label'         => 'Podtytuł',
					'name'          => 'hero_subtitle',
					'type'          => 'textarea',
					'instructions'  => 'Dozwolone proste tagi HTML: <strong>, <br />. Reszta zostanie oczyszczona przy wyświetlaniu.',
					'default_value' => '<strong>DogInvoice</strong> pobiera faktury z KSeF, maila i zdjęć, sam je czyta i kategoryzuje.<br />Ty masz koszty, płatności i bilans w jednym widoku.',
					'rows'          => 4,
					'new_lines'     => '',
					'required'      => 1,
				),
				array(
					'key'   => 'field_doginvoice_hero_badge_tab',
					'label' => 'Znacznik ("3 min")',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_doginvoice_hero_badge_time',
					'label'         => 'Tekst znacznika',
					'name'          => 'hero_badge_time',
					'type'          => 'text',
					'default_value' => '3 min',
					'wrapper'       => array( 'width' => '50' ),
				),
				array(
					'key'           => 'field_doginvoice_hero_badge_caption',
					'label'         => 'Podpis znacznika',
					'name'          => 'hero_badge_caption',
					'type'          => 'text',
					'default_value' => 'Tyle zajmie Ci start',
					'wrapper'       => array( 'width' => '50' ),
				),
				array(
					'key'   => 'field_doginvoice_hero_cta_tab',
					'label' => 'Przyciski CTA',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_doginvoice_hero_cta_primary',
					'label'         => 'Przycisk główny',
					'name'          => 'hero_cta_primary',
					'type'          => 'link',
					'instructions'  => 'Np. "Załóż konto za darmo" → https://app.doginvoice.com/register',
					'return_format' => 'array',
					'default_value' => array(
						'title'  => 'Załóż konto za darmo',
						'url'    => 'https://app.doginvoice.com/register',
						'target' => '_blank',
					),
					'required'      => 1,
				),
				array(
					'key'           => 'field_doginvoice_hero_cta_demo',
					'label'         => 'Przycisk "Zobacz demo"',
					'name'          => 'hero_cta_demo',
					'type'          => 'link',
					'instructions'  => 'URL powinien wskazywać na film (np. YouTube) — jest on otwierany w oknie modalnym, a nie w nowej karcie.',
					'return_format' => 'array',
					'default_value' => array(
						'title'  => 'Zobacz demo',
						'url'    => 'https://www.youtube.com/watch?v=pqiEXPHGjHw',
						'target' => '_blank',
					),
					'required'      => 1,
				),
				array(
					'key'   => 'field_doginvoice_hero_media_tab',
					'label' => 'Zrzuty ekranu',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_doginvoice_hero_media',
					'label'        => 'Grafiki hero',
					'name'         => 'hero_media',
					'type'         => 'group',
					'instructions' => 'Zrzuty ekranu wyświetlane w hero. Widok mobilny pokazuje się tylko na małych ekranach, pozostałe tworzą ułożoną w warstwy grafikę na desktopie.',
					'sub_fields'   => array(
						array(
							'key'           => 'field_doginvoice_hero_media_mobile',
							'label'         => 'Widok mobilny',
							'name'          => 'mobile',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
							'required'      => 1,
						),
						array(
							'key'           => 'field_doginvoice_hero_media_main',
							'label'         => 'Główny zrzut ekranu (desktop)',
							'name'          => 'main',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
							'required'      => 1,
						),
						array(
							'key'           => 'field_doginvoice_hero_media_screen_1',
							'label'         => 'Zrzut ekranu #1',
							'name'          => 'screen_1',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
						),
						array(
							'key'           => 'field_doginvoice_hero_media_screen_2',
							'label'         => 'Zrzut ekranu #2',
							'name'          => 'screen_2',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
						),
						array(
							'key'           => 'field_doginvoice_hero_media_screen_3',
							'label'         => 'Zrzut ekranu #3',
							'name'          => 'screen_3',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
						),
						array(
							'key'           => 'field_doginvoice_hero_media_screen_4',
							'label'         => 'Zrzut ekranu #4',
							'name'          => 'screen_4',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
						),
						array(
							'key'           => 'field_doginvoice_hero_media_screen_5',
							'label'         => 'Zrzut ekranu #5',
							'name'          => 'screen_5',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'    => 0,
			'position'      => 'normal',
			'style'         => 'default',
			'active'        => true,
			'description'   => 'Treść sekcji Hero na stronie głównej (front-page.php).',
		)
	);
}

/**
 * Trust bar / client logos fields (front-page.php, <section class="trust">).
 */
function doginvoice_acf_trust_fields() {
	acf_add_local_field_group(
		array(
			'key'         => 'group_doginvoice_trust',
			'title'       => 'Front Page — Pasek zaufania (logo klientów)',
			'fields'      => array(
				array(
					'key'          => 'field_doginvoice_trust_logos',
					'label'        => 'Logotypy klientów',
					'name'         => 'trust_logos',
					'type'         => 'repeater',
					'instructions' => 'Logotypy przewijane w pasku zaufania pod sekcją hero. Skrypt sam dokleja kopie, jeśli logotypów jest za mało, by wypełnić szerokość ekranu — możesz dodać tylko tyle, ile faktycznie masz.',
					'layout'       => 'table',
					'button_label' => 'Dodaj logo',
					'min'          => 1,
					'sub_fields'   => array(
						array(
							'key'           => 'field_doginvoice_trust_logo',
							'label'         => 'Logo',
							'name'          => 'logo',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
							'required'      => 1,
						),
					),
				),
			),
			'location'    => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'  => 1,
			'position'    => 'normal',
			'style'       => 'default',
			'active'      => true,
			'description' => 'Logotypy klientów w pasku zaufania pod sekcją hero (front-page.php).',
		)
	);
}

/**
 * Offer grid fields (front-page.php, <section class="offer">).
 */
function doginvoice_acf_offer_fields() {
	acf_add_local_field_group(
		array(
			'key'         => 'group_doginvoice_offer',
			'title'       => 'Front Page — Oferta (grid)',
			'fields'      => array(
				array(
					'key'   => 'field_doginvoice_offer_content_tab',
					'label' => 'Nagłówek sekcji',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_doginvoice_offer_badge',
					'label' => 'Tekst odznaki (badge)',
					'name'  => 'offer_badge',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_doginvoice_offer_title',
					'label' => 'Nagłówek (H2)',
					'name'  => 'offer_title',
					'type'  => 'text',
				),
				array(
					'key'  => 'field_doginvoice_offer_description',
					'label' => 'Opis',
					'name'  => 'offer_description',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_doginvoice_offer_items_tab',
					'label' => 'Elementy siatki',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_doginvoice_offer_items',
					'label'        => 'Elementy siatki (4)',
					'name'         => 'offer_items',
					'type'         => 'group',
					'instructions' => 'Animacje przypisane do każdego elementu są ustalone w kodzie szablonu — tu edytujesz tylko treść.',
					'sub_fields'   => array(
						array(
							'key'     => 'field_doginvoice_offer_item_1_title',
							'label'   => 'Element #1 — tytuł',
							'name'    => 'item_1_title',
							'type'    => 'text',
							'wrapper' => array( 'width' => '50' ),
						),
						array(
							'key'     => 'field_doginvoice_offer_item_1_description',
							'label'   => 'Element #1 — opis',
							'name'    => 'item_1_description',
							'type'    => 'textarea',
							'rows'    => 3,
							'wrapper' => array( 'width' => '50' ),
						),
						array(
							'key'     => 'field_doginvoice_offer_item_2_title',
							'label'   => 'Element #2 — tytuł',
							'name'    => 'item_2_title',
							'type'    => 'text',
							'wrapper' => array( 'width' => '50' ),
						),
						array(
							'key'     => 'field_doginvoice_offer_item_2_description',
							'label'   => 'Element #2 — opis',
							'name'    => 'item_2_description',
							'type'    => 'textarea',
							'rows'    => 3,
							'wrapper' => array( 'width' => '50' ),
						),
						array(
							'key'     => 'field_doginvoice_offer_item_3_title',
							'label'   => 'Element #3 — tytuł',
							'name'    => 'item_3_title',
							'type'    => 'text',
							'wrapper' => array( 'width' => '50' ),
						),
						array(
							'key'     => 'field_doginvoice_offer_item_3_description',
							'label'   => 'Element #3 — opis',
							'name'    => 'item_3_description',
							'type'    => 'textarea',
							'rows'    => 3,
							'wrapper' => array( 'width' => '50' ),
						),
						array(
							'key'     => 'field_doginvoice_offer_item_4_title',
							'label'   => 'Element #4 — tytuł',
							'name'    => 'item_4_title',
							'type'    => 'text',
							'wrapper' => array( 'width' => '50' ),
						),
						array(
							'key'     => 'field_doginvoice_offer_item_4_description',
							'label'   => 'Element #4 — opis',
							'name'    => 'item_4_description',
							'type'    => 'textarea',
							'rows'    => 3,
							'wrapper' => array( 'width' => '50' ),
						),
					),
				),
			),
			'location'    => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'  => 2,
			'position'    => 'normal',
			'style'       => 'default',
			'active'      => true,
			'description' => 'Sekcja "Oferta" (grid 4 elementów) na stronie głównej (front-page.php).',
		)
	);
}

/**
 * Features carousel fields (front-page.php, <section class="features">).
 */
function doginvoice_acf_features_fields() {
	acf_add_local_field_group(
		array(
			'key'         => 'group_doginvoice_features',
			'title'       => 'Front Page — Wszystkie funkcje',
			'fields'      => array(
				array(
					'key'   => 'field_doginvoice_features_content_tab',
					'label' => 'Nagłówek sekcji',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_doginvoice_features_badge',
					'label' => 'Tekst odznaki (badge)',
					'name'  => 'features_badge',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_doginvoice_features_title',
					'label' => 'Nagłówek (H2)',
					'name'  => 'features_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_doginvoice_features_items_tab',
					'label' => 'Funkcje',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_doginvoice_features_items',
					'label'        => 'Lista funkcji',
					'name'         => 'features_items',
					'type'         => 'repeater',
					'instructions' => 'Karuzela funkcji pod nagłówkiem sekcji. Skrypt sam dokleja kopie, jeśli funkcji jest za mało, by wypełnić szerokość ekranu.',
					'layout'       => 'block',
					'button_label' => 'Dodaj funkcję',
					'min'          => 1,
					'sub_fields'   => array(
						array(
							'key'           => 'field_doginvoice_features_item_icon',
							'label'         => 'Ikona',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
							'required'      => 1,
						),
						array(
							'key'      => 'field_doginvoice_features_item_title',
							'label'    => 'Tytuł',
							'name'     => 'title',
							'type'     => 'text',
							'required' => 1,
						),
						array(
							'key'      => 'field_doginvoice_features_item_description',
							'label'    => 'Opis',
							'name'     => 'description',
							'type'     => 'textarea',
							'rows'     => 3,
							'required' => 1,
						),
					),
				),
			),
			'location'    => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'  => 3,
			'position'    => 'normal',
			'style'       => 'default',
			'active'      => true,
			'description' => 'Karuzela "Wszystkie funkcje" na stronie głównej (front-page.php).',
		)
	);
}

/**
 * Payments section fields (front-page.php, <section class="payments">).
 */
function doginvoice_acf_payments_fields() {
	acf_add_local_field_group(
		array(
			'key'         => 'group_doginvoice_payments',
			'title'       => 'Front Page — Płatności',
			'fields'      => array(
				array(
					'key'   => 'field_doginvoice_payments_content_tab',
					'label' => 'Nagłówek sekcji',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_doginvoice_payments_badge',
					'label' => 'Tekst odznaki (badge)',
					'name'  => 'payments_badge',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_doginvoice_payments_title',
					'label' => 'Nagłówek (H2)',
					'name'  => 'payments_title',
					'type'  => 'text',
				),
				array(
					'key'  => 'field_doginvoice_payments_description',
					'label' => 'Opis',
					'name'  => 'payments_description',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_doginvoice_payments_cards_tab',
					'label' => 'Karty',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_doginvoice_payments_cards',
					'label'        => 'Karty płatności',
					'name'         => 'payments_cards',
					'type'         => 'repeater',
					'layout'       => 'block',
					'button_label' => 'Dodaj kartę',
					'min'          => 1,
					'sub_fields'   => array(
						array(
							'key'           => 'field_doginvoice_payments_card_icon',
							'label'         => 'Ikona (nad kartą)',
							'name'          => 'icon',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
							'required'      => 1,
						),
						array(
							'key'      => 'field_doginvoice_payments_card_badge',
							'label'    => 'Tekst odznaki karty',
							'name'     => 'badge',
							'type'     => 'text',
							'required' => 1,
						),
						array(
							'key'      => 'field_doginvoice_payments_card_title',
							'label'    => 'Tytuł',
							'name'     => 'title',
							'type'     => 'text',
							'required' => 1,
						),
						array(
							'key'      => 'field_doginvoice_payments_card_description',
							'label'    => 'Opis',
							'name'     => 'description',
							'type'     => 'textarea',
							'rows'     => 3,
							'required' => 1,
						),
						array(
							'key'          => 'field_doginvoice_payments_card_list',
							'label'        => 'Lista punktów',
							'name'         => 'list_items',
							'type'         => 'textarea',
							'instructions' => 'Jedna pozycja listy na linię.',
							'rows'         => 5,
							'required'     => 1,
						),
						array(
							'key'           => 'field_doginvoice_payments_card_media',
							'label'         => 'Grafika (po prawej)',
							'name'          => 'media',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
							'required'      => 1,
						),
					),
				),
			),
			'location'    => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'  => 4,
			'position'    => 'normal',
			'style'       => 'default',
			'active'      => true,
			'description' => 'Sekcja "Płatności" (karty obraz + tekst) na stronie głównej (front-page.php).',
		)
	);
}

/**
 * "Dlaczego DogInvoice?" section fields (front-page.php, <section class="why-us">).
 *
 * Icons are uploaded as SVG files through the "Ikona" image field (SVG
 * uploads are enabled in inc/template-functions.php).
 */
function doginvoice_acf_why_us_fields() {
	acf_add_local_field_group(
		array(
			'key'         => 'group_doginvoice_why_us',
			'title'       => 'Front Page — Dlaczego DogInvoice?',
			'fields'      => array(
				array(
					'key'   => 'field_doginvoice_why_us_content_tab',
					'label' => 'Nagłówek sekcji',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_doginvoice_why_us_badge',
					'label'         => 'Tekst odznaki (badge)',
					'name'          => 'why_us_badge',
					'type'          => 'text',
					'default_value' => 'Dlaczego DogInvoice?',
				),
				array(
					'key'           => 'field_doginvoice_why_us_title',
					'label'         => 'Nagłówek (H2)',
					'name'          => 'why_us_title',
					'type'          => 'text',
					'default_value' => 'Nie jesteśmy kolejną apką od faktur',
				),
				array(
					'key'   => 'field_doginvoice_why_us_items_tab',
					'label' => 'Kafelki',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_doginvoice_why_us_items',
					'label'        => 'Kafelki',
					'name'         => 'why_us_items',
					'type'         => 'repeater',
					'layout'       => 'block',
					'button_label' => 'Dodaj kafelek',
					'min'          => 1,
					'sub_fields'   => array(
						array(
							'key'           => 'field_doginvoice_why_us_item_icon',
							'label'         => 'Ikona (SVG)',
							'name'          => 'icon',
							'type'          => 'image',
							'instructions'  => 'Wgraj plik SVG, np. z src/assets/images/why-us/ w motywie, albo własną ikonę w tym samym stylu (48×48, linia #171717).',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
							'mime_types'    => 'svg',
							'required'      => 1,
						),
						array(
							'key'      => 'field_doginvoice_why_us_item_title',
							'label'    => 'Tytuł',
							'name'     => 'title',
							'type'     => 'text',
							'required' => 1,
						),
						array(
							'key'      => 'field_doginvoice_why_us_item_description',
							'label'    => 'Opis',
							'name'     => 'description',
							'type'     => 'textarea',
							'rows'     => 3,
							'required' => 1,
						),
					),
				),
			),
			'location'    => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'  => 5,
			'position'    => 'normal',
			'style'       => 'default',
			'active'      => true,
			'description' => 'Sekcja "Dlaczego DogInvoice?" na stronie głównej (front-page.php).',
		)
	);
}

/**
 * Pricing section fields (front-page.php, <section class="pricing">).
 *
 * The pricing detail modal (template-parts/front-page/pricing-modal.php)
 * needs no fields of its own — pricing.js reads it straight out of the
 * rendered plan cards' DOM/data attributes at runtime.
 */
function doginvoice_acf_pricing_fields() {
	acf_add_local_field_group(
		array(
			'key'         => 'group_doginvoice_pricing',
			'title'       => 'Front Page — Cennik',
			'fields'      => array(
				array(
					'key'   => 'field_doginvoice_pricing_content_tab',
					'label' => 'Nagłówek sekcji',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_doginvoice_pricing_badge',
					'label' => 'Tekst odznaki (badge)',
					'name'  => 'pricing_badge',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_doginvoice_pricing_title',
					'label' => 'Nagłówek (H2)',
					'name'  => 'pricing_title',
					'type'  => 'text',
				),
				array(
					'key'  => 'field_doginvoice_pricing_description',
					'label' => 'Opis',
					'name'  => 'pricing_description',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_doginvoice_pricing_plans_tab',
					'label' => 'Plany',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_doginvoice_pricing_plans',
					'label'        => 'Plany cenowe',
					'name'         => 'pricing_plans',
					'type'         => 'repeater',
					'layout'       => 'block',
					'button_label' => 'Dodaj plan',
					'min'          => 1,
					'sub_fields'   => array(
						array(
							'key'      => 'field_doginvoice_pricing_plan_title',
							'label'    => 'Nazwa planu',
							'name'     => 'title',
							'type'     => 'text',
							'required' => 1,
							'wrapper'  => array( 'width' => '50' ),
						),
						array(
							'key'      => 'field_doginvoice_pricing_plan_featured',
							'label'    => 'Plan wyróżniony ("Popularny")',
							'name'     => 'is_featured',
							'type'     => 'true_false',
							'ui'       => 1,
							'wrapper'  => array( 'width' => '50' ),
						),
						array(
							'key'          => 'field_doginvoice_pricing_plan_price_monthly',
							'label'        => 'Cena miesięczna (PLN, netto)',
							'name'         => 'price_monthly',
							'type'         => 'number',
							'instructions' => 'Zostaw puste, jeśli plan nie ma stałej ceny (np. "Indywidualnie") — wtedy liczy się pole "Tekst zamiast ceny" obok.',
							'wrapper'      => array( 'width' => '25' ),
						),
						array(
							'key'      => 'field_doginvoice_pricing_plan_price_yearly',
							'label'    => 'Cena roczna (PLN/mies., netto)',
							'name'     => 'price_yearly',
							'type'     => 'number',
							'wrapper'  => array( 'width' => '25' ),
						),
						array(
							'key'          => 'field_doginvoice_pricing_plan_price_text',
							'label'        => 'Tekst zamiast ceny',
							'name'         => 'price_text',
							'type'         => 'text',
							'instructions' => 'Używane tylko, gdy cena miesięczna jest pusta, np. "Indywidualnie".',
							'wrapper'      => array( 'width' => '25' ),
						),
						array(
							'key'          => 'field_doginvoice_pricing_plan_note',
							'label'        => 'Notka pod ceną',
							'name'         => 'note',
							'type'         => 'text',
							'instructions' => 'Np. "na zawsze darmowy". Zostaw puste, by nic nie pokazywać.',
							'wrapper'      => array( 'width' => '25' ),
						),
						array(
							'key'          => 'field_doginvoice_pricing_plan_show_more_link',
							'label'        => 'Pokaż link "Zobacz więcej" (otwiera modal)',
							'name'         => 'show_more_link',
							'type'         => 'true_false',
							'ui'           => 1,
							'wrapper'      => array( 'width' => '50' ),
						),
						array(
							'key'     => 'field_doginvoice_pricing_plan_cta_label',
							'label'   => 'Tekst przycisku CTA',
							'name'    => 'cta_label',
							'type'    => 'text',
							'required' => 1,
							'wrapper' => array( 'width' => '25' ),
						),
						array(
							'key'     => 'field_doginvoice_pricing_plan_cta_url',
							'label'   => 'Link przycisku CTA',
							'name'    => 'cta_url',
							'type'    => 'text',
							'required' => 1,
							'wrapper' => array( 'width' => '25' ),
						),
						array(
							'key'          => 'field_doginvoice_pricing_plan_features',
							'label'        => 'Funkcje w planie',
							'name'         => 'features',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Dodaj funkcję',
							'min'          => 1,
							'sub_fields'   => array(
								array(
									'key'      => 'field_doginvoice_pricing_plan_feature_title',
									'label'    => 'Funkcja',
									'name'     => 'title',
									'type'     => 'text',
									'required' => 1,
								),
								array(
									'key'          => 'field_doginvoice_pricing_plan_feature_description',
									'label'        => 'Opis (dymek info)',
									'name'         => 'description',
									'type'         => 'text',
									'instructions' => 'Opcjonalne. Jeśli wypełnione, przy funkcji pojawi się ikonka z dymkiem informacyjnym.',
								),
							),
						),
					),
				),
			),
			'location'    => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'  => 6,
			'position'    => 'normal',
			'style'       => 'default',
			'active'      => true,
			'description' => 'Sekcja "Cennik" na stronie głównej (front-page.php).',
		)
	);
}

/**
 * Integrations section fields (front-page.php, <section class="integrations">).
 *
 * The decorative background graphic and center-circle glow SVGs are pure
 * design chrome, not content, so they stay hardcoded in the template.
 */
function doginvoice_acf_integrations_fields() {
	acf_add_local_field_group(
		array(
			'key'         => 'group_doginvoice_integrations',
			'title'       => 'Front Page — Integracje',
			'fields'      => array(
				array(
					'key'   => 'field_doginvoice_integrations_content_tab',
					'label' => 'Nagłówek sekcji',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_doginvoice_integrations_badge',
					'label' => 'Tekst odznaki (badge)',
					'name'  => 'integrations_badge',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_doginvoice_integrations_title',
					'label' => 'Nagłówek (H2)',
					'name'  => 'integrations_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_doginvoice_integrations_items_tab',
					'label' => 'Integracje',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_doginvoice_integrations_items',
					'label'        => 'Lista integracji',
					'name'         => 'integrations_items',
					'type'         => 'repeater',
					'instructions' => 'Karuzela logotypów integracji. Skrypt sam dokleja kopie, jeśli jest ich za mało, by wypełnić szerokość ekranu.',
					'layout'       => 'table',
					'button_label' => 'Dodaj integrację',
					'min'          => 1,
					'sub_fields'   => array(
						array(
							'key'           => 'field_doginvoice_integrations_item_logo',
							'label'         => 'Logo',
							'name'          => 'logo',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
							'required'      => 1,
						),
						array(
							'key'      => 'field_doginvoice_integrations_item_name',
							'label'    => 'Nazwa',
							'name'     => 'name',
							'type'     => 'text',
							'required' => 1,
						),
					),
				),
			),
			'location'    => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'  => 7,
			'position'    => 'normal',
			'style'       => 'default',
			'active'      => true,
			'description' => 'Sekcja "Integracje" na stronie głównej (front-page.php).',
		)
	);
}

/**
 * Testimonials section fields (front-page.php, <section class="testimonials">).
 *
 * Avatar initials are derived from the name and the avatar color cycles
 * through the 4 CSS variants in the template — neither needs its own field.
 */
function doginvoice_acf_testimonials_fields() {
	acf_add_local_field_group(
		array(
			'key'         => 'group_doginvoice_testimonials',
			'title'       => 'Front Page — Opinie',
			'fields'      => array(
				array(
					'key'   => 'field_doginvoice_testimonials_content_tab',
					'label' => 'Nagłówek sekcji',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_doginvoice_testimonials_badge',
					'label' => 'Tekst odznaki (badge)',
					'name'  => 'testimonials_badge',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_doginvoice_testimonials_title',
					'label' => 'Nagłówek (H2)',
					'name'  => 'testimonials_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_doginvoice_testimonials_items_tab',
					'label' => 'Opinie',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_doginvoice_testimonials_items',
					'label'        => 'Lista opinii',
					'name'         => 'testimonials_items',
					'type'         => 'repeater',
					'layout'       => 'block',
					'button_label' => 'Dodaj opinię',
					'min'          => 1,
					'sub_fields'   => array(
						array(
							'key'      => 'field_doginvoice_testimonials_item_name',
							'label'    => 'Imię i nazwisko',
							'name'     => 'name',
							'type'     => 'text',
							'required' => 1,
							'wrapper'  => array( 'width' => '50' ),
						),
						array(
							'key'      => 'field_doginvoice_testimonials_item_company',
							'label'    => 'Firma',
							'name'     => 'company',
							'type'     => 'text',
							'required' => 1,
							'wrapper'  => array( 'width' => '50' ),
						),
						array(
							'key'           => 'field_doginvoice_testimonials_item_rating',
							'label'         => 'Ocena (1–5)',
							'name'          => 'rating',
							'type'          => 'number',
							'min'           => 1,
							'max'           => 5,
							'default_value' => 5,
							'required'      => 1,
							'wrapper'       => array( 'width' => '50' ),
						),
						array(
							'key'          => 'field_doginvoice_testimonials_item_body',
							'label'        => 'Treść opinii',
							'name'         => 'body',
							'type'         => 'textarea',
							'instructions' => 'Jeden akapit na linię.',
							'rows'         => 5,
							'required'     => 1,
						),
					),
				),
			),
			'location'    => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'  => 8,
			'position'    => 'normal',
			'style'       => 'default',
			'active'      => true,
			'description' => 'Sekcja "Opinie" na stronie głównej (front-page.php).',
		)
	);
}

/**
 * FAQ section fields (front-page.php, <section class="faq">).
 *
 * Each category's anchor id (used to link the nav buttons to their panel)
 * is slugified from its title in the template, so there's no separate
 * "ID" field an editor could mistype or duplicate.
 */
function doginvoice_acf_faq_fields() {
	acf_add_local_field_group(
		array(
			'key'         => 'group_doginvoice_faq',
			'title'       => 'Front Page — FAQ',
			'fields'      => array(
				array(
					'key'   => 'field_doginvoice_faq_content_tab',
					'label' => 'Nagłówek sekcji',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_doginvoice_faq_badge',
					'label' => 'Tekst odznaki (badge)',
					'name'  => 'faq_badge',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_doginvoice_faq_title',
					'label' => 'Nagłówek (H2)',
					'name'  => 'faq_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_doginvoice_faq_categories_tab',
					'label' => 'Kategorie i pytania',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_doginvoice_faq_categories',
					'label'        => 'Kategorie',
					'name'         => 'faq_categories',
					'type'         => 'repeater',
					'layout'       => 'block',
					'button_label' => 'Dodaj kategorię',
					'min'          => 1,
					'sub_fields'   => array(
						array(
							'key'      => 'field_doginvoice_faq_category_title',
							'label'    => 'Nazwa kategorii',
							'name'     => 'title',
							'type'     => 'text',
							'required' => 1,
						),
						array(
							'key'          => 'field_doginvoice_faq_category_items',
							'label'        => 'Pytania',
							'name'         => 'items',
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => 'Dodaj pytanie',
							'min'          => 1,
							'sub_fields'   => array(
								array(
									'key'      => 'field_doginvoice_faq_item_question',
									'label'    => 'Pytanie',
									'name'     => 'question',
									'type'     => 'text',
									'required' => 1,
								),
								array(
									'key'          => 'field_doginvoice_faq_item_answer',
									'label'        => 'Odpowiedź',
									'name'         => 'answer',
									'type'         => 'textarea',
									'instructions' => 'Jeden akapit na linię.',
									'rows'         => 4,
									'required'     => 1,
								),
							),
						),
					),
				),
			),
			'location'    => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'  => 9,
			'position'    => 'normal',
			'style'       => 'default',
			'active'      => true,
			'description' => 'Sekcja "FAQ" na stronie głównej (front-page.php).',
		)
	);
}

/**
 * Fields for the 404.php template.
 *
 * A 404 response has no underlying Post/Page object to attach fields to,
 * so this content lives on a dedicated ACF Options Page instead of a
 * per-post field group.
 */
function doginvoice_acf_notfound_fields() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page(
			array(
				'page_title' => 'Strona 404',
				'menu_title' => 'Strona 404',
				'menu_slug'  => 'doginvoice-404',
				'capability' => 'edit_posts',
				'icon_url'   => 'dashicons-warning',
				'position'   => 60,
			)
		);
	}

	acf_add_local_field_group(
		array(
			'key'         => 'group_doginvoice_notfound',
			'title'       => 'Strona 404',
			'fields'      => array(
				array(
					'key'           => 'field_doginvoice_notfound_title',
					'label'         => 'Nagłówek',
					'name'          => 'notfound_title',
					'type'          => 'text',
					'default_value' => 'Strona nie istnieje',
					'required'      => 1,
				),
				array(
					'key'           => 'field_doginvoice_notfound_subtitle',
					'label'         => 'Podtytuł',
					'name'          => 'notfound_subtitle',
					'type'          => 'textarea',
					'instructions'  => 'Dozwolone proste tagi HTML: <strong>, <br />.',
					'default_value' => 'Link, którego szukasz, jest nieaktualny albo został przeniesiony. Wróć na stronę główną i kontynuuj z <strong>DogInvoice</strong>.',
					'rows'          => 3,
					'required'      => 1,
				),
				array(
					'key'           => 'field_doginvoice_notfound_button_label',
					'label'         => 'Tekst przycisku',
					'name'          => 'notfound_button_label',
					'type'          => 'text',
					'default_value' => 'Wróć na stronę główną',
					'required'      => 1,
				),
			),
			'location'    => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'doginvoice-404',
					),
				),
			),
			'active'      => true,
			'description' => 'Treść strony błędu 404 (404.php). Przycisk zawsze prowadzi na stronę główną.',
		)
	);
}

/**
 * Fields for the generic text-page template (page.php).
 *
 * Applies to every Page using the default template — i.e. every Page
 * that front-page.php doesn't take over. Title and body come from the
 * normal WordPress editor (get_the_title() / the_content()); these two
 * fields only add the optional badge and lead paragraph the design has
 * above the main content.
 */
function doginvoice_acf_text_page_fields() {
	acf_add_local_field_group(
		array(
			'key'         => 'group_doginvoice_text_page',
			'title'       => 'Nagłówek strony',
			'fields'      => array(
				array(
					'key'          => 'field_doginvoice_page_badge',
					'label'        => 'Tekst odznaki (badge)',
					'name'         => 'page_badge',
					'type'         => 'text',
					'instructions' => 'Opcjonalne, np. "REGULAMIN". Zostaw puste, by nie pokazywać odznaki.',
				),
				array(
					'key'          => 'field_doginvoice_page_lead',
					'label'        => 'Lead (wstęp pod tytułem)',
					'name'         => 'page_lead',
					'type'         => 'textarea',
					'instructions' => 'Opcjonalne. Dozwolone proste tagi HTML: <strong>, <br />, <a>. Zostaw puste, by nie pokazywać leadu.',
					'rows'         => 4,
				),
			),
			'location'    => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'default',
					),
				),
			),
			'active'      => true,
			'description' => 'Opcjonalna odznaka i lead nad główną treścią strony (page.php). Tytuł i treść edytujesz normalnie w edytorze WordPressa.',
		)
	);
}
