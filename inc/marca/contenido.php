<?php
/**
 * El contenido del manual, criterio por criterio.
 *
 * Lo que está escrito acá es lo que alguien necesita para aplicar la marca sin
 * preguntar. Lo que todavía no se decidió dice qué falta y a quién hay que
 * preguntárselo: un hueco declarado se cierra; un hueco callado lo improvisa
 * cada quien a su manera.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ═══════════════════════════════════════════════════════ 01 Estrategia ══

function vx_marca_estrategia(): void {

    vx_marca_bloque( 'estrategia-contexto', function () {
        vx_marca_pendiente( 'En qué mercado compite Vitrinexo, contra qué alternativa concreta y qué problema resuelve que esa alternativa no resuelva. Lo decide el dueño de la marca.' );
    } );

    vx_marca_bloque( 'estrategia-que-significa-la-marca', function () {
        vx_marca_pendiente( 'El nombre desarmado: qué carga «vitrina» y qué carga «nexo», y cuál de las dos manda cuando hay que elegir.' );
    } );

    vx_marca_bloque( 'estrategia-tagline', function () {
        vx_marca_p( 'El sitio usa hoy <strong>«Conecta, colabora y crece»</strong> como bajada de la descripción, pero no está declarado como tagline en ninguna parte del código: se escribe a mano donde hace falta.' );
        vx_marca_pendiente( 'Si esa es la frase, se declara en un solo lugar del sistema y todo la lee de ahí. Si no lo es, hay que elegirla.' );
    } );

    vx_marca_bloque( 'estrategia-linea-de-producto', function () {
        vx_marca_p( 'Bajo la marca conviven hoy el directorio, las comunidades <strong>LGBTQ+</strong>, <strong>Woman</strong> y <strong>Senior</strong>, y <strong>Vitrinexo 4Dinner</strong>, las cenas de networking.' );
        vx_marca_pendiente( 'Cómo se nombra cada pieza respecto de la marca madre: si son productos con nombre propio, secciones del directorio o comunidades. De eso depende si «4Dinner» se escribe solo o siempre pegado a Vitrinexo.' );
    } );

    vx_marca_bloque( 'estrategia-mision', function () {
        vx_marca_pendiente( 'Qué hace Vitrinexo hoy, en una frase que no prometa lo que todavía no existe.' );
    } );

    vx_marca_bloque( 'estrategia-vision', function () {
        vx_marca_pendiente( 'A dónde va. El alcance es global: habla hispana, Brasil, Estados Unidos y Europa. La visión tiene que decirlo sin sonar a folleto.' );
    } );

    vx_marca_bloque( 'estrategia-valores', function () {
        vx_marca_pendiente( 'Cuatro o cinco, cada uno con su consecuencia práctica: qué se hace distinto por tenerlo. Un valor sin consecuencia es un adjetivo.' );
    } );

    vx_marca_bloque( 'estrategia-publicos-objetivos', function () {
        vx_marca_p( 'El producto ya distingue miembros por empresa, cargo, industria y país, y separa tres comunidades. Eso es segmentación del sistema, no públicos de la marca.' );
        vx_marca_pendiente( 'A quién le habla la marca, en las palabras de esa persona y no en las nuestras, y a quién deja fuera cada público.' );
    } );

    vx_marca_bloque( 'estrategia-objetivos-estrategicos', function () {
        vx_marca_p( 'El único número que el sistema hace cumplir hoy es el del programa de lanzamiento: los <strong>primeros 100 miembros aprobados</strong> reciben el distintivo de Miembro Pionero, y la membresía vence a los <strong>90 días</strong> de la aprobación.' );
        vx_marca_pendiente( 'Los objetivos del negocio, con número y plazo cuando lo haya.' );
    } );

    vx_marca_bloque( 'estrategia-propuesta-de-valor', function () {
        vx_marca_pendiente( 'Qué promete Vitrinexo y a cambio de qué. Hoy el sitio lo cuenta por secciones (el problema, cómo funciona, para quién es), pero la promesa no está enunciada en una frase.' );
    } );
}

// ═════════════════════════════════════════════════ 02 Identidad visual ══

function vx_marca_identidad(): void {

    vx_marca_bloque( 'identidad-logotipo', function () {
        vx_marca_p( 'El logotipo es un archivo vectorial, <code>assets/img/vitrinexo.svg</code>, de proporción <strong>1400 × 502</strong>. Se usa siempre ese archivo: ninguna pantalla lo vuelve a dibujar, ni con texto ni con formas.' );
        ?>
        <div class="vx-logo-caja">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/vitrinexo.svg' ); ?>"
                 alt="Logotipo de Vitrinexo: la palabra Vitrinexo en navy con el símbolo en degradado verde."
                 class="vx-logo" data-logotipo="1">
        </div>
        <?php
        vx_marca_p( 'El archivo trae dos colores que <strong>no están en la paleta del producto</strong>: un navy <code>#2F365B</code> y un degradado verde de <code>#62FA7C</code> a <code>#34998D</code>. El color de marca de la interfaz es el teal <code>#00AEB8</code>. Hoy la identidad está partida en dos.' ); // color ajeno: son los del archivo del logotipo, que es justo lo que este párrafo denuncia.
        vx_marca_pendiente( 'Cuál manda. Si manda el logotipo, la paleta de la interfaz tiene que acercarse al verde; si manda la interfaz, el logotipo se redibuja en teal. También falta el área de respeto y el tamaño mínimo medido.' );
    } );

    vx_marca_bloque( 'identidad-isotipo', function () {
        vx_marca_pendiente( 'No existe una versión reducida del logotipo. Hace falta para el favicon, el avatar de redes y cualquier lugar donde la palabra completa no se lea: a partir de qué tamaño reemplaza al logotipo y qué parte del símbolo sobrevive.' );
    } );

    vx_marca_bloque( 'identidad-tipografias', function () {
        vx_marca_p( '<strong>Switzer Variable</strong>, y nada más. Se sirve desde el propio servidor en <code>assets/fonts/</code>, en eje de peso continuo de 100 a 900, con romana e itálica.' );
        vx_marca_p( 'Una sola familia en dos papeles: <code>--font-display</code> para lo que se lee antes y <code>--font-body</code> para el cuerpo. Hoy las dos apuntan a Switzer, y tenerlas separadas es lo que permite cambiar una sin tocar la otra.' );
        vx_marca_p( 'De los nueve pesos disponibles se usan cuatro: <strong>400</strong> para prosa, <strong>500</strong> para lo que acompaña, <strong>600</strong> para nombres y títulos, y <strong>700</strong> para el énfasis fuerte. Los demás existen y no se usan.' );
    } );

    vx_marca_bloque( 'identidad-jerarquia', function () {
        vx_marca_p( 'La jerarquía se arma con tres cosas y en este orden: <strong>tamaño</strong>, <strong>peso</strong> y <strong>tinta</strong>. El color nunca es lo único que distingue un nivel del siguiente, porque quien no distingue ese color se queda sin jerarquía.' );
        vx_marca_p( 'Un solo titular por pantalla. Lo que sigue baja un peldaño de la escala; saltarse dos peldaños para «que se note más» es lo que deja la página sin niveles intermedios.' );
        vx_marca_p( 'Esta página obedece la escala peldaño por peldaño, así que si alguien la rompe se nota leyendo.' );
    } );

    vx_marca_bloque( 'identidad-escala-tipografica', function () {
        vx_marca_p( 'Ocho peldaños y nada entre medio. Cada uno se muestra acá con el peldaño que documenta: lo que lees es el token, no una imagen del token.' );
        foreach ( [
            [ '--fs-display', 'Titular de portada', 'Uno por página, y solo en portada.' ],
            [ '--fs-h2', 'Parte', 'El título de una sección mayor, con su número al lado.' ],
            [ '--fs-h3', 'Declaración', 'Una frase que se sostiene sola. Es contenido, no rótulo.' ],
            [ '--fs-h4', 'Bloque', 'El título de un bloque dentro de una sección.' ],
            [ '--fs-body-l', 'Bajada', 'La entradilla de una parte. Más grande que la prosa porque se lee antes.' ],
            [ '--fs-body', 'Prosa', 'El cuerpo. Es el peldaño por defecto: si dudas, es este.' ],
            [ '--fs-body-s', 'Nota', 'Lo secundario, en tinta de apoyo.' ],
            [ '--fs-caption', 'Etiqueta y dato', 'Distintivos, pies de muestra y valores sueltos.' ],
        ] as [ $token, $uso, $como ] ) {
            vx_marca_peldano_texto( $token, $uso, $como );
        }
        vx_marca_p( 'La escala se agregó al sistema con este manual. El CSS del producto trae <strong>277 declaraciones de tamaño escritas a mano</strong>, de las cuales <strong>166 caen fuera de estos ocho peldaños</strong>. Solo 13 px aparece 55 veces. Migrarlas es trabajo aparte y está anotado en el registro de decisiones.' );
    } );

    vx_marca_bloque( 'identidad-paleta-de-color', function () {
        vx_marca_p( 'La paleta tiene dos capas y solo una se puede nombrar desde una pantalla.' );
        vx_marca_p( '<strong>Los primitivos son la escala.</strong> Cinco rampas de diez peldaños. No significan nada: son colores. Una rampa puede tener peldaños sin usar, y existe justamente para que lo próximo que haga falta caiga en un peldaño en vez de inventar un color nuevo.' );

        $prim = vx_marca_grupos_primitivos();
        foreach ( vx_marca_grupos_tokens() as $g ) {
            if ( in_array( $g['titulo'], $prim, true ) ) vx_marca_rampa( $g['titulo'], $g['tokens'] );
        }

        vx_marca_p( '<strong>Los papeles dicen para qué sirve cada color, nunca de qué color son.</strong> Es lo único que una pantalla puede nombrar. El día que el teal cambie de valor, cambia en un lugar; cada primitivo suelto en una pantalla es un sitio donde no va a cambiar.' );

        foreach ( vx_marca_familias() as $f ) {
            $primero = array_key_first( $f['papeles'] );
            if ( str_starts_with( (string) $primero, '--color' ) ) vx_marca_familia( $f );
        }

        vx_marca_p( '<strong>El teal de marca no alcanza el mínimo de contraste.</strong> Medido contra la superficie de las tarjetas da 2,64:1 como texto. Con tinta blanca encima, que es como se pinta todo botón primario, da 2,71:1. El mínimo para texto es 4,5:1.' );
        ?>
        <div class="vx-celdas">
            <?php
            vx_marca_celda( '--color-primary', '--color-surface' );
            vx_marca_celda( '--color-text-inverse', '--color-primary' );
            vx_marca_celda( '--color-accent', '--color-surface' );
            vx_marca_celda( '--color-text-primary', '--color-surface' );
            vx_marca_celda( '--color-text-secondary', '--color-surface' );
            vx_marca_celda( '--color-secondary', '--color-surface' );
            ?>
        </div>
        <?php
        vx_marca_p( 'Para el texto ya hay salida y está aplicada: <code>--color-primary-ink</code>, el teal que sí se lee. Es el peldaño 900, y se eligió midiendo: el 800 pasa sobre la tarjeta con 4,51:1 pero se queda en <strong>4,37:1</strong> sobre el fondo de página, y un papel que pasa en una superficie y falla en la de al lado no sirve. El 900 da 6,48:1 en el peor caso de las tres superficies del sistema.' );
        ?>
        <div class="vx-celdas">
            <?php
            vx_marca_celda( '--color-primary-ink', '--color-background' );
            vx_marca_celda( '--color-primary-ink', '--color-surface' );
            vx_marca_celda( '--color-primary-ink', '--color-surface-muted' );
            ?>
        </div>
        <?php
        vx_marca_p( 'El mismo problema tienen dos estados: <code>--color-success</code> da 2,70:1 sobre el fondo de página y <code>--color-warning</code> da 2,98:1. Como tinta no se leen. Sirven como fondo, junto a sus pares <code>-bg</code>, y el texto encima va en tinta normal.' );
        vx_marca_p( 'Lo que queda sin resolver es el botón: el fondo teal con tinta blanca encima da 2,71:1, y arreglarlo cambia el color de todos los botones primarios del producto.' );
        vx_marca_pendiente( 'Esa decisión es de sistema y la toma quien responde por la marca: o el botón primario se pinta con el teal que se lee, o el teal de marca deja de ser fondo de botón.' );
    } );

    vx_marca_bloque( 'identidad-iconografia', function () {
        vx_marca_p( '<strong>Tabler Icons 3.19.0</strong>, servidos como fuente de íconos. Trazo de 2 px sobre rejilla de 24, esquinas redondeadas, sin relleno.' );
        vx_marca_p( 'Un ícono nunca va solo cuando es la única manera de entender una acción: lleva texto al lado o etiqueta accesible. Y toma su color de la tinta que lo rodea, nunca uno propio.' );
        vx_marca_p( 'No se mezclan familias. Si falta un ícono, se busca en Tabler antes que en cualquier otro sitio, y si no está, se pide dibujarlo con el mismo trazo.' );
    } );

    vx_marca_bloque( 'identidad-motivos', function () {
        vx_marca_p( 'El motivo de la marca es la <strong>red</strong>: puntos que se unen con líneas, animada sobre el fondo en <code>assets/js/network.js</code>. Es la imagen literal de lo que hace el producto, así que no compite con el contenido: va detrás, tenue, y el contenido siempre queda encima.' );
        vx_marca_p( 'Aparece en la portada y en las páginas legales. No se usa como textura de tarjeta, ni detrás de texto largo, ni en correos.' );
    } );

    vx_marca_bloque( 'identidad-direccion-fotografica', function () {
        vx_marca_pendiente( 'El sitio tiene hoy seis imágenes, todas de la sección 4Dinner, sin criterio escrito. Falta definir la dirección por sujeto: personas, ambientes y producto, cada uno con su regla y con un prompt para generarlas.' );
    } );

    vx_marca_bloque( 'identidad-favicon', function () {
        vx_marca_pendiente( 'El sitio no declara favicon: la pestaña muestra el ícono genérico del navegador. Hace falta el isotipo primero, porque el logotipo completo no se lee a 16 px.' );
    } );

    vx_marca_bloque( 'identidad-imagen-para-compartir', function () {
        vx_marca_pendiente( 'El sitio no declara imagen para compartir ni descripción para redes: quien pega un enlace de Vitrinexo en LinkedIn o WhatsApp ve una tarjeta vacía. Falta la pieza de 1200 × 630 y qué texto lleva.' );
    } );
}

// ══════════════════════════════════════════════════════════════ 03 Voz ══

function vx_marca_voz(): void {

    vx_marca_bloque( 'voz-idioma', function () {
        vx_marca_p( '<strong>Español de Chile</strong>, y se trata de tú. Nunca voseo: «tienes» y «puedes», no «tenés» ni «podés».' );
        vx_marca_p( 'El alcance de la marca es global: habla hispana, Brasil, Estados Unidos y Europa. Ningún texto restringe geográficamente el producto ni lo llama latinoamericano.' );
        vx_marca_pendiente( 'Qué pasa con el portugués y el inglés cuando entren Brasil y Estados Unidos: si es el mismo texto traducido o se escribe aparte.' );
    } );

    vx_marca_bloque( 'voz-tono', function () {
        vx_marca_pendiente( 'Cómo suena la marca con cada público, con ejemplos y con lo que nunca se dice. Depende de los públicos, que todavía no están escritos.' );
    } );

    vx_marca_bloque( 'voz-mayusculas-y-minusculas', function () {
        vx_marca_p( '<strong>Tipo oración en todas partes</strong>: en títulos, botones, etiquetas y avisos. Solo va mayúscula la primera letra y lo que sea nombre propio.' );
        vx_marca_p( 'La caja alta se reserva para los sobretítulos, que son rótulos de sección y no texto para leer. Nunca se usa para dar énfasis: para eso está el peso.' );
        vx_marca_p( 'El nombre de la marca se escribe siempre <strong>Vitrinexo</strong>, con una sola mayúscula. Nunca «VitriNexo» ni «VITRINEXO», tampoco en logotipos de terceros ni en firmas de correo.' );
    } );

    vx_marca_bloque( 'voz-vocabulario', function () {
        vx_marca_p( 'Los términos del producto tienen una sola forma. No son sinónimos intercambiables: cada uno de la izquierda es el que está en la base de datos, en los correos y en la interfaz.' );
        vx_marca_vocabulario( [
            [ 'Vitrinexo', 'VitriNexo, Vitrinexo.com' ],
            [ 'Miembro Pionero', 'Socio Fundador, Afiliado Original, early adopter' ],
            [ 'distintivo', 'badge, insignia' ],
            [ 'miembro', 'usuario, cliente, afiliado' ],
            [ 'perfil', 'ficha, tarjeta de empresa' ],
            [ 'conexión', 'match, contacto, vínculo' ],
            [ 'directorio', 'listado, catálogo, base de datos' ],
            [ 'membresía', 'suscripción, plan de pago' ],
        ] );
        vx_marca_p( 'Fuera de la lista hay una regla de puntuación: <strong>no se usan guiones largos</strong> en ningún texto de la marca. Donde aparezca uno va una coma, un punto o dos puntos.' );
        vx_marca_pendiente( 'Faltan las palabras prohibidas sin reemplazo, esas que no se dicen de ninguna forma. Se completan cuando esté escrito el tono.' );
    } );

    vx_marca_bloque( 'voz-patrones-de-copy', function () {
        vx_marca_pendiente( 'Las formas fijas: cómo se escribe un botón, un título, un error y un aviso. Hoy conviven «Inscríbete», «Ingresar» y «Escribir por WhatsApp» en la misma pantalla, que son tres formas distintas de pedir lo mismo.' );
    } );

    vx_marca_bloque( 'voz-numeros-y-formatos', function () {
        vx_marca_p( 'El teléfono se guarda y se muestra <strong>con prefijo internacional</strong>, con el signo más adelante, porque es lo que necesita el botón de WhatsApp para funcionar desde cualquier país.' );
        vx_marca_pendiente( 'Moneda, fecha, hora y porcentaje. Con alcance global hay que decidir si la fecha se escribe en formato chileno o en uno que se lea igual en todas partes.' );
    } );

    vx_marca_bloque( 'voz-emojis', function () {
        vx_marca_p( 'Hoy el producto usa emojis en al menos un lugar: el aviso de perfil en validación empieza con un reloj de arena.' );
        vx_marca_pendiente( 'Sí o no, y dónde. Una respuesta clara vale más que una política larga. Si la respuesta es que no, hay que sacar el reloj de arena de ese aviso.' );
    } );
}
