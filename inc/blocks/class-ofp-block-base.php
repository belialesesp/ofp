<?php
/**
 * Abstract base class for all OFP ACF blocks.
 *
 * Each block extends this class and only overrides what is unique to it.
 * Location: /inc/blocks/class-ofp-block-base.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

abstract class OFP_Block_Base {

    /**
     * Block slug, e.g. 'newsletter', 'lets-connect'.
     * Must be defined in each child class.
     *
     * @var string
     */
    protected string $name;

    /**
     * Human-readable block title.
     *
     * @var string
     */
    protected string $title;

    /**
     * Block description shown in the editor.
     *
     * @var string
     */
    protected string $description = '';

    /**
     * Dashicons icon name, e.g. 'email-alt'.
     *
     * @var string
     */
    protected string $icon = 'layout';

    /**
     * Editor category for the block.
     *
     * @var string
     */
    protected string $category = 'formatting';

    /**
     * Search keywords for the block inserter.
     *
     * @var array
     */
    protected array $keywords = [];

    /**
     * Block supports options.
     *
     * @var array
     */
    protected array $supports = [
        'align' => false,
        'mode'  => 'edit',
        'jsx'   => true,
    ];

    /**
     * Path to the block's CSS file, relative to theme root.
     * Leave empty to skip enqueueing.
     *
     * @var string
     */
    protected string $css_file = '';

    /**
     * Path to the block's JS file, relative to theme root.
     * Leave empty to skip enqueueing.
     *
     * @var string
     */
    protected string $js_file = '';

    /**
     * Bootstrap the block: register ACF block + enqueue assets.
     */
    public function init(): void {
        add_action( 'acf/init',             [ $this, 'register' ] );
        add_action( 'wp_enqueue_scripts',   [ $this, 'enqueue_assets' ] );
        add_action( 'admin_head',           [ $this, 'admin_styles' ] );
    }

    /**
     * Register the ACF block.
     * Called on acf/init — override if your block needs extra args.
     */
    public function register(): void {
        if ( ! function_exists( 'acf_register_block_type' ) ) {
            return;
        }

        // Avoid double-registration
        if ( acf_get_block_type( "acf/{$this->name}" ) ) {
            return;
        }

        acf_register_block_type( [
            'name'            => $this->name,
            'title'           => __( $this->title, 'our-family-passport' ),
            'description'     => __( $this->description, 'our-family-passport' ),
            'render_callback' => [ $this, 'render' ],
            'category'        => $this->category,
            'icon'            => $this->icon,
            'keywords'        => $this->keywords,
            'supports'        => $this->supports,
        ] );
    }

    /**
     * Render callback: includes the block's template file.
     * Override if your block has a custom render logic.
     *
     * @param array $block ACF block data.
     */
    public function render( array $block ): void {
        $template = get_theme_file_path( "/custom-blocks/{$this->name}/{$this->name}-template.php" );

        if ( file_exists( $template ) ) {
            include $template;
        }
    }

    /**
     * Enqueue block CSS/JS only on pages that use this block.
     * Override to add extra assets or change conditions.
     */
    public function enqueue_assets(): void {
        $version = defined( 'OFP_VERSION' ) ? OFP_VERSION : wp_get_theme()->get( 'Version' );

        if ( $this->css_file && has_block( "acf/{$this->name}" ) ) {
            wp_enqueue_style(
                "ofp-block-{$this->name}",
                get_template_directory_uri() . $this->css_file,
                [],
                $version
            );
        }

        if ( $this->js_file && has_block( "acf/{$this->name}" ) ) {
            wp_enqueue_script(
                "ofp-block-{$this->name}",
                get_template_directory_uri() . $this->js_file,
                [ 'jquery' ],
                $version,
                true
            );
        }
    }

    /**
     * Hook point for block-specific admin <head> styles.
     * Override in child class if needed.
     */
    public function admin_styles(): void {
        // Override in child class if needed.
    }

    /**
     * Register ACF field group for this block.
     * Override in child class and call parent or self register_fields().
     * Not abstract so blocks without custom fields don't need to implement it.
     */
    protected function register_fields(): void {
        // Override in child class.
    }
}