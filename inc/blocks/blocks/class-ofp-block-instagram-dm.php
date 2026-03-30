<?php
/**
 * Instagram DM Block
 *
 * Location: /inc/blocks/blocks/class-ofp-block-instagram-dm.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Instagram_DM extends OFP_Block_Base {

    protected string $name        = 'instagram-dm';
    protected string $title       = 'Instagram DM';
    protected string $description = 'Slider of testimonials styled as Instagram DMs.';
    protected string $icon        = 'format-chat';
    protected array  $keywords    = [ 'instagram', 'dm', 'testimonials', 'social' ];
}