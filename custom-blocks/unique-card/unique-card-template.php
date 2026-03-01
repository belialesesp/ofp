<?php
$card_id            = get_field( 'card_to_show' );
$image              = get_field( 'image' );
$rotating_image     = get_field( 'rotating_image' );

$background_type        = get_field( 'background_type' );
$background_color       = get_field( 'background_color' )        ?: '';
$background_color_start = get_field( 'background_color_start' )  ?: '';
$background_color_end   = get_field( 'background_color_end' )    ?: '';
$rotation_deg           = absint( get_field( 'rotation_deg' ) );
$background_image       = get_field( 'background_image' )        ?: array();

$title_color              = get_field( 'title_color' )              ?: '';
$new_offer_color          = get_field( 'new_offer_color' )          ?: '';
$old_offer_color          = get_field( 'old_offer_color' )          ?: '';
$current_offer_color      = get_field( 'current_offer_color' )      ?: '';
$learn_more_color         = get_field( 'learn_more_color' )         ?: '';
$learn_more_hover_color   = get_field( 'learn_more_hover_color' )   ?: '';
$rates_and_fees_color     = get_field( 'rates_and_fees_color' )     ?: '';
$rates_and_fees_hover_color = get_field( 'rates_and_fees_hover_color' ) ?: '';

// Get card data from options repeater
$all_cards = get_field( 'credit_cards', 'option' );

$card_name       = '';
$card_image      = array();
$new_offer       = '';
$old_offer       = '';
$current_offer   = '';
$offer_ends      = '';
$learn_more_link = '';
$rates_and_fees  = '';

if ( $all_cards && isset( $all_cards[ $card_id ] ) ) {
	$card_data       = $all_cards[ $card_id ];
	$card_name       = $card_data['cci_card_name']       ?? '';
	$card_image      = $card_data['cci_card_image']       ?? array();
	$new_offer       = $card_data['cci_new_offer']        ?? '';
	$old_offer       = $card_data['cci_old_offer']        ?? '';
	$current_offer   = $card_data['cci_current_offer']    ?? '';
	$offer_ends      = $card_data['cci_offer_ends']       ?? '';
	$learn_more_link = $card_data['cci_learn_more_link']  ?? '';
	$rates_and_fees  = $card_data['cci_rates_and_fees']   ?? '';
}

$blockID = 'unique-card-' . uniqid();
?>

<style>
  .unique-card__card-title {
    color: <?php echo esc_attr( $title_color ); ?>;
  }
  .unique-card__card-new-offer {
    color: <?php echo esc_attr( $new_offer_color ); ?>;
  }
  .unique-card__card-old-offer {
    color: <?php echo esc_attr( $old_offer_color ); ?>;
  }
  .unique-card__card-current-offer {
    color: <?php echo esc_attr( $current_offer_color ); ?>;
  }
  .unique-card__card-cta,
  .unique-card__card-cta:visited {
    color: <?php echo esc_attr( $learn_more_color ); ?>;
  }
  .unique-card__card-cta:hover,
  .unique-card__card-cta:hover:visited {
    color: <?php echo esc_attr( $learn_more_hover_color ); ?>;
  }
  .unique-card__card-fees,
  .unique-card__card-fees:visited {
    color: <?php echo esc_attr( $rates_and_fees_color ); ?>;
  }
  .unique-card__card-fees:hover,
  .unique-card__card-fees:hover:visited {
    color: <?php echo esc_attr( $rates_and_fees_hover_color ); ?>;
  }
</style>

<?php if ( $background_type === 'gradient' ) : ?>
  <style>
    #<?php echo esc_attr( $blockID ); ?> {
      background: linear-gradient(<?php echo $rotation_deg; ?>deg,
        <?php echo esc_attr( $background_color_start ); ?> 0%,
        <?php echo esc_attr( $background_color_end ); ?> 100%);
    }
  </style>
<?php elseif ( $background_type === 'image' && ! empty( $background_image['url'] ) ) : ?>
  <style>
    #<?php echo esc_attr( $blockID ); ?> {
      background-image: url(<?php echo esc_url( $background_image['url'] ); ?>);
    }
  </style>
<?php elseif ( $background_type === 'color' ) : ?>
  <style>
    #<?php echo esc_attr( $blockID ); ?> {
      background-color: <?php echo esc_attr( $background_color ); ?>;
    }
  </style>
<?php endif; ?>

<div id="<?php echo esc_attr( $blockID ); ?>" class="unique-card">
  <div class="container">
    <div class="unique-card__card">
      <?php if ( $image || $rotating_image ) : ?>
        <div class="unique-card__rotating-img">
          <div class="images-container">
            <?php if ( $image && ! empty( $image['url'] ) ) : ?>
              <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>" />
            <?php endif; ?>
            <?php if ( $rotating_image && ! empty( $rotating_image['url'] ) ) : ?>
              <img src="<?php echo esc_url( $rotating_image['url'] ); ?>" alt="<?php echo esc_attr( $rotating_image['alt'] ?? '' ); ?>" class="animated__img" />
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>

      <div class="unique-card__card-content">
        <?php if ( ! empty( $card_name ) ) : ?>
          <h2 class="unique-card__card-title">
            <?php echo esc_html( $card_name ); ?>
          </h2>
        <?php endif; ?>

        <?php if ( ! empty( $new_offer ) || ! empty( $old_offer ) ) : ?>
          <div class="unique-card__offers-container">
            <?php if ( ! empty( $new_offer ) ) : ?>
              <h3 class="unique-card__card-new-offer">
                <?php echo esc_html( $new_offer ); ?>
              </h3>
            <?php endif; ?>
            <?php if ( ! empty( $old_offer ) ) : ?>
              <h4 class="unique-card__card-old-offer">
                <?php echo esc_html( $old_offer ); ?>
              </h4>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?php if ( ! empty( $current_offer ) ) : ?>
          <div class="unique-card__card-current-offer">
            <?php echo wp_kses_post( $current_offer ); ?>
            <?php if ( ! empty( $offer_ends ) ) : ?>
              | <span class="offer-ends"> * offer ends <?php echo esc_html( $offer_ends ); ?></span>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?php if ( ! empty( $learn_more_link ) ) : ?>
          <a class="btn unique-card__card-cta" href="<?php echo esc_url( $learn_more_link ); ?>" target="_blank" rel="noopener noreferrer">
            Learn More <i class="fa fa-arrow-right" aria-hidden="true"></i>
          </a>
        <?php endif; ?>
      </div>

      <?php if ( ! empty( $card_image['url'] ) ) : ?>
        <div class="unique-card__card-img">
          <img src="<?php echo esc_url( $card_image['url'] ); ?>" alt="<?php echo esc_attr( $card_name ); ?>">
          <?php if ( ! empty( $rates_and_fees ) ) : ?>
            <a class="btn unique-card__card-fees" href="<?php echo esc_url( $rates_and_fees ); ?>" target="_blank" rel="noopener noreferrer">
              RATES AND FEES
            </a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>