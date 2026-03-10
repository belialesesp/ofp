<?php
/**
 * Let's Connect Block Template
 * Location: /custom-blocks/lets-connect/lets-connect-template.php
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

// Check if using global settings
$use_global = ( function_exists('ofp_is_widget_mode') && ofp_is_widget_mode() )
              || (bool) get_field('use_global');

if ($use_global) {
    // Get fields from options page (single cached fetch)
    $opts             = ofp_get_lets_connect_options();
    $background_color = $opts['lc_background_color'];
    $title            = $opts['lc_title'];
    $image            = $opts['lc_image'];
    $description      = $opts['lc_description'];
    $social_medias    = $opts['lc_social_medias'];
} else {
    // Regular block fields
    $background_color = get_field('background_color');
    $title            = get_field('title');
    $image            = get_field('image');
    $description      = get_field('description');
    $social_medias    = get_field('social_medias');
}

// Default values
$background_color = $background_color ?: '#FFF4E6';
$title            = $title ?: 'Let\'s Connect';

// Mask image URL — uses Media Library path to work across environments
$mask_url = wp_upload_dir()['baseurl'] . '/2024/09/Vector-1.png';

// Enqueue Dashicons if necessary
if ($social_medias && !wp_style_is('dashicons', 'enqueued')) {
    wp_enqueue_style('dashicons');
}

/**
 * Helper function to render icon
 */
if (!function_exists('render_social_icon')) {
    function render_social_icon($icon_data, $icon_color = '#333333') {
        $allowed_svg = array(
            'svg' => array(
                'class' => true, 'aria-hidden' => true, 'aria-labelledby' => true,
                'role' => true, 'xmlns' => true, 'width' => true, 'height' => true,
                'viewbox' => true, 'viewBox' => true, 'fill' => true, 'stroke' => true,
                'stroke-width' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true,
                'style' => true,
            ),
            'g'        => array('fill' => true, 'stroke' => true, 'transform' => true),
            'title'    => array('title' => true),
            'path'     => array('d' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true, 'transform' => true, 'style' => true),
            'polygon'  => array('points' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true),
            'circle'   => array('cx' => true, 'cy' => true, 'r' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true),
            'rect'     => array('x' => true, 'y' => true, 'width' => true, 'height' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true, 'rx' => true, 'ry' => true),
            'line'     => array('x1' => true, 'y1' => true, 'x2' => true, 'y2' => true, 'stroke' => true, 'stroke-width' => true),
            'polyline' => array('points' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true),
            'ellipse'  => array('cx' => true, 'cy' => true, 'rx' => true, 'ry' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true),
        );

        $output = '<span class="dashicons dashicons-share"></span>';

        if (!empty($icon_data)) {
            $icon_type  = '';
            $icon_value = '';

            if (is_array($icon_data)) {
                $icon_type  = $icon_data['type'] ?? '';
                $icon_value = $icon_data['value'] ?? '';
            } elseif (is_string($icon_data)) {
                $icon_value = $icon_data;
                $icon_type  = 'dashicons';
            }

            $clean_value = $icon_value;
            $prev_value  = '';
            $decode_count = 0;

            while ($clean_value !== $prev_value && $decode_count < 3) {
                $prev_value   = $clean_value;
                $clean_value  = html_entity_decode($clean_value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $decode_count++;
            }

            $is_svg_content = (strpos($clean_value, '<svg') !== false);
            $is_svg_url     = (strpos($clean_value, '.svg') !== false && filter_var($clean_value, FILTER_VALIDATE_URL));

            if ($is_svg_content) {
                $svg_code = $clean_value;
                if (strpos($svg_code, 'fill=') === false) {
                    $svg_code = str_replace('<svg', '<svg fill="currentColor"', $svg_code);
                }
                if (strpos($svg_code, 'width=') === false) {
                    $svg_code = str_replace('<svg', '<svg width="20"', $svg_code);
                }
                if (strpos($svg_code, 'height=') === false) {
                    $svg_code = str_replace('<svg', '<svg height="20"', $svg_code);
                }
                $output = wp_kses($svg_code, $allowed_svg);

            } elseif ($is_svg_url) {
                $output = '<img src="' . esc_url($clean_value) . '" alt="" style="width: 20px; height: 20px;">';

            } elseif ($icon_type === 'media_library' && $clean_value) {
                $attachment_url = is_numeric($clean_value) ? wp_get_attachment_url($clean_value) : $clean_value;
                if ($attachment_url) {
                    $output = '<img src="' . esc_url($attachment_url) . '" alt="" style="width: 20px; height: 20px;">';
                }

            } elseif ($icon_type === 'url' && $clean_value) {
                $output = '<img src="' . esc_url($clean_value) . '" alt="" style="width: 20px; height: 20px;">';

            } elseif ($clean_value) {
                $dashicon_class = strip_tags($clean_value);
                if (strpos($dashicon_class, 'dashicons') === 0) {
                    $output = '<span class="dashicons ' . esc_attr($dashicon_class) . '"></span>';
                } elseif (!empty($dashicon_class) && strpos($dashicon_class, '<') === false) {
                    $output = '<span class="dashicons dashicons-' . esc_attr(str_replace('dashicons-', '', $dashicon_class)) . '"></span>';
                }
            }
        }

        return $output;
    }
}
?>

<div class="lets-connect" style="background-color: <?= esc_attr($background_color) ?>;">
  <div class="lets-connect__container container">
    <?php if ($image): ?>
    <div class="lets-connect__image">
      <img
        src="<?= esc_url($image['url']) ?>"
        alt="<?= esc_attr($image['alt'] ?: $title) ?>"
        style="-webkit-mask-image: url('<?= esc_url($mask_url) ?>'); mask-image: url('<?= esc_url($mask_url) ?>'); -webkit-mask-size: 100% 100%; mask-size: 100% 100%;"
      >
    </div>
    <?php endif; ?>
    <div class="lets-connect__content">
      <h2 class="title"><?= esc_html($title) ?></h2>
      <?php if ($description): ?>
      <div class="description"><?= wp_kses_post($description) ?></div>
      <?php endif; ?>
      <?php if ($social_medias && is_array($social_medias)): ?>
      <ul class="social-links">
        <?php foreach ($social_medias as $social): ?>
          <?php if (!empty($social['social_url']) && !empty($social['social_label'])): ?>
          <li class="social-links__link">
            <a href="<?= esc_url($social['social_url']) ?>" target="_blank" rel="noopener noreferrer">
              <span class="icon" style="color: <?= esc_attr($social['color_icon'] ?? '#333333') ?>;">
                <?= render_social_icon($social['social_icon'] ?? null, $social['color_icon'] ?? '#333333') ?>
              </span>
              <span><?= esc_html($social['social_label']) ?></span>
            </a>
          </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div>
  </div>
</div>