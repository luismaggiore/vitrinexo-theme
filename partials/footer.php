<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Read footer.html equivalent from source
?>
<footer class="footer-vx">
  <div class="container">
    <div class="footer-vx__top">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-vx__brand" aria-label="Ir al inicio">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/vitrinexo.svg' ); ?>" alt="Vitrinexo">
      </a>
      <a href="<?php echo esc_url( home_url( '/login/?tab=registro' ) ); ?>" class="btn-vx btn-primary-vx btn-vx-sm">Únete gratis →</a>
    </div>
    <div class="footer-vx__grid">
      <div>
        <p class="footer-vx__text">Directorio B2B hispanohablante de empresarios verificados. Conecta, colabora y crece.</p>
        <a class="footer-vx__contact" href="mailto:hola@vitrinexo.com">
          <i class="ti ti-mail"></i> hola@vitrinexo.com
        </a>
      </div>
      <nav class="footer-vx__nav" aria-label="Plataforma">
        <span class="footer-vx__label">Plataforma</span>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/' ) ); ?>">Qué es Vitrinexo</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/4dinner/' ) ); ?>">4Dinner</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
      </nav>
      <nav class="footer-vx__nav" aria-label="Comunidades">
        <span class="footer-vx__label">Comunidades</span>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/comunidad-out2b/' ) ); ?>">Out2B</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/comunidad-woman/' ) ); ?>">Woman</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/comunidad-senior/' ) ); ?>">Senior</a>
      </nav>
      <nav class="footer-vx__nav" aria-label="Cuenta">
        <span class="footer-vx__label">Cuenta</span>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/login/' ) ); ?>">Iniciar sesión</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/login/?tab=registro' ) ); ?>">Registrarse</a>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/recuperar-contrasena/' ) ); ?>">Recuperar contraseña</a>
      </nav>
    </div>
    <div class="footer-vx__bottom">
      <span>© <?php echo date( 'Y' ); ?> Vitrinexo SpA</span>
      <span>
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/privacidad/' ) ); ?>">Privacidad</a> ·
        <a class="footer-vx__link" href="<?php echo esc_url( home_url( '/terminos/' ) ); ?>">Términos</a>
      </span>
    </div>
  </div>
</footer>
