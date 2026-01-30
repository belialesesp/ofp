<?php
$background_type = get_field('background_type');
$background_color = get_field('background_color');
$background_color_start = get_field('background_color_start');
$background_color_end = get_field('background_color_end');
$rotation_deg = get_field('rotation_deg');
$background_image = get_field('background_image');

$instagram_feed_id = get_field('instagram_feed_id');
$title = get_field('title');
$background_title_color = get_field('background_title_color');
$title_color = get_field('title_color');
$blockID = 'instagram-block-' . uniqid();
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

<div id="<?= $blockID ?>" class="instagram-cb">
  <div class="title-container">
    <svg xmlns="http://www.w3.org/2000/svg" width="303" height="82" viewBox="0 0 303 82" fill="none">
      <path d="M303 41.6406L277.964 0H23.1102L0 41.6406L23.1102 82H279.248L303 41.6406Z" fill="<?= $background_title_color ?>" />
    </svg>
    <h2 class="title" style="color: <?= $title_color ?>"><?= $title ?></h2>
  </div>
  <?= do_shortcode('[instagram-feed feed=' . $instagram_feed_id . ']') ?>
</div>