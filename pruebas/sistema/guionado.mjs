/**
 * Que nunca se partan palabras al final de la línea.
 *
 * Un guion automático parte «conexión» en «cone-xión» a mitad de una columna
 * angosta, y en un manual de marca la primera palabra que se parte suele ser
 * el nombre de la marca. El navegador no lo hace solo: hay que pedírselo, y
 * basta con que alguien copie un `hyphens: auto` de otro proyecto.
 */

import { informar, leer, sinComentarios } from '../comun.mjs';

const fallos = [];
const css = sinComentarios( leer( 'assets/css/marca.css' ) );

for ( const prohibido of [ /hyphens:\s*auto/, /word-break:\s*break-all/, /overflow-wrap:\s*break-word/ ] ) {
  const m = css.match( prohibido );
  if ( m ) fallos.push( `marca.css usa ${ m[ 0 ] }, que parte palabras` );
}

// Y lo pide explícitamente: el valor por defecto depende del navegador.
if ( ! /hyphens:\s*manual/.test( css ) ) {
  fallos.push( 'marca.css no declara hyphens: manual, así que el guionado queda a criterio del navegador' );
}

// Los guiones largos no van en el copy de la marca, tampoco en el manual.
for ( const archivo of [ 'inc/marca/contenido.php', 'inc/marca/papeles.php' ] ) {
  const texto = leer( archivo );
  for ( const linea of texto.split( '\n' ) ) {
    const dentroDeProsa = /vx_marca_p\(|vx_marca_pendiente\(|'bajada'|=>\s*'/.test( linea );
    if ( dentroDeProsa && linea.includes( '—' ) ) {
      fallos.push( `${ archivo } usa un guion largo en el copy: ${ linea.trim().slice( 0, 64 ) }` );
    }
  }
}

informar( 'guionado', fallos );
