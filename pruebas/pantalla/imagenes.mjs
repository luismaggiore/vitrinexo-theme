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
  async ( pagina ) => {
    // Las fotos van con loading="lazy", así que medir apenas termina la red da
    // por no cargada a la que todavía está pidiéndose. Se espera a que cada una
    // resuelva, para bien o para mal: lo que se quiere saber es cuál falló, no
    // cuál iba lenta.
    await pagina.evaluate( () => Promise.all(
      [ ...document.images ].map( ( img ) => img.complete ? null : new Promise( ( listo ) => {
        img.addEventListener( 'load', listo, { once: true } );
        img.addEventListener( 'error', listo, { once: true } );
      } ) )
    ) );

    return pagina.evaluate( () => {
      const malos = [];
      for ( const img of document.images ) {
        // El nombre sale del atributo y no de currentSrc: cuando la imagen no
        // carga, currentSrc viene vacío y el fallo no dice cuál es.
        const nombre = ( img.getAttribute( 'src' ) || '(sin src)' ).split( '/' ).pop();
        const alt = img.getAttribute( 'alt' );
        const decorativa = img.getAttribute( 'aria-hidden' ) === 'true' || alt === '';
        if ( alt === null ) {
          malos.push( `${ nombre } no dice qué hay en ella` );
        } else if ( ! decorativa && alt.trim().length < 3 ) {
          malos.push( `${ nombre } tiene un alt que no describe nada: «${ alt }»` );
        }

        if ( ! img.complete || ! img.naturalWidth ) {
          malos.push( `${ nombre } no cargó` );
          continue;
        }

        const caja = img.getBoundingClientRect();
        if ( ! caja.width || ! caja.height ) continue;
        const propia = img.naturalWidth / img.naturalHeight;
        const puesta = caja.width / caja.height;
        if ( Math.abs( propia - puesta ) / propia > 0.02 ) {
          malos.push( `${ nombre } está deformada: nació ${ propia.toFixed( 2 ) } y se muestra ${ puesta.toFixed( 2 ) }` );
        }
      }
      return [ ...new Set( malos ) ];
    } );
  }, { anchos: ANCHOS }
);

informar( 'imagenes', fallos );
