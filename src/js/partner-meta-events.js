document.addEventListener("DOMContentLoaded", () => {
  if (typeof fbq !== "function") return;

  document.addEventListener("wpcf7mailsent", () => {
    fbq("track", "Lead");
  });

  document.addEventListener("click", (event) => {
    const link = event.target.closest('a[href*="calendar.app.google"]');
    if (link) fbq("track", "Schedule");
  });
});
