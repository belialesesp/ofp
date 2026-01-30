<?php
$background_color = get_field('background_color');
$main_title = get_field('main_title');
$search_title = get_field('search_title');
$search_placeholder = get_field('search_placeholder');
$trending_label = get_field('trending_label');
$trending_items = get_field('trending_items');
$main_title_color = get_field('main_title_color');
$search_title_color = get_field('search_title_color');

// Discover More fields
$discover_more = get_field('discover_more');

$blockID = 'search-hero-' . uniqid();
?>

<div class="search-hero" style="background-color: <?php echo esc_attr($background_color); ?>;">
  <div class="container">
    <div class="search-hero__content">
      
      <?php if ($main_title): ?>
        <!-- Main Title -->
        <h2 class="search-hero__main-title" style="color: <?php echo esc_attr($main_title_color); ?>;">
          <?php echo esc_html($main_title); ?>
        </h2>
      <?php endif; ?>
      
      <?php if ($search_title): ?>
        <!-- Search Title -->
        <h1 class="search-hero__search-title">
          <?php echo esc_html($search_title); ?>
        </h1>
      <?php endif; ?>
      
      <!-- Search Form -->
      <div class="search-hero__form">
        <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
          <div class="search-input-container">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8"></circle>
              <path d="m21 21-4.35-4.35"></path>
            </svg>
            <input 
              type="search" 
              class="search-field" 
              placeholder="<?php echo esc_attr($search_placeholder); ?>" 
              value="<?php echo get_search_query(); ?>" 
              name="s" 
              aria-label="<?php echo esc_attr($search_placeholder); ?>"
            />
          </div>
        </form>
      </div>
      
      <!-- Trending Searches -->
      <?php if ($trending_items && $trending_label): ?>
        <div class="search-hero__trending">
          <div class="trending-label">
            <?php echo esc_html($trending_label); ?>
          </div>
          <div class="trending-buttons">
            <?php foreach ($trending_items as $item): ?>
              <?php if (!empty($item['text'])): ?>
                <?php 
                $text = $item['text'];
                $url = !empty($item['url']) ? $item['url'] : home_url('/?s=' . urlencode($text));
                ?>
                <a href="<?php echo esc_url($url); ?>" class="trending-button">
                  <?php echo esc_html($text); ?>
                </a>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
      
    </div>
  </div>
</div>

<!-- Discover More Section -->
<?php if ($discover_more): ?>
  <div class="discover-more">
    <div class="container">
      <div class="discover-more__content">
        <h3 class="discover-more__title">DISCOVER MORE</h3>
        <div class="discover-more__buttons">
          <?php foreach ($discover_more as $item): ?>
            <?php if (!empty($item['cta_label'])): ?>
              <?php 
              $label = $item['cta_label'];
              $url = home_url('/?s=' . urlencode($label));
              $bg_color = !empty($item['cta_background_color']) ? $item['cta_background_color'] : '#f0f0f0';
              ?>
              <a href="<?php echo esc_url($url); ?>" 
                 class="discover-more__button" 
                 style="background-color: <?php echo esc_attr($bg_color); ?>;">
                <?php echo esc_html($label); ?>
              </a>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>