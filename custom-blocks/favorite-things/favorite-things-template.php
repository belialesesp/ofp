<?php
$background_type = get_field('background_type');
$background_color = get_field('background_color');
$background_color_start = get_field('background_color_start');
$background_color_end = get_field('background_color_end');
$rotation_deg = get_field('rotation_deg');
$background_image = get_field('background_image');
$title_color = get_field('title_color');
$sub_title_color = get_field('sub_title_color');
$load_more_text_color = get_field('load_more_text_color');
$load_more_background_color = get_field('load_more_background_color');
$load_more_hover_color = get_field('load_more_hover_color');

// Captura o grupo rotating_image
$rotating_image_data = get_field('rotating_image');

$title = get_field('title');
$subtitle = get_field('subtitle');
$favorite_things = get_field('favorite_things');
$totalFavoriteThings = count($favorite_things);
$blockID = 'favorite-things-' . uniqid();
$counter = 0;
$favoriteThingsCounter = 0;
?>
<?php if ($background_type == 'gradient'): ?>
  <style>
    #<?= $blockID ?> {
      background: linear-gradient(<?= $rotation_deg ? $rotation_deg : 0 ?>deg,
          <?= $background_color_start ?> 0%,
          <?= $background_color_end ?> 100%);
    }
  </style>
<?php endif; ?>
<?php if ($background_type == 'image'): ?>
  <style>
    #<?= $blockID ?> {
      background-image: url(<?= $background_image['url'] ?>);
    }
  </style>
<?php endif; ?>
<?php if ($background_type == 'color'): ?>
  <style>
    #<?= $blockID ?> {
      background-color: <?= $background_color ?>;
    }
  </style>
<?php endif; ?>

<style>
  #<?= $blockID ?> {
    position: relative;
  }
  
  #<?= $blockID ?> .rotating-image-wrapper {
    position: absolute;
    top: <?= $rotating_image_data['top'] ?: 0 ?>px;
    right: <?= $rotating_image_data['right'] ?: 0 ?>px;
    <?php if($rotating_image_data['bottom']): ?>bottom: <?= $rotating_image_data['bottom'] ?>px;<?php endif; ?>
    <?php if($rotating_image_data['left']): ?>left: <?= $rotating_image_data['left'] ?>px;<?php endif; ?>
    z-index: 1;
    width: 150px; /* Ajuste conforme necessário */
    height: 150px;
  }
  
  #<?= $blockID ?> .rotating-image-wrapper > img:first-child {
    /* Logo central - menor e centralizado */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60%; /* Logo menor que o container */
    height: auto;
    z-index: 2;
  }
  
  #<?= $blockID ?> .rotating-image-wrapper .animated__img {
    /* Texto rotativo - ocupa todo o container */
    position: absolute;
    top: 10px;
    left: 2px;
    width: 100%;
    height: 100%;
    animation: rotate 10s linear infinite;
    z-index: 1;
  }
  
  @keyframes rotate {
    from {
      transform: rotate(0deg);
    }
    to {
      transform: rotate(360deg);
    }
  }
	@media (max-width: 768px) {
    #<?= $blockID ?> .rotating-image-wrapper {
      display: none;
    }
  }
</style>

<div id="<?= $blockID ?>" class="favorite-things">
  <?php if ($rotating_image_data && $rotating_image_data['rotating_image']): ?>
    <div class="rotating-image-wrapper">
      <?php if ($rotating_image_data['image']): ?>
        <img src="<?= $rotating_image_data['image']['url'] ?>" alt="<?= $rotating_image_data['image']['alt'] ?>" style="max-width: inherit;">
      <?php endif; ?>
      <img src="<?= $rotating_image_data['rotating_image']['url'] ?>" alt="<?= $rotating_image_data['rotating_image']['alt'] ?>" class="animated__img">
    </div>
  <?php endif; ?>
  
  <div class="container">
    <div class="title-container">
      <h2 class="title" style="color: <?= $title_color ?>;"><?= $title ?></h2>
      <h3 class="sub-title" style="color: <?= $sub_title_color ?>"><?= $subtitle ?></h3>
    </div>
    <div class="things">
      <?php foreach ($favorite_things as $thing): $favoriteThingsCounter++;
        $counter == 3 ? $counter = 1 : $counter++ ?>

        <style>
          .description-<?= $favoriteThingsCounter ?> a {
            color: <?= isset($thing['link_in_description_color']) ? $thing['link_in_description_color'] : '#9bbfcd' ?>
          }

          .description-<?= $favoriteThingsCounter ?> a:hover {
            color: <?= isset($thing['link_in_description_hover_color']) ? $thing['link_in_description_hover_color'] : '#f0a9ad' ?>
          }
        </style>
        <?php if ($counter == 1): ?>
          <div class="thing-containter">
            <div class="row">
              <div class="thing">
                <img src="<?= $thing['image'] ? $thing['image']['url'] : '' ?>" alt="<?= $thing['image'] ? $thing['image']['alt'] : '' ?>">
                <h3 style="color: <?= $thing['title_color'] ?>"><?= $thing['title'] ?></h3>
                <div style="color: <?= $thing['description_color'] ?>" class="description description-<?= $favoriteThingsCounter ?>"><?= $thing['description'] ?></div>
                <?php $ctaID = 'cta-' . uniqid(); ?>
                <style>
                  #<?= $ctaID ?> {
                    color: <?= $thing['cta_color'] ?>;
                  }

                  #<?= $ctaID ?>:hover {
                    color: <?= $thing['cta_hover_color'] ?>;
                  }
                </style>
                <a id="<?= $ctaID ?>" class="cta" href="<?= $thing['cta_url'] ?>"><?= $thing['cta_label'] ?></a>
              </div>
            <?php else: ?>
              <div class="thing">
                <img src="<?= $thing['image'] ? $thing['image']['url'] : '' ?>" alt="<?= $thing['image'] ? $thing['image']['alt'] : '' ?>">
                <h3 style="color: <?= $thing['title_color'] ?>"><?= $thing['title'] ?></h3>
                <div class="description description-<?= $favoriteThingsCounter ?>" style="color: <?= $thing['description_color'] ?>"><?= $thing['description'] ?></div>
                <?php $ctaID = 'cta-' . uniqid(); ?>
                <style>
                  #<?= $ctaID ?> {
                    color: <?= $thing['cta_color'] ?>;
                  }

                  #<?= $ctaID ?>:hover {
                    color: <?= $thing['cta_hover_color'] ?>;
                  }
                </style>
                <a id="<?= $ctaID ?>" class="cta" href="<?= $thing['cta_url'] ?>"><?= $thing['cta_label'] ?></a>
              </div>
              <?php if ($counter == 3 || $favoriteThingsCounter == $totalFavoriteThings): ?>
            </div>
          </div> <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; ?>
    </div>
    <?php $loadMoreID = 'lm-' . uniqid(); ?>
    <style>
      #<?= $loadMoreID ?> {
        color: <?= $load_more_text_color ?>;
        background-color: <?= $load_more_background_color ?>;
      }

      #<?= $loadMoreID ?>:hover {
        background-color: <?= $load_more_hover_color ?>;
      }
    </style>

    <?php if (count($favorite_things) > 3): ?>
      <button id="<?= $loadMoreID  ?>" class="load-more">
        <span>Load More</span>
        <i class="fa fa-arrow-down" aria-hidden="true"></i>
      </button>
    <?php endif; ?>
  </div>
</div>

<script>
  (function($) {
    $(document).ready(function() {
      $("#<?= $blockID ?> .thing-containter").slice(0, 1).show();
      if ($("#<?= $blockID ?> .thing-containter:hidden").length != 0) {
        $("#<?= $loadMoreID  ?>").show();
      }
      $("#<?= $loadMoreID  ?>").on("click", function(e) {
        e.preventDefault();
        $("#<?= $blockID ?> .thing-containter:hidden").slice(0, 1).slideDown();
        if ($("#<?= $blockID ?> .thing-containter:hidden").length == 0) {
          $("#<?= $loadMoreID  ?>").text("No More to view")
            .fadOut("slow");
        }
      });
    })
  })(jQuery);
</script>