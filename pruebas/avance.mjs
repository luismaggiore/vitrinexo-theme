/**
 * El avance: qué criterio está escrito y cuál no.
 *
 * Informa y no falla. Es estado del trabajo, no una comprobación, y por eso no
 * vive en sistema/ ni en pantalla/ ni aparece en el manual: un manual de marca
 * no lleva adentro el registro de su propia obra.
 *
 *   npm run avance
 */

import { informar, leer } from './comun.mjs';

const criterios = leer( 'inc/marca/criterios.php' );
const cuenta = { definido: 0, parcial: 0, pendiente: 0 };
const filas = [];
let parte = '';

for ( const linea of criterios.split( '\n' ) ) {
  const p = linea.match( /'titulo'\s*=>\s*'([^']+)'/ );
  if ( p ) parte = p[ 1 ];
  const c = linea.match( /\[ '([^']+)', '(definido|parcial|pendiente)'/ );
  if ( ! c ) continue;
  cuenta[ c[ 2 ] ]++;
  filas.push( [ parte, c[ 1 ], c[ 2 ] ] );
}

const simbolo = { definido: '●', parcial: '◐', pendiente: '○' };
let anterior = '';
for ( const [ parteNombre, nombre, estado ] of filas ) {
  if ( parteNombre !== anterior ) {
    console.log( `\n${ parteNombre }` );
    anterior = parteNombre;
  }
  console.log( `  ${ simbolo[ estado ] } ${ nombre }` );
}

const total = filas.length;
console.log( `\n${ cuenta.definido } definidos · ${ cuenta.parcial } parciales · ${ cuenta.pendiente } pendientes · ${ total } criterios` );
