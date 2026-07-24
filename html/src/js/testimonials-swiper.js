document.addEventListener("DOMContentLoaded", () => {
  const testimonialsEl = document.querySelector(".testimonials-swiper");
  if (!testimonialsEl || typeof Swiper === "undefined") return;

  // const wrapper = testimonialsEl.querySelector(".swiper-wrapper");
  // if (!wrapper) return;

  // const originals = Array.from(wrapper.children);
  // if (!originals.length) return;

  // // Loop przy slidesPerView: "auto" wymaga slajdów szerszych niż viewport.
  // const minWidth = window.innerWidth * 2.5;
  // let totalWidth = originals.reduce((sum, slide) => sum + slide.offsetWidth, 0);

  // while (totalWidth < minWidth) {
  //   originals.forEach((slide) => {
  //     const clone = slide.cloneNode(true);
  //     wrapper.appendChild(clone);
  //     totalWidth += slide.offsetWidth || 400;
  //   });
  // }

  new Swiper(testimonialsEl, {
    slidesPerView: "auto",
    spaceBetween: 16,
    centerInsufficientSlides: true,
    grabCursor: true,

    // speed: 6000,
    allowTouchMove: true,
    // autoplay: {
    //   delay: 0,
    //   disableOnInteraction: false,
    //   pauseOnMouseEnter: true,
    // },
    breakpoints: {
      768: {
        spaceBetween: 24,
      },
    },
  });
});
