<?php
/**
 * Block Registry — discovers and initializes all OFP blocks.
 *
 * Usage in functions.php:
 *   OFP_Block_Registry::instance()->init();
 *
 * Location: /inc/blocks/class-ofp-block-registry.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Registry {

    /** @var OFP_Block_Registry|null */
    private static ?OFP_Block_Registry $instance = null;

    /** @var OFP_Block_Base[] */
    private array $blocks = [];

    private function __construct() {}

    public static function instance(): self {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Load all block class files and initialize them.
     */
    public function init(): void {
        $this->load_block_classes();

        foreach ( $this->blocks as $block ) {
            $block->init();
        }
    }

    /**
     * Scans /inc/blocks/blocks/ for class-ofp-block-*.php files and
     * instantiates each one.
     *
     * File naming convention:
     *   class-ofp-block-newsletter.php  →  OFP_Block_Newsletter
     *   class-ofp-block-lets-connect.php → OFP_Block_Lets_Connect
     */
    private function load_block_classes(): void {
        $block_dir = get_template_directory() . '/inc/blocks/blocks/';
        $files     = glob( $block_dir . 'class-ofp-block-*.php' );

        if ( empty( $files ) ) {
            return;
        }

        foreach ( $files as $file ) {
            require_once $file;

            // Derive class name from filename
            // class-ofp-block-lets-connect.php → OFP_Block_Lets_Connect
            $basename   = basename( $file, '.php' );           // class-ofp-block-lets-connect
            $suffix     = str_replace( 'class-ofp-block-', '', $basename ); // lets-connect
            $class_name = 'OFP_Block_' . str_replace(
                ' ',
                '_',
                ucwords( str_replace( '-', ' ', $suffix ) )
            );                                                  // OFP_Block_Lets_Connect

            if ( class_exists( $class_name ) ) {
                $this->blocks[ $suffix ] = new $class_name();
            }
        }
    }

    /**
     * Retrieve a registered block instance by slug.
     *
     * @param string $slug e.g. 'newsletter'
     * @return OFP_Block_Base|null
     */
    public function get( string $slug ): ?OFP_Block_Base {
        return $this->blocks[ $slug ] ?? null;
    }

    /**
     * Return all registered block instances.
     *
     * @return OFP_Block_Base[]
     */
    public function all(): array {
        return $this->blocks;
    }
}