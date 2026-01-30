<?php
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
      <div class="unique-card__card-content">
        <h2 class="unique-card__card-title">
          <?= $all_cards[$card_to_show]["cci_card_name"] ?>
        </h2>
        <div class="unique-card__offers-container">
          <h3 class="unique-card__card-new-offer">
            <?= $all_cards[$card_to_show]["cci_new_offer"] ?>
          </h3>
          <h4 class="unique-card__card-old-offer">
            <?= $all_cards[$card_to_show]["cci_old_offer"] ?>
          </h4>
        </div>
        <div class="unique-card__card-current-offer">
          <?= $all_cards[$card_to_show]["cci_current_offer"] ?>
          <?php if ($all_cards[$card_to_show]["cci_offer_ends"]) : ?>
            | <span class="offer-ends"> * offer ends <?= $all_cards[$card_to_show]["cci_offer_ends"] ?></span>
          <?php endif; ?>
        </div>
        <a class="btn unique-card__card-cta" href="<?= esc_url($all_cards[$card_to_show]["cci_learn_more_link"]) ?>" target="_blank" rel="noopener noreferrer">
          Learn More <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </a>
      </div>
      <div class="unique-card__card-img">
        <img src="<?= esc_url($all_cards[$card_to_show]["cci_card_image"]["url"]) ?>" alt="<?= $all_cards[$card_to_show]["cci_card_name"] ?>">
        <a class="btn unique-card__card-fees" href="<?= esc_url($all_cards[$card_to_show]["cci_rates_and_fees"]) ?>" target="_blank" rel="noopener noreferrer">
          RATES AND FEES
        </a>
      </div>
    </div>
  </div>
</div>