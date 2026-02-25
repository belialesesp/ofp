<?php
/**
 * OFP Calculator Block
 * Note: ACF fields managed via ACF UI.
 * Bootstrap + FontAwesome are enqueued in functions.php — no override needed here.
 */
class OFP_Block_Ofp_Calculator extends OFP_Block_Base {
    protected string $name        = 'ofp-calculator';
    protected string $title       = 'OFP Calculator';
    protected string $description = 'Block to show the OFP Calculator.';
    protected string $icon        = 'calculator';
    protected array  $keywords    = [ 'calculator', 'points', 'finance' ];
}