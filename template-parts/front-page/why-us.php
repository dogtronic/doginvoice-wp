<?php
/**
 * Front page section: Dlaczego DogInvoice?
 *
 * Icons come from the "Ikona" image field per row (SVG uploads enabled in
 * inc/template-functions.php) — see inc/acf-fields.php,
 * doginvoice_acf_why_us_fields().
 *
 * @package doginvoice
 */

$why_us_badge       = get_field( 'why_us_badge' );
$why_us_title       = get_field( 'why_us_title' );
$why_us_items_count = count( (array) get_field( 'why_us_items' ) );
?>
    <!-- ===== DLACZEGO DOGINVOICE? ===== -->
    <section
      id="why-us"
      class="why-us max-width"
      aria-labelledby="why-us-head-title">
      <header class="why-us-head">
        <div class="why-us-head-badge badge badge--light" data-aos="fade-up">
          <span class="badge-text"><?php echo esc_html( $why_us_badge ); ?></span>
        </div>
        <h2
          id="why-us-head-title"
          class="why-us-head-title typography--h2"
          data-remove-orphans
          data-aos="fade-up">
          <?php echo esc_html( $why_us_title ); ?>
        </h2>
      </header>

      <ul class="why-us-grid">
        <?php while ( have_rows( 'why_us_items' ) ) : the_row(); ?>
          <?php
          $why_us_item_icon = get_sub_field( 'icon' );
          $why_us_item_index = get_row_index();
          $why_us_item_is_wide = ( $why_us_item_index === $why_us_items_count ) && ( $why_us_items_count % 3 === 1 );
          ?>
          <li
            class="why-us-grid-item<?php echo $why_us_item_is_wide ? ' why-us-grid-item--wide' : ''; ?>"
            data-aos="fade-up"
            data-aos-delay="<?php echo esc_attr( ( $why_us_item_index - 1 ) * 100 ); ?>">
            <?php if ( $why_us_item_icon ) : ?>
              <span class="why-us-grid-item-icon">
                <img
                  src="<?php echo esc_url( $why_us_item_icon['url'] ); ?>"
                  alt="<?php echo esc_attr( $why_us_item_icon['alt'] ); ?>"
                  width="48"
                  height="48" />
              </span>
            <?php endif; ?>
            <h3 class="why-us-grid-item-title typography--h4">
              <?php echo esc_html( get_sub_field( 'title' ) ); ?>
            </h3>
            <p class="why-us-grid-item-description typography--body-md">
              <?php echo wp_kses_post( get_sub_field( 'description' ) ); ?>
            </p>
          </li>
        <?php endwhile; ?>
      </ul>
    </section>
