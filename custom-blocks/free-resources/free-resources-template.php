<?php
/**
 * Free Resources Block Template
 * Location: /custom-blocks/free-resources/free-resources-template.php
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Check if ACF is available
if (!function_exists('get_field')) {
    echo '<p>Advanced Custom Fields is required for this block.</p>';
    return;
}

// Check if being used as a widget
$is_widget = (bool) get_field('is_widget');

if ($is_widget) {
    $float_icon               = get_field('widget_float_icon', 'option');
    $sub_title                = get_field('widget_sub_title', 'option');
    $title                    = get_field('widget_title', 'option')                    ?: 'Free Resources';
    $description              = get_field('widget_description', 'option');
    $images_position          = get_field('widget_images_position', 'option')          ?: 'alternating';
    $space_between_resources  = get_field('widget_space_between_resources', 'option')  ?: 0;
    $title_color              = get_field('widget_title_color', 'option')              ?: '#222222';
    $description_color        = get_field('widget_description_color', 'option')        ?: '#222222';
    $resources                = get_field('widget_resources', 'option');
} else {
    $float_icon = null;
    $sub_title = null;
    $title = get_field('title') ?: 'Free Resources';
    $description = get_field('description');
    $images_position = get_field('images_position') ?: 'alternating';
    $space_between_resources = get_field('space_between_resources') ?: 0;
    $title_color = get_field('title_color') ?: '#222222';
    $description_color = get_field('description_color') ?: '#222222';
    $resources = get_field('resources');
}

// Add widget-specific class if in widget mode
$container_class = $is_widget ? 'free-resources widget-mode' : 'free-resources';
$blockID = 'free-resources-' . uniqid();
?>

<style>
  #<?= $blockID ?> .free-resources__title {
    color: <?= $title_color ?>;
  }
  #<?= $blockID ?> .free-resources__sub-title {
    color: <?= $title_color ?>;
  }
  #<?= $blockID ?> .free-resources__description {
    color: <?= $description_color ?>;
  }
  #<?= $blockID ?> .free-resources__resources {
    gap: <?= $space_between_resources ?>px;
  }
</style>

<div id="<?= $blockID ?>" class="<?= $container_class ?>">
  <div class="container">
    <?php if ($float_icon && !empty($float_icon['url'])): ?>
      <div class="free-resources__float-icon">
        <img src="<?= esc_url($float_icon['url']) ?>" alt="<?= esc_attr($float_icon['alt']) ?>">
      </div>
    <?php endif; ?>
    
    <?php if ($sub_title): ?>
      <h3 class="free-resources__sub-title">
        <?= esc_html($sub_title) ?>
      </h3>
    <?php endif; ?>
    
    <?php if ($title): ?>
      <h2 class="free-resources__title">
        <?= esc_html($title) ?>
      </h2>
    <?php endif; ?>
    
    <?php if ($description): ?>
      <div class="free-resources__description">
        <?= wp_kses_post($description) ?>
      </div>
    <?php endif; ?>
    
    <?php if ($resources && is_array($resources)): ?>
      <div class="free-resources__resources <?= esc_attr($images_position) ?>">
        <?php foreach ($resources as $resource): ?>
          <div class="resource">
            <?php if (!empty($resource['image']['url'])): ?>
              <div class="resource__image">
                <img src="<?= esc_url($resource['image']['url']) ?>" alt="<?= esc_attr($resource['image']['alt'] ?? '') ?>">
              </div>
            <?php endif; ?>
            
            <div class="resource__content">
              <?php if (!empty($resource['badge_image']['url']) || !empty($resource['badge_label'])): ?>
                <div class="badge">
                  <?php if (!empty($resource['badge_image']['url'])): ?>
                    <img src="<?= esc_url($resource['badge_image']['url']) ?>" alt="<?= esc_attr($resource['badge_image']['alt'] ?? '') ?>">
                  <?php endif; ?>
                  <?php if (!empty($resource['badge_label'])): ?>
                    <h3><?= esc_html($resource['badge_label']) ?></h3>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              
              <?php if (!empty($resource['title'])): ?>
                <h2 class="title"><?= esc_html($resource['title']) ?></h2>
              <?php endif; ?>
              
              <?php if (!empty($resource['description'])): ?>
                <div class="description"><?= wp_kses_post($resource['description']) ?></div>
              <?php endif; ?>
              
              <?php if (!empty($resource['cta_url']) && !empty($resource['cta_label'])): ?>
                <a class="cta" href="<?= esc_url($resource['cta_url']) ?>" style="color: <?= esc_attr($resource['cta_color'] ?? '#000000') ?>">
                  <span><?= esc_html($resource['cta_label']) ?></span>
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_<?= $blockID ?>" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                      <rect width="16" height="16" fill="<?= esc_attr($resource['cta_color'] ?? '#000000') ?>" />
                    </mask>
                    <g mask="url(#mask0_<?= $blockID ?>)">
                      <path d="M10.7827 8.66406H2.66602V7.33073H10.7827L7.04935 3.5974L7.99935 2.66406L13.3327 7.9974L7.99935 13.3307L7.04935 12.3974L10.7827 8.66406Z" fill="<?= esc_attr($resource['cta_color'] ?? '#000000') ?>" />
                    </g>
                  </svg>
                </a>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>