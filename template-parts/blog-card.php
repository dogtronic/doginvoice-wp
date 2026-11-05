<?php
/**
 * Karta wpisu — lista bloga i sekcja na stronie głównej.
 *
 * @package doginvoice
 */

$heading  = ( isset( $args['heading'] ) && 'h2' === $args['heading'] ) ? 'h2' : 'h3';
$category = doginvoice_primary_category();
$excerpt  = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 26, '…' );
?>
<article class="blog-card">
	<a class="blog-card-link no-hover-effect" href="<?php the_permalink(); ?>">
		<div class="blog-card-media">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
			<?php else : ?>
				<span class="blog-card-media-fallback" aria-hidden="true"></span>
			<?php endif; ?>
		</div>
		<div class="blog-card-body">
			<?php if ( $category ) : ?>
				<p class="blog-card-category"><?php echo esc_html( $category->name ); ?></p>
			<?php endif; ?>
			<?php echo '<' . $heading . ' class="blog-card-title typography--h4">'; ?>
				<?php the_title(); ?>
			<?php echo '</' . $heading . '>'; ?>
			<?php if ( $excerpt ) : ?>
				<p class="blog-card-excerpt typography--body-md"><?php echo esc_html( $excerpt ); ?></p>
			<?php endif; ?>
			<p class="blog-card-meta typography--body-sm">
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></time>
				<span aria-hidden="true">·</span>
				<span><?php echo esc_html( doginvoice_reading_time() ); ?></span>
			</p>
		</div>
	</a>
</article>
