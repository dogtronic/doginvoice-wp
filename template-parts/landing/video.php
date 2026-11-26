<?php
/**
 * Landing: film (np. nagranie ekranu). Odtwarza się sam, bez dźwięku i w pętli,
 * gdy pojawi się na ekranie (src/js/index.js, atrybut data-play-in-view).
 *
 * @package doginvoice
 */

$lp_section = $args['section'];
$lp_id      = $args['id'];
$lp_file    = $lp_section['file'] ?? null;
$lp_poster  = $lp_section['poster'] ?? null;
$lp_title   = trim( (string) ( $lp_section['title'] ?? '' ) );

if ( empty( $lp_file['url'] ) ) {
	return;
}

$lp_poster_url = ! empty( $lp_poster['ID'] ) ? wp_get_attachment_image_url( $lp_poster['ID'], 'full' ) : '';
?>
    <!-- ===== LANDING: FILM ===== -->
    <section id="<?php echo esc_attr( $lp_id ); ?>" class="lp-section max-width"<?php echo $lp_title ? ' aria-labelledby="' . esc_attr( $lp_id ) . '-title"' : ''; ?>>
      <?php doginvoice_landing_head( $lp_section, $lp_id . '-title' ); ?>

      <div class="lp-video" data-aos="fade-up">
        <video
          data-play-in-view
          muted
          loop
          playsinline
          controls
          preload="<?php echo $lp_poster_url ? 'none' : 'metadata'; ?>"
          width="1920"
          height="1080"
          <?php if ( $lp_poster_url ) : ?>
            poster="<?php echo esc_url( $lp_poster_url ); ?>"
          <?php endif; ?>
          <?php if ( $lp_title ) : ?>
            aria-label="<?php echo esc_attr( $lp_title ); ?>"
          <?php endif; ?>>
          <source src="<?php echo esc_url( $lp_file['url'] ); ?>" type="video/mp4" />
        </video>
      </div>
    </section>
