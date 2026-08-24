<?php
/**
 * Program partnerski: Zobacz, co polecasz (wideo)
 *
 * @package doginvoice
 */
?>
    <!-- ===== ZOBACZ, CO POLECASZ (WIDEO) ===== -->
    <section id="wideo" class="partner-video" aria-labelledby="partner-video-title">
      <div class="partner-video-inner max-width">
        <header class="partner-video-head">
          <div class="partner-video-head-badge badge badge--dark" data-aos="fade-up">
            <span class="badge-text">Zobacz, co polecasz</span>
          </div>
          <h2
            id="partner-video-title"
            class="partner-video-head-title typography--h2"
            data-aos="fade-up"
            data-remove-orphans>
            Moduł, który upomina się o pieniądze za Twojego klienta
          </h2>
          <p style class="partner-video-head-description typography--body-lg" data-aos="fade-up" data-remove-orphans>
           Analiza wyciągów bankowych, windykacja i przelewy w jednym miejscu. <br/>Zero przełączania między aplikacjami.
          </p>
        </header>

        <div class="partner-video-grid">
          <div class="partner-video-box">
            <video controls preload="metadata" playsinline width="1080" height="1080">
              <source src="<?php echo esc_url( get_template_directory_uri() . '/src/assets/videos/modul-windykacja-1x1.mp4' ); ?>" type="video/mp4" />
              Twoja przeglądarka nie odtworzy tego materiału.
            </video>
          </div>
          <div class="partner-video-copy" data-aos="fade-up" data-aos-delay="150">
            <h3 class="partner-video-copy-title typography--h4">Jedna faktura, od terminu płatności do przelewu</h3>
            <p class="partner-video-copy-lead typography--body-md">
                    Pełny obieg Twojej faktury w Doginvoice:
            </p>
            <ol class="partner-video-copy-list typography--body-md">
              <li><strong>Faktura trafia do systemu.</strong> <br/>Zdjęciem telefonem, mailem, z KSeF albo z programu, w którym klient wystawia dokumenty.</li>
              <li><strong>DogInvoice sprawdza przelewy w banku.</strong><br/> Widzi, kto zapłacił, więc nie zawraca głowy tym, którzy uregulowali.</li>
              <li><strong>Wysyła przypomnienie do dłużnika.</strong> <br/> Kulturalne, w imieniu Twojego klienta, po 3, 7, 14 i 30 dniach od terminu.</li>
              <li><strong>Twój klient przestaje być windykatorem we własnej firmie.</strong> <br/> Nie dzwoni, nie przypomina, nie odkłada tego na później.</li>
            </ol>
            <p class="partner-video-copy-outro typography--body-md">
              Ten jeden moduł sprzedaje się najlepiej, bo każdy przedsiębiorca ma dziś fakturę po terminie i wie, ile kosztuje jej pilnowanie.
            </p>
          </div>
        </div>
      </div>
    </section>
