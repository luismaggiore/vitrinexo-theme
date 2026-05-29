<?php
/*
 * Template Name: Blog
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
<body <?php body_class( 'vx-page-blog bg-page-vx' ); ?>>

<?php
if ( is_user_logged_in() ) {
    get_template_part( 'partials/nav-logged' );
} else {
    get_template_part( 'partials/nav' );
}
?>

<main>
  <?php echo do_shortcode( '[vx_blog]' ); ?>
</main>

<?php
if ( is_user_logged_in() ) {
    get_template_part( 'partials/footer-logged' );
} else {
    get_template_part( 'partials/footer' );
}
?>
<?php wp_footer(); ?>
</body>
</html>
