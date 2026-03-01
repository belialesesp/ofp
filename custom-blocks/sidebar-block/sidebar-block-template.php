<?php
$widgets  = get_field( 'sidebar_widgets' );
$all_cards = ofp_get_all_credit_cards();

$blockID       = 'custom-sidebar-' . uniqid();
$is_page       = is_page();
$sidebar_class = $is_page ? 'page-sidebar-block' : 'post-sidebar-block';
?>

<div class="sidebar-block-wrapper <?php echo esc_attr( $sidebar_class ); ?>">
    <div class="sidebar">
        <aside id="secondary" class="widget-area">
            <?php if ( $widgets && is_array( $widgets ) ) : ?>
                <?php foreach ( $widgets as $widget ) : ?>
                    <?php $widget_type = $widget['widget_type'] ?? ''; ?>

                    <?php /* ── About Kam ── */ ?>
                    <?php if ( $widget_type === 'about_kam' ) : ?>
                        <section class="widget widget_block">
                            <div class="wp-block-group">
                                <div class="wp-block-group__inner-container is-layout-flow wp-block-group-is-layout-flow">
                                    <div class="about-kam-widget">
                                        <?php if ( ! empty( $widget['about_image']['url'] ) ) : ?>
                                            <img decoding="async"
                                                 src="<?php echo esc_url( $widget['about_image']['url'] ); ?>"
                                                 alt="<?php echo esc_attr( $widget['about_image']['alt'] ?? '' ); ?>"
                                                 class="about-kam-widget__image">
                                        <?php endif; ?>

                                        <?php if ( ! empty( $widget['about_title'] ) ) : ?>
                                            <h2 class="about-kam-widget__title">
                                                <?php echo esc_html( $widget['about_title'] ); ?>
                                            </h2>
                                        <?php endif; ?>

                                        <?php if ( ! empty( $widget['about_description'] ) ) : ?>
                                            <div class="about-kam-widget__description">
                                                <?php echo wp_kses_post( $widget['about_description'] ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>

                    <?php /* ── Banner CTA ── */ ?>
                    <?php if ( $widget_type === 'banner_cta' ) : ?>
                        <?php $banner_id = 'banner-cta-' . uniqid(); ?>
                        <section class="widget widget_block">
                            <?php if ( ! empty( $widget['banner_background']['url'] ) ) : ?>
                                <style>
                                    #<?php echo esc_attr( $banner_id ); ?>-container {
                                        background-image: url(<?php echo esc_url( $widget['banner_background']['url'] ); ?>);
                                    }
                                </style>
                            <?php else : ?>
                                <style>
                                    #<?php echo esc_attr( $banner_id ); ?>-container {
                                        background: linear-gradient(-90deg, #fed7d8 0%, #f8c8b4 100%);
                                    }
                                </style>
                            <?php endif; ?>

                            <div id="<?php echo esc_attr( $banner_id ); ?>-container" class="banner-cta">
                                <?php if ( ! empty( $widget['banner_icon']['url'] ) ) : ?>
                                    <img decoding="async"
                                         src="<?php echo esc_url( $widget['banner_icon']['url'] ); ?>"
                                         alt="<?php echo esc_attr( $widget['banner_icon']['alt'] ?? '' ); ?>"
                                         class="banner-cta__icon">
                                <?php endif; ?>

                                <?php if ( ! empty( $widget['banner_title'] ) ) : ?>
                                    <h2 class="banner-cta__title" style="font-family: 'LeagueGothic', sans-serif; color: #ffffff; font-size: 36px; line-height: 36px;">
                                        <?php echo esc_html( $widget['banner_title'] ); ?>
                                    </h2>
                                <?php endif; ?>

                                <?php if ( ! empty( $widget['banner_description'] ) ) : ?>
                                    <div class="banner-cta__description" style="color: #222; font-size: 14px; line-height: 14px;">
                                        <?php echo wp_kses_post( $widget['banner_description'] ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( ! empty( $widget['banner_cta_label'] ) && ! empty( $widget['banner_cta_url'] ) ) : ?>
                                    <a href="<?php echo esc_url( $widget['banner_cta_url'] ); ?>"
                                       target="_blank" class="banner-cta__cta" style="background-color: #9bbfcd; color: #ffffff">
                                        <?php echo esc_html( $widget['banner_cta_label'] ); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <?php /* ── Favorite Cards ── */ ?>
                    <?php if ( $widget_type === 'favorite_cards' ) : ?>
                        <?php
                        $title_line_1 = $widget['cards_title_1'] ?? '';
                        $title_line_2 = $widget['cards_title_2'] ?? '';
                        $left_image   = $widget['cards_image']   ?? null;
                        $cards        = $widget['cards_list']    ?? array();
                        $cta_label    = $widget['cards_cta_label'] ?? '';
                        $cta_url      = $widget['cards_cta_url']   ?? '';
                        ?>
                        <section class="widget favorite-cards-widget widget">
                            <div class="my-favorite-cards widget">
                                <div class="my-favorite-cards__left-col">
                                    <?php if ( $title_line_1 || $title_line_2 ) : ?>
                                        <h2 class="my-favorite-cards__title">
                                            <?php if ( $title_line_1 ) : ?>
                                                <span class="styled"><?php echo esc_html( $title_line_1 ); ?></span>
                                            <?php endif; ?>
                                            <?php if ( $title_line_2 ) : ?>
                                                <br /><span><?php echo esc_html( $title_line_2 ); ?></span>
                                            <?php endif; ?>
                                        </h2>
                                    <?php endif; ?>

                                    <?php if ( $left_image && ! empty( $left_image['url'] ) ) : ?>
                                        <img class="my-favorite-cards__image"
                                             src="<?php echo esc_url( $left_image['url'] ); ?>"
                                             alt="<?php echo esc_attr( $left_image['alt'] ?? '' ); ?>">
                                    <?php endif; ?>
                                </div>

                                <?php if ( $cards && is_array( $cards ) ) : ?>
                                    <div class="my-favorite-cards__right-col">
                                        <div class="my-favorite-cards__cards">
                                            <?php foreach ( $cards as $card ) : ?>
                                                <?php if ( isset( $card['card_option'] ) && isset( $all_cards[ $card['card_option'] ] ) ) : ?>
                                                    <?php $cd = $all_cards[ $card['card_option'] ]; ?>
                                                    <div class="my-favorite-cards__card">
                                                        <div class="my-favorite-cards__card-img">
                                                            <?php if ( ! empty( $cd['cci_card_image']['url'] ) ) : ?>
                                                                <img src="<?php echo esc_url( $cd['cci_card_image']['url'] ); ?>"
                                                                     alt="<?php echo esc_attr( $cd['cci_card_name'] ?? '' ); ?>">
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="my-favorite-cards__card-content">
                                                            <h3 class="my-favorite-cards__card-title">
                                                                <?php echo esc_html( $cd['cci_card_name'] ?? '' ); ?>
                                                            </h3>
                                                            <?php if ( ! empty( $cd['offer_points'] ) ) : ?>
                                                                <p class="my-favorite-cards__card-offer">
                                                                    <?php echo esc_html( $cd['offer_points'] ); ?>
                                                                </p>
                                                            <?php endif; ?>
                                                            <a class="btn my-favorite-cards__card-cta"
                                                               href="<?php echo esc_url( $cd['cci_learn_more_link'] ?? '' ); ?>"
                                                               target="_blank" rel="noopener noreferrer">
                                                                Learn More <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                            </a><br>
                                                            <?php if ( ( $cd['cci_terms_apply'] ?? '' ) === 'Yes' && ! empty( $cd['cci_rates_and_fees'] ) ) : ?>
                                                                <a class="my-favorite-cards__card-rates"
                                                                   href="<?php echo esc_url( $cd['cci_rates_and_fees'] ); ?>"
                                                                   target="_blank" rel="noopener noreferrer">
                                                                    Terms Apply / Rates &amp; Fees
                                                                </a><br>
                                                            <?php endif; ?>
                                                            <?php if ( ! empty( $cd['affiliate'] ) ) : ?>
                                                                <div class="affiliate-info">
                                                                    <?php echo wp_kses_post( $cd['affiliate'] ); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>

                                        <?php if ( $cta_label && $cta_url ) : ?>
                                            <a class="btn my-favorite-cards__cta"
                                               href="<?php echo esc_url( $cta_url ); ?>"
                                               target="_blank" rel="noopener noreferrer">
                                                <span><?php echo esc_html( $cta_label ); ?></span>
                                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
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