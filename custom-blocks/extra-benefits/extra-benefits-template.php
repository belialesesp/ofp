<?php
$background_type = get_field('background_type');
$background_color = get_field('background_color');
$background_color_start = get_field('background_color_start');
$background_color_end = get_field('background_color_end');
$rotation_deg = get_field('rotation_deg');
$background_image = get_field('background_image');
$title_color = get_field('title_color');

$title = get_field('title');
$benefits = get_field('benefits');
$blockID = 'extra-benefits-' . uniqid();
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

<div id="<?= $blockID ?>" class="extra-benefits">
  <div class="container">
    <h2 class="extra-benefits__title" style="color: <?= $title_color ?>">
      <?= $title ?>
    </h2>
    <div class="extra-benefits__benefits">
      <?php foreach ($benefits as $benefit): ?>
        <div class="benefit">
          <div class="icon">
            <?php if($benefit['icon']): ?>
              <img src="<?= $benefit['icon']['url'] ?>" alt="<?= $benefit['icon']['alt'] ?>">  
            <?php endif; ?>
          </div>
          <div class="content">
            <h3 class="benefit-title" style="color: <?= $benefit['title_color'] ?>;">
              <?= $benefit['title'] ?>
            </h3>
            <div class="benefit-description" style="color: <?= $benefit['description_color'] ?>;">
              <?= $benefit['description'] ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>