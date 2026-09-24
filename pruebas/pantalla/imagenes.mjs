/**
 * Que ninguna imagen se deforme ni aparezca sin decir qué hay en ella.
 *
 * Una imagen sin alt deja fuera a quien no la ve, y una imagen estirada es la
 * marca mal puesta: el logotipo con la proporción cambiada es un logotipo
 * distinto.
 */

import { informar } from '../comun.mjs';
import { ANCHOS, enLaPagina } from '../comun-pantalla.mjs';

const fallos = await enLaPagina(
  async ( pagina ) =>
    pagina.evaluate( () => {
      const malos = [];
      for ( const img of document.images ) {
        const alt = img.getAttribute( 'alt' );
        const decorativa = img.getAttribute( 'aria-hidden' ) === 'true' || alt === '';
        if ( alt === null ) {
          malos.push( `${ img.currentSrc.split( '/' ).pop() } no dice qué hay en ella` );
        } else if ( ! decorativa && alt.trim().length < 3 ) {
          malos.push( `${ img.currentSrc.split( '/' ).pop() } tiene un alt que no describe nada: «${ alt }»` );
        }

        if ( ! img.complete || ! img.naturalWidth ) {
          malos.push( `${ img.currentSrc.split( '/' ).pop() } no cargó` );
          continue;
        }

        const caja = img.getBoundingClientRect();
        if ( ! caja.width || ! caja.height ) continue;
        const propia = img.naturalWidth / img.naturalHeight;
        const puesta = caja.width / caja.height;
        if ( Math.abs( propia - puesta ) / propia > 0.02 ) {
          malos.push( `${ img.currentSrc.split( '/' ).pop() } está deformada: nació ${ propia.toFixed( 2 ) } y se muestra ${ puesta.toFixed( 2 ) }` );
        }
      }
      return [ ...new Set( malos ) ];
    } )
  , { anchos: ANCHOS }
);

informar( 'imagenes', fallos );
