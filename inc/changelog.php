<?php
/**
 * Changelog: typ wpisu „Changelog” i strona z szablonem template-changelog.php.
 *
 * Każda zmiana w aplikacji to osobny wpis (wp-admin > Changelog). Data
 * wpisu to data publikacji, wersja i typ zmiany pochodzą z pól ACF
 * (inc/acf-fields.php, grupa group_doginvoice_changelog_entry).
 * Wpisy nie mają własnych podstron, wyświetla je tylko strona Changelog.
 *
 * @package doginvoice
 */

/**
 * Change types: ACF value => label shown on the badge.
 *
 * @return array<string, string>
 */
function doginvoice_changelog_types() {
	return array(
		'nowosc'     => 'Nowość',
		'ulepszenie' => 'Ulepszenie',
		'poprawka'   => 'Poprawka',
	);
}

/**
 * Register the changelog post type.
 */
function doginvoice_register_changelog_post_type() {
	register_post_type(
		'changelog',
		array(
			'labels'              => array(
				'name'               => 'Changelog',
				'singular_name'      => 'Wpis changelogu',
				'menu_name'          => 'Changelog',
				'add_new'            => 'Dodaj wpis',
				'add_new_item'       => 'Dodaj wpis changelogu',
				'edit_item'          => 'Edytuj wpis changelogu',
				'new_item'           => 'Nowy wpis changelogu',
				'view_item'          => 'Zobacz wpis',
				'search_items'       => 'Szukaj wpisów',
				'not_found'          => 'Brak wpisów',
				'not_found_in_trash' => 'Brak wpisów w koszu',
				'all_items'          => 'Wszystkie wpisy',
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'has_archive'         => false,
			'rewrite'             => false,
			'menu_position'       => 21,
			'menu_icon'           => 'dashicons-megaphone',
			'supports'            => array( 'title', 'editor', 'revisions' ),
		)
	);
}
add_action( 'init', 'doginvoice_register_changelog_post_type' );

/**
 * Create the Changelog page once (as a draft), so it only needs publishing.
 */
function doginvoice_ensure_changelog_page() {
	if ( get_option( 'doginvoice_changelog_page_created' ) ) {
		return;
	}

	$existing = get_pages(
		array(
			'meta_key'    => '_wp_page_template',
			'meta_value'  => 'template-changelog.php',
			'number'      => 1,
			'post_status' => array( 'publish', 'draft', 'private', 'pending' ),
		)
	);

	if ( ! $existing ) {
		$by_slug = get_page_by_path( 'changelog' );

		if ( $by_slug && 'page' === $by_slug->post_type ) {
			update_post_meta( $by_slug->ID, '_wp_page_template', 'template-changelog.php' );
		} else {
			$inserted = wp_insert_post(
				array(
					'post_type'   => 'page',
					'post_title'  => 'Changelog',
					'post_name'   => 'changelog',
					'post_status' => 'draft',
				)
			);

			if ( is_wp_error( $inserted ) || ! $inserted ) {
				return;
			}

			update_post_meta( $inserted, '_wp_page_template', 'template-changelog.php' );
			update_post_meta( $inserted, 'page_badge', 'CHANGELOG' );
			update_post_meta( $inserted, '_page_badge', 'field_doginvoice_page_badge' );
			update_post_meta( $inserted, 'page_lead', 'Nowe funkcje, ulepszenia i poprawki w DogInvoice. Sprawdź, co zmieniło się w aplikacji.' );
			update_post_meta( $inserted, '_page_lead', 'field_doginvoice_page_lead' );
		}
	}

	update_option( 'doginvoice_changelog_page_created', 1 );
}
add_action( 'init', 'doginvoice_ensure_changelog_page', 20 );

/**
 * Admin list: show version and change type columns.
 *
 * @param array $columns Existing columns.
 * @return array
 */
function doginvoice_changelog_admin_columns( $columns ) {
	$date = $columns['date'] ?? null;
	unset( $columns['date'] );

	$columns['changelog_version'] = 'Wersja';
	$columns['changelog_type']    = 'Typ zmian';

	if ( $date ) {
		$columns['date'] = $date;
	}

	return $columns;
}
add_filter( 'manage_changelog_posts_columns', 'doginvoice_changelog_admin_columns' );

/**
 * Admin list: render the custom columns.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function doginvoice_changelog_admin_column_content( $column, $post_id ) {
	if ( ! function_exists( 'get_field' ) ) {
		return;
	}

	if ( 'changelog_version' === $column ) {
		echo esc_html( (string) get_field( 'changelog_version', $post_id ) );
	}

	if ( 'changelog_type' === $column ) {
		$labels = doginvoice_changelog_types();
		$types  = (array) get_field( 'changelog_type', $post_id );
		$names  = array();

		foreach ( $types as $type ) {
			if ( isset( $labels[ $type ] ) ) {
				$names[] = $labels[ $type ];
			}
		}

		echo esc_html( implode( ', ', $names ) );
	}
}
add_action( 'manage_changelog_posts_custom_column', 'doginvoice_changelog_admin_column_content', 10, 2 );
