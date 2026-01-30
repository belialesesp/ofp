<?php
add_action('acf/init', 'register_guides_block');
function register_guides_block() {
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'guides',
            'title'             => __('Guides'),
            'description'       => __('Guides section.'),
            'render_template'   => 'custom-blocks/guides/guides-template.php', 
            'category'          => 'formatting',
            'icon'              => 'format-image',
            'keywords'          => array('guides', 'cards', 'links'),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'jsx'   => true
            )
        ));
    }
}