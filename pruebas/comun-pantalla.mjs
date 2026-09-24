/**
 * Lo que comparten las comprobaciones que abren el navegador.
 *
 * Todas miden la misma página en los mismos anchos, así que abrir el navegador
 * y llevar la cuenta de los fallos se escribe una vez.
 */

import { chromium } from 'playwright';

/** Los anchos donde el documento tiene que sostenerse. */
export const ANCHOS = [ 390, 700, 1200, 1600 ];

export const BASE = () => process.argv[ 2 ] ?? 'https://vitrinexo.com/marca';

/**
 * Abre la página y se la pasa a la medición. La ventana se estira al alto del
 * documento: elementFromPoint solo responde dentro de lo visible, y una página
 * larga medida en una ventana corta deja sin medir todo lo que no se ve. Esa
 * es la trampa que hizo que una suite midiera el 24% de la página.
 */
export async function enLaPagina( medir, { anchos = [ 1200 ], alto = 900 } = {} ) {
  const navegador = await chromium.launch();
  const fallos = [];

  try {
    for ( const ancho of anchos ) {
      const contexto = await navegador.newContext( { viewport: { width: ancho, height: alto } } );
      const pagina = await contexto.newPage();
      await pagina.goto( BASE(), { waitUntil: 'networkidle' } );

      const altoDoc = await pagina.evaluate( () => document.documentElement.scrollHeight );
      await pagina.setViewportSize( { width: ancho, height: Math.min( altoDoc, 30000 ) } );

      for ( const f of await medir( pagina, ancho ) ) fallos.push( `[${ ancho }px] ${ f }` );
      await contexto.close();
    }
  } finally {
    await navegador.close();
  }

  return fallos;
}

/**
 * El color como lo devuelve el navegador no es el que está escrito: abrevia
 * #FFFFFF a rgb(255, 255, 255) y la translucidez la escribe aparte. Esto lo
 * deja en un hexadecimal de seis dígitos comparable.
 */
export const aHex = ( rgb ) => {
  const n = ( rgb.match( /[\d.]+/g ) ?? [] ).slice( 0, 3 ).map( ( x ) => Math.round( Number( x ) ) );
  return n.length === 3 ? '#' + n.map( ( x ) => x.toString( 16 ).padStart( 2, '0' ) ).join( '' ).toUpperCase() : rgb;
};
