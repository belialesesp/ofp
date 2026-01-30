<?php
$widgets = get_field('sidebar_widgets');
// Get all cards data from Custom Post Type
$all_cards_query = new WP_Query(array(
    'post_type' => 'credit_cards',
    'posts_per_page' => -1,
    'post_status' => 'publish'
));

$all_cards = array();
if ($all_cards_query->have_posts()) {
    while ($all_cards_query->have_posts()) {
        $all_cards_query->the_post();
        $post_id = get_the_ID();
        
        // Get data from ACF repeater field
        $credit_cards_data = get_field('credit_cards', $post_id);
        
        // Get first item from repeater (position 0)
        $card_info = null;
        if (is_array($credit_cards_data) && !empty($credit_cards_data)) {
            $card_info = $credit_cards_data[0];
        }
        
        $all_cards[$post_id] = array(
            'cci_card_name' => get_the_title(),
            'cci_card_image' => $card_info['cci_card_image'] ?? null,
            'cci_current_offer' => $card_info['cci_current_offer'] ?? null,
            'offer_points' => $card_info['offer_points'] ?? null,
            'cci_learn_more_link' => $card_info['cci_learn_more_link'] ?? null,
            'cci_terms_apply' => $card_info['cci_terms_apply'] ?? null,
            'cci_rates_and_fees' => $card_info['cci_rates_and_fees'] ?? null,
            'affiliate' => $card_info['affiliate'] ?? null,
        );
    }
    wp_reset_postdata();
}

$blockID = 'custom-sidebar-' . uniqid();
$is_page = is_page();
$sidebar_class = $is_page ? 'page-sidebar-block' : 'post-sidebar-block';
?>

<div class="sidebar-block-wrapper <?php echo esc_attr($sidebar_class); ?>">
    <div class="sidebar">
        <aside id="secondary" class="widget-area">
            <?php if ($widgets && is_array($widgets)): ?>
                <?php foreach ($widgets as $widget): ?>
                    <?php $widget_type = $widget['widget_type']; ?>

                    <?php if ($widget_type == 'about_kam'): ?>
                        <section class="widget widget_block">
                            <div class="wp-block-group">
                                <div class="wp-block-group__inner-container is-layout-flow wp-block-group-is-layout-flow">
                                    <div class="about-kam-widget">
                                        <?php if (isset($widget['about_image']) && is_array($widget['about_image']) && isset($widget['about_image']['url'])): ?>
                                            <img decoding="async" src="<?= esc_url($widget['about_image']['url']) ?>" alt="<?= esc_attr($widget['about_image']['alt'] ?? '') ?>" class="about-kam-widget__image">
                                        <?php endif; ?>

                                        <?php if (isset($widget['about_title']) && $widget['about_title']): ?>
                                            <h2 class="about-kam-widget__title">
                                                <?= $widget['about_title'] ?>
                                            </h2>
                                        <?php endif; ?>

                                        <?php if (isset($widget['about_description']) && $widget['about_description']): ?>
                                            <div class="about-kam-widget__description">
                                                <?= $widget['about_description'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>

                    <?php if ($widget_type == 'banner_cta'): ?>
                        <?php
                            $banner_id = 'banner-cta-' . uniqid();
                        ?>
                        <section class="widget widget_block">
                            <?php if (isset($widget['banner_background']) && is_array($widget['banner_background']) && isset($widget['banner_background']['url'])): ?>
                                <style>
                                    #<?= $banner_id ?>-container {
                                        background-image: url(<?= esc_url($widget['banner_background']['url']) ?>);
                                    }
                                </style>
                            <?php else: ?>
                                <style>
                                    #<?= $banner_id ?>-container {
                                        background: linear-gradient(
                                            -90deg,
                                            #fed7d8 0%,
                                            #f8c8b4 100%
                                        );
                                    }
                                </style>
                            <?php endif; ?>
                            
                            <div id="<?= $banner_id ?>-container" class="banner-cta">
                                <?php if (isset($widget['banner_icon']) && is_array($widget['banner_icon']) && isset($widget['banner_icon']['url'])): ?>
                                    <img decoding="async" src="<?= esc_url($widget['banner_icon']['url']) ?>" alt="<?= esc_attr($widget['banner_icon']['alt'] ?? '') ?>" class="banner-cta__icon">
                                <?php endif; ?>
                                
                                <?php if (isset($widget['banner_title']) && $widget['banner_title']): ?>
                                    <h2 class="banner-cta__title" style="font-family: 'LeagueGothic', sans-serif; color: #ffffff; font-size: 36px; line-height: 36px;">
                                        <?= $widget['banner_title'] ?>
                                    </h2>
                                <?php endif; ?>
                                
                                <?php if (isset($widget['banner_description']) && $widget['banner_description']): ?>
                                    <div class="banner-cta__description" style="color: #222; font-size: 14px; line-height: 14px;">
                                        <?= $widget['banner_description'] ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (isset($widget['banner_cta_label']) && $widget['banner_cta_label'] && isset($widget['banner_cta_url']) && $widget['banner_cta_url']): ?>
                                    <a href="<?= esc_url($widget['banner_cta_url']) ?>" target="_blank" class="banner-cta__cta" style="background-color: #9bbfcd; color: #ffffff">
                                        <?= $widget['banner_cta_label'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <?php if ($widget_type == 'favorite_cards'): ?>
                        <?php
                        $title_line_1 = isset($widget['cards_title_1']) ? $widget['cards_title_1'] : '';
                        $title_line_2 = isset($widget['cards_title_2']) ? $widget['cards_title_2'] : '';
                        $left_image = isset($widget['cards_image']) ? $widget['cards_image'] : null;
                        $cards = isset($widget['cards_list']) ? $widget['cards_list'] : array();
                        $cta_label = isset($widget['cards_cta_label']) ? $widget['cards_cta_label'] : '';
                        $cta_url = isset($widget['cards_cta_url']) ? $widget['cards_cta_url'] : '';
                        ?>
                        <section class="widget favorite-cards-widget widget">
                            <div class="my-favorite-cards widget">
                                <div class="my-favorite-cards__left-col">
                                    <?php if ($title_line_1 || $title_line_2): ?>
                                        <h2 class="my-favorite-cards__title">
                                            <?php if ($title_line_1): ?><span class="styled"><?= $title_line_1 ?></span><?php endif; ?>
                                            <?php if ($title_line_2): ?><br /><span><?= $title_line_2 ?></span><?php endif; ?>
                                        </h2>
                                    <?php endif; ?>

                                    <?php if ($left_image && isset($left_image['url'])): ?>
                                        <img class="my-favorite-cards__image" src="<?= esc_url($left_image['url']) ?>"
                                            alt="<?= esc_attr($left_image['alt'] ?? '') ?>">
                                    <?php endif; ?>
                                </div>

                                <?php if ($cards && is_array($cards)): ?>
                                    <div class="my-favorite-cards__right-col">
                                        <div class="my-favorite-cards__cards">
                                            <?php foreach ($cards as $card): ?>
                                                <?php if (isset($card['card_option']) && isset($all_cards[$card['card_option']])): ?>
                                                    <div class="my-favorite-cards__card">
                                                        <div class="my-favorite-cards__card-img">
                                                            <img src="<?= esc_url($all_cards[$card['card_option']]["cci_card_image"]["url"]) ?>"
                                                                alt="<?= $all_cards[$card['card_option']]["cci_card_name"] ?>">
                                                        </div>
                                                        <div class="my-favorite-cards__card-content">
                                                            <h2 class="my-favorite-cards__card-title">
                                                                <?= $all_cards[$card['card_option']]["cci_card_name"] ?>
                                                            </h2>
<?php if (!empty($all_cards[$card['card_option']]["offer_points"])): ?>
  <h3 class="my-favorite-cards__card-offer">
      <?= $all_cards[$card['card_option']]["offer_points"] ?> POINTS
  </h3>
<?php elseif (!empty($all_cards[$card['card_option']]["cci_current_offer"])): ?>
  <h3 class="my-favorite-cards__card-offer">
      <?= $all_cards[$card['card_option']]["cci_current_offer"] ?>
  </h3>
<?php endif; ?>
                                                            <a class="btn my-favorite-cards__card-cta"
                                                                href="<?= esc_url($all_cards[$card['card_option']]["cci_learn_more_link"]) ?>"
                                                                target="_blank" rel="noopener noreferrer">
                                                                Learn More <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                            </a><br>
                                                            <?php
                                                            // Check if terms apply is set to "Yes"
                                                            if (isset($all_cards[$card['card_option']]['cci_terms_apply']) && $all_cards[$card['card_option']]['cci_terms_apply'] === 'Yes'):
                                                                // Check if we have a rates and fees URL
                                                                $rates_fees_url = !empty($all_cards[$card['card_option']]['cci_rates_and_fees']) ?
                                                                    esc_url($all_cards[$card['card_option']]['cci_rates_and_fees']) : '';
                                                                ?>
                                                                <?php if (!empty($rates_fees_url)): ?>
                                                                    <a class="my-favorite-cards__card-rates" href="<?= $rates_fees_url ?>"
                                                                        target="_blank" rel="noopener noreferrer">
                                                                        Terms Apply / Rates &amp; Fees
                                                                    </a>
                                                                <?php endif; ?>
                                                                <br>
                                                            <?php endif; ?>
                                                            <?= isset($all_cards[$card['card_option']]["affiliate"]) ? $all_cards[$card['card_option']]["affiliate"] : '' ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>

                                        <?php if ($cta_label && $cta_url): ?>
                                            <a class="btn my-favorite-cards__cta" href="<?= esc_url($cta_url) ?>" target="_blank"
                                                rel="noopener noreferrer">
                                                <span><?= $cta_label ?></span> <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </section>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </aside><!-- #secondary -->
    </div>
</div>