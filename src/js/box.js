document.addEventListener("DOMContentLoaded", initBox);

// Przykładowe wpłaty pokazywane w sekcji „kasa”: [kwota, firma, faktura].
const BOX_PAYMENTS = [
  [4920, "Agencja Kreatywna Sowa", "FV 2026/10/045"],
  [1845, "Studio Foto Migawka", "FV 2026/11/003"],
  [12300, "Biuro Projektowe Linia", "FV 2026/10/051"],
  [738, "Piekarnia Pod Kogutem", "FV 2026/11/007"],
  [6150, "Warsztat Rowerowy Szprycha", "FV 2026/11/002"],
  [2460, "Kwiaciarnia Zielony Kąt", "FV 2026/11/010"],
];

function initBox() {
  initBoxFilm();
  initBoxTill();
  initBoxSticky();
  initBoxMetaEvents();
}

// Film: dźwięk na żądanie.
function initBoxFilm() {
  const film = document.getElementById("box-film");
  const button = document.getElementById("box-film-sound");
  if (!film || !button) return;
  if (film.dataset.inited === "true") return;
  film.dataset.inited = "true";

  // Po przejściu Barby autoplay nie startuje sam.
  film.muted = true;
  film.play().catch(() => {});

  button.addEventListener("click", () => {
    film.muted = !film.muted;
    if (!film.muted) {
      film.currentTime = 0;
      film.play().catch(() => {});
    }
    if (!film.muted) boxTrack("Box_Film_Sound_On");
    button.setAttribute("aria-pressed", String(!film.muted));
    button.textContent = film.muted ? "Włącz dźwięk" : "Wycisz";
  });
}

// Kasa: wpłaty pokazują się same na ekranie konturowego Boxa; klik = kolejna z „ka-ching”.
function initBoxTill() {
  const till = document.getElementById("box-till");
  if (!till) return;
  if (till.dataset.inited === "true") return;
  till.dataset.inited = "true";

  const sum = document.getElementById("box-till-sum");
  const who = document.getElementById("box-till-who");
  const invoice = document.getElementById("box-till-invoice");
  const sound = new Audio(till.dataset.sound);
  sound.preload = "none";

  const formatZl = (value) =>
    `+${Math.round(value)
      .toString()
      .replace(/\B(?=(\d{3})+(?!\d))/g, " ")} zł`;

  let index = 0;
  let frame = 0;
  const confetti = createBoxConfetti(till.closest(".box-till"));

  let demoTracked = false;
  let timer = 0;
  const reducedMotion = () =>
    window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  // Kolejne powiadomienie na ekranie. byUser = kliknięcie: dźwięk i konfetti.
  const showPayment = (byUser) => {
    index = (index + 1) % BOX_PAYMENTS.length;
    const [amount, company, number] = BOX_PAYMENTS[index];

    if (byUser) {
      sound.currentTime = 0;
      sound.play().catch(() => {});
    }

    who.textContent = company;
    invoice.textContent = number;

    till.classList.remove("is-pop");
    void till.offsetWidth;
    till.classList.add("is-pop");

    cancelAnimationFrame(frame);
    if (reducedMotion()) {
      sum.textContent = formatZl(amount);
      return;
    }

    if (byUser) confetti(sum);

    const start = performance.now();
    const step = (now) => {
      // znacznik klatki bywa wcześniejszy niż start: bez Math.max kwota mignęłaby na minusie
      const progress = Math.min(1, Math.max(0, (now - start) / 700));
      const eased = 1 - Math.pow(1 - progress, 3);
      sum.textContent = formatZl(amount * eased);
      if (progress < 1) frame = requestAnimationFrame(step);
    };
    frame = requestAnimationFrame(step);
  };

  // Symulacja: gdy sekcja jest na ekranie, co kilka sekund przychodzi
  // kolejna wpłata (bez dźwięku). Przy ograniczonym ruchu tylko po kliknięciu.
  const AUTO_DELAY = 3800;
  const stopAuto = () => {
    clearInterval(timer);
    timer = 0;
  };
  const startAuto = () => {
    stopAuto();
    if (reducedMotion()) return;
    timer = setInterval(() => {
      // po przejściu Barby element znika z dokumentu
      if (!till.isConnected) return stopAuto();
      showPayment(false);
    }, AUTO_DELAY);
  };

  if ("IntersectionObserver" in window) {
    new IntersectionObserver(
      ([entry]) => (entry.isIntersecting ? startAuto() : stopAuto()),
      { threshold: 0.35 },
    ).observe(till);
  }

  till.addEventListener("click", () => {
    // jedno zdarzenie na odsłonę, kolejne kliknięcia to już zabawa
    if (!demoTracked) {
      demoTracked = true;
      boxTrack("Box_Demo_Click");
    }

    showPayment(true);
    // po kliknięciu odliczanie do następnej automatycznej wpłaty rusza od nowa
    if (timer) startAuto();
  });
}

// Konfetti po wpłacie: canvas na całą sekcję, wybuch spod kwoty.
const BOX_CONFETTI_COLORS = ["#4fd15f", "#75df3c", "#b4ec92", "#ffffff", "#f5a524"];

function createBoxConfetti(section) {
  if (!section) return () => {};

  const canvas = document.createElement("canvas");
  canvas.className = "box-till-confetti";
  canvas.setAttribute("aria-hidden", "true");
  section.appendChild(canvas);
  const ctx = canvas.getContext("2d");

  let pieces = [];
  let raf = 0;
  let last = 0;
  let width = 0;
  let height = 0;

  const resize = () => {
    const ratio = Math.min(window.devicePixelRatio || 1, 2);
    width = section.clientWidth;
    height = section.clientHeight;
    canvas.width = width * ratio;
    canvas.height = height * ratio;
    ctx.setTransform(ratio, 0, 0, ratio, 0, 0);
  };

  const tick = (now) => {
    const dt = Math.min(0.04, (now - last) / 1000);
    last = now;
    ctx.clearRect(0, 0, width, height);

    pieces = pieces.filter((p) => p.life < p.ttl && p.y < height + 40);
    pieces.forEach((p) => {
      p.life += dt;
      p.vx *= 1 - 1.6 * dt;
      p.vy = p.vy * (1 - 1.6 * dt) + 1500 * dt;
      p.x += p.vx * dt;
      p.y += p.vy * dt;
      p.angle += p.spin * dt;

      ctx.save();
      ctx.globalAlpha = Math.min(1, (p.ttl - p.life) / 0.5);
      ctx.translate(p.x, p.y);
      ctx.rotate(p.angle);
      // „obrót” wokół własnej osi: ściskanie w pionie
      ctx.scale(1, Math.cos(p.life * p.flip));
      ctx.fillStyle = p.color;
      if (p.round) {
        ctx.beginPath();
        ctx.arc(0, 0, p.size / 2, 0, Math.PI * 2);
        ctx.fill();
      } else {
        ctx.fillRect(-p.size / 2, -p.size / 4, p.size, p.size / 2);
      }
      ctx.restore();
    });

    if (pieces.length) {
      raf = requestAnimationFrame(tick);
    } else {
      raf = 0;
      ctx.clearRect(0, 0, width, height);
    }
  };

  return (origin) => {
    resize();
    const box = section.getBoundingClientRect();
    const from = origin.getBoundingClientRect();
    const x = from.left - box.left + from.width / 2;
    const y = from.top - box.top + from.height / 2;
    const power = Math.min(1, width / 900);
    const count = width < 600 ? 70 : 130;

    for (let i = 0; i < count; i++) {
      // wachlarz w górę: od -160° do -20°
      const direction = -Math.PI / 2 + (Math.random() - 0.5) * Math.PI * 0.78;
      const speed = (500 + Math.random() * 900) * (0.55 + 0.45 * power);
      pieces.push({
        x: x + (Math.random() - 0.5) * from.width * 0.5,
        y,
        vx: Math.cos(direction) * speed * 1.25,
        vy: Math.sin(direction) * speed,
        size: 7 + Math.random() * 8,
        angle: Math.random() * Math.PI * 2,
        spin: (Math.random() - 0.5) * 12,
        flip: 6 + Math.random() * 8,
        round: Math.random() < 0.25,
        color: BOX_CONFETTI_COLORS[i % BOX_CONFETTI_COLORS.length],
        life: 0,
        ttl: 1.6 + Math.random() * 1.2,
      });
    }

    if (!raf) {
      last = performance.now();
      raf = requestAnimationFrame(tick);
    }
  };
}

// Pasek zakupu na mobile: widoczny po przewinięciu hero, schowany przy
// sekcji „Kup” i przy stopce (tam są własne przyciski zamówienia).
function initBoxSticky() {
  const bar = document.getElementById("box-sticky");
  if (!bar || !("IntersectionObserver" in window)) return;
  if (bar.dataset.inited === "true") return;
  bar.dataset.inited = "true";

  const link = bar.querySelector("a");
  const targets = [
    document.querySelector(".box-hero"),
    document.getElementById("kup"),
    document.querySelector(".footer"),
  ].filter(Boolean);
  const inView = new Set();

  const update = () => {
    const visible = inView.size === 0;
    bar.classList.toggle("is-visible", visible);
    bar.setAttribute("aria-hidden", String(!visible));
    if (visible) link.removeAttribute("tabindex");
    else link.setAttribute("tabindex", "-1");
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) inView.add(entry.target);
      else inView.delete(entry.target);
    });
    update();
  });
  targets.forEach((target) => observer.observe(target));
}

// Meta Pixel (fbq ładuje header.php). Zdarzenia własne strony Box:
//   Box_Order_Click { placement }  klik „Zamów”: hero | kup | pasek | stopka
//   Box_Demo_Click                 pierwsze kliknięcie demo wpłaty
//   Box_Film_Sound_On              włączenie dźwięku filmu w hero
// Gdy „Zamów” prowadzi do sklepu (a nie do kotwicy #kup), idzie też
// standardowe InitiateCheckout.
function boxTrack(event, params, standard) {
  if (typeof fbq !== "function") return;
  fbq(standard ? "track" : "trackCustom", event, params || {});
}

function initBoxMetaEvents() {
  // delegacja na dokumencie: wystarczy raz, także po przejściach Barby
  if (initBoxMetaEvents.inited) return;
  initBoxMetaEvents.inited = true;

  document.addEventListener("click", (event) => {
    const link = event.target.closest("a[data-box-order]");
    if (!link) return;
    boxTrack("Box_Order_Click", { placement: link.dataset.boxOrder });
    if (!(link.getAttribute("href") || "").startsWith("#")) {
      boxTrack("InitiateCheckout", { content_name: "Doginvoice Box" }, true);
    }
  });
}
