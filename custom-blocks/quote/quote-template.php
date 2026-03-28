<?php
/**
 * Quote / Testimonial Block Template
 */

$quote_text   = get_field( 'quote_text' );
$author_name  = get_field( 'author_name' );
$author_role  = get_field( 'author_role' );
$author_photo = get_field( 'author_photo' );
$style        = get_field( 'style' ) ?: 'testimonial';
$accent_color = get_field( 'accent_color' ) ?: '#67B1BB';

if ( ! $quote_text ) return;
?>

<?php if ( 'pullquote' === $style ) : ?>

	<figure class="ofp-quote ofp-quote--pullquote">
		<svg class="ofp-quote__mark" aria-hidden="true" width="48" height="36" viewBox="0 0 48 36" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M0 36V22.5C0 10.5 6 3 18 0l2.4 4.2C13.8 6.3 10.5 10.2 10.2 15H18V36H0zm27 0V22.5C27 10.5 33 3 45 0l2.4 4.2C40.8 6.3 37.5 10.2 37.2 15H45V36H27z" fill="<?php echo esc_attr( $accent_color ); ?>"/>
		</svg>
		<blockquote class="ofp-quote__text">
			<?php echo wp_kses_post( $quote_text ); ?>
		</blockquote>
		<?php if ( $author_name ) : ?>
			<figcaption class="ofp-quote__attribution">
				<span class="ofp-quote__author" style="color:<?php echo esc_attr( $accent_color ); ?>;">
					— <?php echo esc_html( $author_name ); ?>
				</span>
				<?php if ( $author_role ) : ?>
					<span class="ofp-quote__role"><?php echo esc_html( $author_role ); ?></span>
				<?php endif; ?>
			</figcaption>
		<?php endif; ?>
	</figure>

<?php else : ?>

	<figure class="ofp-quote ofp-quote--testimonial" style="border-color:<?php echo esc_attr( $accent_color ); ?>;">
		<?php if ( $author_photo ) : ?>
			<div class="ofp-quote__photo">
				<img src="<?php echo esc_url( $author_photo['url'] ); ?>"
				     alt="<?php echo esc_attr( $author_photo['alt'] ?: $author_name ); ?>"
				     style="border-color:<?php echo esc_attr( $accent_color ); ?>;">
			</div>
		<?php endif; ?>
		<blockquote class="ofp-quote__text">
			<?php echo wp_kses_post( $quote_text ); ?>
		</blockquote>
		<?php if ( $author_name || $author_role ) : ?>
			<figcaption class="ofp-quote__attribution">
				<?php if ( $author_name ) : ?>
					<span class="ofp-quote__author" style="color:<?php echo esc_attr( $accent_color ); ?>;">
						<?php echo esc_html( $author_name ); ?>
					</span>
				<?php endif; ?>
				<?php if ( $author_role ) : ?>
					<span class="ofp-quote__role"><?php echo esc_html( $author_role ); ?></span>
				<?php endif; ?>
			</figcaption>
		<?php endif; ?>
	</figure>

<?php endif; ?>
