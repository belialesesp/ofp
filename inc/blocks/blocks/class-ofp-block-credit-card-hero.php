<?php
/**
 * Credit Card Hero Block
 *
 * Migrated from: /custom-blocks/credit-card-hero/credit-card-hero.php
 * Location:      /inc/blocks/blocks/class-ofp-block-credit-card-hero.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Credit_Card_Hero extends OFP_Block_Base {

    protected string $name        = 'credit-card-hero';
    protected string $title       = 'Credit Card Hero';
    protected string $description = 'Displays the main hero section with card image and information';
    protected string $icon        = 'credit-card';
    protected array  $keywords    = [ 'credit', 'card', 'hero' ];
}