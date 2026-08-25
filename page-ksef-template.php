<?php

/**
 * Template Name: KSeF Blog
 *
 * Szablon klastra artykułów o KSeF (rankingi, recenzje, poradniki).
 * Treść wpisywana w edytorze blokowym (Gutenberg), style w
 * src/scss/_ksef.scss, scope'owane pod body class .ksef-cluster.
 *
 * @package doginvoice
 */

get_header();
?>
<main id="gora">
  <?php
  while (have_posts()) :
    the_post();

    get_template_part('template-parts/content', get_post_type());

    the_post_navigation(
      array(
        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'doginvoice') . '</span> <span class="nav-title">%title</span>',
        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'doginvoice') . '</span> <span class="nav-title">%title</span>',
      )
    );

    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
      comments_template();
    endif;

  endwhile; // End of the loop.
  ?>
</main>
<?php
get_footer();
