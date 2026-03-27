<?php
/**
 * CTA Block Template
 */

$eyebrow          = get_field( 'eyebrow' );
$title            = get_field( 'title' );
$description      = get_field( 'description' );
$button_label     = get_field( 'button_label' );
$button_url       = get_field( 'button_url' );
$button_new_tab   = get_field( 'button_new_tab' );
$text_color       = get_field( 'text_color' ) ?: '#2b2b2b';
$button_color     = get_field( 'button_color' ) ?: '#BED8BA';
$button_text_color = get_field( 'button_text_color' ) ?: '#2b2b2b';
$background_type  = get_field( 'background_type' ) ?: 'color';
$background_color = get_field( 'background_color' ) ?: '#F7F0E5';
$background_image = get_field( 'background_image' );
$gradient_start   = get_field( 'gradient_start' ) ?: '#F9C9B4';
$gradient_end     = get_field( 'gradient_end' ) ?: '#FDD7D4';
$rotation_deg     = absint( get_field( 'rotation_deg' ) ?: 127 );
$block_id         = 'cta-' . uniqid();
$target           = $button_new_tab ? '_blank' : '_self';
$rel              = $button_new_tab ? 'noopener noreferrer' : '';
?>

<style>
#<?php echo esc_attr( $block_id ); ?> {
	<?php if ( 'color' === $background_type ) : ?>
	background-color: <?php echo esc_attr( $background_color ); ?>;

	<?php elseif ( 'image' === $background_type && $background_image ) : ?>
	background-image: url(<?php echo esc_url( $background_image['url'] ); ?>);
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;

	<?php elseif ( 'gradient' === $background_type ) : ?>
	background: linear-gradient(
		<?php echo $rotation_deg; ?>deg,
		<?php echo esc_attr( $gradient_start ); ?> 0%,
		<?php echo esc_attr( $gradient_end ); ?> 100%
	);
	<?php endif; ?>
}
</style>

<div id="<?php echo esc_attr( $block_id ); ?>" class="cta-block">
	<div class="cta-block__inner container">

		<?php if ( $eyebrow ) : ?>
			<p class="cta-block__eyebrow" style="color: <?php echo esc_attr( $text_color ); ?>;">
				<?php echo esc_html( $eyebrow ); ?>
			</p>
		<?php endif; ?>

		<?php if ( $title ) : ?>
			<h2 class="cta-block__title" style="color: <?php echo esc_attr( $text_color ); ?>;">
				<?php echo esc_html( $title ); ?>
			</h2>
		<?php endif; ?>

		<?php if ( $description ) : ?>
			<div class="cta-block__description" style="color: <?php echo esc_attr( $text_color ); ?>;">
				<?php echo wp_kses_post( $description ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $button_label && $button_url ) : ?>
			<a href="<?php echo esc_url( $button_url ); ?>"
			   class="cta-block__button"
			   target="<?php echo esc_attr( $target ); ?>"
			   <?php echo $rel ? 'rel="' . esc_attr( $rel ) . '"' : ''; ?>
			   style="background-color: <?php echo esc_attr( $button_color ); ?>; color: <?php echo esc_attr( $button_text_color ); ?>;">
				<?php echo esc_html( $button_label ); ?>
			</a>
		<?php endif; ?>

	</div>
</div>
