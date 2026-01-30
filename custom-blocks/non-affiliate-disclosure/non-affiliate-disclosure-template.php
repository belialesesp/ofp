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

<style>
.non-affiliate-disclosure-block {
    margin: 1rem 5rem;
    background-color: transparent;
    text-align: center;
}

.non-affiliate-disclosure-block .disclosure-content {
    max-width: 100%;
}

.non-affiliate-disclosure-block .disclosure-text {
    margin: 0;
    font-size: 14px;
    line-height: 1.6;
    color: #666;
    font-style: italic;
}

/* Responsive */
@media (max-width: 768px) {
    .non-affiliate-disclosure-block {
        padding: 15px;
        margin: 20px 0;
    }
    
    .non-affiliate-disclosure-block .disclosure-text {
        font-size: 13px;
    }
}
</style>