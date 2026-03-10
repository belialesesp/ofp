<?php
/**
 * Free Resources Block
 *
 * Location: /inc/blocks/blocks/class-ofp-block-free-resources.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Free_Resources extends OFP_Block_Base {

    protected string $name        = 'free-resources';
    protected string $title       = 'Free Resources';
    protected string $description = 'Block to show Free Resources.';
    protected string $icon        = 'welcome-learn-more';
    protected array  $keywords    = [ 'resources', 'free', 'banner' ];
}