function leaveAnimation(container) {
  return gsap
    .to(container, {
      duration: 0.3,
      opacity: 0,
      ease: "power2.inOut",
    })
    .then(function () {
      if (!window.__pendingSectionHash) window.scroll(0, 0);
    });
}

function enterAnimation(container) {
  return gsap.fromTo(
    container,
    { opacity: 0 },
    {
      duration: 0.3,
      opacity: 1,
      ease: "power2.inOut",
      clearProps: "opacity",
    },
  );
}

function syncBodyClass(next) {
  const nextHtml = next?.html;
  if (!nextHtml) return;

  const match = nextHtml.match(/<body[^>]*class="([^"]*)"/i);
  if (!match) return;

  const keep = ["is-demo-modal-open", "is-pricing-modal-open"];
  const preserved = keep.filter((name) =>
    document.body.classList.contains(name),
  );

  document.body.className = match[1];
  preserved.forEach((name) => document.body.classList.add(name));
}

barba.hooks.beforeEnter(function () {
  if (typeof setMenuOpen === "function") setMenuOpen(false);
});

barba.init({
  debug: true,
  timeout: 5000,
  transitions: [
    {
      name: "opacity-transition",
      leave: function ({ current }) {
        return leaveAnimation(current.container);
      },
      enter: function ({ next }) {
        syncBodyClass(next);
        if (window.location.hash) {
          history.replaceState(
            null,
            "",
            window.location.pathname + window.location.search,
          );
        }
        if (typeof scrollToPendingSection === "function") {
          scrollToPendingSection({ behavior: "auto" });
        }
        return enterAnimation(next.container);
      },
    },
  ],
});

barba.hooks.afterLeave(function ({ current, next }) {
  window.dispatchEvent(
    new CustomEvent("barba-transition-after-leave", {
      detail: { current, next },
    }),
  );
});

barba.hooks.after(function ({ current, next }) {
  window.dispatchEvent(
    new CustomEvent("barba-transition-after-enter", {
      detail: { current, next },
    }),
  );

  document.documentElement.classList.remove("sidebar-expanded");
  document.querySelector(".header")?.classList.remove("header-expanded");

  [
    "initIndex",
    "initHeader",
    "initGsapAnimations",
    "initPricing",
    "initDemoModal",
    "initLogosSwiper",
    "initFeaturesSwiper",
    "initIntegrationsSwiper",
    "initTestimonialsSwiper",
    "initFaq",
    "initFeaturesLottie",
    "initFrontMetaEvents",
    "initPostToc",
    "initPartnerCalculator",
    "initPartnerMetaEvents",
  ].forEach(function (name) {
    if (typeof window[name] === "function") window[name]();
  });

  if (typeof scrollToPendingSection === "function") {
    scrollToPendingSection({ behavior: "auto", clear: true });
  }
});
