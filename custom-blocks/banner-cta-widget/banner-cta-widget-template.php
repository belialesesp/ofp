<?php
$icon                   = get_field('icon');
$title                  = get_field('title');
$description            = get_field('description');
$cta_label              = get_field('cta_label');
$cta_url                = get_field('cta_url');
$background_type        = get_field('background_type');
$background_image       = get_field('background_image');
$rotation_deg           = get_field('rotation_deg') ?: 0;
$background_color_start = get_field('background_color_start') ?: '#ffffff';
$background_color_end   = get_field('background_color_end')   ?: '#ffffff';
$background_color       = get_field('background_color')       ?: '#ffffff';
$title_font_size        = get_field('title_font_size')        ?: 36;
$title_font_color       = get_field('title_font_color')       ?: '#222222';
$title_font_style       = get_field('title_font_style')       ?: 'League Gothic';
$description_font_size  = get_field('description_font_size')  ?: 14;
$description_font_color = get_field('description_font_color') ?: '#222222';
$cta_font_color         = get_field('cta_font_color')         ?: '#ffffff';
$cta_background_color   = get_field('cta_background_color')   ?: '#000000';
$rounded_box            = get_field('rounded_box');

$blockID = 'banner-cta-' . uniqid();
?>

<style>
  <?php if ( $rounded_box ) : ?>
    #<?= $blockID ?>-container { border-radius: 20px; }
  <?php endif; ?>

  <?php if ( $background_type === 'gradient' ) : ?>
    #<?= $blockID ?>-container {
      background: linear-gradient(
        <?= $rotation_deg ?>deg,
        <?= $background_color_start ?> 0%,
        <?= $background_color_end ?> 100%
      );
    }
  <?php elseif ( $background_type === 'image' && ! empty( $background_image['url'] ) ) : ?>
    #<?= $blockID ?>-container {
      background-image: url(<?= esc_url( $background_image['url'] ) ?>);
    }
  <?php elseif ( $background_type === 'color' ) : ?>
    #<?= $blockID ?>-container {
      background-color: <?= esc_attr( $background_color ) ?>;
    }
  <?php endif; ?>
</style>

<div id="<?= $blockID ?>-container" class="banner-cta">

  <?php if ( $icon ) : ?>
    <img src="<?= esc_url( $icon['url'] ) ?>"
         alt="<?= esc_attr( $icon['alt'] ?? '' ) ?>"
         class="banner-cta__icon">
  <?php endif; ?>

  <?php if ( $title ) : ?>
    <h2 class="banner-cta__title" style="font-family: '<?= esc_attr( $title_font_style ) ?>', sans-serif; color: <?= esc_attr( $title_font_color ) ?>; font-size: <?= (int) $title_font_size ?>px; line-height: <?= (int) $title_font_size ?>px;">
      <?= esc_html( $title ) ?>
    </h2>
  <?php endif; ?>

  <?php if ( $description ) : ?>
    <div class="banner-cta__description" style="color: <?= esc_attr( $description_font_color ) ?>; font-size: <?= (int) $description_font_size ?>px; line-height: <?= (int) $description_font_size ?>px;">
      <?= wp_kses_post( $description ) ?>
    </div>
  <?php endif; ?>

  <?php if ( $cta_url && $cta_label ) : ?>
    <a href="<?= esc_url( $cta_url ) ?>"
       target="_blank"
       class="banner-cta__cta"
       style="background-color: <?= esc_attr( $cta_background_color ) ?>; color: <?= esc_attr( $cta_font_color ) ?>;">
      <?= esc_html( $cta_label ) ?>
    </a>
  <?php endif; ?>

</div>