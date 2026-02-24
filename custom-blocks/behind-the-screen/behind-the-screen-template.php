<?php
$background_type = get_field('background_type');
$background_color = get_field('background_color');
$section_style = '';

if ($background_type === 'color' && $background_color) {
    $section_style = 'style="background-color:' . esc_attr($background_color) . ';"';
} elseif ($background_type === 'image' && $background_image = get_field('background_image')) {
    $section_style = 'style="background-image: url(' . esc_url($background_image['url']) . '); background-size: cover; background-position: center;"';
}

$main_image = get_field('main_image');
$logo_image_1 = get_field('logo_image_1');
$logo_image_2 = get_field('logo_image_2');
$small_title = get_field('small_title');
$main_title_line1 = get_field('main_title_line1');
$main_title_line2 = get_field('main_title_line2');
$subtitle = get_field('subtitle');
$description = get_field('description');
$content_alignment = get_field('content_alignment') ?: 'right';
?>

<section class="family-passport-section" <?php echo $section_style; ?>>
    <div class="container">
        <div class="passport-content">
            
            <!-- Image Column -->
            <div class="image-column">
                <?php if ($main_image) : ?>
                    <div class="main-image-wrapper">
                        <img src="<?php echo esc_url($main_image['url']); ?>" 
                             alt="<?php echo esc_attr($main_image['alt']); ?>" 
                             class="main-image">
                        
                        <?php if ($logo_image_1 || $logo_image_2) : ?>
                            <div class="logo-overlay">
                                <?php if ($logo_image_1) : ?>
                                    <img src="<?php echo esc_url($logo_image_1['url']); ?>" 
                                         alt="<?php echo esc_attr($logo_image_1['alt']); ?>" 
                                         class="logo-image logo-1">
                                <?php endif; ?>
                                
                                <?php if ($logo_image_2) : ?>
                                    <img src="<?php echo esc_url($logo_image_2['url']); ?>" 
                                         alt="<?php echo esc_attr($logo_image_2['alt']); ?>" 
                                         class="logo-image logo-2">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Content Column -->
            <div class="content-column content-align-<?php echo esc_attr($content_alignment); ?>">
                <div class="content-wrapper">
                    
                    <?php if ($small_title) : ?>
                        <div class="small-title">
                            <?php echo esc_html($small_title); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($main_title_line1 || $main_title_line2) : ?>
                        <h2 class="main-title">
                            <?php if ($main_title_line1) : ?>
                                <span class="title-line-1"><?php echo esc_html($main_title_line1); ?></span>
                            <?php endif; ?>
                            <?php if ($main_title_line2) : ?>
                                <span class="title-line-2"><?php echo esc_html($main_title_line2); ?></span>
                            <?php endif; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($subtitle) : ?>
                        <h3 class="subtitle">
                            <?php echo esc_html($subtitle); ?>
                        </h3>
                    <?php endif; ?>

                    <?php if ($description) : ?>
                        <div class="description">
                            <?php echo wp_kses_post(wpautop($description)); ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</section>