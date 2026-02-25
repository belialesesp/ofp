
<?php
/**
 * Newsletter Block
 * Note: ACF fields managed via ACF UI.
 * Has dedicated JS + AJAX localization — override enqueue_assets().
 */
class OFP_Block_Newsletter extends OFP_Block_Base {
    protected string $name        = 'newsletter';
    protected string $title       = 'Newsletter';
    protected string $description = 'Block to show a Newsletter.';
    protected string $icon        = 'email-alt';
    protected array  $keywords    = [ 'newsletter', 'subscribe', 'email' ];

    public function enqueue_assets(): void {
        wp_enqueue_script(
            'ofp-block-newsletter',
            get_template_directory_uri() . '/custom-blocks/newsletter/newsletter.js',
            [ 'jquery' ],
            defined( 'OFP_VERSION' ) ? OFP_VERSION : wp_get_theme()->get( 'Version' ),
            true
        );
        wp_localize_script( 'ofp-block-newsletter', 'newsletter_ajax', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'newsletter_nonce' ),
        ] );
    }
}