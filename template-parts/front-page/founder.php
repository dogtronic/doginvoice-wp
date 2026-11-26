<?php

/**
 * Front page section: „Nie jesteśmy anonimowi” (kto stoi za Doginvoice)
 *
 * Zdjęcie + tekst w układzie .box-split, wspólnym z zapowiedzią Boxa
 * (template-parts/front-page/box.php, src/scss/_box.scss). Zdjęcie ma 500 px,
 * dlatego kolumna ze zdjęciem jest tu węższa niż w Boxie (.home-founder).
 *
 * @package doginvoice
 */

$founder_img      = get_template_directory_uri() . '/src/assets/images/founder/marek-golan-500.webp';
$founder_linkedin = 'https://www.linkedin.com/in/marek-golan/';
$founder_company  = 'https://dogtronic.io/';
?>
<!-- ===== NIE JESTEŚMY ANONIMOWI ===== -->
<section
  id="founder"
  class="home-box home-founder max-width"
  aria-labelledby="home-founder-title">
  <div class="box-split" data-aos="fade-up">
    <div class="box-split-photo">
      <img
        src="<?php echo esc_url($founder_img); ?>"
        alt="Marek Golan, CEO Dogtronic, przy biurku"
        width="500"
        height="500"
        loading="lazy" />
    </div>
    <div class="box-split-text">
      <div class="badge badge--green">
        <span class="badge-text">Poznaj nas</span>
      </div>
      <h2
        id="home-founder-title"
        class="box-split-text-title typography--h3"
        data-remove-orphans>
        Nie jesteśmy anonimowi
      </h2>
      <p
        class="box-split-text-description typography--body-lg"
        data-remove-orphans>
        Doginvoice tworzy Dogtronic, polska firma technologiczna. Partner technologiczny wielu znanych marek.
      </p>
      <ul class="box-split-text-list standard-list">
        <li>20 lat w branży IT</li>
        <li>Wśród klientów m.in. Żabka, Carrefour, Plusssz, Perła.</li>

      </ul>
      <div class="box-split-text-cta">
        <a
          href="<?php echo esc_url($founder_linkedin); ?>"
          class="btn"
          size="bg"
          color="green"
          target="_blank"
          rel="noopener">
          <span class="btn-title">Marek (CEO) na LinkedIn</span>
        </a>
        <a
          href="<?php echo esc_url($founder_company); ?>"
          class="btn"
          size="bg"
          color="transparent"
          target="_blank"
          rel="noopener">
          <span class="btn-title">Poznaj Dogtronic</span>
        </a>
      </div>
    </div>
  </div>
</section>