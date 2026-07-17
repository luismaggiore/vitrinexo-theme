<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<!-- Barra fija superior -->
<header class="vx-topbar">
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="vx-topbar__logo">
    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/vitrinexo.svg' ); ?>" alt="Vitrinexo" height="26">
  </a>
  <button class="vx-topbar__toggle" data-bs-toggle="offcanvas" data-bs-target="#vxDrawer" aria-controls="vxDrawer" aria-label="Abrir menú">
    <span></span><span></span><span></span>
  </button>
</header>

<!-- Drawer lateral -->
<div class="offcanvas offcanvas-end vx-drawer" tabindex="-1" id="vxDrawer" aria-labelledby="vxDrawerLabel">
  <div class="vx-drawer__header">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/vitrinexo.svg' ); ?>" alt="Vitrinexo" height="24">
    </a>
    <button type="button" class="vx-drawer__close" data-bs-dismiss="offcanvas" aria-label="Cerrar">
      <i class="ti ti-x"></i>
    </button>
  </div>
  <nav class="vx-drawer__nav">
    <a href="#el-problema"      data-bs-dismiss="offcanvas">El problema</a>
    <a href="#como-funciona"    data-bs-dismiss="offcanvas">Cómo funciona</a>
    <a href="#para-quien"       data-bs-dismiss="offcanvas">Para quién es</a>
    <a href="#el-multiverso"    data-bs-dismiss="offcanvas">El multiverso</a>
    <a href="#4dinner"          data-bs-dismiss="offcanvas">Experiencia presencial</a>
  </nav>
  <div class="vx-drawer__actions">
    <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>" class="btn-vx btn-ghost-vx btn-vx-sm w-100 justify-content-center mb-2">Ingresar</a>
    <a href="#afiliado-original" class="btn-vx btn-primary-vx btn-vx-sm w-100 justify-content-center" data-bs-dismiss="offcanvas">Inscríbete →</a>
  </div>
</div>
