<?php
/**
 * Section Wrapper Block Template
 *
 * Renders a section container with a configurable background.
 * Inner blocks are placed via <InnerBlocks /> (editor) or $content (frontend).
 */

$background_type  = get_field( 'background_type' ) ?: 'color';
$background_color = get_field( 'background_color' ) ?: '#ffffff';
$background_image = get_field( 'background_image' );
$gradient_start   = get_field( 'gradient_start' ) ?: '#ffffff';
$gradient_end     = get_field( 'gradient_end' ) ?: '#ffffff';
$rotation_deg     = absint( get_field( 'rotation_deg' ) ?: 135 );
$block_id         = 'section-wrapper-' . uniqid();
?>

<style>
#<?php echo esc_attr( $block_id ); ?> {
	position: relative;
	width: 100%;

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

<div id="<?php echo esc_attr( $block_id ); ?>" class="section-wrapper">
	<?php if ( $content ) : ?>
		<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped — inner blocks HTML ?>
	<?php else : ?>
		<InnerBlocks />
	<?php endif; ?>
</div>
