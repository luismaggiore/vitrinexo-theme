/* Vitrinexo — directorio.js
   Maneja solo los filter chips y la búsqueda en tiempo real.
   Los filtros de país/comunidad/fundador son reload-based via form submit.
*/
(function () {
  'use strict';

  // ── Búsqueda en tiempo real ──────────────────────────────────────────────────

  const searchInput = document.getElementById('vx-search-input');
  const searchBtn   = document.getElementById('vx-search-btn');
  const grid        = document.getElementById('vx-members-grid');

  if (searchInput && searchBtn) {
    function doSearch() {
      const q = searchInput.value.trim();
      if (q.length < 2) return;
      const base = window.location.origin + '/busqueda/';
      window.location.href = base + '?q=' + encodeURIComponent(q);
    }

    searchBtn.addEventListener('click', doSearch);
    searchInput.addEventListener('keydown', function (e) {
      if (e.key === 'Enter') doSearch();
    });
  }

})();
