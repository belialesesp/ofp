<?php
/**
 * Free Quiz Block Template
 */
// Get ACF fields
$background_video_url = get_field('background_video_url');
$background_image = get_field('background_image'); // Fallback image
$quiz_title_line1 = get_field('small_text') ?: 'free';
$quiz_title_line2 = get_field('title') ?: 'QUIZ';
$quiz_description = get_field('description') ?: 'Find the perfect travel card for you in just 90 seconds with our free quiz!';
$quiz_button_text = get_field('button_text') ?: 'TAKE THE QUIZ';
$quiz_button_link = get_field('button_link') ?: 'https://ofpbestcardquiz.replit.app/';

// Process video URL
$video_embed_url = '';
if ($background_video_url) {
    // Remove any query parameters for processing
    $clean_url = strtok($background_video_url, '?');
    
    // Check if it's a Vimeo URL
    if (strpos($background_video_url, 'vimeo.com') !== false) {
        // Extract Vimeo ID
        preg_match('/vimeo\.com\/(?:video\/|manage\/videos\/)?(\d+)/', $clean_url, $matches);
        if (isset($matches[1])) {
            $video_embed_url = 'https://player.vimeo.com/video/' . $matches[1] . '?background=1&autoplay=1&loop=1&muted=1&controls=0&title=0&byline=0&portrait=0&dnt=1';
        }
    }
    // Check if it's a YouTube URL
    elseif (strpos($background_video_url, 'youtube.com') !== false || strpos($background_video_url, 'youtu.be') !== false) {
        // Extract YouTube ID
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $background_video_url, $matches);
        if (isset($matches[1])) {
            $video_embed_url = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&controls=0&showinfo=0&playlist=' . $matches[1];
        }
    }
    // Direct video file URL (mp4, webm, etc.)
    else {
        $video_embed_url = $background_video_url;
    }
}

$fallback_image_url = $background_image ? esc_url($background_image['url']) : '';

// Generate unique ID for this block
$block_id = 'free-quiz-' . uniqid();
?>

<section id="<?php echo $block_id; ?>" 
class="free-quiz-section" 
style="background-image: url('<?php echo $fallback_image_url; ?>');"
data-no-lazy="1">
    <?php if ($video_embed_url): ?>
    <div class="free-quiz-video-wrapper">
        <?php if (strpos($video_embed_url, 'player.vimeo.com') !== false || strpos($video_embed_url, 'youtube.com/embed') !== false): ?>
            <!-- Iframe for Vimeo/YouTube -->
            <iframe 
                class="free-quiz-video"
                src="<?php echo esc_url($video_embed_url); ?>"
                width="1440"
                height="900"
                frameborder="0"
                allow="autoplay; fullscreen; picture-in-picture"
                title="Background video"
                allowfullscreen
                loading="eager">
            </iframe>
        <?php else: ?>
            <!-- Video element for direct video files -->
            <video 
                class="free-quiz-video"
                autoplay 
                muted 
                loop 
                playsinline>
                <source src="<?php echo esc_url($video_embed_url); ?>" type="video/mp4">
            </video>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    
    <div class="free-quiz-overlay">
        <div class="free-quiz-container">
            <div class="free-quiz-card">
                <div class="free-quiz-content">
                    <h2 class="free-quiz-title">
                        <span class="title-line1"><?php echo esc_html($quiz_title_line1); ?></span>
                        <span class="title-line2"><?php echo esc_html($quiz_title_line2); ?></span>
                    </h2>
                    
                    <p class="free-quiz-description">
                        <?php echo esc_html($quiz_description); ?>
                    </p>
                    
                    <a href="<?php echo esc_url($quiz_button_link); ?>" class="free-quiz-button">
                        <?php echo esc_html($quiz_button_text); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
#<?php echo $block_id; ?> .free-quiz-video-wrapper iframe {
    width: 100vw !important;
    height: 56.25vw !important;
    min-height: 100vh !important;
    min-width: 177.78vh !important;
    max-width: none !important;
}
    </style>
