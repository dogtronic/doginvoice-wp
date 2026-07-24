<?php
/**
 * Front page section: FAQ
 *
 * @package doginvoice
 */
?>
    <?php
    $faq_badge = get_field( 'faq_badge' );
    $faq_title = get_field( 'faq_title' );
    ?>
    <!-- ===== FAQ ===== -->
    <section id="faq" class="faq" aria-labelledby="faq-header-title">
      <header class="faq-header">
        <div class="faq-header-badge badge badge--white" data-aos="fade-up">
          <span class="badge-text"><?php echo esc_html( $faq_badge ); ?></span>
        </div>
        <h2
          id="faq-header-title"
          class="faq-header-title typography--h2"
          data-remove-orphans
          data-aos="fade-up">
          <?php echo esc_html( $faq_title ); ?>
        </h2>
      </header>

      <nav class="faq-nav" aria-label="Kategorie FAQ" data-aos="fade-up">
        <ul class="faq-nav-list">
          <?php while ( have_rows( 'faq_categories' ) ) : the_row(); ?>
            <?php $category_slug = 'faq-' . sanitize_title( get_sub_field( 'title' ) ); ?>
            <li>
              <button
                type="button"
                class="faq-nav-button<?php echo 1 === get_row_index() ? ' active' : ''; ?>"
                data-faq-target="<?php echo esc_attr( $category_slug ); ?>">
                <?php echo esc_html( get_sub_field( 'title' ) ); ?>
              </button>
            </li>
          <?php endwhile; ?>
        </ul>
      </nav>

      <div class="faq-content">
        <?php while ( have_rows( 'faq_categories' ) ) : the_row(); ?>
          <?php
          $category_title = get_sub_field( 'title' );
          $category_slug  = 'faq-' . sanitize_title( $category_title );
          $is_first_category = 1 === get_row_index();
          ?>
          <div class="faq-category" id="<?php echo esc_attr( $category_slug ); ?>" data-aos="fade-up">
            <h3 class="faq-category-title typography--h4"><?php echo esc_html( $category_title ); ?></h3>
            <div class="faq-category-panel" id="<?php echo esc_attr( $category_slug ); ?>-panel">
              <div class="faq-items">
                <?php while ( have_rows( 'items' ) ) : the_row(); ?>
                  <?php
                  $is_open = $is_first_category && 1 === get_row_index();
                  $answer_paragraphs = array_filter( array_map( 'trim', explode( "\n", (string) get_sub_field( 'answer' ) ) ) );
                  ?>
                  <div class="faq-item<?php echo $is_open ? ' is-open' : ''; ?>">
                    <button
                      type="button"
                      class="faq-item-trigger"
                      aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>">
                      <span class="faq-item-question"><?php echo esc_html( get_sub_field( 'question' ) ); ?></span>
                      <span class="faq-item-icon" aria-hidden="true"></span>
                    </button>
                    <div class="faq-item-answer">
                      <?php foreach ( $answer_paragraphs as $paragraph ) : ?>
                        <p><?php echo esc_html( $paragraph ); ?></p>
                      <?php endforeach; ?>
                    </div>
                  </div>
                <?php endwhile; ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </section>

    <?php
    $faq_schema_questions = array();
    while ( have_rows( 'faq_categories' ) ) : the_row();
      while ( have_rows( 'items' ) ) : the_row();
        $schema_answer_paragraphs = array_filter( array_map( 'trim', explode( "\n", (string) get_sub_field( 'answer' ) ) ) );
        $faq_schema_questions[]   = array(
          '@type'          => 'Question',
          'name'           => get_sub_field( 'question' ),
          'acceptedAnswer' => array(
            '@type' => 'Answer',
            'text'  => implode( ' ', $schema_answer_paragraphs ),
          ),
        );
      endwhile;
    endwhile;

    if ( ! empty( $faq_schema_questions ) ) :
      $faq_schema = array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $faq_schema_questions,
      );
      ?>
      <script type="application/ld+json"><?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_UNICODE ); ?></script>
      <?php
    endif;
    ?>
