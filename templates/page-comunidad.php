<?php
/*
 * Template Name: Comunidad
 */
if ( ! defined( 'ABSPATH' ) ) exit;
$slug = get_post_field( 'post_name', get_queried_object_id() );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'vx-page-comunidad vx-page-comunidad--' . esc_attr( $slug ) ); ?>>
<?php get_template_part( 'partials/nav-logged' ); ?>
<main>
  <?php the_content(); ?>
</main>
<?php get_template_part( 'partials/footer-logged' ); ?>
<?php wp_footer(); ?>
</body>
</html>
