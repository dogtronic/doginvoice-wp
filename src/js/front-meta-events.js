document.addEventListener("DOMContentLoaded", () => {
  function fbTrack(event, params) {
    if (typeof fbq !== "function") return;
    params ? fbq("track", event, params) : fbq("track", event);
  }
  function fbCustom(event, params) {
    if (typeof fbq !== "function") return;
    fbq("trackCustom", event, params || {});
  }

  // Hero CTA (primary) -> Hero_CTA_Click + Lead
  const heroCta = document.querySelector(
    '.hero-content-cta .hero-content-cta-button[color="green"]',
  );
  if (heroCta) {
    heroCta.addEventListener("click", () => {
      fbCustom("Hero_CTA_Click");
      fbTrack("Lead");
    });
  }

  // Wszystkie pozostałe linki do app.doginvoice.com poza hero i cennikiem -> Lead
  document
    .querySelectorAll('a[href^="https://app.doginvoice.com"]')
    .forEach((link) => {
      if (
        link.closest(".hero-content-cta") ||
        link.closest(".pricing-main-plan")
      ) {
        return;
      }
      link.addEventListener("click", () => {
        fbTrack("Lead");
      });
    });

  // Cennik: plan płatny -> InitiateCheckout, plan darmowy -> Lead
  document
    .querySelectorAll(".pricing-main-plan-button")
    .forEach((link) => {
      link.addEventListener("click", () => {
        const plan = link.closest(".pricing-main-plan");
        const planName =
          plan?.querySelector(".pricing-main-plan-header-title")?.textContent.trim() ||
          "";
        const isPaid = ["Professional", "Business", "Enterprise"].includes(
          planName,
        );
        if (isPaid) {
          fbTrack("InitiateCheckout", { content_name: planName });
        } else {
          fbTrack("Lead", { content_name: planName });
        }
      });
    });

  // Demo wideo -> WatchDemo
  document.querySelectorAll("[data-demo-modal-open]").forEach((trigger) => {
    trigger.addEventListener("click", () => {
      fbCustom("WatchDemo");
    });
  });

  // Sekcja cennika wchodzi w viewport -> ViewContent
  // + Engagement: 5s aktywnego oglądania -> PricingEngaged
  const pricingSection = document.getElementById("price");
  if (pricingSection) {
    let pricingTracked = false;
    let pricingEngagedTracked = false;
    let pricingVisibleMs = 0;
    let pricingVisibleSince = null;
    const ENGAGEMENT_THRESHOLD_MS = 5000;

    const startEngagementTimer = () => {
      if (pricingVisibleSince === null && !document.hidden) {
        pricingVisibleSince = Date.now();
      }
    };
    const stopEngagementTimer = () => {
      if (pricingVisibleSince !== null) {
        pricingVisibleMs += Date.now() - pricingVisibleSince;
        pricingVisibleSince = null;
      }
      if (!pricingEngagedTracked && pricingVisibleMs >= ENGAGEMENT_THRESHOLD_MS) {
        pricingEngagedTracked = true;
        fbCustom("PricingEngaged", { dwell_ms: Math.round(pricingVisibleMs) });
      }
    };

    new IntersectionObserver(
      (entries) => {
        const entry = entries[0];
        if (entry.isIntersecting) {
          if (!pricingTracked) {
            pricingTracked = true;
            fbTrack("ViewContent", { content_name: "Cennik" });
          }
          startEngagementTimer();
        } else {
          stopEngagementTimer();
        }
      },
      { threshold: 0.3 },
    ).observe(pricingSection);

    document.addEventListener("visibilitychange", () => {
      if (document.hidden) stopEngagementTimer();
      else startEngagementTimer();
    });

    // Sprawdzaj próg cyklicznie, gdy sekcja jest cały czas widoczna
    setInterval(() => {
      if (pricingEngagedTracked) return;
      if (pricingVisibleSince !== null) {
        const total = pricingVisibleMs + (Date.now() - pricingVisibleSince);
        if (total >= ENGAGEMENT_THRESHOLD_MS) {
          pricingEngagedTracked = true;
          fbCustom("PricingEngaged", { dwell_ms: Math.round(total) });
        }
      }
    }, 1000);
  }

  // Przełącznik miesięcznie/rocznie -> ViewPricing_Toggle
  document.addEventListener("pricing:period-change", (event) => {
    const billing = event.detail?.isYearly ? "yearly" : "monthly";
    fbCustom("ViewPricing_Toggle", { billing });
  });

  // FAQ otwarte -> FAQ_Open (setTimeout 0, żeby sprawdzić stan po przełączeniu przez faq.js)
  document.querySelectorAll(".faq-item-trigger").forEach((trigger) => {
    trigger.addEventListener("click", () => {
      const item = trigger.closest(".faq-item");
      setTimeout(() => {
        if (item?.classList.contains("is-open")) {
          const question =
            trigger.querySelector(".faq-item-question")?.textContent.trim().substring(0, 80) || "";
          fbCustom("FAQ_Open", { question });
        }
      }, 0);
    });
  });

  // Scroll 50% -> Scroll50
  let scroll50Tracked = false;
  window.addEventListener(
    "scroll",
    () => {
      if (scroll50Tracked) return;
      if (
        (window.scrollY + window.innerHeight) /
          document.documentElement.scrollHeight >=
        0.5
      ) {
        scroll50Tracked = true;
        fbCustom("Scroll50");
      }
    },
    { passive: true },
  );

  // Engaged 30s -> TimeOnPage30s (liczy tylko aktywny czas - pauza gdy karta w tle)
  (() => {
    const THRESHOLD_MS = 30000;
    let activeMs = 0;
    let lastTick = Date.now();
    let fired = false;

    const tick = () => {
      if (fired) return;
      const now = Date.now();
      if (!document.hidden) activeMs += now - lastTick;
      lastTick = now;
      if (activeMs >= THRESHOLD_MS) {
        fired = true;
        fbCustom("TimeOnPage30s");
        clearInterval(intervalId);
      }
    };

    document.addEventListener("visibilitychange", () => {
      lastTick = Date.now();
    });

    const intervalId = setInterval(tick, 1000);
  })();
});
