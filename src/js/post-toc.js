document.addEventListener("DOMContentLoaded", () => {
  const toc = document.querySelector(".blog-toc");
  if (!toc) return;

  const panel = toc.querySelector(".blog-toc-panel");
  const links = [...toc.querySelectorAll('a[href^="#"]')];
  const headings = links
    .map((link) => document.getElementById(link.getAttribute("href").slice(1)))
    .filter(Boolean);

  if (!headings.length) return;

  const offset = () => {
    const value = parseFloat(getComputedStyle(headings[0]).scrollMarginTop);
    return Number.isFinite(value) ? value : 120;
  };

  const setActive = (id) => {
    links.forEach((link) => {
      const active = link.getAttribute("href") === `#${id}`;
      link.classList.toggle("is-active", active);
      if (active) link.setAttribute("aria-current", "location");
      else link.removeAttribute("aria-current");
    });
  };

  // Nagłówek, który właśnie minął linię scrolla (tę samą co scroll-margin).
  const headingAtLine = () => {
    const line = offset() + 2;
    let current = headings[0];

    headings.forEach((heading) => {
      if (heading.getBoundingClientRect().top <= line) current = heading;
    });

    return current;
  };

  let lockedId = null;
  let frame = 0;
  let releaseTimer = 0;

  const sync = () => {
    const current = headingAtLine();
    if (current) setActive(current.id);
  };

  const armRelease = (delay) => {
    window.clearTimeout(releaseTimer);
    releaseTimer = window.setTimeout(() => {
      lockedId = null;
      sync();
    }, delay);
  };

  window.addEventListener(
    "scroll",
    () => {
      if (lockedId) {
        armRelease(140);
        return;
      }

      window.cancelAnimationFrame(frame);
      frame = window.requestAnimationFrame(sync);
    },
    { passive: true }
  );

  links.forEach((link) => {
    link.addEventListener("click", (event) => {
      const id = link.getAttribute("href").slice(1);
      const target = document.getElementById(id);
      if (!target) return;

      event.preventDefault();
      lockedId = id;
      setActive(id);
      history.pushState(null, "", `#${id}`);

      const reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
      target.scrollIntoView({
        behavior: reduced ? "auto" : "smooth",
        block: "start",
      });
      armRelease(reduced ? 50 : 160);

      if (panel && window.matchMedia("(max-width: 1023px)").matches) {
        panel.removeAttribute("open");
      }
    });
  });

  sync();
  window.addEventListener("load", sync);
});
