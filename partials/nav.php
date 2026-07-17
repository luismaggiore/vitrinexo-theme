<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <div class="container-fluid px-4">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand d-flex align-items-center gap-2">
      <img width="100" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/vitrinexo.svg' ); ?>" alt="Vitrinexo" style="flex-shrink:0">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navPublic" aria-controls="navPublic" aria-expanded="false" aria-label="Abrir navegación">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navPublic">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4 gap-1">
        <li class="nav-item"><a class="nav-link" href="#el-problema">El problema</a></li>
        <li class="nav-item"><a class="nav-link" href="#como-funciona">Cómo funciona</a></li>
        <li class="nav-item"><a class="nav-link" href="#para-quien">Para quién es</a></li>
        <li class="nav-item"><a class="nav-link" href="#el-multiverso">El multiverso</a></li>
        <li class="nav-item"><a class="nav-link" href="#4dinner">Experiencia presencial</a></li>
      </ul>
      <div class="d-flex align-items-center gap-2">
        <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>" class="btn-vx btn-ghost-vx btn-vx-sm">Ingresar</a>
        <a href="#afiliado-original" class="btn-vx btn-primary-vx btn-vx-sm">Inscríbete →</a>
      </div>
    </div>
  </div>
</nav>
