<?php
/**
 * Related Posts Block
 *
 * Location: /inc/blocks/blocks/class-ofp-block-related-posts.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Related_Posts extends OFP_Block_Base {

    protected string $name        = 'related-posts-auto';
    protected string $title       = 'Related Posts (Automatic)';
    protected string $description = 'Display related posts automatically by category.';
    protected string $icon        = 'admin-links';
    protected array  $keywords    = [ 'posts', 'related', 'automatic' ];

    protected array $supports = [
        'align' => false,
        'mode'  => true,
        'jsx'   => true,
    ];

    public function render( array $block ): void {
        $template = get_theme_file_path( '/custom-blocks/related-posts/related-posts-template.php' );
        if ( file_exists( $template ) ) {
            include $template;
        }
    }
}