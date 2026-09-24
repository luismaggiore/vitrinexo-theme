/**
 * Contraste real, medido sobre la página renderizada.
 *
 * No mira los tokens: mira cada elemento con texto, resuelve su color efectivo
 * y el fondo que de verdad queda debajo, y compara contra el mínimo que le
 * toca por tamaño y peso. Un token puede pasar en el papel y fallar en la
 * pantalla si alguien lo puso sobre el fondo equivocado.
 *
 * Umbrales AA: 4,5:1 para texto normal y 3:1 para texto grande, que es 24 px o
 * más, o 18,66 px o más si va en negrita.
 *
 * El logotipo no se mide: la norma exime al texto que es parte de una marca.
 * Se reconoce por data-logotipo, que es un atributo explícito y no una
 * deducción a partir del tamaño.
 */

import { informar } from '../comun.mjs';
import { enLaPagina } from '../comun-pantalla.mjs';

const fallos = await enLaPagina( async ( pagina ) =>
  pagina.evaluate( () => {
    // Cada color se resuelve pintándolo en un lienzo de un píxel, que es el
    // único que sabe de verdad qué color es: getComputedStyle puede devolver
    // oklab() o color(), y leerle los tres primeros números da un color que no
    // existe.
    const lienzo = document.createElement( 'canvas' ).getContext( '2d', { willReadFrequently: true } );
    const rgba = ( css ) => {
      lienzo.clearRect( 0, 0, 1, 1 );
      lienzo.fillStyle = css;
      lienzo.fillRect( 0, 0, 1, 1 );
      const [ r, g, b, a ] = lienzo.getImageData( 0, 0, 1, 1 ).data;
      return [ r, g, b, a / 255 ];
    };

    const luminancia = ( [ r, g, b ] ) => {
      const c = ( v ) => { v /= 255; return v <= 0.03928 ? v / 12.92 : ( ( v + 0.055 ) / 1.055 ) ** 2.4; };
      return 0.2126 * c( r ) + 0.7152 * c( g ) + 0.0722 * c( b );
    };
    const razon = ( a, b ) => {
      const [ x, y ] = [ luminancia( a ), luminancia( b ) ];
      return ( Math.max( x, y ) + 0.05 ) / ( Math.min( x, y ) + 0.05 );
    };
    const sobre = ( frente, fondo ) => frente.slice( 0, 3 ).map( ( v, i ) => v * frente[ 3 ] + fondo[ i ] * ( 1 - frente[ 3 ] ) );

    /** El fondo que de verdad queda debajo, compuesto hacia arriba. */
    const fondoDe = ( el ) => {
      let color = [ 255, 255, 255, 1 ];
      const capas = [];
      for ( let n = el; n; n = n.parentElement ) {
        const c = rgba( getComputedStyle( n ).backgroundColor );
        if ( c[ 3 ] > 0 ) capas.push( c );
        if ( c[ 3 ] === 1 ) break;
      }
      for ( const capa of capas.reverse() ) color = [ ...sobre( capa, color ), 1 ];
      return color;
    };

    const malos = [];
    for ( const el of document.querySelectorAll( 'body *' ) ) {
      // El logotipo está exento por norma; la demostración de un contraste
      // que falla es el contenido mismo del manual y se declara en la línea.
      if ( el.closest( '[data-logotipo]' ) || el.closest( '[data-demostracion]' ) ) continue;

      const texto = [ ...el.childNodes ].some( ( n ) => n.nodeType === 3 && n.textContent.trim() );
      if ( ! texto ) continue;

      const caja = el.getBoundingClientRect();
      const estilo = getComputedStyle( el );
      if ( ! caja.width || ! caja.height || estilo.visibility === 'hidden' || estilo.opacity === '0' ) continue;
      // El texto que solo existe para el lector de pantalla está recortado a un
      // píxel: no se ve, así que no hay contraste que medirle.
      if ( caja.width <= 1 || caja.height <= 1 || estilo.clipPath.startsWith( 'inset(50%' ) ) continue;

      const px = parseFloat( estilo.fontSize );
      const peso = Number( estilo.fontWeight ) || 400;
      const grande = px >= 24 || ( px >= 18.66 && peso >= 700 );
      const minimo = grande ? 3 : 4.5;

      const tinta = rgba( estilo.color );
      const fondo = fondoDe( el );
      const r = razon( sobre( tinta, fondo ), fondo );

      if ( r < minimo ) {
        malos.push( `${ el.tagName.toLowerCase() }.${ ( el.className || '' ).toString().split( ' ' )[ 0 ] } da ${ r.toFixed( 2 ) }:1 y necesita ${ minimo }:1 — «${ el.textContent.trim().slice( 0, 40 ) }»` );
      }
    }
    return [ ...new Set( malos ) ];
  } )
);

informar( 'contraste', fallos );
