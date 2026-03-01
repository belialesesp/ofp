<?php

/**
 * Block Name: Credit Cards
 *
 * This is the template that displays the Credit Cards block.
 */

$card_style   = get_field( 'ccb_card_stye' );
$credit_card  = get_field( 'ccb_credit_card' );
$all_cards    = get_field( 'credit_cards', 'option' );

// Bail early if no card selected or card data missing
if ( ! isset( $all_cards[ $credit_card ] ) ) {
	return;
}

// CREDIT CARD VALUES
$card               = $all_cards[ $credit_card ];
$cci_card_name      = $card['cci_card_name']      ?? '';
$cci_card_image     = $card['cci_card_image']      ?? array();
$cci_learn_more_link = $card['cci_learn_more_link'] ?? '';
$cci_current_offer  = $card['cci_current_offer']   ?? '';
$cci_annual_fee     = $card['cci_annual_fee']       ?? '';
?>

<div class="credit-card-container">
  <div class="card <?php echo esc_attr( $card_style ); ?>">
    <div class="left slide-in-left">
      <a class="card-title" href="<?php echo esc_url( $cci_learn_more_link ); ?>">
        <?php echo esc_html( $cci_card_name ); ?>
      </a>
      <a class="card-img" href="<?php echo esc_url( $cci_learn_more_link ); ?>">
        <?php if ( ! empty( $cci_card_image['url'] ) ) : ?>
          <img
            src="<?php echo esc_url( $cci_card_image['url'] ); ?>"
            alt="<?php echo esc_attr( $cci_card_name ); ?>" />
        <?php endif; ?>
      </a>
    </div>
    <div class="right slide-in-right">
      <hr />
      <div class="reward-points">
        <?php echo wp_kses_post( $cci_current_offer ); ?>
      </div>
      <hr class="hidde-small" />
      <div class="mod-annual">
        <div class="annual-fee">
          <b><?php printf( 'Annual Fee: %s', esc_html( $cci_annual_fee ) ); ?></b>
        </div>
        <a href="<?php echo esc_url( $cci_learn_more_link ); ?>" class="apply-link">LEARN HOW TO APPLY</a>
      </div>
    </div>
  </div>
</div>