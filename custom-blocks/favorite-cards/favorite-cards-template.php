<?php
/**
 * Favorite Cards Widget Template
 * Works with Credit Cards Custom Post Type using ACF Repeater Field
 */

// Check if being used as a widget
$is_widget = ofp_is_widget_mode();

// Get all cards data from cache (single DB query per request)
$all_cards = ofp_get_all_credit_cards();

/**
 * WIDGET MODE vs BLOCK MODE
 */
if ( $is_widget ) {
	// Widget mode - default styles and get widget fields
	$background_type        = 'gradient';
	$rotation_deg           = 90;
	$background_color_start = '#9abfcc';
	$background_color_end   = '#d3eff4';
	$title_line_1           = get_field( 'title_line_1' ) ?: 'my favorite';
	$title_line_2           = get_field( 'title_line_2' ) ?: 'CARDS';
	$left_image             = get_field( 'left_image' );
	$favorite_cards         = get_field( 'favorite_cards' );
	$cta_label              = get_field( 'cta_label' );
	$cta_url                = get_field( 'cta_url' );

	// If no cards selected in widget, get from options as fallback
	if ( empty( $favorite_cards ) ) {
		$opts           = ofp_get_favorite_cards_options();
		$favorite_cards = $opts['widget_favorite_cards'];
	}
} else {
	// Block mode - get all fields from block
	$background_type        = get_field( 'background_type' ) ?: 'gradient';
	$background_image       = get_field( 'background_image' );
	$rotation_deg           = get_field( 'rotation_deg' ) ?: 90;
	$background_color_start = get_field( 'background_color_start' ) ?: '#9abfcc';
	$background_color_end   = get_field( 'background_color_end' ) ?: '#d3eff4';
	$background_color       = get_field( 'background_color' );
	$title_line_1           = get_field( 'title_line_1' ) ?: 'my favorite';
	$title_line_2           = get_field( 'title_line_2' ) ?: 'CARDS';
	$left_image             = get_field( 'left_image' );
	$favorite_cards         = get_field( 'favorite_cards' );
	$cta_label              = get_field( 'cta_label' );
	$cta_url                = get_field( 'cta_url' );
}

// Generate unique ID for styling
$blockID = 'course-library-' . uniqid();
?>

<?php /* Background styles */ ?>
<?php if ( $background_type === 'gradient' ) : ?>
<style>
  #<?php echo esc_attr( $blockID ); ?> {
    background: linear-gradient(<?php echo absint( $rotation_deg ); ?>deg,
      <?php echo esc_attr( $background_color_start ); ?> 0%,
      <?php echo esc_attr( $background_color_end ); ?> 100%);
  }
</style>
<?php elseif ( $background_type === 'image' && ! empty( $background_image['url'] ) ) : ?>
<style>
  #<?php echo esc_attr( $blockID ); ?> {
    background-image: url(<?php echo esc_url( $background_image['url'] ); ?>);
    background-size: cover;
    background-position: center;
  }
</style>
<?php elseif ( $background_type === 'color' && ! empty( $background_color ) ) : ?>
<style>
  #<?php echo esc_attr( $blockID ); ?> {
    background-color: <?php echo esc_attr( $background_color ); ?>;
  }
</style>
<?php endif; ?>

<div id="<?php echo esc_attr( $blockID ); ?>" class="my-favorite-cards">
  <div class="container">
    <div class="my-favorite-cards__left-col">
      <?php if ( $title_line_1 || $title_line_2 ) : ?>
        <h2 class="my-favorite-cards__title">
          <?php if ( $title_line_1 ) : ?>
            <span class="styled"><?php echo esc_html( $title_line_1 ); ?></span>
          <?php endif; ?>
          <?php if ( $title_line_2 ) : ?>
            <br /><span><?php echo esc_html( $title_line_2 ); ?></span>
          <?php endif; ?>
        </h2>
      <?php endif; ?>

      <?php if ( $left_image && ! empty( $left_image['url'] ) ) : ?>
        <img class="my-favorite-cards__image"
             src="<?php echo esc_url( $left_image['url'] ); ?>"
             alt="<?php echo esc_attr( $left_image['alt'] ?? '' ); ?>">
      <?php endif; ?>
    </div>

    <div class="my-favorite-cards__right-col">
      <div class="my-favorite-cards__cards">
        <?php
        if ( is_array( $favorite_cards ) && ! empty( $favorite_cards ) && is_array( $all_cards ) && ! empty( $all_cards ) ) :
          foreach ( $favorite_cards as $card ) :
            if ( isset( $card['fc_card_option'] ) && isset( $all_cards[ $card['fc_card_option'] ] ) ) :
              $card_option = $card['fc_card_option'];
              $card_data   = $all_cards[ $card_option ];
        ?>
          <div class="my-favorite-cards__card">
            <div class="my-favorite-cards__card-img">
              <?php if ( ! empty( $card_data['cci_card_image']['url'] ) ) : ?>
                <img src="<?php echo esc_url( $card_data['cci_card_image']['url'] ); ?>"
                     alt="<?php echo esc_attr( $card_data['cci_card_name'] ?? '' ); ?>">
              <?php endif; ?>
            </div>

            <div class="my-favorite-cards__card-content">
              <h2 class="my-favorite-cards__card-title">
                <?php echo esc_html( $card_data['cci_card_name'] ?? '' ); ?>
              </h2>

              <?php if ( ! empty( $card_data['cci_current_offer'] ) ) : ?>
                <h3 class="my-favorite-cards__card-offer">
                  <?php echo esc_html( $card_data['offer_points'] ?? '' ); ?>
                </h3>
              <?php endif; ?>

              <a class="btn my-favorite-cards__card-cta" target="_blank"
                 href="<?php echo esc_url( $card_data['cci_learn_more_link'] ?? '' ); ?>">
                Learn More <i class="fa fa-arrow-right" aria-hidden="true"></i>
              </a><br>

              <?php if ( ( $card_data['cci_terms_apply'] ?? '' ) === 'Yes' && ! empty( $card_data['cci_rates_and_fees'] ) ) : ?>
                <a class="my-favorite-cards__card-rates"
                   href="<?php echo esc_url( $card_data['cci_rates_and_fees'] ); ?>"
                   target="_blank" rel="noopener noreferrer">
                  Terms Apply / Rates &amp; Fees
                </a><br>
              <?php endif; ?>

              <?php if ( ! empty( $card_data['affiliate'] ) ) : ?>
                <div class="affiliate-info">
                  <?php echo wp_kses_post( $card_data['affiliate'] ); ?>
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

      <?php if ( ! empty( $cta_label ) ) : ?>
        <a class="btn my-favorite-cards__cta"
           href="<?php echo esc_url( $cta_url ?? '' ); ?>"
           target="_blank" rel="noopener noreferrer">
          <span><?php echo esc_html( $cta_label ); ?></span>
          <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </a>
      <?php endif; ?>
    </div>
  </div>
</div>