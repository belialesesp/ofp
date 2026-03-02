<?php
/**
 * Credit Card Hero Block Template
 */

global $post;
$post_id = $post->ID;

// Card data lives in a repeater on the CPT post itself
$credit_cards = get_field( 'credit_cards', $post_id );
$card_data    = $credit_cards[0] ?? null;

// Resolve card image URL
$image_url = '';
if ( isset( $card_data['cci_card_image'] ) ) {
	$image = $card_data['cci_card_image'];
	if ( is_array( $image ) && isset( $image['url'] ) ) {
		$image_url = $image['url'];
	} elseif ( is_numeric( $image ) ) {
		$image_url = wp_get_attachment_url( $image ) ?: '';
	}
}

// Animation images — ACF fields on the block, with theme asset fallbacks.
// Set these in the block editor to avoid any dependency on external servers.
$hello_travel_img = get_field( 'hello_travel_image' );
$ofp_logo_img     = get_field( 'ofp_logo_image' );

$hello_travel_url = ! empty( $hello_travel_img['url'] )
	? $hello_travel_img['url']
	: get_theme_file_uri( '/images/hello-travel.png' );

$ofp_logo_url = ! empty( $ofp_logo_img['url'] )
	? $ofp_logo_img['url']
	: get_theme_file_uri( '/images/ofp-logo.svg' );

// Offer end date: reformat DD/MM/YYYY → MM/DD/YYYY if needed
$offer_ends_formatted = '';
if ( ! empty( $card_data['cci_offer_ends'] ) ) {
	$date_parts = explode( '/', $card_data['cci_offer_ends'] );
	$offer_ends_formatted = ( count( $date_parts ) === 3 )
		? $date_parts[1] . '/' . $date_parts[0] . '/' . $date_parts[2]
		: $card_data['cci_offer_ends'];
}
?>

<div class="credit-card-hero-simple">
	<div class="hero-container container">

		<div class="credit-card-hero-animation">
			<img src="<?php echo esc_url( $hello_travel_url ); ?>"
			     alt="<?php esc_attr_e( 'Hello Travel', 'our-family-passport' ); ?>"
			     class="hello-travel rotating">
			<img src="<?php echo esc_url( $ofp_logo_url ); ?>"
			     alt="<?php esc_attr_e( 'Our Family Passport', 'our-family-passport' ); ?>"
			     class="ofp-logo">
		</div>

		<div class="hero-left">
			<div>
				<h1><?php echo esc_html( get_the_title( $post_id ) ); ?></h1>

				<?php if ( ! empty( $card_data['cci_new_offer'] ) ) : ?>
					<div class="offer-points">
						<h2><?php echo esc_html( $card_data['cci_new_offer'] ); ?></h2>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $card_data['cci_old_offer'] ) ) : ?>
					<div class="old-offer">
						<p><?php echo esc_html( $card_data['cci_old_offer'] ); ?></p>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $card_data['cci_current_offer'] ) ) : ?>
					<div class="current-offer">
						<p>
							<?php echo esc_html( $card_data['cci_current_offer'] ); ?>
							<?php if ( $offer_ends_formatted ) : ?>
								| *OFFER ENDS <?php echo esc_html( $offer_ends_formatted ); ?>
							<?php endif; ?>
						</p>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $card_data['cci_learn_more_link'] ) ) : ?>
					<div class="learn-more-section">
						<a href="<?php echo esc_url( $card_data['cci_learn_more_link'] ); ?>"
						   class="btn-learn-apply"
						   target="_blank"
						   rel="noopener noreferrer">
							LEARN HOW TO APPLY<i class="fas fa-arrow-right"></i>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="hero-right">
			<?php if ( $image_url ) : ?>
				<img src="<?php echo esc_url( $image_url ); ?>"
				     alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>">
			<?php endif; ?>

			<?php if ( ! empty( $card_data['cci_rates_and_fees'] ) ) : ?>
				<div class="rates-fees-section">
					<a href="<?php echo esc_url( $card_data['cci_rates_and_fees'] ); ?>"
					   class="rates-fees-link"
					   target="_blank"
					   rel="noopener noreferrer">
						RATES AND FEES
					</a>
				</div>
			<?php endif; ?>
		</div>

	</div>
</div>

<style>
.credit-card-hero-simple .hero-container.container {
	display: flex;
	flex-wrap: nowrap;
	gap: 2rem;
	justify-content: space-between;
}
.hero-left { max-width: 634px; }
.hero-left,
.hero-right {
	display: flex;
	flex-direction: column;
	align-items: center;
	padding: 3rem 0 0 0;
}
.hero-right { min-width: 350px; width: 493px; }
.hero-left h1 {
	color: #222;
	font-family: Versailles;
	font-size: 45px;
	font-weight: 400;
	line-height: 51px;
}
.offer-points h2 {
	color: var(--OFP-CTA, #F0A9AD);
	font-family: "GlacialIndifference";
	font-size: 30px;
	font-weight: 700;
	letter-spacing: 6px;
	text-transform: uppercase;
}
.old-offer p {
	color: #939393;
	font-family: "GlacialIndifference";
	font-size: 20px;
	font-weight: 700;
	letter-spacing: 4px;
	text-decoration-line: line-through;
	text-transform: uppercase;
}
.current-offer p {
	color: #222;
	font-family: "GlacialIndifference";
	font-size: 17.719px;
	font-weight: 400;
}
.learn-more-section .btn-learn-apply {
	color: var(--OFP-Color-3, #9BBFCD);
	font-family: "GlacialIndifference";
	font-size: 25px;
	font-weight: 700;
	line-height: 74.4px;
	letter-spacing: 5px;
	text-transform: uppercase;
	text-underline-offset: .5rem;
}
.rates-fees-link {
	color: #9A9A9A;
	font-family: "GlacialIndifference";
	font-size: 12px;
	font-weight: 700;
	line-height: 74.4px;
	letter-spacing: 2.4px;
	text-transform: uppercase;
	text-underline-offset: .5rem;
}
.credit-card-hero-animation {
	width: 152px;
	height: auto;
	position: relative;
}
.ofp-logo {
	position: absolute;
	left: 30px;
	top: 30px;
	height: 66px;
}
.btn-learn-apply i.fas.fa-arrow-right { margin-left: 1rem; }
@keyframes spin {
	from { transform: rotate(0deg); }
	to   { transform: rotate(360deg); }
}
.rotating { animation: spin 15s linear infinite; }
</style>