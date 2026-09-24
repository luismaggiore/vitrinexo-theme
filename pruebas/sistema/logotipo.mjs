/**
 * Que el logotipo no se dibuje a mano.
 *
 * El día que el logotipo cambie, cambia el archivo. Cada pantalla que escribe
 * la marca con tipografía propia, o que apunta a otra copia del archivo, es un
 * lugar donde va a seguir el logotipo viejo, y nadie se va a acordar de ese
 * lugar.
 */

import { informar, leer } from '../comun.mjs';

const OFICIAL = 'assets/img/vitrinexo.svg';
const fallos = [];

for ( const archivo of [ 'templates/page-marca.php', 'inc/marca/contenido.php', 'inc/marca/piezas.php' ] ) {
  const fuente = leer( archivo );

  // Las etiquetas se buscan sin el PHP: un <?php ... ?> dentro de un atributo
  // tiene un > que corta la etiqueta a la mitad, y la prueba terminaba
  // denunciando imágenes sin alt que sí lo tenían. Las rutas, en cambio, viven
  // dentro del PHP, así que esas se buscan en la fuente entera: medirlas sobre
  // el texto sin PHP es no medir ninguna.
  const etiquetas = fuente.replace( /<\?php[\s\S]*?\?>/g, 'PHP' );

  // Ninguna otra copia del logotipo.
  // Las fotos de referencia del manual viven en su propia carpeta y no son
  // logotipos; lo que se vigila es que nadie apunte a otra copia de la marca.
  for ( const [ , ruta ] of fuente.matchAll( /assets\/img\/(?!marca\/)([\w.-]+\.(?:svg|png|jpe?g))/g ) ) {
    if ( `assets/img/${ ruta }` !== OFICIAL ) fallos.push( `${ archivo } apunta a ${ ruta } en vez de al archivo oficial` );
  }

  // Toda imagen dice qué hay en ella.
  for ( const [ etiqueta ] of etiquetas.matchAll( /<img[^>]*>/g ) ) {
    if ( ! /\salt=/.test( etiqueta ) ) fallos.push( `${ archivo } tiene una imagen sin alt: ${ etiqueta.replace( /\s+/g, ' ' ).slice( 0, 64 ) }` );
  }

  // El logotipo se marca para que las pruebas de pantalla lo reconozcan: la
  // norma exime del contraste al texto que es parte de una marca, y sin marca
  // explícita esa exención habría que deducirla del tamaño o del color.
  if ( fuente.includes( OFICIAL ) ) {
    for ( const [ etiqueta ] of etiquetas.matchAll( /<img[^>]*>/g ) ) {
      if ( ! etiqueta.includes( 'data-logotipo' ) && ! etiqueta.includes( 'vx-imagen' ) ) {
        fallos.push( `${ archivo } pinta el logotipo sin data-logotipo: ${ etiqueta.replace( /\s+/g, ' ' ).slice( 0, 64 ) }` );
      }
    }
  }
}

informar( 'logotipo', fallos );
