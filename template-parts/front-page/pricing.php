<?php
/**
 * Front page section: Cennik
 *
 * @package doginvoice
 */
?>
    <?php
    $pricing_badge       = get_field( 'pricing_badge' );
    $pricing_title       = get_field( 'pricing_title' );
    $pricing_description = get_field( 'pricing_description' );
    ?>
    <!-- ===== CENNIK ===== -->
    <section id="price" class="pricing" aria-labelledby="pricing-title">
      <header class="pricing-header">
        <div
          class="pricing-header-badge badge badge--white"
          data-aos="fade-up">
          <span class="badge-text"><?php echo esc_html( $pricing_badge ); ?></span>
        </div>
        <h2
          id="pricing-title"
          class="pricing-header-title typography--h2"
          data-aos="fade-up">
          <?php echo esc_html( $pricing_title ); ?>
        </h2>
        <p
          class="pricing-header-description typography--body-lg"
          data-aos="fade-up">
          <?php echo esc_html( $pricing_description ); ?>
        </p>
      </header>

      <div class="pricing-switcher" data-aos="fade-up">
        <button
          type="button"
          class="pricing-switcher-option typography--body-md"
          data-period="monthly"
          aria-pressed="true">
          Miesięcznie
        </button>
        <button
          type="button"
          class="pricing-switcher-button"
          aria-pressed="false"
          aria-label="Przełącz okres rozliczeniowy">
          <span class="pricing-switcher-button-slider"></span>
        </button>
        <button
          type="button"
          class="pricing-switcher-option typography--body-md"
          data-period="yearly"
          aria-pressed="false">
          Rocznie
          <span class="pricing-switcher-option-badge typography--body-sm">
            -50%
          </span>
        </button>
      </div>

      <div class="pricing-main">
        <?php while ( have_rows( 'pricing_plans' ) ) : the_row(); ?>
          <?php
          $plan_title          = get_sub_field( 'title' );
          $plan_featured       = get_sub_field( 'is_featured' );
          $plan_price_monthly  = get_sub_field( 'price_monthly' );
          $plan_price_yearly   = get_sub_field( 'price_yearly' );
          $plan_price_text     = get_sub_field( 'price_text' );
          $plan_note           = get_sub_field( 'note' );
          $plan_show_more_link = get_sub_field( 'show_more_link' );
          $plan_cta_label      = get_sub_field( 'cta_label' );
          $plan_cta_url        = get_sub_field( 'cta_url' );
          $plan_has_price      = $plan_price_monthly !== '' && $plan_price_monthly !== null;
          ?>
          <article
            class="pricing-main-plan<?php echo $plan_featured ? ' pricing-main-plan--featured' : ''; ?>"
            data-aos="fade-up">
            <?php if ( $plan_featured ) : ?>
              <span class="pricing-main-plan-popular typography--body-sm">Popularny</span>
            <?php endif; ?>
            <div class="pricing-main-plan-header">
              <h3 class="pricing-main-plan-header-title typography--h4">
                <?php echo esc_html( $plan_title ); ?>
              </h3>
              <div class="pricing-main-plan-header-price">
                <?php if ( $plan_has_price ) : ?>
                  <span
                    class="pricing-main-plan-header-price-value ff-special typography--h3"
                    data-price-monthly="<?php echo esc_attr( $plan_price_monthly ); ?>"
                    data-price-yearly="<?php echo esc_attr( $plan_price_yearly ); ?>"><?php echo esc_html( $plan_price_monthly ); ?></span>
                  <span
                    class="pricing-main-plan-header-price-unit typography--body-md">
                    PLN/miesiąc (netto)
                  </span>
                <?php else : ?>
                  <span
                    class="pricing-main-plan-header-price-value ff-special typography--h3"><?php echo esc_html( $plan_price_text ); ?></span>
                <?php endif; ?>
              </div>
              <?php if ( $plan_note ) : ?>
                <span class="pricing-main-plan-header-note typography--body-md">
                  <?php echo esc_html( $plan_note ); ?>
                </span>
              <?php endif; ?>
            </div>

            <ul
              data-remove-orphans
              class="pricing-main-plan-features standard-list">
              <?php while ( have_rows( 'features' ) ) : the_row(); ?>
                <?php
                $feature_title       = get_sub_field( 'title' );
                $feature_description = get_sub_field( 'description' );
                ?>
                <li>
                  <?php echo esc_html( $feature_title ); ?>
                  <?php if ( $feature_description ) : ?>
                    <button
                      type="button"
                      class="pricing-info"
                      aria-label="Informacja: <?php echo esc_attr( $feature_title ); ?>"
                      data-tippy-content="<?php echo esc_attr( $feature_description ); ?>">
                      <img
                        src="<?php echo get_template_directory_uri(); ?>/src/assets/images/icon-information.svg"
                        alt=""
                        width="18"
                        height="18" />
                    </button>
                  <?php endif; ?>
                </li>
              <?php endwhile; ?>
            </ul>

            <?php if ( $plan_show_more_link ) : ?>
              <a
                href="#"
                class="pricing-main-plan-more typography--body-md no-hover-effect">
                <span class="pricing-main-plan-more-plus" aria-hidden="true">
                  <svg
                    width="12"
                    height="12"
                    viewBox="0 0 12 12"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M6 1.5V10.5M1.5 6H10.5"
                      stroke="currentColor"
                      stroke-width="1.5"
                      stroke-linecap="square" />
                  </svg>
                </span>
                Zobacz więcej
              </a>
            <?php endif; ?>

            <a
              href="<?php echo esc_url( $plan_cta_url ); ?>"
              class="pricing-main-plan-button btn"
              size="bg"
              color="<?php echo $plan_featured ? 'green' : 'border'; ?>">
              <?php if ( ! $plan_featured ) : ?><span class="background"></span><?php endif; ?>
              <span class="btn-title"><?php echo esc_html( $plan_cta_label ); ?></span>
              <span class="btn-icon" aria-hidden="true">
                <svg
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M19.0303 12L19.498 12.5863L20.233 12L19.498 11.4137L19.0303 12ZM7.74805 21H6.99805V22.5577L8.21575 21.5863L7.74805 21ZM7.74805 14.9639L7.21772 14.4335L6.99805 14.6532V14.9639H7.74805ZM10.3809 12.3311L10.9112 12.8614L12.1915 11.5811H10.3809V12.3311ZM7.74805 12.3311H6.99805V13.0811H7.74805V12.3311ZM7.74805 12.3301H8.49805V11.5801H7.74805V12.3301ZM5.16992 12.3301L4.63959 11.7997L3.35926 13.0801H5.16992V12.3301ZM7.74805 9.75195L8.27838 10.2823L8.49805 10.0626V9.75195H7.74805ZM7.74805 3L8.21575 2.4137L6.99805 1.44231V3H7.74805ZM19.0303 12L18.5626 11.4137L7.28034 20.4137L7.74805 21L8.21575 21.5863L19.498 12.5863L19.0303 12ZM7.74805 21H8.49805V14.9639H7.74805H6.99805V21H7.74805ZM7.74805 14.9639L8.27838 15.4942L10.9112 12.8614L10.3809 12.3311L9.85053 11.8007L7.21772 14.4335L7.74805 14.9639ZM10.3809 12.3311V11.5811H7.74805V12.3311V13.0811H10.3809V12.3311ZM7.74805 12.3311H8.49805V12.3301H7.74805H6.99805V12.3311H7.74805ZM7.74805 12.3301V11.5801H5.16992V12.3301V13.0801H7.74805V12.3301ZM5.16992 12.3301L5.70025 12.8604L8.27838 10.2823L7.74805 9.75195L7.21772 9.22162L4.63959 11.7997L5.16992 12.3301ZM7.74805 9.75195H8.49805V3H7.74805H6.99805V9.75195H7.74805ZM7.74805 3L7.28034 3.5863L18.5626 12.5863L19.0303 12L19.498 11.4137L8.21575 2.4137L7.74805 3Z"
                    fill="#171717" />
                </svg>
              </span>
            </a>
          </article>
        <?php endwhile; ?>
      </div>
    </section>

    <?php
    $schema_offers = array();
    while ( have_rows( 'pricing_plans' ) ) : the_row();
      $schema_price_monthly = get_sub_field( 'price_monthly' );
      if ( '' === $schema_price_monthly || null === $schema_price_monthly ) {
        continue;
      }
      $schema_offers[] = array(
        '@type'         => 'Offer',
        'name'          => get_sub_field( 'title' ),
        'price'         => (string) $schema_price_monthly,
        'priceCurrency' => 'PLN',
        'url'           => home_url( '/#price' ),
      );
    endwhile;

    if ( ! empty( $schema_offers ) ) :
      $software_schema = array(
        '@context'          => 'https://schema.org',
        '@type'             => 'SoftwareApplication',
        'name'              => get_bloginfo( 'name' ),
        'applicationCategory' => 'FinanceApplication',
        'operatingSystem'   => 'Web',
        'url'               => home_url( '/' ),
        'offers'            => $schema_offers,
      );
      ?>
      <script type="application/ld+json"><?php echo wp_json_encode( $software_schema, JSON_UNESCAPED_UNICODE ); ?></script>
      <?php
    endif;
    ?>
