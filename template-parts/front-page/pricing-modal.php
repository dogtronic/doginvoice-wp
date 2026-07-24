<?php
/**
 * Front page section: Modal ze szczegółami planu cennika
 *
 * @package doginvoice
 */
?>
    <!-- ===== CENNIK MODAL ===== -->
    <div class="pricing-modal" aria-hidden="true">
      <div
        class="pricing-modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-label="Szczegóły planu">
        <button
          class="pricing-modal-close"
          type="button"
          aria-label="Zamknij"></button>

        <div class="pricing-modal-swiper swiper">
          <div class="swiper-wrapper"></div>
        </div>

        <div class="pricing-modal-footer">
          <button
            type="button"
            class="pricing-modal-nav pricing-modal-nav--prev"
            aria-label="Poprzedni plan">
            <span class="pricing-modal-nav-arrow" aria-hidden="true">
              <img
                src="<?php echo get_template_directory_uri(); ?>/src/assets/images/alternative-arrow.svg"
                alt=""
                width="14"
                height="15" />
            </span>
            <span class="pricing-modal-nav-copy">
              <span class="pricing-modal-nav-label typography--body-sm">Poprzedni plan</span>
              <span
                class="pricing-modal-nav-name typography--body-lg"
                data-pricing-modal-prev-name></span>
            </span>
          </button>

          <a
            href="#"
            class="pricing-modal-cta btn"
            size="bg"
            color="green"
            data-pricing-modal-cta>
            <span class="btn-title">Wybierz plan</span>
          </a>

          <button
            type="button"
            class="pricing-modal-nav pricing-modal-nav--next"
            aria-label="Następny plan">
            <span class="pricing-modal-nav-copy">
              <span class="pricing-modal-nav-label typography--body-sm">Następny plan</span>
              <span
                class="pricing-modal-nav-name typography--body-lg"
                data-pricing-modal-next-name></span>
            </span>
            <span class="pricing-modal-nav-arrow" aria-hidden="true">
              <img
                src="<?php echo get_template_directory_uri(); ?>/src/assets/images/alternative-arrow.svg"
                alt=""
                width="14"
                height="15" />
            </span>
          </button>
        </div>
      </div>
    </div>
    <div class="pricing-modal-backdrop" data-close="true"></div>
