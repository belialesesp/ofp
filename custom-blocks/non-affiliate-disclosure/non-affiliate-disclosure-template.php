<?php
/**
 * Non-Affiliate Disclosure Block Template
 */

// Get block fields
$disclosure_text = get_field('disclosure_text');

// Se não há texto, não exibe nada
if (!$disclosure_text) {
    return;
}

// Block classes
$className = 'non-affiliate-disclosure-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>

<div class="<?php echo esc_attr($className); ?>">
    <div class="disclosure-content">
        <p class="disclosure-text"><?php echo wp_kses_post($disclosure_text); ?></p>
    </div>
</div>