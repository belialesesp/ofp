<?php
// Try to get local fields first
$image = get_field('image');
$title = get_field('title');
$description = get_field('description');

// If empty, try to get global fields from options page
if (empty($image) || empty($title) || empty($description)) {
    // Get fields from options page
    $image = get_field('about_kam_image', 'option') ?: $image;
    $title = get_field('about_kam_title', 'option') ?: $title;
    $description = get_field('about_kam_description', 'option') ?: $description;
}
?>
<div class="about-kam-widget">
<?php if (is_array($image) && isset($image['url'])): ?>
  <img src="<?= esc_url($image['url']) ?>" alt="<?= esc_attr($image['alt'] ?? '') ?>" class="about-kam-widget__image">
<?php elseif (is_string($image)): ?>
  <img src="<?= esc_url($image) ?>" alt="" class="about-kam-widget__image">
<?php endif; ?>

  <h2 class="about-kam-widget__title">
    <?= $title ?>
  </h2>
  <div class="about-kam-widget__description">
    <?= $description ?>
  </div>
</div>