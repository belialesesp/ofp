<?php
/**
 * Block system entry point.
 *
 * Replaces /custom-blocks/index.php.
 * Called from functions.php via:
 *   require get_template_directory() . '/inc/blocks/index.php';
 *
 * During migration: blocks not yet converted to OOP are still loaded
 * here via require, exactly as before. As each block is migrated,
 * its require line is removed from the legacy section below.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// --- OOP System -------------------------------------------------
require_once __DIR__ . '/class-ofp-block-base.php';
require_once __DIR__ . '/class-ofp-block-registry.php';
OFP_Block_Registry::instance()->init();

// --- Legacy blocks (not yet migrated to OOP) ---------------------
// Remove each line below as the corresponding block is migrated.
$legacy_blocks_dir = get_template_directory() . '/custom-blocks/';

// require $legacy_blocks_dir . 'about-kam/about-kam.php';
// require $legacy_blocks_dir . 'about-kam-widget/about-kam-widget.php';
// require $legacy_blocks_dir . 'banner-cta-widget/banner-cta-widget.php';
// require $legacy_blocks_dir . 'box-grid/box-grid.php';
// require $legacy_blocks_dir . 'contact-form/contact-form.php';
// require $legacy_blocks_dir . 'course-library/course-library.php';
// require $legacy_blocks_dir . 'credit-card-hero/credit-card-hero.php';
// require $legacy_blocks_dir . 'credit-cards/credit-cards.php';
// require $legacy_blocks_dir . 'destinations-map/destinations-map.php';
// require $legacy_blocks_dir . 'enchanting-links/enchanting-links.php';
// require $legacy_blocks_dir . 'extra-benefits/extra-benefits.php';
// require $legacy_blocks_dir . 'favorite-cards/favorite-cards.php';
// require $legacy_blocks_dir . 'favorite-things/favorite-things.php';
// require $legacy_blocks_dir . 'free-consultation/free-consultation.php';
// require $legacy_blocks_dir . 'free-resources/free-resources.php';
// require $legacy_blocks_dir . 'free-resources-list/free-resources-list.php';
// require $legacy_blocks_dir . 'hero-content/hero-content.php';
// require $legacy_blocks_dir . 'hero-image/hero-image.php';
// require $legacy_blocks_dir . 'instagram-cb/instagram-cb.php';
// require $legacy_blocks_dir . 'lets-connect/lets-connect.php';
// require $legacy_blocks_dir . 'must-read/must-read.php';
// require $legacy_blocks_dir . 'newsletter/newsletter.php';
// require $legacy_blocks_dir . 'rotating-words/rotating-words.php';
// require $legacy_blocks_dir . 'sidebar-block/sidebar-block.php';
// require $legacy_blocks_dir . 'start-here/start-here.php';
// require $legacy_blocks_dir . 'success-stories/success-stories.php';
// require $legacy_blocks_dir . 'the-blog/the-blog.php';
// require $legacy_blocks_dir . 'time-line/time-line.php';
// require $legacy_blocks_dir . 'unique-card/unique-card.php';

// --- Global block styles ---------------
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'ofp-custom-blocks',
        get_stylesheet_directory_uri() . '/custom-blocks/styles.css',
        [],
        defined( 'OFP_VERSION' ) ? OFP_VERSION : wp_get_theme()->get( 'Version' )
    );
} );