<?php
$background_color = get_field('background_color');
$title = get_field('title');
$image = get_field('image');
$items = get_field('items');
?>

<div class="start-here" style="background-color: <?= $background_color ?>">
  <div class="container">
    <h2 class="start-here__title"><?= $title ?></h2>
    <div class="start-here__content">
      <div class="start-here__image">
          <?php if ( ! empty( $image['url'] ) ) : ?>
              <img src="<?= esc_url($image['url']) ?>" alt="<?= esc_attr( $image['alt'] ?? '' ) ?>">
          <?php endif; ?>
      </div>
      <div class="start-here__items">
        <?php foreach($items as $item): ?>
          <div class="start-here__item">
            <span class="identifier" style="color: <?= $item['identifier_color'] ?>">
              <?= $item['identifier'] ?>
            </span>
            <a href="<?= esc_url($item['label_url']) ?>"><?= $item['label'] ?></a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>