<?php
/**
 * Favorite Cards Widget Template - Final Version
 * Works with Credit Cards Custom Post Type using ACF Repeater Field
 */

// Check if being used as a widget
$is_widget = get_field('is_widget');

// Get all cards data from Custom Post Type
$all_cards_query = new WP_Query(array(
    'post_type' => 'credit_cards',
    'posts_per_page' => -1,
    'post_status' => 'publish'
));

$all_cards = array();
if ($all_cards_query->have_posts()) {
    while ($all_cards_query->have_posts()) {
        $all_cards_query->the_post();
        $post_id = get_the_ID();
        
        // Get data from ACF repeater field
        $credit_cards_data = get_field('credit_cards', $post_id);
        
        // Get first item from repeater (position 0)
        $card_info = null;
        if (is_array($credit_cards_data) && !empty($credit_cards_data)) {
            $card_info = $credit_cards_data[0];
        }
        
        $all_cards[$post_id] = array(
            'cci_card_name' => get_the_title(),
            'cci_card_image' => $card_info['cci_card_image'] ?? null,
            'cci_current_offer' => $card_info['cci_current_offer'] ?? null,
            'cci_learn_more_link' => $card_info['cci_learn_more_link'] ?? null,
            'cci_terms_apply' => $card_info['cci_terms_apply'] ?? null,
            'cci_rates_and_fees' => $card_info['cci_rates_and_fees'] ?? null,
            'affiliate' => $card_info['affiliate'] ?? null,
            'cci_card_type' => $card_info['cci_card_type'] ?? null,
            'cci_annual_fee' => $card_info['cci_annual_fee'] ?? null,
            'cci_little_blurb' => $card_info['cci_little_blurb'] ?? null
        );
    }
    wp_reset_postdata();
}

/**
 * WIDGET MODE vs BLOCK MODE
 */
if ($is_widget) {
    // Widget mode - default styles and get widget fields
    $background_type = 'gradient';
    $rotation_deg = 90;
    $background_color_start = '#9abfcc';
    $background_color_end = '#d3eff4';
    $title_line_1 = get_field('title_line_1') ?: 'my favorite';
    $title_line_2 = get_field('title_line_2') ?: 'CARDS';
    $left_image = get_field('left_image');
    $favorite_cards = get_field('favorite_cards');
    $cta_label = get_field('cta_label');
    $cta_url = get_field('cta_url');
    
    // If no cards selected in widget, get from options as fallback
    if (empty($favorite_cards)) {
        $favorite_cards = get_field('widget_favorite_cards', 'option');
    }
} else {
    // Block mode - get all fields from block
    $background_type = get_field('background_type') ?: 'gradient';
    $background_image = get_field('background_image');
    $rotation_deg = get_field('rotation_deg') ?: 90;
    $background_color_start = get_field('background_color_start') ?: '#9abfcc';
    $background_color_end = get_field('background_color_end') ?: '#d3eff4';
    $background_color = get_field('background_color');
    $title_line_1 = get_field('title_line_1') ?: 'my favorite';
    $title_line_2 = get_field('title_line_2') ?: 'CARDS';
    $left_image = get_field('left_image');
    $favorite_cards = get_field('favorite_cards');
    $cta_label = get_field('cta_label');
    $cta_url = get_field('cta_url');
}


// Generate unique ID for styling
$blockID = 'course-library-' . uniqid();

$additional_classes = '';
if ($is_widget) {
    $additional_classes .= ' widget';
}
?>

<?php if ($background_type == 'gradient'): ?>
  <style>
    #<?= $blockID ?> {
      background: linear-gradient(<?= $rotation_deg ?>deg,
          <?= $background_color_start ?> 40%,
          <?= $background_color_end ?> 98%);
    }
  </style>
<?php endif; ?>

<?php if ($background_type == 'image' && isset($background_image['url'])): ?>
  <style>
    #<?= $blockID ?> {
      background-image: url(<?= $background_image['url'] ?>);
      background-size: cover;
      background-position: center;
    }
  </style>
<?php endif; ?>

<?php if ($background_type == 'color' && !empty($background_color)): ?>
  <style>
    #<?= $blockID ?> {
      background-color: <?= $background_color ?>;
    }
  </style>
<?php endif; ?>

<div id="<?= $blockID ?>" class="my-favorite-cards<?= $additional_classes ?>">
  <div class="container">
    <div class="my-favorite-cards__left-col">
      <h2 class="my-favorite-cards__title">
        <span class="styled"><?= $title_line_1 ?></span><br />
        <span><?= $title_line_2 ?></span>
      </h2>
      <?php if (isset($left_image['url'])): ?>
        <img class="my-favorite-cards__image" src="<?= esc_url($left_image['url']) ?>" alt="<?= $left_image['alt'] ?? '' ?>">
      <?php endif; ?>
    </div>
    
    <div class="my-favorite-cards__right-col">
      <div class="my-favorite-cards__cards">
        <?php 
        if (is_array($favorite_cards) && !empty($favorite_cards) && is_array($all_cards) && !empty($all_cards)):
          foreach ($favorite_cards as $card): 
            if (isset($card['fc_card_option']) && isset($all_cards[$card['fc_card_option']])): 
              $card_option = $card['fc_card_option'];
              $card_data = $all_cards[$card_option];
        ?>
          <div class="my-favorite-cards__card">
            <div class="my-favorite-cards__card-img">
              <?php if (!empty($card_data["cci_card_image"]["url"])): ?>
                <img src="<?= esc_url($card_data["cci_card_image"]["url"]) ?>" alt="<?= $card_data["cci_card_name"] ?>">
              <?php endif; ?>
            </div>
            
            <div class="my-favorite-cards__card-content">
              <h2 class="my-favorite-cards__card-title">
                <?= $card_data["cci_card_name"] ?>
              </h2>
              
              <?php if (!empty($card_data["cci_current_offer"])): ?>
                <h3 class="my-favorite-cards__card-offer">
                  <?= $card_data["offer_points"] ?>
                </h3>
              <?php endif; ?>
              
              <?php // Learn More button - always show, goes to CPT single page ?>
              <a class="btn my-favorite-cards__card-cta" target="_blank" href="<?= $card_data['cci_learn_more_link'] ?>">
                Learn More <i class="fa fa-arrow-right" aria-hidden="true"></i>
              </a><br>
              
              <?php if ($card_data['cci_terms_apply'] === 'Yes' && !empty($card_data['cci_rates_and_fees'])): ?>
                <a class="my-favorite-cards__card-rates" href="<?= esc_url($card_data['cci_rates_and_fees']) ?>" target="_blank" rel="noopener noreferrer">
                  Terms Apply / Rates &amp; Fees
                </a><br>
              <?php endif; ?>
              
              <?php if (!empty($card_data["affiliate"])): ?>
                <div class="affiliate-info">
                  <?= wp_kses_post($card_data["affiliate"]) ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php 
            endif;
          endforeach;
        endif; 
        ?>
      </div>

      <?php if (!empty($cta_label)) : ?>
        <a class="btn my-favorite-cards__cta" href="<?= esc_url($cta_url) ?>" target="_blank" rel="noopener noreferrer">
          <span><?= $cta_label ?></span> <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </a>
      <?php endif; ?>
    </div>
  </div>
</div>