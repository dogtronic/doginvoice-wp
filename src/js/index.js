// Remove orphans
function removeOrphans() {
  Array.prototype.forEach.call(
    document.querySelectorAll("[data-remove-orphans]"),
    function (el, i) {
      // Funkcja rekurencyjna do przetwarzania węzłów tekstowych
      function processTextNodes(node) {
        if (node.nodeType === Node.TEXT_NODE) {
          // Zastosuj logikę usuwania sierot tylko do treści tekstowej
          const text = node.textContent;
          const processedText = text.replace(
            /(\s)([^<>\/\s]{1,3})[\s]+/g,
            "$1$2\u00A0",
          );
          if (text !== processedText) {
            node.textContent = processedText;
          }
        } else if (node.nodeType === Node.ELEMENT_NODE) {
          // Rekurencyjnie przetwórz wszystkie węzły potomne
          Array.from(node.childNodes).forEach(processTextNodes);
        }
      }

      // Przetwórz wszystkie węzły potomne kontenera
      Array.from(el.childNodes).forEach(processTextNodes);
    },
  );
}

function initIndex() {
  if (typeof AOS !== "undefined") {
    AOS.init({
      duration: 700,
      once: true,
      easing: "ease",
      anchorPlacement: "top-bottom",
    });
    AOS.refreshHard();
  }
  removeOrphans();
  initPlayInView();
}

// Filmy z atrybutem data-play-in-view (np. sekcja „Film” na landingach):
// start, gdy film pojawi się na ekranie, pauza, gdy z niego zniknie.
// Przy ograniczonych animacjach film czeka na kliknięcie „odtwórz”.
function initPlayInView() {
  const videos = document.querySelectorAll("video[data-play-in-view]");
  if (
    !videos.length ||
    !("IntersectionObserver" in window) ||
    window.matchMedia("(prefers-reduced-motion: reduce)").matches
  ) {
    return;
  }

  const observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        const video = entry.target;
        if (entry.isIntersecting) {
          const playing = video.play();
          if (playing && typeof playing.catch === "function") {
            playing.catch(function () {});
          }
        } else {
          video.pause();
        }
      });
    },
    { threshold: 0.4 },
  );

  videos.forEach(function (video) {
    observer.observe(video);
  });
}

document.addEventListener("DOMContentLoaded", initIndex);
