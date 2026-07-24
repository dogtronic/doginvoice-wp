document.addEventListener("DOMContentLoaded", () => {
  const logosEl = document.querySelector(".trust-logos");
  if (!logosEl || typeof Swiper === "undefined") return;

  const wrapper = logosEl.querySelector(".swiper-wrapper");
  if (!wrapper) return;

  const originals = Array.from(wrapper.children);
  if (!originals.length) return;

  // Loop przy slidesPerView: "auto" wymaga slajdów szerszych niż viewport.
  const minWidth = window.innerWidth * 2.5;
  let totalWidth = originals.reduce((sum, slide) => sum + slide.offsetWidth, 0);

  while (totalWidth < minWidth) {
    originals.forEach((slide) => {
      const clone = slide.cloneNode(true);
      const img = clone.querySelector("img");
      if (img) img.setAttribute("alt", "");
      wrapper.appendChild(clone);
      totalWidth += slide.offsetWidth || 140;
    });
  }

  new Swiper(logosEl, {
    slidesPerView: "auto",
    spaceBetween: 40,
    loop: true,
    
    loopAdditionalSlides: 4,
    speed: 4000,
    allowTouchMove: false,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
    },
    breakpoints: {
      768: {
        spaceBetween: 64,
      },
    },
  });
});
