<?php
/**
 * La ruta /marca.
 *
 * El manual no depende de que exista una página en WordPress: es código, no
 * contenido. Se sirve por regla de reescritura, así que nadie puede borrarlo
 * desde el escritorio ni cambiarle el texto sin pasar por un commit. Si algún
 * día se crea una página con slug «marca», el template también la toma.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Se sube cuando cambian las reglas de reescritura. Comparar contra lo
 * guardado es lo que evita un flush en cada carga, que es caro y silencioso.
 */
const VX_MARCA_REGLAS = '1';

add_action( 'init', function () {
    add_rewrite_rule( '^marca/?$', 'index.php?vx_marca=1', 'top' );

    if ( get_option( 'vx_marca_reglas' ) !== VX_MARCA_REGLAS ) {
        flush_rewrite_rules( false );
        update_option( 'vx_marca_reglas', VX_MARCA_REGLAS, false );
    }
} );

add_filter( 'query_vars', function ( array $vars ): array {
    $vars[] = 'vx_marca';
    return $vars;
} );

/** true cuando la petición es el manual, por regla propia o por página. */
function vx_marca_es_ruta(): bool {
    return (bool) get_query_var( 'vx_marca' ) || is_page( 'marca' );
}

/**
 * Sirve el manual. Va en prioridad 1 porque el 404 del tema corre en la 10 y
 * esta petición no tiene post detrás: sin adelantarse, WordPress la da por
 * perdida antes de que lleguemos.
 */
add_action( 'template_redirect', function () {
    if ( ! get_query_var( 'vx_marca' ) ) return;

    status_header( 200 );
    // Sin post detrás, WordPress marca la consulta como fallida y algunos
    // plugins de caché leen eso en vez del código de estado.
    global $wp_query;
    $wp_query->is_404 = false;

    require get_template_directory() . '/templates/page-marca.php';
    exit;
}, 1 );

/** El manual se publica sin indexar: es para quien tenga el enlace. */
add_action( 'wp_head', function () {
    if ( vx_marca_es_ruta() ) echo '<meta name="robots" content="noindex, nofollow">' . "\n";
}, 1 );

add_action( 'wp_enqueue_scripts', function () {
    if ( ! vx_marca_es_ruta() ) return;

    $ver = wp_get_theme()->get( 'Version' );
    $uri = get_template_directory_uri();

    wp_enqueue_style( 'vitrinexo-marca', $uri . '/assets/css/marca.css', [ 'vitrinexo-design' ], $ver );
    wp_enqueue_script( 'vitrinexo-marca', $uri . '/assets/js/marca.js', [], $ver, true );
}, 20 );

/** El título de la pestaña, sin post que lo ponga. */
add_filter( 'document_title_parts', function ( array $partes ): array {
    if ( get_query_var( 'vx_marca' ) ) $partes['title'] = 'Manual de marca';
    return $partes;
} );
