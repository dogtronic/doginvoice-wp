<?php
/**
 * Front page section: wybrane wpisy z bloga.
 *
 * Pola ACF: blog_badge, blog_title, blog_description, blog_posts.
 * Jeśli lista jest pusta, sekcja pokazuje 3 najnowsze opublikowane wpisy.
 *
 * @package doginvoice
 */

$blog_badge       = get_field( 'blog_badge' );
$blog_title       = get_field( 'blog_title' );
$blog_description = get_field( 'blog_description' );
$blog_posts       = get_field( 'blog_posts' );

if ( empty( $blog_posts ) ) {
	$blog_posts = get_posts(
		array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 3,
		)
	);
}

if ( empty( $blog_posts ) ) {
	return;
}

$blog_posts = array_slice( $blog_posts, 0, 3 );
?>
    <!-- ===== BLOG ===== -->
    <section id="blog" class="blog" aria-labelledby="blog-header-title">
      <header class="blog-header">
        <?php if ( $blog_badge ) : ?>
          <div class="blog-header-badge badge badge--light" data-aos="fade-up">
            <span class="badge-text"><?php echo esc_html( $blog_badge ); ?></span>
          </div>
        <?php endif; ?>
        <?php if ( $blog_title ) : ?>
          <h2
            id="blog-header-title"
            class="blog-header-title typography--h2"
            data-remove-orphans
            data-aos="fade-up">
            <?php echo esc_html( $blog_title ); ?>
          </h2>
        <?php endif; ?>
        <?php if ( $blog_description ) : ?>
          <p
            class="blog-header-description typography--body-lg"
            data-aos="fade-up"
            data-remove-orphans>
            <?php echo esc_html( $blog_description ); ?>
          </p>
        <?php endif; ?>
      </header>

      <div class="blog-grid" data-aos="fade-up">
        <?php
        foreach ( $blog_posts as $post ) :
          setup_postdata( $post );
          get_template_part( 'template-parts/blog-card', null, array( 'heading' => 'h3' ) );
        endforeach;
        wp_reset_postdata();
        ?>
      </div>

      <div class="blog-footer" data-aos="fade-up">
        <a class="btn" size="bg" color="green" href="<?php echo esc_url( doginvoice_blog_url() ); ?>">
          <span class="btn-title">Wszystkie wpisy</span>
        </a>
      </div>
    </section>
