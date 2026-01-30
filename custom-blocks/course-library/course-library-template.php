<?php
$items = get_field('items');
$itemCounter = 0;
$background_type = get_field('background_type');
$background_image = get_field('background_image');
$background_video = get_field('background_video'); 
$rotation_deg = get_field('rotation_deg');
$background_color_start = get_field('background_color_start');
$background_color_end = get_field('background_color_end');
$background_color = get_field('background_color');
$blockID = 'course-library-' . uniqid();

// Process video URL BEFORE using it
$video_embed_url = '';
if ($background_type == 'video' && $background_video) {
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
    // Direct video file URL (mp4, webm, etc.)
    else {
        $video_embed_url = $background_video;
    }
}
?>

<style>
/* Base styles for course library */
#<?= $blockID ?>.course-library {
    position: relative;
    padding: 3rem 0;
}

<?php if ($background_type == 'gradient'): ?>
#<?= $blockID ?> {
    background: linear-gradient(<?= $rotation_deg ? $rotation_deg : 0 ?>deg,
        <?= $background_color_start ?> 0%,
        <?= $background_color_end ?> 100%);
}
<?php endif; ?>

<?php if ($background_type == 'image'): ?>
#<?= $blockID ?> {
    background-image: url(<?= $background_image['url'] ?>);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
<?php endif; ?>

<?php if ($background_type == 'color'): ?>
#<?= $blockID ?> {
    background-color: <?= $background_color ?>;
}
<?php endif; ?>

<?php if ($background_type == 'video'): ?>
#<?= $blockID ?> {
    position: relative;
    overflow: hidden;
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    min-height: 600px;
    background-color: #000;
}

/* Video wrapper for overflow control */
#<?= $blockID ?> .course-library__video-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 0;
}

/* Video positioning for coverage */
#<?= $blockID ?> .course-library__video-wrapper iframe {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    min-width: 100%;
    min-height: 100%;
    transform: translate(-50%, -50%) scale(1.2);
    z-index: 0;
    pointer-events: none;
    border: none;
}

#<?= $blockID ?> .course-library__video-wrapper video {
    position: absolute;
    top: 50%;
    left: 50%;
    width: auto;
    height: auto;
    min-width: 100%;
    min-height: 100%;
    transform: translate(-50%, -50%);
    object-fit: cover;
    z-index: 0;
    pointer-events: none;
}

#<?= $blockID ?> .course-library__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 1;
    pointer-events: none;
}

#<?= $blockID ?> .splide__track {
    position: relative;
    z-index: 2;
}

/* Mobile responsive styles */
@media (max-width: 767px) {
    #<?= $blockID ?> {
        margin-left: 0;
        width: 100%;
        min-height: 500px;
    }
	#<?= $blockID ?> .course-library__video-wrapper {
		min-height: 700px;
	}
	#<?= $blockID ?> .course-library__video-wrapper iframe {
		top: 0;
		transform: scale(4);
	}
}
<?php endif; ?>

/* Tab styles */
.course-library__tab {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: -1;
}
</style>

<div id="<?= $blockID ?>" class="splide course-library">
  <?php if ($background_type == 'video' && $video_embed_url): ?>
    <div class="course-library__video-wrapper">
      <?php if (strpos($video_embed_url, 'player.vimeo.com') !== false || strpos($video_embed_url, 'youtube.com/embed') !== false): ?>
        <!-- Iframe for Vimeo/YouTube -->
        <iframe 
          src="<?= esc_url($video_embed_url) ?>"
          frameborder="0"
          allow="autoplay; fullscreen; picture-in-picture"
          title="Background video"
          allowfullscreen>
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
    <div class="course-library__overlay"></div>
  <?php endif; ?>
  
  <div class="splide__track">
    <ul class="splide__list">
      <?php foreach ($items as $item): $itemCounter++; ?>
        <style>
          .course-library__tab--<?= $itemCounter ?> {
            background-color: <?= $item['tab_color'] ?>;
          }

          .course-library__tab--<?= $itemCounter ?>::before {
            background-color: <?= $item['tab_color'] ?>;
          }

          .course-library__tab--<?= $itemCounter ?>::after {
            background-color: <?= $item['tab_color'] ?>;
          }
        </style>

        <li class="splide__slide">
          <div class="course-library__item">
            <div class="course-library__content">
              <div class="tab-title" style="background-color: <?= $item['tab_color'] ?>; color: <?= $item['tab_title_font_color'] ?>">
                <div class="course-library__tab course-library__tab--<?= $itemCounter ?>"></div>
                <?= $item['tab_title'] ?>
              </div>
              <div class="box-content">
                <div class="identifier">
                  <span class="identifier__number" style="color: <?= $item['number__identifier_color'] ?>">
                    <?= $item['number_identifier'] ?>
                  </span>
                  <span class="identifier__title">
                    <?= $item['number_identifier_title'] ?>
                  </span>
                </div>
                <h2 class="title">
                  <?= $item['title'] ?>
                </h2>
                <div class="description">
                  <?= $item['description'] ?>
                </div>
                <a class="cta" href="<?= $item['cta_url'] ?>" style="color: <?= $item['tab_color'] ?>">
                  <span><?= $item['cta_label'] ?></span>
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_<?= $blockID ?>_<?= $itemCounter ?>" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                      <rect width="24" height="24" fill="#D9D9D9" />
                    </mask>
                    <g mask="url(#mask0_<?= $blockID ?>_<?= $itemCounter ?>)">
                      <path d="M16.175 13H4V11H16.175L10.575 5.4L12 4L20 12L12 20L10.575 18.6L16.175 13Z" fill="<?= $item['tab_color'] ?>" />
                    </g>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<script>
  window.addEventListener("load", function() {
    var successStoriesSlider = new Splide("#<?= $blockID ?>", {
      type: 'loop',
      heightRatio: 0,
      pagination: false,
      arrows: true,
      perPage: 2,
      gap: '1rem',
      arrowPath: 'M29.6548 23.8359H7.33398V20.1693H29.6548L19.3882 9.9026L22.0007 7.33594L36.6673 22.0026L22.0007 36.6693L19.3882 34.1026L29.6548 23.8359Z',
      breakpoints: {
        991: {
          perPage: 1,
        },
      }
    });
    successStoriesSlider.mount();
  });
</script>