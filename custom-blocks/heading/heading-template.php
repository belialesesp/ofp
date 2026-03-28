<?php
/**
 * OFP Heading Block Template
 */

$text       = get_field( 'text' );
$level      = get_field( 'level' )      ?: 'h2';
$font       = get_field( 'font_family' ) ?: 'versailles';
$size       = get_field( 'size' )       ?: 'h2';
$alignment  = get_field( 'alignment' )  ?: 'left';
$color      = get_field( 'color' )      ?: '#222222';

if ( ! $text ) return;

// Allowed heading tags
$allowed_levels = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ];
$tag = in_array( $level, $allowed_levels, true ) ? $level : 'h2';

$font_map = [
	'versailles' => '"Versailles", sans-serif',
	'gothic'     => '"League Gothic", sans-serif',
	'glacial'    => '"GlacialIndifference", sans-serif',
	'moontime'   => '"Net MoonTime", sans-serif',
];

$size_map = [
	'display' => '5rem',
	'h1'      => '4rem',
	'h2'      => '3rem',
	'h3'      => '2rem',
	'h4'      => '1.5rem',
	'h5'      => '1.25rem',
	'h6'      => '1rem',
];

$font_family = $font_map[ $font ] ?? $font_map['versailles'];
$font_size   = $size_map[ $size ] ?? $size_map['h2'];

$style = sprintf(
	'font-family:%s;font-size:%s;text-align:%s;color:%s;font-weight:400;line-height:1.2;margin:0;',
	esc_attr( $font_family ),
	esc_attr( $font_size ),
	esc_attr( $alignment ),
	esc_attr( $color )
);
?>

<<?php echo esc_attr( $tag ); ?> class="ofp-heading" style="<?php echo $style; ?>">
	<?php echo esc_html( $text ); ?>
</<?php echo esc_attr( $tag ); ?>>
