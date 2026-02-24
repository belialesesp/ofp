<?php
$background_type = get_field('background_type');
$background_color = get_field('background_color');
$section_style = '';
if ($background_type === 'color' && $background_color) {
    $section_style = 'style="background-color:' . esc_attr($background_color) . ';"';
}

// Get all cards data from Custom Post Type (same as favorite-cards template)
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
            'cci_learn_more_link' => $card_info['cci_learn_more_link'] ?? null,
            'cci_terms_apply' => $card_info['cci_terms_apply'] ?? null,
            'cci_rates_and_fees' => $card_info['cci_rates_and_fees'] ?? null,
            'affiliate' => $card_info['affiliate'] ?? null,
            'cci_card_type' => $card_info['cci_card_type'] ?? null,
            'cci_annual_fee' => $card_info['cci_annual_fee'] ?? null,
            'cci_little_blurb' => $card_info['cci_little_blurb'] ?? null,
            'offer_points' => $card_info['offer_points'] ?? null // Campo específico para este template
        );
    }
    wp_reset_postdata();
}
?>
<section class="favorite-cards-section" <?php echo $section_style; ?>>
    <div class="container">
        <div class="section-header">
            <div class="title">
                <h2>
                    <span class="first-line"><?php the_field('title_line_1'); ?></span>
                    <span class="second-line">
                    <?php if ($left_image = get_field('left_image')) : ?>
                        <div class="left-image">
                            <img src="<?php echo esc_url($left_image['url']); ?>" alt="<?php echo esc_attr($left_image['alt']); ?>">
                        </div>
                    <?php endif; ?>                    
                    <?php the_field('title_line_2'); ?></span>
                </h2>
            </div>
        </div>
        <div class="cards-wrapper">
            <?php if (have_rows('favorite_cards')) :
                while (have_rows('favorite_cards')) : the_row();
                    $card_option = get_sub_field('fc_card_option');
                    
                    // Verificar se o card existe e se o ID é válido
                    if (!empty($card_option) && $card_option !== '0' && isset($all_cards[intval($card_option)])) :
                        $card = $all_cards[intval($card_option)];
                        ?>
                        <div class="card-item">
                            <?php if (!empty($card['cci_card_image']['url'])) : ?>
                                <div class="card-image">
                                    <img src="<?php echo esc_url($card['cci_card_image']['url']); ?>" alt="<?php echo esc_attr($card['cci_card_name']); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="card-info">
                                <?php if (!empty($card['cci_card_name'])) : ?>
                                    <h3><?php echo esc_html($card['cci_card_name']); ?></h3>
                                <?php endif; ?>
                                <?php if (!empty($card['offer_points'])) : ?>
                                    <p><strong><?php echo esc_html($card['offer_points']); ?> POINTS</strong></p>
                                <?php elseif (!empty($card['cci_current_offer'])) : ?>
                                    <p><strong><?php echo esc_html($card['cci_current_offer']); ?></strong></p>
                                <?php endif; ?>
                                <?php 
                                // Priorizar learn_more_link do ACF, senão usar permalink do CPT
                                $learn_more_url = !empty($card['cci_learn_more_link']) ? $card['cci_learn_more_link'] : get_permalink(intval($card_option));
                                ?>
                                <a href="<?php echo esc_url($learn_more_url); ?>" class="learn-more">
                                    Learn More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endif;
                endwhile;
            endif; ?>
        </div>
    </div>
</section>