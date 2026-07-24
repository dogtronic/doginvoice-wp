<?php
/**
 * Custom nav menu walker for the front-page header navigation.
 *
 * Outputs <li>/<a> markup using the design's own class names instead of
 * WordPress' default menu-item-* classes. Item/link classes are
 * configurable via the constructor so the same walker can drive the
 * desktop menu, the mobile menu, and the footer nav column in
 * front-page.php. Pass an empty string to omit the class attribute
 * entirely (used by the footer, whose <li> has no class).
 *
 * @package doginvoice
 */

class DogInvoice_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * @var string Class added to each <li>.
	 */
	private $item_class;

	/**
	 * @var string Class added to each <a>.
	 */
	private $link_class;

	public function __construct( $item_class = 'site-header-nav-menu-item', $link_class = 'site-header-nav-menu-item-link' ) {
		$this->item_class = $item_class;
		$this->link_class = $link_class;
	}

	/**
	 * Starts the list before the elements are added.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$submenu_class = $this->item_class ? ' class="' . esc_attr( $this->item_class ) . '-submenu"' : '';
		$output       .= '<ul' . $submenu_class . '>';
	}

	/**
	 * Ends the list after the elements are added.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul>';
	}

	/**
	 * Starts the element output.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		if ( $this->item_class ) {
			$classes[] = $this->item_class;
		}
		$classes    = array_filter( $classes );
		$li_class   = $classes ? ' class="' . esc_attr( implode( ' ', $classes ) ) . '"' : '';

		$output .= '<li' . $li_class . '>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		if ( $this->link_class ) {
			$attributes .= ' class="' . esc_attr( $this->link_class ) . '"';
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$item_output  = $args->before ?? '';
		$item_output .= '<a' . $attributes . '>';
		$item_output .= ( $args->link_before ?? '' ) . $title . ( $args->link_after ?? '' );
		$item_output .= '</a>';
		$item_output .= $args->after ?? '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}
