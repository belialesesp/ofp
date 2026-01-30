<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package our-family-passport
 */

// Check if there's a sidebar block in the content
$has_sidebar_block = false;
if (is_singular() && has_blocks(get_the_content())) {
  $blocks = parse_blocks(get_the_content());
  foreach ($blocks as $block) {
    if ($block['blockName'] === 'acf/sidebar-block') {
      $has_sidebar_block = true;
      break;
    }
  }
}
?>

<article id="postPage post-<?= the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-content">
    <header class="entry-header">
      <?php 
        if ('post' === get_post_type()) :
        $categories = get_the_category();
        $count = 0;
      ?>
        <div class="entry-meta">
          <?php foreach($categories as $categorie): $count++; $cat = get_category( $categorie );?>
            <span><?= $cat->name ?></span>
            <?php if(count($categories) > 1 && count($categories) > $count) : ?>
              <span>•</span>
            <?php endif; ?>
          <?php endforeach; ?>
          <span>•</span>
          <?= our_family_passport_posted_on() ?>
        </div><!-- .entry-meta -->
      <?php endif; ?>

      <?php
      if (is_singular()) :
        the_title('<h1 class="entry-title">', '</h1>');
      else :
        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
      endif;
      ?>
    </header><!-- .entry-header -->
    <?php our_family_passport_post_thumbnail('full'); ?>
    <?php
    the_content(
      sprintf(
        wp_kses(
          /* translators: %s: Name of current post. Only visible to screen readers */
          __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'our-family-passport'),
          array(
            'span' => array(
              'class' => array(),
            ),
          )
        ),
        wp_kses_post(get_the_title())
      )
    );

    wp_link_pages(
      array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'our-family-passport'),
        'after'  => '</div>',
      )
    );
    ?>
  </div><!-- .entry-content -->

  <?php
  // Only show the default sidebar if there's no custom sidebar block
  if (!$has_sidebar_block): ?>
    <div class="sidebar">
      <?php get_sidebar(); ?>
    </div>
  <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->