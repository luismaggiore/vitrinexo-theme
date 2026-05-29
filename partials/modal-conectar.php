<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Partial: modal-conectar
 *
 * Args:
 *   $args['receptor_id']     — int
 *   $args['receptor_nombre'] — string
 *   $args['viewer_empresas'] — WP_Post[] empresas del emisor
 */

$receptor_id     = (int)    ( $args['receptor_id']     ?? 0 );
$receptor_nombre = (string) ( $args['receptor_nombre'] ?? '' );
$viewer_empresas = (array)  ( $args['viewer_empresas'] ?? [] );
?>
<div class="modal fade" id="modalConectar" tabindex="-1" aria-labelledby="modalConectarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-vx" style="width:100%;max-width:500px;margin:auto">

      <div class="modal-vx-header">
        <div>
          <h5 class="modal-vx-title" id="modalConectarLabel">
            Conectar con <span id="modal-receptor-nombre"><?php echo esc_html( $receptor_nombre ); ?></span>
          </h5>
          <p class="modal-subtitle"><span id="modal-receptor-empresa"></span></p>
        </div>
        <button type="button" class="btn-vx btn-ghost-vx btn-vx-icon-sm" data-bs-dismiss="modal" aria-label="Cerrar">
          <i class="ti ti-x"></i>
        </button>
      </div>

      <div class="modal-body-pad">
        <form id="form-conectar">
          <input type="hidden" name="receptor_id" value="<?php echo $receptor_id; ?>" id="modal-receptor-id">

          <?php if ( count( $viewer_empresas ) > 1 ) : ?>
            <div class="mb-3" id="campo-empresa">
              <label class="form-label-vx">
                ¿Desde qué empresa(s) contactas?
                <span style="color:var(--color-text-secondary);font-weight:400">(puedes seleccionar más de una)</span>
              </label>
              <?php foreach ( $viewer_empresas as $i => $empresa ) :
                $logo_id  = (int) get_post_meta( $empresa->ID, 'vx_logo', true );
                $logo_url = $logo_id ? wp_get_attachment_image_url( $logo_id, 'vx-logo' ) : '';
                $sector   = (string) get_post_meta( $empresa->ID, 'vx_sector', true );
                $pais_emp = (string) get_post_meta( $empresa->ID, 'vx_pais', true );
                $is_first = 0 === $i;
              ?>
                <label class="modal-empresa-option">
                  <input type="checkbox" name="empresas[]" value="<?php echo $empresa->ID; ?>" <?php checked( $is_first ); ?> style="display:none">
                  <div class="modal-empresa-card <?php echo $is_first ? 'modal-empresa-card--selected' : ''; ?>">
                    <div class="empresa-logo-circle">
                      <?php if ( $logo_url ) : ?>
                        <img src="<?php echo esc_url( $logo_url ); ?>" alt="Logo <?php echo esc_attr( $empresa->post_title ); ?>">
                      <?php else : ?>
                        <i class="ti ti-building"></i>
                      <?php endif; ?>
                    </div>
                    <div class="modal-empresa-info">
                      <div class="modal-empresa-name"><?php echo esc_html( $empresa->post_title ); ?></div>
                      <div class="modal-empresa-role">
                        <?php echo esc_html( implode( ' · ', array_filter( [ $sector, $pais_emp ] ) ) ); ?>
                      </div>
                    </div>
                    <i class="ti <?php echo $is_first ? 'ti-circle-check' : 'ti-circle'; ?> modal-empresa-check"></i>
                  </div>
                </label>
              <?php endforeach; ?>
            </div>
          <?php elseif ( count( $viewer_empresas ) === 1 ) : ?>
            <input type="hidden" name="empresas[]" value="<?php echo (int) $viewer_empresas[0]->ID; ?>">
          <?php endif; ?>

          <div class="mb-3">
            <label class="form-label-vx">
              Tu mensaje
              <span style="color:var(--color-text-secondary);font-weight:400">(por qué quieres conectar)</span>
            </label>
            <textarea class="form-control-vx" name="pitch" rows="4"
              placeholder="Cuéntale el motivo de tu contacto, qué tienes en mente o en qué crees que pueden colaborar..."
              required minlength="20"></textarea>
          </div>

          <div id="form-conectar-error" class="vx-alert vx-alert--error d-none mb-2"></div>

          <button type="submit" class="btn-vx btn-primary-vx btn-vx-sm w-100" id="btn-enviar-conexion">
            <i class="ti ti-send"></i> Enviar solicitud de conexión
          </button>

          <p class="text-xs-muted text-center" style="margin-top:8px">
            <i class="ti ti-lock" style="font-size:11px"></i>
            Tus datos de contacto solo se revelan si la persona acepta la conexión.
          </p>
        </form>

        <div id="modal-success" style="display:none;text-align:center;padding:1.5rem 0">
          <div style="font-size:2.5rem;margin-bottom:.75rem">✓</div>
          <div style="font-size:15px;font-weight:600;color:var(--color-text-primary);margin-bottom:.4rem">Solicitud enviada</div>
          <p class="text-body-muted mb-0">
            <span id="modal-receptor-nombre-success"><?php echo esc_html( $receptor_nombre ); ?></span>
            recibirá tu mensaje y podrá aceptar desde su correo.
            Sus datos de contacto se revelarán solo si acepta.
          </p>
        </div>
      </div>

    </div>
  </div>
</div>
