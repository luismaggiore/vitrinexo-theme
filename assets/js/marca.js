/**
 * El menú del manual.
 *
 * Dos trabajos y nada más: abrir y cerrar el cajón en pantalla angosta, y
 * marcar en qué criterio estás. La marca se pone con aria-current, que es lo
 * que la lee el lector de pantalla, y el CSS la dibuja con contorno: el color
 * solo no llega al mínimo que la norma pide para lo que no es texto.
 */
( function () {
  'use strict';

  var cuerpo = document.body;
  var boton  = document.querySelector( '.vx-barra-menu' );
  var velo   = document.querySelector( '.vx-velo' );
  var menu   = document.getElementById( 'vx-menu' );
  if ( ! cuerpo || ! menu ) return;

  function abrir( si ) {
    cuerpo.classList.toggle( 'vx-menu-abierto', si );
    if ( boton ) boton.setAttribute( 'aria-expanded', si ? 'true' : 'false' );
    if ( velo ) velo.hidden = ! si;
  }

  if ( boton ) boton.addEventListener( 'click', function () {
    abrir( ! cuerpo.classList.contains( 'vx-menu-abierto' ) );
  } );
  if ( velo ) velo.addEventListener( 'click', function () { abrir( false ); } );

  document.addEventListener( 'keydown', function ( e ) {
    if ( e.key === 'Escape' ) abrir( false );
  } );

  // Al saltar a un criterio, el cajón se va: si se queda abierto tapa justo lo
  // que se acaba de pedir.
  menu.addEventListener( 'click', function ( e ) {
    if ( e.target.closest( 'a' ) ) abrir( false );
  } );

  // Dónde estás. El navegador avisa cuándo entra y sale cada bloque; escuchar
  // el scroll para recalcular lo mismo cuesta más y acierta menos.
  var enlaces = {};
  Array.prototype.forEach.call( menu.querySelectorAll( 'a[data-criterio]' ), function ( a ) {
    enlaces[ a.getAttribute( 'data-criterio' ) ] = a;
  } );

  var bloques = Object.keys( enlaces )
    .map( function ( id ) { return document.getElementById( id ); } )
    .filter( Boolean );
  if ( ! bloques.length || ! ( 'IntersectionObserver' in window ) ) return;

  var aqui = null;
  var vista = new IntersectionObserver( function ( entradas ) {
    var visibles = entradas
      .filter( function ( e ) { return e.isIntersecting; } )
      .sort( function ( a, b ) { return a.boundingClientRect.top - b.boundingClientRect.top; } );
    if ( ! visibles.length ) return;

    var id = visibles[ 0 ].target.id;
    if ( id === aqui ) return;
    if ( aqui && enlaces[ aqui ] ) enlaces[ aqui ].removeAttribute( 'aria-current' );
    aqui = id;
    enlaces[ id ].setAttribute( 'aria-current', 'true' );
  }, { rootMargin: '-10% 0px -70% 0px' } );

  bloques.forEach( function ( b ) { vista.observe( b ); } );
} )();
