<?php

/**
 * our-family-passport functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package our-family-passport
 */

if (!defined('ofp_VERSION')) {
    // Replace the version number of the theme on each release.
    define('ofp_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function our_family_passport_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on our-family-passport, use a find and replace
     * to change 'our-family-passport' to the name of your theme in all the template files.
     */
    load_theme_textdomain('our-family-passport', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'main-menu' => esc_html__('Primary', 'our-family-passport'),
            'menu-look-around' => esc_html__('Look Around Menu', 'our-family-passport'),
            'menu-bottom-look-around' => esc_html__('Look Around Bottom Menu', 'our-family-passport'),
            'menu-footer' => esc_html__('Footer Menu', 'our-family-passport'),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'our_family_passport_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'our_family_passport_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function our_family_passport_content_width()
{
    $GLOBALS['content_width'] = apply_filters('our_family_passport_content_width', 640);
}
add_action('after_setup_theme', 'our_family_passport_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function our_family_passport_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'our-family-passport'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Widgets for single posts.', 'our-family-passport'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
    // Add new widget areas

    register_sidebar(
        array(
            'name' => esc_html__('Post Widgets', 'our-family-passport'),
            'id' => 'post-sidebar',
            'description' => esc_html__('Widgets for single posts.', 'our-family-passport'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
    register_sidebar(
        array(
            'name' => esc_html__('Page Widgets', 'our-family-passport'),
            'id' => 'page-sidebar',
            'description' => esc_html__('Widgets for pages.', 'our-family-passport'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name' => esc_html__('Footer Widget Area', 'our-family-passport'),
            'id' => 'footer-widgets',
            'description' => esc_html__('Widgets for the footer area.', 'our-family-passport'),
            'before_widget' => '<div id="%1$s" class="widget %2$s footer-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
	    register_sidebar(
        array(
            'name' => esc_html__('Footer Widget Area - Blog Posts', 'our-family-passport'),
            'id' => 'footer-widgets-blog',
            'description' => esc_html__('Widgets for the footer area on blog posts only.', 'our-family-passport'),
            'before_widget' => '<div id="%1$s" class="widget %2$s footer-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );

}
add_action('widgets_init', 'our_family_passport_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function our_family_passport_scripts()
{
    wp_enqueue_style(
        'our-family-passport-style',
        get_stylesheet_uri(),
        array(),
        filemtime( get_template_directory() . '/style.css' )
    );
    wp_enqueue_style(
        'our-family-passport-custom-styles',
        esc_url( get_stylesheet_directory_uri() . '/css/ofp-styles.css' ),
        array(),
        filemtime( get_template_directory() . '/css/ofp-styles.css' )
    );
    wp_enqueue_style( 'font-awesome-6', esc_url( get_stylesheet_directory_uri() . '/fontawesome/css/all.min.css' ), array(), '6.5.1' );
    wp_enqueue_style( 'splide-slider-styles', esc_url( get_stylesheet_directory_uri() . '/js/splide-slide/css/splide.min.css' ), array(), '6.5.1' );
    wp_style_add_data( 'our-family-passport-style', 'rtl', 'replace' );

    wp_enqueue_script(
        'our-family-passport-navigation',
        get_template_directory_uri() . '/js/navigation.js',
        array(),
        filemtime( get_template_directory() . '/js/navigation.js' ),
        true
    );
    wp_enqueue_script( 'splide-slider', get_template_directory_uri() . '/js/splide-slide/js/splide.min.js', array(), '4.1.2', true );
    wp_enqueue_script(
        'our-family-passport-functions',
        get_template_directory_uri() . '/js/ofp-functions.js',
        array(),
        filemtime( get_template_directory() . '/js/ofp-functions.js' ),
        true
    );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action('wp_enqueue_scripts', 'our_family_passport_scripts');

function our_family_passport_admin_scripts()
{
    wp_enqueue_script(
        'our-family-passport-admin-functions',
        get_template_directory_uri() . '/js/admin-functions.js',
        array(),
        filemtime( get_template_directory() . '/js/admin-functions.js' ),
        true
    );
}
add_action('admin_enqueue_scripts', 'our_family_passport_admin_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Load Recursively Taxonomy file.
 */
require get_template_directory() . '/inc/recursively-taxonomy.php';

/**
 * Load Options Pages
 */
require_once get_template_directory() . '/option-pages/index.php';

/**
 * Load Custom Blocks
 */
require get_template_directory() . '/inc/blocks/index.php';

/**
 * Enable WebP Images
 */
function add_webp_to_upload_mimes($upload_mimes)
{
    $upload_mimes['webp'] = 'image/webp';
    return $upload_mimes;
}
add_filter('upload_mimes', 'add_webp_to_upload_mimes', 10, 1);

/**
 * REGISTER DESTINATIONS TAXONOMIES
 */
function add_custom_taxonomies()
{
    // Add new "Destinations" taxonomy to Posts
    register_taxonomy('destination', 'post', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x('Destinations', 'taxonomy general name'),
            'singular_name' => _x('Location', 'taxonomy singular name'),
            'search_items' => __('Search Destinations'),
            'all_items' => __('All Destinations'),
            'parent_item' => __('Parent Location'),
            'parent_item_colon' => __('Parent Location:'),
            'edit_item' => __('Edit Location'),
            'update_item' => __('Update Location'),
            'add_new_item' => __('Add New Location'),
            'new_item_name' => __('New Location Name'),
            'menu_name' => __('Destinations'),
        ),
        'rewrite' => array(
            'slug' => 'destination',
            'with_front' => false,
            'hierarchical' => true,
        ),
    ));
}
add_action('init', 'add_custom_taxonomies', 0);

// ADD CAPTABILITY OF ADD IMAGES TO DESTINATIONS
add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_5caada1b5a0e2',
        'title' => 'Destinations [Taxonomy]',
        'fields' => array(
            array(
                'key' => 'field_5caada221dd3d',
                'label' => 'Icon',
                'name' => 'icon',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_5cf91b61a7977',
                'label' => 'Stamp',
                'name' => 'stamp',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'destination',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
});
function backup_timeline_data()
{
    // Get all posts/pages that might use your block
    $args = array(
        'post_type' => array('post', 'page'), // Add other post types if needed
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);
    $timeline_data = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();

            // Check if this post contains timeline data
            if (have_rows('items', $post_id)) {
                $timeline_data[$post_id] = array();

                // Get time_line_first data
                $timeline_data[$post_id]['time_line_first'] = get_field('time_line_first', $post_id);

                // Get all items
                $items = get_field('items', $post_id);
                if ($items) {
                    $timeline_data[$post_id]['items'] = $items;
                }

                // Get other fields
                $timeline_data[$post_id]['background_type'] = get_field('background_type', $post_id);
                $timeline_data[$post_id]['background_image'] = get_field('background_image', $post_id);
                $timeline_data[$post_id]['rotation_deg'] = get_field('rotation_deg', $post_id);
                $timeline_data[$post_id]['background_color_start'] = get_field('background_color_start', $post_id);
                $timeline_data[$post_id]['background_color_end'] = get_field('background_color_end', $post_id);
                $timeline_data[$post_id]['time_line_color'] = get_field('time_line_color', $post_id);
            }
        }
    }
    wp_reset_postdata();

    // Save data to an option for safe keeping
    update_option('timeline_backup_data', $timeline_data);

    // Output for verification
    echo '<pre>';
    print_r($timeline_data);
    echo '</pre>';
}

// Create a temporary admin page to run this function
function add_timeline_backup_page()
{
    add_management_page(
        'Timeline Backup',
        'Timeline Backup',
        'manage_options',
        'timeline-backup',
        'backup_timeline_page'
    );
}
add_action('admin_menu', 'add_timeline_backup_page');

function backup_timeline_page()
{
    echo '<div class="wrap">';
    echo '<h1>Timeline Data Backup</h1>';

    if (isset($_POST['backup_timeline'])) {
        backup_timeline_data();
        echo '<div class="notice notice-success"><p>Timeline data has been backed up to database option "timeline_backup_data".</p></div>';
    }

    echo '<form method="post">';
    echo '<input type="submit" name="backup_timeline" class="button button-primary" value="Backup Timeline Data">';
    echo '</form>';
    echo '</div>';
}
/**
 * Enqueue Sidebar Block CSS
 */
function enqueue_sidebar_block_styles()
{
    wp_enqueue_style(
        'sidebar-block-styles',
        get_template_directory_uri() . '/css/sidebar-block.css',
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'enqueue_sidebar_block_styles');
add_action('enqueue_block_editor_assets', 'enqueue_sidebar_block_styles');

function has_sidebar_block($post_id = null, $specific_block = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    // Get the content
    $post = get_post($post_id);
    if (!$post)
        return false;

    $content = $post->post_content;

    // If looking for a specific block
    if ($specific_block) {
        $patterns = array();
        switch ($specific_block) {
            case 'favorite-cards':
                $patterns = [
                    'my-favorite-cards',
                    'class="favorite-things"',
                    'wp:acf/favorite-cards',
                    'course-library'
                ];
                break;
            case 'success-stories':
                $patterns = [
                    'class="success-stories"',
                    'success-storie-',
                    'wp:acf/success-stories'
                ];
                break;
            case 'free-resources':
                $patterns = [
                    'class="free-resources"',
                    'wp:acf/free-resources'
                ];
                break;
            // Add more cases as needed
        }

        foreach ($patterns as $pattern) {
            if (strpos($content, $pattern) !== false) {
                return true;
            }
        }
        return false;
    }

    // Standard check for any sidebar block
    $block_patterns = [
        'wp:acf/sidebar-block',
        'wp:core/sidebar',
        'sidebar-block-wrapper',
        'class="unique-card"',
        'class="free-resources"',
        'class="extra-benefits"',
        'class="success-stories"',
        'class="my-favorite-cards"',
        'class="favorite-things"',
        'course-library'
    ];

    foreach ($block_patterns as $pattern) {
        if (strpos($content, $pattern) !== false) {
            return true;
        }
    }

    return false;
}

function early_sidebar_block_check()
{
    if (is_singular()) {
        $has_block = has_sidebar_block(get_the_ID());

        if ($has_block) {
            add_filter('body_class', function ($classes) {
                if (is_page()) {
                    $classes[] = 'has-page-sidebar-block';
                } else {
                    $classes[] = 'has-post-sidebar-block';
                }
                $classes[] = 'has-sidebar-block';

                // Only add this class if we want to hide ALL widgets
                // $classes[] = 'no-widget-sidebar';
                return $classes;
            });

        }
    }
}

/**
 * Add sidebar-specific body classes
 */
function add_sidebar_body_classes($classes)
{
    // Check if we're on a singular post/page
    if (is_singular()) {
        $post_id = get_the_ID();

        // For pages, NEVER add sidebar classes, only add pre-footer class
        if (is_page()) {
            $classes[] = 'has-pre-footer-sidebar';
            return $classes;
        }

        // For posts, continue with normal sidebar logic
        if (has_sidebar_block($post_id)) {
            return $classes; // Classes already added in has_sidebar_block function
        }

        // Check for widget sidebars on posts only
        if (is_singular('post') && is_active_sidebar('post-sidebar')) {
            $classes[] = 'has-post-sidebar';
            $classes[] = 'has-sidebar';
        } elseif (is_active_sidebar('sidebar-1') && !is_page()) {
            $classes[] = 'has-sidebar';
        }
    }

    return $classes;
}
add_filter('body_class', 'add_sidebar_body_classes');
/**
 * Move page sidebar to pre-footer area
 */
function reposition_page_sidebar()
{
    // Only apply to pages
    if (!is_page()) {
        return;
    }

    // Remove the standard sidebar inclusion for all pages
    add_action('get_sidebar', function ($name) {
        if (is_page()) {
            return false;
        }
    }, 1);

    // Add body class
    add_filter('body_class', function ($classes) {
        if (is_page()) {
            $classes[] = 'has-pre-footer-sidebar';

            // Remove conflicting classes
            $key = array_search('has-page-sidebar', $classes);
            if ($key !== false) {
                unset($classes[$key]);
            }

            $key = array_search('has-sidebar', $classes);
            if ($key !== false) {
                unset($classes[$key]);
            }
        }
        return $classes;
    });

    // Display the sidebar before the footer
    add_action('get_footer', function ($name) {
        if (is_page() && is_active_sidebar('page-sidebar')) {
            ?>
            <div class="pre-footer-page-sidebar-container">
                <div class="container">
                    <div class="pre-footer-page-sidebar-wrapper">
                        <?php dynamic_sidebar('page-sidebar'); ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }, 5);
}

// Initialize the repositioning
add_action('wp', 'reposition_page_sidebar');
/**
 * Check for specific blocks in page content
 */
function detect_blocks_in_content($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $post = get_post($post_id);
    if (!$post)
        return array();

    $content = $post->post_content;
    $found_blocks = array();

    // Check for favorite cards block
    if (
        strpos($content, 'class="my-favorite-cards') !== false ||
        strpos($content, 'id="course-library-') !== false
    ) {
        $found_blocks[] = 'favorite-cards';
    }

    // Check for success stories block
    if (
        strpos($content, 'id="success-storie-') !== false ||
        strpos($content, 'class="success-stories') !== false
    ) {
        $found_blocks[] = 'success-stories';
    }

    // Check for free resources block
    if (strpos($content, 'class="free-resources') !== false) {
        $found_blocks[] = 'free-resources';
    }

    // Check for lets connect block
    if (strpos($content, 'class="lets-connect') !== false) {
        $found_blocks[] = 'lets-connect';
    }

    return $found_blocks;
}




function add_specific_widget_detection_classes()
{
    if (is_singular()) {
        $post_id = get_the_ID();

        // Check for specific block types
        $has_favorite_cards = has_sidebar_block($post_id, 'favorite-cards');
        $has_success_stories = has_sidebar_block($post_id, 'success-stories');
        $has_free_resources = has_sidebar_block($post_id, 'free-resources');

        // Add body classes for specific widgets that should be hidden
        if ($has_favorite_cards || $has_success_stories || $has_free_resources) {
            add_filter('body_class', function ($classes) use ($has_favorite_cards, $has_success_stories, $has_free_resources) {
                if ($has_favorite_cards) {
                    $classes[] = 'has-favorite-cards-block';
                }
                if ($has_success_stories) {
                    $classes[] = 'has-success-stories-block';
                }
                if ($has_free_resources) {
                    $classes[] = 'has-free-resources-block';
                }
                return $classes;
            });
        }
    }
}
add_action('wp', 'add_specific_widget_detection_classes', 5);

/**
 * Check for specific block types in content
 * 
 * @param int $post_id Post ID to check
 * @param string $block_type Specific block type to check for ('favorite-cards', 'success-stories', etc.)
 * @return boolean True if the specified block is found
 */
function has_specific_block($post_id = null, $block_type = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    // Get the content
    $post = get_post($post_id);
    if (!$post)
        return false;

    $content = $post->post_content;

    // Define patterns for each block type
    $block_patterns = array(
        'favorite-cards' => array(
            'class="my-favorite-cards',
            'class="favorite-things"',
            'id="course-library-',
            'wp:acf/favorite-cards'
        ),
        'success-stories' => array(
            'class="success-stories',
            'id="success-storie-',
            'wp:acf/success-stories'
        ),
        'free-resources' => array(
            'class="free-resources',
            'wp:acf/free-resources'
        ),
        'lets-connect' => array(
            'class="lets-connect',
            'wp:acf/lets-connect'
        ),
        'unique-card' => array(
            'class="unique-card',
            'wp:acf/unique-card'
        ),
        'extra-benefits' => array(
            'class="extra-benefits',
            'wp:acf/extra-benefits'
        )
    );

    // If checking for a specific block type
    if ($block_type && isset($block_patterns[$block_type])) {
        foreach ($block_patterns[$block_type] as $pattern) {
            if (strpos($content, $pattern) !== false) {
                return true;
            }
        }
        return false;
    }

    // Check for any block type
    foreach ($block_patterns as $type => $patterns) {
        foreach ($patterns as $pattern) {
            if (strpos($content, $pattern) !== false) {
                return true;
            }
        }
    }

    return false;
}

/**
 * Add specific body classes for each block type
 */
function add_specific_block_classes()
{
    if (!is_page()) {
        return;
    }

    $post_id = get_the_ID();

    // Check for each specific block type
    $has_favorite_cards = has_specific_block($post_id, 'favorite-cards');
    $has_success_stories = has_specific_block($post_id, 'success-stories');
    $has_free_resources = has_specific_block($post_id, 'free-resources');
    $has_lets_connect = has_specific_block($post_id, 'lets-connect');
    $has_unique_card = has_specific_block($post_id, 'unique-card');
    $has_extra_benefits = has_specific_block($post_id, 'extra-benefits');

    // Add body classes for each detected block
    if (
        $has_favorite_cards || $has_success_stories || $has_free_resources ||
        $has_lets_connect || $has_unique_card || $has_extra_benefits
    ) {

        add_filter('body_class', function ($classes) use ($has_favorite_cards, $has_success_stories, $has_free_resources, $has_lets_connect, $has_unique_card, $has_extra_benefits) {
            if ($has_favorite_cards) {
                $classes[] = 'has-favorite-cards-block';
            }
            if ($has_success_stories) {
                $classes[] = 'has-success-stories-block';
            }
            if ($has_free_resources) {
                $classes[] = 'has-free-resources-block';
            }
            if ($has_lets_connect) {
                $classes[] = 'has-lets-connect-block';
            }
            if ($has_unique_card) {
                $classes[] = 'has-unique-card-block';
            }
            if ($has_extra_benefits) {
                $classes[] = 'has-extra-benefits-block';
            }

            // Legacy class
            $classes[] = 'has-sidebar-block';
            $classes[] = 'has-page-sidebar-block';

            // Only add no-widget-sidebar if ALL blocks are present
            if (
                $has_favorite_cards && $has_success_stories &&
                $has_free_resources && $has_lets_connect
            ) {
                $classes[] = 'no-widget-sidebar';
            }

            return $classes;
        });

        // Add inline styles for immediate effect
        add_action('wp_head', function () use ($has_favorite_cards, $has_success_stories, $has_free_resources, $has_lets_connect) {
            echo '<style>
                /* Hide specific widgets when corresponding blocks exist */
                ' . ($has_favorite_cards ? '
                .widget .my-favorite-cards,
                .widget_block:has(.my-favorite-cards),
                .widget [id^="course-library-"] {
                    display: none !important;
                }' : '') . '
                
                ' . ($has_success_stories ? '
                .widget .success-stories:not(.site-main .success-stories),
                .widget_block:has(.success-stories) {
                    display: none !important;
                }' : '') . '
                
                ' . ($has_free_resources ? '
                .widget .free-resources:not(.site-main .free-resources),
                .widget_block:has(.free-resources) {
                    display: none !important;
                }' : '') . '
                
                ' . ($has_lets_connect ? '
                .widget .lets-connect:not(.site-main .lets-connect),
                .widget_block:has(.lets-connect) {
                    display: none !important;
                }' : '') . '
            </style>';
        });
    }
}
add_action('wp', 'add_specific_block_classes', 5);

/**
 * Should this widget be displayed based on blocks in content
 */
function should_display_widget($widget_id)
{
    // Only apply this filter on pages
    if (!is_page()) {
        return true;
    }

    $post_id = get_the_ID();

    // Widget ID to block type mapping
    $widget_to_block_map = array(
        'favorite_cards_widget' => 'favorite-cards',
        'success_stories_widget' => 'success-stories',
        'free_resources_widget' => 'free-resources',
        'lets_connect_widget' => 'lets-connect'
    );

    // Check if this widget has a corresponding block type
    foreach ($widget_to_block_map as $widget_base_id => $block_type) {
        if (strpos($widget_id, $widget_base_id) !== false && has_specific_block($post_id, $block_type)) {
            // This widget has a corresponding block in the content, so don't display it
            return false;
        }
    }

    // No matching block found, display the widget
    return true;
}

/**
 * Filter to control widget display based on content blocks
 */
function filter_page_widgets($instance, $widget, $args)
{
    // Don't apply in admin
    if (is_admin()) {
        return $instance;
    }

    // Only apply this filter on pages
    if (!is_page()) {
        return $instance;
    }

    // Check if this widget should be displayed
    if (!should_display_widget($widget->id)) {
        return false; // Return false to hide the widget
    }

    return $instance;
}
add_filter('widget_display_callback', 'filter_page_widgets', 10, 3);


/**
 * Clean up sidebar blocks from post content
 */
function remove_sidebar_blocks_from_post_content() {
    // Only apply to single posts
    if (!is_single() || is_page()) {
        return;
    }
    
    // Get the current post
    global $post;
    
    // Check if post exists
    if (!$post) {
        return;
    }
    
    // Check if post content contains sidebar block
    if (strpos($post->post_content, 'sidebar-block-wrapper') !== false) {
        // Remove sidebar block from content
        $pattern = '/<div class="sidebar-block-wrapper.*?<\/div>\s*<\/div>/s';
        $clean_content = preg_replace($pattern, '', $post->post_content);
        
        // Update post content in the database to remove the sidebar block
        if ($clean_content !== $post->post_content) {
            // Remove the filter to prevent infinite loop
            remove_filter('the_content', 'apply_content_filter_for_sidebars');
            
            // Update the post
            wp_update_post(array(
                'ID' => $post->ID,
                'post_content' => $clean_content
            ));
            
            // Add the filter back
            add_filter('the_content', 'apply_content_filter_for_sidebars', 1);
            
            // Refresh the post object
            $post = get_post($post->ID);
        }
    }
}

/**
 * Enqueue script to fix sidebar position on single posts
 */
function enqueue_sidebar_fix_script() {
    // Only apply to single posts
    if (!is_single() || is_page()) {
        return;
    }
    
    // Enqueue jQuery if not already loaded
    wp_enqueue_script('jquery');
    
    // Add inline script to move sidebar
    wp_add_inline_script('jquery', '
        jQuery(document).ready(function($) {
            // Find sidebar inside entry content
            var $sidebarInContent = $(".entry-content .sidebar-block-wrapper");
            
            // Check if sidebar exists inside content
            if ($sidebarInContent.length) {
                // Get the article element
                var $article = $(".entry-content").closest("article");
                
                // Move sidebar after entry-content
                $sidebarInContent.detach().insertAfter($article.find(".entry-content"));
                
                // Add class to body
                $("body").addClass("sidebar-fixed");
            }
        });
    ');
}
add_action('wp_enqueue_scripts', 'enqueue_sidebar_fix_script');


// Register Custom Post Type for Credit Cards
function register_credit_cards_cpt() {
    $labels = array(
        'name'                  => 'Credit Cards',
        'singular_name'         => 'Credit Card',
        'menu_name'             => 'Credit Cards',
        'add_new'               => 'Add New Card',
        'add_new_item'          => 'Add New Credit Card',
        'edit_item'             => 'Edit Credit Card',
        'new_item'              => 'New Credit Card',
        'view_item'             => 'View Credit Card',
        'view_items'            => 'View Credit Cards',
        'search_items'          => 'Search Credit Cards',
        'not_found'             => 'No credit cards found',
        'not_found_in_trash'    => 'No credit cards found in Trash',
        'all_items'             => 'All Credit Cards',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'credit-cards'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-money',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true,
    );

    register_post_type('credit_cards', $args);
}
add_action('init', 'register_credit_cards_cpt');

// Register ACF blocks for Credit Cards
function register_credit_card_blocks() {
    if( function_exists('acf_register_block_type') ) {
        
        // Credit Card Hero Block
        acf_register_block_type(array(
            'name'              => 'credit-card-hero',
            'title'             => 'Credit Card Hero',
            'description'       => 'Displays the main hero section with card image and information',
            'render_template'   => 'custom-blocks/credit-card-hero/credit-card-hero-template.php',
            'category'          => 'formatting',
            'icon'              => 'money-alt',
            'keywords'          => array('credit', 'card', 'hero'),
            'mode'              => 'preview',
        ));
    }
}
add_action('acf/init', 'register_credit_card_blocks');

// Populate ACF field with CPT Credit Cards
function populate_credit_cards_choices($field) {
    $field['choices'] = array();
    
    $posts = get_posts(array(
        'post_type' => 'credit_cards',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC'
    ));
    
    $field['choices'][''] = 'Select a card...';
    
    if ($posts) {
        foreach ($posts as $post) {
            $field['choices'][$post->ID] = $post->post_title;
        }
    }
    
    return $field;
}

add_filter('acf/load_field/name=fc_card_option', 'populate_credit_cards_choices');

// Blog Post Type
register_sidebar(
    array(
        'name' => esc_html__('Footer Widget Area - Blog Posts', 'our-family-passport'),
        'id' => 'footer-widgets-blog',
        'description' => esc_html__('Widgets for the footer area on blog posts only.', 'our-family-passport'),
        'before_widget' => '<div id="%1$s" class="widget %2$s footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    )
);

// AJAX "See more"
add_action( 'wp_ajax_load_more_posts', 'load_more_posts' );
add_action( 'wp_ajax_nopriv_load_more_posts', 'load_more_posts' );

function load_more_posts() {
    $paged = $_POST['page'] + 1;
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 6,
        'paged'          => $paged
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            $post_categories = get_the_category();
            $cat_classes = '';
            foreach ( $post_categories as $cat ) {
                $cat_classes .= $cat->slug . ' ';
            }
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( esc_attr( trim( $cat_classes ) ) ); ?>>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-meta">
                    <span>Published on <?php echo get_the_date(); ?> by <?php the_author(); ?></span>
                </div>
                <div class="post-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
            </div>
            <?php
        endwhile;
    endif;
    wp_die();
}

add_action('wp_ajax_get_filtered_posts', 'get_filtered_posts');
add_action('wp_ajax_nopriv_get_filtered_posts', 'get_filtered_posts');

function get_filtered_posts() {
    $category = sanitize_text_field($_POST['category']);
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 12;
    
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $posts_per_page,
        'paged'          => $page,
        'post_status'    => 'publish'
    );
    
    if ($category !== 'all') {
        $args['category_name'] = $category;
    }
    
    $query = new WP_Query($args);
    $posts_html = '';
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_categories = get_the_category();
            $cat_classes = array();
            
            foreach ($post_categories as $cat) {
                $cat_classes[] = esc_attr($cat->slug);
            }
            $cat_classes_string = implode(' ', $cat_classes);
            
            ob_start();
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class($cat_classes_string); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium_large'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <h2 class="post-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
                
                <a href="<?php the_permalink(); ?>" class="read-post-link">
                    READ POST <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <?php
            $posts_html .= ob_get_clean();
        }
        wp_reset_postdata();
    }
    
    $response_data = array(
        'posts' => $posts_html,
        'has_more' => $query->max_num_pages > $page,
        'max_pages' => $query->max_num_pages,
        'post_count' => $query->found_posts,
        'current_page' => $page
    );
    
    wp_send_json_success($response_data);
}


// Enqueue CSS
function enqueue_custom_blocks_css() {
    
    if (has_block('acf/enchanted-link')) {
        wp_enqueue_style('enchanted-link-block-css', 
            get_template_directory_uri() . '/custom-blocks/enchanted-link/enchanted-link.css'
        );
    }
	if (has_block('acf/guides')) {
        wp_enqueue_style('guides-block-css', 
            get_template_directory_uri() . '/custom-blocks/guides/guides.css'
        );
    }
	if (has_block('acf/favorite-cards-small')) {
        wp_enqueue_style('favorite-cards-small-css', 
            get_template_directory_uri() . '/custom-blocks/favorite-cards-small/favorite-cards-small.css'
        );
    }
	if (has_block('acf/behind-the-screen')) {
        wp_enqueue_style('behind-the-screen-css', 
            get_template_directory_uri() . '/custom-blocks/behind-the-screen/behind-the-screen.css'
        );
    }
	if (has_block('acf/free-quiz')) {
        wp_enqueue_style('free-quiz-css', 
            get_template_directory_uri() . '/custom-blocks/free-quiz/free-quiz.css'
        );
    }    
}
add_action('wp_enqueue_scripts', 'enqueue_custom_blocks_css');


// Prevent WordPress from converting && to HTML entities in ACF blocks
add_filter('acf/settings/remove_wp_meta_box', '__return_true');
remove_filter('acf_the_content', 'wptexturize');
remove_filter('the_content', 'wptexturize');


//Restrict search
function restrict_search_to_posts($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search() && !empty($_GET['s'])) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts', 'restrict_search_to_posts');
function ofp_minimal_popup_control() {
    ?>
    <style>
    .pop-up { 
        opacity: 0 !important;
        visibility: hidden !important;
        transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    }
    
    .pop-up.show-popup {
        opacity: 1 !important;
        visibility: visible !important;
    }
    </style>
    
    <script>
    setTimeout(function() {
        if (!sessionStorage.getItem('popup_shown')) {
            var popup = document.querySelector('.pop-up');
            if (popup) {
                popup.classList.add('show-popup');
                sessionStorage.setItem('popup_shown', '1');
            }
        }
    }, 3000);
    
    document.addEventListener('click', function(e) {
        var popup = document.querySelector('.pop-up.show-popup');
        if (!popup) return;
        
        // Close if clicked on close/dismiss buttons
        if (e.target.closest('.close-btn') || e.target.closest('.dimiss')) {
            popup.classList.remove('show-popup');
            return;
        }
        
        // Close if clicked outside popup content
        var popupBox = popup.querySelector('.popup-box');
        if (popupBox && !popupBox.contains(e.target) && popup.contains(e.target)) {
            popup.classList.remove('show-popup');
        }
    });
    </script>
    <?php
}
add_action('wp_footer', 'ofp_minimal_popup_control');
function enqueue_blog_filter_data() {
    if (is_page_template('page-blog.php') || is_page('blog-page')) {
        $categories = get_categories(array(
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC'
        ));
        
        $categories_data = array();
        foreach ($categories as $category) {
            $categories_data[$category->term_id] = array(
                'id' => $category->term_id,
                'name' => $category->name,
                'slug' => $category->slug,
                'parent' => $category->parent,
                'count' => $category->count
            );
        }
        
        wp_localize_script('your-script-handle', 'categoriesData', $categories_data);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_blog_filter_data');

// Debug ACF save errors
add_filter('acf/validate_save_post', function($errors) {
    error_log('ACF Validation Errors: ' . print_r($errors, true));
    return $errors;
}, 999);
