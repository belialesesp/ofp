<?php
/**
 * Instagram DM Block Template
 *
 * Slider config: "instagram-dm-splide" (registered in ofp-functions.js).
 * No inline <script> needed — OFPSlider handles init centrally.
 *
 * Location: /custom-blocks/instagram-dm/instagram-dm-template.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'get_field' ) ) {
    echo '<p>Advanced Custom Fields is required for this block.</p>';
    return;
}

// ── Fields ────────────────────────────────────────────────────────────────────
$messages = get_field( 'messages' );
$blockID  = 'instagram-dm-' . uniqid();
?>

<div id="<?php echo esc_attr( $blockID ); ?>-container" class="instagram-dm">

    <div class="container">

        <?php if ( ! empty( $messages ) ) : ?>

            <div id="<?php echo esc_attr( $blockID ); ?>"
                 class="splide instagram-dm-splide instagram-dm__slider">

                <div class="splide__track">
                    <ul class="splide__list">

                        <?php foreach ( $messages as $message ) :
                            $text = $message['message'] ?? '';
                            if ( empty( $text ) ) continue;
                        ?>
                            <li class="splide__slide instagram-dm__slide">
                                <div class="dm-message">
                                    <div class="dm-bubble">
                                        <p class="dm-bubble__text">
                                            <?php echo wp_kses_post( $text ); ?>
                                        </p>
                                    </div>
                                    <div class="dm-heart" aria-hidden="true">❤️</div>
                                </div>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div><!-- /.splide__track -->

            </div><!-- /.splide -->

        <?php endif; ?>

    </div><!-- /.container -->

</div>