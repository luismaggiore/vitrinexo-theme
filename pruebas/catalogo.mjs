/**
 * Qué comprobaciones existen y cómo corre cada una.
 *
 * Se descubren leyendo las carpetas, no una lista escrita a mano: la manera
 * más fácil de que una comprobación no corra es escribir el archivo y
 * olvidarse de agregarlo a la cadena.
 *
 * Hay dos clases y la diferencia es si necesitan el navegador. Las de sistema
 * leen el código y los tokens; las de pantalla abren la página de verdad,
 * porque hay cosas que solo se pueden medir renderizadas.
 */

import { readdirSync } from 'node:fs';
import { join } from 'node:path';
import { TEMA } from './comun.mjs';

const enCarpeta = ( carpeta ) =>
  readdirSync( join( TEMA, 'pruebas', carpeta ) )
    .filter( ( f ) => f.endsWith( '.mjs' ) )
    .sort()
    .map( ( f ) => `${ carpeta }/${ f }` );

export function comprobaciones() {
  return { sistema: enCarpeta( 'sistema' ), pantalla: enCarpeta( 'pantalla' ) };
}
