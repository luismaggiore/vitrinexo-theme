<?php
/**
 * El registro de decisiones.
 *
 * Este manual no tiene versión, tiene commit. Lo que sí hay que versionar son
 * las decisiones: qué se eligió, contra qué, y con qué medición. Sin registro,
 * cada decisión hay que volver a tomarla, y la conversación empieza de cero.
 *
 * Cuando una decisión movió un token, deja escrito su valor de hoy en
 * `tokens`. Una prueba lo compara con el valor real del CSS: un registro que
 * se desincroniza del sistema es peor que no tener registro, porque se cree.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @return array<int,array{
 *   fecha:string, titulo:string, eligio:string, contra:string,
 *   medicion:string, estado:string, tokens:array<string,string>
 * }>
 */
function vx_marca_decisiones(): array {
    return [
        [
            'fecha'    => '2026-09-24',
            'titulo'   => 'La escala tipográfica es de ocho peldaños',
            'eligio'   => 'Ocho tamaños fijos, de 40 a 12 px, cada uno con su uso escrito.',
            'contra'   => 'Seguir sin escala, que es lo que había.',
            'medicion' => 'El CSS traía 277 declaraciones de tamaño escritas a mano. 166 caen fuera de los ocho peldaños; 13 px aparece 55 veces, 11 px 19 y 15 px 16.',
            'estado'   => 'aplicada',
            'tokens'   => [
                '--fs-display' => '40px', '--fs-h2' => '32px', '--fs-h3' => '24px', '--fs-h4' => '20px',
                '--fs-body-l' => '18px', '--fs-body' => '16px', '--fs-body-s' => '14px', '--fs-caption' => '12px',
            ],
        ],
        [
            'fecha'    => '2026-09-24',
            'titulo'   => 'El espaciado va en múltiplos de cuatro',
            'eligio'   => 'Once peldaños de 4 a 80 px. La medida de la casa es 16.',
            'contra'   => 'Seguir escribiendo cada margen a mano.',
            'medicion' => 'La escala cubre los valores que el producto ya usaba sin nombrarlos. Los peldaños sin uso existen para que lo próximo caiga en uno en vez de inventar 33 px.',
            'estado'   => 'aplicada',
            'tokens'   => [ '--space-4' => '16px', '--space-6' => '24px', '--space-12' => '48px' ],
        ],
        [
            'fecha'    => '2026-09-24',
            'titulo'   => 'Cada rampa de color se titula sola',
            'eligio'   => 'Un comentario propio por rampa en el CSS: Verde, Teal, Púrpura, Rosa, Hielo.',
            'contra'   => 'Dejar el teal colgando del comentario del verde, como estaba.',
            'medicion' => 'El lector de tokens leía las dos rampas como una sola de veinte peldaños, y la paleta del manual las pintaba juntas.',
            'estado'   => 'aplicada',
            'tokens'   => [],
        ],
        [
            'fecha'    => '2026-09-24',
            'titulo'   => 'El teal que se lee es el peldaño 900',
            'eligio'   => 'Un papel nuevo, --color-primary-ink, para el teal que tiene que leerse: enlaces, títulos de acento e íconos.',
            'contra'   => 'Usar --color-primary #00AEB8, que es lo que se venía haciendo, o subir solo hasta cyan-800.', // color ajeno: el registro cita la medición y el token que movió.
            'medicion' => 'Sobre las tres superficies del sistema: #00AEB8 da 2,55 / 2,64 / 2,68. cyan-800 da 4,37 / 4,51 / 4,58, y el 4,37 del fondo de página está bajo el mínimo. cyan-900 da 6,48 / 6,70 / 6,81.', // color ajeno: el registro cita la medición y el token que movió.
            'estado'   => 'aplicada',
            'tokens'   => [ '--color-primary-ink' => 'var(--color-cyan-900)' ], // primitivo a propósito: el registro cita la medición y el token que movió.
        ],
        [
            'fecha'    => '2026-09-24',
            'titulo'   => 'El fondo del botón primario sigue sin resolverse',
            'eligio'   => 'Nada todavía.',
            'contra'   => 'Dejar el teal de marca como fondo de todo botón primario.',
            'medicion' => 'Tinta blanca sobre #00AEB8 da 2,71:1, bajo el mínimo de 4,5:1. Sobre cyan-900 da 6,88:1. Cambiarlo toca todos los botones primarios del producto, no solo esta página.', // color ajeno: el registro cita la medición y el token que movió.
            'estado'   => 'abierta',
            'tokens'   => [],
        ],
        [
            'fecha'    => '2026-09-24',
            'titulo'   => 'Los estados no se usan como tinta',
            'eligio'   => 'Verde y rosa de estado son fondo, no texto. Lo que va encima se escribe con la tinta normal.',
            'contra'   => 'Escribir «aprobado» en verde y «vence pronto» en rosa, que es lo que pide el reflejo.',
            'medicion' => 'Sobre el fondo de página, --color-success da 2,70:1 y --color-warning 2,98:1, contra un mínimo de 4,5:1. Los pares -bg sí funcionan como fondo con tinta oscura encima.',
            'estado'   => 'aplicada',
            'tokens'   => [],
        ],
        [
            'fecha'    => '2026-09-24',
            'titulo'   => 'El manual se publica sin indexar',
            'eligio'   => 'La página es pública para quien tenga el enlace y lleva noindex.',
            'contra'   => 'Dejarla indexable, o cerrarla tras la sesión de miembro.',
            'medicion' => 'Es lo que hace falta para mandársela a un proveedor sin que compita con la portada en los buscadores.',
            'estado'   => 'aplicada',
            'tokens'   => [],
        ],
    ];
}
