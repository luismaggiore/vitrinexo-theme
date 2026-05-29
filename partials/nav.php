<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <div class="container-fluid px-4">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand d-flex align-items-center gap-2">
      <img width="100" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/vitrinexo.svg' ); ?>" alt="Vitrinexo" style="flex-shrink:0">
      <span class="dashboard-date">by Maggiore</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navPublic" aria-controls="navPublic" aria-expanded="false" aria-label="Abrir navegación">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navPublic">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4 gap-1">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">Qué es</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Comunidades</a>
          <ul class="dropdown-menu border-0 shadow-sm p-1">
            <li>
              <a class="dropdown-item rounded-2" href="<?php echo esc_url( home_url( '/comunidad-out2b/' ) ); ?>">
                <i class="ti ti-rainbow me-2" style="color:#a855f7"></i>Out2B
              </a>
            </li>
            <li>
              <a class="dropdown-item rounded-2" href="<?php echo esc_url( home_url( '/comunidad-woman/' ) ); ?>">
                <i class="ti ti-gender-female me-2" style="color:#ec4899"></i>Woman
              </a>
            </li>
            <li>
              <a class="dropdown-item rounded-2" href="<?php echo esc_url( home_url( '/comunidad-senior/' ) ); ?>">
                <i class="ti ti-award me-2" style="color:#d97706"></i>Senior
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo esc_url( home_url( '/4dinner/' ) ); ?>">4Dinner</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
        </li>
      </ul>
      <div class="d-flex align-items-center gap-2">
        <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>" class="btn-vx btn-ghost-vx btn-vx-sm">Ingresar</a>
        <a href="<?php echo esc_url( home_url( '/login/?tab=registro' ) ); ?>" class="btn-vx btn-primary-vx btn-vx-sm">Registrarse →</a>
      </div>
    </div>
  </div>
</nav>
