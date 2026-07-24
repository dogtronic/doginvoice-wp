document.addEventListener("DOMContentLoaded", () => {
  wrapPricingInfoWithLastWord();
  initPricingTooltips();
  initPricingSwitcher();
  initPricingModal();
});

function initPricingTooltips() {
  if (typeof tippy !== "function") return;

  tippy(".pricing-info", {
    theme: "pricing",
    placement: "top",
    maxWidth: 240,
    arrow: true,
    animation: "fade",
    duration: [150, 100],
    offset: [0, 10],
  });
}

function initPricingSwitcher() {
  const pricingSwitch = document.querySelector(".pricing-switcher");
  const pricingSwitchButton = pricingSwitch?.querySelector(
    ".pricing-switcher-button",
  );
  const monthlyOption = pricingSwitch?.querySelector('[data-period="monthly"]');
  const yearlyOption = pricingSwitch?.querySelector('[data-period="yearly"]');
  const priceValues = document.querySelectorAll(
    ".pricing-main-plan-header-price-value[data-price-monthly]",
  );

  if (!pricingSwitch || !pricingSwitchButton || !monthlyOption || !yearlyOption)
    return;

  const setPeriod = (isYearly) => {
    pricingSwitchButton.setAttribute("aria-pressed", String(isYearly));
    monthlyOption.setAttribute("aria-pressed", String(!isYearly));
    yearlyOption.setAttribute("aria-pressed", String(isYearly));

    priceValues.forEach((priceEl) => {
      const value = isYearly
        ? priceEl.dataset.priceYearly
        : priceEl.dataset.priceMonthly;
      if (value != null) priceEl.textContent = value;
    });

    document.dispatchEvent(
      new CustomEvent("pricing:period-change", { detail: { isYearly } }),
    );
  };

  pricingSwitchButton.addEventListener("click", () => {
    const isYearly =
      pricingSwitchButton.getAttribute("aria-pressed") === "true";
    setPeriod(!isYearly);
  });

  monthlyOption.addEventListener("click", () => setPeriod(false));
  yearlyOption.addEventListener("click", () => setPeriod(true));
}

function initPricingModal() {
  const modal = document.querySelector(".pricing-modal");
  const dialog = modal?.querySelector(".pricing-modal-dialog");
  const swiperEl = modal?.querySelector(".pricing-modal-swiper");
  const wrapper = modal?.querySelector(".swiper-wrapper");
  const closeBtn = modal?.querySelector(".pricing-modal-close");
  const backdrop = document.querySelector(".pricing-modal-backdrop");
  const prevBtn = modal?.querySelector(".pricing-modal-nav--prev");
  const nextBtn = modal?.querySelector(".pricing-modal-nav--next");
  const prevNameEl = modal?.querySelector("[data-pricing-modal-prev-name]");
  const nextNameEl = modal?.querySelector("[data-pricing-modal-next-name]");
  const ctaEl = modal?.querySelector("[data-pricing-modal-cta]");
  const moreButtons = [
    ...document.querySelectorAll(".pricing-main-plan-more"),
  ];

  if (
    !modal ||
    !dialog ||
    !swiperEl ||
    !wrapper ||
    !moreButtons.length ||
    typeof Swiper === "undefined"
  ) {
    return;
  }

  const featureDescriptions = collectFeatureDescriptions();

  const plans = moreButtons
    .map((button) => {
      const planEl = button.closest(".pricing-main-plan");
      if (!planEl) return null;
      const plan = extractPlanData(planEl);
      plan.features = plan.features.map((feature) => ({
        ...feature,
        description:
          feature.description || featureDescriptions.get(feature.title) || "",
      }));
      return plan;
    })
    .filter(Boolean);

  if (!plans.length) return;

  wrapper.innerHTML = plans.map(renderPlanSlide).join("");

  let swiper = null;

  const isYearlyPeriod = () =>
    document
      .querySelector(".pricing-switcher-button")
      ?.getAttribute("aria-pressed") === "true";

  const syncSlidePrices = () => {
    const yearly = isYearlyPeriod();
    wrapper.querySelectorAll("[data-modal-price]").forEach((priceEl) => {
      const value = yearly
        ? priceEl.dataset.priceYearly
        : priceEl.dataset.priceMonthly;
      if (value != null) priceEl.textContent = value;
    });
  };

  const updateFooter = (index) => {
    const current = plans[index];
    const prev = plans[index - 1];
    const next = plans[index + 1];

    if (prevBtn) {
      prevBtn.disabled = !prev;
      prevBtn.setAttribute("aria-disabled", String(!prev));
    }
    if (nextBtn) {
      nextBtn.disabled = !next;
      nextBtn.setAttribute("aria-disabled", String(!next));
    }
    if (prevNameEl) prevNameEl.textContent = prev?.title || "";
    if (nextNameEl) nextNameEl.textContent = next?.title || "";

    if (ctaEl) {
      ctaEl.href = current?.ctaHref || "#";
      const titleEl = ctaEl.querySelector(".btn-title");
      if (titleEl) titleEl.textContent = current?.ctaLabel || "Wybierz plan";
    }
  };

  const openModal = (index = 0) => {
    syncSlidePrices();
    modal.classList.add("is-open");
    modal.setAttribute("aria-hidden", "false");
    document.documentElement.classList.add("is-pricing-modal-open");

    if (!swiper) {
      swiper = new Swiper(swiperEl, {
        slidesPerView: 1,
        spaceBetween: 0,
        speed: 350,
        allowTouchMove: true,
        autoHeight: false,
        observer: true,
        observeParents: true,
        on: {
          slideChange(instance) {
            updateFooter(instance.activeIndex);
          },
        },
      });
    }

    swiper.slideTo(index, 0);
    updateFooter(index);
    closeBtn?.focus({ preventScroll: true });
  };

  const closeModal = () => {
    modal.classList.remove("is-open");
    modal.setAttribute("aria-hidden", "true");
    document.documentElement.classList.remove("is-pricing-modal-open");
  };

  moreButtons.forEach((button, index) => {
    button.addEventListener("click", (event) => {
      event.preventDefault();
      openModal(index);
    });
  });

  closeBtn?.addEventListener("click", closeModal);
  backdrop?.addEventListener("click", closeModal);
  modal.addEventListener("click", (event) => {
    if (event.target === modal) closeModal();
  });

  prevBtn?.addEventListener("click", () => swiper?.slidePrev());
  nextBtn?.addEventListener("click", () => swiper?.slideNext());

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && modal.classList.contains("is-open")) {
      closeModal();
    }
  });

  document.addEventListener("pricing:period-change", () => {
    if (modal.classList.contains("is-open")) syncSlidePrices();
  });
}

function extractPlanData(planEl) {
  const title =
    planEl.querySelector(".pricing-main-plan-header-title")?.textContent.trim() ||
    "";
  const priceEl = planEl.querySelector(
    ".pricing-main-plan-header-price-value",
  );
  const note =
    planEl
      .querySelector(".pricing-main-plan-header-note")
      ?.textContent.trim() || "";
  const popular = Boolean(
    planEl.querySelector(".pricing-main-plan-popular") ||
      planEl.classList.contains("pricing-main-plan--featured"),
  );
  const cta = planEl.querySelector(".pricing-main-plan-button");
  const features = [
    ...planEl.querySelectorAll(".pricing-main-plan-features > li"),
  ].map(extractFeatureData);

  return {
    title,
    popular,
    note,
    priceMonthly: priceEl?.dataset.priceMonthly ?? null,
    priceYearly: priceEl?.dataset.priceYearly ?? null,
    priceText: priceEl?.textContent.trim() || "",
    hasNumericPrice: priceEl?.hasAttribute("data-price-monthly") ?? false,
    ctaHref: cta?.getAttribute("href") || "#",
    ctaLabel:
      cta?.querySelector(".btn-title")?.textContent.trim() || "Wybierz plan",
    features,
  };
}

function collectFeatureDescriptions() {
  const descriptions = new Map();

  document
    .querySelectorAll(".pricing-main-plan-features > li")
    .forEach((li) => {
      const { title, description } = extractFeatureData(li);
      if (title && description && !descriptions.has(title)) {
        descriptions.set(title, description);
      }
    });

  return descriptions;
}

function extractFeatureData(li) {
  const tippyBtn = li.querySelector(".pricing-info");
  const description =
    tippyBtn?.getAttribute("data-tippy-content")?.trim() || "";

  const clone = li.cloneNode(true);
  clone
    .querySelectorAll(".pricing-info, .pricing-info-wrap")
    .forEach((node) => {
      if (node.classList.contains("pricing-info-wrap")) {
        const text = node.childNodes[0];
        if (text && text.nodeType === Node.TEXT_NODE) {
          node.replaceWith(document.createTextNode(text.textContent || ""));
        } else {
          node.remove();
        }
        return;
      }
      node.remove();
    });

  const title = clone.textContent.replace(/\s+/g, " ").trim();
  return { title, description };
}

function renderPlanSlide(plan) {
  const badge = plan.popular
    ? `<span class="pricing-modal-plan-badge">Popularny</span>`
    : "";

  const priceValueAttrs = plan.hasNumericPrice
    ? `data-modal-price data-price-monthly="${escapeAttr(plan.priceMonthly)}" data-price-yearly="${escapeAttr(plan.priceYearly)}"`
    : "";

  const priceUnit = plan.hasNumericPrice
    ? `<span class="pricing-modal-plan-price-unit">PLN/miesiąc (netto)</span>`
    : "";

  const note = plan.note
    ? `<span class="pricing-modal-plan-note">${escapeHtml(plan.note)}</span>`
    : "";

  const features = plan.features
    .map((feature) => {
      const desc = feature.description
        ? `<p class="pricing-modal-plan-feature-desc">${escapeHtml(feature.description)}</p>`
        : "";
      return `<li class="pricing-modal-plan-feature">
        <span class="pricing-modal-plan-feature-title">${escapeHtml(feature.title)}</span>
        ${desc}
      </li>`;
    })
    .join("");

  return `<div class="swiper-slide">
    <article class="pricing-modal-plan">
      <header class="pricing-modal-plan-header">
        <div class="pricing-modal-plan-title-row">
          <h3 class="pricing-modal-plan-title">${escapeHtml(plan.title)}</h3>
          ${badge}
        </div>
        <div class="pricing-modal-plan-price">
          <span class="pricing-modal-plan-price-value ff-special" ${priceValueAttrs}>${escapeHtml(plan.priceText)}</span>
          ${priceUnit}
        </div>
        ${note}
      </header>
      <ul class="pricing-modal-plan-features">
        ${features}
      </ul>
    </article>
  </div>`;
}

function escapeHtml(value) {
  return String(value)
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;");
}

function escapeAttr(value) {
  return escapeHtml(value ?? "");
}

function wrapPricingInfoWithLastWord() {
  document.querySelectorAll(".pricing-info").forEach((btn) => {
    if (btn.closest(".pricing-info-wrap")) return;

    let prev = btn.previousSibling;

    while (
      prev &&
      prev.nodeType === Node.TEXT_NODE &&
      !/[^\s\u00A0]/.test(prev.textContent)
    ) {
      const emptyNode = prev;
      prev = prev.previousSibling;
      emptyNode.remove();
    }

    if (!prev || prev.nodeType !== Node.TEXT_NODE) return;

    const text = prev.textContent;
    // [\s\S] zamiast . — tekst zaczyna się od \n, a kropka w JS nie łapie newline
    // (?:...\u00A0...)* — słowa sklejone przez removeOrphans (nbsp)
    const match = text.match(/^([\s\S]*?)((?:[^\s\u00A0]+\u00A0*)+)(\s*)$/);
    if (!match) return;

    const [, before, lastWord] = match;
    prev.textContent = before;

    if (!prev.textContent.trim()) {
      prev.remove();
    }

    const wrap = document.createElement("span");
    wrap.className = "pricing-info-wrap";
    wrap.appendChild(document.createTextNode(lastWord.replace(/\u00A0+$/, "")));
    wrap.appendChild(document.createTextNode("\u00A0"));

    btn.parentNode.insertBefore(wrap, btn);
    wrap.appendChild(btn);
  });
}
