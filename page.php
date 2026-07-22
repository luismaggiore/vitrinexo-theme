<?php
if ( ! defined( 'ABSPATH' ) ) exit;

the_post();
$title   = get_the_title();
$content = get_the_content();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'vx-page-legal' ); ?>>

<?php get_template_part( 'partials/nav' ); ?>

<main class="vx-legal-main">
  <div class="vx-legal-container">

    <header class="vx-legal-header">
      <p class="vx-legal-eyebrow">Vitrinexo</p>
      <h1 class="vx-legal-title"><?php echo esc_html( $title ); ?></h1>
    </header>

    <div class="vx-legal-body">
      <?php echo apply_filters( 'the_content', $content ); ?>
    </div>

  </div>
</main>

<?php get_template_part( 'partials/footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
