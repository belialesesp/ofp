<?php
add_action('acf/init', 'register_favorite_cards_small_block');
function register_favorite_cards_small_block() {
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'favorite-cards-small',
            'title'             => __('Favorite Cards Small'),
            'description'       => __('Section to display favorite cards.'),
            'render_template'   => 'custom-blocks/favorite-cards-small/favorite-cards-small-template.php', 
            'category'          => 'formatting',
            'icon'              => 'star-filled',
            'keywords'          => array('favorite', 'cards', 'small', 'favorites', 'list'),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'jsx'   => true
            )
        ));
    }
}