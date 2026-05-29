<?php
/*
 * Template Name: Editar perfil
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'vx-page-editor-perfil' ); ?>>
<?php get_template_part( 'partials/nav-logged' ); ?>
<main>
  <?php the_content(); ?>
</main>
<?php get_template_part( 'partials/footer-logged' ); ?>

<script>
(function() {
  // Editor de perfil — guardar via REST
  const form = document.getElementById('vx-editor-form');
  if (!form) return;

  form.addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = form.querySelector('[type="submit"]');
    const msg = document.getElementById('vx-editor-msg');
    btn.disabled = true;
    btn.textContent = 'Guardando...';
    msg.classList.add('d-none');

    const fd = new FormData(form);
    const offer_tags = window._vxOfferTags || [];
    const seek_tags  = window._vxSeekTags  || [];

    const body = {
      paso: 2,
      datos: {
        nombre:             fd.get('nombre'),
        apellido:           fd.get('apellido'),
        bio:                fd.get('bio'),
        ciudad:             fd.get('ciudad'),
        pais:               fd.get('pais'),
        contacto_preferido: fd.get('contacto_preferido'),
        telefono:           fd.get('telefono'),
        linkedin:           fd.get('linkedin'),
      },
      partial: false,
    };

    // Save personal data (step 2)
    try {
      let res = await fetch(vx_data.api_url + 'onboarding/paso', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': vx_data.nonce },
        body: JSON.stringify(body),
      });
      let json = await res.json();
      if (!json.success) throw new Error(json.error);

      // Save tags (step 4)
      const tagsBody = {
        paso: 4,
        datos: {
          offer_tags,
          seek_tags,
          offer_texto: fd.get('offer_texto'),
          seek_texto:  fd.get('seek_texto'),
        },
        partial: false,
      };
      res = await fetch(vx_data.api_url + 'onboarding/paso', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': vx_data.nonce },
        body: JSON.stringify(tagsBody),
      });
      json = await res.json();
      if (!json.success) throw new Error(json.error);

      // Save company (step 3) if fields present
      if (fd.get('nombre_empresa')) {
        const empBody = {
          paso: 3,
          datos: {
            nombre_empresa: fd.get('nombre_empresa'),
            sector:         fd.get('sector'),
            descripcion:    fd.get('descripcion'),
          },
          partial: false,
        };
        await fetch(vx_data.api_url + 'onboarding/paso', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': vx_data.nonce },
          body: JSON.stringify(empBody),
        });
      }

      msg.textContent = 'Cambios guardados correctamente.';
      msg.className = 'vx-alert vx-alert--success mb-3';
      msg.classList.remove('d-none');
    } catch {
      msg.textContent = 'Error al guardar los cambios.';
      msg.className = 'vx-alert vx-alert--error mb-3';
      msg.classList.remove('d-none');
    }

    btn.disabled = false;
    btn.textContent = 'Guardar cambios';
  });
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
