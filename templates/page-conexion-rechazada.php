<?php
/*
 * Template Name: Conexión rechazada
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'vx-page-conexion-rechazada' ); ?>>

<?php get_template_part( 'partials/nav' ); ?>

<main>
  <?php the_content(); ?>
</main>

<?php get_template_part( 'partials/footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
