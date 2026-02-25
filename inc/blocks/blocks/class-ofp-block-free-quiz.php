<?php
/**
 * Free Quiz Block
 *
 * Migrated from: /custom-blocks/free-quiz/free-quiz.php
 * Location:      /inc/blocks/blocks/class-ofp-block-free-quiz.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Free_Quiz extends OFP_Block_Base {

    protected string $name        = 'free-quiz';
    protected string $title       = 'Free Quiz';
    protected string $description = 'Free Quiz section.';
    protected string $icon        = 'format-image';
    protected array  $keywords    = [ 'free-quiz', 'quiz', 'cards', 'links' ];
    protected array  $supports    = [ 'align' => false, 'jsx' => true ];
    protected string $css_file    = '/custom-blocks/free-quiz/free-quiz.css';
}