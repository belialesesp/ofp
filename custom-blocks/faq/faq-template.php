<?php
/**
 * FAQ / Accordion Block Template
 */

$section_title = get_field( 'section_title' );
$items         = get_field( 'items' );
$block_id      = 'faq-' . uniqid();
?>

<?php if ( $items ) : ?>
<div id="<?php echo esc_attr( $block_id ); ?>" class="faq-block">
	<div class="container">

		<?php if ( $section_title ) : ?>
			<h2 class="faq-block__title">
				<?php echo esc_html( $section_title ); ?>
			</h2>
		<?php endif; ?>

		<div class="faq-block__list">
			<?php foreach ( $items as $index => $item ) :
				$item_id = $block_id . '-item-' . $index;
			?>
				<div class="faq-block__item">
					<button
						class="faq-block__question"
						aria-expanded="false"
						aria-controls="<?php echo esc_attr( $item_id ); ?>"
					>
						<span class="faq-block__question-text">
							<?php echo esc_html( $item['question'] ); ?>
						</span>
						<span class="faq-block__icon" aria-hidden="true">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</span>
					</button>
					<div
						id="<?php echo esc_attr( $item_id ); ?>"
						class="faq-block__answer"
						role="region"
					>
						<div class="faq-block__answer-inner">
							<?php echo wp_kses_post( $item['answer'] ); ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</div>

<script>
(function () {
	var block = document.getElementById('<?php echo esc_js( $block_id ); ?>');
	if ( ! block ) return;

	block.querySelectorAll('.faq-block__question').forEach(function (btn) {
		btn.addEventListener('click', function () {
			var item   = this.closest('.faq-block__item');
			var answer = item.querySelector('.faq-block__answer');
			var isOpen = this.getAttribute('aria-expanded') === 'true';

			// Close all items in this block
			block.querySelectorAll('.faq-block__item').forEach(function (el) {
				el.querySelector('.faq-block__question').setAttribute('aria-expanded', 'false');
				el.querySelector('.faq-block__answer').style.maxHeight = null;
				el.classList.remove('is-open');
			});

			// Open the clicked item if it was closed
			if ( ! isOpen ) {
				this.setAttribute('aria-expanded', 'true');
				answer.style.maxHeight = answer.scrollHeight + 'px';
				item.classList.add('is-open');
			}
		});
	});
}());
</script>
<?php endif; ?>
