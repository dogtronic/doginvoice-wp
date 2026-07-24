document.addEventListener("DOMContentLoaded", () => {
  const faq = document.querySelector(".faq");
  if (!faq) return;

  const navButtons = [...faq.querySelectorAll(".faq-nav-button")];
  const categories = [...faq.querySelectorAll(".faq-category")];
  const prefersReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  ).matches;

  let isScrollingByClick = false;
  let scrollTimeoutId = 0;

  const getNavOffset = () =>
    window.matchMedia("(min-width: 1280px)").matches ? 180 : 170;

  const setActiveNav = (targetId) => {
    navButtons.forEach((button) => {
      button.classList.toggle("active", button.dataset.faqTarget === targetId);
    });
  };

  const getAnswer = (item) => item.querySelector(".faq-item-answer");
  const getAnswerText = (answer) => answer?.querySelector("p");

  const openItem = (item, animate = true) => {
    const answer = getAnswer(item);
    const text = getAnswerText(answer);
    const trigger = item.querySelector(".faq-item-trigger");
    if (!answer) return;

    item.classList.add("is-open");
    trigger?.setAttribute("aria-expanded", "true");

    if (typeof gsap === "undefined" || prefersReducedMotion || !animate) {
      answer.style.height = "auto";
      if (text) text.style.opacity = "1";
      return;
    }

    gsap.killTweensOf([answer, text].filter(Boolean));
    gsap.set(answer, { height: "auto" });
    const targetHeight = answer.offsetHeight;
    gsap.fromTo(
      answer,
      { height: 0 },
      {
        height: targetHeight,
        duration: 0.45,
        ease: "power2.out",
        onComplete: () => {
          gsap.set(answer, { height: "auto" });
        },
      },
    );

    if (text) {
      gsap.fromTo(
        text,
        { opacity: 0, y: -6 },
        { opacity: 1, y: 0, duration: 0.35, delay: 0.06, ease: "power2.out" },
      );
    }
  };

  const closeItem = (item, animate = true) => {
    const answer = getAnswer(item);
    const text = getAnswerText(answer);
    const trigger = item.querySelector(".faq-item-trigger");
    if (!answer) return;

    item.classList.remove("is-open");
    trigger?.setAttribute("aria-expanded", "false");

    if (typeof gsap === "undefined" || prefersReducedMotion || !animate) {
      answer.style.height = "0px";
      if (text) text.style.opacity = "1";
      return;
    }

    gsap.killTweensOf([answer, text].filter(Boolean));
    gsap.set(answer, { height: answer.offsetHeight });

    if (text) {
      gsap.to(text, {
        opacity: 0,
        y: -4,
        duration: 0.2,
        ease: "power1.in",
      });
    }

    gsap.to(answer, {
      height: 0,
      duration: 0.35,
      ease: "power2.inOut",
    });
  };

  // Stan początkowy: otwarte elementy bez animacji
  faq.querySelectorAll(".faq-item").forEach((item) => {
    const answer = getAnswer(item);
    if (!answer) return;

    if (item.classList.contains("is-open")) {
      answer.style.height = "auto";
    } else {
      answer.style.height = "0px";
    }
  });

  const scrollToCategory = (targetId) => {
    const category = document.getElementById(targetId);
    if (!category) return;

    const top =
      category.getBoundingClientRect().top + window.scrollY - getNavOffset();

    isScrollingByClick = true;
    setActiveNav(targetId);
    window.scrollTo({ top, behavior: "smooth" });

    window.clearTimeout(scrollTimeoutId);
    scrollTimeoutId = window.setTimeout(() => {
      isScrollingByClick = false;
    }, 800);
  };

  navButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const targetId = button.dataset.faqTarget;
      if (targetId) scrollToCategory(targetId);
    });
  });

  faq.querySelectorAll(".faq-item-trigger").forEach((trigger) => {
    trigger.addEventListener("click", () => {
      const item = trigger.closest(".faq-item");
      const itemsRoot = trigger.closest(".faq-items");
      if (!item || !itemsRoot) return;

      const willOpen = !item.classList.contains("is-open");

      itemsRoot.querySelectorAll(".faq-item.is-open").forEach((openItem) => {
        if (openItem === item) return;
        closeItem(openItem);
      });

      if (willOpen) {
        openItem(item);
      } else {
        closeItem(item);
      }
    });
  });

  const updateActiveOnScroll = () => {
    if (isScrollingByClick || !categories.length) return;

    const offset = getNavOffset() + 24;
    let currentId = categories[0].id;

    categories.forEach((category) => {
      if (category.getBoundingClientRect().top - offset <= 0) {
        currentId = category.id;
      }
    });

    setActiveNav(currentId);
  };

  window.addEventListener("scroll", updateActiveOnScroll, { passive: true });
  updateActiveOnScroll();
});
