function initPartnerMetaEvents() {
  if (initPartnerMetaEvents.inited) return;
  if (typeof fbq !== "function") return;
  initPartnerMetaEvents.inited = true;

  document.addEventListener("wpcf7mailsent", () => {
    fbq("track", "Lead");
  });

  document.addEventListener("click", (event) => {
    const link = event.target.closest('a[href*="calendar.app.google"]');
    if (link) fbq("track", "Schedule");
  });
}

document.addEventListener("DOMContentLoaded", initPartnerMetaEvents);
