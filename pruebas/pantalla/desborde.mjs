/**
 * Que el documento no se salga de la pantalla por el costado.
 *
 * Una tabla de colores, un bloque de código o una palabra larga bastan para
 * que aparezca la barra horizontal, y con ella la página entera se corre al
 * arrastrar. Se mide en los cuatro anchos, y cuando desborda se nombra al
 * culpable: «hay desborde» sin decir de quién manda a buscar a ciegas.
 */

import { informar } from '../comun.mjs';
import { ANCHOS, enLaPagina } from '../comun-pantalla.mjs';

const fallos = await enLaPagina(
  async ( pagina, ancho ) =>
    pagina.evaluate( ( limite ) => {
      const malos = [];
      // Los dos, y el mayor: con la raíz sola, una tabla que se sale del body
      // no mueve el número y la prueba pasa con la página desbordada. Es lo que
      // pasó la primera vez que se probó rompiéndola a propósito.
      const ancho = Math.max( document.documentElement.scrollWidth, document.body.scrollWidth );
      if ( ancho > limite + 1 ) {
        malos.push( `el documento mide ${ ancho } de ancho y la ventana ${ limite }` );

        for ( const el of document.querySelectorAll( 'body *' ) ) {
          const caja = el.getBoundingClientRect();
          if ( caja.right > limite + 1 && getComputedStyle( el ).position !== 'fixed' ) {
            const nombre = `${ el.tagName.toLowerCase() }.${ ( el.className || '' ).toString().split( ' ' )[ 0 ] }`;
            malos.push( `${ nombre } llega hasta ${ Math.round( caja.right ) }` );
          }
        }
      }
      return [ ...new Set( malos ) ].slice( 0, 6 );
    }, ancho )
  , { anchos: ANCHOS }
);

informar( 'desborde', fallos );
