<?php

/**
 * ACF Helpers
 *
 * Centralized helpers for ACF field retrieval, query caching,
 * and widget context management.
 *
 * @package our-family-passport
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// =============================================================================
// 1. CREDIT CARDS QUERY CACHE
//    Replaces the duplicated WP_Query found in:
//    - favorite-cards-template.php
//    - favorite-cards-small-template.php
//    - sidebar-block-template.php
//    - favorite-cards-widget.php
// =============================================================================

/**
 * Returns all credit cards indexed by post ID.
 * Uses a static cache so the database is only queried once per request.
 *
 * Usage in templates:
 *   $all_cards = ofp_get_all_credit_cards();
 *
 * @return array
 */
function ofp_get_all_credit_cards(): array {
    static $cache = null;

    if ( $cache !== null ) {
        return $cache;
    }

    $cache = [];

    $query = new WP_Query([
        'post_type'              => 'credit_cards',
        'posts_per_page'         => -1,
        'post_status'            => 'publish',
        'no_found_rows'          => true,
        'update_post_term_cache' => false,
        'update_post_meta_cache' => true,
    ]);

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $post_id = get_the_ID();

            $repeater = get_field( 'credit_cards', $post_id );
            $card     = ( is_array( $repeater ) && ! empty( $repeater ) ) ? $repeater[0] : [];

            $cache[ $post_id ] = [
                'cci_card_name'     => get_the_title(),
                'cci_card_image'    => $card['cci_card_image']    ?? null,
                'cci_current_offer' => $card['cci_current_offer'] ?? null,
                'offer_points'      => $card['offer_points']      ?? null,
                'cci_learn_more_link' => $card['cci_learn_more_link'] ?? null,
                'cci_terms_apply'   => $card['cci_terms_apply']   ?? null,
                'cci_rates_and_fees'=> $card['cci_rates_and_fees']?? null,
                'affiliate'         => $card['affiliate']         ?? null,
                'cci_card_type'     => $card['cci_card_type']     ?? null,
                'cci_annual_fee'    => $card['cci_annual_fee']    ?? null,
                'cci_little_blurb'  => $card['cci_little_blurb'] ?? null,
            ];
        }
        wp_reset_postdata();
    }

    return $cache;
}

// =============================================================================
// 2. OPTIONS PAGE FIELD CACHE
//    Prevents individual get_field() calls for each option field.
//    Examples of waste found in the project:
//    - free-resources-template.php  → 8 separate calls
//    - free-consultation-template.php → 9 separate calls
//    - lets-connect-template.php    → 5 separate calls
// =============================================================================

/**
 * Returns a group of ACF option fields in a single fetch, with static cache.
 *
 * @param string $option_key  Unique identifier for this group (used as cache key).
 * @param array  $field_names List of ACF field names to retrieve.
 * @return array
 */
function ofp_get_option_fields( string $option_key, array $field_names ): array {
    static $cache = [];

    if ( isset( $cache[ $option_key ] ) ) {
        return $cache[ $option_key ];
    }

    $data = [];
    foreach ( $field_names as $name ) {
        $data[ $name ] = get_field( $name, 'option' );
    }

    $cache[ $option_key ] = $data;
    return $data;
}

// -----------------------------------------------------------------------------
// Block-specific option wrappers
// -----------------------------------------------------------------------------

function ofp_get_free_resources_options(): array {
    return ofp_get_option_fields( 'free_resources', [
        'widget_float_icon',
        'widget_sub_title',
        'widget_title',
        'widget_description',
        'widget_images_position',
        'widget_space_between_resources',
        'widget_title_color',
        'widget_description_color',
        'widget_resources',
    ]);
}

function ofp_get_lets_connect_options(): array {
    return ofp_get_option_fields( 'lets_connect', [
        'lc_background_color',
        'lc_title',
        'lc_image',
        'lc_description',
        'lc_social_medias',
    ]);
}

function ofp_get_free_consultation_options(): array {
    return ofp_get_option_fields( 'free_consultation', [
        'widget_sub_title_left',
        'widget_title_left',
        'widget_title_right',
        'widget_description_right',
        'widget_cta_label_right',
        'widget_cta_url_right',
        'widget_background_color',
        'widget_box_background_color',
        'widget_text_color',
    ]);
}

// =============================================================================
// 3. WIDGET MODE CONTEXT — NO DATABASE WRITES
//    Replaces update_field('is_widget', true) in all widget classes.
//    update_field() triggers a database UPDATE on every page load — wrong.
// =============================================================================

/**
 * Sets the widget rendering context without writing to the database.
 *
 * @param bool $state
 */
function ofp_set_widget_mode( bool $state ): void {
    $GLOBALS['ofp_widget_mode'] = $state;
}

/**
 * Returns true when a block template is being rendered inside a widget.
 *
 * @return bool
 */
function ofp_is_widget_mode(): bool {
    return ! empty( $GLOBALS['ofp_widget_mode'] );
}

// =============================================================================
// 4. TRANSIENT CACHE FOR HEAVY CUSTOM QUERIES
//    For queries whose results rarely change (e.g. related posts).
// =============================================================================

/**
 * Returns related posts for a given post, cached via transients.
 * Cache is invalidated automatically when any post is saved.
 *
 * @param int $post_id     Current post ID.
 * @param int $qty         Number of related posts to return.
 * @param int $ttl_seconds Cache lifetime in seconds (default: 1 hour).
 * @return WP_Post[]
 */
function ofp_get_related_posts(
    int $post_id,
    int $qty = 3,
    string $selection = 'category',
    string $order_by = 'date',
    int $ttl_seconds = 3600
): array {
    $cache_key = "ofp_related_{$post_id}_{$qty}_{$selection}_{$order_by}";
    $cached    = get_transient( $cache_key );

    if ( $cached !== false ) {
        return $cached;
    }

    $posts = ofp_query_related_posts( $post_id, $qty, $selection, $order_by );

    // Fallback to category if tag/both returned nothing
    if ( empty( $posts ) && $selection !== 'category' ) {
        $posts = ofp_query_related_posts( $post_id, $qty, 'category', $order_by );
    }

    // Last resort: any recent posts
    if ( empty( $posts ) ) {
        $posts = ofp_query_related_posts( $post_id, $qty, 'none', $order_by );
    }

    set_transient( $cache_key, $posts, $ttl_seconds );

    return $posts;
}

/**
 * Executes the actual WP_Query for related posts.
 */
function ofp_query_related_posts(
    int $post_id,
    int $qty,
    string $selection,
    string $order_by
): array {
    $args = [
        'post_type'              => 'post',
        'posts_per_page'         => $qty,
        'post_status'            => 'publish',
        'post__not_in'           => [ $post_id ],
        'no_found_rows'          => true,
        'update_post_term_cache' => false,
        'orderby'                => $order_by,
    ];

    $tax_query = [ 'relation' => 'OR' ];

    if ( in_array( $selection, [ 'category', 'both' ], true ) ) {
        $category_ids = wp_list_pluck( get_the_category( $post_id ), 'term_id' );
        if ( $category_ids ) {
            $tax_query[] = [
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $category_ids,
            ];
        }
    }

    if ( in_array( $selection, [ 'tag', 'both' ], true ) ) {
        $tag_ids = wp_list_pluck( get_the_tags( $post_id ) ?: [], 'term_id' );
        if ( $tag_ids ) {
            $tax_query[] = [
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $tag_ids,
            ];
        }
    }

    if ( count( $tax_query ) > 1 ) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query( $args );
    $posts = $query->posts;
    wp_reset_postdata();

    return $posts;
}

/**
 * Invalidates related posts cache when a post is saved.
 */
add_action( 'save_post', function( int $post_id ): void {
    foreach ( [3, 4, 5, 6] as $qty ) {
        delete_transient( "ofp_related_{$post_id}_{$qty}" );
    }
});

// =============================================================================
// 5. POST META CACHE PRIMER — Prevents N+1 queries in loops
//    Call this before iterating over a list of posts that need ACF fields.
// =============================================================================

/**
 * Warms up the WordPress meta cache for a list of post IDs.
 * Fetches all post meta in a single query instead of one per post.
 *
 * Usage (before a foreach loop over posts):
 *   $post_ids = wp_list_pluck( $query->posts, 'ID' );
 *   ofp_prime_post_meta_cache( $post_ids );
 *   // All get_field() / get_post_meta() calls below will use the cache.
 *
 * @param int[] $post_ids
 */
function ofp_prime_post_meta_cache( array $post_ids ): void {
    if ( empty( $post_ids ) ) return;
    update_meta_cache( 'post', $post_ids );
}