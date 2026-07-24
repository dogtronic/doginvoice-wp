document.addEventListener("DOMContentLoaded", () => {
  const header = document.querySelector(".site-header");
  const hamburger = document.querySelector(".site-header-nav-hamburger");
  const mobileMenu = document.getElementById("site-header-mobile");

  if (!header || !hamburger || !mobileMenu) return;

  const desktopLinks = header.querySelectorAll(
    ".site-header-nav-menu-item-link",
  );
  const mobileLinks = mobileMenu.querySelectorAll(
    ".site-header-mobile-menu-item-link",
  );
  const footerLinks = document.querySelectorAll(
    ".footer-nav-col-list a[href^='#']",
  );

  const getNavOffset = () =>
    window.matchMedia("(min-width: 1280px)").matches ? 180 : 170;

  const scrollToHash = (hash) => {
    const target = document.querySelector(hash);
    if (!target) return;

    const top =
      target.getBoundingClientRect().top + window.scrollY - getNavOffset();

    window.scrollTo({ top, behavior: "smooth" });
    history.pushState(null, "", hash);
  };

  const setMenuOpen = (isOpen) => {
    header.classList.toggle("is-menu-open", isOpen);
    document.body.classList.toggle("is-menu-open", isOpen);
    hamburger.classList.toggle("expanded", isOpen);
    hamburger.setAttribute("aria-expanded", String(isOpen));
    hamburger.setAttribute(
      "aria-label",
      isOpen ? "Zamknij menu" : "Otwórz menu",
    );
    mobileMenu.setAttribute("aria-hidden", String(!isOpen));
  };

  const handleNavClick = (event, { fromMobile = false } = {}) => {
    const hash = event.currentTarget.getAttribute("href");
    if (!hash?.startsWith("#") || hash === "#") return;
    if (!document.querySelector(hash)) return;

    event.preventDefault();

    if (fromMobile && header.classList.contains("is-menu-open")) {
      setMenuOpen(false);
    }

    scrollToHash(hash);
  };

  hamburger.addEventListener("click", () => {
    setMenuOpen(!header.classList.contains("is-menu-open"));
  });

  desktopLinks.forEach((link) => {
    link.addEventListener("click", (event) => handleNavClick(event));
  });

  mobileLinks.forEach((link) => {
    link.addEventListener("click", (event) =>
      handleNavClick(event, { fromMobile: true }),
    );
  });

  footerLinks.forEach((link) => {
    link.addEventListener("click", (event) => handleNavClick(event));
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && header.classList.contains("is-menu-open")) {
      setMenuOpen(false);
    }
  });

  window.addEventListener("resize", () => {
    if (
      window.matchMedia("(min-width: 1280px)").matches &&
      header.classList.contains("is-menu-open")
    ) {
      setMenuOpen(false);
    }
  });
});
