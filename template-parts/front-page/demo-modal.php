<?php
/**
 * Front page section: Modal wideo demo
 *
 * @package doginvoice
 */
?>
    <!-- ===== DEMO VIDEO MODAL ===== -->
    <div class="demo-modal" aria-hidden="true">
      <div
        class="demo-modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-label="Demo DogInvoice">
        <button
          class="demo-modal-close"
          type="button"
          aria-label="Zamknij"
          data-demo-modal-close></button>
        <div class="demo-modal-frame">
          <iframe
            class="demo-modal-iframe"
            data-demo-modal-iframe
            data-src="https://www.youtube-nocookie.com/embed/pqiEXPHGjHw?autoplay=1&rel=0&modestbranding=1"
            title="Demo DogInvoice"
            allow="
                accelerometer;
                autoplay;
                clipboard-write;
                encrypted-media;
                gyroscope;
                picture-in-picture;
                web-share;
              "
            allowfullscreen></iframe>
        </div>
      </div>
    </div>
    <div class="demo-modal-backdrop" data-demo-modal-close></div>
