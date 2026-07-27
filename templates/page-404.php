<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>404 · Página no encontrada | Vitrinexo</title>
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'vx-page-404' ); ?>>

<?php if ( is_user_logged_in() ) : ?>
  <?php get_template_part( 'partials/nav-logged' ); ?>
<?php else : ?>
  <?php get_template_part( 'partials/nav' ); ?>
<?php endif; ?>

<main>
  <div class="container py-6 text-center">
    <div class="vx-404">
      <div class="vx-404__code">404</div>
      <h1 class="vx-404__title">Página no encontrada</h1>
      <p class="text-muted mb-4">La página que buscas no existe o fue movida.</p>
      <?php if ( is_user_logged_in() ) : ?>
        <a href="<?php echo esc_url( home_url( '/dashboard/' ) ); ?>" class="btn-vx btn-vx--primary">Ir al dashboard</a>
      <?php else : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-vx btn-vx--primary">Ir al inicio</a>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php if ( is_user_logged_in() ) : ?>
  <?php get_template_part( 'partials/footer-logged' ); ?>
<?php else : ?>
  <?php get_template_part( 'partials/footer' ); ?>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
