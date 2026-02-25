<?php
/**
 * Custom Sidebar Block
 * Note: ACF fields managed via ACF UI.
 * CSS is enqueued globally in functions.php (sidebar-block.css) — no override needed.
 */
class OFP_Block_Sidebar_Block extends OFP_Block_Base {
    protected string $name        = 'sidebar-block';
    protected string $title       = 'Sidebar Block';
    protected string $description = 'Block to show a Sidebar.';
    protected string $icon        = 'layout';
    protected array  $keywords    = [ 'sidebar', 'widgets', 'layout' ];
}