<?php
$icon = get_field('icon');
$title = get_field('tilte');
$description = get_field('description');
$cta_label = get_field('cta_label');
$cta_url = get_field('cta_url');
$background_type = get_field('background_type');
$background_image = get_field('background_image');
$rotation_deg = get_field('rotation_deg');
$background_color_start = get_field('background_color_start');
$background_color_end = get_field('background_color_end');
$title_font_size = get_field('title_font_size');
$title_font_color = get_field('title_font_color');
$title_font_style = get_field('title_font_style');
$description_font_size = get_field('description_font_size');
$description_font_color = get_field('description_font_color');
$cta_font_color = get_field('cta_font_color');
$cta_background_color = get_field('cta_background_color');
$rounded_box = get_field('rounded_box');

$blockID = 'banner-cta-' . uniqid();
?>

<?php if ($rounded_box): ?>
  <style>
    #<?= $blockID ?>-container {
      border-radius: 20px;
    }
  </style>
<?php endif; ?>
<?php if ($background_type == 'gradient'): ?>
  <style>
    #<?= $blockID ?>-container {
      background: linear-gradient(
        <?= $rotation_deg ? $rotation_deg : 0 ?>deg,
        <?= $background_color_start ?> 0%,
        <?= $background_color_end ?> 100%
      );
    }
  </style>
<?php endif; ?>
<?php if ($background_type == 'image'): ?>
  <style>
    #<?= $blockID ?>-container {
      background-image: url(<?= $background_image['url'] ?>);
    }
  </style>
<?php endif; ?>
<?php if ($background_type == 'color'): ?>
  <style>
    #<?= $blockID ?>-container {
      background-color: <?= $background_color ?>;
    }
  </style>
<?php endif; ?>

<div id="<?= $blockID ?>-container" class="banner-cta">
  <?php if ($icon): ?>
    <img src="<?= esc_url($icon['url']) ?>" alt="<?= $icon['alt'] ?>" class="banner-cta__icon">
  <?php endif ?>
  <h2 class="banner-cta__title" style="font-family: '<?= $title_font_style ?>', sans-serif; color: <?= $title_font_color  ?>; font-size: <?= $title_font_size ?>px; line-height: <?= $title_font_size ?>px;">
    <?= $title ?>
  </h2>
  <div class="banner-cta__description" style="color: <?= $description_font_color  ?>; font-size: <?= $description_font_size ?>px; line-height: <?= $description_font_size ?>px;">
    <?= $description ?>
  </div>
  <a href="<?= $cta_url ?>"  target="_blank" class="banner-cta__cta" style="background-color: <?= $cta_background_color  ?>; color: <?= $cta_font_color ?>">
    <?= $cta_label ?>
  </a>
</div>