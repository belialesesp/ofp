<?php
$title = get_field('title');
$sub_title = get_field('sub_title');
$description = get_field('description');
$float_icon = get_field('float_icon');
$resources = get_field('resources');
$discover_more = get_field('discover_more');
?>

<div class="free-resources-list">
  <div class="container">
    <div class="container header">
      <h3 class="free-resources-list__sub-title">
        <?= $sub_title ?>
      </h3>
      <h2 class="free-resources-list__title">
        <?= $title ?>
        <img src="<?= $float_icon['url'] ?>" alt="<?= $float_icon['alt'] ?>">
      </h2>
      <div class="free-resources-list__description">
        <?= $description ?>
      </div>
    </div>
    <div class="free-resources-list__resources">
      <?php foreach ($resources as $resource): ?>
        <div class="resource-list">
          <div class="resource-list__image">
            <img src="<?= $resource['image']['url'] ?>" alt="<?= $resource['image']['alt'] ?>">
          </div>
          <div class="resource-list__content">
            <div class="badge" style="background-color: <?= $resource['cta_color'] ?>;">
              <h3><?= $resource['badge_label'] ?></h3>
            </div>
            <h2 class="title"><?= $resource['title'] ?></h2>
            <div class="description"><?= $resource['description'] ?></div>
          </div>
          <div class="resource-list__cta">
            <a class="cta" href="<?= $resource['cta_url'] ?>" style="color: <?= $resource['cta_color'] ?>">
              <span>
                <?= $resource['cta_label'] ?>
              </span>
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <mask id="mask0_4218_2536" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                  <rect width="16" height="16" fill="<?= $resource['cta_color'] ?>" />
                </mask>
                <g mask="url(#mask0_4218_2536)">
                  <path d="M10.7827 8.66406H2.66602V7.33073H10.7827L7.04935 3.5974L7.99935 2.66406L13.3327 7.9974L7.99935 13.3307L7.04935 12.3974L10.7827 8.66406Z" fill="<?= $resource['cta_color'] ?>" />
                </g>
              </svg>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="free-resources-list__discover-more">
      <div class="title">DISCOVER MORE</div>
      <div class="ctas">
        <?php foreach ($discover_more as $badge): ?>
          <a class="cta" href="<?= $badge['cta_url'] ?>" style="background-color: <?= $badge['cta_background_color'] ?>">
                <?= $badge['cta_label'] ?>
            </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>