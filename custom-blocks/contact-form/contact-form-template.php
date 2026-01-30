<?php
$background_color = get_field('background_color');
$background_image = get_field('background_image');
$title = get_field('title');
$description = get_field('description');
$contact_items = get_field('contact_items');
$contact_form_id = get_field('contact_form_id');
?>
<div class="contact-form" style="background-color: <?= $background_color ?>;">
  <?php if($background_image): ?>
    <div class="contact-form__background-image col">
      <img src="<?= $background_image['url'] ?>" alt="<?= $background_image['alt'] ?>" />
    </div>
  <?php endif; ?>
  <div class="container col">
    <div class="contact-formcontent">
      <h2 class="contact-formtitle">
        <?= $title ?>
      </h2>
      <div class="contact-formdescription">
        <?= $description ?>
      </div>
      <div class="contact-formcontact-items">
        <?php foreach($contact_items as $item): ?>
          <?php if ($item['type'] == 'mail'): ?>
            <a href="mailto:<?= $item['label'] ?>" target="_blank" rel="noopener noreferrer">
              <?= $item['label'] ?>
            </a>
          <?php endif; ?>
          <?php if ($item['type'] == 'phone'): ?>
            <a href="tel:<?= $item['label'] ?>" target="_blank" rel="noopener noreferrer">
              <?= $item['label'] ?>
            </a>
          <?php endif; ?>
          <?php if ($item['type'] == 'url'): ?>
            <a href="<?= $item['url'] ?>" target="_blank" rel="noopener noreferrer">
              <?= $item['label'] ?>
            </a>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <div class="contact-form__contact-form">
        <?= do_shortcode('[contact-form-7 id="' . $contact_form_id . '" title="Contact form"]') ?>
      </div>
    </div>
  </div>
</div>