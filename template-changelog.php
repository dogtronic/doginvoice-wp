<?php
/**
 * Template Name: Changelog
 *
 * Oś czasu zmian w aplikacji. Wpisy dodajesz w wp-admin > Changelog
 * (tytuł, treść, wersja, typ zmian). Nagłówek strony z pól ACF
 * „Nagłówek strony”. Style w src/scss/_changelog.scss.
 *
 * @package doginvoice
 */

get_header();

while ( have_posts() ) :
	the_post();

	$page_badge = get_field( 'page_badge' );
	$page_lead  = get_field( 'page_lead' );
	$page_title = doginvoice_page_heading();
	$paged      = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
	$type_names = doginvoice_changelog_types();

	$entries = new WP_Query(
		array(
			'post_type'      => 'changelog',
			'post_status'    => 'publish',
			'posts_per_page' => 15,
			'paged'          => $paged,
			'orderby'        => 'date',
			'order'          => 'DESC',
		)
	);
	?>
	<main class="changelog-page" aria-labelledby="changelog-page-title">
		<?php doginvoice_breadcrumbs(); ?>
		<header class="changelog-page-header" data-aos="fade-up">
			<?php if ( $page_badge ) : ?>
				<span class="changelog-page-badge badge badge--beige">
					<span class="badge-text"><?php echo esc_html( $page_badge ); ?></span>
				</span>
			<?php endif; ?>
			<h1 id="changelog-page-title" class="changelog-page-title typography--h2" data-remove-orphans>
				<?php echo esc_html( $page_title ); ?>
			</h1>
			<?php if ( $page_lead ) : ?>
				<p class="changelog-page-lead typography--body-lg" data-remove-orphans>
					<?php echo wp_kses_post( $page_lead ); ?>
				</p>
			<?php endif; ?>
		</header>

		<?php if ( $entries->have_posts() ) : ?>
			<ol class="changelog-list">
				<?php
				while ( $entries->have_posts() ) :
					$entries->the_post();

					$version = get_field( 'changelog_version' );
					$types   = array_filter( (array) get_field( 'changelog_type' ) );
					$anchor  = 'zmiana-' . get_post_field( 'post_name' );
					?>
					<li id="<?php echo esc_attr( $anchor ); ?>" class="changelog-entry" data-aos="fade-up">
						<div class="changelog-entry-meta">
							<time class="changelog-entry-date typography--body-md" datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
								<?php echo esc_html( get_the_date( 'j F Y' ) ); ?>
							</time>
							<?php if ( $version ) : ?>
								<span class="changelog-entry-version typography--body-sm"><?php echo esc_html( $version ); ?></span>
							<?php endif; ?>
						</div>

						<article class="changelog-entry-card">
							<?php if ( $types ) : ?>
								<ul class="changelog-entry-types" aria-label="Typ zmian">
									<?php foreach ( $types as $type ) : ?>
										<?php if ( isset( $type_names[ $type ] ) ) : ?>
											<li class="changelog-tag changelog-tag--<?php echo esc_attr( $type ); ?> typography--body-sm">
												<?php echo esc_html( $type_names[ $type ] ); ?>
											</li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>

							<h2 class="changelog-entry-title typography--h4">
								<a href="#<?php echo esc_attr( $anchor ); ?>"><?php the_title(); ?></a>
							</h2>

							<div class="changelog-entry-content">
								<?php the_content(); ?>
							</div>
						</article>
					</li>
				<?php endwhile; ?>
			</ol>

			<?php
			$pagination = paginate_links(
				array(
					'total'     => (int) $entries->max_num_pages,
					'current'   => $paged,
					'type'      => 'array',
					'mid_size'  => 1,
					'prev_text' => 'Nowsze',
					'next_text' => 'Starsze',
				)
			);

			if ( $pagination ) :
				?>
				<nav class="blog-pagination changelog-pagination" aria-label="Paginacja changelogu">
					<?php foreach ( $pagination as $link ) : ?>
						<?php echo $link; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php endforeach; ?>
				</nav>
			<?php endif; ?>
		<?php else : ?>
			<p class="changelog-empty typography--body-lg">Pierwsze wpisy pojawią się tu wkrótce.</p>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</main>
	<?php
endwhile;

get_footer();
