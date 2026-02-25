<?php
/**
 * Non-Affiliate Disclosure Block
 *
 * Originally registered in functions.php via acf_register_block_type()
 * using render_template instead of render_callback.
 * Location: /inc/blocks/blocks/class-ofp-block-non-affiliate-disclosure.php
 *
 * Note: ACF fields managed via ACF UI.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Non_Affiliate_Disclosure extends OFP_Block_Base {

    protected string $name        = 'non-affiliate-disclosure';
    protected string $title       = 'Non-Affiliate Disclosure';
    protected string $description = 'Displays a non-affiliate disclosure message.';
    protected string $icon        = 'info';
    protected array  $keywords    = [ 'disclosure', 'affiliate', 'legal' ];
    protected array  $supports    = [
        'align' => [ 'wide', 'full' ],
        'mode'  => true,
        'jsx'   => true,
    ];
}