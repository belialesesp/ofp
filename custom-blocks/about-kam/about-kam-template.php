<?php
// Settings
$background_color = get_field('background_color');
$sub_title_color = get_field('sub_title_color');
$title_color = get_field('title_color');
$description_color = get_field('description_color');
$flloating_image_border_color = get_field('flloating_image_border_color');
$background_float_box_color = get_field('background_float_box_color');
$text_float_box_color = get_field('text_float_box_color');

// Content
$sub_tile = get_field('sub_tile');
$title = get_field('title');
$description = get_field('description');
$main_image = get_field('main_image');
$float_image = get_field('float_image');
$float_video = get_field('float_video'); // New video field
$passport_float_box = get_field('passport_float_box');
$first_paragraph_float_box = get_field('first_paragraph_float_box');
$second_paragraph_float_box = get_field('second_paragraph_float_box');

$blockID = 'success-storie-' . uniqid();

// Process video URL if it exists
$video_embed_url = '';
if ($float_video) {
    // Remove any query parameters for processing
    $clean_url = strtok($float_video, '?');
    
    // Check if it's a Vimeo URL
    if (strpos($float_video, 'vimeo.com') !== false) {
        // Extract Vimeo ID - updated regex to handle various formats
        preg_match('/vimeo\.com\/(?:video\/|manage\/videos\/)?(\d+)/', $clean_url, $matches);
        if (isset($matches[1])) {
            $video_embed_url = 'https://player.vimeo.com/video/' . $matches[1] . '?background=1&autoplay=1&loop=1&muted=1&controls=0&title=0&byline=0&portrait=0&dnt=1';
        }
    }
    // Check if it's a YouTube URL
    elseif (strpos($float_video, 'youtube.com') !== false || strpos($float_video, 'youtu.be') !== false) {
        // Extract YouTube ID
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $float_video, $matches);
        if (isset($matches[1])) {
            $video_embed_url = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&controls=0&showinfo=0&playlist=' . $matches[1];
        }
    }
    // Direct video file URL (mp4, webm, etc.)
    else {
        $video_embed_url = $float_video;
    }
}
?>

<div class="about-kam" style="background-color: <?= $background_color ?>;">
  <div class="container">
    <h3 class="about-kam__sub-title" style="color: <?= $sub_title_color ?>">
      <?= $sub_tile ?>
    </h3>
    <h2 class="about-kam__title" style="color: <?= $title_color ?>">
      <?= $title ?>
    </h2>
    <div class="about-kam__main-image">
      <img src="<?= esc_url($main_image['url']) ?>" alt="<?= $main_image['alt'] ?>">
    </div>
    <div class="about-kam__description" style="color: <?= $description_color ?>">
      <?= $description ?>
    </div>
    
    <?php if ($video_embed_url): ?>
        <!-- Float Video -->
        <div class="about-kam__float-image about-kam__float-video" style="border-color: <?= $flloating_image_border_color ? $flloating_image_border_color : 'transparent' ?>;">
            <?php if (strpos($video_embed_url, 'player.vimeo.com') !== false || strpos($video_embed_url, 'youtube.com/embed') !== false): ?>
                <!-- Iframe for Vimeo/YouTube -->
                <iframe 
                    src="<?= esc_url($video_embed_url) ?>"
                    frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture"
                    allowfullscreen
                    title="Float video">
                </iframe>
            <?php else: ?>
                <!-- Video element for direct video files -->
                <video 
                    autoplay 
                    muted 
                    loop 
                    playsinline>
                    <source src="<?= esc_url($video_embed_url) ?>" type="video/mp4">
                </video>
            <?php endif; ?>
        </div>
    <?php elseif ($float_image): ?>
        <!-- Float Image (fallback) -->
        <div class="about-kam__float-image">
            <img src="<?= esc_url($float_image['url']) ?>" alt="<?= $float_image['alt'] ?>" style="border-color: <?= $flloating_image_border_color ? $flloating_image_border_color : 'transparent' ?>;">
        </div>
    <?php endif; ?>
    
    <div class="about-kam__float-box" style="background-color: <?= $background_float_box_color ?>">
      <img src="<?= esc_url($passport_float_box['url']) ?>" alt="<?= $passport_float_box['alt'] ?>">
      <div class="first" style="color: <?= $text_float_box_color ?>"><?= $first_paragraph_float_box ?></div>
      <div class="second" style="color: <?= $text_float_box_color ?>"><?= $second_paragraph_float_box ?></div>
    </div>
  </div>
</div>