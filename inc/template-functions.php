<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package doginvoice
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function doginvoice_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Design-specific classes expected by index.css for the 404 and
	// generic text-page layouts (short content needs the footer pinned).
	if ( is_404() ) {
		$classes[] = 'page-404';
	} elseif ( is_page() && ! is_front_page() ) {
		$classes[] = 'page-text';
	}

	return $classes;
}
add_filter( 'body_class', 'doginvoice_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function doginvoice_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'doginvoice_pingback_header' );

/**
 * Allow SVG uploads (needed for the "Dlaczego DogInvoice?" icon fields).
 *
 * WordPress blocks SVG uploads by default since a malicious SVG can carry
 * embedded scripts. Restricting this to manage_options keeps that risk
 * limited to trusted admins instead of opening it to every uploader role.
 */
function doginvoice_allow_svg_upload( $mimes ) {
	if ( current_user_can( 'manage_options' ) ) {
		$mimes['svg'] = 'image/svg+xml';
	}
	return $mimes;
}
add_filter( 'upload_mimes', 'doginvoice_allow_svg_upload' );

/**
 * SVGs have no raster dimensions, so the media library grid/list views
 * render them as a tiny broken-looking icon without this.
 */
function doginvoice_fix_svg_media_preview() {
	?>
	<style>
		.media-icon img[src$=".svg"],
		.attachment-preview img[src$=".svg"],
		.thumbnail img[src$=".svg"] {
			width: 100% !important;
			height: auto !important;
		}
	</style>
	<?php
}
add_action( 'admin_head', 'doginvoice_fix_svg_media_preview' );
