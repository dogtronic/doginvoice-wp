<?php
/**
 * Pojedynczy wpis ze spisem treści budowanym z nagłówków Gutenberga.
 *
 * @package doginvoice
 */

get_header();

while ( have_posts() ) :
	the_post();

	$document = doginvoice_content_with_toc( apply_filters( 'the_content', get_the_content() ) );
	$content  = $document['html'];
	$toc      = $document['toc'];
	$category = doginvoice_primary_category();
	$lead     = has_excerpt() ? get_the_excerpt() : '';
	$cover    = get_field( 'post_cover' );
	$cover_id = ( is_array( $cover ) && ! empty( $cover['ID'] ) ) ? (int) $cover['ID'] : 0;

	if ( ! $cover_id && has_post_thumbnail() ) {
		$cover_id = (int) get_post_thumbnail_id();
	}
	?>
	<main class="blog-post">
		<?php doginvoice_breadcrumbs(); ?>
		<header class="blog-post-header" data-aos="fade-up">
			<?php if ( $category ) : ?>
				<div class="blog-post-header-badge badge badge--beige">
					<span class="badge-text"><?php echo esc_html( $category->name ); ?></span>
				</div>
			<?php endif; ?>
			<h1 class="blog-post-title typography--h2" data-remove-orphans><?php the_title(); ?></h1>
			<?php if ( $lead ) : ?>
				<p class="blog-post-lead typography--body-lg" data-remove-orphans><?php echo esc_html( $lead ); ?></p>
			<?php endif; ?>
			<p class="blog-post-meta typography--body-sm">
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></time>
				<span aria-hidden="true">·</span>
				<span><?php echo esc_html( doginvoice_reading_time() ); ?></span>
			</p>
		</header>

		<?php if ( $cover_id ) : ?>
			<figure class="blog-post-cover" data-aos="fade-up">
				<?php
				echo wp_get_attachment_image(
					$cover_id,
					'large',
					false,
					array(
						'alt' => get_post_meta( $cover_id, '_wp_attachment_image_alt', true ) ?: get_the_title(),
					)
				);
				?>
			</figure>
		<?php endif; ?>

		<div class="blog-post-layout<?php echo $toc ? ' blog-post-layout--with-toc' : ''; ?>">
			<?php if ( $toc ) : ?>
				<nav class="blog-toc" aria-label="Spis treści" data-aos="fade-up">
					<details class="blog-toc-panel" open>
						<summary class="blog-toc-label">Spis treści</summary>
						<?php echo doginvoice_render_toc( $toc ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</details>
				</nav>
			<?php endif; ?>

			<div class="blog-post-content" data-aos="fade-up">
				<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</div>

	</main>
	<?php
endwhile;

get_footer();
