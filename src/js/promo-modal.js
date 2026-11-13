/*
 * Modal promocyjny z CTA do rejestracji.
 *
 * Losuje jeden wariant (inny niż ostatnio pokazany) i pokazuje go:
 *  - desktop: gdy kursor ucieka nad górną krawędź okna (zamiar wyjścia),
 *  - wszędzie: po MAX_WAIT_MS aktywnego czasu, jeśli user przewinął >= MIN_SCROLL.
 * Nie częściej niż raz na COOLDOWN_DAYS i nigdy po kliknięciu w link do aplikacji.
 *
 * Test ręczny: dodaj do adresu ?promo=1 (losowy wariant) albo ?promo=yearly.
 */
const PROMO_MODAL = {
  MIN_ARM_MS: 8000, // wcześniej modal się nie pokaże
  MAX_WAIT_MS: 20000, // aktywny czas, po którym pokazujemy bez zamiaru wyjścia
  MIN_SCROLL: 0.35, // wymagany scroll dla triggera czasowego
  COOLDOWN_DAYS: 3,
  KEY_LAST_SHOWN: "doginvoice-promo-shown-at",
  KEY_LAST_VARIANT: "doginvoice-promo-variant",
  KEY_CONVERTED: "doginvoice-promo-converted",
};

let promoModalTriggersBound = false;
let promoModalShownThisLoad = false;

function promoStorageGet(key) {
  try {
    return window.localStorage.getItem(key);
  } catch (e) {
    return null;
  }
}

function promoStorageSet(key, value) {
  try {
    window.localStorage.setItem(key, value);
  } catch (e) {
    /* tryb prywatny - trudno */
  }
}

function promoTrack(event, variant) {
  if (typeof fbq === "function") {
    fbq("trackCustom", event, { variant });
  }
  if (typeof gtag === "function") {
    gtag("event", event, { variant });
  }
}

function promoModalAllowed() {
  if (promoModalShownThisLoad) return false;
  if (promoStorageGet(PROMO_MODAL.KEY_CONVERTED)) return false;

  const lastShown = Number(promoStorageGet(PROMO_MODAL.KEY_LAST_SHOWN) || 0);
  const cooldownMs = PROMO_MODAL.COOLDOWN_DAYS * 24 * 60 * 60 * 1000;
  if (lastShown && Date.now() - lastShown < cooldownMs) return false;

  // Nie przykrywamy innych modali ani otwartego menu.
  const root = document.documentElement;
  if (
    root.classList.contains("is-pricing-modal-open") ||
    root.classList.contains("is-demo-modal-open") ||
    root.classList.contains("sidebar-expanded")
  ) {
    return false;
  }
  return true;
}

function openPromoModal(forcedVariant) {
  const modal = document.querySelector(".promo-modal");
  if (!modal) return false;

  const variants = [...modal.querySelectorAll("[data-promo-variant]")];
  if (!variants.length) return false;

  let chosen = variants.find((el) => el.dataset.promoVariant === forcedVariant);
  if (!chosen) {
    const last = promoStorageGet(PROMO_MODAL.KEY_LAST_VARIANT);
    const pool = variants.filter((el) => el.dataset.promoVariant !== last);
    const from = pool.length ? pool : variants;
    chosen = from[Math.floor(Math.random() * from.length)];
  }

  variants.forEach((el) => {
    el.hidden = el !== chosen;
  });

  const variantId = chosen.dataset.promoVariant;
  modal.dataset.activeVariant = variantId;
  modal.classList.add("is-open");
  modal.setAttribute("aria-hidden", "false");
  document.documentElement.classList.add("is-promo-modal-open");
  modal.querySelector(".promo-modal-close")?.focus({ preventScroll: true });

  promoModalShownThisLoad = true;
  promoStorageSet(PROMO_MODAL.KEY_LAST_SHOWN, String(Date.now()));
  promoStorageSet(PROMO_MODAL.KEY_LAST_VARIANT, variantId);
  promoTrack("PromoModal_View", variantId);
  return true;
}

function closePromoModal() {
  const modal = document.querySelector(".promo-modal");
  if (!modal || !modal.classList.contains("is-open")) return;
  modal.classList.remove("is-open");
  modal.setAttribute("aria-hidden", "true");
  document.documentElement.classList.remove("is-promo-modal-open");
  promoTrack("PromoModal_Close", modal.dataset.activeVariant || "");
}

function bindPromoModalTriggers() {
  if (promoModalTriggersBound) return;
  promoModalTriggersBound = true;

  const startedAt = Date.now();
  let activeMs = 0;
  let lastTick = Date.now();
  let maxScroll = 0;

  const tryOpen = () => {
    if (!document.querySelector(".promo-modal")) return;
    if (!promoModalAllowed()) return;
    openPromoModal();
  };

  // Kliknięcie w dowolny link do aplikacji = user już idzie dalej, nie nagabujemy.
  document.addEventListener("click", (event) => {
    const link = event.target.closest?.('a[href^="https://app.doginvoice.com"]');
    if (link) promoStorageSet(PROMO_MODAL.KEY_CONVERTED, "1");
  });

  // Zamiar wyjścia (desktop): kursor wychodzi górą okna.
  document.addEventListener("mouseout", (event) => {
    if (event.relatedTarget || event.clientY > 0) return;
    if (Date.now() - startedAt < PROMO_MODAL.MIN_ARM_MS) return;
    tryOpen();
  });

  window.addEventListener(
    "scroll",
    () => {
      const scrollable =
        document.documentElement.scrollHeight - window.innerHeight;
      if (scrollable > 0) {
        maxScroll = Math.max(maxScroll, window.scrollY / scrollable);
      }
    },
    { passive: true },
  );

  document.addEventListener("visibilitychange", () => {
    lastTick = Date.now();
  });

  // Trigger czasowy (głównie mobile): aktywny czas + minimalny scroll.
  const intervalId = setInterval(() => {
    const now = Date.now();
    if (!document.hidden) activeMs += now - lastTick;
    lastTick = now;

    if (promoModalShownThisLoad) {
      clearInterval(intervalId);
      return;
    }
    if (
      activeMs >= PROMO_MODAL.MAX_WAIT_MS &&
      maxScroll >= PROMO_MODAL.MIN_SCROLL
    ) {
      tryOpen();
    }
  }, 1000);

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") closePromoModal();
  });
}

function initPromoModal() {
  const modal = document.querySelector(".promo-modal");
  if (!modal) return;

  if (modal.dataset.inited !== "true") {
    modal.dataset.inited = "true";

    document.querySelectorAll("[data-promo-modal-close]").forEach((trigger) => {
      trigger.addEventListener("click", closePromoModal);
    });

    modal.querySelectorAll("[data-promo-modal-cta]").forEach((cta) => {
      cta.addEventListener("click", () => {
        promoTrack("PromoModal_CTA_Click", modal.dataset.activeVariant || "");
      });
    });
  }

  bindPromoModalTriggers();

  // Podgląd: ?promo=1 lub ?promo=<id wariantu> pomija limity.
  const preview = new URLSearchParams(window.location.search).get("promo");
  if (preview && !modal.classList.contains("is-open")) {
    openPromoModal(preview);
  }
}

document.addEventListener("DOMContentLoaded", initPromoModal);
