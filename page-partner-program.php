<?php
/**
 * Template Name: Program partnerski
 *
 * Landing page programu partnerskiego DogInvoice. Treść sekcji jest na
 * razie wpisana wprost w template-parts/partner-program/*.php (bez ACF —
 * strona budowana jest sekcja po sekcji, do ustalenia później czy część
 * treści przejdzie na pola ACF).
 *
 * UWAGA: strony NIE publikować (nie linkować, nie ustawiać jako widoczna
 * w menu) dopóki regulamin programu partnerskiego nie zostanie
 * zaakceptowany przez kancelarię Creativa — patrz notatka w
 * html/Landing programu partnerskiego DI (gotowy 13.08).html.
 *
 * @package doginvoice
 */

get_header();
?>
  <main id="gora">
    <?php get_template_part( 'template-parts/partner-program/hero' ); ?>
    <?php get_template_part( 'template-parts/partner-program/how-it-works' ); ?>
    <?php get_template_part( 'template-parts/partner-program/video' ); ?>
    <?php get_template_part( 'template-parts/partner-program/product' ); ?>
    <?php get_template_part( 'template-parts/partner-program/audience' ); ?>
    <?php get_template_part( 'template-parts/partner-program/testimonials' ); ?>
    <?php get_template_part( 'template-parts/partner-program/form' ); ?>
  </main>
<?php
get_footer();
