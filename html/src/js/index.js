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

document.addEventListener("DOMContentLoaded", () => {
  AOS.init({
    duration: 700,
    once: true,
    easing: "ease",
    anchorPlacement: "top-bottom",
  });
  removeOrphans();
});
