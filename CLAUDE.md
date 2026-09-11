# Vitrinexo — Tema WordPress

## El proyecto

Vitrinexo es una plataforma B2B de directorio de servicios profesionales. Empresa independiente. **Nunca mencionar Maggiore Marketing**. **No restringir geográficamente** — visión global (habla hispana, Brasil, EEUU, Europa).

**Sitio:** https://vitrinexo.com  
**Par de repositorios:** `luismaggiore/vitrinexo-theme` (este) y `luismaggiore/vitrinexo-core`

## Reglas no negociables

- Siempre **Vitrinexo** — nunca "VitriNexo"
- Programa: **Miembro Pionero / Miembros Pioneros**
- Siempre **"distintivo"** — nunca "badge"
- Sin guiones largos (—) en copy
- Español chileno: "tienes", "puedes" — nunca voseo

## Stack

- WordPress 7.0, Bootstrap 5.3.3, Tabler Icons 3.19.0
- Fuente: Switzer Variable
- Colores: `--color-primary: #00aeb8` (teal), navy `#1a2335`
- CSS en `assets/css/style.css` (usar CSS variables del sistema de diseño)

## Estructura del tema

```
vitrinexo-theme/
├── functions.php                ← enqueue de assets, condicionales por página
├── page.php                     ← template para páginas interiores (privacidad, términos)
│                                   Incluye nav, animación de red (network.js), footer
├── assets/
│   ├── css/style.css            ← sistema de diseño completo con CSS variables
│   ├── js/
│   │   ├── main.js
│   │   └── network.js           ← animación de puntos y líneas (canvas, fixed, z-index:0)
│   └── img/
│       ├── vitrinexo.svg        ← logo principal (dark, para fondo claro)
│       └── vitrinexo-email.png  ← logo para emails (PNG 144×52px, fondo transparente)
├── templates/
│   └── front-page.php           ← landing page principal
└── partials/
    ├── nav.php
    └── footer.php               ← incluye links a /privacidad/ y /terminos/
```

## Deploy

Push a `main` → GitHub Actions → rsync SSH → Hostinger.

```yaml
# Secrets requeridos en el repo
SSH_HOST: 195.200.3.42
SSH_PORT: 65002
SSH_USERNAME: u969893599
SSH_PRIVATE_KEY: <clave Ed25519 privada>
SSH_TARGET: /home/u969893599/public_html/wp-content/themes/vitrinexo-theme
```

El workflow tiene **retry automático** (90s entre intentos). Autenticación por SSH key, nunca contraseña.

## Animación de red (network.js)

Se carga en `functions.php` condicionalmente:

```php
if ( is_front_page() || is_page( [ 'privacidad', 'terminos' ] ) ) {
    wp_enqueue_script( 'vitrinexo-network', $uri . '/assets/js/network.js', [], $ver, true );
}
```

El canvas se inyecta automáticamente con `position: fixed; z-index: 0`. El contenido de la página debe tener `position: relative; z-index: 1` para quedar encima.

## Páginas legales

`/privacidad/` y `/terminos/` usan el template `page.php`:
- Fondo blanco transparente sobre la animación de red
- Tipografía Vitrinexo: Switzer, navy, teal
- Sin mención a Maggiore ni restricción geográfica
- El nav y footer se incluyen igual que el resto del sitio

## Dominios

- `vitrinexo.com` — dominio principal
- `vitrinexo.cl` — dominio aparcado (alias completo, mismo contenido). Gestionado en hPanel → Dominios aparcados.

## Caché

Después de cambios en assets estáticos (imágenes, CSS), purgar el CDN de Hostinger manualmente:
**hPanel → vitrinexo.com → Rendimiento → CDN → Vaciar caché**

LiteSpeed se purga automáticamente al hacer deploy.

## Pendientes

- Integración de pagos con Stripe
- Contenido de la sección 4Dinner (solo tiene header)
