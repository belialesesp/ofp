<?php
add_action('acf/init', 'register_words_animation_block');
function register_words_animation_block() {
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'words-animation',
            'title'             => __('Words Animation'),
            'description'       => __('Words Animation section.'),
            'render_template'   => 'custom-blocks/words-animation/words-animation-template.php', 
            'category'          => 'formatting',
            'icon'              => 'move',
            'keywords'          => array('words-animation', 'animation', 'text', 'scroll'),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'jsx'   => true
            )
        ));
    }
}