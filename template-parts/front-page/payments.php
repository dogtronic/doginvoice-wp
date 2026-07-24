<?php
/**
 * Front page section: Sekcje płatności (obraz + tekst)
 *
 * @package doginvoice
 */
?>
    <?php
    $payments_badge       = get_field( 'payments_badge' );
    $payments_title       = get_field( 'payments_title' );
    $payments_description = get_field( 'payments_description' );
    ?>
    <!-- ===== SEKCJE PŁATNOŚCI (obraz + tekst) ===== -->
    <section
      id="payments"
      class="payments max-width"
      aria-labelledby="payments-title">
      <header class="payments-header">
        <div
          class="payments-header-badge badge badge--light"
          data-aos="fade-up">
          <span class="badge-text"><?php echo esc_html( $payments_badge ); ?></span>
        </div>
        <h2
          id="payments-title"
          class="payments-header-title typography--h2"
          data-aos="fade-up">
          <?php echo esc_html( $payments_title ); ?>
        </h2>
        <p
          class="payments-header-description typography--body-lg"
          data-aos="fade-up"
          data-remove-orphans>
          <?php echo esc_html( $payments_description ); ?>
        </p>
      </header>

      <div class="payments-card-list">
        <?php while ( have_rows( 'payments_cards' ) ) : the_row(); ?>
          <?php
          $card_icon  = get_sub_field( 'icon' );
          $card_media = get_sub_field( 'media' );
          $list_items = array_filter( array_map( 'trim', explode( "\n", (string) get_sub_field( 'list_items' ) ) ) );
          ?>
          <div class="payments-card" data-aos="fade-up">
            <div class="payments-card-content">
              <div class="payments-card-content-top">
                <span class="payments-card-content-top-icon">
                  <img
                    src="<?php echo esc_url( $card_icon['url'] ); ?>"
                    alt="<?php echo esc_attr( $card_icon['alt'] ); ?>"
                    width="48"
                    height="48" />
                </span>
                <div class="payments-main-content-top-badge badge badge--green">
                  <span class="badge-text"><?php echo esc_html( get_sub_field( 'badge' ) ); ?></span>
                </div>
              </div>

              <h3
                class="payments-main-content-title typography--h3"
                data-remove-orphans>
                <?php echo esc_html( get_sub_field( 'title' ) ); ?>
              </h3>

              <p
                class="payments-main-content-description typography--body-md"
                data-remove-orphans>
                <?php echo esc_html( get_sub_field( 'description' ) ); ?>
              </p>

              <ul class="payments-main-content-list standard-list">
                <?php foreach ( $list_items as $list_item ) : ?>
                  <li class="payments-main-content-list-item">
                    <?php echo esc_html( $list_item ); ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>

            <div class="payments-card-media">
              <img
                src="<?php echo esc_url( $card_media['url'] ); ?>"
                alt="<?php echo esc_attr( $card_media['alt'] ); ?>"
                width="768"
                height="790" />
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </section>
