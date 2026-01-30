<?php
// Get field values
$background_image = get_field('background_image');
$background_mobile = get_field('background_mobile');
$background_video = get_field('background_video');
$top_icon = get_field('top_icon');
$title = get_field('title');
$top_sub_title = get_field('top_sub_title');
$subTitle = get_field('sub-title');
$description = get_field('description');
$min_height = get_field('min_height') ?: '600px';
$background_position = get_field('background_position') ?: 'center';
$content_position = get_field('content_position') ?: 'center';
$social_media = get_field('social_media');
$title_color = get_field('title_color') ?: '#ffffff';
$subTitle_color = get_field('sub-title_color') ?: '#ffffff';
$description_color = get_field('description_color') ?: '#ffffff';

// Determine if we should use video or image
$use_video = !empty($background_video);
$use_image = (!empty($background_image) || !empty($background_mobile)) && !$use_video;

// Process video URL if video is provided
$video_embed_url = '';
$is_vimeo = false;
$is_youtube = false;
$vimeo_id = '';

if ($use_video && $background_video) {
    // Remove any query parameters for processing
    $clean_url = strtok($background_video, '?');
    
    // Check if it's a Vimeo URL
    if (strpos($background_video, 'vimeo.com') !== false) {
        // Extract Vimeo ID
        preg_match('/vimeo\.com\/(?:video\/|manage\/videos\/)?(\d+)/', $clean_url, $matches);
        if (isset($matches[1])) {
            $vimeo_id = $matches[1];
            $video_embed_url = 'https://player.vimeo.com/video/' . $vimeo_id . '?background=1&autoplay=1&loop=1&muted=1&controls=0&title=0&byline=0&portrait=0&dnt=1&autopause=0';
            $is_vimeo = true;
        }
    }
    // Check if it's a YouTube URL
    elseif (strpos($background_video, 'youtube.com') !== false || strpos($background_video, 'youtu.be') !== false) {
        // Extract YouTube ID
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $background_video, $matches);
        if (isset($matches[1])) {
            $video_embed_url = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&controls=0&showinfo=0&rel=0&modestbranding=1&playlist=' . $matches[1];
            $is_youtube = true;
        }
    }
    // Direct video file URL
    else {
        $video_embed_url = $background_video;
    }
}

// Generate unique block ID
$blockID = 'hero-image-' . uniqid();

// Prepare background styles for desktop and mobile
$background_style_desktop = '';
$background_style_mobile = '';
if ($use_image) {
    if ($background_image) {
        $background_style_desktop = "background-image: url('" . esc_url($background_image['url']) . "');";
    }
    if ($background_mobile) {
        $background_style_mobile = "background-image: url('" . esc_url($background_mobile['url']) . "');";
    } elseif ($background_image) {
        // Fallback to desktop image if no mobile image is set
        $background_style_mobile = "background-image: url('" . esc_url($background_image['url']) . "');";
    }
}

// Determine fallback image URL for video
$fallback_image_url = '';
if ($background_mobile) {
    $fallback_image_url = $background_mobile['url'];
} elseif ($background_image) {
    $fallback_image_url = $background_image['url'];
}
?>

<style>
.hero-image#<?= $blockID ?> {
    position: relative;
    width: 100%;
    min-height: <?= $min_height ?>;
    overflow: hidden;
    background-color: #000;
}

/* Desktop-only background image div */
.hero-image#<?= $blockID ?> .desktop-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-attachment: fixed;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: <?= $background_position ?> center;
    <?= $background_style_desktop ?>
    z-index: 0;
    display: block;
}

/* Mobile-only background image div */
.hero-image#<?= $blockID ?> .mobile-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-attachment: scroll;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    <?= $background_style_mobile ?>
    z-index: 0;
    display: none;
}

/* Video container */
.hero-image#<?= $blockID ?> .hero-video-wrap {
    position: absolute !important;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 0;
}

.hero-image#<?= $blockID ?> .hero-video-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

/* Desktop video sizing */
@media (min-width: 768px) {
    .hero-image#<?= $blockID ?> .hero-video-bg iframe,
    .hero-image#<?= $blockID ?> .hero-video-bg video {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 177.77vh;
        height: 56.25vw;
        min-width: 100%;
        min-height: 100%;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }
}

/* Mobile video sizing - More aggressive scaling for Vimeo */
@media (max-width: 767px) {
    /* Hero container sizing */
    .hero-image#<?= $blockID ?> {
        position: relative !important;
        min-height: 400px;
        max-height: 600px;
        height: 70vh;
    }
    
    /* Video wrapper */
    .hero-image#<?= $blockID ?> .hero-video-wrap {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
    }
    
    .hero-image#<?= $blockID ?> .hero-video-bg {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
    }
    
    /* AGGRESSIVE Vimeo scaling to eliminate ALL black bars */
    .hero-image#<?= $blockID ?>.has-vimeo .hero-video-bg iframe {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        /* Much larger scaling to ensure no black bars */
        width: 300% !important;
        height: 300% !important;
        min-width: 300% !important;
        min-height: 300% !important;
        transform: translate(-50%, -50%) !important;
        pointer-events: none;
    }
    
    /* YouTube iframe scaling */
    .hero-image#<?= $blockID ?>.has-youtube .hero-video-bg iframe {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        width: 250% !important;
        height: 250% !important;
        transform: translate(-50%, -50%) !important;
        pointer-events: none;
    }
    
    /* Direct video files */
    .hero-image#<?= $blockID ?> .hero-video-bg video {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }
}

/* Portrait orientation - Even more aggressive for tall screens */
@media (max-width: 767px) and (orientation: portrait) {
    .hero-image#<?= $blockID ?>.has-vimeo .hero-video-bg iframe {
        /* Extra scaling for portrait to completely fill */
        width: 400% !important;
        height: 225% !important; /* 16:9 aspect ratio */
        transform: translate(-50%, -50%) !important;
    }
}

/* Landscape orientation */
@media (max-width: 767px) and (orientation: landscape) {
    .hero-image#<?= $blockID ?> {
        height: 90vh;
    }
    
    .hero-image#<?= $blockID ?>.has-vimeo .hero-video-bg iframe {
        /* Scale for landscape */
        width: 250% !important;
        height: 250% !important;
        transform: translate(-50%, -50%) !important;
    }
}

/* Alternative CSS-only approach for maximum coverage */
@media (max-width: 767px) {
    .hero-image#<?= $blockID ?>.has-vimeo .hero-video-wrap {
        /* Create a mask effect to hide edges */
        -webkit-mask-image: -webkit-radial-gradient(white, black);
        mask-image: radial-gradient(white, black);
    }
    
    /* Use viewport units for better scaling */
    .hero-image#<?= $blockID ?>.has-vimeo .hero-video-bg iframe {
        width: max(300%, 300vw) !important;
        height: max(300%, 300vh) !important;
    }
}

/* Specific fix for iPhones */
@supports (-webkit-touch-callout: none) {
    @media (max-width: 767px) {
        .hero-image#<?= $blockID ?>.has-vimeo .hero-video-bg iframe {
            /* iOS specific scaling */
            width: 350% !important;
            height: 350% !important;
            -webkit-transform: translate(-50%, -50%) scale(1.1) !important;
            transform: translate(-50%, -50%) scale(1.1) !important;
        }
    }
}

/* Overlay */
.hero-image#<?= $blockID ?> .hero-video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    z-index: 1;
}

/* Content */
.hero-image#<?= $blockID ?> .hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
    height: 100%;
    min-height: <?= $min_height ?>;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2rem;
}

/* Desktop styles */
@media (min-width: 768px) {
    .hero-image#<?= $blockID ?> .desktop-bg {
        display: block !important;
    }
    
    .hero-image#<?= $blockID ?> .mobile-bg {
        display: none !important;
    }
}

/* Tablet */
@media (max-width: 1024px) {
    .hero-image#<?= $blockID ?> .desktop-bg {
        background-attachment: scroll !important;
    }
}

/* Mobile */
@media (max-width: 767px) {
    .hero-image#<?= $blockID ?> .desktop-bg {
        display: none !important;
    }
    
    .hero-image#<?= $blockID ?> .mobile-bg {
        display: block !important;
    }
    
    .hero-image#<?= $blockID ?> .hero-content {
        min-height: 400px;
        padding: 1.5rem;
    }
}

/* Small mobile */
@media (max-width: 480px) {
    .hero-image#<?= $blockID ?> {
        min-height: 350px;
        height: 60vh;
    }
    
    .hero-image#<?= $blockID ?> .hero-content {
        min-height: 350px;
        padding: 1rem;
    }
    
    /* Even more aggressive scaling for very small screens */
    .hero-image#<?= $blockID ?>.has-vimeo .hero-video-bg iframe {
        width: 400% !important;
        height: 400% !important;
    }
}
</style>

<div id="<?= $blockID ?>" class="hero-image bg-<?= $background_position ?> content-<?= $content_position ?> <?= $is_vimeo ? 'has-vimeo' : '' ?> <?= $is_youtube ? 'has-youtube' : '' ?> <?= ($use_video && $video_embed_url) ? 'has-video' : '' ?>">
    
    <?php if ($use_image && !$use_video): ?>
        <!-- Desktop Background -->
        <?php if ($background_image): ?>
            <div class="desktop-bg"></div>
        <?php endif; ?>
        
        <!-- Mobile Background -->
        <?php if ($background_mobile || $background_image): ?>
            <div class="mobile-bg"></div>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php if ($use_video && $video_embed_url): ?>
        <div class="hero-video-wrap">
            <div class="hero-video-bg" data-video-aspect="16:9">
                <?php if ($is_vimeo || $is_youtube): ?>
                    <iframe 
                        id="video-iframe-<?= esc_attr($blockID) ?>"
                        src="<?= esc_attr($video_embed_url) ?>"
                        frameborder="0"
                        allow="autoplay; fullscreen"
                        allowfullscreen>
                    </iframe>
                <?php else: ?>
                    <video 
                        autoplay 
                        muted 
                        loop 
                        playsinline
                        webkit-playsinline
                        <?php if($fallback_image_url): ?>poster="<?= esc_url($fallback_image_url) ?>"<?php endif; ?>>
                        <source src="<?= esc_url($video_embed_url) ?>" type="video/mp4">
                    </video>
                <?php endif; ?>
            </div>
            <div class="hero-video-overlay"></div>
        </div>
    <?php endif; ?>
    
    <div class="hero-content">
        <?php if($top_icon): ?>
            <div class="decorative-edge">
                <img src="<?= esc_url($top_icon['url']) ?>" alt="<?= esc_attr($top_icon['alt']) ?>">
            </div>
        <?php endif ?>
        
        <?php if($top_sub_title): ?>
            <h3 class="hero-top-sub-title" style="color: <?= $subTitle_color ?>">
                <?= esc_html($top_sub_title) ?>
            </h3>
        <?php endif ?>
        
        <h2 class="hero-title" style="<?= !$subTitle ? 'margin-bottom: 4rem;' : '' ?> color: <?= $title_color ?>;">
            <?= esc_html($title) ?>
        </h2>
        
        <?php if($subTitle): ?>
            <h3 class="hero-sub-title" style="color: <?= $subTitle_color ?>">
                <?= esc_html($subTitle) ?>
            </h3>
        <?php endif ?>
        
        <div class="hero-description" style="color: <?= $description_color ?>">
            <?= wp_kses_post($description) ?>
        </div>
        
        <?php if($social_media): ?>
            <div class="container social-medias">
                <?php foreach($social_media as $media): ?>
                    <a href="<?= esc_url($media['url']) ?>" target="_blank" rel="noopener noreferrer" style="color: <?= esc_attr($media['label_color']) ?>">
                        <img src="<?= esc_url($media['icon']['url']) ?>" alt="<?= esc_attr($media['icon']['alt']) ?>">
                        <span>
                            <?= esc_html($media['label']) ?>
                        </span>
                    </a>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
</div>

<?php if ($is_vimeo && $vimeo_id): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const heroElement = document.getElementById('<?= esc_js($blockID) ?>');
    const iframe = document.getElementById('video-iframe-<?= esc_js($blockID) ?>');
    
    if (heroElement && iframe && window.innerWidth <= 767) {
        // More aggressive dynamic scaling
        function aggressiveVimeoScale() {
            const container = heroElement.querySelector('.hero-video-bg');
            if (container) {
                const containerWidth = container.offsetWidth;
                const containerHeight = container.offsetHeight;
                const containerAspect = containerWidth / containerHeight;
                
                // Vimeo videos are 16:9
                const videoAspect = 16 / 9;
                
                // Calculate how much to scale up to completely fill container
                let scale;
                if (containerAspect > videoAspect) {
                    // Container is wider - need to scale based on width
                    scale = (containerAspect / videoAspect) * 2.5;
                } else {
                    // Container is taller - need to scale based on height
                    scale = (videoAspect / containerAspect) * 2.5;
                }
                
                // Apply very aggressive scaling
                iframe.style.width = (scale * 100) + '%';
                iframe.style.height = (scale * 100) + '%';
                iframe.style.transform = 'translate(-50%, -50%)';
                
                // Log for debugging
                console.log('Vimeo aggressive scaling:', {
                    containerAspect: containerAspect.toFixed(2),
                    videoAspect: videoAspect.toFixed(2),
                    scaleFactor: scale.toFixed(2),
                    finalWidth: (scale * 100) + '%'
                });
            }
        }
        
        // Apply scaling immediately
        aggressiveVimeoScale();
        
        // Reapply on orientation change
        window.addEventListener('orientationchange', function() {
            setTimeout(aggressiveVimeoScale, 200);
        });
        
        // Also try alternative approach with transform scale
        setTimeout(function() {
            if (iframe) {
                // Get current computed styles
                const currentTransform = window.getComputedStyle(iframe).transform;
                
                // If black bars still visible, increase scale even more
                const testElement = document.createElement('div');
                testElement.style.position = 'absolute';
                testElement.style.top = '0';
                testElement.style.width = '100%';
                testElement.style.height = '1px';
                testElement.style.background = 'red';
                testElement.style.zIndex = '9999';
                
                // Check if we need more scaling by testing visibility
                container = heroElement.querySelector('.hero-video-bg');
                if (container) {
                    container.appendChild(testElement);
                    
                    setTimeout(() => {
                        testElement.remove();
                        
                        // Force even more aggressive scaling if needed
                        const rect = iframe.getBoundingClientRect();
                        const containerRect = container.getBoundingClientRect();
                        
                        if (rect.height < containerRect.height * 1.5) {
                            iframe.style.transform = 'translate(-50%, -50%) scale(2)';
                        }
                    }, 100);
                }
            }
        }, 500);
    }
});

// Detect and log actual video dimensions for debugging
if (window.location.search.includes('debug')) {
    console.log('Hero Video Debug Mode - Vimeo ID: <?= esc_js($vimeo_id) ?>');
}
</script>
<?php endif; ?>

<!-- Debug Info -->
<!-- Vimeo Scaling: 300% base, 400% portrait, 350% iOS -->
<!-- Container: 70vh mobile, 90vh landscape -->