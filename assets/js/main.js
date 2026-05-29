/* Vitrinexo — main.js */
(function () {
  'use strict';

  // ── Badge de notificaciones ──────────────────────────────────────────────────

  const badge = document.getElementById('vx-notif-badge');
  if (badge && typeof vx_data !== 'undefined' && vx_data.user_id) {
    fetch(vx_data.api_url + 'notificaciones/unread-count', {
      headers: { 'X-WP-Nonce': vx_data.nonce },
    })
      .then(r => r.json())
      .then(json => {
        if (json.success && json.count > 0) {
          badge.classList.remove('d-none');
          badge.dataset.count = json.count;
        } else {
          badge.classList.add('d-none');
        }
      })
      .catch(() => {});
  }

  // ── Favoritos (cards del directorio) ─────────────────────────────────────────

  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.vx-fav-btn');
    if (!btn) return;
    if (!vx_data || !vx_data.user_id) {
      window.location.href = vx_data.api_url.replace('/wp-json/vitrinexo/v1/', '') + '/login/';
      return;
    }

    const userId = btn.dataset.userId;
    const activo = btn.dataset.activo === '1';
    const method = activo ? 'DELETE' : 'POST';

    fetch(vx_data.api_url + 'favoritos/' + userId, {
      method,
      headers: { 'X-WP-Nonce': vx_data.nonce },
    })
      .then(r => r.json())
      .then(json => {
        if (json.success) {
          btn.dataset.activo = activo ? '0' : '1';
          const icon = btn.querySelector('i');
          if (icon) {
            icon.classList.toggle('ti-heart', activo);
            icon.classList.toggle('ti-heart-filled', !activo);
          }
          btn.classList.toggle('vx-fav-btn--active', !activo);
        }
      })
      .catch(() => {});
  });

  // ── Modal conectar — rellenar datos del receptor ─────────────────────────────

  const modalConectar = document.getElementById('modalConectar');
  if (modalConectar) {
    modalConectar.addEventListener('show.bs.modal', function (event) {
      const trigger = event.relatedTarget;
      if (!trigger) return;

      const nombre  = trigger.dataset.receptorNombre  || '';
      const empresa = trigger.dataset.receptorEmpresa || '';
      const id      = trigger.dataset.userId           || trigger.dataset.receptorId || '';

      const elNombre  = modalConectar.querySelector('#modal-receptor-nombre');
      const elEmpresa = modalConectar.querySelector('#modal-receptor-empresa');
      const elId      = modalConectar.querySelector('#modal-receptor-id');
      const elSuccess = modalConectar.querySelector('#modal-receptor-nombre-success');

      if (elNombre)  elNombre.textContent  = nombre  || 'esta persona';
      if (elEmpresa) elEmpresa.textContent = empresa;
      if (elId)      elId.value            = id;
      if (elSuccess) elSuccess.textContent = nombre  || 'La persona';

      // Reset form/success state
      const form = document.getElementById('form-conectar');
      const succ = document.getElementById('modal-success');
      if (form) form.style.display = '';
      if (succ) succ.style.display = 'none';
    });

    // Empresa selector checkboxes
    modalConectar.querySelectorAll('.modal-empresa-option').forEach(function (opt) {
      opt.addEventListener('click', function () {
        const card     = opt.querySelector('.modal-empresa-card');
        const check    = opt.querySelector('.modal-empresa-check');
        const checkbox = opt.querySelector('input[type="checkbox"]');
        checkbox.checked = !checkbox.checked;
        card.classList.toggle('modal-empresa-card--selected', checkbox.checked);
        if (checkbox.checked) {
          check.classList.remove('ti-circle');
          check.classList.add('ti-circle-check');
        } else {
          check.classList.remove('ti-circle-check');
          check.classList.add('ti-circle');
        }
      });
    });
  }

  // ── Modal conectar — envío del formulario ─────────────────────────────────────

  const formConectar = document.getElementById('form-conectar');
  if (formConectar) {
    formConectar.addEventListener('submit', async function (e) {
      e.preventDefault();
      const btn      = document.getElementById('btn-enviar-conexion');
      const errDiv   = document.getElementById('form-conectar-error');
      const successEl = document.getElementById('modal-success');

      btn.disabled    = true;
      btn.textContent = 'Enviando...';
      if (errDiv) { errDiv.classList.add('d-none'); errDiv.textContent = ''; }

      const receptorId = formConectar.querySelector('[name="receptor_id"]')?.value;
      const pitch      = formConectar.querySelector('[name="pitch"]')?.value;
      const empresaBoxes = formConectar.querySelectorAll('[name="empresas[]"]:checked');
      const empresas   = Array.from(empresaBoxes).map(cb => cb.value);

      try {
        const res  = await fetch(vx_data.api_url + 'conexiones', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': vx_data.nonce,
          },
          body: JSON.stringify({ receptor_id: parseInt(receptorId, 10), pitch, empresas }),
        });
        const json = await res.json();

        if (json.success) {
          formConectar.style.display = 'none';
          if (successEl) successEl.style.display = '';
        } else {
          const msgs = {
            no_autoconexion:     'No puedes conectarte contigo mismo.',
            pitch_muy_corto:     'El mensaje debe tener al menos 20 caracteres.',
            conexion_pendiente:  'Ya tienes una solicitud pendiente con esta persona.',
          };
          if (errDiv) {
            errDiv.textContent = msgs[json.error] || 'Error al enviar la solicitud.';
            errDiv.classList.remove('d-none');
          }
          btn.disabled    = false;
          btn.textContent = 'Enviar solicitud de conexión';
        }
      } catch {
        if (errDiv) {
          errDiv.textContent = 'Error de conexión. Intenta más tarde.';
          errDiv.classList.remove('d-none');
        }
        btn.disabled    = false;
        btn.textContent = 'Enviar solicitud de conexión';
      }
    });
  }

  // ── 4Dinner — botón de interés ───────────────────────────────────────────────

  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.vx-dinner-interes-btn');
    if (!btn) return;
    if (!vx_data || !vx_data.user_id) return;

    const dinnerId = btn.dataset.dinnerId;
    const activo   = btn.dataset.activo === '1';
    const method   = activo ? 'DELETE' : 'POST';

    btn.disabled = true;

    fetch(vx_data.api_url + 'dinners/' + dinnerId + '/interes', {
      method,
      headers: { 'X-WP-Nonce': vx_data.nonce },
    })
      .then(r => r.json())
      .then(json => {
        if (json.success) {
          btn.dataset.activo = activo ? '0' : '1';
          btn.textContent    = activo ? 'Me interesa' : 'Quitar interés';
          btn.classList.toggle('vx-dinner-interes-btn--active', !activo);
        }
        btn.disabled = false;
      })
      .catch(() => { btn.disabled = false; });
  });

  // ── Solicitar verificación Senior ───────────────────────────────────────────

  const btnSenior = document.getElementById('vx-solicitar-senior');
  if (btnSenior) {
    btnSenior.addEventListener('click', async function () {
      btnSenior.disabled = true;
      btnSenior.textContent = 'Enviando solicitud...';
      try {
        const res  = await fetch(vx_data.api_url + 'comunidades/solicitar-senior', {
          method: 'POST',
          headers: { 'X-WP-Nonce': vx_data.nonce },
        });
        const json = await res.json();
        if (json.success) {
          btnSenior.textContent = 'Solicitud enviada';
        } else {
          btnSenior.disabled = false;
          btnSenior.textContent = 'Solicitar verificación Senior';
        }
      } catch {
        btnSenior.disabled = false;
        btnSenior.textContent = 'Solicitar verificación Senior';
      }
    });
  }

  // ── Recuperar contraseña ──────────────────────────────────────────────────────

  const recuperarForm = document.getElementById('vx-recuperar-form');
  if (recuperarForm) {
    recuperarForm.addEventListener('submit', async function (e) {
      e.preventDefault();
      const btn = recuperarForm.querySelector('[type="submit"]');
      const msg = document.getElementById('vx-recuperar-msg');
      btn.disabled = true;
      msg.classList.add('d-none');

      const email = recuperarForm.querySelector('[name="email"]').value;
      const ajaxUrl = vx_data.api_url.replace('/wp-json/vitrinexo/v1/', '/wp-admin/admin-ajax.php');
      const formData = new FormData();
      formData.append('action', 'vx_reset_password');
      formData.append('email', email);
      formData.append('nonce', vx_data.nonce);

      try {
        await fetch(ajaxUrl, { method: 'POST', body: formData });
        msg.textContent = 'Si existe una cuenta con ese correo, recibirás el enlace en breve.';
        msg.className = 'vx-alert vx-alert--success';
        msg.classList.remove('d-none');
      } catch {
        msg.textContent = 'Error de conexión. Intenta más tarde.';
        msg.className = 'vx-alert vx-alert--error';
        msg.classList.remove('d-none');
      }
      btn.disabled = false;
      btn.textContent = 'Enviar enlace';
    });
  }

})();
