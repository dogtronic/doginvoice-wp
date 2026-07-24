document.addEventListener("DOMContentLoaded", () => {
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  gsap.registerPlugin(ScrollTrigger);

  const mm = gsap.matchMedia();

  // Powyżej 680px (sm): animacja GSAP. Poniżej: statyczny obrazek mobile-app.
  mm.add("(min-width: 681px)", () => {
    const hero = document.querySelector(".hero");
    if (!hero) return;

    const scroll = {
      trigger: hero,
      start: "top top",
      end: "bottom top",
      scrub: 1,
    };

    // Lewe (3, 5) → w prawo; prawe (1, 2, 4) → w lewo — zbieżność do środka
    gsap.to(".hero-media-screen--1", {
      x: -280,
      y: 120,
      ease: "none",
      scrollTrigger: scroll,
    });
    gsap.to(".hero-media-screen--2", {
      x: -260,
      y: 100,
      ease: "none",
      scrollTrigger: scroll,
    });
    gsap.to(".hero-media-screen--3", {
      x: 220,
      y: 60,
      ease: "none",
      scrollTrigger: scroll,
    });
    gsap.to(".hero-media-screen--4", {
      x: -300,
      y: 140,
      ease: "none",
      scrollTrigger: scroll,
    });
    gsap.to(".hero-media-screen--5", {
      x: 260,
      y: 100,
      ease: "none",
      scrollTrigger: scroll,
    });
  });

  const footerGradient = document.querySelector(".footer__gradient");
  const footerBackground = document.querySelector(".footer__background");
  if (footerGradient) {
    gsap.to(footerGradient, {
      opacity: 1,
      ease: "none",
      scrollTrigger: {
        trigger: ".footer-section",
        start: "top center",
        end: "top 30%",
        scrub: 1,
      },
    });
  }
  if (footerBackground) {
    gsap.to(footerBackground, {
      opacity: 1,
      ease: "none",
      scrollTrigger: {
        trigger: ".footer-section",
        start: "top center",
        end: "top 30%",
        scrub: 1,
      },
    });
  }
});
