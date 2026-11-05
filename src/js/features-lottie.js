function initFeaturesLottie() {
  initFeaturesLottie.cleanup?.();
  initFeaturesLottie.cleanup = null;

  const containers = document.querySelectorAll("[data-lottie]");
  if (!containers.length || typeof lottie === "undefined") return;

  const reduceMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  ).matches;

  const animations = [];
  const observers = [];

  containers.forEach((container) => {
    const path = container.dataset.lottie;
    if (!path) return;

    const animation = lottie.loadAnimation({
      container,
      renderer: "svg",
      loop: !reduceMotion,
      autoplay: false,
      path,
    });
    animations.push(animation);

    if (reduceMotion) {
      animation.addEventListener("DOMLoaded", () => {
        animation.goToAndStop(0, true);
      });
      return;
    }

    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          animation.play();
        } else {
          animation.pause();
        }
      },
      { threshold: 0.35 },
    );

    observer.observe(container);
    observers.push(observer);
  });

  initFeaturesLottie.cleanup = () => {
    observers.forEach((observer) => observer.disconnect());
    animations.forEach((animation) => animation.destroy());
  };
}

document.addEventListener("DOMContentLoaded", initFeaturesLottie);
