<?php
// custom-blocks/banner-cta-widget/edit-form.php

// Get widget settings
$widget_parts = explode('-', $widget_id);
$widget_number = isset($widget_parts[1]) ? intval($widget_parts[1]) : 0;
$widget_settings = get_option('widget_banner_cta_widget');

// Get values
$icon = isset($widget_settings[$widget_number]['icon']) ? $widget_settings[$widget_number]['icon'] : '';
$title = isset($widget_settings[$widget_number]['title']) ? $widget_settings[$widget_number]['title'] : '';
$description = isset($widget_settings[$widget_number]['description']) ? $widget_settings[$widget_number]['description'] : '';
$cta_label = isset($widget_settings[$widget_number]['cta_label']) ? $widget_settings[$widget_number]['cta_label'] : '';
$cta_url = isset($widget_settings[$widget_number]['cta_url']) ? $widget_settings[$widget_number]['cta_url'] : '';
$background_type = isset($widget_settings[$widget_number]['background_type']) ? $widget_settings[$widget_number]['background_type'] : 'gradient';
?>

<div class="acf-field acf-field-accordion" data-name="banner_cta_widget" data-type="accordion">
    <div class="acf-label acf-accordion-title">
        <i class="acf-accordion-icon dashicons dashicons-arrow-down"></i>
        <label>Banner CTA [Widget]</label>
    </div>
    <div class="acf-input acf-accordion-content" style="display: block;">
        <div class="acf-fields">
            <div class="acf-tab-wrap -top">
                <ul class="acf-hl acf-tab-group">
                    <li class="active"><a href="" class="acf-tab-button" data-key="content">Content</a></li>
                    <li><a href="" class="acf-tab-button" data-key="settings">Setting</a></li>
                </ul>
            </div>
            
            <!-- Content tab fields -->
            <div class="acf-tab-content" data-tab="content">
                <!-- Icon field -->
                <div class="acf-field acf-field-image" data-name="icon" data-type="image">
                    <div class="acf-label">
                        <label>Icon</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-image-uploader<?php echo !empty($icon) ? ' has-value' : ''; ?>" data-preview_size="medium" data-library="all" data-mime_types="">
                            <input type="hidden" name="widget-banner-cta-widget[<?php echo $widget_number; ?>][icon]" value="<?php echo esc_attr($icon); ?>">
                            <div class="show-if-value image-wrap" style="max-width: 300px">
                                <?php if (!empty($icon)): 
                                    $icon_url = wp_get_attachment_image_url($icon, 'medium');
                                    $icon_alt = get_post_meta($icon, '_wp_attachment_image_alt', true);
                                ?>
                                    <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>" data-name="image" style="max-height: 300px;">
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
                
                <!-- Title field -->
                <div class="acf-field acf-field-text" data-name="title" data-type="text">
                    <div class="acf-label">
                        <label>Title</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-input-wrap">
                            <input type="text" name="widget-banner-cta-widget[<?php echo $widget_number; ?>][title]" value="<?php echo esc_attr($title); ?>">
                        </div>
                    </div>
                </div>
                
                <!-- Description field -->
                <div class="acf-field acf-field-text" data-name="description" data-type="text">
                    <div class="acf-label">
                        <label>Description</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-input-wrap">
                            <input type="text" name="widget-banner-cta-widget[<?php echo $widget_number; ?>][description]" value="<?php echo esc_attr($description); ?>">
                        </div>
                    </div>
                </div>
                
                <!-- CTA Label field -->
                <div class="acf-field acf-field-text" data-name="cta_label" data-type="text">
                    <div class="acf-label">
                        <label>CTA Label</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-input-wrap">
                            <input type="text" name="widget-banner-cta-widget[<?php echo $widget_number; ?>][cta_label]" value="<?php echo esc_attr($cta_label); ?>">
                        </div>
                    </div>
                </div>
                
                <!-- CTA URL field -->
                <div class="acf-field acf-field-url" data-name="cta_url" data-type="url">
                    <div class="acf-label">
                        <label>CTA URL</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-input-wrap acf-url">
                            <i class="acf-icon -globe -small"></i>
                            <input type="url" name="widget-banner-cta-widget[<?php echo $widget_number; ?>][cta_url]" value="<?php echo esc_url($cta_url); ?>">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Settings tab fields -->
            <div class="acf-tab-content" data-tab="settings" style="display: none;">
                <!-- Background Type field -->
                <div class="acf-field acf-field-select" data-name="background_type" data-type="select">
                    <div class="acf-label">
                        <label>Background Type</label>
                    </div>
                    <div class="acf-input">
                        <select name="widget-banner-cta-widget[<?php echo $widget_number; ?>][background_type]">
                            <option value="color" <?php selected($background_type, 'color'); ?>>Color</option>
                            <option value="gradient" <?php selected($background_type, 'gradient'); ?>>Gradient</option>
                            <option value="image" <?php selected($background_type, 'image'); ?>>Image</option>
                        </select>
                    </div>
                </div>
                
                <!-- Add more settings fields as needed -->
            </div>
        </div>
    </div>
</div>