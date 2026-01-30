<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package our-family-passport
 */
get_header();
?>
<main id="primary" class="site-main archives-page container">
	<?php if (have_posts()) : ?>
		<header class="archives-header">
			<?php
			the_archive_title('<h1 class="archives-title">', '</h1>');
			?>
		</header><!-- .page-header -->
		<div class="archive-posts">
			<?php
			/* Start the Loop */
			while (have_posts()) :
				the_post();
			?>
				<div class="post">
					<div class="post__image">
						<?php echo the_post_thumbnail('full'); ?>
					</div>
					<?php echo the_title('<h2 class="post__title">', '</h2>'); ?>
					<a class="post__cta" href="<?php echo get_permalink(); ?>">
						<span>Read Post</span>
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<mask id="mask0_4328_198" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
								<rect width="16" height="16" fill="#66B1BB" />
							</mask>
							<g mask="url(#mask0_4328_198)">
								<path d="M10.7827 8.66406H2.66602V7.33073H10.7827L7.04935 3.5974L7.99935 2.66406L13.3327 7.9974L7.99935 13.3307L7.04935 12.3974L10.7827 8.66406Z" fill="#66B1BB" />
							</g>
						</svg>
					</a>
				</div>
			<?php
			endwhile;
			?>
		</div>
		
		<!-- Navegação customizada com ordem NEWER - OLDER -->
		<?php
		global $wp_query;
		if ($wp_query->max_num_pages > 1) :
			$next_link = get_next_posts_link('Older Posts');
			$prev_link = get_previous_posts_link('Newer Posts');
			
			if ($prev_link || $next_link) :
		?>
		<nav class="navigation posts-navigation" aria-label="Posts">
			<div class="nav-links">
				<?php if ($prev_link) : ?>
					<div class="nav-previous"><?php echo $prev_link; ?></div>
				<?php endif; ?>
				
				<?php if ($next_link) : ?>
					<div class="nav-next"><?php echo $next_link; ?></div>
				<?php endif; ?>
			</div>
		</nav>
		<?php 
			endif;
		endif;
		?>
		
	<?php
	else :
		get_template_part('template-parts/content', 'none');
	endif;
	?>
</main><!-- #main -->
<?php
// get_sidebar();
get_footer();
?>