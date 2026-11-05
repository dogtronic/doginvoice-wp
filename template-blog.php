<?php
/**
 * Template Name: Blog
 *
 * Lista opublikowanych wpisów. Strona z tym szablonem jest tworzona
 * w panelu (Strony → Blog). Badge i lead edytujesz polami ACF.
 *
 * @package doginvoice
 */

get_header();

while ( have_posts() ) :
	the_post();

	$badge = get_field( 'blog_page_badge' );
	$lead  = get_field( 'blog_page_lead' );
	$title = doginvoice_page_heading();
	$paged = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
	$query = new WP_Query(
		array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'paged'          => $paged,
			'posts_per_page' => 12,
		)
	);
	?>
	<main class="blog-archive">
		<?php doginvoice_breadcrumbs(); ?>
		<header class="blog-archive-header" data-aos="fade-up">
			<?php if ( $badge ) : ?>
				<span class="blog-archive-badge badge badge--beige">
					<span class="badge-text"><?php echo esc_html( $badge ); ?></span>
				</span>
			<?php endif; ?>
			<h1 class="blog-archive-title typography--h2" data-remove-orphans><?php echo esc_html( $title ); ?></h1>
			<?php if ( $lead ) : ?>
				<p class="blog-archive-lead typography--body-lg" data-remove-orphans><?php echo esc_html( $lead ); ?></p>
			<?php endif; ?>
		</header>

		<?php if ( $query->have_posts() ) : ?>
			<div class="blog-grid">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					get_template_part( 'template-parts/blog-card', null, array( 'heading' => 'h2' ) );
				endwhile;
				?>
			</div>
			<?php
			$pagination = paginate_links(
				array(
					'total'      => (int) $query->max_num_pages,
					'current'    => $paged,
					'type'       => 'array',
					'mid_size'   => 1,
					'prev_next'  => false,
				)
			);
			$arrow      = '<span class="btn-icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.0303 12L19.498 12.5863L20.233 12L19.498 11.4137L19.0303 12ZM7.74805 21H6.99805V22.5577L8.21575 21.5863L7.74805 21ZM7.74805 14.9639L7.21772 14.4335L6.99805 14.6532V14.9639H7.74805ZM10.3809 12.3311L10.9112 12.8614L12.1915 11.5811H10.3809V12.3311ZM7.74805 12.3311H6.99805V13.0811H7.74805V12.3311ZM7.74805 12.3301H8.49805V11.5801H7.74805V12.3301ZM5.16992 12.3301L4.63959 11.7997L3.35926 13.0801H5.16992V12.3301ZM7.74805 9.75195L8.27838 10.2823L8.49805 10.0626V9.75195H7.74805ZM7.74805 3L8.21575 2.4137L6.99805 1.44231V3H7.74805ZM19.0303 12L18.5626 11.4137L7.28034 20.4137L7.74805 21L8.21575 21.5863L19.498 12.5863L19.0303 12ZM7.74805 21H8.49805V14.9639H7.74805H6.99805V21H7.74805ZM7.74805 14.9639L8.27838 15.4942L10.9112 12.8614L10.3809 12.3311L9.85053 11.8007L7.21772 14.4335L7.74805 14.9639ZM10.3809 12.3311V11.5811H7.74805V12.3311V13.0811H10.3809V12.3311ZM7.74805 12.3311H8.49805V12.3301H7.74805H6.99805V12.3311H7.74805ZM7.74805 12.3301V11.5801H5.16992V12.3301V13.0801H7.74805V12.3301ZM5.16992 12.3301L5.70025 12.8604L8.27838 10.2823L7.74805 9.75195L7.21772 9.22162L4.63959 11.7997L5.16992 12.3301ZM7.74805 9.75195H8.49805V3H7.74805H6.99805V9.75195H7.74805ZM7.74805 3L7.28034 3.5863L18.5626 12.5863L19.0303 12L19.498 11.4137L8.21575 2.4137L7.74805 3Z" fill="#171717"></path></svg></span>';
			if ( $pagination || $query->max_num_pages > 1 ) :
				?>
				<nav class="blog-pagination" aria-label="Paginacja wpisów">
					<?php if ( $paged > 1 ) : ?>
						<a class="btn blog-pagination-nav blog-pagination-nav--prev" size="sm" color="white" href="<?php echo esc_url( get_pagenum_link( $paged - 1 ) ); ?>">
							<?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<span class="btn-title">Poprzednia</span>
						</a>
					<?php endif; ?>
					<?php foreach ( (array) $pagination as $link ) : ?>
						<?php echo $link; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php endforeach; ?>
					<?php if ( $paged < (int) $query->max_num_pages ) : ?>
						<a class="btn blog-pagination-nav blog-pagination-nav--next" size="sm" color="white" href="<?php echo esc_url( get_pagenum_link( $paged + 1 ) ); ?>">
							<span class="btn-title">Następna</span>
							<?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</a>
					<?php endif; ?>
				</nav>
			<?php endif; ?>
		<?php else : ?>
			<p class="blog-empty typography--body-lg">Nie ma tu jeszcze żadnych wpisów.</p>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</main>
	<?php
endwhile;

get_footer();
