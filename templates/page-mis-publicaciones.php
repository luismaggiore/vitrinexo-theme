<?php
/*
 * Template Name: Mis Publicaciones
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
<body <?php body_class( 'vx-page-mis-publicaciones' ); ?>>

<?php get_template_part( 'partials/nav-logged' ); ?>

<?php echo do_shortcode( '[vx_mis_publicaciones]' ); ?>

<?php get_template_part( 'partials/footer-logged' ); ?>
<?php wp_footer(); ?>
</body>
</html>
