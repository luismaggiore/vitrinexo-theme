<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! have_posts() ) {
    wp_safe_redirect( home_url( '/blog/' ) );
    exit;
}

the_post();

$post_id     = get_the_ID();
$title       = get_the_title();
$content     = get_the_content();
$date        = get_the_date( 'j \d\e F Y' );
$author_id   = (int) get_the_author_meta( 'ID' );
$author_name = get_the_author();
$author_bio  = get_the_author_meta( 'description' );
$author_role = get_the_author_meta( 'user_title' ) ?: get_the_author_meta( 'job_title' ) ?: '';
$avatar_url  = get_avatar_url( $author_id, [ 'size' => 96 ] );
$author_slug = (string) get_user_meta( $author_id, 'vx_perfil_slug', true );
$categories  = get_the_category();
$tags        = get_the_tags() ?: [];
$cat_name    = $categories[0]->name ?? 'Blog';
$read_time   = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( $content ) ) / 200 ) );

$has_thumb   = has_post_thumbnail();
$thumb_url   = $has_thumb ? get_the_post_thumbnail_url( $post_id, 'vx-banner' ) : '';
$hero_style  = $has_thumb
    ? 'background:url(' . esc_url( $thumb_url ) . ') center/cover no-repeat'
    : 'background:linear-gradient(135deg,var(--color-cyan-700) 0%,var(--color-green-600) 100%)';

$prev_post = get_previous_post();
$next_post = get_next_post();

// Related posts (same category, excluding current)
$related = get_posts( [
    'category__in'   => wp_list_pluck( $categories, 'term_id' ),
    'post__not_in'   => [ $post_id ],
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
] );

$related_gradients = [
    'linear-gradient(135deg,var(--color-purple-600),var(--color-purple-400))',
    'linear-gradient(135deg,#f59e0b,#f97316)',
    'linear-gradient(135deg,var(--color-pink-600),var(--color-pink-400))',
];
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'vx-single-blog bg-page-vx' ); ?>>

<?php
if ( is_user_logged_in() ) {
    get_template_part( 'partials/nav-logged' );
} else {
    get_template_part( 'partials/nav' );
}
?>

<main>
<div class="container py-4">
  <div class="row g-4 justify-content-center">

    <!-- ── COLUMNA ARTÍCULO ── -->
    <div class="col-12 col-lg-8">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb" style="font-size:12px;background:none;padding:0;margin:0">
          <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="link-primary-color">Blog</a></li>
          <li class="breadcrumb-item active" style="color:var(--color-text-secondary)"><?php echo esc_html( $cat_name ); ?></li>
        </ol>
      </nav>

      <!-- Header artículo -->
      <div class="card-vx p-0 mb-4 overflow-hidden">
        <div style="height:220px;<?php echo esc_attr( $hero_style ); ?>;display:flex;align-items:flex-end;padding:1.5rem;position:relative">
          <div>
            <span class="tag-vx" style="background:rgba(255,255,255,.2);border-color:rgba(255,255,255,.3);color:#fff;margin-bottom:.75rem;display:inline-block">
              <?php echo esc_html( $cat_name ); ?>
            </span>
            <h1 style="font-size:clamp(1.4rem,3vw,2rem);font-weight:600;color:#fff;line-height:1.2;margin:0;max-width:600px">
              <?php echo esc_html( $title ); ?>
            </h1>
          </div>
        </div>
        <div class="article-meta-bar">
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center gap-2">
              <img src="<?php echo esc_url( $avatar_url ); ?>" class="avatar-36" alt="<?php echo esc_attr( $author_name ); ?>">
              <div>
                <div class="text-body-label"><?php echo esc_html( $author_name ); ?></div>
                <div class="text-xs-muted"><?php echo esc_html( $date ); ?> · <?php echo esc_html( $read_time ); ?> min de lectura</div>
              </div>
            </div>
            <div class="d-flex gap-2">
              <button class="btn-vx btn-ghost-vx btn-vx-sm" onclick="navigator.share ? navigator.share({title:<?php echo wp_json_encode( $title ); ?>,url:window.location.href}) : navigator.clipboard.writeText(window.location.href)">
                <i class="ti ti-share-2"></i> Compartir
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Cuerpo del artículo -->
      <div class="card-vx mb-4 article-body">
        <?php echo apply_filters( 'the_content', $content ); ?>
      </div>

      <!-- Tags y navegación entre artículos -->
      <div class="card-vx d-flex align-items-center justify-content-between flex-wrap gap-3 mb-5">
        <div class="d-flex gap-1 flex-wrap">
          <?php foreach ( $categories as $cat ) : ?>
          <span class="tag-vx"><?php echo esc_html( $cat->name ); ?></span>
          <?php endforeach; ?>
          <?php foreach ( $tags as $tag ) : ?>
          <span class="tag-vx"><?php echo esc_html( $tag->name ); ?></span>
          <?php endforeach; ?>
        </div>
        <div class="d-flex gap-2">
          <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="btn-vx btn-ghost-vx btn-vx-sm">
            <i class="ti ti-arrow-left me-1"></i> Volver al blog
          </a>
          <?php if ( $next_post ) : ?>
          <a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" class="btn-vx btn-ghost-vx btn-vx-sm">
            Siguiente <i class="ti ti-arrow-right ms-1"></i>
          </a>
          <?php endif; ?>
        </div>
      </div>

    </div>

    <!-- ── SIDEBAR ── -->
    <div class="col-12 col-lg-4">

      <!-- Autor -->
      <div class="card-vx mb-3">
        <div class="d-flex align-items-center gap-3 mb-3">
          <img src="<?php echo esc_url( $avatar_url ); ?>"
               style="width:52px;height:52px;border-radius:var(--radius-sm);object-fit:cover;border:2px solid var(--color-border)"
               alt="<?php echo esc_attr( $author_name ); ?>">
          <div>
            <div style="font-size:14px;font-weight:600;color:var(--color-text-primary)"><?php echo esc_html( $author_name ); ?></div>
            <?php if ( $author_role ) : ?>
            <div class="text-xs-muted"><?php echo esc_html( $author_role ); ?></div>
            <?php endif; ?>
          </div>
        </div>
        <?php if ( $author_bio ) : ?>
        <p class="text-sm-muted" style="line-height:1.6;margin-bottom:.75rem"><?php echo esc_html( $author_bio ); ?></p>
        <?php endif; ?>
        <?php if ( $author_slug ) : ?>
        <a href="<?php echo esc_url( home_url( '/perfil/' . $author_slug . '/' ) ); ?>" class="btn-vx btn-ghost-vx btn-vx-sm w-100">
          <i class="ti ti-user me-1"></i> Ver perfil en Vitrinexo
        </a>
        <?php endif; ?>
      </div>

      <!-- Más artículos -->
      <?php if ( $related ) : ?>
      <div class="card-vx mb-3">
        <h3 class="subsection-title mb-3" style="font-size:15px">Más artículos</h3>
        <div class="d-flex flex-column gap-3">
          <?php foreach ( $related as $i => $rpost ) :
            $rcat  = get_the_category( $rpost->ID );
            $rcat_name = $rcat[0]->name ?? 'Blog';
            $rtime = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( $rpost->post_content ) ) / 200 ) );
            $grad  = $related_gradients[ $i % 3 ];
            $rthumb = get_the_post_thumbnail_url( $rpost->ID, 'thumbnail' );
            $rthumb_style = $rthumb
                ? 'background:url(' . esc_url( $rthumb ) . ') center/cover no-repeat'
                : 'background:' . $grad;
          ?>
          <a href="<?php echo esc_url( get_permalink( $rpost ) ); ?>" class="text-decoration-none d-flex gap-3 align-items-start">
            <div style="width:44px;height:44px;border-radius:var(--radius-sm);flex-shrink:0;<?php echo esc_attr( $rthumb_style ); ?>"></div>
            <div>
              <div class="text-body-label" style="line-height:1.35;margin-bottom:2px"><?php echo esc_html( get_the_title( $rpost ) ); ?></div>
              <div class="text-xs-muted"><?php echo esc_html( $rtime ); ?> min · <?php echo esc_html( $rcat_name ); ?></div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
        <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="btn-vx btn-ghost-vx btn-vx-sm w-100 mt-3">
          Ver todos los artículos <i class="ti ti-arrow-right ms-1"></i>
        </a>
      </div>
      <?php endif; ?>

      <!-- CTA directorio -->
      <div class="card-vx border-left-primary">
        <div class="eyebrow-vx" style="margin-bottom:.5rem">¿Ya estás en Vitrinexo?</div>
        <p class="text-body-muted" style="margin-bottom:.75rem">Conecta con las empresas de las que habla este artículo. Están en el directorio.</p>
        <a href="<?php echo esc_url( home_url( '/directorio/' ) ); ?>" class="btn-vx btn-soft-primary btn-vx-sm w-100">
          <i class="ti ti-layout-grid me-1"></i> Explorar el directorio
        </a>
      </div>

    </div>

  </div>
</div>
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
