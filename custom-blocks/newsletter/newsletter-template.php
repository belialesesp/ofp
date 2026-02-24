<?php
/**
 * Newsletter Block Template
 * Location: /custom-blocks/newsletter/newsletter-template.php
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

// Get widget mode setting
$is_widget = get_field('is_widget');

// Initialize variables
$background_color = '';
$background_image = '';
$background_video = '';
$title = '';
$description = '';
$title_color = '';
$description_color = '';
$flodesk_form_id = '';

if ($is_widget) {
    // Widget mode - get settings from options page
    $background_color = get_field('widget_background_color', 'option') ?: '#222222';
    $background_image = get_field('widget_background_image', 'option');
    $background_video = get_field('widget_background_video', 'option');
    $title = get_field('widget_title', 'option') ?: 'Stay Connected';
    $description = get_field('widget_description', 'option');
    $title_color = get_field('widget_title_color', 'option') ?: '#FFFFFF';
    $description_color = get_field('widget_description_color', 'option') ?: '#FFFFFF';
    $flodesk_form_id = get_field('widget_flodesk_form_id', 'option');
} else {
    // Block mode - get settings from block
    $background_color = get_field('background_color') ?: '#222222';
    $background_image = get_field('background_image');
    $background_video = get_field('background_video');
    $title = get_field('title') ?: 'Stay Connected';
    $description = get_field('description');
    $title_color = get_field('title_color') ?: '#FFFFFF';
    $description_color = get_field('description_color') ?: '#FFFFFF';
    $flodesk_form_id = get_field('flodesk_form_id');
}

// Use default form ID if none is set
$form_id_to_use = $flodesk_form_id ?: '685421b840679baaea6652ec';

// Process video URL if it exists
$video_embed_url = '';
if ($background_video) {
    // Remove any query parameters for processing
    $clean_url = strtok($background_video, '?');
    
    // Check if it's a Vimeo URL
    if (strpos($background_video, 'vimeo.com') !== false) {
        // Extract Vimeo ID
        preg_match('/vimeo\.com\/(?:video\/|manage\/videos\/)?(\d+)/', $clean_url, $matches);
        if (isset($matches[1])) {
            $video_embed_url = 'https://player.vimeo.com/video/' . $matches[1] . '?background=1&autoplay=1&loop=1&muted=1&controls=0&title=0&byline=0&portrait=0&dnt=1';
        }
    }
    // Check if it's a YouTube URL
    elseif (strpos($background_video, 'youtube.com') !== false || strpos($background_video, 'youtu.be') !== false) {
        // Extract YouTube ID
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $background_video, $matches);
        if (isset($matches[1])) {
            $video_embed_url = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&controls=0&showinfo=0&playlist=' . $matches[1];
        }
    }
    // Direct video file URL
    else {
        $video_embed_url = $background_video;
    }
}

// Generate unique block ID
$blockID = 'newsletter-' . uniqid();

// Container class
$container_class = 'newsletter';
if ($is_widget) {
    $container_class .= ' widget-mode';
}

// Load Flodesk SDK - ALWAYS load it if we have a form ID
if (!wp_script_is('flodesk-sdk', 'enqueued')) {
    wp_enqueue_script('flodesk-sdk', 'https://assets.flodesk.com/universal.js', array(), null, true);
}
?>

<style>
#<?= $blockID ?> {
    position: relative;
    overflow: hidden;
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    min-height: 500px;
}

#<?= $blockID ?>.newsletter {
    display: flex;
    align-items: center;
    min-height: 70vh;
    padding: 5rem 0;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    width: 100vw;
}

/* Video wrapper for overflow control */
#<?= $blockID ?> .newsletter__video-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 0;
}

/* Video positioning for complete coverage */
#<?= $blockID ?> .newsletter__video-iframe {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100vw;
    height: 56.25vw; /* 16:9 Aspect Ratio */
    min-height: 100vh;
    min-width: 177.78vh; /* 16:9 Aspect Ratio */
    transform: translate(-50%, -50%);
    z-index: 0;
    pointer-events: none;
    border: none;
}

#<?= $blockID ?> .newsletter__video-background {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100vw;
    height: 56.25vw;
    min-height: 100vh;
    min-width: 177.78vh;
    transform: translate(-50%, -50%);
    object-fit: cover;
    z-index: 0;
    pointer-events: none;
}

#<?= $blockID ?> .newsletter__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 1;
    pointer-events: none;
}

#<?= $blockID ?> .container {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
    width: 100%;
    padding: 0 2rem;
}

#<?= $blockID ?> .newsletter__title {
    font-size: 3.5rem;
    font-weight: 300;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    line-height: 1.2;
    margin-top: 0;
}

#<?= $blockID ?> .newsletter__description {
    font-size: 1.125rem;
    line-height: 1.6;
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

#<?= $blockID ?> .newsletter__description p {
    margin-bottom: 1rem;
}

#<?= $blockID ?> .newsletter__description p:last-child {
    margin-bottom: 0;
}

/* Remove custom form styling since we're using Flodesk's native styles */
/* You can add overrides here if needed to match your theme */

/* Optional: Override Flodesk form colors to match video background */
<?php if ($video_embed_url || $background_image): ?>
#<?= $blockID ?> .fd-form-group input {
    color: #fff !important;
    background-color: rgba(255, 255, 255, 0.1) !important;
    border-color: rgba(255, 255, 255, 0.3) !important;
}

#<?= $blockID ?> .fd-form-group input::placeholder {
    color: rgba(255, 255, 255, 0.7) !important;
}

#<?= $blockID ?> .fd-form-group input:focus {
    background-color: rgba(255, 255, 255, 0.2) !important;
    border-color: rgba(255, 255, 255, 0.6) !important;
}
<?php endif; ?>

/* Mobile responsive styles */
@media (max-width: 767px) {
    #<?= $blockID ?> {
        margin-left: 0;
        width: 100%;
        min-height: 100vh;
    }
    
    #<?= $blockID ?>.newsletter {
        min-height: 100vh;
        padding: 3rem 0;
    }
    
    #<?= $blockID ?> .container {
        padding: 0 1rem;
    }
    
    #<?= $blockID ?> .newsletter__video-wrapper {
        top: -10%;
        left: -10%;
        width: 120%;
        height: 120%;
    }
    
    #<?= $blockID ?> .newsletter__video-iframe,
    #<?= $blockID ?> .newsletter__video-background {
        width: 300vw;
        height: 168.75vw;
        min-width: 300vw;
        min-height: 100vh;
    }
    
    #<?= $blockID ?> .newsletter__title {
        font-size: 2rem;
        margin-bottom: 1rem;
    }
    
    #<?= $blockID ?> .newsletter__description {
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }
}

@media (max-width: 1024px) {
    #<?= $blockID ?> .newsletter__title {
        font-size: 3rem;
    }
}

@media (min-width: 1920px) {
    #<?= $blockID ?>.newsletter {
        min-height: 80vh;
    }
}
</style>

<div id="<?= $blockID ?>" class="<?= esc_attr($container_class) ?>" style="background-color: <?= $video_embed_url ? '#000000' : esc_attr($background_color) ?>; <?= (!$video_embed_url && $background_image) ? 'background-image: url(' . esc_url($background_image['url']) . '); background-size: cover; background-position: center;' : '' ?>">
    
    <?php if ($video_embed_url): ?>
        <div class="newsletter__video-wrapper">
            <?php if (strpos($video_embed_url, 'player.vimeo.com') !== false || strpos($video_embed_url, 'youtube.com/embed') !== false): ?>
                <!-- Iframe for Vimeo/YouTube -->
                <iframe 
                    class="newsletter__video-iframe"
                    src="<?= esc_url($video_embed_url) ?>"
                    frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture"
                    title="Background video">
                </iframe>
            <?php else: ?>
                <!-- Video element for direct video files -->
                <video 
                    class="newsletter__video-background" 
                    autoplay 
                    muted 
                    loop 
                    playsinline>
                    <source src="<?= esc_url($video_embed_url) ?>" type="video/mp4">
                </video>
            <?php endif; ?>
        </div>
        <div class="newsletter__overlay"></div>
    <?php endif; ?>
    
    <div class="container">
        <h2 class="newsletter__title" style="color: <?= esc_attr($title_color) ?>">
            <?= esc_html($title) ?>
        </h2>
        
        <?php if ($description): ?>
        <div class="newsletter__description" style="color: <?= esc_attr($description_color) ?>">
            <?= wp_kses_post($description) ?>
        </div>
        <?php endif; ?>
        
        <!-- Flodesk Form Container -->
        <div id="fd-form-<?= esc_attr($form_id_to_use) ?>"></div>
    </div>
</div>

<script>
// Initialize Flodesk form after DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Wait a bit for Flodesk SDK to load
    setTimeout(function() {
        if (typeof window.fd === 'function') {
            window.fd('form', {
                formId: '<?= esc_js($form_id_to_use) ?>',
                containerEl: '#fd-form-<?= esc_js($form_id_to_use) ?>'
            });
        }
    }, 100);
});
</script>