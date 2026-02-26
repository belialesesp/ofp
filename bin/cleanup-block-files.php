<?php
/**
 * Deletes the legacy registration .php file from each migrated block folder.
 * Only deletes files that match the pattern: custom-blocks/{slug}/{slug}.php
 * Templates, CSS, JS and other files are preserved.
 *
 * Usage (from theme root):
 *   php bin/cleanup-block-files.php --dry-run
 *   php bin/cleanup-block-files.php
 *   php bin/cleanup-block-files.php --block=newsletter
 *
 * Location: /bin/cleanup-block-files.php
 */

// ----------------------------------------------------------------
// Config
// ----------------------------------------------------------------
$theme_dir      = dirname( __DIR__ );
$blocks_src_dir = $theme_dir . '/custom-blocks';
$migrated_dir   = $theme_dir . '/inc/blocks/blocks';

// ----------------------------------------------------------------
// Parse CLI args
// ----------------------------------------------------------------
$opts         = getopt( '', [ 'dry-run', 'block:' ] );
$dry_run      = isset( $opts['dry-run'] );
$single_block = $opts['block'] ?? null;

// ----------------------------------------------------------------
// Helpers
// ----------------------------------------------------------------
function log_line( string $msg ): void  { echo $msg . PHP_EOL; }
function log_ok( string $msg ): void    { echo "\033[32m✔  {$msg}\033[0m" . PHP_EOL; }
function log_warn( string $msg ): void  { echo "\033[33m⚠  {$msg}\033[0m" . PHP_EOL; }
function log_skip( string $msg ): void  { echo "\033[90m⏭  {$msg}\033[0m" . PHP_EOL; }
function log_error( string $msg ): void { echo "\033[31m✖  {$msg}\033[0m" . PHP_EOL; }

// ----------------------------------------------------------------
// Main
// ----------------------------------------------------------------
log_line( '' );
log_line( $dry_run ? '=== DRY RUN — no files will be deleted ===' : '=== OFP Block Cleanup ===' );
log_line( '' );

$dirs    = glob( $blocks_src_dir . '/*', GLOB_ONLYDIR );
$deleted = [];
$skipped = [];
$errors  = [];

foreach ( $dirs as $block_dir ) {
    $slug = basename( $block_dir );

    if ( $single_block && $slug !== $single_block ) {
        continue;
    }

    $legacy_file   = "{$block_dir}/{$slug}.php";
    $migrated_file = "{$migrated_dir}/class-ofp-block-{$slug}.php";

    // Only delete if the migrated class exists
    if ( ! file_exists( $migrated_file ) ) {
        log_skip( "No migrated class found for '{$slug}' — skipping." );
        $skipped[] = $slug;
        continue;
    }

    // Nothing to delete
    if ( ! file_exists( $legacy_file ) ) {
        log_skip( "Already clean: {$slug}" );
        $skipped[] = $slug;
        continue;
    }

    if ( $dry_run ) {
        log_line( "Would delete: custom-blocks/{$slug}/{$slug}.php" );
        $deleted[] = $slug;
        continue;
    }

    if ( unlink( $legacy_file ) ) {
        log_ok( "Deleted: custom-blocks/{$slug}/{$slug}.php" );
        $deleted[] = $slug;
    } else {
        log_error( "Could not delete: custom-blocks/{$slug}/{$slug}.php" );
        $errors[] = $slug;
    }
}

// ----------------------------------------------------------------
// Summary
// ----------------------------------------------------------------
log_line( '' );
log_line( '========================================' );
log_line( '  Summary' );
log_line( '========================================' );
log_ok( ( $dry_run ? 'Would delete' : 'Deleted' ) . ': ' . count( $deleted ) . ' file(s)' );

if ( $skipped ) {
    log_skip( 'Skipped : ' . count( $skipped ) . ' (no legacy file or no migrated class)' );
}

if ( $errors ) {
    log_error( 'Errors  : ' . implode( ', ', $errors ) );
}

log_line( '' );