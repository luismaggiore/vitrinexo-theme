/* Vitrinexo — editor-perfil.js
   Maneja la subida de foto de perfil del usuario con barra de progreso.
   Los logos/banners de empresa usan handlers inline del shortcode PHP.
*/
(function () {
  'use strict';

  // ── Foto de usuario (tipo='foto') ─────────────────────────────────────────────

  document.querySelectorAll( 'input[data-upload-type="foto"]' ).forEach( function ( input ) {
    if ( input.dataset.uploadInitialized ) return;
    input.dataset.uploadInitialized = '1';

    // Buscar el contenedor de progreso asociado (hermano o dentro del mismo wrapper)
    var container  = input.closest( '[data-upload-container]' ) || input.parentElement;
    var progressEl = container ? container.querySelector( '.vx-upload-progress' ) : null;

    input.addEventListener( 'change', function () {
      var file = input.files[0];
      if ( ! file ) return;

      // Preview optimista inmediato
      var previewEl = document.getElementById( 'vx-foto-preview' );
      if ( previewEl ) {
        var reader = new FileReader();
        reader.onload = function ( e ) {
          var img = previewEl.querySelector( 'img' );
          if ( ! img ) {
            img = document.createElement( 'img' );
            previewEl.appendChild( img );
          }
          img.src = e.target.result;
          img.style.cssText = 'width:60px;height:60px;border-radius:var(--radius-sm);object-fit:cover;border:2px solid var(--color-border)';
          var placeholder = previewEl.querySelector( 'i' );
          if ( placeholder ) placeholder.style.display = 'none';
        };
        reader.readAsDataURL( file );
      }

      // Subida con XHR + progreso
      if ( typeof window.vxUploadXHR !== 'function' ) {
        console.warn( 'vxUploadXHR no disponible todavía' );
        return;
      }

      window.vxUploadXHR(
        file,
        'foto',
        null,
        progressEl,
        function ( json ) {
          // Éxito — el servidor ya guardó vx_foto; la URL ya está en el preview
        },
        function ( msg ) {
          // Error — revertir preview
          if ( typeof vxShowError === 'function' ) vxShowError( msg );
          else alert( msg );
          if ( previewEl ) {
            var img = previewEl.querySelector( 'img' );
            if ( img ) img.src = '';
            var placeholder = previewEl.querySelector( 'i' );
            if ( placeholder ) placeholder.style.display = '';
          }
        }
      );
    } );
  } );

} )();
