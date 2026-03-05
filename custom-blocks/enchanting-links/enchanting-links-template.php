<?php
/**
 * Enchanting Links Block Template
 * Location: /custom-blocks/enchanting-links/enchanting-links-template.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$background_type        = get_field( 'background_type' );
$background_color       = get_field( 'background_color' );
$background_color_start = get_field( 'background_color_start' );
$background_color_end   = get_field( 'background_color_end' );
$rotation_deg           = get_field( 'rotation_deg' );
$background_image       = get_field( 'background_image' );
$title_color            = get_field( 'title_color' );

$block_id = 'enchanting-links-' . uniqid();
?>

<?php if ( $background_type === 'gradient' && $background_color_start && $background_color_end ) : ?>
    <style>
        #<?php echo esc_attr( $block_id ); ?> {
            background: linear-gradient(
                <?php echo absint( $rotation_deg ?: 0 ); ?>deg,
                <?php echo esc_attr( $background_color_start ); ?> 0%,
                <?php echo esc_attr( $background_color_end ); ?> 100%
            );
        }
    </style>
<?php elseif ( $background_type === 'image' && ! empty( $background_image['url'] ) ) : ?>
    <style>
        #<?php echo esc_attr( $block_id ); ?> {
            background-image: url('<?php echo esc_url( $background_image['url'] ); ?>');
            background-size: cover;
            background-position: center;
        }
    </style>
<?php elseif ( $background_type === 'color' && $background_color ) : ?>
    <style>
        #<?php echo esc_attr( $block_id ); ?> {
            background-color: <?php echo esc_attr( $background_color ); ?>;
        }
    </style>
<?php endif; ?>

<div id="<?php echo esc_attr( $block_id ); ?>" class="enchanting-links">
    <div class="container">
        <?php /* Block content — not yet implemented */ ?>
    </div>
</div>