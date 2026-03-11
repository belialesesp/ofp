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