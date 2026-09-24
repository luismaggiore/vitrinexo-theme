/**
 * Que el tracking salga siempre de un peldaño.
 *
 * Es la regla que más fácil se rompe, porque escribir -0.03em al lado del
 * font-size es más rápido que buscar el token. Y se rompe en silencio: nadie
 * revisa el tracking de una pantalla que ya estaba hecha.
 *
 * Antes de esta comprobación había 66 valores a mano y una regla general que
 * apretaba todo h1 y h2 un 7% sin mirar el tamaño.
 */

import { informar, leer, sinComentarios, tokensDelSistema } from '../comun.mjs';

const fallos = [];

const peldanos = tokensDelSistema()
  .flatMap( ( g ) => g.tokens.map( ( t ) => t.nombre ) )
  .filter( ( n ) => n.startsWith( '--ls-' ) );

if ( peldanos.length < 8 ) fallos.push( `solo hay ${ peldanos.length } peldaños de tracking declarados` );

const css = sinComentarios( leer( 'assets/css/style.css' ) );
for ( const [ , valor ] of css.matchAll( /letter-spacing:\s*([^;}]+)/g ) ) {
  const v = valor.trim();
  if ( ! v.startsWith( 'var(--ls-' ) ) fallos.push( `style.css escribe letter-spacing: ${ v } a mano` );
  else {
    const nombre = v.match( /var\(\s*(--[\w-]+)/ )?.[ 1 ];
    if ( nombre && ! peldanos.includes( nombre ) ) fallos.push( `style.css usa ${ nombre }, que no existe en la escala` );
  }
}

// La hoja del manual, por lo mismo.
const manual = sinComentarios( leer( 'assets/css/marca.css' ) );
for ( const [ , valor ] of manual.matchAll( /letter-spacing:\s*([^;}]+)/g ) ) {
  const v = valor.trim();
  if ( ! v.startsWith( 'var(--ls-' ) && v !== 'normal' ) fallos.push( `marca.css escribe letter-spacing: ${ v } a mano` );
}

informar( 'tracking', fallos );
