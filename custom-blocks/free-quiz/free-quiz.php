<?php
add_action('acf/init', 'register_free_quiz_block');
function register_free_quiz_block() {
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'free-quiz',
            'title'             => __('Free Quiz'),
            'description'       => __('Free Quiz section.'),
            'render_template'   => 'custom-blocks/free-quiz/free-quiz-template.php', 
            'category'          => 'formatting',
            'icon'              => 'format-image',
            'keywords'          => array('free-quiz', 'quiz', 'cards', 'links'),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'jsx'   => true
            )
        ));
    }
}