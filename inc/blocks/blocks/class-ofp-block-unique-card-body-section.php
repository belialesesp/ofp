<?php
/**
 * Unique Card Body Section Block
 *
 * Migrated from: /custom-blocks/unique-card-body-section/unique-card-body-section.php
 * Location:      /inc/blocks/blocks/class-ofp-block-unique-card-body-section.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Unique_Card_Body_Section extends OFP_Block_Base {

    protected string $name        = 'unique-card-body-section';
    protected string $title       = 'Unique Card Body Section';
    protected string $description = 'Block to show a Unique Card Body Section.';
    protected string $icon        = 'money-alt';
    protected array  $keywords    = [ 'cards', 'favorite', 'banner' ];
    protected string $css_file    = '/custom-blocks/unique-card-body-section/unique-card-body-section.css';
}