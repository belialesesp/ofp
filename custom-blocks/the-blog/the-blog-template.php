<?php
$show_categories = get_field('show_categories');
$cta_label = get_field('cta_label');
$cta_url = get_field('cta_url');
$background_color = get_field('background_color');
$posts_to_show = get_field('posts_to_show');
$blockID = 'success-storie-' . uniqid();
$count = 0;

// CATEGORIES 
$uncategorized = get_category_by_slug('uncategorized');
$exclude_ids = $uncategorized ? array($uncategorized->term_id) : array();

$categories = get_categories(array(
    'parent' => 0,
    'hide_empty' => true,
    'exclude' => $exclude_ids
));

// POSTS
$args = array(
  'post_type' => 'post',
  'order' => 'DESC',
  'posts_per_page' => $posts_to_show
);
$query = new WP_Query($args);
?>

<div class="the-blog" style="background-color: <?= $background_color ?>;">
  <div class="container">
    <h2 class="the-blog__title">
      <span>the</span>
      BLOG
    </h2>
    <?php if ($show_categories): ?>
      <div class="the-blog__categories">
        <?php foreach ($categories as $category): $count++; ?>
          <a href="<?= get_category_link($category->term_id) ?>" class="categorie <?= $count == 2 ? 'green' : '' ?> <?= $count == 3 ? 'blue' : '' ?>"> <?= $category->name  ?> </a>
        <?php
          if ($count == 3) {
            $count = 0;
          }
        endforeach;
        ?>
      </div>
    <?php endif; ?>
    <div class="the-blog__bar">
  <?php
  // Get the newest post title
  $latest_post = wp_get_recent_posts(array(
      'numberposts' => 1,
      'post_status' => 'publish'
  ));
  
  if (!empty($latest_post)) :
      $newest_title = get_the_title($latest_post[0]['ID']);
  ?>
    <span class="newest-post-title"><?= esc_html($newest_title) ?></span>
  <?php endif; ?>
  <span>NEWEST</span>
</div>
    <div class="the-blog__posts">
      <!-- the loop -->
      <?php while ($query->have_posts()) : $query->the_post(); ?>
        <div class="post">
          <div class="post__image">
            <?= get_the_post_thumbnail(get_the_ID(), 'full') ?>
          </div>
          <?= the_title('<h2 class="post__title">', '</h2>'); ?>
          <a class="post__cta" href="<?= get_permalink() ?>">
            <span>Read Post</span>
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <mask id="mask0_4328_198" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                <rect width="16" height="16" fill="#66B1BB" />
              </mask>
              <g mask="url(#mask0_4328_198)">
                <path d="M10.7827 8.66406H2.66602V7.33073H10.7827L7.04935 3.5974L7.99935 2.66406L13.3327 7.9974L7.99935 13.3307L7.04935 12.3974L10.7827 8.66406Z" fill="#66B1BB" />
              </g>
            </svg>
          </a>
        </div>
      <?php endwhile; ?>
      <!-- end of the loop -->
    </div>
  </div>
</div>