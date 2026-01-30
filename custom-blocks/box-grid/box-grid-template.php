<?php
$background_type = get_field('background_type');
$background_color = get_field('background_color');
$background_color_start = get_field('background_color_start');
$background_color_end = get_field('background_color_end');
$rotation_deg = get_field('rotation_deg');
$background_image = get_field('background_image');
$blockID = 'box-grid-' . uniqid();
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

<div id="<?= $blockID ?>" class="box-grid">
  <div class="container">
    <?php if (have_rows('boxes')): ?>
      <?php while (have_rows('boxes')): the_row(); ?>

        <?php if (get_row_layout() == 'why_we_like_it'): ?>
          <div class="box-grid__box why_we_like_it" style="background-color: <?= get_sub_field('box_background_color') ?>;">
            <?php $bgshape = get_sub_field('title_shape'); ?>
            <h2 style="background-image: url('<?= $bgshape ? $bgshape['url'] : '' ?>'); color: <?= get_sub_field('title_color') ?>" class="title"><?=  get_sub_field('title') ?></h2>
            <div class="description" style="color: <?= get_sub_field('description_color') ?>;">
              <?= get_sub_field('description') ?>
            </div>
            <?php $ctaID = 'cta-'. uniqid() ; ?>
            <style>
              #<?= $ctaID ?> {
                color: <?= get_sub_field('cta_color') ?>;
              }
              #<?= $ctaID ?>:hover {
                color: <?= get_sub_field('cta_hover_color') ?>;
              }
            </style>
            <a id="<?= $ctaID ?>" href="<?= get_sub_field('cta_url') ?>">
              <span><?= get_sub_field('cta_label') ?></span>
              <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </a>
          </div>
        <?php endif; ?>

        <?php if (get_row_layout() == 'extra_ways_to_earn'): ?>
          <div class="box-grid__box extra_ways_to_earn" style="background-color: <?= get_sub_field('box_background_color') ?>;">
            <?php $bgshape = get_sub_field('title_shape'); ?>
            <h2 style="background-image: url('<?= $bgshape ? $bgshape : '' ?>'); color: <?= get_sub_field('title_color') ?>" class="title"><?=  get_sub_field('title') ?></h2>
            <div class="items-list">
              <?php foreach ( get_sub_field('items') as $item): ?>
                <div class="item">
                  <img src="<?= $item['icon'] ? $item['icon']['url'] : '' ?>" alt="<?= $item['icon'] ? $item['icon']['alt'] : '' ?>">
                  <div class="item-description" style="color: <?= $item['description_color'] ?>">
                    <?= $item['description'] ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (get_row_layout() == 'annual_fee'): ?>
          <div class="box-grid__box annual_fee" style="background-color: <?= get_sub_field('box_background_color') ?>;">
            <?php $bgshape = get_sub_field('title_shape'); ?>
            <h2 style="background-image: url('<?= $bgshape ? $bgshape['url'] : '' ?>'); color: <?= get_sub_field('title_color') ?>" class="title"><?=  get_sub_field('title') ?></h2>
            <h3 class="amount" style="color: <?= get_sub_field('amount_color') ?>;">$<?= get_sub_field('amount') ?></h3>
            <div class="fee-description" style="color: <?= get_sub_field('description_color') ?>;">
              <?= get_sub_field('description') ?>
            </div>
          </div>
        <?php endif; ?>

      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>