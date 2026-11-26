<?php
/**
 * Landingi kampanii reklamowych.
 *
 * Osobny typ treści „Landingi” (adres /lp/nazwa/), który marketing składa
 * w kokpicie z gotowych sekcji. Wygląd sekcji jest stały (src/scss/_landing.scss),
 * w ACF edytuje się wyłącznie treść, kolejność i kilka przełączników.
 *
 * 1. Typ treści i ustawienia (noindex, klasa body, duplikowanie).
 * 2. Funkcje pomocnicze dla szablonów (single-landing.php, header.php, footer.php).
 * 3. Pola ACF.
 *
 * Nowa sekcja = nowy layout w doginvoice_landing_layouts() + plik
 * template-parts/landing/<nazwa-layoutu>.php + style w _landing.scss.
 *
 * @package doginvoice
 */

const DOGINVOICE_LANDING_REWRITE_VERSION = '1';

/* -------------------------------------------------------------------------
 * 1. Typ treści
 * ---------------------------------------------------------------------- */

add_action( 'init', 'doginvoice_landing_register_post_type' );

function doginvoice_landing_register_post_type() {
	register_post_type(
		'landing',
		array(
			'labels'              => array(
				'name'               => 'Landingi',
				'singular_name'      => 'Landing',
				'menu_name'          => 'Landingi',
				'add_new'            => 'Dodaj landing',
				'add_new_item'       => 'Dodaj landing',
				'edit_item'          => 'Edytuj landing',
				'new_item'           => 'Nowy landing',
				'view_item'          => 'Zobacz landing',
				'search_items'       => 'Szukaj landingów',
				'not_found'          => 'Brak landingów',
				'not_found_in_trash' => 'Brak landingów w koszu',
				'all_items'          => 'Wszystkie landingi',
			),
			'public'              => true,
			'exclude_from_search' => true,
			'has_archive'         => false,
			'show_in_nav_menus'   => false,
			'show_in_rest'        => false,
			'rewrite'             => array(
				'slug'       => 'lp',
				'with_front' => false,
			),
			'menu_position'       => 22,
			'menu_icon'           => 'dashicons-megaphone',
			// „thumbnail” = obrazek pokazywany przy udostępnianiu linku (wtyczka Open Graph).
			'supports'            => array( 'title', 'thumbnail', 'revisions' ),
		)
	);

	// Adresy /lp/… zaczynają działać bez wchodzenia w Ustawienia → Bezpośrednie odnośniki.
	if ( get_option( 'doginvoice_landing_rewrite' ) !== DOGINVOICE_LANDING_REWRITE_VERSION ) {
		flush_rewrite_rules( false );
		update_option( 'doginvoice_landing_rewrite', DOGINVOICE_LANDING_REWRITE_VERSION );
	}
}

// Landing kampanii domyślnie nie trafia do wyszukiwarek (przełącznik w Ustawieniach landingu).
add_filter(
	'wp_robots',
	function ( $robots ) {
		if ( is_singular( 'landing' ) && doginvoice_landing_setting( 'lp_noindex', true ) ) {
			$robots['noindex']  = true;
			$robots['nofollow'] = true;
		}
		return $robots;
	}
);

add_filter(
	'body_class',
	function ( $classes ) {
		if ( is_singular( 'landing' ) ) {
			$classes[] = 'page-landing';
			if ( doginvoice_landing_setting( 'lp_simple_header', true ) ) {
				$classes[] = 'page-landing--simple-header';
			}
			if ( doginvoice_landing_setting( 'lp_hide_chat', false ) ) {
				$classes[] = 'page-landing--no-chat';
			}
		}
		return $classes;
	}
);

/**
 * „Duplikuj” na liście landingów: nowa kampania zaczyna od kopii poprzedniej.
 */
add_filter(
	'post_row_actions',
	function ( $actions, $post ) {
		if ( 'landing' === $post->post_type && current_user_can( 'edit_posts' ) ) {
			$url = wp_nonce_url(
				admin_url( 'admin-post.php?action=doginvoice_landing_duplicate&post=' . $post->ID ),
				'doginvoice_landing_duplicate_' . $post->ID
			);
			$actions['doginvoice_duplicate'] = '<a href="' . esc_url( $url ) . '">Duplikuj</a>';
		}
		return $actions;
	},
	10,
	2
);

add_action(
	'admin_post_doginvoice_landing_duplicate',
	function () {
		$source_id = isset( $_GET['post'] ) ? (int) $_GET['post'] : 0;
		check_admin_referer( 'doginvoice_landing_duplicate_' . $source_id );

		$source = get_post( $source_id );
		if ( ! $source || 'landing' !== $source->post_type || ! current_user_can( 'edit_post', $source_id ) ) {
			wp_die( 'Nie można zduplikować tego landingu.' );
		}

		$copy_id = wp_insert_post(
			array(
				'post_type'   => 'landing',
				'post_status' => 'draft',
				'post_title'  => $source->post_title . ' (kopia)',
			)
		);
		if ( ! $copy_id || is_wp_error( $copy_id ) ) {
			wp_die( 'Nie udało się utworzyć kopii.' );
		}

		foreach ( get_post_meta( $source_id ) as $meta_key => $meta_values ) {
			if ( in_array( $meta_key, array( '_edit_lock', '_edit_last', '_wp_old_slug' ), true ) ) {
				continue;
			}
			foreach ( $meta_values as $meta_value ) {
				add_post_meta( $copy_id, $meta_key, wp_slash( maybe_unserialize( $meta_value ) ) );
			}
		}

		wp_safe_redirect( admin_url( 'post.php?action=edit&post=' . $copy_id ) );
		exit;
	}
);

/* -------------------------------------------------------------------------
 * 2. Funkcje pomocnicze
 * ---------------------------------------------------------------------- */

/**
 * Przełącznik z zakładki „Ustawienia” landingu. Dopóki landing nie został
 * zapisany z tym polem, obowiązuje wartość domyślna.
 *
 * @param string $name    Nazwa pola ACF.
 * @param bool   $default Wartość, gdy pole nie ma jeszcze zapisanej wartości.
 * @return bool
 */
function doginvoice_landing_setting( $name, $default ) {
	if ( ! is_singular( 'landing' ) || ! function_exists( 'get_field' ) ) {
		return false;
	}

	$value = get_field( $name, get_queried_object_id() );

	return null === $value || '' === $value ? $default : (bool) $value;
}

/**
 * Główny przycisk landingu: ten sam tekst i adres w nagłówku, hero,
 * sekcjach i nad stopką.
 *
 * @return array{label:string,url:string,new_tab:bool,note:string}
 */
function doginvoice_landing_cta() {
	$post_id = get_queried_object_id();
	$label   = function_exists( 'get_field' ) ? trim( (string) get_field( 'lp_cta_label', $post_id ) ) : '';
	$url     = function_exists( 'get_field' ) ? trim( (string) get_field( 'lp_cta_url', $post_id ) ) : '';
	$note    = function_exists( 'get_field' ) ? trim( (string) get_field( 'lp_cta_note', $post_id ) ) : '';
	$url     = $url ? $url : 'https://app.doginvoice.com/register';

	return array(
		'label'   => $label ? $label : 'Załóż konto bez zobowiązań',
		'url'     => $url,
		// Linki poza stronę (aplikacja, sklep) otwierają się w nowej karcie.
		'new_tab' => 0 !== strpos( $url, '#' ) && 0 !== strpos( $url, home_url() ),
		'note'    => $note,
	);
}

/**
 * Wyświetla główny przycisk landingu.
 *
 * @param string $placement Miejsce na stronie; trafia do zdarzenia Meta Pixel
 *                          Landing_CTA_Click (src/js/front-meta-events.js).
 * @param string $size      Rozmiar przycisku: "bg" lub "sm".
 */
function doginvoice_landing_cta_button( $placement, $size = 'bg' ) {
	$cta = doginvoice_landing_cta();
	?>
	<a
		href="<?php echo esc_url( $cta['url'] ); ?>"
		<?php echo $cta['new_tab'] ? 'target="_blank" rel="noopener"' : ''; ?>
		class="btn"
		size="<?php echo esc_attr( $size ); ?>"
		color="green"
		data-lp-cta="<?php echo esc_attr( $placement ); ?>">
		<span class="btn-title"><?php echo esc_html( $cta['label'] ); ?></span>
	</a>
	<?php
}

/**
 * Nagłówek sekcji landingu (plakietka, tytuł H2, opis). Każdy element jest opcjonalny.
 *
 * @param array  $section  Wiersz sekcji z ACF (klucze badge, title, description).
 * @param string $title_id Id tytułu dla aria-labelledby.
 */
function doginvoice_landing_head( $section, $title_id ) {
	$badge       = trim( (string) ( $section['badge'] ?? '' ) );
	$title       = trim( (string) ( $section['title'] ?? '' ) );
	$description = trim( (string) ( $section['description'] ?? '' ) );

	if ( ! $badge && ! $title && ! $description ) {
		return;
	}
	?>
	<header class="lp-head">
		<?php if ( $badge ) : ?>
			<div class="badge badge--light" data-aos="fade-up">
				<span class="badge-text"><?php echo esc_html( $badge ); ?></span>
			</div>
		<?php endif; ?>
		<?php if ( $title ) : ?>
			<h2 id="<?php echo esc_attr( $title_id ); ?>" class="lp-head-title typography--h2" data-remove-orphans data-aos="fade-up">
				<?php echo esc_html( $title ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( $description ) : ?>
			<p class="lp-head-description typography--body-lg" data-remove-orphans data-aos="fade-up">
				<?php echo esc_html( $description ); ?>
			</p>
		<?php endif; ?>
	</header>
	<?php
}

/**
 * Zamienia pole tekstowe „jedna pozycja w linii” na tablicę.
 *
 * @param mixed $text Wartość pola textarea.
 * @return string[]
 */
function doginvoice_landing_lines( $text ) {
	return array_values( array_filter( array_map( 'trim', explode( "\n", (string) $text ) ) ) );
}

/**
 * Wyświetla sekcję strony głównej (opinie, cennik, logotypy…) z jej własną
 * treścią: na czas renderowania pola ACF bez podanego id czytane są
 * ze strony głównej, więc zmiana np. opinii na stronie głównej od razu
 * widać na wszystkich landingach.
 *
 * @param string $slug Nazwa pliku w template-parts/front-page/.
 */
function doginvoice_landing_front_part( $slug ) {
	$front_id = (int) get_option( 'page_on_front' );
	if ( ! $front_id ) {
		return;
	}

	$use_front_page = static function ( $preload, $post_id ) use ( $front_id ) {
		return $post_id ? $preload : $front_id;
	};

	add_filter( 'acf/pre_load_post_id', $use_front_page, 20, 2 );
	get_template_part( 'template-parts/front-page/' . $slug );
	remove_filter( 'acf/pre_load_post_id', $use_front_page, 20 );
}

/* -------------------------------------------------------------------------
 * 3. Pola ACF
 * ---------------------------------------------------------------------- */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

/**
 * Pola nagłówka wspólne dla większości sekcji.
 *
 * @param string $layout      Nazwa layoutu (prefiks kluczy).
 * @param bool   $description Czy sekcja ma też opis pod tytułem.
 * @return array
 */
function doginvoice_landing_head_fields( $layout, $description = true ) {
	$fields = array(
		array(
			'key'          => "field_dilp_{$layout}_badge",
			'label'        => 'Plakietka nad tytułem',
			'name'         => 'badge',
			'type'         => 'text',
			'instructions' => 'Opcjonalnie. 1–3 słowa, np. „Jak to działa”.',
			'maxlength'    => 30,
			'wrapper'      => array( 'width' => '30' ),
		),
		array(
			'key'       => "field_dilp_{$layout}_title",
			'label'     => 'Tytuł sekcji',
			'name'      => 'title',
			'type'      => 'text',
			'maxlength' => 90,
			'wrapper'   => array( 'width' => '70' ),
		),
	);

	if ( $description ) {
		$fields[] = array(
			'key'          => "field_dilp_{$layout}_description",
			'label'        => 'Opis pod tytułem',
			'name'         => 'description',
			'type'         => 'textarea',
			'instructions' => 'Opcjonalnie. Jedno, dwa zdania.',
			'rows'         => 2,
			'new_lines'    => '',
			'maxlength'    => 220,
		);
	}

	return $fields;
}

/**
 * Komunikat w sekcjach, których treść pochodzi ze strony głównej.
 *
 * @param string $layout Nazwa layoutu.
 * @param string $what   Co jest pobierane, np. „Opinie”.
 * @return array
 */
function doginvoice_landing_shared_notice( $layout, $what ) {
	return array(
		array(
			'key'     => "field_dilp_{$layout}_notice",
			'label'   => '',
			'name'    => '',
			'type'    => 'message',
			'message' => $what . ' są takie same jak na stronie głównej. Zmienisz je w edycji strony głównej, a zmiana pojawi się na wszystkich landingach.',
		),
	);
}

/**
 * Sekcje do wyboru w polu „Sekcje”.
 *
 * @return array
 */
function doginvoice_landing_layouts() {
	$layouts = array(
		'benefits'     => array(
			'label'  => 'Korzyści (kafelki)',
			'fields' => array_merge(
				doginvoice_landing_head_fields( 'benefits' ),
				array(
					array(
						'key'          => 'field_dilp_benefits_items',
						'label'        => 'Kafelki',
						'name'         => 'items',
						'type'         => 'repeater',
						'instructions' => 'Najlepiej wyglądają 3 lub 6 kafelków.',
						'min'          => 2,
						'max'          => 6,
						'layout'       => 'block',
						'button_label' => 'Dodaj kafelek',
						'sub_fields'   => array(
							array(
								'key'           => 'field_dilp_benefits_item_icon',
								'label'         => 'Ikona',
								'name'          => 'icon',
								'type'          => 'image',
								'instructions'  => 'Opcjonalnie. Ikona z biblioteki mediów (takie jak na stronie głównej).',
								'return_format' => 'array',
								'preview_size'  => 'thumbnail',
								'wrapper'       => array( 'width' => '20' ),
							),
							array(
								'key'       => 'field_dilp_benefits_item_title',
								'label'     => 'Tytuł',
								'name'      => 'title',
								'type'      => 'text',
								'required'  => 1,
								'maxlength' => 50,
								'wrapper'   => array( 'width' => '30' ),
							),
							array(
								'key'       => 'field_dilp_benefits_item_description',
								'label'     => 'Opis',
								'name'      => 'description',
								'type'      => 'textarea',
								'rows'      => 2,
								'new_lines' => '',
								'maxlength' => 200,
								'wrapper'   => array( 'width' => '50' ),
							),
						),
					),
				)
			),
		),
		'media_text'   => array(
			'label'  => 'Obraz + tekst',
			'fields' => array(
				array(
					'key'           => 'field_dilp_media_text_image',
					'label'         => 'Obraz',
					'name'          => 'image',
					'type'          => 'image',
					'instructions'  => 'Zdjęcie lub zrzut ekranu, min. 1200 px szerokości.',
					'required'      => 1,
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'wrapper'       => array( 'width' => '40' ),
				),
				array(
					'key'           => 'field_dilp_media_text_side',
					'label'         => 'Obraz po stronie',
					'name'          => 'side',
					'type'          => 'button_group',
					'instructions'  => 'Przy kilku takich sekcjach pod rząd ustawiaj strony na zmianę.',
					'choices'       => array(
						'left'  => 'Lewej',
						'right' => 'Prawej',
					),
					'default_value' => 'left',
					'wrapper'       => array( 'width' => '30' ),
				),
				array(
					'key'           => 'field_dilp_media_text_fit',
					'label'         => 'Rodzaj obrazu',
					'name'          => 'fit',
					'type'          => 'button_group',
					'instructions'  => 'Zdjęcie wypełnia całe pole (może być przycięte). Zrzut ekranu jest widoczny w całości.',
					'choices'       => array(
						'cover'   => 'Zdjęcie',
						'contain' => 'Zrzut ekranu',
					),
					'default_value' => 'cover',
					'wrapper'       => array( 'width' => '30' ),
				),
				array(
					'key'          => 'field_dilp_media_text_badge',
					'label'        => 'Plakietka nad tytułem',
					'name'         => 'badge',
					'type'         => 'text',
					'instructions' => 'Opcjonalnie.',
					'maxlength'    => 30,
					'wrapper'      => array( 'width' => '30' ),
				),
				array(
					'key'       => 'field_dilp_media_text_title',
					'label'     => 'Tytuł',
					'name'      => 'title',
					'type'      => 'text',
					'required'  => 1,
					'maxlength' => 90,
					'wrapper'   => array( 'width' => '70' ),
				),
				array(
					'key'       => 'field_dilp_media_text_description',
					'label'     => 'Opis',
					'name'      => 'description',
					'type'      => 'textarea',
					'rows'      => 3,
					'new_lines' => '',
					'maxlength' => 320,
				),
				array(
					'key'          => 'field_dilp_media_text_points',
					'label'        => 'Lista punktów',
					'name'         => 'points',
					'type'         => 'textarea',
					'instructions' => 'Opcjonalnie. Każdy punkt w osobnej linii, najlepiej 3–4 krótkie.',
					'rows'         => 4,
					'new_lines'    => '',
					'wrapper'      => array( 'width' => '70' ),
				),
				array(
					'key'           => 'field_dilp_media_text_show_cta',
					'label'         => 'Przycisk',
					'name'          => 'show_cta',
					'type'          => 'true_false',
					'message'       => 'Pokaż główny przycisk w tej sekcji',
					'default_value' => 0,
					'ui'            => 1,
					'wrapper'       => array( 'width' => '30' ),
				),
			),
		),
		'steps'        => array(
			'label'  => 'Kroki (1, 2, 3)',
			'fields' => array_merge(
				doginvoice_landing_head_fields( 'steps' ),
				array(
					array(
						'key'          => 'field_dilp_steps_items',
						'label'        => 'Kroki',
						'name'         => 'items',
						'type'         => 'repeater',
						'min'          => 2,
						'max'          => 4,
						'layout'       => 'table',
						'button_label' => 'Dodaj krok',
						'sub_fields'   => array(
							array(
								'key'       => 'field_dilp_steps_item_title',
								'label'     => 'Tytuł',
								'name'      => 'title',
								'type'      => 'text',
								'required'  => 1,
								'maxlength' => 40,
								'wrapper'   => array( 'width' => '35' ),
							),
							array(
								'key'       => 'field_dilp_steps_item_description',
								'label'     => 'Opis',
								'name'      => 'description',
								'type'      => 'textarea',
								'rows'      => 2,
								'new_lines' => '',
								'maxlength' => 160,
							),
						),
					),
				)
			),
		),
		'stats'        => array(
			'label'  => 'Liczby',
			'fields' => array_merge(
				doginvoice_landing_head_fields( 'stats', false ),
				array(
					array(
						'key'          => 'field_dilp_stats_items',
						'label'        => 'Liczby',
						'name'         => 'items',
						'type'         => 'repeater',
						'min'          => 2,
						'max'          => 4,
						'layout'       => 'table',
						'button_label' => 'Dodaj liczbę',
						'sub_fields'   => array(
							array(
								'key'         => 'field_dilp_stats_item_value',
								'label'       => 'Liczba',
								'name'        => 'value',
								'type'        => 'text',
								'required'    => 1,
								'placeholder' => 'np. 3 min',
								'maxlength'   => 12,
								'wrapper'     => array( 'width' => '30' ),
							),
							array(
								'key'         => 'field_dilp_stats_item_label',
								'label'       => 'Podpis',
								'name'        => 'label',
								'type'        => 'text',
								'required'    => 1,
								'placeholder' => 'np. tyle zajmuje start',
								'maxlength'   => 60,
							),
						),
					),
				)
			),
		),
		'comparison'   => array(
			'label'  => 'Porównanie (tabela)',
			'fields' => array_merge(
				doginvoice_landing_head_fields( 'comparison' ),
				array(
					array(
						'key'           => 'field_dilp_comparison_col_a',
						'label'         => 'Nazwa pierwszej kolumny',
						'name'          => 'col_a',
						'type'          => 'text',
						'required'      => 1,
						'placeholder'   => 'np. Księgowa',
						'maxlength'     => 30,
						'wrapper'       => array( 'width' => '50' ),
					),
					array(
						'key'           => 'field_dilp_comparison_col_b',
						'label'         => 'Nazwa drugiej kolumny (wyróżniona)',
						'name'          => 'col_b',
						'type'          => 'text',
						'required'      => 1,
						'default_value' => 'DogInvoice',
						'maxlength'     => 30,
						'wrapper'       => array( 'width' => '50' ),
					),
					array(
						'key'          => 'field_dilp_comparison_rows',
						'label'        => 'Wiersze',
						'name'         => 'rows',
						'type'         => 'repeater',
						'min'          => 2,
						'max'          => 8,
						'layout'       => 'table',
						'button_label' => 'Dodaj wiersz',
						'sub_fields'   => array(
							array(
								'key'       => 'field_dilp_comparison_row_label',
								'label'     => 'Co porównujemy',
								'name'      => 'label',
								'type'      => 'text',
								'required'  => 1,
								'maxlength' => 40,
								'wrapper'   => array( 'width' => '24' ),
							),
							array(
								'key'       => 'field_dilp_comparison_row_a',
								'label'     => 'Pierwsza kolumna',
								'name'      => 'a',
								'type'      => 'text',
								'required'  => 1,
								'maxlength' => 120,
							),
							array(
								'key'       => 'field_dilp_comparison_row_b',
								'label'     => 'Druga kolumna',
								'name'      => 'b',
								'type'      => 'text',
								'required'  => 1,
								'maxlength' => 120,
							),
						),
					),
				)
			),
		),
		'logos'        => array(
			'label'  => 'Logotypy firm',
			'max'    => 1,
			'fields' => array(
				array(
					'key'          => 'field_dilp_logos_heading',
					'label'        => 'Mały nagłówek nad logotypami',
					'name'         => 'heading',
					'type'         => 'text',
					'instructions' => 'Opcjonalnie, np. „Zaufali nam”.',
					'maxlength'    => 50,
				),
				array(
					'key'           => 'field_dilp_logos_items',
					'label'         => 'Logotypy',
					'name'          => 'items',
					'type'          => 'gallery',
					'instructions'  => 'Wgraj logotypy dla tej kampanii (najlepiej SVG lub PNG z przezroczystym tłem, co najmniej 4). Wyświetlą się w szarości, jako przewijany pasek. Bez wgranych logotypów sekcja nie pokaże się na stronie.',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
					'insert'        => 'append',
					'library'       => 'all',
				),
			),
		),
		'testimonials' => array(
			'label'  => 'Opinie klientów (ze strony głównej)',
			'max'    => 1,
			'fields' => doginvoice_landing_shared_notice( 'testimonials', 'Opinie' ),
		),
		'pricing'      => array(
			'label'  => 'Cennik (ze strony głównej)',
			'max'    => 1,
			'fields' => doginvoice_landing_shared_notice( 'pricing', 'Plany i ceny' ),
		),
		'faq'          => array(
			'label'  => 'Pytania i odpowiedzi (FAQ)',
			'max'    => 1,
			'fields' => array_merge(
				doginvoice_landing_head_fields( 'faq', false ),
				array(
					array(
						'key'          => 'field_dilp_faq_items',
						'label'        => 'Pytania',
						'name'         => 'items',
						'type'         => 'repeater',
						'instructions' => 'Pytania, które padają w tej kampanii. Najlepiej 3–6.',
						'min'          => 1,
						'max'          => 10,
						'layout'       => 'block',
						'button_label' => 'Dodaj pytanie',
						'sub_fields'   => array(
							array(
								'key'       => 'field_dilp_faq_item_question',
								'label'     => 'Pytanie',
								'name'      => 'question',
								'type'      => 'text',
								'required'  => 1,
								'maxlength' => 140,
							),
							array(
								'key'       => 'field_dilp_faq_item_answer',
								'label'     => 'Odpowiedź',
								'name'      => 'answer',
								'type'      => 'textarea',
								'required'  => 1,
								'rows'      => 3,
								'new_lines' => '',
							),
						),
					),
				)
			),
		),
		'cta'          => array(
			'label'  => 'Baner z przyciskiem',
			'fields' => array(
				array(
					'key'       => 'field_dilp_cta_title',
					'label'     => 'Tytuł',
					'name'      => 'title',
					'type'      => 'text',
					'required'  => 1,
					'maxlength' => 90,
				),
				array(
					'key'          => 'field_dilp_cta_description',
					'label'        => 'Opis',
					'name'         => 'description',
					'type'         => 'textarea',
					'instructions' => 'Opcjonalnie. Przycisk jest taki sam jak w całym landingu (zakładka „Przycisk”).',
					'rows'         => 2,
					'new_lines'    => '',
					'maxlength'    => 200,
				),
			),
		),
		'note'         => array(
			'label'  => 'Tekst (np. warunki promocji)',
			'fields' => array(
				array(
					'key'       => 'field_dilp_note_title',
					'label'     => 'Tytuł',
					'name'      => 'title',
					'type'      => 'text',
					'maxlength' => 90,
				),
				array(
					'key'          => 'field_dilp_note_text',
					'label'        => 'Treść',
					'name'         => 'text',
					'type'         => 'wysiwyg',
					'required'     => 1,
					'tabs'         => 'visual',
					'toolbar'      => 'basic',
					'media_upload' => 0,
				),
			),
		),
	);

	$acf_layouts = array();
	foreach ( $layouts as $name => $layout ) {
		$acf_layouts[ "layout_dilp_{$name}" ] = array(
			'key'        => "layout_dilp_{$name}",
			'name'       => $name,
			'label'      => $layout['label'],
			'display'    => 'block',
			'sub_fields' => $layout['fields'],
			'max'        => $layout['max'] ?? '',
		);
	}

	return $acf_layouts;
}

add_action( 'acf/init', 'doginvoice_landing_acf_fields' );

function doginvoice_landing_acf_fields() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_doginvoice_landing',
			'title'    => 'Landing kampanii',
			'fields'   => array(
				// ---- Hero ----
				array(
					'key'   => 'field_dilp_tab_hero',
					'label' => '1. Góra strony',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_dilp_hero_badge',
					'label'        => 'Plakietka nad nagłówkiem',
					'name'         => 'lp_hero_badge',
					'type'         => 'text',
					'instructions' => 'Opcjonalnie. 1–3 słowa, np. „Dla biur rachunkowych”.',
					'maxlength'    => 30,
				),
				array(
					'key'          => 'field_dilp_hero_title',
					'label'        => 'Nagłówek (H1)',
					'name'         => 'lp_hero_title',
					'type'         => 'text',
					'instructions' => 'Najważniejsze zdanie strony. Powinno powtarzać obietnicę z reklamy. Do ok. 60 znaków.',
					'required'     => 1,
					'maxlength'    => 90,
				),
				array(
					'key'          => 'field_dilp_hero_subtitle',
					'label'        => 'Podtytuł',
					'name'         => 'lp_hero_subtitle',
					'type'         => 'textarea',
					'instructions' => 'Jedno, dwa zdania rozwinięcia.',
					'rows'         => 3,
					'new_lines'    => '',
					'maxlength'    => 260,
				),
				array(
					'key'          => 'field_dilp_hero_points',
					'label'        => 'Krótkie atuty pod przyciskiem',
					'name'         => 'lp_hero_points',
					'type'         => 'textarea',
					'instructions' => 'Opcjonalnie. Do 3 krótkich haseł, każde w osobnej linii, np. „Bez karty płatniczej”.',
					'rows'         => 3,
					'new_lines'    => '',
					'wrapper'      => array( 'width' => '50' ),
				),
				array(
					'key'          => 'field_dilp_hero_secondary',
					'label'        => 'Drugi przycisk',
					'name'         => 'lp_hero_secondary',
					'type'         => 'link',
					'instructions' => 'Opcjonalnie, np. „Zobacz cennik”. Główny przycisk ustawisz w zakładce „Przycisk”.',
					'return_format' => 'array',
					'wrapper'      => array( 'width' => '50' ),
				),
				array(
					'key'           => 'field_dilp_hero_image',
					'label'         => 'Obraz',
					'name'          => 'lp_hero_image',
					'type'          => 'image',
					'instructions'  => 'Zrzut ekranu aplikacji lub grafika kampanii. Poziomy, min. 1600 px szerokości. Bez obrazu hero będzie samym tekstem.',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),

				// ---- Przycisk ----
				array(
					'key'   => 'field_dilp_tab_cta',
					'label' => '2. Przycisk',
					'type'  => 'tab',
				),
				array(
					'key'     => 'field_dilp_cta_info',
					'label'   => '',
					'type'    => 'message',
					'message' => 'Landing ma jeden główny przycisk. Ten sam tekst i adres pojawia się w nagłówku, na górze strony, w sekcjach i nad stopką, dzięki czemu cała strona prowadzi do jednego celu.',
				),
				array(
					'key'           => 'field_dilp_cta_label',
					'label'         => 'Tekst przycisku',
					'name'          => 'lp_cta_label',
					'type'          => 'text',
					'default_value' => 'Załóż konto bez zobowiązań',
					'required'      => 1,
					'maxlength'     => 34,
					'wrapper'       => array( 'width' => '40' ),
				),
				array(
					'key'           => 'field_dilp_cta_url',
					'label'         => 'Adres przycisku',
					'name'          => 'lp_cta_url',
					'type'          => 'url',
					'instructions'  => 'Domyślnie rejestracja w aplikacji.',
					'default_value' => 'https://app.doginvoice.com/register',
					'required'      => 1,
					'wrapper'       => array( 'width' => '60' ),
				),
				array(
					'key'          => 'field_dilp_cta_note',
					'label'        => 'Dopisek pod przyciskiem',
					'name'         => 'lp_cta_note',
					'type'         => 'text',
					'instructions' => 'Opcjonalnie, np. „Start zajmuje 3 minuty”.',
					'maxlength'    => 70,
				),

				// ---- Sekcje ----
				array(
					'key'   => 'field_dilp_tab_sections',
					'label' => '3. Sekcje',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_dilp_sections',
					'label'        => 'Sekcje strony',
					'name'         => 'lp_sections',
					'type'         => 'flexible_content',
					'instructions' => 'Dodawaj sekcje i przeciągaj je, żeby zmienić kolejność. Wygląd każdej sekcji jest stały, uzupełniasz tylko treść.',
					'button_label' => 'Dodaj sekcję',
					'layouts'      => doginvoice_landing_layouts(),
				),

				// ---- Zakończenie ----
				array(
					'key'   => 'field_dilp_tab_final',
					'label' => '4. Zakończenie',
					'type'  => 'tab',
				),
				array(
					'key'     => 'field_dilp_final_info',
					'label'   => '',
					'type'    => 'message',
					'message' => 'Ciemna sekcja z głównym przyciskiem na samym dole strony, nad stopką.',
				),
				array(
					'key'           => 'field_dilp_final_badge',
					'label'         => 'Plakietka',
					'name'          => 'lp_final_badge',
					'type'          => 'text',
					'default_value' => 'Zacznij już dziś',
					'maxlength'     => 30,
				),
				array(
					'key'           => 'field_dilp_final_title',
					'label'         => 'Tytuł',
					'name'          => 'lp_final_title',
					'type'          => 'text',
					'default_value' => 'W 60 sekund DogInvoice będzie gotowy do pracy',
					'required'      => 1,
					'maxlength'     => 90,
				),
				array(
					'key'           => 'field_dilp_final_description',
					'label'         => 'Opis',
					'name'          => 'lp_final_description',
					'type'          => 'textarea',
					'default_value' => 'Załóż konto, podłącz KSeF, automatyzuj zarządzanie finansami swojej firmy.',
					'rows'          => 2,
					'new_lines'     => '',
					'maxlength'     => 200,
				),

				// ---- Ustawienia ----
				array(
					'key'   => 'field_dilp_tab_settings',
					'label' => 'Ustawienia',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_dilp_simple_header',
					'label'         => 'Nagłówek',
					'name'          => 'lp_simple_header',
					'type'          => 'true_false',
					'message'       => 'Uproszczony: tylko logo i główny przycisk, bez menu',
					'instructions'  => 'Zalecane dla ruchu z reklam: nic nie odciąga od celu kampanii.',
					'default_value' => 1,
					'ui'            => 1,
				),
				array(
					'key'           => 'field_dilp_hide_box_bar',
					'label'         => 'Pasek promocyjny nad nagłówkiem',
					'name'          => 'lp_hide_box_bar',
					'type'          => 'true_false',
					'message'       => 'Ukryj pasek (np. przedsprzedaż Doginvoice Box)',
					'default_value' => 1,
					'ui'            => 1,
				),
				array(
					'key'           => 'field_dilp_hide_chat',
					'label'         => 'Czat',
					'name'          => 'lp_hide_chat',
					'type'          => 'true_false',
					'message'       => 'Ukryj okienko czatu',
					'default_value' => 0,
					'ui'            => 1,
				),
				array(
					'key'           => 'field_dilp_noindex',
					'label'         => 'Wyszukiwarki',
					'name'          => 'lp_noindex',
					'type'          => 'true_false',
					'message'       => 'Ukryj landing przed Google',
					'instructions'  => 'Zalecane dla stron pod płatne kampanie. Wyłącz tylko, jeśli landing ma się pozycjonować.',
					'default_value' => 1,
					'ui'            => 1,
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'landing',
					),
				),
			),
			'position'        => 'acf_after_title',
			'style'           => 'seamless',
			'label_placement' => 'top',
		)
	);
}

// Zwinięta sekcja pokazuje swój tytuł, więc na liście widać, co jest czym.
add_filter(
	'acf/fields/flexible_content/layout_title/name=lp_sections',
	function ( $title ) {
		$section_title = trim( (string) get_sub_field( 'title' ) );

		return $section_title ? $title . ': <b>' . esc_html( $section_title ) . '</b>' : $title;
	}
);

// Nowy landing startuje z zalecanym układem sekcji zamiast pustej strony.
add_filter(
	'acf/load_value/name=lp_sections',
	function ( $value, $post_id ) {
		if ( ! empty( $value ) || ! is_admin() || 'auto-draft' !== get_post_status( $post_id ) ) {
			return $value;
		}

		return array(
			array( 'acf_fc_layout' => 'logos' ),
			array( 'acf_fc_layout' => 'benefits' ),
			array( 'acf_fc_layout' => 'media_text' ),
			array( 'acf_fc_layout' => 'steps' ),
			array( 'acf_fc_layout' => 'testimonials' ),
			array( 'acf_fc_layout' => 'faq' ),
		);
	},
	10,
	2
);
