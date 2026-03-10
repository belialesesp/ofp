<?php
/**
 * Favorite Cards Block Template
 * Supports block mode and widget mode (legacy WP widget via Favorite_Cards_Widget).
 * Cards are sourced from the Credit Cards CPT — each repeater row stores a post ID
 * in fc_card_option (Post Object field, return format: ID).
 */

$is_widget = ( function_exists( 'ofp_is_widget_mode' ) && ofp_is_widget_mode() )
             || (bool) get_field( 'is_widget' );

// All cards indexed by post ID — single cached query via acf-helpers.php.
$all_cards = ofp_get_all_credit_cards();

if ( $is_widget ) {
    // Widget mode — fixed background, fields from options page.
    $background_type        = 'gradient';
    $rotation_deg           = 90;
    $background_color_start = '#9abfcc';
    $background_color_end   = '#d3eff4';
    $opts         = ofp_get_favorite_cards_options();
    $title_line_1 = $opts['widget_title_line_1'] ?: 'my favorite';
    $title_line_2 = $opts['widget_title_line_2'] ?: 'CARDS';
    $left_image   = $opts['widget_left_image'];
    $cta_label    = $opts['widget_cta_label'];
    $cta_url      = $opts['widget_cta_url'];
    $raw_cards    = $opts['widget_favorite_cards'] ?: array();
} else {
    // Block mode — fields from the block instance.
    $background_type        = get_field( 'background_type' )        ?: 'gradient';
    $background_image       = get_field( 'background_image' );
    $rotation_deg           = get_field( 'rotation_deg' )           ?: 90;
    $background_color_start = get_field( 'background_color_start' ) ?: '#9abfcc';
    $background_color_end   = get_field( 'background_color_end' )   ?: '#d3eff4';
    $background_color       = get_field( 'background_color' );
    $title_line_1           = get_field( 'title_line_1' )           ?: 'my favorite';
    $title_line_2           = get_field( 'title_line_2' )           ?: 'CARDS';
    $left_image             = get_field( 'left_image' );
    $cta_label              = get_field( 'cta_label' );
    $cta_url                = get_field( 'cta_url' );
    $raw_cards              = get_field( 'favorite_cards' )         ?: array();
}

// Normalise: build a flat list of post IDs from the repeater rows.
$card_ids = array();
foreach ( (array) $raw_cards as $row ) {
    $id = intval( $row['fc_card_post'] ?? $row['fc_card_option'] ?? 0 );
    if ( $id > 0 ) {
        $card_ids[] = $id;
    }
}

// Unique block ID for scoped inline background styles.
$blockID = 'favorite-cards-' . uniqid();
?>

<?php /* ── Inline background styles (dynamic — cannot live in SCSS) ── */ ?>
<?php if ( $background_type === 'gradient' ) : ?>
<style>
  #<?php echo esc_attr( $blockID ); ?> {
    background: linear-gradient(
      <?php echo absint( $rotation_deg ); ?>deg,
      <?php echo esc_attr( $background_color_start ); ?> 0%,
      <?php echo esc_attr( $background_color_end ); ?> 100%
    );
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
            <span class="styled">
              <?php echo esc_html( $title_line_1 ); ?>
              <img src="https://www.ourfamilypassport.com/wp-content/uploads/2024/08/Heart.svg"
                   alt="heart"
                   class="my-favorite-cards__title-heart">
            </span>
          <?php endif; ?>
          <?php if ( $title_line_2 ) : ?>
            <br /><span><?php echo esc_html( $title_line_2 ); ?></span>
          <?php endif; ?>
        </h2>
      <?php endif; ?>

      <?php if ( ! empty( $left_image['url'] ) ) : ?>
        <img class="my-favorite-cards__image"
             src="<?php echo esc_url( $left_image['url'] ); ?>"
             alt="<?php echo esc_attr( $left_image['alt'] ?? '' ); ?>">
      <?php endif; ?>
    </div>

    <div class="my-favorite-cards__right-col">
      <div class="my-favorite-cards__cards">
        <?php foreach ( $card_ids as $card_id ) : ?>
          <?php
          $card_data = $all_cards[ $card_id ] ?? null;
          if ( ! $card_data ) continue;
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

              <?php if ( ! empty( $card_data['offer_points'] ) ) : ?>
                <h3 class="my-favorite-cards__card-offer">
                  <?php echo esc_html( $card_data['offer_points'] ); ?>
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
        <?php endforeach; ?>
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