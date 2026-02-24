<?php
$background_type = get_field('background_type');
$background_color = get_field('background_color');
$background_color_start = get_field('background_color_start');
$background_color_end = get_field('background_color_end');
$rotation_deg = get_field('rotation_deg');
$background_image = get_field('background_image');
$title_color = get_field('title_color');

$blockID = 'enchanting-thhings-' . uniqid();
?>

<?php if ($background_type == 'gradient'): ?>
  <style>
    #<?= $blockID ?> {
      background: linear-gradient(<?= $rotation_deg ? $rotation_deg : 0 ?>deg,
          <?= $background_color_start ?> 0%,
          <?= $background_color_end ?> 100%);
    }
  </style>
<?php endif; ?>
<?php if ($background_type == 'image'): ?>
  <style>
    #<?= $blockID ?> {
      background-image: url(<?= $background_image['url'] ?>);
    }
  </style>
<?php endif; ?>
<?php if ($background_type == 'color'): ?>
  <style>
    #<?= $blockID ?> {
      background-color: <?= $background_color ?>;
    }
  </style>
<?php endif; ?>

<div id="<?= $blockID ?>" class="enchanting-thhings">
  <div class="container">
 
  </div>
</div>