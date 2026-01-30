<?php
require 'credit-cards/credit-cards.php';
require 'credit-card-hero/credit-card-hero.php';
require 'destinations-map/destinations-map.php';
require 'hero-image/hero-image.php';
require 'favorite-cards/favorite-cards.php';
require 'course-library/course-library.php';
require 'success-stories/success-stories.php';
require 'lets-connect/lets-connect.php';
require 'hero-content/hero-content.php';
require 'free-resources/free-resources.php';
require 'free-resources-list/free-resources-list.php';
require 'free-consultation/free-consultation.php';
require 'the-blog/the-blog.php';
require 'newsletter/newsletter.php';
require 'about-kam/about-kam.php';
require 'contact-form/contact-form.php';
require 'start-here/start-here.php';
require 'must-read/must-read.php';
require 'about-kam-widget/about-kam-widget.php';
require 'banner-cta-widget/banner-cta-widget.php';
require 'time-line/time-line.php';
require 'unique-card/unique-card.php';
require 'box-grid/box-grid.php';
require 'extra-benefits/extra-benefits.php';
require 'favorite-things/favorite-things.php';
require 'rotating-words/rotating-words.php';
require 'enchanting-links/enchanting-links.php';
require 'instagram-cb/instagram-cb.php';
require 'sidebar-block/sidebar-block.php';

// REGISTER STYLES AND SCRIPTS FOR CUSTOM BLOCKS
function custom_blocks_scripts()
{
	wp_enqueue_style('credit-cards-block-style', esc_url(get_stylesheet_directory_uri() . '/custom-blocks/styles.css'), array(), _S_VERSION);
}
add_action('wp_enqueue_scripts', 'custom_blocks_scripts');