document.addEventListener("DOMContentLoaded", () => {
  const featuresEl = document.querySelector(".features-swiper");
  if (!featuresEl || typeof Swiper === "undefined") return;

  const wrapper = featuresEl.querySelector(".swiper-wrapper");
  if (!wrapper) return;

  const originals = Array.from(wrapper.children);
  if (!originals.length) return;

  const EDGE_MIN_WIDTH = 1400;

  // Loop przy slidesPerView: "auto" wymaga slajdów szerszych niż viewport.
  const minWidth = window.innerWidth * 3.5;
  let totalWidth = originals.reduce((sum, slide) => sum + slide.offsetWidth, 0);

  while (totalWidth < minWidth) {
    originals.forEach((slide) => {
      const clone = slide.cloneNode(true);
      const img = clone.querySelector("img");
      if (img) img.setAttribute("alt", "");
      wrapper.appendChild(clone);
      totalWidth += slide.offsetWidth || 360;
    });
  }

  const EPS = 0.5;

  const clearEdgeSlides = () => {
    featuresEl.querySelectorAll(".swiper-slide.is-edge").forEach((slide) => {
      slide.classList.remove("is-edge");
    });
  };

  const updateEdgeSlides = () => {
    if (window.innerWidth < EDGE_MIN_WIDTH) {
      clearEdgeSlides();
      return;
    }

    const slides = featuresEl.querySelectorAll(".swiper-slide");
    const viewLeft = 0;
    const viewRight = document.documentElement.clientWidth;

    for (const slide of slides) {
      const rect = slide.getBoundingClientRect();
      const intersectsViewport =
        rect.right > viewLeft + EPS && rect.left < viewRight - EPS;
      const sticksOut =
        rect.left < viewLeft - EPS || rect.right > viewRight + EPS;
      const isEdge = intersectsViewport && sticksOut;

      if (slide.classList.contains("is-edge") !== isEdge) {
        slide.classList.toggle("is-edge", isEdge);
      }
    }
  };

  let rafId = 0;
  const trackEdges = () => {
    updateEdgeSlides();
    rafId = requestAnimationFrame(trackEdges);
  };

  const stopTracking = () => {
    cancelAnimationFrame(rafId);
    rafId = 0;
    clearEdgeSlides();
  };

  const startTracking = () => {
    if (rafId) return;
    trackEdges();
  };

  const syncEdgeTracking = () => {
    if (window.innerWidth >= EDGE_MIN_WIDTH) {
      startTracking();
    } else {
      stopTracking();
    }
  };

  new Swiper(featuresEl, {
    slidesPerView: "auto",
    spaceBetween: 16,
    loop: true,
    loopAdditionalSlides: 4,
    centeredSlides: true,
    centerInsufficientSlides: true,
    disableOnInteraction: true,

    autoplay: {
      delay: 0,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },
    speed: 5000,

    breakpoints: {
      768: {
        spaceBetween: 24,
      },
    },

    on: {
      init() {
        syncEdgeTracking();
      },
      destroy() {
        stopTracking();
      },
    },
  });

  window.addEventListener("resize", syncEdgeTracking);
});
