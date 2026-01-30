<?php
add_action('acf/init', 'register_enchanted_link_block');
function register_enchanted_link_block() {
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'enchanted-link',
            'title'             => __('Enchanted Link'),
            'description'       => __('Enchanted Link section.'),
            'render_template'   => 'custom-blocks/enchanted-link/enchanted-link-template.php', 
            'category'          => 'formatting',
            'icon'              => 'move',
            'keywords'          => array('enchanted-link', 'animation', 'text', 'scroll'),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'jsx'   => true
            )
        ));
    }
}