<?php
$background_type = get_field('background_type');
$background_color = get_field('background_color');
$background_color_start = get_field('background_color_start');
$background_color_end = get_field('background_color_end');
$background_image = get_field('background_image');
$rotation_deg = get_field('rotation_deg');
$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_left = get_field('padding_left');
$padding_right = get_field('padding_right');
$title_max_width = get_field('title_max_width');
$description_max_width = get_field('description_max_width');
$title_font_size_desktop = get_field('title_font_size_desktop');
$title_font_size_tablet = get_field('title_font_size_tablet');
$title_font_size_mobile = get_field('title_font_size_mobile');
$description_font_size_desktop = get_field('description_font_size_desktop');
$description_font_size_tablet = get_field('description_font_size_tablet');
$description_font_size_mobile = get_field('description_font_size_mobile');

$title = get_field('title');
$description = get_field('description');
$title_color = get_field('title_color');
$cta_color = get_field('cta_color');
$cta_hover_color = get_field('cta_hover_color');
$arrow_direction = get_field('arrow_direction');
$cta_label = get_field('cta_label');
$cta_url = get_field('cta_url');
$images = get_field('images');
$top_icon = get_field('top_icon');

$blockID = 'hero-content-' . uniqid();
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
  #<?= $blockID ?> {
    padding: <?= $padding_top ? $padding_top : 0 ?>rem <?= $padding_right ? $padding_right : 0 ?>rem <?= $padding_bottom ? $padding_bottom : 0 ?>rem <?= $padding_left ? $padding_left : 0 ?>rem;
  }

  #<?= $blockID ?> .hero-content__title {
    max-width: <?= $title_max_width ? $title_max_width . 'px' : '100%' ?>;
    font-size: <?= $title_font_size_desktop ? $title_font_size_desktop . 'px' : '2rem' ?>;
    color: <?= $title_color ? $title_color : '#222' ?>;
  }

  @media screen and (max-width: 991px) {
    #<?= $blockID ?> .hero-content__title {
      font-size: <?= $title_font_size_tablet ? $title_font_size_tablet . 'px' : '2rem' ?>;
    }
  }

  @media screen and (max-width: 767px) {
    #<?= $blockID ?> .hero-content__title {
      font-size: <?= $title_font_size_mobile ? $title_font_size_mobile . 'px' : '2rem' ?>;
    }
  }

  #<?= $blockID ?> .hero-content__description {
    max-width: <?= $description_max_width ? $description_max_width . 'px' : '100%' ?>;
    font-size: <?= $description_font_size_desktop ? $description_font_size_desktop . 'px' : '16px' ?>;
  }

  @media screen and (max-width: 991px) {
    #<?= $blockID ?> .hero-content__description {
      font-size: <?= $description_font_size_tablet ? $description_font_size_tablet . 'px' : '16px' ?>;
    }
  }

  @media screen and (max-width: 767px) {
    #<?= $blockID ?> .hero-content__description {
      font-size: <?= $description_font_size_mobile ? $description_font_size_mobile . 'px' : '16px' ?>;
    }
  }

  #<?= $blockID ?> .hero-content__cta {
    background-color: <?= $cta_color ?>;
  }

  #<?= $blockID ?> .hero-content__cta:hover {
    background-color: <?= $cta_hover_color ?>;
  }
</style>

<div id="<?= $blockID ?>" class="hero-content">
  <div class="container">
    <?php if ($top_icon): ?>
      <img src="<?= $top_icon['url'] ?>" alt="<?= $top_icon['alt'] ?>">
    <?php endif; ?>
    <h2 class="hero-content__title">
      <?= $title ?>
    </h2>
    <div class="hero-content__description">
      <?= $description ?>
    </div>
    <?php if ($cta_url && $cta_label): ?>
      <a class="hero-content__cta" href="<?= $cta_url ?>">
        <span><?= $cta_label ?></span>
        <span class="icon">
          <i class="fas fa-arrow-<?= $arrow_direction ?>"></i>
        </span>
      </a>
    <?php endif; ?>

    <?php if ($images) : ?>
  <?php foreach ($images as $index => $image): ?>
    <div class="hero-content__image <?= $image['animated'] ? 'animate' : '' ?> <?= $index === 0 ? 'decorative-edge' : '' ?>" style="
      top: <?= $image['top_position_percent'] ? $image['top_position_percent'] . '%'  : 'inherit' ?>; 
      bottom: <?= $image['bottom_position_percent'] ? $image['bottom_position_percent'] . '%'  : 'inherit' ?>; 
      left: <?= $image['left_position_percent'] ? $image['left_position_percent'] . '%' : 'inherit' ?>; 
      right: <?= $image['right_position_percent'] ? $image['right_position_percent'] . '%'  : 'inherit' ?>; 
      max-width: <?= $image['image_max_width_px'] ? $image['image_max_width_px'] . 'px'  : 'inherit' ?>; 											<?= $image['is_rounded'] ? 'aspect-ratio: 1/1; overflow: hidden; display: flex; justify-content: center; align-items: center;' : '' ?>
    ">
      <img src="<?= $image['image']['url'] ?>" style="<?= $image['is_rounded'] ? 'border: 9px solid ' . $image['border_color'] . '; border-radius: 1000px;' : '' ?>" />
      <?php if ($image['animated']) : ?>
        <img src="<?= $image['rotating_image']['url'] ?>" class="animated__img" />
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
  </div>
</div>