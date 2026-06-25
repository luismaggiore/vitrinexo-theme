<?php
/*
 * Template Name: Landing
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$vx_is_logged = is_user_logged_in();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'vx-page-landing' ); ?>>

<?php if ( $vx_is_logged ) : ?>
  <?php get_template_part( 'partials/nav-logged' ); ?>
<?php else : ?>
  <?php get_template_part( 'partials/nav' ); ?>
<?php endif; ?>

<main>
  <?php echo do_shortcode( '[vx_landing]' ); ?>
</main>

<?php if ( $vx_is_logged ) : ?>
  <?php get_template_part( 'partials/footer-logged' ); ?>
<?php else : ?>
  <?php get_template_part( 'partials/footer' ); ?>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
