<?php
require 'block-registration-helper.php';

/**
 * Block definitions.
 *
 * Each entry is registered via the shared register_custom_block() helper,
 * which uses the single generic custom_block_render() render callback.
 * Only the fields/enqueues/filters that are unique to a block live in
 * that block's own .php file.
 */
$custom_blocks = array(

  // ── Content blocks ──────────────────────────────────────────────────────
  array( 'name' => 'hero-content',        'title' => 'Hero Content',        'icon' => 'schedule',            'keywords' => array( 'hero', 'image', 'banner' ) ),
  array( 'name' => 'hero-image',          'title' => 'Hero Image',          'icon' => 'format-image',        'keywords' => array( 'hero', 'image', 'banner' ) ),
  array( 'name' => 'the-blog',            'title' => 'The Blog',            'icon' => 'format-quote',        'keywords' => array( 'blog', 'post', 'destinations' ) ),
  array( 'name' => 'start-here',          'title' => 'Start Here',          'icon' => 'editor-spellcheck',   'keywords' => array( 'start', 'here', 'content' ) ),
  array( 'name' => 'must-read',           'title' => 'Must Read',           'icon' => 'book-alt',            'keywords' => array( 'read', 'post', 'content' ) ),
  array( 'name' => 'about-kam',           'title' => 'About Kam',           'icon' => 'admin-users',         'keywords' => array( 'about', 'author', 'profile' ) ),
  array( 'name' => 'about-kam-widget',    'title' => 'About Kam Widget',    'icon' => 'admin-users',         'keywords' => array( 'about', 'author', 'widget' ) ),
  array( 'name' => 'time-line',           'title' => 'Time Line',           'icon' => 'clock',               'keywords' => array( 'timeline', 'history', 'events' ) ),
  array( 'name' => 'rotating-words',      'title' => 'Rotating Words',      'icon' => 'editor-textcolor',    'keywords' => array( 'text', 'animation', 'rotating' ) ),
  array( 'name' => 'instagram-cb',        'title' => 'Instagram',           'icon' => 'instagram',           'keywords' => array( 'instagram', 'social', 'feed' ) ),
  array( 'name' => 'contact-form',        'title' => 'Contact Form',        'icon' => 'email-alt',           'keywords' => array( 'contact', 'form', 'email' ) ),
  array( 'name' => 'search',              'title' => 'Search',              'icon' => 'search',              'keywords' => array( 'search', 'hero', 'trending' ) ),
  array( 'name' => 'behind-the-screen',   'title' => 'Behind The Screen',   'icon' => 'heart',               'keywords' => array( 'behind', 'screen', 'content' ) ),

  // ── Cards & resources ───────────────────────────────────────────────────
  array( 'name' => 'credit-cards',        'title' => 'Credit Cards',        'icon' => 'money-alt',           'keywords' => array( 'credit', 'cards', 'quote' ) ),
  array( 'name' => 'favorite-cards',      'title' => 'My Favorite Cards',   'icon' => 'money-alt',           'keywords' => array( 'cards', 'favorite', 'banner' ) ),
  array( 'name' => 'favorite-things',     'title' => 'Favorite Things',     'icon' => 'heart',               'keywords' => array( 'cards', 'favorite', 'banner' ) ),
  array( 'name' => 'box-grid',            'title' => 'Box Grid',            'icon' => 'editor-kitchensink',  'keywords' => array( 'cards', 'grid', 'banner' ) ),
  array( 'name' => 'extra-benefits',      'title' => 'Extra Benefits',      'icon' => 'editor-kitchensink',  'keywords' => array( 'cards', 'benefits', 'banner' ) ),
  array( 'name' => 'unique-card',         'title' => 'Unique Card',         'icon' => 'money-alt',           'keywords' => array( 'cards', 'favorite', 'banner' ) ),
  array( 'name' => 'free-resources',      'title' => 'Free Resources',      'icon' => 'download',            'keywords' => array( 'resources', 'free', 'download' ) ),
  array( 'name' => 'free-resources-list', 'title' => 'Free Resources List', 'icon' => 'welcome-learn-more',  'keywords' => array( 'resources', 'free', 'list' ) ),
  array( 'name' => 'free-consultation',   'title' => 'Free Consultation',   'icon' => 'calendar-alt',        'keywords' => array( 'consultation', 'free', 'contact' ) ),
  array( 'name' => 'course-library',      'title' => 'Course Library',      'icon' => 'welcome-learn-more',  'keywords' => array( 'course', 'library', 'learn' ) ),
  array( 'name' => 'success-stories',     'title' => 'Success Stories',     'icon' => 'star-filled',         'keywords' => array( 'success', 'stories', 'testimonial' ) ),
  array( 'name' => 'enchanting-links',    'title' => 'Enchanting Links',    'icon' => 'admin-links',         'keywords' => array( 'links', 'navigation', 'menu' ) ),
  array( 'name' => 'destinations-map',    'title' => 'Destinations Map',    'icon' => 'location-alt',        'keywords' => array( 'map', 'destinations', 'travel' ) ),
  array( 'name' => 'newsletter',          'title' => 'Newsletter',          'icon' => 'email-alt',           'keywords' => array( 'newsletter', 'subscribe', 'email' ) ),
  array( 'name' => 'lets-connect',        'title' => 'Lets Connect',        'icon' => 'share',               'keywords' => array( 'social', 'connect', 'links' ) ),
  array( 'name' => 'banner-cta-widget',   'title' => 'Banner CTA Widget',   'icon' => 'megaphone',           'keywords' => array( 'banner', 'cta', 'widget' ) ),
  array( 'name' => 'sidebar-block',       'title' => 'Custom Sidebar',      'icon' => 'admin-comments',      'keywords' => array( 'sidebar', 'widget', 'custom' ) ),

  // ── Blocks with render_template (not render_callback) ───────────────────
  // These use acf_register_block_type with render_template, so they are NOT
  // registered via register_custom_block(). Their registration is below.
  // favorite-cards-small, enchanted-link, guides, free-quiz, words-animation
);

// Register all standard blocks via the shared helper
add_action( 'acf/init', function () use ( $custom_blocks ) {
  foreach ( $custom_blocks as $config ) {
    register_custom_block( $config );
  }
} );

// ── render_template blocks (require their own acf_register_block_type call) ─
// These blocks use render_template instead of render_callback and have extra
// supports — they cannot use the generic helper.
require 'favorite-cards-small/favorite-cards-small.php';
require 'enchanted-link/enchanted-link.php';
require 'guides/guides.php';
require 'free-quiz/free-quiz.php';
require 'words-animation/words-animation.php';
require 'credit-card-hero/credit-card-hero.php';

// ── Extra logic files (fields, filters, enqueues) ───────────────────────────
// These blocks are already registered above via $custom_blocks.
// These files only contain ACF field groups, filter hooks, or enqueue calls.
require 'credit-cards/credit-cards.php';
require 'favorite-cards/favorite-cards.php';
require 'unique-card/unique-card.php';
require 'newsletter/newsletter.php';
require 'lets-connect/lets-connect.php';
require 'sidebar-block/sidebar-block.php';

// ── Shared styles ────────────────────────────────────────────────────────────
function custom_blocks_scripts() {
  wp_enqueue_style(
    'custom-blocks-style',
    esc_url( get_stylesheet_directory_uri() . '/custom-blocks/styles.css' ),
    array(),
    ofp_VERSION
  );
}
add_action( 'wp_enqueue_scripts', 'custom_blocks_scripts' );