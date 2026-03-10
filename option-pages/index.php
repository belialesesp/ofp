<?php
add_action('acf/init', function() {
// REGISTER OPTION PAGES
if (function_exists('acf_add_options_page')) {

  acf_add_options_page(array(
    'page_title'    => 'Theme Options',
    'menu_title'    => 'Theme Options',
    'menu_slug'     => 'ofp-options',
    'capability'    => 'edit_posts',
    'redirect'      => false
  ));

  //  ADD A SUBPAGES
  // acf_add_options_sub_page(array(
  //   'page_title'    => 'Credit Cards',
  //   'menu_title'    => 'Credit Cards',
  //   'menu_slug'     => 'credit-cards-settings',
  //   'parent_slug'   => 'ofp-options',
  //   'capability'    => 'edit_posts',
  //   'redirect'      => false
  // ));
  
  acf_add_options_sub_page(array(
    'page_title'    => 'Map Setting',
    'menu_title'    => 'Map Settings',
    'menu_slug'     => 'map-settings',
    'parent_slug'   => 'ofp-options',
  ));

  acf_add_options_sub_page(array(
    'page_title'    => 'Pop-Ups',
    'menu_title'    => 'Pop-Ups',
    'menu_slug'     => 'pop-ups',
    'parent_slug'   => 'ofp-options',
  ));
  
  acf_add_options_sub_page(array(
    'page_title'    => 'Success Stories',
    'menu_title'    => 'Success Stories',
    'menu_slug'     => 'success-stories',
    'parent_slug'   => 'ofp-options',
  ));
  
  acf_add_options_sub_page(array(
    'page_title'    => 'Let\'s Connect',
    'menu_title'    => 'Let\'s Connect',
    'menu_slug'     => 'lets-connect',
    'parent_slug'   => 'ofp-options',
  ));
  
  acf_add_options_sub_page(array(
    'page_title'    => 'Free Resources',
    'menu_title'    => 'Free Resources',
    'menu_slug'     => 'free-resources',
    'parent_slug'   => 'ofp-options',
  ));

  acf_add_options_sub_page(array(
    'page_title'    => 'Free Consultation',
    'menu_title'    => 'Free Consultation',
    'menu_slug'     => 'free-consultation',
    'parent_slug'   => 'ofp-options',
  ));
  
  acf_add_options_sub_page(array(
    'page_title'    => 'Newsletter',
    'menu_title'    => 'Newsletter',
    'menu_slug'     => 'newsletter',
    'parent_slug'   => 'ofp-options',
  ));

  acf_add_options_sub_page(array(
    'page_title'  => 'Favorite Cards',
    'menu_title'  => 'Favorite Cards',
    'menu_slug'   => 'favorite-cards',
    'parent_slug' => 'ofp-options',
  ));

}
});
// Import pages Options
require 'credit-cards.php';
require 'map-settings.php';
require 'success-stories.php';
require 'lets-connect.php';
require 'free-resources.php';
require 'newsletter.php';
require 'free-consultation.php';
require 'favorite-cards.php';