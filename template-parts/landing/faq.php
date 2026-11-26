<?php
/**
 * Landing: pytania i odpowiedzi. Te same klasy i skrypt co FAQ na stronie
 * głównej (src/scss/_faq.scss, src/js/faq.js), bez podziału na kategorie.
 *
 * @package doginvoice
 */

$lp_section = $args['section'];
$lp_id      = $args['id'];
$lp_items   = array_values( array_filter( (array) ( $lp_section['items'] ?? array() ) ) );
$lp_badge   = trim( (string) ( $lp_section['badge'] ?? '' ) );
$lp_title   = trim( (string) ( $lp_section['title'] ?? '' ) );

if ( ! $lp_items ) {
	return;
}

$lp_schema = array();
?>
    <!-- ===== LANDING: FAQ ===== -->
    <section id="<?php echo esc_attr( $lp_id ); ?>" class="faq lp-faq" aria-labelledby="<?php echo esc_attr( $lp_id ); ?>-title">
      <header class="faq-header">
        <?php if ( $lp_badge ) : ?>
          <div class="faq-header-badge badge badge--white" data-aos="fade-up">
            <span class="badge-text"><?php echo esc_html( $lp_badge ); ?></span>
          </div>
        <?php endif; ?>
        <h2 id="<?php echo esc_attr( $lp_id ); ?>-title" class="faq-header-title typography--h2" data-remove-orphans data-aos="fade-up">
          <?php echo esc_html( $lp_title ? $lp_title : 'Najczęstsze pytania' ); ?>
        </h2>
      </header>

      <div class="faq-items lp-faq-items" data-aos="fade-up">
        <?php foreach ( $lp_items as $lp_index => $lp_item ) : ?>
          <?php
          $lp_paragraphs = doginvoice_landing_lines( $lp_item['answer'] ?? '' );
          $lp_schema[]   = array(
            '@type'          => 'Question',
            'name'           => (string) ( $lp_item['question'] ?? '' ),
            'acceptedAnswer' => array(
              '@type' => 'Answer',
              'text'  => implode( ' ', $lp_paragraphs ),
            ),
          );
          ?>
          <div class="faq-item<?php echo 0 === $lp_index ? ' is-open' : ''; ?>">
            <button type="button" class="faq-item-trigger" aria-expanded="<?php echo 0 === $lp_index ? 'true' : 'false'; ?>">
              <span class="faq-item-question"><?php echo esc_html( $lp_item['question'] ?? '' ); ?></span>
              <span class="faq-item-icon" aria-hidden="true"></span>
            </button>
            <div class="faq-item-answer">
              <?php foreach ( $lp_paragraphs as $lp_paragraph ) : ?>
                <p><?php echo esc_html( $lp_paragraph ); ?></p>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
    <script type="application/ld+json"><?php
      echo wp_json_encode(
        array(
          '@context'   => 'https://schema.org',
          '@type'      => 'FAQPage',
          'mainEntity' => $lp_schema,
        ),
        JSON_UNESCAPED_UNICODE
      );
    ?></script>
