<?php
/**
 * Block Registration Helper
 *
 * Provides a generic register function and a shared render callback
 * used by all ACF custom blocks, eliminating duplicated boilerplate.
 */

/**
 * Generic render callback for all ACF custom blocks.
 *
 * Resolves the block slug from its name and includes the matching template file.
 *
 * @param array $block The block settings and attributes.
 */
function custom_block_render( $block ) {
  $slug = str_replace( 'acf/', '', $block['name'] );
  $template = get_theme_file_path( "/custom-blocks/{$slug}/{$slug}-template.php" );

  if ( file_exists( $template ) ) {
    include $template;
  }
}

/**
 * Register a single ACF custom block.
 *
 * @param array $config {
 *   @type string   $name        Block slug, e.g. 'hero-content'.
 *   @type string   $title       Human-readable block title.
 *   @type string   $description Optional. Defaults to "Block to show {title}.".
 *   @type string   $icon        Dashicon slug, e.g. 'schedule'.
 *   @type string[] $keywords    Array of search keywords.
 * }
 */
function register_custom_block( array $config ) {
  if ( ! function_exists( 'acf_register_block' ) ) {
    return;
  }

  $name = $config['name'];

  acf_register_block( array(
    'name'            => $name,
    'title'           => __( $config['title'] ),
    'description'     => __( $config['description'] ?? "Block to show {$config['title']}." ),
    'render_callback' => 'custom_block_render',
    'category'        => 'formatting',
    'icon'            => $config['icon'] ?? 'admin-generic',
    'keywords'        => $config['keywords'] ?? array(),
  ) );
}