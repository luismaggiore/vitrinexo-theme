<?php
/**
 * Los criterios de Vitrinexo: el contenido del manual y, a la vez, el estado
 * del trabajo.
 *
 * Un criterio está `definido` cuando alguien puede aplicarlo sin preguntar,
 * `parcial` cuando hay una decisión tomada pero le falta alcance, y
 * `pendiente` cuando no existe. Declarar los huecos es parte del manual: lo
 * que no está escrito, cada quien lo improvisa distinto.
 *
 * El orden no es decorativo. Todo se deriva de la estrategia: el vocabulario
 * sale de a quién le hablas y el tono de qué le prometes, así que Voz va al
 * final y no al principio.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * El ancla de un criterio, derivada de su nombre. Se calcula y no se escribe:
 * un identificador escrito a mano se desincroniza del nombre en cuanto alguien
 * renombra el criterio, y entonces el enlace del menú apunta a nada.
 */
function vx_marca_ancla( string $nombre ): string {
    $sin = strtr(
        $nombre,
        [ 'á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n','Á'=>'A','É'=>'E','Í'=>'I','Ó'=>'O','Ú'=>'U','Ñ'=>'N' ]
    );
    $s = strtolower( $sin );
    $s = preg_replace( '/[^a-z0-9]+/', '-', $s );
    return trim( (string) $s, '-' );
}

/**
 * Las tres partes con sus criterios, en orden de lectura. El número de parte y
 * el de criterio se calculan por lo mismo que el ancla: escritos a mano se
 * desincronizan en cuanto alguien mueve una parte de sitio.
 */
function vx_marca_partes(): array {
    static $partes = null;
    if ( $partes !== null ) return $partes;

    $crudo = [
        [
            'id'      => 'estrategia',
            'titulo'  => 'Estrategia',
            'bajada'  => 'Por qué existe la marca. Todo lo demás se deriva de acá: el vocabulario sale de a quién le hablas, y el tono de qué le prometes.',
            'criterios' => [
                [ 'Contexto', 'pendiente' ],
                [ 'Qué significa la marca', 'pendiente' ],
                [ 'Tagline', 'pendiente' ],
                [ 'Línea de producto', 'parcial', 'Directorio, comunidades y 4Dinner conviven bajo la marca; falta cómo se nombra cada uno respecto de la madre.' ],
                [ 'Misión', 'pendiente' ],
                [ 'Visión', 'pendiente' ],
                [ 'Valores', 'pendiente' ],
                [ 'Públicos objetivos', 'pendiente' ],
                [ 'Objetivos estratégicos', 'parcial', 'El sistema hace cumplir dos números: 100 Miembros Pioneros y 90 días de vigencia.' ],
                [ 'Propuesta de valor', 'pendiente' ],
            ],
        ],
        [
            'id'      => 'identidad',
            'titulo'  => 'Identidad visual',
            'bajada'  => 'Cómo se ve la marca.',
            'criterios' => [
                [ 'Logotipo', 'parcial', 'El archivo manda y ninguna pantalla lo redibuja. Sus colores no están en la paleta del producto.' ],
                [ 'Isotipo', 'pendiente' ],
                [ 'Tipografías', 'definido', 'Switzer Variable, servida localmente. Cuatro pesos en uso de los nueve disponibles.' ],
                [ 'Jerarquía', 'definido', 'Tamaño, peso y tinta, en ese orden. El color nunca distingue solo.' ],
                [ 'Escala tipográfica', 'definido', 'Ocho peldaños. Esta página los obedece, así que si alguien la rompe se nota leyendo.' ],
                [ 'Paleta de color', 'parcial', 'Las dos capas están escritas. El teal de marca no llega al mínimo de contraste y la salida está sin decidir.' ],
                [ 'Iconografía', 'definido', 'Tabler Icons 3.19.0, trazo de 2 px sobre rejilla de 24. Una sola familia.' ],
                [ 'Motivos', 'definido', 'La red: puntos que se unen. Va detrás del contenido y nunca encima.' ],
                [ 'Dirección fotográfica', 'pendiente' ],
                [ 'Favicon', 'pendiente', 'El sitio no declara ninguno. Depende del isotipo.' ],
                [ 'Imagen para compartir', 'pendiente', 'Quien pega un enlace de Vitrinexo ve una tarjeta vacía.' ],
            ],
        ],
        [
            'id'      => 'voz',
            'titulo'  => 'Voz',
            'bajada'  => 'Cómo habla la marca.',
            'criterios' => [
                [ 'Idioma', 'parcial', 'Español de Chile, de tú, sin voseo y sin restringir la geografía. Faltan portugués e inglés.' ],
                [ 'Tono', 'pendiente' ],
                [ 'Mayúsculas y minúsculas', 'definido', 'Tipo oración en todas partes. Caja alta solo en sobretítulos.' ],
                [ 'Vocabulario', 'parcial', 'Ocho pares de decimos y no decimos, más la prohibición del guion largo.' ],
                [ 'Patrones de copy', 'pendiente' ],
                [ 'Números y formatos', 'parcial', 'El teléfono va con prefijo internacional. Falta moneda, fecha y hora.' ],
                [ 'Emojis', 'pendiente', 'El producto ya usa uno sin haberlo decidido.' ],
            ],
        ],
    ];

    $n      = 0;
    $partes = [];

    foreach ( $crudo as $i => $p ) {
        $criterios = [];
        foreach ( $p['criterios'] as $c ) {
            $n++;
            $criterios[] = [
                'n'      => $n,
                'nombre' => $c[0],
                'estado' => $c[1],
                'nota'   => $c[2] ?? '',
                'id'     => $p['id'] . '-' . vx_marca_ancla( $c[0] ),
            ];
        }
        $partes[] = [
            'id'        => $p['id'],
            'numero'    => str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ),
            'titulo'    => $p['titulo'],
            'bajada'    => $p['bajada'],
            'criterios' => $criterios,
        ];
    }

    return $partes;
}

/** Todos los criterios, aplanados y en orden. */
function vx_marca_criterios(): array {
    $todos = [];
    foreach ( vx_marca_partes() as $p ) {
        foreach ( $p['criterios'] as $c ) $todos[] = $c;
    }
    return $todos;
}

/** El nombre de un criterio por su ancla. El título del bloque sale de acá. */
function vx_marca_nombre( string $id ): string {
    foreach ( vx_marca_criterios() as $c ) {
        if ( $c['id'] === $id ) return $c['nombre'];
    }
    return '';
}

/** Cómo se rotula cada estado. */
function vx_marca_etiqueta( string $estado ): string {
    return [ 'definido' => 'Definido', 'parcial' => 'Parcial', 'pendiente' => 'Pendiente' ][ $estado ] ?? $estado;
}
