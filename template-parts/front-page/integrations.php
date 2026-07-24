<?php
/**
 * Front page section: Integracje
 *
 * @package doginvoice
 */
?>
    <?php
    $integrations_badge = get_field( 'integrations_badge' );
    $integrations_title = get_field( 'integrations_title' );
    ?>
    <!-- ===== INTEGRACJE ===== -->
    <section
      id="integrations"
      class="integrations"
      aria-labelledby="integrations-header-title">
      <header class="integrations-header">
        <div
          class="integrations-header-badge badge badge--dark"
          data-aos="fade-up">
          <span class="badge-text"><?php echo esc_html( $integrations_badge ); ?></span>
        </div>
        <h2
          id="integrations-header-title"
          class="integrations-header-title typography--h2"
          data-remove-orphans
          data-aos="fade-up">
          <?php echo esc_html( $integrations_title ); ?>
        </h2>
      </header>

      <div class="integrations-stage">
        <div class="integrations-background" aria-hidden="true">
          <svg
            width="1440"
            height="319"
            viewBox="0 0 1440 319"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid meet">
            <g opacity="0.5">
              <circle
                cx="720"
                cy="159.361"
                r="125"
                stroke="white"
                stroke-width="0.75" />
              <path
                d="M217.824 0.375L459.824 0.374989L518.899 59.4493L644.749 59.4493"
                stroke="url(#paint0_linear_506_16630)"
                stroke-width="0.75" />
              <path
                d="M624.492 55.1113L522.207 55.1113L503.829 36.7335L496.443 36.7335"
                stroke="white"
                stroke-width="0.75" />
              <path
                d="M0 148.891L560.791 148.891L569.866 157.965L595.717 157.965"
                stroke="white"
                stroke-width="0.75" />
              <path
                d="M410.051 170.078L560.794 170.078L569.868 161.004L595.719 161.004"
                stroke="white"
                stroke-width="0.75" />
              <path
                d="M1440 148.891L879.926 148.891L870.851 157.965L845.001 157.965"
                stroke="white"
                stroke-width="0.75" />
              <path
                d="M1083.39 170.078L879.926 170.078L870.852 161.004L845.001 161.004"
                stroke="white"
                stroke-width="0.75" />
              <path
                d="M1221.96 0.375L979.957 0.374989L950.42 29.9122L920.883 59.4493L795.032 59.4493"
                stroke="url(#paint1_linear_506_16630)"
                stroke-width="0.75" />
              <path
                d="M815.289 55.1113L917.575 55.1113L935.953 36.7335L943.338 36.7335"
                stroke="url(#paint2_linear_506_16630)"
                stroke-width="0.75" />
              <path
                d="M1221.96 318.445L979.957 318.445L920.883 259.371L795.032 259.371"
                stroke="url(#paint3_linear_506_16630)"
                stroke-width="0.75" />
              <path
                d="M815.289 263.709L917.575 263.709L935.953 282.087L943.338 282.087"
                stroke="white"
                stroke-width="0.75" />
              <path
                d="M217.824 318.445L459.824 318.445L518.899 259.371L644.749 259.371"
                stroke="url(#paint4_linear_506_16630)"
                stroke-width="0.75" />
              <path
                d="M624.492 263.709L522.207 263.709L503.829 282.087L496.443 282.087"
                stroke="white"
                stroke-width="0.75" />
            </g>
            <defs>
              <linearGradient
                id="paint0_linear_506_16630"
                x1="460.714"
                y1="0.375"
                x2="216.041"
                y2="0.375"
                gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
              <linearGradient
                id="paint1_linear_506_16630"
                x1="979.646"
                y1="0.375"
                x2="1221.96"
                y2="0.375"
                gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
              <linearGradient
                id="paint2_linear_506_16630"
                x1="879.314"
                y1="55.1113"
                x2="879.314"
                y2="36.7334"
                gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" />
              </linearGradient>
              <linearGradient
                id="paint3_linear_506_16630"
                x1="984.768"
                y1="308.541"
                x2="1221.96"
                y2="308.541"
                gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
              <linearGradient
                id="paint4_linear_506_16630"
                x1="461.401"
                y1="299.263"
                x2="217.824"
                y2="299.263"
                gradientUnits="userSpaceOnUse">
                <stop stop-color="white" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
        </div>

        <div class="integrations-swiper swiper">
          <div class="swiper-wrapper">
            <?php while ( have_rows( 'integrations_items' ) ) : the_row(); ?>
              <?php $integration_logo = get_sub_field( 'logo' ); ?>
              <div class="integrations-swiper-item swiper-slide">
                <span class="integrations-swiper-item-icon">
                  <img
                    src="<?php echo esc_url( $integration_logo['url'] ); ?>"
                    alt="<?php echo esc_attr( get_sub_field( 'name' ) ); ?>" />
                </span>
                <span class="integrations-swiper-item-title typography--body-sm"><?php echo esc_html( get_sub_field( 'name' ) ); ?></span>
              </div>
            <?php endwhile; ?>
          </div>
        </div>

        <div class="integrations-circle">
          <img
            src="<?php echo get_template_directory_uri(); ?>/src/assets/images/logo-light.svg"
            alt="DogInvoice"
            width="140"
            height="24" />

          <svg
            width="352"
            height="352"
            viewBox="0 0 352 352"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <!-- <foreignObject x="50" y="50" width="250" height="250">
                <div
                  xmlns="http://www.w3.org/1999/xhtml"
                  style="
                    backdrop-filter: blur(10.05px);
                    -webkit-backdrop-filter: blur(10.05px);
                    border-radius: 50%;
                    overflow: hidden;
                    height: 100%;
                    width: 100%;
                  "
                ></div>
              </foreignObject> -->
            <!-- Ellipse_287: ciemna tarcza w tle (blur szkła) -->
            <g transform="translate(51, 51)">
              <!-- <foreignObject x="-20.1" y="-20.1" width="290.2" height="290.2"
                  ><div
                    xmlns="http://www.w3.org/1999/xhtml"
                    style="
                      backdrop-filter: blur(10.05px);
                      clip-path: url(#bgblur_0_506_16663_clip_path);
                      height: 100%;
                      width: 100%;
                    "
                  ></div
                ></foreignObject> -->
              <g
                filter="url(#filter0_i_506_16663)"
                data-figma-bg-blur-radius="20.1">
                <circle
                  cx="125"
                  cy="125"
                  r="125"
                  fill="#0A140B"
                  fill-opacity="0.8" />
              </g>
              <defs>
                <filter
                  id="filter0_i_506_16663"
                  x="-20.1"
                  y="-20.1"
                  width="290.2"
                  height="290.2"
                  filterUnits="userSpaceOnUse"
                  color-interpolation-filters="sRGB">
                  <feFlood flood-opacity="0" result="BackgroundImageFix" />
                  <feBlend
                    mode="normal"
                    in="SourceGraphic"
                    in2="BackgroundImageFix"
                    result="shape" />
                  <feColorMatrix
                    in="SourceAlpha"
                    type="matrix"
                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                    result="hardAlpha" />
                  <feOffset dy="2" />
                  <feGaussianBlur stdDeviation="3.25" />
                  <feComposite
                    in2="hardAlpha"
                    operator="arithmetic"
                    k2="-1"
                    k3="1" />
                  <feColorMatrix
                    type="matrix"
                    values="0 0 0 0 0.305882 0 0 0 0 0.811765 0 0 0 0 0.368627 0 0 0 0.5 0" />
                  <feBlend
                    mode="normal"
                    in2="shape"
                    result="effect1_innerShadow_506_16663" />
                </filter>
                <clipPath
                  id="bgblur_0_506_16663_clip_path"
                  transform="translate(20.1 20.1)">
                  <circle cx="125" cy="125" r="125" />
                </clipPath>
              </defs>
            </g>

            <!-- Ellipse_284: najszersza, najbardziej rozmyta poświata (blur 25) -->
            <g transform="translate(0.25, 14.5)">
              <g opacity="0.5" filter="url(#filter0_f_506_16661)">
                <circle
                  cx="175.75"
                  cy="161.5"
                  r="125"
                  stroke="url(#paint0_radial_506_16661)"
                  stroke-width="1.5" />
              </g>
              <defs>
                <filter
                  id="filter0_f_506_16661"
                  x="0"
                  y="-14.2495"
                  width="351.5"
                  height="351.5"
                  filterUnits="userSpaceOnUse"
                  color-interpolation-filters="sRGB">
                  <feFlood flood-opacity="0" result="BackgroundImageFix" />
                  <feBlend
                    mode="normal"
                    in="SourceGraphic"
                    in2="BackgroundImageFix"
                    result="shape" />
                  <feGaussianBlur
                    stdDeviation="25"
                    result="effect1_foregroundBlur_506_16661" />
                </filter>
                <radialGradient
                  id="paint0_radial_506_16661"
                  cx="0"
                  cy="0"
                  r="1"
                  gradientUnits="userSpaceOnUse"
                  gradientTransform="translate(175.75 36.5005) rotate(90) scale(119.806)">
                  <stop stop-color="#4FD15F" />
                  <stop offset="0.528846" stop-color="#C0F2C5" />
                  <stop offset="1" stop-color="#C0F2C5" stop-opacity="0" />
                </radialGradient>
              </defs>
            </g>

            <!-- Ellipse_283: poświata blur 12.5 -->
            <g transform="translate(25.25, 25.25)">
              <g opacity="0.5" filter="url(#filter0_f_506_16660)">
                <circle
                  cx="150.75"
                  cy="150.75"
                  r="125"
                  stroke="url(#paint0_radial_506_16660)"
                  stroke-width="1.5" />
              </g>
              <defs>
                <filter
                  id="filter0_f_506_16660"
                  x="0"
                  y="0"
                  width="301.5"
                  height="301.5"
                  filterUnits="userSpaceOnUse"
                  color-interpolation-filters="sRGB">
                  <feFlood flood-opacity="0" result="BackgroundImageFix" />
                  <feBlend
                    mode="normal"
                    in="SourceGraphic"
                    in2="BackgroundImageFix"
                    result="shape" />
                  <feGaussianBlur
                    stdDeviation="12.5"
                    result="effect1_foregroundBlur_506_16660" />
                </filter>
                <radialGradient
                  id="paint0_radial_506_16660"
                  cx="0"
                  cy="0"
                  r="1"
                  gradientUnits="userSpaceOnUse"
                  gradientTransform="translate(150.75 25.75) rotate(90) scale(119.806)">
                  <stop stop-color="#4FD15F" />
                  <stop offset="0.528846" stop-color="#C0F2C5" />
                  <stop offset="1" stop-color="#C0F2C5" stop-opacity="0" />
                </radialGradient>
              </defs>
            </g>

            <!-- Ellipse_285: poświata blur 7.5 -->
            <g transform="translate(35.25, 35.25)">
              <g opacity="0.5" filter="url(#filter0_f_506_16659)">
                <circle
                  cx="140.75"
                  cy="140.75"
                  r="125"
                  stroke="url(#paint0_radial_506_16659)"
                  stroke-width="1.5" />
              </g>
              <defs>
                <filter
                  id="filter0_f_506_16659"
                  x="0"
                  y="0"
                  width="281.5"
                  height="281.5"
                  filterUnits="userSpaceOnUse"
                  color-interpolation-filters="sRGB">
                  <feFlood flood-opacity="0" result="BackgroundImageFix" />
                  <feBlend
                    mode="normal"
                    in="SourceGraphic"
                    in2="BackgroundImageFix"
                    result="shape" />
                  <feGaussianBlur
                    stdDeviation="7.5"
                    result="effect1_foregroundBlur_506_16659" />
                </filter>
                <radialGradient
                  id="paint0_radial_506_16659"
                  cx="0"
                  cy="0"
                  r="1"
                  gradientUnits="userSpaceOnUse"
                  gradientTransform="translate(140.75 15.75) rotate(90) scale(119.806)">
                  <stop stop-color="#4FD15F" />
                  <stop offset="0.528846" stop-color="#C0F2C5" />
                  <stop offset="1" stop-color="#C0F2C5" stop-opacity="0" />
                </radialGradient>
              </defs>
            </g>

            <!-- Ellipse_282: poświata blur 2.5 -->
            <g transform="translate(45.25, 45.25)">
              <g opacity="0.5" filter="url(#filter0_f_506_16658)">
                <circle
                  cx="130.75"
                  cy="130.75"
                  r="125"
                  stroke="url(#paint0_radial_506_16658)"
                  stroke-width="1.5" />
              </g>
              <defs>
                <filter
                  id="filter0_f_506_16658"
                  x="0"
                  y="0"
                  width="261.5"
                  height="261.5"
                  filterUnits="userSpaceOnUse"
                  color-interpolation-filters="sRGB">
                  <feFlood flood-opacity="0" result="BackgroundImageFix" />
                  <feBlend
                    mode="normal"
                    in="SourceGraphic"
                    in2="BackgroundImageFix"
                    result="shape" />
                  <feGaussianBlur
                    stdDeviation="2.5"
                    result="effect1_foregroundBlur_506_16658" />
                </filter>
                <radialGradient
                  id="paint0_radial_506_16658"
                  cx="0"
                  cy="0"
                  r="1"
                  gradientUnits="userSpaceOnUse"
                  gradientTransform="translate(130.75 5.75) rotate(90) scale(119.806)">
                  <stop stop-color="#4FD15F" />
                  <stop offset="0.528846" stop-color="#C0F2C5" />
                  <stop offset="1" stop-color="#C0F2C5" stop-opacity="0" />
                </radialGradient>
              </defs>
            </g>

            <!-- Ellipse_286: delikatny blur 1.35 -->
            <g transform="translate(48.3, 48.3)">
              <g filter="url(#filter0_f_506_16662)">
                <circle
                  cx="127.7"
                  cy="127.7"
                  r="124"
                  stroke="url(#paint0_radial_506_16662)"
                  stroke-width="2" />
              </g>
              <defs>
                <filter
                  id="filter0_f_506_16662"
                  x="0.000195265"
                  y="0.000195265"
                  width="255.4"
                  height="255.4"
                  filterUnits="userSpaceOnUse"
                  color-interpolation-filters="sRGB">
                  <feFlood flood-opacity="0" result="BackgroundImageFix" />
                  <feBlend
                    mode="normal"
                    in="SourceGraphic"
                    in2="BackgroundImageFix"
                    result="shape" />
                  <feGaussianBlur
                    stdDeviation="1.35"
                    result="effect1_foregroundBlur_506_16662" />
                </filter>
                <radialGradient
                  id="paint0_radial_506_16662"
                  cx="0"
                  cy="0"
                  r="1"
                  gradientUnits="userSpaceOnUse"
                  gradientTransform="translate(127.7 2.7002) rotate(90) scale(119.806)">
                  <stop stop-color="#4FD15F" />
                  <stop offset="0.528846" stop-color="#C0F2C5" />
                  <stop offset="1" stop-color="#C0F2C5" stop-opacity="0" />
                </radialGradient>
              </defs>
            </g>

            <!-- Ellipse_281: najostrzejszy pierścień na wierzchu (bez blur) -->
            <g transform="translate(50.625, 50.625)">
              <circle
                cx="125.375"
                cy="125.375"
                r="125"
                stroke="url(#paint0_radial_506_16657)"
                stroke-width="0.75" />
              <defs>
                <radialGradient
                  id="paint0_radial_506_16657"
                  cx="0"
                  cy="0"
                  r="1"
                  gradientUnits="userSpaceOnUse"
                  gradientTransform="translate(125.375 0.375) rotate(90) scale(119.806)">
                  <stop stop-color="#4FD15F" />
                  <stop offset="0.528846" stop-color="#C0F2C5" />
                  <stop offset="1" stop-color="#C0F2C5" stop-opacity="0" />
                </radialGradient>
              </defs>
            </g>
          </svg>
        </div>
      </div>
    </section>
