<?php
/*
 * Template Name: Onboarding
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
<body <?php body_class( 'vx-page-onboarding ob-shell' ); ?>>

<?php the_content(); ?>

<?php wp_footer(); ?>
</body>
</html>
