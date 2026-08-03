<?php
/*
 * Template Name: Ayuda
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
<body <?php body_class( 'vx-page-ayuda' ); ?>>

<?php
// Miembro logueado → header/footer de miembro; visitante → header/footer público.
if ( $vx_is_logged ) {
    get_template_part( 'partials/nav-logged' );
} else {
    get_template_part( 'partials/nav' );
}
?>

<main>
  <?php echo do_shortcode( '[vx_ayuda]' ); ?>
</main>

<?php
if ( $vx_is_logged ) {
    get_template_part( 'partials/footer-logged' );
} else {
    get_template_part( 'partials/footer' );
}
?>
<?php wp_footer(); ?>
</body>
</html>
