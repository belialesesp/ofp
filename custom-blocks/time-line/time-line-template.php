<?php
$time_line_first = get_field('time_line_first');
$items = get_field('items');
$itemPosition = 'right';
$background_type = get_field('background_type');
$background_image = get_field('background_image');
$rotation_deg = get_field('rotation_deg');
$background_color_start = get_field('background_color_start');
$background_color_end = get_field('background_color_end');
$time_line_color = get_field('time_line_color');
$blockID = 'time-line-' . uniqid();

// Define spacing for each timeline item using index-based keys
// The numbers correspond to the item's position (1-based index)
$timeline_spacing = [
    1  => '15rem',   // 60+
    2  => '-3rem',   // 30 Million+
    3  => '12rem',   // 1 Million
    4  => '-10rem',  // 1,500+
    5  => '-4rem',   // 15k+
    6  => '-4rem',   // 6
    7  => '7rem',   // 1000+
    8  => '0rem',    // A TRILLION
    9  => '13rem',   // 8
    10 => '-4rem',   // just getting started…
    11 => '9rem',   // Empty right item
    12 => '-3rem',   // Calling kutcher family
    13 => '24rem',   // 10,000
    14 => '9rem'     // 55
];
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

<style>
  .time-line__item.right::before {
    border-left: 10px solid <?= $time_line_color ?>;
  }
  .time-line__item.right::after {
    border-right: 10px solid <?= $time_line_color ?>;
  }
  .time-line__item.left::before {
    border-right:10px solid <?= $time_line_color ?>; 
  }
  
  /* Add spacing after top images */
  .time-line__item .image--top + h2 {
    margin-top: 3rem;
  }
</style>

<div id="<?= $blockID ?>" class="time-line">
  <div class="line" style="background-color: <?= $time_line_color ?>;"><div class="point" style="background-color: <?= $time_line_color ?>;"></div></div>
  <div class="container">
    <div class="time-line__item title-description" data-timeline-item="title">
      <div class="first">
        <img src="<?= $time_line_first['image']['url'] ?>" alt="<?= $time_line_first['image']['alt'] ?>">
        <div>
          <h2 style="color: <?= $time_line_first['title__date_color'] ?>"><?= $time_line_first['title'] ?></h2>
          <h3 style="color: <?= $time_line_first['title__date_color'] ?>"><?= $time_line_first['dates'] ?></h3>
        </div>
      </div>
      <div class="second">
        <?= $time_line_first['description'] ?>
      </div>
    </div>
    <?php foreach ($items as $index => $item): 
      // Create a data attribute based on the year text and index
      $item_identifier = '';
      
      if (!empty($item['year'])) {
        // Clean the year text to create a valid attribute value
        $item_identifier = sanitize_title($item['year']);
      } else {
        // Fallback to index-based identifier
        $item_identifier = 'item-' . ($index + 1);
      }
      
      // Current index (1-based for easier reference)
      $current_index = $index + 1;
      
      // Get margin-top value based on item's index
      $margin_top = isset($timeline_spacing[$current_index]) ? $timeline_spacing[$current_index] : '';
      
      // Only apply inline styles for desktop - no !important flag
      $style_attr = '';
      if ($margin_top) {
        $style_attr = 'style="margin-top: ' . $margin_top . ';"';
      }
    ?>
      <div class="time-line__item <?= $itemPosition ?>" 
           data-timeline-item="<?= $item_identifier ?>" 
           data-timeline-index="<?= $current_index ?>" 
           <?= $style_attr ?>>
        <?php if ($item['image_position'] === 'top' && $item['image']): ?>
          <div class="image image--top">
            <img src="<?= $item['image']['url'] ?>" alt="<?= $item['image']['alt'] ?>">
            <?php if (!empty($item['image_float_text'])): ?>
              <div class="floating-text">
                <?= $item['image_float_text'] ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <h2 style="color: <?= $item['year_color'] ?>"><?= $item['year'] ?></h2>
        <div class="history">
          <?php foreach ($item['history'] as $history): ?>
            <div class="history__item">
              <?= $history['item'] ?>
            </div>
          <?php endforeach; ?>
        </div>
        <?php if ($item['image_position'] === 'bottom' && $item['image']): ?>
          <div class="image image--bottom">
            <img src="<?= $item['image']['url'] ?>" alt="<?= $item['image']['alt'] ?>">
            <?php if (!empty($item['image_float_text'])): ?>
              <div class="floating-text">
                <?= $item['image_float_text'] ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <?php if ($item['image_position'] === 'floating' && $item['image']): ?>
          <div class="image image--floating">
            <img src="<?= $item['image']['url'] ?>" alt="<?= $item['image']['alt'] ?>">
            <?php if (!empty($item['image_float_text'])): ?>
              <div class="floating-text">
                <?= $item['image_float_text'] ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
      <?php $itemPosition === 'right' ? $itemPosition = 'left' : $itemPosition = 'right' ?>
    <?php endforeach; ?>
  </div>
</div>