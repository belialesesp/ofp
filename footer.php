<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package our-family-passport
 */
$socialMediaOpts = get_field( 'footer', 'option' ) ?: array();
$popUps          = get_field( 'pop-ups', 'option' ) ?: array();
$flodeskLoaded   = false; // Track if Flodesk universal script is loaded
?>

<?php foreach ( (array) $popUps as $popUp ) : ?>
	<?php if ( ! empty( $popUp['show_on_entire_site'] ) ) : ?>
		<?php
		$popupID              = 'popup-' . uniqid();
		$background_type      = $popUp['background_type']         ?? '';
		$background_color     = $popUp['background_color']        ?? '';
		$background_color_start = $popUp['background_color_start'] ?? '';
		$background_color_end   = $popUp['background_color_end']   ?? '';
		$rotation_deg         = $popUp['rotation_deg']            ?? 0;
		$background_image     = $popUp['background_image']        ?? array();
		?>

		<?php if ( $background_type === 'gradient' ) : ?>
			<style>
				#<?php echo esc_attr( $popupID ); ?> .right {
					background: linear-gradient(<?php echo absint( $rotation_deg ); ?>deg,
							<?php echo esc_attr( $background_color_start ); ?> 0%,
							<?php echo esc_attr( $background_color_end ); ?> 100%);
				}
			</style>
		<?php endif; ?>
		<?php if ( $background_type === 'image' ) : ?>
			<style>
				#<?php echo esc_attr( $popupID ); ?> .right {
					background-image: url(<?php echo esc_url( $background_image['url'] ?? '' ); ?>);
				}
			</style>
		<?php endif; ?>
		<?php if ( $background_type === 'color' ) : ?>
			<style>
				#<?php echo esc_attr( $popupID ); ?> .right {
					background-color: <?php echo esc_attr( $background_color ); ?>;
				}
			</style>
		<?php endif; ?>

		<div id="<?php echo esc_attr( $popupID ); ?>" class="pop-up">
			<div class="popup-box">
				<button class="close-btn"
				        onclick="javascript:close_pop_up('<?php echo esc_js( $popupID ); ?>')"
				        aria-label="<?php esc_attr_e( 'Close', 'our-family-passport' ); ?>">
					<span class="close-btn__x" aria-hidden="true"></span>
				</button>
				<div class="left" style="background-image: url(<?php echo esc_url( $popUp['left_image']['url'] ?? '' ); ?>);">
					<div class="circular-image" style="background-color: <?php echo esc_attr( $popUp['icon_image_background_color'] ?? '' ); ?>;">
						<img src="<?php echo esc_url( $popUp['icon_image']['url'] ?? '' ); ?>" alt="<?php echo esc_attr( $popUp['icon_image']['alt'] ?? '' ); ?>">
					</div>
				</div>
				<div class="right">
					<h3 style="color: <?php echo esc_attr( $popUp['sub-title_color'] ?? '' ); ?>;"><?php echo wp_kses( $popUp['sub-title'] ?? '', ofp_kses_svg() ); ?></h3>
					<h2 style="color: <?php echo esc_attr( $popUp['title_color'] ?? '' ); ?>;"><?php echo wp_kses( $popUp['title'] ?? '', ofp_kses_svg() ); ?></h2>
					<div class="description" style="color: <?php echo esc_attr( $popUp['description_color'] ?? '' ); ?>;"><?php echo wp_kses_post( $popUp['description'] ?? '' ); ?></div>

					<?php $formID = 'cta-' . uniqid(); ?>
					<style>
						#<?php echo esc_attr( $formID ); ?> button[type="submit"] {
							color: <?php echo esc_attr( $popUp['cta_color'] ?? '' ); ?>;
							background-color: <?php echo esc_attr( $popUp['cta_background_color'] ?? '' ); ?>;
						}

						#<?php echo esc_attr( $formID ); ?> button[type="submit"]:hover {
							color: <?php echo esc_attr( $popUp['cta_hover_color'] ?? '' ); ?>;
							background-color: <?php echo esc_attr( $popUp['cta_background_hover_color'] ?? '' ); ?>;
						}
					</style>
					<div id="<?php echo esc_attr( $formID ); ?>" class="popup-form">
						<!-- Flodesk form container -->
						<div class="flodesk-form-container" data-flodesk-id="<?php echo esc_attr( $popUp['form_id'] ?? '' ); ?>"></div>
					</div>

					<?php $dimissID = 'dimiss-' . uniqid(); ?>
					<style>
						#<?php echo esc_attr( $dimissID ); ?> {
							color: <?php echo esc_attr( $popUp['dimiss_color'] ?? '' ); ?>;
						}

						#<?php echo esc_attr( $dimissID ); ?>:hover {
							color: <?php echo esc_attr( $popUp['dimiss_hover_color'] ?? '' ); ?>;
						}
					</style>
					<button id="<?php echo esc_attr( $dimissID ); ?>" class="dimiss" onclick="javascript:close_pop_up('<?php echo esc_js( $popupID ); ?>')"><?php echo esc_html( $popUp['dimiss_label'] ?? '' ); ?></button>
				</div>
			</div>
		</div>
		
		<?php if ( ! $flodeskLoaded ) : ?>
			<!-- Load Flodesk universal script only once -->
			<script>
			  (function(w, d, t, h, s, n) {
			    w.FlodeskObject = n;
			    var fn = function() {
			      (w[n].q = w[n].q || []).push(arguments);
			    };
			    w[n] = w[n] || fn;
			    var f = d.getElementsByTagName(t)[0];
			    var v = '?v=' + Math.floor(new Date().getTime() / (120 * 1000)) * 60;
			    var sm = d.createElement(t);
			    sm.async = true;
			    sm.type = 'module';
			    sm.src = h + s + '.mjs' + v;
			    f.parentNode.insertBefore(sm, f);
			    var sn = d.createElement(t);
			    sn.async = true;
			    sn.noModule = true;
			    sn.src = h + s + '.js' + v;
			    f.parentNode.insertBefore(sn, f);
			  })(window, document, 'script', 'https://assets.flodesk.com', '/universal', 'fd');
			</script>
			<?php $flodeskLoaded = true; ?>
		<?php endif; ?>
		
		<!-- Initialize Flodesk form for this popup -->
		<script>
		  document.addEventListener('DOMContentLoaded', function() {
		    setTimeout(function() {
		      if (window.fd) {
		        window.fd('form', {
		          formId: '<?php echo esc_js( $popUp['form_id'] ?? '' ); ?>',
		          containerEl: document.querySelector('#<?php echo esc_js( $formID ); ?> .flodesk-form-container')
		        });
		      }
		    }, 100);
		  });
		</script>
	<?php endif; ?>
<?php endforeach; ?>

<footer id="colophon" class="site-footer" style="background-color: <?php echo esc_attr( $socialMediaOpts['bacground_color'] ?? '' ); ?>;">
    <div class="footer-container">
        <div class="footer-top container">        
            <div class="footer-left">            
                <h3 class="footer-title"><?php echo esc_html( $socialMediaOpts['footer_title'] ?? '' ); ?></h3>

                <?php if ($socialMediaOpts['footer_socials']) : ?>
                    <div class="social-icons">
                        <?php foreach ($socialMediaOpts['footer_socials'] as $social) : 
                            $icon = $social['icon'];
                            $link = $social['link'];
                        ?>
                            <a href="<?php echo esc_url($link); ?>" target="_blank" class="social-icon">
                                <?php if ($icon) : ?>
                                    <span class="dashicons <?php echo esc_attr($icon); ?>"></span>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>



            </div>
            <div class="footer-center">

                <?php if ($socialMediaOpts['top_image']) : ?>
                    <div class="top-image">
                        <img src="<?php echo esc_url($socialMediaOpts['top_image']['url']); ?>" alt="<?php echo esc_attr($socialMediaOpts['top_image']['alt']); ?>">
                    </div>
                <?php endif; ?>

                <?php if ($socialMediaOpts['main_logo']) : ?>
                    <div class="main-logo">
                        <img src="<?php echo esc_url($socialMediaOpts['main_logo']['url']); ?>" alt="<?php echo esc_attr($socialMediaOpts['main_logo']['alt']); ?>">
                    </div>
                <?php endif; ?>

                <?php if ($socialMediaOpts['footer_description']) : ?>
                    <div class="footer-description">
                        <?php echo wp_kses_post(wpautop($socialMediaOpts['footer_description'])); ?>
                    </div>
                <?php endif; ?>

            </div>
            <div class="footer-right">

                <?php if ($socialMediaOpts['form_title']) : ?>
                    <h3 class="form-title"><?php echo esc_html($socialMediaOpts['form_title']); ?></h3>
                <?php endif; ?>

                <?php if ($socialMediaOpts['form_description']) : ?>
                    <p class="form-description"><?php echo esc_html($socialMediaOpts['form_description']); ?></p>
                <?php endif; ?>


                    <div class="newsletter-form">
                    	<div id="fd-form-685421b840679baaea6652ec"></div>
                            <script>
                              window.fd('form', {
                                formId: '685421b840679baaea6652ec',
                                containerEl: '#fd-form-685421b840679baaea6652ec'
                              });
                            </script>
                    </div>           
            </div>
        </div>
    </div>
        
        <div class="footer-bottom">
            <div id="advertiser-disclosure" class="adverticer">
                <div class="container">
                    <h2 class="adverticer__tile">
                        <?php echo esc_html( $socialMediaOpts['adverticer_title'] ?? '' ); ?>
                    </h2>
                    <div class="adverticer__description">
                        <?php echo wp_kses_post( $socialMediaOpts['advertiser_content'] ?? '' ); ?>
                    </div>
                </div>
            </div>
            <nav class="footer-menu">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-footer',
                        'menu_id'        => 'menu-footer',
                    )
                );
                ?>
            </nav>
		</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>