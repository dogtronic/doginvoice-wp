<?php

/**
 * The footer for this theme
 *
 * Contains the site footer (CTA + nav columns), all front-page
 * scripts, wp_footer(), and the closing </body></html>.
 * Shared by every template via get_footer().
 *
 * @package doginvoice
 */
?>
<footer class="footer">
  <div class="footer__background"></div>
  <?php if (is_front_page()) : ?>
    <div class="footer-section max-width" aria-labelledby="cta-title">
      <div class="footer-section-badge badge badge--dark" data-aos="fade-up">
        <span class="badge-text">ZACZNIJ JUŻ DZIŚ</span>
      </div>
      <h2
        id="cta-title"
        class="footer-section-title typography--h2"
        data-aos="fade-up">
        W 60 sekund DogInvoice będzie gotowy do pracy
      </h2>
      <p
        class="footer-section-description typography--body-lg"
        data-aos="fade-up"
        data-remove-orphans>
        Załóż konto, podłącz KSeF, automatyzuj zarządzanie finansami swojej
        firmy.
      </p>
      <a
        href="https://app.doginvoice.com/register"
        target="_blank"
        class="footer-section-button btn"
        data-aos="fade-up"
        size="bg"
        color="green">
        <span class="btn-title">Załóż konto bez zobowiązań</span>
      </a>
      <span class="footer-section-watermark" aria-hidden="true">
        <svg
          width="1321"
          height="215"
          viewBox="0 0 1321 215"
          fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M308.66 39.4541C328.613 39.4542 344.012 45.6819 354.799 58.1777L355.308 58.7578C365.915 71.017 371.198 87.5657 371.198 108.361C371.198 129.318 365.745 146.059 354.801 158.543C343.846 171.039 328.447 177.268 308.66 177.269C288.873 177.268 273.475 171.039 262.52 158.543C251.575 146.059 246.121 129.318 246.121 108.361C246.121 87.2359 251.575 70.4931 262.521 58.1777C273.477 45.6834 288.874 39.4542 308.66 39.4541ZM308.66 40.2041C289.043 40.2042 273.869 46.3726 263.084 58.6738L263.082 58.6758C252.289 70.8181 246.871 87.3654 246.871 108.361C246.871 129.186 252.289 145.735 263.084 158.049C273.869 170.35 289.043 176.518 308.66 176.519C328.277 176.518 343.451 170.35 354.236 158.049C365.032 145.735 370.448 129.186 370.448 108.361C370.448 87.3653 365.032 70.8181 354.238 58.6758L354.234 58.6719C343.62 46.3734 328.448 40.2042 308.66 40.2041Z"
            fill="url(#paint0_linear_384_19306)" />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M308.66 1.74805C330.11 1.74809 348.686 6.08937 364.377 14.7861L365.854 15.5967C381.002 24.0848 392.792 36.0963 401.217 51.624C410.085 67.4854 414.51 86.4025 414.51 108.361C414.51 129.984 410.083 148.816 401.215 164.847C392.349 180.873 379.984 193.239 364.126 201.936L364.125 201.935C348.434 210.632 329.942 214.975 308.66 214.975C287.378 214.975 268.799 210.633 252.939 201.936L252.936 201.933C237.25 193.067 224.972 180.703 216.106 164.848L216.105 164.847C207.238 148.816 202.811 129.984 202.811 108.361C202.811 86.5701 207.238 67.7367 216.106 51.875C224.972 35.8501 237.25 23.4848 252.938 14.7881L252.939 14.7871C268.799 6.08977 287.378 1.7481 308.66 1.74805ZM308.66 2.49805C287.481 2.4981 269.032 6.81863 253.301 15.4453L253.3 15.4443C237.738 24.0715 225.56 36.3347 216.762 52.2393L216.761 52.2402C207.966 67.9696 203.561 86.6724 203.561 108.361C203.561 129.879 207.965 148.582 216.761 164.482L217.596 165.947C226.323 180.98 238.223 192.755 253.3 201.277C269.031 209.904 287.481 214.225 308.66 214.225C329.839 214.225 348.203 209.904 363.764 201.278L363.765 201.277C379.497 192.65 391.761 180.387 400.559 164.483C409.355 148.583 413.76 129.88 413.76 108.361C413.76 86.5019 409.354 67.7144 400.56 51.9854L400.557 51.9814C391.929 36.0795 379.752 23.9034 364.021 15.4463L364.018 15.4443C348.458 6.8189 330.009 2.49809 308.66 2.49805Z"
            fill="url(#paint1_linear_384_19306)" />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1134 58.7441C1141.63 58.7442 1148.35 60.0155 1154.15 62.5693L1154.7 62.8115C1160.33 65.3553 1164.99 68.9919 1168.67 73.7188L1169.02 74.1719C1172.62 78.8882 1174.94 84.5092 1175.99 91.0234L1175.62 91.458H1157.57L1157.2 91.1582C1156.15 86.0345 1153.59 82.0568 1149.53 79.2021L1149.53 79.2002C1145.55 76.3449 1140.38 74.9014 1134 74.9014C1124.89 74.9014 1117.75 77.7829 1112.54 83.5166L1112.54 83.5186C1107.33 89.1793 1104.71 97.0504 1104.71 107.181C1104.71 117.309 1107.33 125.219 1112.54 130.957C1117.75 136.615 1124.88 139.459 1134 139.459C1140.38 139.459 1145.55 138.053 1149.53 135.272C1153.59 132.419 1156.14 128.404 1157.2 123.203L1157.57 122.902H1175.62L1175.99 123.337C1174.91 130.061 1172.47 135.871 1168.67 140.755L1168.67 140.757C1164.87 145.56 1160.03 149.238 1154.15 151.791C1148.35 154.345 1141.63 155.616 1134 155.616C1124.52 155.616 1116.17 153.651 1108.98 149.707L1108.98 149.704C1101.86 145.683 1096.33 140.036 1092.39 132.77L1092.39 132.767C1088.52 125.498 1086.6 116.965 1086.6 107.181C1086.6 97.3963 1088.52 88.8637 1092.39 81.5947L1092.39 81.5918C1096.21 74.5523 1101.52 69.0675 1108.32 65.1455L1108.98 64.7705C1116.17 60.7494 1124.52 58.7441 1134 58.7441ZM1134 59.4941C1124.62 59.4941 1116.41 61.4758 1109.34 65.4258L1109.34 65.4268C1102.35 69.3007 1096.93 74.806 1093.05 81.9492L1093.05 81.9482C1089.25 89.0894 1087.35 97.4964 1087.35 107.181C1087.35 116.865 1089.25 125.271 1093.05 132.412C1096.92 139.554 1102.35 145.098 1109.34 149.049C1116.41 152.923 1124.62 154.866 1134 154.866C1141.54 154.866 1148.16 153.609 1153.85 151.104L1153.85 151.104C1159.63 148.597 1164.37 144.993 1168.08 140.292C1171.71 135.623 1174.08 130.079 1175.18 123.652H1157.87C1156.74 128.884 1154.11 132.971 1149.96 135.887L1149.96 135.888C1145.82 138.779 1140.49 140.209 1134 140.209C1124.71 140.209 1117.36 137.305 1111.99 131.465L1111.99 131.463C1106.62 125.55 1103.96 117.44 1103.96 107.181C1103.96 96.9214 1106.62 88.8479 1111.99 83.0107C1117.36 77.0947 1124.71 74.1514 1134 74.1514C1140.49 74.1514 1145.82 75.6202 1149.96 78.5889L1150.36 78.8711C1154.27 81.7625 1156.78 85.7153 1157.87 90.708H1175.18C1174.08 84.2821 1171.71 78.7768 1168.08 74.1836L1168.08 74.1816C1164.36 69.4043 1159.62 65.7623 1153.85 63.2568L1153.85 63.2559C1148.16 60.7514 1141.54 59.4942 1134 59.4941Z"
            fill="url(#paint2_linear_384_19306)" />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1001.91 74.0361C1011.41 74.0362 1018.81 76.9778 1024.03 82.8994L1024.52 83.46C1029.48 89.3184 1031.95 97.2012 1031.95 107.065C1031.95 117.172 1029.32 125.242 1024.03 131.229L1024.03 131.231C1018.73 137.152 1011.34 140.095 1001.91 140.095C992.47 140.095 985.078 137.152 979.78 131.231L979.778 131.229C974.49 125.242 971.865 117.172 971.865 107.065C971.865 96.8829 974.49 88.812 979.78 82.8994C985.078 76.9792 992.47 74.0361 1001.91 74.0361ZM1001.91 74.7861C992.638 74.7861 985.466 77.6693 980.339 83.3994C975.204 89.138 972.615 97.0117 972.615 107.065C972.615 117.04 975.203 124.915 980.339 130.731L980.826 131.26C985.917 136.638 992.927 139.345 1001.91 139.345C1011.17 139.345 1018.34 136.462 1023.47 130.731C1028.61 124.915 1031.2 117.04 1031.2 107.065C1031.2 97.0119 1028.61 89.138 1023.47 83.3994L1023.47 83.3975C1018.42 77.6701 1011.25 74.7862 1001.91 74.7861Z"
            fill="url(#paint3_linear_384_19306)" />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1001.91 58.7441C1011.54 58.7442 1019.92 60.7098 1027.04 64.6543C1034.23 68.598 1039.76 74.2075 1043.63 81.4746C1047.57 88.6688 1049.54 97.204 1049.54 107.065C1049.54 116.851 1047.57 125.385 1043.63 132.654C1039.68 139.922 1034.11 145.532 1026.92 149.477L1026.92 149.476C1019.8 153.42 1011.46 155.387 1001.91 155.387C992.348 155.387 983.967 153.421 976.774 149.477L976.771 149.474C969.658 145.453 964.126 139.846 960.184 132.656L960.183 132.654C956.239 125.385 954.273 116.851 954.273 107.065C954.273 97.2039 956.238 88.6689 960.184 81.4746C964.126 74.2085 969.658 68.5995 976.773 64.6553L976.774 64.6543C983.967 60.7102 992.348 58.7441 1001.91 58.7441ZM1001.91 59.4941C992.453 59.4941 984.2 61.4385 977.136 65.3125L977.135 65.3115C970.147 69.1854 964.718 74.6911 960.843 81.834L960.842 81.8359C956.969 88.899 955.023 97.3041 955.023 107.065C955.023 116.749 956.968 125.154 960.842 132.295L961.209 132.953C965.057 139.704 970.364 144.991 977.135 148.818C984.199 152.692 992.453 154.637 1001.91 154.637C1011.36 154.637 1019.57 152.693 1026.56 148.819L1026.56 148.818C1033.63 144.944 1039.09 139.439 1042.97 132.297C1046.84 125.156 1048.79 116.749 1048.79 107.065C1048.79 97.3042 1046.84 88.8989 1042.97 81.8359L1042.97 81.8311C1039.17 74.6902 1033.74 69.1865 1026.67 65.3125L1026.67 65.3115C1019.69 61.4385 1011.43 59.4942 1001.91 59.4941Z"
            fill="url(#paint4_linear_384_19306)" />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M756.916 60.4961V153.629L756.541 154.004H739.063L738.688 153.629V60.4961L739.063 60.1211H756.541L756.916 60.4961ZM739.438 153.254H756.166V60.8711H739.438V153.254Z"
            fill="url(#paint5_linear_384_19306)" />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M790.241 60.2725L841.536 129.2V60.4961L841.911 60.1211H858.584L858.959 60.4961V153.629L858.584 154.004H839.612L839.312 153.854L788.476 85.957V153.629L788.101 154.004H771.429L771.054 153.629V60.4961L771.429 60.1211H789.94L790.241 60.2725ZM771.804 153.254H787.726V85.4463L788.101 85.0713H788.561L788.86 85.2217L839.8 153.254H858.209V60.8711H842.286V129.714L841.911 130.089H841.451L841.15 129.938L789.752 60.8711H771.804V153.254Z"
            fill="url(#paint6_linear_384_19306)" />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M883.515 60.3594L912.166 133.823H912.228L940.649 60.3604L940.999 60.1211H959.741L960.089 60.6367L922.49 153.77L922.143 154.004H901.562L901.214 153.77L863.615 60.6367L863.963 60.1211H883.165L883.515 60.3594ZM901.814 153.254H921.89L959.186 60.8711H941.256L912.834 134.334L912.484 134.573H911.909L911.56 134.335L882.908 60.8711H864.519L901.814 153.254Z"
            fill="url(#paint7_linear_384_19306)" />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1077.17 60.4961V153.629L1076.8 154.004H1059.32L1058.95 153.629V60.4961L1059.32 60.1211H1076.8L1077.17 60.4961ZM1059.7 153.254H1076.42V60.8711H1059.7V153.254Z"
            fill="url(#paint8_linear_384_19306)" />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1248.89 60.4961V75.6738L1248.52 76.0488H1199.45V97.6045H1245.07L1245.45 97.9795V112.697L1245.07 113.072H1199.45V138.077H1248.52L1248.89 138.452V153.629L1248.52 154.004H1181.49L1181.11 153.629V60.4961L1181.49 60.1211H1248.52L1248.89 60.4961ZM1181.86 153.254H1248.14V138.827H1199.08L1198.7 138.452V112.697L1199.08 112.322H1244.7V98.3545H1199.08L1198.7 97.9795V75.6738L1199.08 75.2988H1248.14V60.8711H1181.86V153.254Z"
            fill="url(#paint9_linear_384_19306)" />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1288.56 0.00292969H1319.91L1320.29 0.37793V182.633L1320.18 182.898L1288.82 214.257L1288.56 214.146V214.36H699.028L699.025 214.363H667.667L667.292 213.988V31.7324L667.401 31.4668L698.76 0.109375L699.025 0H1288.56L1288.56 0.00292969ZM668.042 31.8887V213.613H699.022L699.025 213.61H1288.41L1319.54 182.478V0.75293H1288.56L1288.55 0.75H699.182L668.042 31.8887Z"
            fill="url(#paint10_linear_384_19306)" />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M532.869 0.610352C550.066 0.610446 565.24 3.58719 578.375 9.55762C591.505 15.3561 602.252 23.7181 610.613 34.6377L611.404 35.668C619.482 46.3814 624.59 59.0931 626.737 73.791L626.366 74.2207H581.272L580.902 73.9082C579.049 62.9602 573.921 54.5593 565.52 48.6777L565.516 48.6748C557.103 42.6183 546.23 39.5753 532.869 39.5752C520.187 39.5752 509.127 42.3667 499.682 47.9326L499.68 47.9336C490.409 53.3286 483.151 61.1657 477.917 71.4629L477.918 71.4639C472.853 81.7632 470.315 93.853 470.315 107.734L470.323 109.062C470.482 122.721 473.102 134.616 478.171 144.756C483.405 155.055 490.746 163.074 500.192 168.811C509.636 174.375 520.78 177.161 533.631 177.161C543.1 177.161 551.63 175.641 559.222 172.605C566.816 169.568 572.792 165.355 577.161 159.978C581.387 154.776 583.561 148.953 583.693 142.5L583.7 141.873V139.211L583.707 139.204V139.135L537.996 108.104L538.207 107.418H626.364V107.634L626.366 107.635V107.418L626.476 107.681L626.741 107.791V107.793H626.522L626.523 107.794L626.741 107.793V210.401L626.366 210.776H586.628L586.253 210.401V199.134C583.132 201.184 575.098 205.691 565.767 209.108C557.527 212.126 541.794 213.835 528.025 213.835C507.928 213.834 490.196 209.408 474.847 200.539L474.843 200.536C459.667 191.499 447.728 178.962 439.035 162.939L439.034 162.937C430.51 146.91 426.256 128.419 426.256 107.479C426.256 86.0264 430.682 67.2776 439.549 51.248L440.391 49.7559C449.197 34.4463 461.367 22.4923 476.894 13.9033C492.923 5.03642 511.586 0.610402 532.869 0.610352ZM532.869 1.36035C511.692 1.3604 493.158 5.76358 477.257 14.5596C461.353 23.3574 449.003 35.7076 440.205 51.6113C431.409 67.5119 427.006 86.1313 427.006 107.479L427.019 109.425C427.275 129.46 431.501 147.177 439.694 162.582C448.325 178.489 460.17 190.926 475.226 199.892C490.446 208.684 508.043 213.084 528.025 213.085C541.771 213.085 557.397 211.374 565.509 208.403C575.446 204.764 583.893 199.885 586.413 198.121L587.003 198.429V210.026H625.991V108.168H539.428L584.293 138.626L584.457 138.937V139.211L584.45 139.218V141.873C584.45 148.755 582.211 154.951 577.743 160.45C573.281 165.942 567.192 170.226 559.501 173.303C551.808 176.379 543.181 177.911 533.631 177.911C520.669 177.911 509.39 175.1 499.812 169.457L499.809 169.454C490.235 163.642 482.798 155.515 477.503 145.096L477.502 145.094C472.207 134.503 469.566 122.045 469.565 107.734C469.565 93.7619 472.119 81.5552 477.244 71.1338L477.247 71.1289C482.542 60.7103 489.896 52.7591 499.303 47.2852C508.88 41.6422 520.075 38.8252 532.869 38.8252C546.34 38.8253 557.378 41.8932 565.949 48.0625C574.449 54.0127 579.657 62.4941 581.586 73.4707H625.929C623.691 58.5965 618.389 45.8084 610.021 35.0986L610.02 35.0957C601.737 24.2787 591.09 15.9924 578.068 10.2422L578.064 10.2412C565.044 4.32286 549.98 1.36045 532.869 1.36035Z"
            fill="url(#paint11_linear_384_19306)" />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M81.6465 4.80371C104.112 4.80371 123.537 8.97346 139.905 17.3281C156.273 25.6826 168.896 37.6229 177.766 53.1436C186.636 68.6661 191.062 87.0771 191.062 108.36C191.062 129.475 186.55 147.801 177.51 163.323C168.641 178.842 156.018 190.867 139.652 199.391L139.65 199.392C123.282 207.746 103.943 211.916 81.6465 211.916H0.375L0 211.541V5.17871L0.375 4.80371H81.6465ZM0.75 41.4902H81.6465C103.117 41.4902 119.451 47.5419 130.582 59.6992L131.107 60.2715C142.045 72.3509 147.497 88.3939 147.497 108.36C147.497 128.475 141.87 144.707 130.584 157.019C119.453 169.177 103.118 175.229 81.6465 175.229H43.4307L43.0557 174.854V72.9824L0.75 42.5957V211.166H81.6465C103.849 211.166 123.066 207.014 139.309 198.724C155.551 190.264 168.066 178.339 176.86 162.948L176.861 162.946C185.824 147.557 190.312 129.366 190.312 108.36C190.312 87.1827 185.909 68.9057 177.115 53.5166C168.321 38.126 155.806 26.2863 139.563 17.9961C123.322 9.70621 104.02 5.55371 81.6465 5.55371H0.75V41.4902ZM43.6494 72.4854L43.8057 72.79V174.479H81.6465C102.976 174.479 119.083 168.472 130.031 156.513C141.165 144.367 146.747 128.329 146.747 108.36C146.747 88.2209 141.165 72.1836 130.033 60.209L130.031 60.207C119.083 48.2479 102.976 42.2402 81.6465 42.2402H1.54004L43.6494 72.4854Z"
            fill="url(#paint12_linear_384_19306)" />
          <defs>
            <linearGradient
              id="paint0_linear_384_19306"
              x1="660.145"
              y1="0"
              x2="660.145"
              y2="214.975"
              gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.3" />
              <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
            <linearGradient
              id="paint1_linear_384_19306"
              x1="660.145"
              y1="0"
              x2="660.145"
              y2="214.975"
              gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.3" />
              <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
            <linearGradient
              id="paint2_linear_384_19306"
              x1="660.145"
              y1="0"
              x2="660.145"
              y2="214.975"
              gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.3" />
              <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
            <linearGradient
              id="paint3_linear_384_19306"
              x1="660.145"
              y1="0"
              x2="660.145"
              y2="214.975"
              gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.3" />
              <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
            <linearGradient
              id="paint4_linear_384_19306"
              x1="660.145"
              y1="0"
              x2="660.145"
              y2="214.975"
              gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.3" />
              <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
            <linearGradient
              id="paint5_linear_384_19306"
              x1="660.145"
              y1="0"
              x2="660.145"
              y2="214.975"
              gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.3" />
              <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
            <linearGradient
              id="paint6_linear_384_19306"
              x1="660.145"
              y1="0"
              x2="660.145"
              y2="214.975"
              gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.3" />
              <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
            <linearGradient
              id="paint7_linear_384_19306"
              x1="660.145"
              y1="0"
              x2="660.145"
              y2="214.975"
              gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.3" />
              <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
            <linearGradient
              id="paint8_linear_384_19306"
              x1="660.145"
              y1="0"
              x2="660.145"
              y2="214.975"
              gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.3" />
              <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
            <linearGradient
              id="paint9_linear_384_19306"
              x1="660.145"
              y1="0"
              x2="660.145"
              y2="214.975"
              gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.3" />
              <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
            <linearGradient
              id="paint10_linear_384_19306"
              x1="660.145"
              y1="0"
              x2="660.145"
              y2="214.975"
              gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.3" />
              <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
            <linearGradient
              id="paint11_linear_384_19306"
              x1="660.145"
              y1="0"
              x2="660.145"
              y2="214.975"
              gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.3" />
              <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
            <linearGradient
              id="paint12_linear_384_19306"
              x1="660.145"
              y1="0"
              x2="660.145"
              y2="214.975"
              gradientUnits="userSpaceOnUse">
              <stop stop-color="white" stop-opacity="0.3" />
              <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
          </defs>
        </svg>
      </span>

      <div class="footer__gradient">
        <svg
          width="1212"
          height="387"
          viewBox="0 0 1212 387"
          fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <g filter="url(#filter0_f_452_13256)">
            <ellipse
              cx="605.8"
              cy="193.3"
              rx="548"
              ry="135.5"
              fill="#082B0E" />
          </g>
          <g filter="url(#filter1_f_452_13256)">
            <ellipse
              cx="605.8"
              cy="193.3"
              rx="389"
              ry="63.5"
              fill="#1C5F25" />
          </g>
          <g filter="url(#filter2_f_452_13256)">
            <ellipse
              cx="605.798"
              cy="193.3"
              rx="263.493"
              ry="38.6232"
              fill="#4FD15F" />
          </g>
          <g filter="url(#filter3_f_452_13256)">
            <ellipse
              cx="605.801"
              cy="193.299"
              rx="189.136"
              ry="20.6027"
              fill="#C9F45A" />
          </g>
          <g filter="url(#filter4_f_452_13256)">
            <ellipse
              cx="605.8"
              cy="193.299"
              rx="75.8673"
              ry="13.4618"
              fill="#E2FB9B" />
          </g>
          <defs>
            <filter
              id="filter0_f_452_13256"
              x="-0.00019455"
              y="-0.00019455"
              width="1211.6"
              height="386.6"
              filterUnits="userSpaceOnUse"
              color-interpolation-filters="sRGB">
              <feFlood flood-opacity="0" result="BackgroundImageFix" />
              <feBlend
                mode="normal"
                in="SourceGraphic"
                in2="BackgroundImageFix"
                result="shape" />
              <feGaussianBlur
                stdDeviation="28.9"
                result="effect1_foregroundBlur_452_13256" />
            </filter>
            <filter
              id="filter1_f_452_13256"
              x="159"
              y="71.9998"
              width="893.6"
              height="242.6"
              filterUnits="userSpaceOnUse"
              color-interpolation-filters="sRGB">
              <feFlood flood-opacity="0" result="BackgroundImageFix" />
              <feBlend
                mode="normal"
                in="SourceGraphic"
                in2="BackgroundImageFix"
                result="shape" />
              <feGaussianBlur
                stdDeviation="28.9"
                result="effect1_foregroundBlur_452_13256" />
            </filter>
            <filter
              id="filter2_f_452_13256"
              x="282.206"
              y="94.5768"
              width="647.185"
              height="197.446"
              filterUnits="userSpaceOnUse"
              color-interpolation-filters="sRGB">
              <feFlood flood-opacity="0" result="BackgroundImageFix" />
              <feBlend
                mode="normal"
                in="SourceGraphic"
                in2="BackgroundImageFix"
                result="shape" />
              <feGaussianBlur
                stdDeviation="30.05"
                result="effect1_foregroundBlur_452_13256" />
            </filter>
            <filter
              id="filter3_f_452_13256"
              x="370.065"
              y="126.096"
              width="471.471"
              height="134.405"
              filterUnits="userSpaceOnUse"
              color-interpolation-filters="sRGB">
              <feFlood flood-opacity="0" result="BackgroundImageFix" />
              <feBlend
                mode="normal"
                in="SourceGraphic"
                in2="BackgroundImageFix"
                result="shape" />
              <feGaussianBlur
                stdDeviation="23.3"
                result="effect1_foregroundBlur_452_13256" />
            </filter>
            <filter
              id="filter4_f_452_13256"
              x="501.933"
              y="151.837"
              width="207.734"
              height="82.9238"
              filterUnits="userSpaceOnUse"
              color-interpolation-filters="sRGB">
              <feFlood flood-opacity="0" result="BackgroundImageFix" />
              <feBlend
                mode="normal"
                in="SourceGraphic"
                in2="BackgroundImageFix"
                result="shape" />
              <feGaussianBlur
                stdDeviation="14"
                result="effect1_foregroundBlur_452_13256" />
            </filter>
          </defs>
        </svg>
      </div>
    </div>
  <?php endif; ?>
  <div class="footer-panel">
    <div class="footer-panel-main">
      <div class="footer-content">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-content-logo no-hover-effect">
          <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/logo.svg" alt="DogInvoice" />
        </a>
        <p
          class="footer-content-description typography--body-md"
          data-remove-orphans>
          Automatyzacja faktur z AI i pełna integracja z KSeF. Oszczędzaj
          czas, eliminuj błędy i miej kontrolę nad finansami.
        </p>
      </div>

      <nav class="footer-nav" aria-label="Stopka">
        <div class="footer-nav-col">
          <h4 class="footer-nav-col-title">Produkt</h4>
          <?php
          wp_nav_menu(
            array(
              'theme_location' => 'menu-1',
              'container'      => false,
              'menu_id'        => 'footer-nav-menu',
              'menu_class'     => 'footer-nav-col-list',
              'walker'         => new DogInvoice_Nav_Walker('', 'no-hover-effect'),
              'fallback_cb'    => false,
              'depth'          => 1,
            )
          );
          ?>
        </div>
        <div class="footer-nav-col">
          <h4 class="footer-nav-col-title">Narzędzia</h4>
          <?php
          wp_nav_menu(
            array(
              'menu'        => 4,
              'container'   => false,
              'menu_id'     => 'footer-tools-menu',
              'menu_class'  => 'footer-nav-col-list',
              'walker'      => new DogInvoice_Nav_Walker('', 'no-hover-effect'),
              'fallback_cb' => false,
              'depth'       => 1,
            )
          );
          ?>
        </div>
        <div class="footer-nav-col">
          <h4 class="footer-nav-col-title">Wsparcie</h4>
          <?php
          wp_nav_menu(
            array(
              'menu'        => 5,
              'container'   => false,
              'menu_id'     => 'footer-support-menu',
              'menu_class'  => 'footer-nav-col-list',
              'walker'      => new DogInvoice_Nav_Walker('', 'no-hover-effect'),
              'fallback_cb' => false,
              'depth'       => 1,
            )
          );
          ?>
        </div>
      </nav>
    </div>

    <div class="footer-bottom">
      <span class="footer-bottom-copyright typography--body-md">© 2026 DogInvoice. Wszystkie prawa zastrzeżone.</span>
      <p class="footer-bottom-credit typography--body-md">
        Stworzone przez
        <span class="footer-bottom-credit-link-wrap">
          <a
            class="footer-bottom-credit-link"
            href="https://dogtronic.com"
            target="_blank"
            rel="noopener noreferrer">Dogtronic Labs.</a>
        </span>
      </p>
    </div>
  </div>
</footer>

<?php
$organization_schema = array(
  '@context' => 'https://schema.org',
  '@type'    => 'Organization',
  'name'     => get_bloginfo('name'),
  'url'      => home_url('/'),
  'logo'     => get_template_directory_uri() . '/src/assets/images/logo.svg',
);
?>
<script type="application/ld+json">
  <?php echo wp_json_encode($organization_schema, JSON_UNESCAPED_UNICODE); ?>
</script>

<!-- <script src="main.js"></script> -->
<script src="<?php echo get_template_directory_uri(); ?>/src/js/index.js" defer></script>
<script src="<?php echo get_template_directory_uri(); ?>/src/js/header.js" defer></script>
<?php if (is_front_page()) : ?>
  <script src="https://unpkg.com/@popperjs/core@2" defer></script>
  <script src="https://unpkg.com/tippy.js@6" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js" defer></script>
  <script src="<?php echo get_template_directory_uri(); ?>/src/js/gsap-animations.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
  <script src="<?php echo get_template_directory_uri(); ?>/src/js/pricing.js" defer></script>
  <script src="<?php echo get_template_directory_uri(); ?>/src/js/demo-modal.js" defer></script>
  <script src="<?php echo get_template_directory_uri(); ?>/src/js/logos-swiper.js" defer></script>
  <script src="<?php echo get_template_directory_uri(); ?>/src/js/features-swiper.js" defer></script>
  <script src="<?php echo get_template_directory_uri(); ?>/src/js/integrations-swiper.js" defer></script>
  <script src="<?php echo get_template_directory_uri(); ?>/src/js/testimonials-swiper.js" defer></script>
  <script src="<?php echo get_template_directory_uri(); ?>/src/js/faq.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/lottie-web@5.12.2/build/player/lottie.min.js" defer></script>
  <script src="<?php echo get_template_directory_uri(); ?>/src/js/features-lottie.js" defer></script>
<?php endif; ?>
<?php wp_footer(); ?>
</body>

</html>