/**
 * Que no haya emojis en lo que la página de verdad muestra.
 *
 * La comprobación de sistema lee el código, y hay emojis que el código no
 * tiene: el selector de país armaba la bandera en tiempo de ejecución, desde el
 * código ISO, así que en el archivo no había ningún emoji que encontrar y en la
 * pantalla había veintiséis. Esta mide el texto renderizado, que es lo único
 * que ve una persona.
 *
 * Recorre las páginas públicas del sitio, no solo el manual: la regla es de la
 * marca entera.
 */

import { chromium } from 'playwright';
import { informar } from '../comun.mjs';
import { BASE } from '../comun-pantalla.mjs';

const RUTAS = [ '/', '/preguntas-frecuentes/', '/login/', '/marca' ];
const PICTOGRAMAS = /[\u{1F000}-\u{1FAFF}\u{2190}-\u{21FF}\u{2300}-\u{23FF}\u{2600}-\u{27BF}\u{2B00}-\u{2BFF}]/u;

const origen = new URL( BASE() ).origin;
const navegador = await chromium.launch();
const pagina = await navegador.newPage( { viewport: { width: 1200, height: 900 } } );

const fallos = [];
const medidas = [];

for ( const ruta of RUTAS ) {
  const url = origen + ruta;
  const r = await pagina.goto( url, { waitUntil: 'domcontentloaded' } ).catch( () => null );

  // Una página que no existe no se mide, y se dice cuál: una prueba que se
  // salta cosas en silencio da tranquilidad sin dar nada.
  if ( ! r || ! r.ok() ) continue;
  medidas.push( ruta );

  const encontrados = await pagina.evaluate( () => {
    const re = /[\u{1F000}-\u{1FAFF}\u{2190}-\u{21FF}\u{2300}-\u{23FF}\u{2600}-\u{27BF}\u{2B00}-\u{2BFF}]/gu;
    const texto = document.body.innerText + ' ' +
      [ ...document.querySelectorAll( 'option, [title], [aria-label], [placeholder]' ) ]
        .map( ( e ) => `${ e.textContent } ${ e.title } ${ e.getAttribute( 'aria-label' ) ?? '' } ${ e.placeholder ?? '' }` )
        .join( ' ' );
    return [ ...new Set( texto.match( re ) ?? [] ) ];
  } );

  // Una línea por página y no una por carácter: veintiséis banderas son un
  // solo defecto, y veintiséis líneas lo hacen parecer veintiséis.
  if ( encontrados.length ) {
    const muestra = encontrados.slice( 0, 6 ).join( ' ' );
    const resto = encontrados.length > 6 ? ` y ${ encontrados.length - 6 } más` : '';
    fallos.push( `${ ruta } muestra ${ encontrados.length } pictograma${ encontrados.length === 1 ? '' : 's' }: ${ muestra }${ resto }` );
  }
}

await navegador.close();

const noMedidas = RUTAS.filter( ( r ) => ! medidas.includes( r ) );
if ( noMedidas.length ) console.log( `      (no respondieron, no se midieron: ${ noMedidas.join( ', ' ) })` );

informar( 'emojis', fallos );
