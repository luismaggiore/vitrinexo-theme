<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Partial: card-member
 *
 * Args:
 *   $args['member']  — array from VX_User::to_card_array()
 *   $args['context'] — 'directorio' | 'favoritos' | 'comunidad' | 'match-seeks' | 'match-offers' | 'dashboard'
 */

$member  = $args['member']  ?? [];
$context = $args['context'] ?? 'directorio';

if ( empty( $member ) ) return;

$viewer_id     = get_current_user_id();
$target_id     = (int) ( $member['id'] ?? 0 );
$nombre        = esc_html( $member['nombre_completo'] ?? '' );
$empresa_nombre = esc_html( $member['empresa'] ?? '' );
$ciudad        = esc_html( $member['ciudad'] ?? '' );
$pais_code     = esc_html( $member['pais_codigo'] ?? '' );
$foto_url      = esc_url( $member['foto_url'] ?? '' );
$slug          = esc_attr( $member['slug'] ?? '' );
$perfil_url    = home_url( '/perfil/' . $member['slug'] . '/' );
$offer_tags    = (array) ( $member['offer_tags'] ?? [] );
$seek_tags     = (array) ( $member['seek_tags'] ?? [] );
$is_founder    = ! empty( $member['is_founder'] );
$communities   = (array) ( $member['communities'] ?? [] );

// Verificar si es favorito
$viewer        = $viewer_id ? VX_User::get( $viewer_id ) : null;
$is_fav        = $viewer && in_array( $target_id, $viewer->get_favoritos(), true );

// Ocultar acciones en el propio perfil
$show_actions  = $viewer_id && $viewer_id !== $target_id;
?>
<div class="card" data-user-id="<?php echo $target_id; ?>">
  <div class="card-img-container">
    <div class="card-enlaces">
      <a href="<?php echo esc_url( $perfil_url ); ?>" class="btn-vx btn-ghost-vx btn-vx-sm btn-vx-icon-sm" aria-label="Ver perfil de <?php echo $nombre; ?>">
        <i class="ti ti-external-link"></i>
      </a>
      <?php if ( $show_actions ) : ?>
        <button class="btn-vx btn-soft-accent btn-vx-sm btn-vx-icon-sm vx-fav-btn <?php echo $is_fav ? 'vx-fav-btn--active' : ''; ?>"
                aria-label="<?php echo $is_fav ? 'Quitar de favoritos' : 'Guardar en favoritos'; ?>"
                data-user-id="<?php echo $target_id; ?>"
                data-activo="<?php echo $is_fav ? '1' : '0'; ?>">
          <i class="ti <?php echo $is_fav ? 'ti-heart-filled' : 'ti-heart'; ?>"></i>
        </button>
        <button class="btn-vx btn-soft-primary btn-vx-sm vx-conectar-btn"
                data-user-id="<?php echo $target_id; ?>"
                data-receptor-nombre="<?php echo $nombre; ?>"
                data-receptor-empresa="<?php echo $empresa_nombre; ?>"
                data-bs-toggle="modal"
                data-bs-target="#modalConectar">
          <i class="ti ti-send"></i> Conectar
        </button>
      <?php endif; ?>
    </div>
    <div class="card-blur-gradient"></div>
    <img class="card-img-top" alt="Foto de <?php echo $nombre; ?>" src="<?php echo $foto_url ?: esc_url( get_template_directory_uri() . '/assets/img/avatar-placeholder.svg' ); ?>">
  </div>
  <div class="card-body">
    <div class="info mb-2">
      <h5 class="h6 py-0 my-0">
        <?php echo $nombre; ?>
        <?php if ( $is_founder ) : ?>
          <span class="badge-vx badge-founder" title="Miembro fundador">F</span>
        <?php endif; ?>
      </h5>
      <?php if ( $empresa_nombre ) : ?>
        <p class="member-company"><?php echo $empresa_nombre; ?></p>
      <?php endif; ?>
      <?php if ( $ciudad || $pais_code ) : ?>
        <p class="member-company">
          <?php
          $location_parts = array_filter( [ $ciudad, $pais_code ? '(' . $pais_code . ')' : '' ] );
          echo esc_html( implode( ' ', $location_parts ) );
          ?>
        </p>
      <?php endif; ?>
    </div>

    <?php
    // Mostrar tags según contexto
    $show_offers = in_array( $context, [ 'directorio', 'favoritos', 'comunidad', 'dashboard' ], true ) || 'match-offers' === $context;
    $show_seeks  = in_array( $context, [ 'directorio', 'favoritos', 'comunidad', 'dashboard' ], true ) || 'match-seeks' === $context;
    ?>

    <?php if ( ( $offer_tags || $seek_tags ) && ( $show_offers || $show_seeks ) ) : ?>
      <div class="d-flex flex-wrap gap-1 mb-0 p-0">
        <?php if ( $show_offers && $offer_tags ) : ?>
          <p class="p-offers">Ofrece</p>
        <?php endif; ?>
        <?php if ( $show_seeks && $seek_tags ) : ?>
          <p class="p-seeks">Busca</p>
        <?php endif; ?>
      </div>
      <div class="d-flex flex-wrap gap-1">
        <?php if ( $show_offers ) : ?>
          <?php foreach ( $offer_tags as $tag ) : ?>
            <span class="tag-vx tag-offers"><?php echo esc_html( $tag ); ?></span>
          <?php endforeach; ?>
        <?php endif; ?>
        <?php if ( $show_seeks ) : ?>
          <?php foreach ( $seek_tags as $tag ) : ?>
            <span class="tag-vx tag-seeks"><?php echo esc_html( $tag ); ?></span>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
