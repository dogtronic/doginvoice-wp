document.addEventListener("DOMContentLoaded", () => {
  initPartnerCalculator();
});

// Stawki w jednym miejscu. Źródło: DECISIONS.md D21 (Marek, 10.08.2026).
const PARTNER_RATE = 0.5; // prowizja partnera od kwoty faktycznie zapłaconej
const PARTNER_DISCOUNT = 0.5; // zniżka klienta na pierwszy okres rozliczeniowy

function initPartnerCalculator() {
  const slider = document.getElementById("partner-calc-clients");
  if (!slider) return;

  const sliderValue = document.getElementById("partner-calc-clients-value");
  const outMonth = document.getElementById("partner-calc-month");
  const outYear = document.getElementById("partner-calc-year");
  const planButtons = [
    ...document.querySelectorAll(".partner-calc-plan-toggle-button"),
  ];

  let price = Number(
    planButtons.find((btn) => btn.getAttribute("aria-pressed") === "true")
      ?.dataset.price || 149,
  );

  const formatZl = (value) =>
    `${Math.round(value)
      .toString()
      .replace(/\B(?=(\d{3})+(?!\d))/g, " ")} zł`;

  const calculate = () => {
    const clients = parseInt(slider.value, 10);
    const base = clients * price; // łączny abonament miesięczny poleconych
    const monthFull = base * PARTNER_RATE; // prowizja od pełnej ceny
    const monthFirst = base * (1 - PARTNER_DISCOUNT) * PARTNER_RATE; // pierwszy miesiąc, klient ze zniżką
    const year = monthFirst + monthFull * 11; // rok przy rozliczeniu miesięcznym

    if (sliderValue) sliderValue.textContent = String(clients);
    if (outMonth) outMonth.textContent = formatZl(monthFull);
    if (outYear) outYear.textContent = formatZl(year);
  };

  slider.addEventListener("input", calculate);

  planButtons.forEach((button) => {
    button.addEventListener("click", () => {
      planButtons.forEach((btn) => btn.setAttribute("aria-pressed", "false"));
      button.setAttribute("aria-pressed", "true");
      price = Number(button.dataset.price);
      calculate();
    });
  });

  calculate();
}
