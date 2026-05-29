<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Partial: pagination
 * Args: $args['pagination'] — array from VX_Pagination::build()
 */

$p = $args['pagination'] ?? [];
if ( empty( $p ) || (int) ( $p['total_pages'] ?? 1 ) <= 1 ) return;

$current     = (int) $p['current'];
$total_pages = (int) $p['total_pages'];
$pages       = (array) ( $p['pages'] ?? [] );
$has_prev    = (bool) $p['has_prev'];
$has_next    = (bool) $p['has_next'];

function vx_pagination_url( int $page ): string {
    return add_query_arg( 'pagina', $page );
}
?>
<nav aria-label="Paginación" class="mt-5">
  <ul class="pagination justify-content-center">

    <!-- Anterior -->
    <li class="page-item <?php echo ! $has_prev ? 'disabled' : ''; ?>">
      <a class="page-link" href="<?php echo $has_prev ? esc_url( vx_pagination_url( $current - 1 ) ) : '#'; ?>" aria-label="Página anterior">
        <i class="ti ti-chevron-left"></i>
      </a>
    </li>

    <!-- Primera página si no está en rango -->
    <?php if ( ! empty( $p['show_first'] ) ) : ?>
      <li class="page-item">
        <a class="page-link" href="<?php echo esc_url( vx_pagination_url( 1 ) ); ?>">1</a>
      </li>
      <li class="page-item disabled"><span class="page-link">…</span></li>
    <?php endif; ?>

    <!-- Páginas del rango -->
    <?php foreach ( $pages as $page ) : ?>
      <li class="page-item <?php echo $page === $current ? 'active' : ''; ?>">
        <a class="page-link" href="<?php echo esc_url( vx_pagination_url( $page ) ); ?>"><?php echo $page; ?></a>
      </li>
    <?php endforeach; ?>

    <!-- Última página si no está en rango -->
    <?php if ( ! empty( $p['show_last'] ) ) : ?>
      <li class="page-item disabled"><span class="page-link">…</span></li>
      <li class="page-item">
        <a class="page-link" href="<?php echo esc_url( vx_pagination_url( $total_pages ) ); ?>"><?php echo $total_pages; ?></a>
      </li>
    <?php endif; ?>

    <!-- Siguiente -->
    <li class="page-item <?php echo ! $has_next ? 'disabled' : ''; ?>">
      <a class="page-link" href="<?php echo $has_next ? esc_url( vx_pagination_url( $current + 1 ) ) : '#'; ?>" aria-label="Página siguiente">
        <i class="ti ti-chevron-right"></i>
      </a>
    </li>

  </ul>
</nav>
