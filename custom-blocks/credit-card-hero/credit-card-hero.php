<?php
// REGISTER CREDIT CARD HERO BLOCK
add_action('acf/init', 'credit_card_hero_register_block');
function credit_card_hero_register_block() {
    if (function_exists('acf_register_block')) {
        acf_register_block(array(
            'name'              => 'credit-card-hero',
            'title'             => __('Credit Card Hero'),
            'description'       => __('Displays the main hero section with card image and information'),
            'render_callback'   => 'credit_card_hero_render',
            'category'          => 'formatting',
            'icon'              => 'credit-card',
            'keywords'          => array('credit', 'card', 'hero'),
            'mode'              => 'preview',
        ));
    }
}

// RENDER FUNCTION FOR HERO BLOCK
function credit_card_hero_render($block) {
    // convert name ("acf/credit-card-hero") into path friendly slug ("credit-card-hero")
    $slug = str_replace('acf/', '', $block['name']);
    // include a template part from folder
    if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
        include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
    }
}