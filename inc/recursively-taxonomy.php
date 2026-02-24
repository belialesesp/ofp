<?php 

/**
 * Recursively get taxonomy and its children
 *
 * @param string $taxonomy Taxonomy slug.
 * @param int $parent Parent term id.
 * @return array
 */

function get_taxonomy_hierarchy( $taxonomy, $parent = 0 ) {
    // Only 1 taxonomy.
    $taxonomy = is_array( $taxonomy ) ? array_shift( $taxonomy ) : $taxonomy;
    // Get all direct descendants of the $parent.
    $terms = get_terms( $taxonomy, [ 'parent' => $parent ] );
    // Prepare a new array. These are the children of $parent.
    // We'll ultimately copy all the $terms into this new array, but only after they
    // find their own children
    $children = [];
    // Go through all the direct descendants of $parent, and gather their children.
    foreach ( $terms as $term ){
        // Recurse to get the direct descendants of "this" term.
        $term->children = get_taxonomy_hierarchy( $taxonomy, $term->term_id );
        // Add the term to our new array.
        $children[ $term->term_id ] = $term;
    }
    // Send the results back to the caller.
    return $children;
}
/**
 * Recursively get given taxonomies' terms as complete hierarchies.
 *
 * @param string|array $taxonomies Taxonomy slugs.
 * @param int $parent - Starting parent term id
 *
 * @return array
 */
function get_taxonomy_hierarchy_multiple( $taxonomies, int $parent = 0 ) {
    if ( ! is_array( $taxonomies )  ) {
        $taxonomies = [ $taxonomies ];
    }
    $results = [];
    foreach( $taxonomies as $taxonomy ){
        $terms = get_taxonomy_hierarchy( $taxonomy, $parent );
        if ( $terms ) {
            $results[ $taxonomy ] = $terms;
        }
    }
    return $results;
}