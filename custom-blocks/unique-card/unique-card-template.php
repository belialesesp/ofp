<?php
$card_id = get_field('card_to_show');
$image = get_field('image');
$rotating_image = get_field('rotating_image');

$background_type = get_field('background_type');
$background_color = get_field('background_color');
$background_color_start = get_field('background_color_start');
$background_color_end = get_field('background_color_end');
$rotation_deg = get_field('rotation_deg');
$background_image = get_field('background_image');
$title_color = get_field('title_color');
$new_offer_color = get_field('new_offer_color');
$old_offer_color = get_field('old_offer_color');
$current_offer_color = get_field('current_offer_color');
$learn_more_color = get_field('learn_more_color');
$learn_more_hover_color = get_field('learn_more_hover_color');
$rates_and_fees_color = get_field('rates_and_fees_color');
$rates_and_fees_hover_color = get_field('rates_and_fees_hover_color');

// Get card data from options repeater
$all_cards = get_field('credit_cards', 'option');
if ($all_cards && isset($all_cards[$card_id])) {
  $card_data = $all_cards[$card_id];
  
  $card_name = $card_data['cci_card_name'];
  $card_image = $card_data['cci_card_image'];
  $new_offer = $card_data['cci_new_offer'];
  $old_offer = $card_data['cci_old_offer'];
  $current_offer = $card_data['cci_current_offer'];
  $offer_ends = $card_data['cci_offer_ends'];
  $learn_more_link = $card_data['cci_learn_more_link'];
  $rates_and_fees = $card_data['cci_rates_and_fees'];
}

$blockID = 'hero-content-' . uniqid();
?>

<style>
  .unique-card__card-title {
    color: <?= $title_color ?>;
  }
  .unique-card__card-new-offer {
    color: <?= $new_offer_color ?>;
  }
  .unique-card__card-old-offer {
    color: <?= $old_offer_color ?>;
  }
  .unique-card__card-current-offer {
    color: <?= $current_offer_color ?>;
  }
  .unique-card__card-cta,
  .unique-card__card-cta:visited {
    color: <?= $learn_more_color ?>;
  }
  .unique-card__card-cta:hover,
  .unique-card__card-cta:hover:visited {
    color: <?= $learn_more_hover_color ?>;
  }
  .unique-card__card-fees,
  .unique-card__card-fees:visited {
    color: <?= $rates_and_fees_color ?>;
  }
  .unique-card__card-fees:hover,
  .unique-card__card-fees:hover:visited {
    color: <?= $rates_and_fees_hover_color ?>;
  }
</style>

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

<div id="<?= $blockID ?>" class="unique-card">
  <div class="container">
    <div class="unique-card__card">
      <?php if ($image || $rotating_image) : ?>
        <div class="unique-card__rotating-img">
          <div class="images-container">
            <?php if ($image) : ?>
              <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" />
            <?php endif; ?>
            <?php if ($rotating_image) : ?>
              <img src="<?= $rotating_image['url'] ?>" alt="<?= $rotating_image['alt'] ?>" class="animated__img" />
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
      
      <div class="unique-card__card-content">
        <?php if (!empty($card_name)) : ?>
          <h2 class="unique-card__card-title">
            <?= $card_name ?>
          </h2>
        <?php endif; ?>
        
        <?php if (!empty($new_offer) || !empty($old_offer)) : ?>
          <div class="unique-card__offers-container">
            <?php if (!empty($new_offer)) : ?>
              <h3 class="unique-card__card-new-offer">
                <?= $new_offer ?>
              </h3>
            <?php endif; ?>
            
            <?php if (!empty($old_offer)) : ?>
              <h4 class="unique-card__card-old-offer">
                <?= $old_offer ?>
              </h4>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        
        <?php if (!empty($current_offer)) : ?>
          <div class="unique-card__card-current-offer">
            <?= $current_offer ?>
            <?php if (!empty($offer_ends)) : ?>
              | <span class="offer-ends"> * offer ends <?= $offer_ends ?></span>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        
        <?php if (!empty($learn_more_link)) : ?>
          <a class="btn unique-card__card-cta" href="<?= esc_url($learn_more_link) ?>" target="_blank" rel="noopener noreferrer">
            Learn More <i class="fa fa-arrow-right" aria-hidden="true"></i>
          </a>
        <?php endif; ?>
      </div>
      
      <?php if (!empty($card_image['url'])) : ?>
        <div class="unique-card__card-img">
          <img src="<?= esc_url($card_image['url']) ?>" alt="<?= $card_name ?>">
          
          <?php if (!empty($rates_and_fees)) : ?>
            <a class="btn unique-card__card-fees" href="<?= esc_url($rates_and_fees) ?>" target="_blank" rel="noopener noreferrer">
              RATES AND FEES
            </a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>