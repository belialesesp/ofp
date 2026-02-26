<?php
/**
 * Contact Form Block
 *
 * Migrated from: /custom-blocks/contact-form/contact-form.php
 * Location:      /inc/blocks/blocks/class-ofp-block-contact-form.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Contact_Form extends OFP_Block_Base {

    protected string $name        = 'contact-form';
    protected string $title       = 'Contact Form';
    protected string $description = 'Block to show a Contact Form.';
    protected string $icon        = 'feedback';
    protected array  $keywords    = [ 'contact', 'image', 'banner' ];
}