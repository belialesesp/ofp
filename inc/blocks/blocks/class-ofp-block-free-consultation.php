<?php
/**
 * Free Consultation Block
 * Location: /inc/blocks/blocks/class-ofp-block-free-consultation.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Free_Consultation extends OFP_Block_Base {

    protected string $name        = 'free-consultation';
    protected string $title       = 'Free Consultation';
    protected string $description = 'Block to show a Free Consultation.';
    protected string $icon        = 'welcome-learn-more';
    protected array  $keywords    = [ 'consultation', 'free', 'banner' ];

    public function init(): void {
        parent::init();
    }
}