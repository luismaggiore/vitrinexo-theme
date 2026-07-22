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
<body <?php body_class( 'vx-page-interior' ); ?>>

<?php get_template_part( 'partials/nav' ); ?>

<main>
  <div class="container py-5" style="max-width:820px">
    <div class="card-vx">
      <h1 style="font-size:clamp(1.5rem,3vw,2rem);font-weight:700;color:var(--color-text-primary);margin-bottom:1.5rem">
        <?php echo esc_html( $title ); ?>
      </h1>
      <div class="article-body" style="color:var(--color-text-secondary);line-height:1.8">
        <?php echo apply_filters( 'the_content', $content ); ?>
      </div>
    </div>
  </div>
</main>

<?php get_template_part( 'partials/footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
