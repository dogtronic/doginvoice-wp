<?php
/**
 * The template for displaying all pages
 *
 * Generic long-form/text page layout (regulamin, polityka prywatności,
 * itp.). Title and body come from the normal WordPress editor; the
 * optional badge and lead paragraph above the content come from ACF
 * (see inc/acf-fields.php — doginvoice_acf_text_page_fields()).
 *
 * @package doginvoice
 */

get_header();

while ( have_posts() ) :
	the_post();

	$page_badge = get_field( 'page_badge' );
	$page_lead  = get_field( 'page_lead' );
	?>
    <main class="text-page" aria-labelledby="text-page-title">
      <header class="text-page-header" data-aos="fade-up">
        <?php if ( $page_badge ) : ?>
          <span class="text-page-badge badge badge--beige">
            <span class="badge-text"><?php echo esc_html( $page_badge ); ?></span>
          </span>
        <?php endif; ?>
        <h1 id="text-page-title" class="text-page-title typography--h2">
          <?php the_title(); ?>
        </h1>
        <?php if ( $page_lead ) : ?>
          <p class="text-page-lead typography--body-lg" data-remove-orphans>
            <?php echo wp_kses_post( $page_lead ); ?>
          </p>
        <?php endif; ?>
      </header>

      <div class="text-page-content" data-aos="fade-up">
        <?php the_content(); ?>
      </div>
    </main>
	<?php
endwhile;

get_footer();
