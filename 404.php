<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * Content comes from the "Strona 404" ACF Options Page — a 404 response
 * has no underlying Post/Page object, so there's nowhere else to attach
 * per-post fields.
 *
 * @package doginvoice
 */

get_header();

$notfound_title        = get_field( 'notfound_title', 'option' );
$notfound_subtitle     = get_field( 'notfound_subtitle', 'option' );
$notfound_button_label = get_field( 'notfound_button_label', 'option' );
?>
    <main class="not-found max-width" aria-labelledby="not-found-title">
      <p
        class="not-found-code"
        aria-hidden="true"
        data-remove-orphans
        data-aos="fade-up">404</p>
      <h1
        id="not-found-title"
        class="not-found-title typography--h2"
        data-aos="fade-up">
        <?php echo esc_html( $notfound_title ); ?>
      </h1>
      <p
        class="not-found-subtitle typography--body-xl"
        data-remove-orphans
        data-aos="fade-up">
        <?php echo wp_kses_post( $notfound_subtitle ); ?>
      </p>
      <a
        href="<?php echo esc_url( home_url( '/' ) ); ?>"
        class="not-found-button btn"
        size="bg"
        color="green"
        data-aos="fade-up">
        <span class="btn-title"><?php echo esc_html( $notfound_button_label ); ?></span>
      </a>
    </main>

<?php get_footer(); ?>
