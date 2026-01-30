<?php

/**
 * Block Name: Credit Cards
 *
 * This is the template that displays the Credit Cards block.
 */

$card_style = get_field('ccb_card_stye');
$credit_card = get_field('ccb_credit_card');
$all_cards = get_field('credit_cards', 'option');

// CREDIT CART VALUES
$cci_card_name = $all_cards[$credit_card]["cci_card_name"];
$cci_card_image = $all_cards[$credit_card]["cci_card_image"];
$cci_learn_more_link = $all_cards[$credit_card]["cci_learn_more_link"];
$cci_card_type = $all_cards[$credit_card]["cci_card_type"];
$cci_old_offer = $all_cards[$credit_card]["cci_old_offer"];
$cci_new_offer = $all_cards[$credit_card]["cci_new_offer"];
$cci_current_offer = $all_cards[$credit_card]["cci_current_offer"];
$cci_annual_fee = $all_cards[$credit_card]["cci_annual_fee"];
$cci_offer_ends = $all_cards[$credit_card]["cci_offer_ends"];
$cci_terms_apply = $all_cards[$credit_card]["cci_terms_apply"];
$cci_rates_and_fees = $all_cards[$credit_card]["cci_rates_and_fees"];
$cci_little_blurb = $all_cards[$credit_card]["cci_little_blurb"];
?>

<div class="credit-card-container">
  <div class="card <?= $card_style ?>">
    <div class="left slide-in-left">
      <a class="card-title" href="<?= $cci_learn_more_link ?>">
        <?= $cci_card_name ?>
      </a>
      <a
        class="card-img"
        href="<?= $cci_learn_more_link ?>">
        <img
          src="<?=  esc_url($cci_card_image['url']) ?>"
          alt="<?= $cci_card_name ?>" />
      </a>
    </div>
    <div class="right slide-in-right">
      <hr />
      <div class="reward-points">
        <?= $cci_current_offer ?>
      </div>
      <hr class="hidde-small" />
      <div class="mod-annual">
        <div class="annual-fee">
          <b>Annual Fee: <?= $cci_annual_fee ?></b>
        </div>
        <a
          href="<?= $cci_learn_more_link ?>"
          class="apply-link">LEARN HOW TO APPLY</a>
      </div>
    </div>
  </div>
</div>