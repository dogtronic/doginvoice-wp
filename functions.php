<?php

/**
 * doginvoice functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package doginvoice
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (! defined('DOGINVOICE_CSS_VERSION')) {
	define('DOGINVOICE_CSS_VERSION', '1.0.27');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function doginvoice_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on doginvoice, use a find and replace
		* to change 'doginvoice' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('doginvoice', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'doginvoice'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'doginvoice_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'doginvoice_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function doginvoice_content_width()
{
	$GLOBALS['content_width'] = apply_filters('doginvoice_content_width', 640);
}
add_action('after_setup_theme', 'doginvoice_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function doginvoice_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'doginvoice'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'doginvoice'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'doginvoice_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function doginvoice_scripts()
{
	wp_enqueue_style('doginvoice-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('doginvoice-style', 'rtl', 'replace');

	$index_css = get_template_directory() . '/src/css/index.css';
	wp_enqueue_style(
		'doginvoice-index',
		get_template_directory_uri() . '/src/css/index.css',
		array(),
		file_exists($index_css) ? (string) filemtime($index_css) : DOGINVOICE_CSS_VERSION
	);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'doginvoice_scripts');

/**
 * Custom nav menu walker used by the front-page header navigation.
 */
require get_template_directory() . '/inc/class-nav-walker.php';

/**
 * ACF field group registrations for front-page.php sections.
 */
require get_template_directory() . '/inc/acf-fields.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}


add_action('after_setup_theme', function () {

	// Style bazowe bloków na frontendzie (tabele, kolumny, grupy, separatory).
	add_theme_support('wp-block-styles');

	// Wyrównania "szeroki" i "pełna szerokość" w edytorze —
	// przydatne dla tabel porównawczych w rankingu.
	add_theme_support('align-wide');

	// Responsywne osadzenia (YouTube itp. skalują się zamiast wystawać).
	add_theme_support('responsive-embeds');
});

/**
 * Opcjonalnie: własny arkusz stylów ładowany też w edytorze,
 * żeby podgląd w Gutenbergu wyglądał jak frontend.
 * Plik editor-style.css umieść w katalogu motywu potomnego.
 */
add_action('after_setup_theme', function () {
	add_theme_support('editor-styles');
	add_editor_style('editor-style.css');
});

/**
 * Gutenberg tylko dla wpisów. Strony i pozostałe typy treści
 * edytowane są klasycznym edytorem.
 */
add_filter('use_block_editor_for_post_type', function ($use_block_editor, $post_type) {
	if ('post' === $post_type) {
		return true;
	}

	// Wewnętrzne typy bloków (wzorce, szablony) zostają, żeby edytor wpisu działał.
	$internal = array('wp_block', 'wp_template', 'wp_template_part', 'wp_navigation');
	if (in_array($post_type, $internal, true)) {
		return $use_block_editor;
	}

	return false;
}, 10, 2);


add_filter('body_class', function ($classes) {
	if (is_page_template('page-ksef-template.php')) {
		$classes[] = 'single';
		$classes[] = 'single-post';
		$classes[] = 'ksef-cluster'; // własny hak na przyszłe style klastra
	}
	return $classes;
});


//============================================================
// DISABLE COMMENTS IN ADMIN PANEL.
// ============================================================
function disable_comments()
{
    // Usunięcie sekcji komentarzy w kokpicie
    remove_menu_page('edit-comments.php');

    // Usunięcie metaboxa komentarzy w edytorze wpisów
    remove_meta_box('commentsdiv', 'post', 'normal');
    remove_meta_box('commentstatusdiv', 'post', 'normal');

    // Usunięcie kolumny komentarzy z listy wpisów
    add_filter('manage_edit-post_columns', function ($columns) {
        unset($columns['comments']);
        return $columns;
    });

    // Usunięcie komentarzy z frontendu
    add_filter('comments_open', '__return_false', 20, 2);
    add_filter('pings_open', '__return_false', 20, 2);
    add_filter('comments_array', '__return_empty_array', 10, 2);
}
add_action('admin_menu', 'disable_comments');


//============================================================
// HIDE PAGE EDITOR META BOXES.
// ============================================================
function doginvoice_hide_page_editor_boxes()
{
	$boxes = array(
		'commentstatusdiv',
		'commentsdiv',
		'slugdiv',
		'authordiv',
		'revisionsdiv',
		'wpcode-metabox-snippets',
	);

	foreach ($boxes as $box) {
		foreach (array('normal', 'advanced', 'side') as $context) {
			remove_meta_box($box, 'page', $context);
		}
	}
}
add_action('add_meta_boxes', 'doginvoice_hide_page_editor_boxes', 100);


//============================================================
// DISABLE TAGS ON POSTS.
// ============================================================
function doginvoice_disable_post_tags()
{
	unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'doginvoice_disable_post_tags');

function doginvoice_remove_post_tags_ui()
{
	remove_meta_box('tagsdiv-post_tag', 'post', 'side');

	add_filter('manage_edit-post_columns', function ($columns) {
		unset($columns['tags']);
		return $columns;
	});
}
add_action('admin_menu', 'doginvoice_remove_post_tags_ui');


//============================================================
// REPLACE WORDPRESS ADMIN BAR LOGO WITH CUSTOM SVG
// ============================================================
function custom_admin_bar_logo()
{
    // Custom SVG code (decoded from your Base64 string)
    $logo_svg = '<svg width="186" height="31" viewBox="0 0 186 31" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M87.9201 15.09V21.03V29.93H82.3401V27.82C81.7101 28.26 80.7101 28.79 79.3901 29.27C78.2401 29.69 76.0401 29.93 74.1101 29.93C71.3001 29.93 68.8101 29.31 66.6701 28.07C64.5501 26.81 62.8801 25.05 61.6601 22.81C60.4701 20.57 59.8701 17.98 59.8701 15.05C59.8701 12.12 60.4901 9.42001 61.7301 7.18001C62.9701 4.94001 64.7101 3.20001 66.9501 1.96001C69.1901 0.720006 71.8001 0.100006 74.7901 0.100006C77.2001 0.100006 79.3201 0.520006 81.1601 1.35001C83.0001 2.16001 84.5001 3.33001 85.6701 4.86001C86.8601 6.39001 87.6101 8.21001 87.9201 10.33H81.5901C81.3301 8.78001 80.6001 7.59001 79.4101 6.75001C78.2201 5.89001 76.6801 5.46001 74.7901 5.46001C72.9001 5.46001 71.4401 5.85001 70.1001 6.64001C68.7901 7.40001 67.7601 8.51001 67.0201 9.97001C66.3001 11.43 65.9501 13.13 65.9501 15.09C65.9501 17.09 66.3201 18.83 67.0601 20.31C67.8001 21.77 68.8401 22.9 70.1701 23.71C71.5101 24.5 73.0801 24.89 74.8901 24.89C76.2301 24.89 77.4301 24.68 78.5001 24.25C79.5701 23.82 80.4201 23.22 81.0401 22.46C81.6601 21.7 81.9701 20.84 81.9701 19.88V19.51V19.47L75.5301 15.1H81.9701H87.9101" fill="#171717"/>
<path d="M51.1002 1.91C48.9102 0.689996 46.3102 0.0899963 43.3002 0.0899963C40.2902 0.0899963 37.7202 0.699996 35.5002 1.91C33.3102 3.13 31.5902 4.86 30.3502 7.1C29.1102 9.32 28.4902 11.95 28.4902 15.01C28.4902 18.07 29.1102 20.68 30.3502 22.92C31.5902 25.14 33.3102 26.87 35.5002 28.11C37.7202 29.33 40.3202 29.93 43.3002 29.93C46.2802 29.93 48.8702 29.32 51.0602 28.11C53.2802 26.89 55.0102 25.16 56.2502 22.92C57.4902 20.68 58.1102 18.04 58.1102 15.01C58.1102 11.98 57.4902 9.29 56.2502 7.07C55.0302 4.83 53.3202 3.11 51.1002 1.92V1.91ZM49.7402 22.02C48.2102 23.76 46.0702 24.63 43.3002 24.63C40.5302 24.63 38.3902 23.76 36.8602 22.02C35.3302 20.28 34.5702 17.94 34.5702 15.01C34.5702 12.08 35.3302 9.71 36.8602 8C38.3902 6.26 40.5302 5.39 43.3002 5.39C46.0702 5.39 48.2402 6.26 49.7402 8C51.2702 9.72 52.0302 12.06 52.0302 15.01C52.0302 17.96 51.2702 20.28 49.7402 22.02Z" fill="#171717"/>
<path d="M19.57 2.23001C17.28 1.06001 14.56 0.480011 11.41 0.480011H0V5.63001H11.41C14.42 5.63001 16.69 6.48001 18.24 8.17001C19.81 9.86001 20.6 12.13 20.6 14.97C20.6 17.81 19.81 20.05 18.24 21.77C16.69 23.46 14.41 24.31 11.41 24.31H6.04V9.98001L0 5.62001V29.45H11.41C14.53 29.45 17.24 28.87 19.53 27.7C21.82 26.51 23.59 24.83 24.83 22.66C26.09 20.49 26.73 17.93 26.73 14.97C26.73 12.01 26.11 9.41001 24.87 7.24001C23.63 5.07001 21.86 3.40001 19.57 2.23001Z" fill="#171717"/>
<path d="M185.32 0V25.53L180.93 29.92H93.9502V4.39L98.3302 0H185.31H185.32Z" fill="#4FD15F"/>
<path d="M175.321 21.47H165.931V8.42001H175.321V10.55H168.391V13.67H174.831V15.73H168.391V19.34H175.321V21.47Z" fill="#DEFAE1"/>
<path d="M159.271 21.7C157.951 21.7 156.791 21.43 155.791 20.88C154.801 20.32 154.031 19.54 153.491 18.53C152.951 17.52 152.681 16.33 152.681 14.97C152.681 13.61 152.951 12.42 153.491 11.41C154.041 10.4 154.811 9.62001 155.791 9.07001C156.791 8.51001 157.951 8.23001 159.271 8.23001C160.331 8.23001 161.271 8.41001 162.071 8.76001C162.891 9.11001 163.561 9.63001 164.081 10.31C164.611 10.98 164.941 11.78 165.101 12.71H162.571C162.421 11.98 162.061 11.41 161.471 11C160.901 10.59 160.171 10.39 159.261 10.39C157.971 10.39 156.961 10.8 156.221 11.61C155.481 12.42 155.111 13.53 155.111 14.96C155.111 16.39 155.481 17.51 156.221 18.33C156.961 19.14 157.981 19.54 159.261 19.54C160.161 19.54 160.901 19.34 161.471 18.94C162.051 18.53 162.421 17.96 162.571 17.22H165.101C164.951 18.15 164.611 18.96 164.081 19.64C163.551 20.31 162.881 20.82 162.071 21.17C161.261 21.52 160.331 21.7 159.271 21.7Z" fill="#DEFAE1"/>
<path d="M148.811 21.47V8.42001H151.261V21.47H148.811Z" fill="#DEFAE1"/>
<path d="M140.77 21.66C139.44 21.66 138.27 21.39 137.27 20.84C136.28 20.28 135.51 19.5 134.97 18.5C134.42 17.49 134.15 16.3 134.15 14.94C134.15 13.58 134.42 12.38 134.97 11.38C135.52 10.37 136.29 9.59 137.27 9.04C138.27 8.49 139.43 8.22 140.77 8.22C142.11 8.22 143.28 8.49 144.27 9.04C145.27 9.59 146.04 10.37 146.57 11.38C147.12 12.38 147.39 13.57 147.39 14.94C147.39 16.31 147.12 17.49 146.57 18.5C146.02 19.51 145.25 20.29 144.25 20.84C143.26 21.39 142.1 21.66 140.77 21.66ZM140.77 19.52C142.08 19.52 143.1 19.11 143.83 18.3C144.56 17.47 144.93 16.36 144.93 14.95C144.93 13.54 144.56 12.42 143.83 11.6C143.11 10.78 142.09 10.38 140.77 10.38C139.45 10.38 138.44 10.79 137.71 11.6C136.98 12.42 136.61 13.53 136.61 14.95C136.61 16.37 136.98 17.47 137.71 18.3C138.44 19.12 139.46 19.52 140.77 19.52Z" fill="#DEFAE1"/>
<path d="M126.71 21.47L121.44 8.42001H124.13L128.16 18.75H128.24L132.23 8.42001H134.86L129.59 21.47H126.71Z" fill="#DEFAE1"/>
<path d="M120.69 21.47H118.03L110.88 11.92H110.82V21.47H108.48V8.42001H111.07L118.29 18.12H118.35V8.42001H120.69V21.47Z" fill="#DEFAE1"/>
<path d="M103.94 21.47V8.42001H106.39V21.47H103.94Z" fill="#DEFAE1"/>
</svg>
';

	$favicon_svg = '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M32 28.2295L28.2285 32.001H0V3.77051L3.77051 0.000976562H0L32 0V28.2295Z" fill="#4FD15F"/>
<path d="M7.41992 22.4006V9.60059H12.4609C13.8515 9.60059 15.0525 9.85869 16.0639 10.3749C17.0752 10.8911 17.8548 11.6286 18.4026 12.5873C18.9505 13.5459 19.2244 14.6837 19.2244 16.0006C19.2244 17.3069 18.9452 18.4394 18.3868 19.3981C17.839 20.3568 17.0594 21.0995 16.0481 21.6263C15.0367 22.1425 13.841 22.4006 12.4609 22.4006H7.41992ZM10.0905 20.125H12.4609C13.7883 20.125 14.7944 19.751 15.4792 19.0031C16.1745 18.2445 16.5221 17.2437 16.5221 16.0006C16.5221 14.7469 16.1745 13.7461 15.4792 12.9981C14.7944 12.2501 13.7883 11.8761 12.4609 11.8761H10.0905H7.41992L10.0905 13.7943V20.125Z" fill="#FFFFFF"/>
<path d="M24.5792 11.8765H21.8906L24.5611 13.7944V22.4006H21.8906V9.60059H24.5792V11.8765Z" fill="#FFFFFF"/>
<path d="M24.5792 22.4006H24.5611C24.567 22.4006 24.5731 22.3999 24.5792 22.3998V22.4006Z" fill="#FFFFFF"/>
</svg>
';

    // Add CSS to replace the WordPress logo with custom SVG and resize category editor
    ?>
    <style type="text/css">
        #wpadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon:before {
            content: "";
            background-image: url('data:image/svg+xml;base64,<?php echo base64_encode($favicon_svg); ?>');
            background-position: center center;
            background-repeat: no-repeat;
            top: 1px;
            right: 1px;
            display: block;
            width: 24px;
            height: 22px;
            background-size: contain;
        }

        #login h1 a,
        .login h1 a {
            background-image: url('data:image/svg+xml;base64,<?php echo base64_encode($logo_svg); ?>') !important;
            width: 230px;
            height: 80px;
            background-size: contain;
			background-position: center center;
        }

        @media (min-width: 900px){
            #edittag {
                max-width: 80%;
            }
        }
    </style>
    <?php
}
add_action('wp_before_admin_bar_render', 'custom_admin_bar_logo');
add_action('login_enqueue_scripts', 'custom_admin_bar_logo');


//============================================================
// BLOG: TOC, reading time, listing page in admin.
// ============================================================

/**
 * Minutes of reading, with Polish plural forms.
 *
 * @param int|null $post_id Post ID. Defaults to the current post.
 * @return string
 */
function doginvoice_reading_time( $post_id = null ) {
	$post_id = $post_id ? (int) $post_id : get_the_ID();
	$text    = wp_strip_all_tags( (string) get_post_field( 'post_content', $post_id ) );
	$words   = preg_split( '/\s+/u', trim( $text ), -1, PREG_SPLIT_NO_EMPTY );
	$minutes = max( 1, (int) ceil( count( (array) $words ) / 200 ) );

	$mod10  = $minutes % 10;
	$mod100 = $minutes % 100;

	if ( 1 === $minutes ) {
		$unit = 'minuta';
	} elseif ( $mod10 >= 2 && $mod10 <= 4 && ( $mod100 < 12 || $mod100 > 14 ) ) {
		$unit = 'minuty';
	} else {
		$unit = 'minut';
	}

	return sprintf( '%d %s czytania', $minutes, $unit );
}

/**
 * First real category of a post, skipping empty default buckets.
 *
 * @param int|null $post_id Post ID.
 * @return WP_Term|null
 */
function doginvoice_primary_category( $post_id = null ) {
	$categories = get_the_category( $post_id ? (int) $post_id : get_the_ID() );

	if ( empty( $categories ) ) {
		return null;
	}

	foreach ( $categories as $category ) {
		if ( ! in_array( $category->slug, array( 'bez-kategorii', 'uncategorized' ), true ) ) {
			return $category;
		}
	}

	return $categories[0];
}

/**
 * Permalink of the Blog page (template-blog.php).
 *
 * @return string
 */
function doginvoice_blog_page_id() {
	$page_id = (int) get_option( 'doginvoice_blog_page_id' );

	if ( $page_id && 'publish' === get_post_status( $page_id ) ) {
		return $page_id;
	}

	$pages = get_pages(
		array(
			'meta_key'   => '_wp_page_template',
			'meta_value' => 'template-blog.php',
			'number'     => 1,
		)
	);

	return $pages ? (int) $pages[0]->ID : 0;
}

function doginvoice_blog_url() {
	$page_id = doginvoice_blog_page_id();

	return $page_id ? get_permalink( $page_id ) : home_url( '/blog/' );
}

/**
 * Heading shown on a page: the optional display title, or the page name.
 *
 * @param int|null $post_id Page ID. Defaults to the current page.
 * @return string
 */
function doginvoice_page_heading( $post_id = null ) {
	$post_id = $post_id ? (int) $post_id : get_the_ID();
	$display = function_exists( 'get_field' ) ? get_field( 'display_title', $post_id ) : '';

	if ( is_string( $display ) && '' !== trim( $display ) ) {
		return $display;
	}

	return get_the_title( $post_id );
}

/**
 * Breadcrumb trail for posts and pages.
 */
function doginvoice_breadcrumbs() {
	if ( ! is_singular( array( 'post', 'page' ) ) ) {
		return;
	}

	$crumbs = array(
		array(
			'label' => 'Strona główna',
			'url'   => home_url( '/' ),
		),
	);

	if ( is_singular( 'post' ) ) {
		$blog_id  = doginvoice_blog_page_id();
		$crumbs[] = array(
			'label' => $blog_id ? get_the_title( $blog_id ) : 'Blog',
			'url'   => doginvoice_blog_url(),
		);
	} else {
		foreach ( array_reverse( get_post_ancestors( get_the_ID() ) ) as $ancestor_id ) {
			$crumbs[] = array(
				'label' => get_the_title( $ancestor_id ),
				'url'   => get_permalink( $ancestor_id ),
			);
		}
	}

	$crumbs[] = array(
		'label' => get_the_title(),
	);

	echo '<nav class="breadcrumbs" aria-label="Okruszki"><ol>';

	$last = count( $crumbs ) - 1;
	foreach ( $crumbs as $index => $crumb ) {
		echo '<li>';
		if ( $index === $last || empty( $crumb['url'] ) ) {
			echo '<span aria-current="page">' . esc_html( $crumb['label'] ) . '</span>';
		} else {
			echo '<a class="breadcrumbs__link" href="' . esc_url( $crumb['url'] ) . '">' . esc_html( $crumb['label'] ) . '</a>';
			echo '<span class="breadcrumbs-sep" aria-hidden="true">/</span>';
		}
		echo '</li>';
	}

	echo '</ol></nav>';
}

/**
 * Add stable ids to h2/h3 and return a table of contents.
 *
 * @param string $html Rendered post HTML (after the_content).
 * @return array{html: string, toc: array<int, array{id: string, text: string, level: int}>}
 */
function doginvoice_content_with_toc( $html ) {
	$result = array(
		'html' => (string) $html,
		'toc'  => array(),
	);

	if ( '' === trim( $result['html'] ) ) {
		return $result;
	}

	$used = array();

	$result['html'] = preg_replace_callback(
		'/<h([23])(\s[^>]*)?>(.*?)<\/h\1>/is',
		function ( $matches ) use ( &$used, &$result ) {
			$level = (int) $matches[1];
			$attrs = isset( $matches[2] ) ? $matches[2] : '';
			$inner = $matches[3];
			$text  = trim( wp_strip_all_tags( $inner ) );

			if ( '' === $text ) {
				return $matches[0];
			}

			$id = '';
			if ( preg_match( '/\sid=(["\'])([^"\']+)\1/i', $attrs, $id_match ) ) {
				$id = $id_match[2];
			} else {
				$base = sanitize_title( $text );
				$base = $base ? $base : 'sekcja';
				$id   = $base;
				$i    = 2;

				while ( isset( $used[ $id ] ) ) {
					$id = $base . '-' . $i;
					++$i;
				}

				$attrs .= ' id="' . esc_attr( $id ) . '"';
			}

			$used[ $id ]     = true;
			$result['toc'][] = array(
				'id'    => $id,
				'text'  => $text,
				'level' => $level,
			);

			return '<h' . $level . $attrs . '>' . $inner . '</h' . $level . '>';
		},
		$result['html']
	);

	return $result;
}

/**
 * Nested list markup for the table of contents.
 *
 * @param array<int, array{id: string, text: string, level: int}> $toc Headings.
 * @return string
 */
function doginvoice_render_toc( $toc ) {
	if ( empty( $toc ) ) {
		return '';
	}

	$html     = '<ol class="blog-toc-list">';
	$open_sub = false;
	$count    = count( $toc );

	for ( $i = 0; $i < $count; $i++ ) {
		$item       = $toc[ $i ];
		$next       = $toc[ $i + 1 ] ?? null;
		$next_is_h3 = $next && 3 === (int) $next['level'];
		$link       = '<a href="#' . esc_attr( $item['id'] ) . '">' . esc_html( $item['text'] ) . '</a>';

		if ( 2 === (int) $item['level'] ) {
			if ( $open_sub ) {
				$html    .= '</ol></li>';
				$open_sub = false;
			}

			$html .= '<li class="blog-toc-item">' . $link;

			if ( $next_is_h3 ) {
				$html    .= '<ol class="blog-toc-sub">';
				$open_sub = true;
			} else {
				$html .= '</li>';
			}

			continue;
		}

		if ( ! $open_sub ) {
			$html    .= '<li class="blog-toc-item"><ol class="blog-toc-sub">';
			$open_sub = true;
		}

		$html .= '<li>' . $link . '</li>';

		if ( ! $next_is_h3 ) {
			$html    .= '</ol></li>';
			$open_sub = false;
		}
	}

	if ( $open_sub ) {
		$html .= '</ol></li>';
	}

	$html .= '</ol>';

	return $html;
}

/**
 * Create the Blog page in wp-admin the first time the theme runs.
 */
function doginvoice_ensure_blog_page() {
	$page_id = (int) get_option( 'doginvoice_blog_page_id' );
	$page    = $page_id ? get_post( $page_id ) : null;

	if ( $page && 'trash' !== $page->post_status ) {
		if ( 'template-blog.php' !== get_page_template_slug( $page_id ) ) {
			update_post_meta( $page_id, '_wp_page_template', 'template-blog.php' );
		}
		return;
	}

	$found = get_pages(
		array(
			'meta_key'    => '_wp_page_template',
			'meta_value'  => 'template-blog.php',
			'number'      => 1,
			'post_status' => array( 'publish', 'draft', 'private' ),
		)
	);

	if ( $found ) {
		update_option( 'doginvoice_blog_page_id', (int) $found[0]->ID );
		return;
	}

	$by_slug = get_page_by_path( 'blog' );

	if ( $by_slug && 'page' === $by_slug->post_type ) {
		update_post_meta( $by_slug->ID, '_wp_page_template', 'template-blog.php' );
		update_option( 'doginvoice_blog_page_id', (int) $by_slug->ID );
		return;
	}

	$inserted = wp_insert_post(
		array(
			'post_type'   => 'page',
			'post_title'  => 'Blog',
			'post_name'   => 'blog',
			'post_status' => 'publish',
		)
	);

	if ( is_wp_error( $inserted ) || ! $inserted ) {
		return;
	}

	update_post_meta( $inserted, '_wp_page_template', 'template-blog.php' );
	update_option( 'doginvoice_blog_page_id', (int) $inserted );

	if ( function_exists( 'update_field' ) ) {
		update_field( 'field_doginvoice_blog_page_badge', 'Wiedza', $inserted );
		update_field(
			'field_doginvoice_blog_page_lead',
			'Poradniki o fakturach, KSeF i automatyzacji, które da się wdrożyć od razu.',
			$inserted
		);
	}
}
add_action( 'init', 'doginvoice_ensure_blog_page' );

/**
 * Hide the content editor on the default page template and the blog listing.
 * Text pages use template-text.php, where the editor stays available.
 */
function doginvoice_hide_default_page_editor() {
	$screen = get_current_screen();

	if ( ! $screen || 'page' !== $screen->post_type ) {
		return;
	}

	$post_id = isset( $_GET['post'] ) ? (int) $_GET['post'] : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( 'add' === $screen->action || ! $post_id ) {
		remove_post_type_support( 'page', 'editor' );
		return;
	}

	$template = get_page_template_slug( $post_id );

	if ( '' === $template || 'default' === $template || 'template-blog.php' === $template ) {
		remove_post_type_support( 'page', 'editor' );
	}
}
add_action( 'current_screen', 'doginvoice_hide_default_page_editor' );

/**
 * Move existing default-template pages onto the text template once,
 * so regulamin-style pages keep their layout. The front page stays default.
 */
function doginvoice_assign_text_template() {
	if ( get_option( 'doginvoice_text_template_migrated' ) ) {
		return;
	}

	$front_id = (int) get_option( 'page_on_front' );
	$pages    = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => array( 'publish', 'draft', 'private', 'pending' ),
			'posts_per_page' => -1,
			'fields'         => 'ids',
		)
	);

	foreach ( $pages as $page_id ) {
		$page_id = (int) $page_id;

		if ( $page_id === $front_id ) {
			continue;
		}

		$template = get_page_template_slug( $page_id );

		if ( '' === $template || 'default' === $template ) {
			update_post_meta( $page_id, '_wp_page_template', 'template-text.php' );
		}
	}

	update_option( 'doginvoice_text_template_migrated', 1 );
}
add_action( 'init', 'doginvoice_assign_text_template' );