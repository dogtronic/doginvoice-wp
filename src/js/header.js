function getNavOffset() {
  return window.matchMedia("(min-width: 1280px)").matches ? 180 : 170;
}

function getHomeUrl() {
  const url = new URL(
    document.querySelector(".site-header-nav-logo")?.getAttribute("href") ||
      "/",
    window.location.href,
  );
  url.hash = "";
  return `${url.pathname}${url.search}` || "/";
}

function parseHash(href) {
  if (!href) return "";
  try {
    const url = new URL(href, window.location.href);
    return url.hash && url.hash !== "#" ? url.hash : "";
  } catch {
    return href.startsWith("#") && href.length > 1 ? href : "";
  }
}

function stripHashFromUrl() {
  if (!window.location.hash) return;
  history.replaceState(
    null,
    "",
    window.location.pathname + window.location.search,
  );
}

function isHomePath(pathname) {
  const homePath =
    new URL(getHomeUrl(), window.location.href).pathname.replace(/\/+$/, "") ||
    "/";
  const path = (pathname || "/").replace(/\/+$/, "") || "/";
  return path === homePath;
}

function scrollToHash(hash, { behavior = "smooth" } = {}) {
  const target = document.querySelector(hash);
  if (!target) return false;

  const top =
    target.getBoundingClientRect().top + window.scrollY - getNavOffset();
  window.scrollTo({ top: Math.max(0, top), behavior });
  stripHashFromUrl();
  return true;
}

function leavesCurrentPage(link, event) {
  if (!link || event.button !== 0) return false;
  if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return false;
  if (link.target && link.target !== "_self") return false;
  if (link.hasAttribute("download")) return false;

  const href = link.getAttribute("href");
  if (!href) return false;

  let url;
  try {
    url = new URL(href, window.location.href);
  } catch {
    return false;
  }

  if (url.origin !== window.location.origin) return false;

  const hash = parseHash(href);
  const currentPath = window.location.pathname.replace(/\/+$/, "") || "/";
  const nextPath = url.pathname.replace(/\/+$/, "") || "/";
  const sameDocument =
    nextPath === currentPath && url.search === window.location.search;

  if (hash && (href.trim().startsWith("#") || isHomePath(url.pathname))) {
    return !isHomePath(currentPath);
  }

  return !sameDocument;
}

function goToHash(hash) {
  const header = document.querySelector(".site-header");
  const currentPath = window.location.pathname.replace(/\/+$/, "") || "/";

  if (isHomePath(currentPath) && header?.classList.contains("is-menu-open")) {
    setMenuOpen(false);
  }

  if (scrollToHash(hash, { behavior: "smooth" })) return;

  window.__pendingSectionHash = hash;
  stripHashFromUrl();

  const homeUrl = getHomeUrl();

  if (isHomePath(currentPath)) {
    window.__pendingSectionHash = "";
    return;
  }

  if (typeof barba !== "undefined" && typeof barba.go === "function") {
    barba.go(homeUrl);
    return;
  }

  sessionStorage.setItem("doginvoice-scroll-to", hash);
  window.location.assign(homeUrl);
}

function scrollToPendingSection({ behavior = "auto", clear = false } = {}) {
  const hash = window.__pendingSectionHash;
  if (!hash) return false;

  const scrolled = scrollToHash(hash, { behavior });
  if (clear) window.__pendingSectionHash = "";
  return scrolled;
}

function setMenuOpen(isOpen) {
  const header = document.querySelector(".site-header");
  const hamburger = document.querySelector(".site-header-nav-hamburger");
  const mobileMenu = document.getElementById("site-header-mobile");
  if (!header || !hamburger || !mobileMenu) return;

  header.classList.toggle("is-menu-open", isOpen);
  document.body.classList.toggle("is-menu-open", isOpen);
  hamburger.classList.toggle("expanded", isOpen);
  hamburger.setAttribute("aria-expanded", String(isOpen));
  hamburger.setAttribute("aria-label", isOpen ? "Zamknij menu" : "Otwórz menu");
  mobileMenu.setAttribute("aria-hidden", String(!isOpen));
}

function handleMobileNavClick(event) {
  const link = event.target.closest("#site-header-mobile a[href]");
  if (!link) return;
  if (leavesCurrentPage(link, event)) return;
  setMenuOpen(false);
}

function handleHashLinkClick(event) {
  if (event.defaultPrevented) return;
  if (event.button !== 0) return;
  if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;

  const link = event.target.closest("a[href]");
  if (!link) return;
  if (link.target && link.target !== "_self") return;
  if (link.hasAttribute("download")) return;
  if (link.closest(".blog-toc")) return;

  const href = link.getAttribute("href");
  const hash = parseHash(href);
  if (!hash) return;

  let url;
  try {
    url = new URL(href, window.location.href);
  } catch {
    return;
  }

  if (url.origin !== window.location.origin) return;

  const hashOnly = href.trim().startsWith("#");
  if (!hashOnly && !isHomePath(url.pathname)) return;

  event.preventDefault();
  event.stopImmediatePropagation();
  goToHash(hash);
}

function consumeInitialHash() {
  const stored = sessionStorage.getItem("doginvoice-scroll-to");
  if (stored) sessionStorage.removeItem("doginvoice-scroll-to");

  const hash =
    stored || (window.location.hash !== "#" ? window.location.hash : "");
  if (!hash) return;

  stripHashFromUrl();
  window.__pendingSectionHash = hash;
  requestAnimationFrame(() => {
    scrollToPendingSection({ behavior: "auto", clear: true });
  });
}

function initHeader() {
  const header = document.querySelector(".site-header");
  const hamburger = document.querySelector(".site-header-nav-hamburger");
  const mobileMenu = document.getElementById("site-header-mobile");

  if (!header || !hamburger || !mobileMenu) return;
  if (header.dataset.inited === "true") return;
  header.dataset.inited = "true";

  hamburger.addEventListener("click", () => {
    setMenuOpen(!header.classList.contains("is-menu-open"));
  });

  document.addEventListener("click", handleMobileNavClick, true);
  document.addEventListener("click", handleHashLinkClick, true);

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
}

document.addEventListener("DOMContentLoaded", () => {
  initHeader();
  consumeInitialHash();
});
