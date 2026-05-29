<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$user_id    = get_current_user_id();
$nombre     = vx_get_current_user_short_name();
$avatar_url = vx_get_current_user_avatar_url();
$slug       = (string) get_user_meta( $user_id, 'vx_perfil_slug', true );
$unread     = class_exists( 'VX_Notification' ) ? VX_Notification::count_unread( $user_id ) : 0;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <div class="container-fluid px-4">
    <a href="<?php echo esc_url( home_url( '/dashboard/' ) ); ?>" class="navbar-brand d-flex align-items-center gap-2">
      <img width="100" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/vitrinexo.svg' ); ?>" alt="Vitrinexo" style="flex-shrink:0">
      <span class="dashboard-date">by Maggiore</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navLogged" aria-controls="navLogged" aria-expanded="false" aria-label="Abrir navegación">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navLogged">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4 gap-1">
        <li class="nav-item">
          <a class="nav-link<?php echo is_page( 'directorio' ) ? ' active' : ''; ?>" href="<?php echo esc_url( home_url( '/directorio/' ) ); ?>">Directorio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo is_page( 'matches' ) ? ' active' : ''; ?>" href="<?php echo esc_url( home_url( '/matches/' ) ); ?>">Matches</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo is_page( 'conexiones' ) ? ' active' : ''; ?>" href="<?php echo esc_url( home_url( '/conexiones/' ) ); ?>">Conexiones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo is_page( 'favoritos' ) ? ' active' : ''; ?>" href="<?php echo esc_url( home_url( '/favoritos/' ) ); ?>">Favoritos</a>
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
          <a class="nav-link<?php echo is_page( '4dinner' ) ? ' active' : ''; ?>" href="<?php echo esc_url( home_url( '/4dinner/' ) ); ?>">4Dinner</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo is_page( 'blog' ) ? ' active' : ''; ?>" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
        </li>
      </ul>
      <div class="d-flex align-items-center gap-2">
        <!-- Notificaciones -->
        <a href="<?php echo esc_url( home_url( '/notificaciones/' ) ); ?>" class="btn-vx btn-ghost-vx btn-vx-sm btn-vx-icon-sm position-relative" aria-label="Notificaciones">
          <i class="ti ti-bell"></i>
          <?php if ( $unread > 0 ) : ?>
            <span class="notif-dot" id="vx-notif-badge" data-count="<?php echo (int) $unread; ?>"></span>
          <?php else : ?>
            <span class="notif-dot d-none" id="vx-notif-badge" data-count="0"></span>
          <?php endif; ?>
        </a>
        <!-- Avatar dropdown -->
        <div class="dropdown">
          <button class="btn-vx btn-ghost-vx btn-vx-sm d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php echo esc_attr( $nombre ); ?>" class="nav-avatar">
            <span class="nav-username"><?php echo esc_html( $nombre ); ?></span>
            <i class="ti ti-chevron-down nav-chevron"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end dropdown-vx border-0 shadow" style="padding:6px 0;min-width:190px">
            <li><a class="dropdown-vx-item" href="<?php echo esc_url( home_url( '/dashboard/' ) ); ?>"><i class="ti ti-layout-dashboard"></i>Dashboard</a></li>
            <?php if ( $slug ) : ?>
              <li><a class="dropdown-vx-item" href="<?php echo esc_url( home_url( '/perfil/' . $slug . '/' ) ); ?>"><i class="ti ti-user"></i>Mi perfil</a></li>
            <?php endif; ?>
            <li><a class="dropdown-vx-item" href="<?php echo esc_url( home_url( '/editar-perfil/' ) ); ?>"><i class="ti ti-pencil"></i>Editar perfil</a></li>
            <li><hr class="dropdown-vx-divider my-1"></li>
            <li><a class="dropdown-vx-item" href="<?php echo esc_url( home_url( '/conexiones/' ) ); ?>"><i class="ti ti-network"></i>Mis conexiones</a></li>
            <li><a class="dropdown-vx-item" href="<?php echo esc_url( home_url( '/matches/' ) ); ?>"><i class="ti ti-sparkles"></i>Mis matches</a></li>
            <li><a class="dropdown-vx-item" href="<?php echo esc_url( home_url( '/favoritos/' ) ); ?>"><i class="ti ti-heart"></i>Mis favoritos</a></li>
            <li><a class="dropdown-vx-item" href="<?php echo esc_url( home_url( '/notificaciones/' ) ); ?>"><i class="ti ti-bell"></i>Notificaciones</a></li>
            <li><hr class="dropdown-vx-divider my-1"></li>
            <li><a class="dropdown-vx-item" href="<?php echo esc_url( home_url( '/configuracion/' ) ); ?>"><i class="ti ti-settings"></i>Configuración</a></li>
            <li>
              <a class="dropdown-vx-item danger" href="<?php echo esc_url( wp_logout_url( home_url( '/login/' ) ) ); ?>"><i class="ti ti-logout"></i>Cerrar sesión</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
