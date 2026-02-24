<?php
/**
 * Success Stories Block Template
 * Location: /custom-blocks/success-stories/success-stories-template.php
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Check if ACF is available
if (!function_exists('get_field')) {
    echo '<p>Advanced Custom Fields is required for this block.</p>';
    return;
}

// Get block settings
$is_widget = get_field('is_widget');
$title = get_field('title') ?: 'Success Stories';

// Initialize background settings variables
$background_type = '';
$rotation_deg = 0;
$background_color_start = '#f1f1f1';
$background_color_end = '#ffffff';
$background_color = '#f1f1f1';

// Get display settings based on mode
if ($is_widget) {
    // Widget mode - get background settings from options page
    $background_type = get_field('widget_background_type', 'option') ?: 'gradient';
    $rotation_deg = get_field('widget_rotation_deg', 'option') ?: 0;
    $background_color_start = get_field('widget_background_color_start', 'option') ?: '#f1f1f1';
    $background_color_end = get_field('widget_background_color_end', 'option') ?: '#ffffff';
    $background_color = get_field('widget_background_color', 'option') ?: '#f1f1f1';
} else {
    // Block mode - get background settings from block
    $background_type = get_field('background_type') ?: 'gradient';
    $rotation_deg = get_field('rotation_deg') ?: 0;
    $background_color_start = get_field('background_color_start') ?: '#f1f1f1';
    $background_color_end = get_field('background_color_end') ?: '#ffffff';
    $background_color = get_field('background_color') ?: '#f1f1f1';
}

// Rest of your existing code remains the same...
// Initialize stories array
$stories = array();

// Get stories based on widget mode
if ($is_widget) {
    // Widget mode - use global stories
    $all_stories = get_field('success_stories', 'option');
    
    if ($all_stories && is_array($all_stories)) {
        // Get display mode
        $display_mode = get_field('ssb_display_mode');
        
        switch ($display_mode) {
            case 'single':
                $selected_index = get_field('ssb_success_story');
                if ($selected_index !== '' && isset($all_stories[$selected_index])) {
                    $story = $all_stories[$selected_index];
                    $stories[] = array(
                        'image' => $story['ssi_image'] ?? null,
                        'storie' => $story['ssi_story'] ?? '',
                        'author' => $story['ssi_author'] ?? '',
                        'image_border_color__author_color' => $story['ssi_author_color'] ?? '#61a7af'
                    );
                }
                break;
                
            case 'multiple':
                $selected_indices = get_field('ssb_success_stories_multiple');
                if ($selected_indices && is_array($selected_indices)) {
                    foreach ($selected_indices as $index) {
                        if (isset($all_stories[$index])) {
                            $story = $all_stories[$index];
                            $stories[] = array(
                                'image' => $story['ssi_image'] ?? null,
                                'storie' => $story['ssi_story'] ?? '',
                                'author' => $story['ssi_author'] ?? '',
                                'image_border_color__author_color' => $story['ssi_author_color'] ?? '#61a7af'
                            );
                        }
                    }
                }
                break;
                
            case 'featured':
                foreach ($all_stories as $story) {
                    if (!empty($story['ssi_featured'])) {
                        $stories[] = array(
                            'image' => $story['ssi_image'] ?? null,
                            'storie' => $story['ssi_story'] ?? '',
                            'author' => $story['ssi_author'] ?? '',
                            'image_border_color__author_color' => $story['ssi_author_color'] ?? '#61a7af'
                        );
                    }
                }
                break;
                
            case 'recent':
                $count = get_field('ssb_story_count') ?: 5;
                // Sort by date if date field exists
                usort($all_stories, function($a, $b) {
                    $date_a = isset($a['ssi_date']) ? strtotime($a['ssi_date']) : 0;
                    $date_b = isset($b['ssi_date']) ? strtotime($b['ssi_date']) : 0;
                    return $date_b - $date_a;
                });
                
                $recent_stories = array_slice($all_stories, 0, $count);
                foreach ($recent_stories as $story) {
                    $stories[] = array(
                        'image' => $story['ssi_image'] ?? null,
                        'storie' => $story['ssi_story'] ?? '',
                        'author' => $story['ssi_author'] ?? '',
                        'image_border_color__author_color' => $story['ssi_author_color'] ?? '#61a7af'
                    );
                }
                break;
                
            case 'random':
                $count = get_field('ssb_story_count') ?: 3;
                shuffle($all_stories);
                $random_stories = array_slice($all_stories, 0, $count);
                
                foreach ($random_stories as $story) {
                    $stories[] = array(
                        'image' => $story['ssi_image'] ?? null,
                        'storie' => $story['ssi_story'] ?? '',
                        'author' => $story['ssi_author'] ?? '',
                        'image_border_color__author_color' => $story['ssi_author_color'] ?? '#61a7af'
                    );
                }
                break;
                
            case 'all':
            default:
                foreach ($all_stories as $story) {
                    $stories[] = array(
                        'image' => $story['ssi_image'] ?? null,
                        'storie' => $story['ssi_story'] ?? '',
                        'author' => $story['ssi_author'] ?? '',
                        'image_border_color__author_color' => $story['ssi_author_color'] ?? '#61a7af'
                    );
                }
                break;
        }
    }
} else {
    // Block mode - use stories from the Success Storie field group
    // This field appears to be a repeater or group field with story data
    $custom_stories = get_field('stories');
    if ($custom_stories && is_array($custom_stories)) {
        // If it's a repeater field with multiple stories
        $stories = $custom_stories;
    } else {
        // If it's a single story in a group field
        $single_story = array(
            'storie' => get_field('storie'),
            'image' => get_field('image'),
            'author' => get_field('author'),
            'image_border_color__author_color' => get_field('image_border_color__author_color') ?: '#61a7af'
        );
        
        // Only add if there's content
        if (!empty($single_story['storie']) || !empty($single_story['author'])) {
            $stories[] = $single_story;
        }
    }
}

// Generate unique block ID
$blockID = 'success-storie-' . uniqid();

// Container class
$container_class = $is_widget ? 'success-stories widget-mode' : 'success-stories';

// Build background style
$background_style = '';
if ($background_type == 'gradient') {
    $background_style = sprintf(
        'background: linear-gradient(%ddeg, %s 0%%, %s 100%%);',
        $rotation_deg,
        $background_color_start,
        $background_color_end
    );
} else {
    $background_style = sprintf('background: %s;', $background_color);
}
?>

<div id="<?php echo esc_attr($blockID); ?>-container" class="<?php echo esc_attr($container_class); ?>" style="<?php echo esc_attr($background_style); ?>">
    <div class="container">
        <?php if ($title): ?>
            <h2 class="success-stories__title">
                <?php echo esc_html($title); ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($stories)): ?>
            <div id="<?php echo esc_attr($blockID); ?>" class="splide success-stories__stories">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php foreach ($stories as $story): ?>
                            <li class="splide__slide storie">
                                <?php 
                                // Handle image display
                                if (!empty($story['image'])) {
                                    $image_url = '';
                                    if (is_array($story['image']) && isset($story['image']['url'])) {
                                        $image_url = $story['image']['url'];
                                    } elseif (is_numeric($story['image'])) {
                                        $image_array = wp_get_attachment_image_src($story['image'], 'medium');
                                        if ($image_array) {
                                            $image_url = $image_array[0];
                                        }
                                    }
                                    
                                    if ($image_url): ?>
                                        <div class="storie-image">
                                            <img 
                                                src="<?php echo esc_url($image_url); ?>" 
                                                alt="<?php echo esc_attr($story['author'] ?? ''); ?>"
                                                style="border-color: <?php echo esc_attr($story['image_border_color__author_color'] ?? '#61a7af'); ?>">
                                        </div>
                                    <?php endif;
                                }
                                ?>
                                
                                <?php if (!empty($story['storie'])): ?>
                                    <div class="storie-description">
                                        <?php echo wp_kses_post($story['storie']); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($story['author'])): ?>
                                    <div class="storie-author" style="color: <?php echo esc_attr($story['image_border_color__author_color'] ?? '#61a7af'); ?>">
                                        <?php echo esc_html($story['author']); ?>
                                    </div>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Splide !== 'undefined') {
                    var splideElement = document.getElementById('<?php echo esc_js($blockID); ?>');
                    if (splideElement) {
                        new Splide(splideElement, {
                            type: 'loop',
                            perPage: 2,
                            perMove: 1,
                            gap: '1rem',
                            pagination: false,
                            arrows: true,
                            breakpoints: {
                                991: {
                                    perPage: 1
                                }
                            }
                        }).mount();
                    }
                }
            });
            </script>
        <?php else: ?>
            <div class="no-stories-message">
                <p>
                    <?php if ($is_widget): ?>
                        No success stories available. Please add stories in Theme Options > Success Stories.
                    <?php else: ?>
                        No success stories available. Please add stories to this block.
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.success-stories {
    padding: 3rem 0;
}

.no-stories-message {
    text-align: center;
    padding: 3rem;
    background: rgba(0,0,0,0.05);
    border-radius: 8px;
    margin: 2rem 0;
}

.no-stories-message p {
    margin: 0;
    color: #666;
}

/* Make sure existing styles still work */
.storie {
    text-align: center;
}

.storie-image {
    margin-bottom: 1rem;
}

.storie-image img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid;
}

.storie-description {
    margin-bottom: 1rem;
    padding: 0 1rem;
}

.storie-author {
    font-weight: bold;
}
</style>