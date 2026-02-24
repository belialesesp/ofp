<?php
/**
 * Words Animation Block Template
 */

// Get ACF fields
$words_list = get_field('words_list'); // Repeater field
$animation_speed = get_field('animation_speed') ?: '10'; // seconds - um pouco mais rápido
$background_color = get_field('background_color') ?: '#F5F2EF';
$section_height = get_field('section_height') ?: '150px';

// Default words with colors if no ACF field configured
$default_words = [
    ['word' => 'IMAGINE', 'color' => '#A8C8A8'],
    ['word' => 'SAVE', 'color' => '#F4B5A0'],
    ['word' => 'DREAM', 'color' => '#9BBFCD'],
    ['word' => 'PLAN', 'color' => '#F0A9AD']
];

$words_to_display = array();

if ($words_list && is_array($words_list)) {
    foreach ($words_list as $word_item) {
        if (!empty($word_item['word'])) {
            $words_to_display[] = [
                'word' => $word_item['word'],
                'color' => !empty($word_item['color']) ? $word_item['color'] : '#A8C8A8'
            ];
        }
    }
}

// Use default words if no custom words are set
if (empty($words_to_display)) {
    $words_to_display = $default_words;
}
?>

<section class="words-animation-section" 
         style="background-color: <?php echo esc_attr($background_color); ?>; 
                height: <?php echo esc_attr($section_height); ?>;">
    
    <div class="words-animation-container">
        <div class="words-marquee" 
             style="animation-duration: <?php echo esc_attr($animation_speed); ?>s;">
            
            <?php 
            foreach ($words_to_display as $index => $word_data): 
                // Get next word color for separator
                $next_index = ($index + 1) % count($words_to_display);
                $next_color = $words_to_display[$next_index]['color'];
            ?>
                <span class="animated-word" style="color: <?php echo esc_attr($word_data['color']); ?>;">
                    <?php echo esc_html($word_data['word']); ?>
                </span>
                <?php if ($index < count($words_to_display) - 1): ?>
                <span class="word-separator" style="color: <?php echo esc_attr($next_color); ?>;">/</span>
                <?php endif; ?>
            <?php 
            endforeach;
            ?>
        </div>
    </div>
</section>

<style>
.words-animation-section {
    width: 100%;
    overflow: hidden;
    position: relative;
    display: flex;
    align-items: center;
    min-height: 120px;
    padding: 24px 0;
    border-bottom: 1px solid #D7D7D7;
}

.words-animation-container {
    width: 100%;
    position: relative;
    white-space: nowrap;
    display: flex;
    justify-content: center;
    align-items: center;
}

.words-marquee {
    display: inline-flex;
    align-items: center;
    animation: move-to-center ease-in-out forwards;
    will-change: transform;
    width: max-content;
}

.animated-word {
    text-align: center;
    font-family: Versailles;
    font-size: 110px;
    font-style: normal;
    font-weight: 400;
    line-height: 121px; /* 110% */
    margin: 0 2rem;
    white-space: nowrap;
    text-transform: uppercase;
    opacity: 1;
}

.word-separator {
    text-align: center;
    font-family: Versailles;
    font-size: 110px;
    font-style: normal;
    font-weight: 400;
    line-height: 121px; /* 110% */
    margin: 0 2rem;
    opacity: 1;
}

/* Keyframe animation - da esquerda para direita até centralizado */
@keyframes move-to-center {
    0% {
        transform: translateX(-30%);
    }
    100% {
        transform: translateX(0);
    }
}

/* Mobile Responsive */
@media screen and (max-width: 768px) {
    .words-animation-section {
        height: auto !important;
        min-height: 80px;
        padding: 24px 0;
    }
    
    .animated-word {
        font-size: 60px;
        line-height: 66px;
        margin: 0 1rem;
    }
    
    .word-separator {
        font-size: 60px;
        line-height: 66px;
        margin: 0 1rem;
    }
}

@media screen and (max-width: 480px) {
    .animated-word {
        font-size: 40px;
        line-height: 44px;
        margin: 0 0.8rem;
    }
    
    .word-separator {
        font-size: 40px;
        line-height: 44px;
        margin: 0 0.8rem;
    }
}

/* Smooth performance optimizations */
.words-marquee {
    backface-visibility: hidden;
    perspective: 1000px;
    transform: translateZ(0);
}
</style>