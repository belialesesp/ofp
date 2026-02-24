<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package our-family-passport
 */
$bannerOpts = get_field('banner', 'option');
// Get quiz fields from the homepage
$home_id = get_option('page_on_front');
$quizUrl = get_field('quizz_url', $home_id);
$quizLabel = get_field('take_a_quizz_label', $home_id);
$lookAroundOpts = get_field('menu_look_around', 'option');
$socialMediaOpts = get_field('social_media', 'option');
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'our-family-passport'); ?></a>

		<header id="masthead" class="site-header">
			<?php if ($bannerOpts): ?>
				<div class="header-banner" style="background-color: <?= $bannerOpts['banner_background_color'] ?>;">
					<div class="container align-items-center">
						<a id="colophonBtn" href="#advertiser-disclosure">ADVERTISER AND EDITORIAL DISCLOSURE</a>
						<?php if ($bannerOpts['banner_image']): ?>
							<div class="header-banner__img">
								<img src="<?= $bannerOpts['banner_image']['url'] ?>" alt="<?= $bannerOpts['banner_image']['alt'] ?>">
							</div>
						<?php endif; ?>
						<div class="header-banner__content">
							<?php if ($bannerOpts['banner_title']): ?>
								<h2 class="header-banner__content__title"><?= $bannerOpts['banner_title'] ?></h2>
							<?php endif; ?>
							<?php if ($bannerOpts['banner_description']): ?>
								<div class="header-banner__content__description">
									<?= $bannerOpts['banner_description'] ?>
								</div>
							<?php endif; ?>
						</div>
						<?php if ($bannerOpts['cta_link']): ?>
							<div class="header-banner__cta" href="<?= $bannerOpts['cta_link'] ?>" target="_blank" rel="noopener noreferrer">
								<a href="<?= $bannerOpts['cta_link'] ?>" target="_blank" rel="noopener noreferrer" class="btn btn-header">
									<?= $bannerOpts['cta_text'] ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="look-around">
				<div class="container align-items-center justify-content-between">
					<?php if ($quizUrl && $quizLabel): ?>
    <div class="look-around__quiz-link">
        <a class="take-quizz" href="<?= esc_url($quizUrl) ?>" target="_blank" rel="noopener noreferrer">
            <?= esc_html($quizLabel) ?>
        </a>
    </div>
<?php endif; ?>
					<div class="look-around__big-menu">
						<?php if ($lookAroundOpts): ?>
							<div class="label">
								<span><?= $lookAroundOpts['look_around_text'] ?></span>
								<svg width="37" height="27" viewBox="0 0 37 27" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M33.3653 10.5772C22.1492 32.9865 2.6083 27.1629 1.13039 16.9671C-0.254989 7.40955 9.72044 2.28239 15.8119 2.92374C21.6071 3.5339 21.8351 9.65685 16.5648 9.65685C10.1511 9.65685 6.57414 4.82477 5.92752 1M33.3653 10.5772L25.2282 13.2664M33.3653 10.5772L36 18.8824" stroke="#66B1BB" class="svg-elem-1"></path>
								</svg>
							</div>
							<div class="hamburguer-menu">
								<button class="hamburguer-menu__button" id="show-look-around-btn">
									<svg width="80" height="73" viewBox="0 0 80 73" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="36.5" cy="36.5" r="35" fill="#BED8BA" stroke="white" stroke-width="3" />
										<g class="stars" clip-path="url(#clip0_4337_2111)">
											<path d="M80 53.9953C80.0008 54.4815 79.7368 54.796 79.2067 54.9041C78.6011 55.0277 78.003 55.1727 77.4107 55.3489C75.8115 55.8255 74.7993 56.8719 74.3298 58.4624C74.1605 59.0367 74.0274 59.6198 73.898 60.2038C73.793 60.6781 73.4263 60.9964 72.9996 61.0001C72.5287 61.0038 72.2144 60.727 72.0976 60.1964C71.9749 59.6391 71.8425 59.0848 71.6887 58.5349C71.2163 56.8446 70.1375 55.7759 68.4496 55.303C67.9253 55.1564 67.3997 55.021 66.8658 54.9174C66.2913 54.8064 66.003 54.5074 66 54.0145C65.9971 53.5423 66.3187 53.1923 66.8533 53.0842C67.4499 52.9636 68.0392 52.8178 68.6218 52.6402C70.2063 52.1554 71.2074 51.1082 71.671 49.5274C71.8425 48.9435 71.9786 48.3522 72.1072 47.7587C72.213 47.2695 72.525 47.0053 72.9871 47.0001C73.464 46.9949 73.7841 47.2591 73.8936 47.7601C74.0311 48.3899 74.1775 49.016 74.3653 49.6333C74.8629 51.2688 75.9682 52.2516 77.5911 52.7038C78.1331 52.8548 78.6795 52.9821 79.2303 53.0968C79.7405 53.2034 80 53.5157 80.0008 53.9945L80 53.9953Z" fill="#E5AF9A" />
											<g clip-path="url(#clip1_4337_2111)">
												<path d="M66.9938 50.0001C66.4564 49.9976 66.0025 49.5392 66 48.9946C65.9967 48.4196 66.4497 47.9917 67.0547 48.0001C67.5803 48.0069 68.0084 48.4627 68.0009 49.0065C67.9933 49.5477 67.5328 50.0027 66.9946 50.0001H66.9938Z" fill="#E5AF9A" />
											</g>
										</g>
										<g class="stars" clip-path="url(#clip2_4337_2111)">
											<path d="M17 10.9953C17.0008 11.4815 16.7368 11.796 16.2067 11.9041C15.6011 12.0277 15.003 12.1727 14.4107 12.3489C12.8115 12.8255 11.7993 13.8719 11.3298 15.4624C11.1605 16.0367 11.0274 16.6198 10.898 17.2038C10.793 17.6781 10.4263 17.9964 9.99965 18.0001C9.52867 18.0038 9.21444 17.727 9.09762 17.1964C8.97488 16.6391 8.84253 16.0848 8.68874 15.5349C8.21629 13.8446 7.13754 12.7759 5.44956 12.303C4.92534 12.1564 4.39965 12.021 3.86582 11.9174C3.29133 11.8064 3.00298 11.5074 3.00002 11.0145C2.99706 10.5423 3.31869 10.1923 3.85325 10.0842C4.44993 9.9636 5.03921 9.8178 5.62183 9.64019C7.2063 9.15544 8.20741 8.10823 8.671 6.52743C8.84253 5.94351 8.97858 5.35219 9.10723 4.75865C9.21296 4.26946 9.52497 4.00526 9.98708 4.00007C10.464 3.99489 10.7841 4.2591 10.8936 4.76013C11.0311 5.38994 11.1775 6.01604 11.3653 6.63326C11.8629 8.26883 12.9682 9.25165 14.5911 9.70383C15.1331 9.85481 15.6795 9.9821 16.2303 10.0968C16.7405 10.2034 17 10.5157 17.0008 10.9945L17 10.9953Z" fill="#E5AF9A" />
											<g clip-path="url(#clip3_4337_2111)">
												<path d="M3.99376 7.00012C3.45642 6.99759 3.00252 6.53924 3.00002 5.99463C2.99668 5.41957 3.44975 4.99167 4.05467 5.00012C4.58033 5.00689 5.00836 5.4627 5.00085 6.00647C4.99334 6.54769 4.53277 7.00266 3.99459 7.00012H3.99376Z" fill="#E5AF9A" />
											</g>
										</g>
										<path d="M16.3333 51C15.0447 51 14 49.9553 14 48.6667V48.6667C14 47.378 15.0447 46.3333 16.3333 46.3333H55.6667C56.9553 46.3333 58 47.378 58 48.6667V48.6667C58 49.9553 56.9553 51 55.6667 51H16.3333ZM16.3333 39.3333C15.0447 39.3333 14 38.2887 14 37V37C14 35.7113 15.0447 34.6667 16.3333 34.6667H55.6667C56.9553 34.6667 58 35.7113 58 37V37C58 38.2887 56.9553 39.3333 55.6667 39.3333H16.3333ZM16.3333 27.6667C15.0447 27.6667 14 26.622 14 25.3333V25.3333C14 24.0447 15.0447 23 16.3333 23H55.6667C56.9553 23 58 24.0447 58 25.3333V25.3333C58 26.622 56.9553 27.6667 55.6667 27.6667H16.3333Z" fill="#222222" />
										<defs>
											<clipPath id="clip0_4337_2111">
												<rect width="14" height="14" fill="white" transform="translate(66 47)" />
											</clipPath>
											<clipPath id="clip1_4337_2111">
												<rect width="2" height="2" fill="white" transform="translate(66 48)" />
											</clipPath>
											<clipPath id="clip2_4337_2111">
												<rect width="14" height="14" fill="white" transform="translate(3 4)" />
											</clipPath>
											<clipPath id="clip3_4337_2111">
												<rect width="2" height="2" fill="white" transform="translate(3 5)" />
											</clipPath>
										</defs>
									</svg>
								</button>
							</div>
							<div class="look-around__menu">
								<div class="about-ofp">
									<div class="content">
										<img class="kam-img" src="<?= $lookAroundOpts['image']['url'] ?>" alt="<?= $lookAroundOpts['image']['alt'] ?>">
										<?= the_custom_logo(); ?>
										<h2 class="title">
											<?= $lookAroundOpts['title'] ?>
										</h2>
										<div class="description">
											<?= $lookAroundOpts['description'] ?>
										</div>
									</div>
									<div class="social-media">
										<div class="instagram">
											<a href="<?= $socialMediaOpts['instagram_url'] ?>" target="_blank" rel="noopener noreferrer">
												<svg width="23" height="25" viewBox="0 0 23 25" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M11.4661 15.6861C13.2196 15.6861 14.6412 14.2646 14.6412 12.511C14.6412 10.7575 13.2196 9.33594 11.4661 9.33594C9.71255 9.33594 8.29102 10.7575 8.29102 12.511C8.29102 14.2646 9.71255 15.6861 11.4661 15.6861Z" fill="#E5AF9A" />
													<path d="M15.1836 3.45312H7.81641C4.99891 3.45312 2.69531 5.75807 2.69531 8.57422V16.4221C2.69531 19.24 5.0007 21.5432 7.81641 21.5432H15.1836C18.0011 21.5432 20.3047 19.2382 20.3047 16.4221V8.57602C20.3047 5.75807 17.9993 3.45312 15.1836 3.45312ZM11.4897 17.3538C10.5305 17.3538 9.5929 17.0695 8.79536 16.5367C7.99783 16.0039 7.37621 15.2465 7.00912 14.3604C6.64203 13.4743 6.54596 12.4992 6.73306 11.5585C6.92016 10.6178 7.38202 9.75366 8.06023 9.07545C8.73845 8.39723 9.60256 7.93537 10.5433 7.74827C11.484 7.56118 12.4591 7.65725 13.3452 8.02433C14.2313 8.39142 14.9886 9.01304 15.5215 9.81058C16.0543 10.6081 16.3386 11.5457 16.3385 12.5049C16.3384 13.7908 15.8275 15.0241 14.9182 15.9334C14.0089 16.8427 12.7756 17.3536 11.4897 17.3538ZM16.4163 8.72875C16.1892 8.72875 15.9672 8.66142 15.7784 8.53527C15.5896 8.40913 15.4424 8.22983 15.3555 8.02005C15.2686 7.81027 15.2458 7.57943 15.2901 7.35671C15.3343 7.13399 15.4437 6.9294 15.6042 6.7688C15.7647 6.60821 15.9693 6.49882 16.192 6.45446C16.4147 6.41011 16.6455 6.43278 16.8553 6.51962C17.0652 6.60645 17.2445 6.75355 17.3707 6.94231C17.4969 7.13107 17.5644 7.35302 17.5645 7.5801C17.5645 7.88462 17.4435 8.17667 17.2282 8.392C17.0128 8.60733 16.7208 8.7283 16.4163 8.7283V8.72875Z" fill="#E5AF9A" />
												</svg>

											</a>
										</div>
										<div class="facebook">
											<a href="<?= $socialMediaOpts['facebook_url'] ?>" target="_blank" rel="noopener noreferrer">
												<svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M14.5 9V7.21406C14.5 6.40781 14.6781 6 15.9297 6H17.5V3H14.8797C11.6688 3 10.6094 4.47188 10.6094 6.99844V9H8.5V12H10.6094V21H14.5V12H17.1437L17.5 9H14.5Z" fill="#66B1BB" fill-opacity="0.79" />
												</svg>
											</a>
										</div>
										<div class="pinterest">
											<a href="<?= $socialMediaOpts['pinterest_url'] ?>" target="_blank" rel="noopener noreferrer">
												<svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M11.8867 2.10938C6.74855 2.10938 4.11523 5.79836 4.11523 8.82834C4.11523 10.6728 4.77424 12.3857 6.35504 12.9126C6.61828 13.0443 6.88197 12.9126 6.88197 12.6489C6.88197 12.5173 7.01359 11.9904 7.14566 11.7267C7.27773 11.463 7.14566 11.3318 7.01359 11.0681C6.61828 10.5412 6.35504 9.88221 6.35504 8.96041C6.35504 6.19367 8.46277 3.82225 11.7564 3.82225C14.6553 3.82225 16.2361 5.66674 16.2361 8.03816C16.2361 11.1998 14.7869 13.8331 12.8108 13.8331C11.6248 13.8331 10.8342 12.9108 11.0979 11.7249C11.3616 10.4078 12.0201 8.82654 12.0201 7.90654C12.0201 6.98654 11.4932 6.32574 10.571 6.32574C9.38502 6.32574 8.46277 7.51123 8.46277 9.09248C8.46277 10.1463 8.85809 10.8049 8.85809 10.8049C8.85809 10.8049 7.53873 15.9426 7.40711 16.8649C7.0118 18.5777 7.40711 20.818 7.40711 20.9492C7.40711 21.0803 7.53873 21.0808 7.6708 20.9492C7.80287 20.8175 9.11998 19.1047 9.64736 17.3918C9.77899 16.8649 10.438 14.3618 10.438 14.3618C10.8329 15.0204 11.8872 15.6794 13.0727 15.6794C16.4979 15.6794 18.8676 12.5173 18.8676 8.30141C18.868 5.13936 16.1026 2.10938 11.8867 2.10938Z" fill="#ADD79E" />
												</svg>
											</a>
										</div>
									</div>
								</div>
								<div class="center">
									<?php foreach ($lookAroundOpts['center_words'] as $word): ?>
										<span><?= $word['word'] ?></span>
									<?php endforeach; ?>
								</div>
								<div class="menu-container">
									<button id="hidde-look-around-btn" class="close-btn">
										<svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
											<mask id="mask0_4328_647" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="78" height="78">
												<rect width="77.5137" height="77.5137" fill="#D9D9D9" />
											</mask>
											<g mask="url(#mask0_4328_647)">
												<path d="M20.6701 61.3647L16.1484 56.8431L34.235 38.7566L16.1484 20.6701L20.6701 16.1484L38.7566 34.235L56.8431 16.1484L61.3647 20.6701L43.2782 38.7566L61.3647 56.8431L56.8431 61.3647L38.7566 43.2782L20.6701 61.3647Z" fill="#222222" />
											</g>
										</svg>
									</button>
									<nav class="navigation">
										<?php
										wp_nav_menu(
											array(
												'theme_location' => 'menu-look-around',
												'menu_id'        => 'menu-look-around',
											)
										);
										?>
									</nav>
									<nav class="bottom-navigation">
										<?php
										wp_nav_menu(
											array(
												'theme_location' => 'menu-bottom-look-around',
												'menu_id'        => 'menu-bottom-look-around',
											)
										);
										?>
									</nav>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'our-family-passport'); ?></button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'main-menu',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->
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
		</header><!-- #masthead -->