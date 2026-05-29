<?php
/*
 * Template Name: Perfil
 */
if ( ! defined( 'ABSPATH' ) ) exit;
$perfil_slug = get_query_var( 'vx_perfil_slug' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'vx-page-perfil' ); ?>>
<?php get_template_part( 'partials/nav-logged' ); ?>
<main>
  <?php echo do_shortcode( '[vx_perfil]' ); ?>
</main>
<?php get_template_part( 'partials/footer-logged' ); ?>

<script>
(function() {
  // Modal conectar — empresa selector
  const modal = document.getElementById('modalConectar');
  if (modal) {
    modal.querySelectorAll('.modal-empresa-option').forEach(function(opt) {
      opt.addEventListener('click', function() {
        const card = opt.querySelector('.modal-empresa-card');
        const check = opt.querySelector('.modal-empresa-check');
        const checkbox = opt.querySelector('input[type="checkbox"]');
        checkbox.checked = !checkbox.checked;
        if (checkbox.checked) {
          card.classList.add('modal-empresa-card--selected');
          check.classList.replace('ti-circle', 'ti-circle-check');
        } else {
          card.classList.remove('modal-empresa-card--selected');
          check.classList.replace('ti-circle-check', 'ti-circle');
        }
      });
    });
  }

  // Envío de conexión
  const formConectar = document.getElementById('form-conectar');
  if (formConectar) {
    formConectar.addEventListener('submit', async function(e) {
      e.preventDefault();
      const btn = document.getElementById('btn-enviar-conexion');
      const errDiv = document.getElementById('form-conectar-error');
      btn.disabled = true;
      errDiv.classList.add('d-none');

      const fd = new FormData(this);
      const empresas = [...fd.getAll('empresas[]')].map(Number).filter(Boolean);
      const body = {
        receptor_id: parseInt(document.getElementById('modal-receptor-id').value),
        pitch: fd.get('pitch'),
        empresas,
      };

      try {
        const res = await fetch(vx_data.api_url + 'conexiones', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': vx_data.nonce },
          body: JSON.stringify(body),
        });
        const json = await res.json();
        if (json.success) {
          formConectar.style.display = 'none';
          document.getElementById('modal-success').style.display = '';
        } else {
          const msgs = {
            conexion_pendiente: 'Ya tienes una solicitud pendiente con esta persona.',
            ya_conectados: 'Ya están conectados.',
          };
          errDiv.textContent = msgs[json.error] || 'No se pudo enviar la solicitud.';
          errDiv.classList.remove('d-none');
          btn.disabled = false;
        }
      } catch {
        errDiv.textContent = 'Error de conexión.';
        errDiv.classList.remove('d-none');
        btn.disabled = false;
      }
    });
  }

  // Botón favorito en perfil
  const favBtn = document.getElementById('vx-btn-favorito');
  if (favBtn) {
    favBtn.addEventListener('click', async function() {
      const userId = favBtn.dataset.userId;
      const activo = favBtn.dataset.activo === '1';
      const method = activo ? 'DELETE' : 'POST';
      try {
        const res = await fetch(vx_data.api_url + 'favoritos/' + userId, {
          method,
          headers: { 'X-WP-Nonce': vx_data.nonce },
        });
        const json = await res.json();
        if (json.success) {
          favBtn.dataset.activo = activo ? '0' : '1';
          const icon = favBtn.querySelector('i');
          if (activo) {
            icon.classList.replace('ti-heart-filled', 'ti-heart');
            favBtn.classList.remove('btn-vx--icon--active');
          } else {
            icon.classList.replace('ti-heart', 'ti-heart-filled');
            favBtn.classList.add('btn-vx--icon--active');
          }
        }
      } catch {}
    });
  }
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
