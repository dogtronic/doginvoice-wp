<?php
/**
 * Front page section: Oferta (grid)
 *
 * @package doginvoice
 */
?>
    <?php
    $offer_badge       = get_field( 'offer_badge' );
    $offer_title       = get_field( 'offer_title' );
    $offer_description = get_field( 'offer_description' );
    $offer_items       = get_field( 'offer_items' );
    ?>
    <!-- ===== OFERTA (GRID) ===== -->
    <section id="offer" class="offer max-width" aria-labelledby="offer-head-title">
      <header class="offer-head">
        <div class="offer-head-badge badge badge--light" data-aos="fade-up">
          <span class="badge-text"><?php echo esc_html( $offer_badge ); ?></span>
        </div>
        <h2
          id="offer-head-title"
          class="offer-head-title typography--h2"
          data-aos="fade-up">
          <?php echo esc_html( $offer_title ); ?>
        </h2>
        <p
          class="offer-head-description typography--body-lg"
          data-aos="fade-up"
          data-remove-orphans>
          <?php echo esc_html( $offer_description ); ?>
        </p>
      </header>

      <ul class="offer-grid">
        <li class="offer-grid-item" data-aos="fade-up" data-aos-delay="100">
          <div
            class="offer-grid-item-lottie"
            data-lottie="<?php echo get_template_directory_uri(); ?>/src/assets/images/grid/illustration.json"></div>
          <h3 class="offer-grid-item-title typography--h4">
            <?php echo esc_html( $offer_items['item_1_title'] ); ?>
          </h3>
          <p class="offer-grid-item-description typography--body-md">
            <?php echo esc_html( $offer_items['item_1_description'] ); ?>
          </p>
        </li>

        <li class="offer-grid-item" data-aos="fade-up" data-aos-delay="100">
          <div
            class="offer-grid-item-lottie"
            data-lottie="<?php echo get_template_directory_uri(); ?>/src/assets/images/grid/illustration-1.json"></div>
          <h3 class="offer-grid-item-title typography--h4">
            <?php echo esc_html( $offer_items['item_2_title'] ); ?>
          </h3>
          <p class="offer-grid-item-description typography--body-md">
            <?php echo esc_html( $offer_items['item_2_description'] ); ?>
          </p>
        </li>

        <li class="offer-grid-item" data-aos="fade-up" data-aos-delay="100">
          <div
            class="offer-grid-item-lottie"
            data-lottie="<?php echo get_template_directory_uri(); ?>/src/assets/images/grid/illustration-2.json"></div>
          <h3 class="offer-grid-item-title typography--h4">
            <?php echo esc_html( $offer_items['item_3_title'] ); ?>
          </h3>
          <p class="offer-grid-item-description typography--body-md">
            <?php echo esc_html( $offer_items['item_3_description'] ); ?>
          </p>
        </li>

        <li class="offer-grid-item" data-aos="fade-up" data-aos-delay="100">
          <div
            class="offer-grid-item-lottie"
            data-lottie="<?php echo get_template_directory_uri(); ?>/src/assets/images/grid/illustration-3.json"></div>
          <h3 class="offer-grid-item-title typography--h4">
            <?php echo esc_html( $offer_items['item_4_title'] ); ?>
          </h3>
          <p class="offer-grid-item-description typography--body-md">
            <?php echo esc_html( $offer_items['item_4_description'] ); ?>
          </p>
        </li>
      </ul>
    </section>
