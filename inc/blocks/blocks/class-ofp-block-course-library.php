<?php
/**
 * Course Library Block
 *
 * Migrated from: /custom-blocks/course-library/course-library.php
 * Location:      /inc/blocks/blocks/class-ofp-block-course-library.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Course_Library extends OFP_Block_Base {

    protected string $name        = 'course-library';
    protected string $title       = 'Course Library';
    protected string $description = 'Block to show a Course Library.';
    protected string $icon        = 'category';
    protected array  $keywords    = [ 'course', 'library', 'banner' ];
    protected string $js_file     = '/custom-blocks/course-library/course-library.js';
}