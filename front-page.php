<?php
/**
 * The template for displaying the front page
 *
 * front-page.php takes priority over home.php / index.php for the site
 * root, so this template renders the homepage's main content regardless
 * of the "Your homepage displays" setting in Settings > Reading. The
 * surrounding <head>/header and footer/scripts live in header.php and
 * footer.php so they can be shared with the other page templates.
 *
 * Each section below is its own file in template-parts/front-page/ so
 * sections can be edited independently; every part fetches its own ACF
 * fields via get_field().
 *
 * @package doginvoice
 */

get_header();
?>
  <main>
    <?php get_template_part( 'template-parts/front-page/hero' ); ?>
    <?php get_template_part( 'template-parts/front-page/trust' ); ?>
    <?php get_template_part( 'template-parts/front-page/offer' ); ?>
    <?php get_template_part( 'template-parts/front-page/features' ); ?>
    <?php get_template_part( 'template-parts/front-page/payments' ); ?>
    <?php get_template_part( 'template-parts/front-page/why-us' ); ?>
    <?php get_template_part( 'template-parts/front-page/pricing' ); ?>
    <?php get_template_part( 'template-parts/front-page/pricing-modal' ); ?>
    <?php get_template_part( 'template-parts/front-page/demo-modal' ); ?>
    <?php get_template_part( 'template-parts/front-page/integrations' ); ?>
    <?php get_template_part( 'template-parts/front-page/testimonials' ); ?>
    <?php get_template_part( 'template-parts/front-page/faq' ); ?>
  </main>

<?php get_footer(); ?>
