/* Vitrinexo — editor-perfil.js
   Preview de imagen al seleccionar archivo en editor de perfil.
*/
(function () {
  'use strict';

  // ── Upload preview ───────────────────────────────────────────────────────────

  async function handleUpload(input) {
    const file = input.files[0];
    if (!file) return;

    const tipo      = input.dataset.uploadType;
    const empresaId = input.dataset.empresaId || null;
    const previewId = { foto: 'vx-foto-preview', logo: 'vx-logo-preview', banner: 'vx-banner-preview' }[tipo];
    const previewEl = previewId ? document.getElementById(previewId) : null;

    // Show optimistic preview (only for elements managed by this file)
    if (previewEl) {
      const reader = new FileReader();
      reader.onload = function (e) {
        let img = previewEl.querySelector('img');
        if (!img) {
          img = document.createElement('img');
          img.className = 'vx-img-upload__img';
          previewEl.appendChild(img);
        }
        img.src = e.target.result;
        img.classList.remove('d-none');
        const placeholder = previewEl.querySelector('i');
        if (placeholder) placeholder.classList.add('d-none');
      };
      reader.readAsDataURL(file);
    }

    // Upload to server
    const formData = new FormData();
    formData.append('file', file);
    formData.append('tipo', tipo);
    if (empresaId) formData.append('contexto', empresaId);

    try {
      const res  = await fetch(vx_data.api_url + 'upload', {
        method: 'POST',
        headers: { 'X-WP-Nonce': vx_data.nonce },
        body: formData,
      });
      const json = await res.json();
      if (!json.success) {
        console.warn('Upload failed:', json.error);
      }
    } catch (err) {
      console.warn('Upload error:', err);
    }
  }

  document.querySelectorAll('input[data-upload-type]').forEach(input => {
    input.addEventListener('change', () => handleUpload(input));
  });

  // ── Tag inputs ───────────────────────────────────────────────────────────────

  document.querySelectorAll('.vx-tags-input').forEach(el => {
    if (el.dataset.initialized) return;
    el.dataset.initialized = '1';

    const field = el.dataset.field;
    const max   = parseInt(el.dataset.max, 10) || 5;
    let tags    = [];

    try {
      if (el.dataset.value) tags = JSON.parse(el.dataset.value);
    } catch {}

    const input = document.createElement('input');
    input.type  = 'text';
    input.placeholder = 'Escribir y Enter...';
    input.className   = 'vx-tags-input__field';

    function render() {
      el.innerHTML = '';
      tags.forEach(tag => {
        const chip = document.createElement('span');
        chip.className = 'vx-tag-chip';
        chip.innerHTML = `<span>${tag}</span><button type="button" class="vx-tag-chip__remove" data-tag="${tag}">×</button>`;
        el.appendChild(chip);
      });
      if (tags.length < max) el.appendChild(input);
      if (field === 'offer_tags') window._vxOfferTags = [...tags];
      if (field === 'seek_tags')  window._vxSeekTags  = [...tags];
    }

    el.addEventListener('click', e => {
      const rm = e.target.closest('.vx-tag-chip__remove');
      if (rm) { tags = tags.filter(t => t !== rm.dataset.tag); render(); }
    });

    input.addEventListener('keydown', e => {
      if (['Enter', ',', 'Tab'].includes(e.key)) {
        e.preventDefault();
        const val = input.value.trim().toLowerCase();
        if (val && !tags.includes(val) && tags.length < max) { tags.push(val); render(); }
        input.value = '';
      }
    });

    render();
  });

})();
