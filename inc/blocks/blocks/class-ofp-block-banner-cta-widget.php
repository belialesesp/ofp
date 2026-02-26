<?php
/**
 * Banner CTA widget Block
 *
 * Migrated from: /custom-blocks/banner-cta-widget/banner-cta-widget.php
 * Location:      /inc/blocks/blocks/class-ofp-block-banner-cta-widget.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Banner_Cta_Widget extends OFP_Block_Base {

    protected string $name        = 'banner-cta-widget';
    protected string $title       = 'Banner CTA widget';
    protected string $description = 'Block to show a Banner CTA widget.';
    protected string $icon        = 'format-image';
    protected array  $keywords    = [ 'hero', 'image', 'banner' ];
}