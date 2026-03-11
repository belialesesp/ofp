<?php
/**
 * Performance — Cache-Control headers via PHP
 *
 * Used as a fallback when .htaccess directives are overridden by the
 * server-level LiteSpeed cache (DreamHost shared hosting).
 *
 * The send_headers hook fires before output is sent, giving WordPress
 * a chance to set headers even on pages served by LiteSpeed.
 *
 * @package our-family-passport
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'send_headers', function (): void {
// =============================================================================
// 1. Dequeue dashicons for non-logged-in visitors
//    Dashicons is only needed in the admin bar (logged-in users).
//    Saves 35 KiB of render-blocking CSS for all anonymous visitors.
// =============================================================================
add_action( 'wp_enqueue_scripts', function (): void {
    if ( ! is_user_logged_in() ) {
        wp_dequeue_style( 'dashicons' );
    }
} );

// =============================================================================
// 2. Preconnect hints for third-party origins
//    Tells the browser to open connections to Flodesk and Google Fonts
//    as early as possible, reducing connection overhead for these resources.
// =============================================================================
add_action( 'wp_head', function (): void {
    echo '<link rel="preconnect" href="https://assets.flodesk.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://form.flodesk.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1 );

// =============================================================================
// 3. Long browser cache for static assets via .htaccess headers
//    The WP Super Cache page cache serves HTML — but images, fonts, CSS and JS
//    still go through Apache. This filter adds far-future Expires headers so
//    browsers cache static files for 1 year on repeat visits.
//    Note: the existing Cache-Control headers above handle HTML pages only.
// =============================================================================
add_filter( 'wp_headers', function ( array $headers ): array {
    if ( is_admin() || is_user_logged_in() ) {
        return $headers;
    }
    // Only apply to static asset requests (not HTML pages handled above).
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    if ( preg_match( '/\.(css|js|woff2?|otf|ttf|eot|png|jpg|jpeg|gif|svg|webp|ico)(\?.*)?$/i', $uri ) ) {
        $headers['Cache-Control'] = 'public, max-age=31536000, immutable';
    }
    return $headers;
} );

    // ------------------------------------------------------------------
    // 1. No-cache: login page and admin area
    //    Prevents caching of authenticated/sensitive responses.
    // ------------------------------------------------------------------
    $pagenow = $GLOBALS['pagenow'] ?? '';

    if ( is_admin() || $pagenow === 'wp-login.php' ) {
        header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
        header( 'Pragma: no-cache' );
        return;
    }

    // ------------------------------------------------------------------
    // 2. No-cache: REST API and AJAX requests
    //    Dynamic responses must never be served stale.
    // ------------------------------------------------------------------
    if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
        header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
        return;
    }

    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
        header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
        return;
    }

    // ------------------------------------------------------------------
    // 3. No-cache: logged-in users
    //    Personalized pages (account, dashboard, etc.) must not be cached.
    // ------------------------------------------------------------------
    if ( is_user_logged_in() ) {
        header( 'Cache-Control: private, no-store, no-cache, must-revalidate, max-age=0' );
        return;
    }

    // ------------------------------------------------------------------
    // 4. No-cache: search results, 404, and preview pages
    // ------------------------------------------------------------------
    if ( is_search() || is_404() || is_preview() ) {
        header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
        return;
    }

    // ------------------------------------------------------------------
    // 5. Short cache: front page and blog index
    //    Updated frequently; 10 min browser, 1 hour shared/CDN.
    // ------------------------------------------------------------------
    if ( is_front_page() || is_home() ) {
        header( 'Cache-Control: public, max-age=600, s-maxage=3600, stale-while-revalidate=60' );
        return;
    }

    // ------------------------------------------------------------------
    // 6. Medium cache: archive and category pages
    //    Less volatile than the homepage; 30 min browser, 2 hours shared.
    // ------------------------------------------------------------------
    if ( is_archive() || is_category() || is_tag() ) {
        header( 'Cache-Control: public, max-age=1800, s-maxage=7200, stale-while-revalidate=120' );
        return;
    }

    // ------------------------------------------------------------------
    // 7. Long cache: singular posts and pages
    //    Rarely changed after publishing; 1 hour browser, 24 hours shared.
    // ------------------------------------------------------------------
    if ( is_singular() ) {
        header( 'Cache-Control: public, max-age=3600, s-maxage=86400, stale-while-revalidate=300' );
        return;
    }
} );