<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package our-family-passport
 */
get_header();
?>

<main id="primary" class="site-main">
    <div class="error-404-container container">
        <div class="error-404-content">
            <h1 class="error-404-title">Ooops!</h1>
            <h2 class="error-404-subtitle">We can't seem to find the page you're looking for. Do you want to go back to <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>?</h2>
            
            <p class="error-code">Error code: 404</p>
        </div>
    </div>
</main>

<?php
get_footer();