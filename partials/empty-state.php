<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Partial: empty-state
 * Args: $args['tipo'] — string
 */

$tipo = $args['tipo'] ?? 'generico';

if ( function_exists( 'vx_render_empty_state' ) ) {
    echo vx_render_empty_state( $tipo );
}
