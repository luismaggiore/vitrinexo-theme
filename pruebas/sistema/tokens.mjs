/**
 * Las tres capas, separadas.
 *
 * Una pantalla que nombra un primitivo se salta la capa que hace posible
 * cambiar el sistema: el día que el teal cambie de valor, cada --color-cyan-600
 * suelto es un lugar donde no va a cambiar. Y un papel que se llama por su
 * color —«el token verde»— deja de decir para qué sirve en cuanto deja de ser
 * verde.
 */

import { ARCHIVOS_MANUAL, gruposPrimitivos, informar, leer, sinComentarios, tokensDelSistema } from '../comun.mjs';

/**
 * Las excepciones se declaran en la línea, no aflojando la regla. Una regla
 * sin escape se rompe en silencio; una con escape marcado se audita.
 *
 *   primitivo a propósito — el registro de decisiones nombra el token que movió
 *   color ajeno          — un color que no es del sistema: el del archivo del
 *                          logotipo, o una medición que se está citando
 */
const MARCADOR = { primitivo: 'primitivo a propósito', ajeno: 'color ajeno' };

const fallos = [];
const primitivos = gruposPrimitivos();
const grupos = tokensDelSistema();

const nombresPrimitivos = new Set(
  grupos.filter( ( g ) => primitivos.includes( g.titulo ) ).flatMap( ( g ) => g.tokens.map( ( t ) => t.nombre ) )
);
const semanticos = grupos
  .filter( ( g ) => ! primitivos.includes( g.titulo ) )
  .flatMap( ( g ) => g.tokens.map( ( t ) => t.nombre ) );

// 1. Ninguna pieza del manual nombra un primitivo ni escribe un color a mano.
for ( const archivo of ARCHIVOS_MANUAL ) {
  const fuente = sinComentarios( leer( archivo ) );

  for ( const linea of fuente.split( '\n' ) ) {
    const primitivo = [ ...nombresPrimitivos ].find( ( n ) => linea.includes( n ) );
    if ( primitivo && ! linea.includes( MARCADOR.primitivo ) ) {
      fallos.push( `${ archivo } nombra el primitivo ${ primitivo }: ${ linea.trim().slice( 0, 72 ) }` );
    }
  }

  // Un hexadecimal escrito a mano es un primitivo sin nombre. La excepción va
  // marcada en la línea, no aflojando la regla.
  for ( const linea of fuente.split( '\n' ) ) {
    const hex = linea.match( /#[0-9a-fA-F]{3,8}\b/ );
    if ( hex && ! linea.includes( MARCADOR.ajeno ) ) {
      fallos.push( `${ archivo } escribe el color ${ hex[ 0 ] } a mano: ${ linea.trim().slice( 0, 72 ) }` );
    }
  }
}

// 2. Ningún papel se llama por su color.
const COLORES = [ 'cyan', 'green', 'purple', 'pink', 'ice', 'teal', 'navy', 'blanco', 'negro', 'rojo', 'azul' ];
for ( const nombre of semanticos ) {
  const culpable = COLORES.find( ( c ) => nombre.toLowerCase().includes( c ) );
  if ( culpable ) fallos.push( `el papel ${ nombre } se llama por su color («${ culpable }»)` );
}

// 3. Todo papel tiene su oficio escrito, y ningún oficio nombra un token que
//    ya no existe. Un papel que nadie describe es un color más en la lista.
const papeles = leer( 'inc/marca/papeles.php' );
const conOficio = [ ...papeles.matchAll( /'(--[\w-]+)'\s*=>\s*'/g ) ].map( ( m ) => m[ 1 ] );

for ( const nombre of semanticos ) {
  if ( ! conOficio.includes( nombre ) ) fallos.push( `el papel ${ nombre } no tiene oficio escrito en papeles.php` );
}
for ( const nombre of conOficio ) {
  if ( ! semanticos.includes( nombre ) ) fallos.push( `papeles.php describe ${ nombre }, que el CSS ya no declara` );
}

informar( 'tokens', fallos );
