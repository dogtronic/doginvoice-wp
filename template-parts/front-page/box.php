<?php
/**
 * Front page section: zapowiedź Doginvoice Box (zdjęcie + tekst)
 *
 * Układ .box-split jest wspólny z sekcją „Box + Doginvoice” na stronie Boxa
 * (template-parts/box/duo.php, src/scss/_box.scss).
 *
 * @package doginvoice
 */

$box_url = doginvoice_box_page_url();
$box_img = get_template_directory_uri() . '/src/assets/images/box';
?>
    <!-- ===== DOGINVOICE BOX ===== -->
    <section
      id="box"
      class="home-box max-width"
      aria-labelledby="home-box-title">
      <div class="box-split" data-aos="fade-up">
        <a
          class="box-split-photo no-hover-effect"
          href="<?php echo esc_url( $box_url ); ?>"
          tabindex="-1"
          aria-hidden="true">
          <img
            src="<?php echo esc_url( $box_img . '/01-hero-800.webp' ); ?>"
            srcset="<?php echo esc_url( $box_img . '/01-hero-800.webp' ); ?> 800w, <?php echo esc_url( $box_img . '/01-hero-1600.webp' ); ?> 1600w"
            sizes="(min-width: 768px) 45vw, 100vw"
            alt=""
            width="2400"
            height="1600"
            loading="lazy" />
        </a>
        <div class="box-split-text">
          <div class="badge badge--green">
            <span class="badge-text">Zamów w przedsprzedaży</span>
          </div>
          <h2
            id="home-box-title"
            class="box-split-text-title typography--h3"
            data-remove-orphans>
            Doginvoice Box. Twoje finanse na biurku, na żywo
          </h2>
          <p
            class="box-split-text-description typography--body-lg"
            data-remove-orphans>
            Mały ekran na biurko, połączony z Twoim kontem Doginvoice. Na bieżąco pokazuje, co dzieje się w firmie, bez otwierania laptopa.
          </p>
          <ul class="box-split-text-list standard-list">
            <li>Wpłaty od klientów</li>
            <li>Nowe faktury z KSeF</li>
            <li>Terminy płatności i wynik miesiąca</li>
          </ul>
          <div class="box-split-text-cta">
            <a href="<?php echo esc_url( $box_url ); ?>" class="btn" size="bg" color="green">
              <span class="btn-title">Dowiedz się więcej</span>
            </a>
          </div>
        </div>
      </div>
    </section>
