<?php
/**
 * ACF Block migration script — plain PHP, no WP-CLI required.
 *
 * Usage (from the theme root):
 *   php bin/migrate-blocks.php
 *   php bin/migrate-blocks.php --dry-run
 *   php bin/migrate-blocks.php --block=about-kam
 *   php bin/migrate-blocks.php --block=about-kam --dry-run
 *
 * Location: /bin/migrate-blocks.php
 */

// ----------------------------------------------------------------
// Bootstrap — resolve theme root regardless of cwd
// ----------------------------------------------------------------
$theme_dir      = dirname( __DIR__ );
$blocks_src_dir = $theme_dir . '/custom-blocks';
$output_dir     = $theme_dir . '/inc/blocks/blocks';
$index_file     = $theme_dir . '/inc/blocks/index.php';

// ----------------------------------------------------------------
// Parse CLI args
// ----------------------------------------------------------------
$opts        = getopt( '', [ 'dry-run', 'block:' ] );
$dry_run     = isset( $opts['dry-run'] );
$single      = $opts['block'] ?? null;

// ----------------------------------------------------------------
// Config
// ----------------------------------------------------------------

// These blocks have inline ACF fields or complex logic — the class
// will be generated but flagged with @todo for manual review.
$needs_review = [
    'lets-connect',
    'sidebar-block',
    'ofp-calculator',
    'time-line',
    'credit-cards',
    'success-stories',
];

// These entries inside /custom-blocks/ are not blocks — skip them.
$skip = [
    'search',   // registered differently in functions.php
    'non-affiliate-disclosure',
];

// ----------------------------------------------------------------
// Helpers
// ----------------------------------------------------------------

function slug_to_class( string $slug ): string {
    return 'OFP_Block_' . str_replace( ' ', '_', ucwords( str_replace( '-', ' ', $slug ) ) );
}

function slug_to_filename( string $slug ): string {
    return "class-ofp-block-{$slug}.php";
}

function extract_field( string $source, string $field ): string {
    // Handles __('value') and plain 'value'
    if ( preg_match( "/['\"]?{$field}['\"]?\s*=>\s*__\(\s*['\"](.+?)['\"]/", $source, $m ) ) {
        return $m[1];
    }
    if ( preg_match( "/['\"]?{$field}['\"]?\s*=>\s*['\"](.+?)['\"]/", $source, $m ) ) {
        return $m[1];
    }
    return '';
}

function extract_keywords( string $source ): array {
    if ( ! preg_match( "/'keywords'\s*=>\s*array\((.+?)\)/s", $source, $m ) ) {
        return [];
    }
    preg_match_all( "/['\"](.+?)['\"]/", $m[1], $kw );
    return $kw[1] ?? [];
}

function extract_supports( string $source ): ?string {
    if ( ! preg_match( "/'supports'\s*=>\s*array\((.+?)\)/s", $source, $m ) ) {
        return null;
    }
    // Convert old array() syntax to short [] syntax
    $raw = trim( preg_replace( '/\s+/', ' ', $m[1] ) );
    return $raw;
}

function find_asset( string $block_dir, string $slug, string $ext ): string {
    $candidates = [ "{$slug}.{$ext}", "_{$slug}.{$ext}" ];
    foreach ( $candidates as $c ) {
        if ( file_exists( "{$block_dir}/{$c}" ) ) {
            return "/custom-blocks/{$slug}/{$slug}.{$ext}";
        }
    }
    return '';
}

function has_inline_fields( string $source ): bool {
    return strpos( $source, 'acf_add_local_field_group' ) !== false;
}

function has_admin_css( string $source ): bool {
    return strpos( $source, 'admin_head' ) !== false;
}

function generate_class(
    string  $slug,
    string  $title,
    string  $description,
    string  $icon,
    array   $keywords,
    string  $css_file,
    string  $js_file,
    ?string $supports_raw,
    bool    $flag_review,
    bool    $flag_admin_css
): string {
    $class   = slug_to_class( $slug );
    $kw_php  = $keywords
        ? "[ '" . implode( "', '", $keywords ) . "' ]"
        : '[]';

    $todos = '';
    if ( $flag_review ) {
        $todos .= "\n * @todo Review: block had inline ACF fields.\n"
                . " *       Move acf_add_local_field_group() into register_fields()\n"
                . " *       and override init() to call parent::init() + \$this->register_fields().";
    }
    if ( $flag_admin_css ) {
        $todos .= "\n * @todo Review: block had admin_head CSS.\n"
                . " *       Move the <style> block into the admin_styles() method.";
    }

    $supports_line = '';
    if ( $supports_raw ) {
        $supports_line = "\n    protected array  \$supports    = [ {$supports_raw} ];";
    }

    $css_line = $css_file ? "\n    protected string \$css_file    = '{$css_file}';" : '';
    $js_line  = $js_file  ? "\n    protected string \$js_file     = '{$js_file}';"  : '';

    return <<<PHP
<?php
/**
 * {$title} Block
 *
 * Migrated from: /custom-blocks/{$slug}/{$slug}.php
 * Location:      /inc/blocks/blocks/class-ofp-block-{$slug}.php
 *{$todos}
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class {$class} extends OFP_Block_Base {

    protected string \$name        = '{$slug}';
    protected string \$title       = '{$title}';
    protected string \$description = '{$description}';
    protected string \$icon        = '{$icon}';
    protected array  \$keywords    = {$kw_php};{$supports_line}{$css_line}{$js_line}
}
PHP;
}

function log_line( string $msg ): void   { echo $msg . PHP_EOL; }
function log_ok( string $msg ): void     { echo "\033[32m✔  {$msg}\033[0m" . PHP_EOL; }
function log_warn( string $msg ): void   { echo "\033[33m⚠  {$msg}\033[0m" . PHP_EOL; }
function log_skip( string $msg ): void   { echo "\033[90m⏭  {$msg}\033[0m" . PHP_EOL; }
function log_error( string $msg ): void  { echo "\033[31m✖  {$msg}\033[0m" . PHP_EOL; }

// ----------------------------------------------------------------
// Main
// ----------------------------------------------------------------
log_line( '' );
log_line( $dry_run ? '=== DRY RUN — no files will be written ===' : '=== OFP Block Migration ===' );
log_line( '' );

if ( ! is_dir( $output_dir ) ) {
    if ( $dry_run ) {
        log_warn( "Output dir does not exist (would create): {$output_dir}" );
    } else {
        mkdir( $output_dir, 0755, true );
        log_ok( "Created directory: {$output_dir}" );
    }
}

$dirs     = glob( $blocks_src_dir . '/*', GLOB_ONLYDIR );
$migrated = [];
$skipped  = [];
$flagged  = [];

foreach ( $dirs as $block_dir ) {
    $slug = basename( $block_dir );

    if ( in_array( $slug, $skip, true ) ) {
        log_skip( "Skipped (excluded list): {$slug}" );
        $skipped[] = $slug;
        continue;
    }

    if ( $single && $slug !== $single ) {
        continue;
    }

    $php_file = "{$block_dir}/{$slug}.php";

    if ( ! file_exists( $php_file ) ) {
        log_warn( "No PHP file found for: {$slug} — skipping." );
        $skipped[] = $slug;
        continue;
    }

    $out_file = "{$output_dir}/" . slug_to_filename( $slug );

    if ( file_exists( $out_file ) && ! $single ) {
        log_skip( "Already migrated: {$slug}" );
        $skipped[] = $slug;
        continue;
    }

    $source      = file_get_contents( $php_file );
    $title       = extract_field( $source, 'title' )       ?: ucwords( str_replace( '-', ' ', $slug ) );
    $description = extract_field( $source, 'description' ) ?: "Block to show {$title}.";
    $icon        = extract_field( $source, 'icon' )        ?: 'layout';
    $keywords    = extract_keywords( $source );
    $supports    = extract_supports( $source );
    $css_file    = find_asset( $block_dir, $slug, 'css' );
    $js_file     = find_asset( $block_dir, $slug, 'js' );
    $flag        = in_array( $slug, $needs_review, true ) || has_inline_fields( $source );
    $adm_css     = has_admin_css( $source );

    $content = generate_class(
        $slug, $title, $description, $icon,
        $keywords, $css_file, $js_file,
        $supports, $flag, $adm_css
    );

    if ( $dry_run ) {
        log_line( "--- Would generate: " . slug_to_filename( $slug ) . " ---" );
        log_line( $content );
        log_line( '' );
    } else {
        file_put_contents( $out_file, $content );
        log_ok( "Generated: " . slug_to_filename( $slug ) );
    }

    $migrated[] = $slug;

    if ( $flag || $adm_css ) {
        $flagged[] = $slug;
    }
}

// ----------------------------------------------------------------
// Update index.php
// ----------------------------------------------------------------
if ( ! $dry_run && ! empty( $migrated ) && file_exists( $index_file ) ) {
    $index = file_get_contents( $index_file );

    foreach ( $migrated as $slug ) {
        $index = preg_replace(
            "/^(require[^;]+custom-blocks\/{$slug}\/{$slug}\.php[^;]*;)/m",
            '// $1 // ✅ migrated',
            $index
        );
    }

    file_put_contents( $index_file, $index );
    log_ok( 'Updated inc/blocks/index.php' );
}

// ----------------------------------------------------------------
// Summary
// ----------------------------------------------------------------
log_line( '' );
log_line( '========================================' );
log_line( '  Summary' );
log_line( '========================================' );
log_ok( 'Generated : ' . count( $migrated ) . ' block(s)' );

if ( $skipped ) {
    log_skip( 'Skipped   : ' . implode( ', ', $skipped ) );
}

if ( $flagged ) {
    log_line( '' );
    log_warn( 'Needs manual review (' . count( $flagged ) . '):' );
    foreach ( $flagged as $f ) {
        log_warn( "   {$f}" );
    }
    log_line( '   → Check @todo comments in the generated files.' );
}

log_line( '' );
log_line( 'Next steps:' );
log_line( '  1. Review flagged files in inc/blocks/blocks/' );
log_line( '  2. Test each block in the editor and front-end' );
log_line( '  3. Delete the original .php in /custom-blocks/{slug}/' );
log_line( '' );