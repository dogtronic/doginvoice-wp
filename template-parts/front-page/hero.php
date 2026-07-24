<?php
/**
 * Front page section: Hero
 *
 * @package doginvoice
 */
?>
    <!-- ===== HERO ===== -->
    <?php
    $hero_title         = get_field( 'hero_title' );
    $hero_subtitle      = get_field( 'hero_subtitle' );
    $hero_badge_time    = get_field( 'hero_badge_time' );
    $hero_badge_caption = get_field( 'hero_badge_caption' );
    $hero_cta_primary   = get_field( 'hero_cta_primary' );
    $hero_cta_demo      = get_field( 'hero_cta_demo' );
    $hero_media         = get_field( 'hero_media' );
    ?>
    <section class="hero max-width" aria-labelledby="hero-title">
      <div class="hero-content">
        <h1
          id="hero-title"
          class="hero-content-title typography--h1"
          data-aos="fade-up"
          data-aos-delay="300"
          data-aos-anchor=".hero">
          <?php echo esc_html( $hero_title ); ?>
        </h1>
        <p
          class="hero-content-subtitle typography--body-xl"
          data-remove-orphans
          data-aos="fade-up"
          data-aos-delay="200"
          data-aos-anchor=".hero">
          <?php echo wp_kses_post( $hero_subtitle ); ?>
        </p>
        <div class="hero-content-cta">
          <a
            href="<?php echo esc_url( $hero_cta_primary['url'] ); ?>"
            <?php echo ! empty( $hero_cta_primary['target'] ) ? ' target="' . esc_attr( $hero_cta_primary['target'] ) . '"' : ''; ?>
            class="hero-content-cta-button btn"
            size="bg"
            color="green">
            <span class="btn-title"><?php echo esc_html( $hero_cta_primary['title'] ); ?></span>
          </a>
          <a
            href="<?php echo esc_url( $hero_cta_demo['url'] ); ?>"
            class="hero-content-cta-button btn"
            size="bg"
            color="white"
            data-demo-modal-open>
            <span class="btn-title"><?php echo esc_html( $hero_cta_demo['title'] ); ?></span>
            <span class="btn-icon">
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
        </div>
      </div>
      <div class="hero-middle" data-aos="fade-zoom-in" data-aos-delay="400">
        <p class="hero-middle-text typography--h3 ff-special"><?php echo esc_html( $hero_badge_time ); ?></p>
        <span class="hero-middle-caption typography--body-md"><?php echo esc_html( $hero_badge_caption ); ?></span>
      </div>
      <div class="hero-media">
        <img
          class="hero-media-mobile"
          src="<?php echo esc_url( $hero_media['mobile']['url'] ); ?>"
          alt="<?php echo esc_attr( $hero_media['mobile']['alt'] ); ?>" />

        <div class="hero-media-desktop">
          <div class="hero-media-main">
            <img
              src="<?php echo esc_url( $hero_media['main']['url'] ); ?>"
              alt="<?php echo esc_attr( $hero_media['main']['alt'] ); ?>" />
          </div>

          <div class="hero-media-screen hero-media-screen--1">
            <img
              src="<?php echo esc_url( $hero_media['screen_1']['url'] ); ?>"
              alt="<?php echo esc_attr( $hero_media['screen_1']['alt'] ); ?>"
              aria-hidden="true"
              data-aos="fade-zoom-in"
              data-aos-delay="400"
              data-aos-anchor=".hero" />
          </div>

          <div class="hero-media-screen hero-media-screen--2">
            <img
              src="<?php echo esc_url( $hero_media['screen_2']['url'] ); ?>"
              alt="<?php echo esc_attr( $hero_media['screen_2']['alt'] ); ?>"
              aria-hidden="true"
              data-aos="fade-zoom-in"
              data-aos-delay="400"
              data-aos-anchor=".hero" />
          </div>

          <div class="hero-media-screen hero-media-screen--3">
            <img
              src="<?php echo esc_url( $hero_media['screen_3']['url'] ); ?>"
              alt="<?php echo esc_attr( $hero_media['screen_3']['alt'] ); ?>"
              aria-hidden="true"
              data-aos="fade-zoom-in"
              data-aos-delay="400"
              data-aos-anchor=".hero" />
          </div>

          <div class="hero-media-screen hero-media-screen--4">
            <img
              src="<?php echo esc_url( $hero_media['screen_4']['url'] ); ?>"
              alt="<?php echo esc_attr( $hero_media['screen_4']['alt'] ); ?>"
              aria-hidden="true"
              data-aos="fade-zoom-in"
              data-aos-delay="400"
              data-aos-anchor=".hero" />
          </div>

          <div class="hero-media-screen hero-media-screen--5">
            <img
              src="<?php echo esc_url( $hero_media['screen_5']['url'] ); ?>"
              alt="<?php echo esc_attr( $hero_media['screen_5']['alt'] ); ?>"
              aria-hidden="true"
              data-aos="fade-zoom-in"
              data-aos-delay="400"
              data-aos-anchor=".hero" />
          </div>
        </div>
      </div>
    </section>
