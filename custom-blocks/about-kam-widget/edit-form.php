<?php
// custom-blocks/about-kam-widget/edit-form.php

// Get widget settings
$widget_parts = explode('-', $widget_id);
$widget_number = isset($widget_parts[1]) ? intval($widget_parts[1]) : 0;
$widget_settings = get_option('widget_about_kam_widget');

// Get values
$title = isset($widget_settings[$widget_number]['title']) ? $widget_settings[$widget_number]['title'] : '';
$description = isset($widget_settings[$widget_number]['description']) ? $widget_settings[$widget_number]['description'] : '';
$image = isset($widget_settings[$widget_number]['image']) ? $widget_settings[$widget_number]['image'] : '';

// If empty, try to get from options
if (empty($title) || empty($description) || empty($image)) {
    $title = get_field('about_kam_title', 'option') ?: $title;
    $description = get_field('about_kam_description', 'option') ?: $description;
    $image = get_field('about_kam_image', 'option') ?: $image;
}
?>

<div class="acf-field acf-field-accordion" data-name="about_kam" data-type="accordion">
    <div class="acf-label acf-accordion-title">
        <i class="acf-accordion-icon dashicons dashicons-arrow-down"></i>
        <label>About Kam [widget]</label>
    </div>
    <div class="acf-input acf-accordion-content" style="display: block;">
        <div class="acf-fields">
            <!-- Title field -->
            <div class="acf-field acf-field-text" data-name="title" data-type="text">
                <div class="acf-label">
                    <label>Title</label>
                </div>
                <div class="acf-input">
                    <div class="acf-input-wrap">
                        <input type="text" name="widget-about-kam-widget[<?php echo $widget_number; ?>][title]" value="<?php echo esc_attr($title); ?>">
                    </div>
                </div>
            </div>
            
            <!-- Description field -->
            <div class="acf-field acf-field-wysiwyg" data-name="description" data-type="wysiwyg">
                <div class="acf-label">
                    <label>Description</label>
                </div>
                <div class="acf-input">
                    <?php
                    wp_editor(
                        $description,
                        'widget-about-kam-widget-' . $widget_number . '-description',
                        array(
                            'textarea_name' => 'widget-about-kam-widget[' . $widget_number . '][description]',
                            'media_buttons' => true,
                            'textarea_rows' => 8
                        )
                    );
                    ?>
                </div>
            </div>
            
            <!-- Image field -->
            <div class="acf-field acf-field-image" data-name="image" data-type="image">
                <div class="acf-label">
                    <label>Image</label>
                </div>
                <div class="acf-input">
                    <div class="acf-image-uploader<?php echo !empty($image) ? ' has-value' : ''; ?>" data-preview_size="medium" data-library="all" data-mime_types="">
                        <input type="hidden" name="widget-about-kam-widget[<?php echo $widget_number; ?>][image]" value="<?php echo esc_attr($image); ?>">
                        <div class="show-if-value image-wrap" style="max-width: 300px">
                            <?php if (!empty($image)): 
                                $image_url = wp_get_attachment_image_url($image, 'medium');
                                $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                            ?>
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" data-name="image" style="max-height: 300px;">
                                <div class="acf-actions -hover">
                                    <a class="acf-icon -pencil dark" data-name="edit" href="#" title="Edit"></a>
                                    <a class="acf-icon -cancel dark" data-name="remove" href="#" title="Remove"></a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="hide-if-value">
                            <p>No image selected <a data-name="add" class="acf-button button" href="#">Add Image</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>