/**
 * Que la página obedezca la escala que documenta.
 *
 * El manual afirma que está escrito con sus propios peldaños, y eso hay que
 * comprobarlo viéndolo: el tamaño y el tracking se heredan, y una regla vieja
 * del tema puede estar pisando el token sin que nadie lo note. Pasó: h1 y h2
 * llevaban -0,07em de una regla global, que a 40 px son 2,8 px de menos entre
 * letra y letra, y el titular se leía apretado.
 *
 * Se compara el valor renderizado contra el token, no contra un número escrito
 * a mano acá: un valor copiado se desincroniza en cuanto alguien mueve la
 * escala.
 */

import { informar, resolver, tokensDelSistema } from '../comun.mjs';
import { enLaPagina } from '../comun-pantalla.mjs';

/** Qué peldaño le toca a cada pieza del manual. */
const PIEZAS = [
  [ '.vx-display', '--fs-display', '--ls-display' ],
  [ '.vx-h2', '--fs-h2', '--ls-h2' ],
  [ '.vx-h3', '--fs-h3', '--ls-h3' ],
  [ '.vx-h4', '--fs-h4', '--ls-h4' ],
  [ '.vx-bajada', '--fs-body-l', '--ls-body-l' ],
  [ '.vx-p', '--fs-body', '--ls-body' ],
  [ '.vx-nota', '--fs-body-s', '--ls-body-s' ],
  [ '.vx-sobretitulo', '--fs-caption', '--ls-sobretitulo' ],
];

const mapa = Object.fromEntries( tokensDelSistema().flatMap( ( g ) => g.tokens.map( ( t ) => [ t.nombre, t.valor ] ) ) );
const px = ( token ) => parseFloat( resolver( mapa[ token ] ?? '', mapa ) );
const em = ( token ) => parseFloat( resolver( mapa[ token ] ?? '', mapa ) );

const esperado = PIEZAS.map( ( [ sel, fs, ls ] ) => ( { sel, tam: px( fs ), tracking: em( ls ) * px( fs ) } ) );

const fallos = await enLaPagina( async ( pagina ) =>
  pagina.evaluate( ( piezas ) => {
    const malos = [];
    for ( const { sel, tam, tracking } of piezas ) {
      const el = document.querySelector( sel );
      if ( ! el ) { malos.push( `no hay ningún ${ sel } en la página` ); continue; }

      const s = getComputedStyle( el );
      const tamReal = parseFloat( s.fontSize );
      // «normal» es cero de tracking, y es lo que devuelve quien no lo declara.
      const trackingReal = s.letterSpacing === 'normal' ? 0 : parseFloat( s.letterSpacing );

      if ( Math.abs( tamReal - tam ) > 0.5 ) {
        malos.push( `${ sel } mide ${ tamReal }px y su peldaño dice ${ tam }px` );
      }
      if ( Math.abs( trackingReal - tracking ) > 0.05 ) {
        malos.push( `${ sel } lleva ${ trackingReal.toFixed( 2 ) }px de tracking y su peldaño dice ${ tracking.toFixed( 2 ) }px` );
      }
    }
    return malos;
  }, esperado )
);

informar( 'tipografia', fallos );
