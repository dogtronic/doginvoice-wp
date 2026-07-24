(() => {
  const modal = document.querySelector(".demo-modal");
  const dialog = modal?.querySelector(".demo-modal-dialog");
  const iframe = modal?.querySelector("[data-demo-modal-iframe]");
  const openTriggers = document.querySelectorAll("[data-demo-modal-open]");
  const closeTriggers = document.querySelectorAll("[data-demo-modal-close]");
  const backdrop = document.querySelector(".demo-modal-backdrop");

  if (!modal || !iframe) return;

  const videoSrc = iframe.getAttribute("data-src") || "";

  const openModal = () => {
    if (videoSrc) iframe.src = videoSrc;
    modal.classList.add("is-open");
    modal.setAttribute("aria-hidden", "false");
    document.documentElement.classList.add("is-demo-modal-open");
    modal.querySelector(".demo-modal-close")?.focus({ preventScroll: true });
  };

  const closeModal = () => {
    modal.classList.remove("is-open");
    modal.setAttribute("aria-hidden", "true");
    document.documentElement.classList.remove("is-demo-modal-open");
    iframe.removeAttribute("src");
  };

  openTriggers.forEach((trigger) => {
    trigger.addEventListener("click", (event) => {
      event.preventDefault();
      openModal();
    });
  });

  closeTriggers.forEach((trigger) => {
    trigger.addEventListener("click", closeModal);
  });

  backdrop?.addEventListener("click", closeModal);

  modal.addEventListener("click", (event) => {
    if (event.target === modal) closeModal();
  });

  dialog?.addEventListener("click", (event) => {
    event.stopPropagation();
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && modal.classList.contains("is-open")) {
      closeModal();
    }
  });
})();
