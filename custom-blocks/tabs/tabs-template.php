<?php
/**
 * Tabs Block Template
 */

$items    = get_field( 'items' );
$block_id = 'tabs-' . uniqid();
?>

<?php if ( $items ) : ?>
<div id="<?php echo esc_attr( $block_id ); ?>" class="tabs-block">
	<div class="container">

		<!-- Tab navigation -->
		<div class="tabs-block__nav" role="tablist">
			<?php foreach ( $items as $index => $item ) :
				$tab_id   = $block_id . '-tab-' . $index;
				$panel_id = $block_id . '-panel-' . $index;
				$is_first = ( 0 === $index );
			?>
				<button
					class="tabs-block__tab<?php echo $is_first ? ' is-active' : ''; ?>"
					role="tab"
					id="<?php echo esc_attr( $tab_id ); ?>"
					aria-selected="<?php echo $is_first ? 'true' : 'false'; ?>"
					aria-controls="<?php echo esc_attr( $panel_id ); ?>"
					tabindex="<?php echo $is_first ? '0' : '-1'; ?>"
				>
					<?php echo esc_html( $item['tab_label'] ); ?>
				</button>
			<?php endforeach; ?>
		</div>

		<!-- Tab panels -->
		<div class="tabs-block__panels">
			<?php foreach ( $items as $index => $item ) :
				$tab_id   = $block_id . '-tab-' . $index;
				$panel_id = $block_id . '-panel-' . $index;
				$is_first = ( 0 === $index );
			?>
				<div
					class="tabs-block__panel<?php echo $is_first ? ' is-active' : ''; ?>"
					id="<?php echo esc_attr( $panel_id ); ?>"
					role="tabpanel"
					aria-labelledby="<?php echo esc_attr( $tab_id ); ?>"
					<?php echo ! $is_first ? 'hidden' : ''; ?>
				>
					<div class="tabs-block__panel-inner">
						<?php echo wp_kses_post( $item['tab_content'] ); ?>
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

	var tabs   = Array.from( block.querySelectorAll('.tabs-block__tab') );
	var panels = Array.from( block.querySelectorAll('.tabs-block__panel') );

	function activateTab( tab ) {
		// Deactivate all
		tabs.forEach(function (t) {
			t.setAttribute('aria-selected', 'false');
			t.setAttribute('tabindex', '-1');
			t.classList.remove('is-active');
		});
		panels.forEach(function (p) {
			p.hidden = true;
			p.classList.remove('is-active');
		});

		// Activate selected
		tab.setAttribute('aria-selected', 'true');
		tab.setAttribute('tabindex', '0');
		tab.classList.add('is-active');

		var panel = block.querySelector('#' + tab.getAttribute('aria-controls'));
		if ( panel ) {
			panel.hidden = false;
			panel.classList.add('is-active');
		}
	}

	tabs.forEach(function (tab) {
		tab.addEventListener('click', function () {
			activateTab( this );
		});

		// Keyboard navigation (left/right arrows)
		tab.addEventListener('keydown', function (e) {
			var idx = tabs.indexOf( this );
			if ( e.key === 'ArrowRight' ) {
				activateTab( tabs[ (idx + 1) % tabs.length ] );
				tabs[ (idx + 1) % tabs.length ].focus();
			}
			if ( e.key === 'ArrowLeft' ) {
				activateTab( tabs[ (idx - 1 + tabs.length) % tabs.length ] );
				tabs[ (idx - 1 + tabs.length) % tabs.length ].focus();
			}
		});
	});
}());
</script>
<?php endif; ?>
