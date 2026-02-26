<?php
/**
 * Free Consultation Block Template
 * Location: /custom-blocks/free-consultation/free-consultation-template.php
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

// Get widget mode setting
$is_widget = ofp_is_widget_mode() || (bool) get_field('is_widget');

// Initialize variables
$sub_title_left       = '';
$title_left           = '';
$title_right          = '';
$description_right    = '';
$cta_label_right      = '';
$cta_url_right        = '';
$background_color     = '';
$box_background_color = '';
$text_color           = '';

// Get values based on widget mode
if ($is_widget) {
    $opts                 = ofp_get_free_consultation_options();
    $sub_title_left       = $opts['widget_sub_title_left']       ?: 'NEED HELP?';
    $title_left           = $opts['widget_title_left']           ?: 'Get Expert Financial Guidance Today';
    $title_right          = $opts['widget_title_right']          ?: 'Free Consultation';
    $description_right    = $opts['widget_description_right']    ?: 'Take the first step towards financial freedom.';
    $cta_label_right      = $opts['widget_cta_label_right']      ?: 'SCHEDULE NOW';
    $cta_url_right        = $opts['widget_cta_url_right']        ?: '/contact';
    $background_color     = $opts['widget_background_color']     ?: '#f7f7f7';
    $box_background_color = $opts['widget_box_background_color'] ?: '#ffffff';
    $text_color           = $opts['widget_text_color']           ?: '#222222';
} else {
    // Custom mode - use block-specific values
    $sub_title_left       = get_field('sub_title_left')       ?: 'NEED HELP?';
    $title_left           = get_field('title_left')           ?: 'Get Expert Financial Guidance Today';
    $title_right          = get_field('title_right')          ?: 'Free Consultation';
    $description_right    = get_field('description_right')    ?: 'Take the first step towards financial freedom.';
    $cta_label_right      = get_field('cta_label_right')      ?: 'SCHEDULE NOW';
    $cta_url_right        = get_field('cta_url_right')        ?: '/contact';
    $background_color     = get_field('background_color')     ?: '#f7f7f7';
    $box_background_color = get_field('box_background_color') ?: '#ffffff';
    $text_color           = get_field('text_color')           ?: '#222222';
}

// Generate unique block ID
$blockID = 'free-consultation-' . uniqid();

// Container class
$container_class = 'free-consultation';
if ($is_widget) {
    $container_class .= ' widget-mode';
}
?>

<style>
  #<?= $blockID ?> {
    background-color: <?= $background_color ?>;
  }

  #<?= $blockID ?> .container {
    background-color: <?= $box_background_color ?>;
    border-radius: 12px;
    display: flex;
    flex-wrap: wrap;
    overflow: hidden;
  }

  #<?= $blockID ?> .free-consultation__right::before {
    background-color: <?= $text_color ?>;
  }

  #<?= $blockID ?> h2,
  #<?= $blockID ?> h3,
  #<?= $blockID ?> .free-consultation__right-description,
  #<?= $blockID ?> .free-consultation__right-cta {
    color: <?= $text_color ?>;
  }
  
  @media screen and (max-width: 767px) {
    #<?= $blockID ?> .container {
      flex-direction: column;
    }
    
    #<?= $blockID ?> .free-consultation__left,
    #<?= $blockID ?> .free-consultation__right {
      width: 100%;
    }
    
    #<?= $blockID ?> .free-consultation__right::before {
      width: calc(100% - 4rem);
      height: 2px;
      top: -1px;
      left: 2rem;
    }
  }
</style>

<div id="<?= $blockID ?>" class="<?= esc_attr($container_class) ?>">
  <div class="container">
    <div class="free-consultation__left">
      <?php if (!empty($sub_title_left)): ?>
        <h3 class="free-consultation__left-sub-title">
          <?= esc_html($sub_title_left) ?>
        </h3>
      <?php endif; ?>
      
      <?php if (!empty($title_left)): ?>
        <h2 class="free-consultation__left-title">
          <?= wp_kses_post($title_left) ?>
        </h2>
      <?php endif; ?>
    </div>
    
    <div class="free-consultation__right">
      <?php if (!empty($title_right)): ?>
        <h2 class="free-consultation__right-title">
          <?= esc_html($title_right) ?>
        </h2>
      <?php endif; ?>
      
      <?php if (!empty($description_right)): ?>
        <div class="free-consultation__right-description">
          <?= wp_kses_post($description_right) ?>
        </div>
      <?php endif; ?>
      
      <?php if (!empty($cta_label_right) && !empty($cta_url_right)): ?>
        <a href="<?= esc_url($cta_url_right) ?>" class="free-consultation__right-cta">
          <span><?= esc_html($cta_label_right) ?></span>
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <mask id="mask0_<?= $blockID ?>" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
              <rect width="16" height="16" fill="<?= $text_color ?>" />
            </mask>
            <g mask="url(#mask0_<?= $blockID ?>)">
              <path d="M10.7827 8.66406H2.66602V7.33073H10.7827L7.04935 3.5974L7.99935 2.66406L13.3327 7.9974L7.99935 13.3307L7.04935 12.3974L10.7827 8.66406Z" fill="<?= $text_color ?>" />
            </g>
          </svg>
        </a>
      <?php endif; ?>
    </div>
  </div>
</div>