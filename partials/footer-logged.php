<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<footer class="footer-vx footer-vx--logged">
  <div class="container">
    <div class="footer-vx__top">
      <a href="<?php echo esc_url( home_url( '/dashboard/' ) ); ?>" class="footer-vx__brand" aria-label="Ir al dashboard">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/vitrinexo.svg' ); ?>" alt="Vitrinexo">
      </a>
      <a href="<?php echo esc_url( home_url( '/editar-perfil/' ) ); ?>" class="btn-vx btn-soft-primary btn-vx-sm">
        <i class="ti ti-pencil"></i> Editar perfil
      </a>
    </div>
    <div class="footer-vx__grid">
      <div>
        <p class="footer-vx__text">Sigue construyendo tu vitrina, guardando nexos relevantes y activando nuevas conversaciones B2B.</p>
        <a class="footer-vx__contact" href="mailto:hola@vitrinexo.com">
          <i class="ti ti-mail"></i> hola@vitrinexo.com
        </a>
      </div>
      <nav class="footer-vx__nav" aria-label="Explorar">
        <span class="footer-vx__label">Explorar</span>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/directorio/' ) ); ?>">Directorio</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/matches/' ) ); ?>">Mis matches</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/favoritos/' ) ); ?>">Mis favoritos</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/4dinner/' ) ); ?>">4Dinner</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
      </nav>
      <nav class="footer-vx__nav" aria-label="Comunidades">
        <span class="footer-vx__label">Comunidades</span>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/comunidad-out2b/' ) ); ?>">Out2B</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/comunidad-woman/' ) ); ?>">Woman</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/comunidad-senior/' ) ); ?>">Senior</a>
      </nav>
      <nav class="footer-vx__nav" aria-label="Mi cuenta">
        <span class="footer-vx__label">Mi cuenta</span>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/dashboard/' ) ); ?>">Dashboard</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/perfil/' ) ); ?>">Mi perfil</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/conexiones/' ) ); ?>">Mis conexiones</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/notificaciones/' ) ); ?>">Notificaciones</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/configuracion/' ) ); ?>">Configuración</a>
        <a class="footer-vx__link" href="<?php echo esc_url( wp_logout_url( home_url( '/login/' ) ) ); ?>">Cerrar sesión</a>
      </nav>
    </div>
    <div class="footer-vx__bottom">
      <span>© <?php echo date( 'Y' ); ?> Vitrinexo SpA</span>
      <span>Vitrinea, conecta y colabora.</span>
    </div>
  </div>
</footer>
