<?php
$background_color = get_field('background_color');
$title = get_field('title');
$top_badge = get_field('top_badge');
$posts = get_field('posts');
?>

<div class="must-read" style="background-color: <?= $background_color ?>">
  <div class="container">
    <h2 class="must-read__title"><?= $title ?></h2>
    <div class="must-read__posts">
        <?php foreach($posts as $post): 
            $categories = wp_get_post_categories($post['post']->ID); 
            $has_top_badge = isset($post['has_top_badge']) && $post['has_top_badge'];
        ?>
          <a href="<?= get_permalink($post['post']->ID) ?>" class="must-read__post">
            <?php if($has_top_badge): ?>
              <img src="<?= esc_url($top_badge['url']) ?>" alt="<?= esc_attr($top_badge['alt']) ?>" class="top__badge">
            <?php endif; ?>
            
            <div class="post-image">
              <?= get_the_post_thumbnail($post['post']->ID, 'full') ?>
            </div>
            
            <div class="categories">
              <?php $count = 0 ?>
              <?php foreach($categories as $categorie): 
                  $count++; 
                  $cat = get_category($categorie);
              ?>
                <?= $cat->name ?><?= (count($categories) > 1 && count($categories) > $count) ? ', ' : '' ?>
              <?php endforeach; ?>
            </div>
            
            <h2 class="title"><?= get_the_title($post['post']->ID) ?></h2>
          </a>
        <?php endforeach; ?>
    </div>
  </div>
</div>