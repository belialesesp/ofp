<?php
/**
 * Success Stories Block Template
 *
 * Slider initialisation is handled centrally by OFPSlider in ofp-functions.js.
 * The .splide root carries the class "success-stories-splide" so the manager
 * knows which named config to apply.  No inline <script> block is needed here.
 */

// ─── Determine rendering context ──────────────────────────────────────────────
$is_widget = ( function_exists('ofp_is_widget_mode') && ofp_is_widget_mode() )
             || (bool) get_field('is_widget');

// ─── Source: widget mode vs block mode ────────────────────────────────────────
$stories = array();

if ($is_widget) {
    // Widget mode — pull from ACF options page using helper
    $stories_raw = function_exists('get_widget_success_stories')
            ? get_widget_success_stories()
            : ( get_field('success_stories', 'option') ?: array() );

    foreach ($stories_raw as $s) {
        $stories[] = array(
            'image'                            => $s['ssi_image']        ?? null,
            'storie'                           => $s['ssi_story']        ?? '',
            'author'                           => $s['ssi_author']       ?? '',
            'image_border_color__author_color' => $s['ssi_author_color'] ?? '#61a7af',
        );
    }
} else {
    // Block mode — use stories attached to this block instance
    $custom_stories = get_field('stories');
    if ($custom_stories && is_array($custom_stories)) {
        $stories = $custom_stories;
    } else {
        $single_story = array(
            'storie'                         => get_field('storie'),
            'image'                          => get_field('image'),
            'author'                         => get_field('author'),
            'image_border_color__author_color' => get_field('image_border_color__author_color') ?: '#61a7af',
        );
        if (!empty($single_story['storie']) || !empty($single_story['author'])) {
            $stories[] = $single_story;
        }
    }
}

// ─── Meta ─────────────────────────────────────────────────────────────────────
$blockID         = 'success-storie-' . uniqid();
$container_class = $is_widget ? 'success-stories widget-mode' : 'success-stories';

if ($is_widget) {
    $opts                   = function_exists('ofp_get_success_stories_options') ? ofp_get_success_stories_options() : array();
    $title                  = $opts['widget_title']                ?? get_field('widget_title', 'option') ?: 'Success Stories';
    $background_type        = $opts['widget_background_type']      ?? 'gradient';
    $background_color       = $opts['widget_background_color']     ?? '#ffffff';
    $background_color_start = $opts['widget_background_color_start'] ?? '#ffffff';
    $background_color_end   = $opts['widget_background_color_end']   ?? '#ffffff';
    $rotation_deg           = (int) ( $opts['widget_rotation_deg'] ?? 90 );
} else {
    $title                  = get_field('title');
    $background_type        = get_field('background_type')        ?: 'solid';
    $background_color       = get_field('background_color')       ?: '#ffffff';
    $background_color_start = get_field('background_color_start') ?: '#ffffff';
    $background_color_end   = get_field('background_color_end')   ?: '#ffffff';
    $rotation_deg           = (int) ( get_field('rotation_deg')   ?: 90 );
}

if ($background_type === 'gradient') {
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

<div id="<?php echo esc_attr( $blockID ); ?>-container"
     class="<?php echo esc_attr( $container_class ); ?>"
     style="<?php echo esc_attr( $background_style ); ?>">

    <div class="container">

        <?php if ($title) : ?>
            <h2 class="success-stories__title">
                <?php echo esc_html($title); ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($stories)) : ?>

            <?php
            /*
             * The root element carries two classes that matter:
             *   "splide"                  — OFPSlider.init() scans for this
             *   "success-stories-splide"  — OFPSlider uses this to select the
             *                               named config from its CONFIGS registry
             *
             * No data-splide attribute is needed here because the named config
             * already defines all required options. Add data-splide only if you
             * need to override a specific option for this particular instance.
             */
            ?>
            <div id="<?php echo esc_attr( $blockID ); ?>"
                 class="splide success-stories-splide success-stories__stories">

                <div class="splide__track">
                    <ul class="splide__list">

                        <?php foreach ($stories as $story) : ?>
                            <li class="splide__slide storie">

                                <?php
                                // ── Author image ──────────────────────────────
                                if (!empty($story['image'])) {
                                    $image_url = '';
                                    if (is_array($story['image']) && isset($story['image']['url'])) {
                                        $image_url = $story['image']['url'];
                                    } elseif (is_numeric($story['image'])) {
                                        $img_src = wp_get_attachment_image_src($story['image'], 'medium');
                                        if ($img_src) {
                                            $image_url = $img_src[0];
                                        }
                                    }

                                    if ($image_url) : ?>
                                        <div class="storie-image">
                                            <img src="<?php echo esc_url($image_url); ?>"
                                                 alt="<?php echo esc_attr($story['author'] ?? ''); ?>"
                                                 style="border-color: <?php echo esc_attr($story['image_border_color__author_color'] ?? '#61a7af'); ?>">
                                        </div>
                                    <?php endif;
                                }
                                ?>

                                <?php if (!empty($story['storie'])) : ?>
                                    <div class="storie-description">
                                        <?php echo wp_kses_post($story['storie']); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($story['author'])) : ?>
                                    <div class="storie-author"
                                         style="color: <?php echo esc_attr($story['image_border_color__author_color'] ?? '#61a7af'); ?>">
                                        <?php echo esc_html($story['author']); ?>
                                    </div>
                                <?php endif; ?>

                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div><!-- /.splide -->

        <?php else : ?>
            <div class="no-stories-message">
                <p>
                    <?php if ($is_widget) : ?>
                        <?php esc_html_e('No success stories available. Please add stories in Theme Options > Success Stories.', 'our-family-passport'); ?>
                    <?php else : ?>
                        <?php esc_html_e('No success stories available. Please add stories to this block.', 'our-family-passport'); ?>
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
