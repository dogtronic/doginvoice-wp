<?php
/**
 * Default page template.
 *
 * The content editor is hidden for this template. Text pages use
 * template-text.php.
 *
 * @package doginvoice
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<main class="text-page" aria-labelledby="text-page-title">
		<?php doginvoice_breadcrumbs(); ?>
		<header class="text-page-header" data-aos="fade-up">
			<h1 id="text-page-title" class="text-page-title typography--h2" data-remove-orphans>
				<?php echo esc_html( get_the_title() ); ?>
			</h1>
		</header>
	</main>
	<?php
endwhile;

get_footer();
