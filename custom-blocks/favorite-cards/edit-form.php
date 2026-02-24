<?php
// custom-blocks/favorite-cards/edit-form.php

// Get widget settings
$widget_parts = explode('-', $widget_id);
$widget_number = isset($widget_parts[1]) ? intval($widget_parts[1]) : 0;
$widget_settings = get_option('widget_favorite_cards');

// Get values
$is_widget = isset($widget_settings[$widget_number]['is_widget']) ? $widget_settings[$widget_number]['is_widget'] : 0;
$title_line_1 = isset($widget_settings[$widget_number]['title_line_1']) ? $widget_settings[$widget_number]['title_line_1'] : '';
$title_line_2 = isset($widget_settings[$widget_number]['title_line_2']) ? $widget_settings[$widget_number]['title_line_2'] : '';
$left_image = isset($widget_settings[$widget_number]['left_image']) ? $widget_settings[$widget_number]['left_image'] : '';
$favorite_cards = isset($widget_settings[$widget_number]['favorite_cards']) ? $widget_settings[$widget_number]['favorite_cards'] : array();
$cta_label = isset($widget_settings[$widget_number]['cta_label']) ? $widget_settings[$widget_number]['cta_label'] : '';
$cta_url = isset($widget_settings[$widget_number]['cta_url']) ? $widget_settings[$widget_number]['cta_url'] : '';
$background_type = isset($widget_settings[$widget_number]['background_type']) ? $widget_settings[$widget_number]['background_type'] : 'gradient';
?>

<div class="acf-field acf-field-accordion" data-name="favorite_cards" data-type="accordion">
    <div class="acf-label acf-accordion-title">
        <i class="acf-accordion-icon dashicons dashicons-arrow-down"></i>
        <label>My Favorite Cards</label>
    </div>
    <div class="acf-input acf-accordion-content" style="display: block;">
        <div class="acf-fields">
            <div class="acf-tab-wrap -top">
                <ul class="acf-hl acf-tab-group">
                    <li class="active"><a href="" class="acf-tab-button" data-key="content">Content</a></li>
                    <li><a href="" class="acf-tab-button" data-key="settings">Settings</a></li>
                </ul>
            </div>
            
            <!-- Content tab fields -->
            <div class="acf-tab-content" data-tab="content">
                <!-- Is Widget field -->
                <div class="acf-field acf-field-true-false" data-name="is_widget" data-type="true_false">
                    <div class="acf-label">
                        <label>Is Widget?</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-true-false">
                            <input type="hidden" name="widget-favorite-cards[<?php echo $widget_number; ?>][is_widget]" value="0">
                            <label>
                                <input type="checkbox" name="widget-favorite-cards[<?php echo $widget_number; ?>][is_widget]" value="1" class="acf-switch-input" <?php checked($is_widget, 1); ?>>
                                <div class="acf-switch">
                                    <span class="acf-switch-on">Yes</span>
                                    <span class="acf-switch-off">No</span>
                                    <div class="acf-switch-slider"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Title Line 1 field -->
                <div class="acf-field acf-field-text" data-name="title_line_1" data-type="text">
                    <div class="acf-label">
                        <label>Title [line 1]</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-input-wrap">
                            <input type="text" name="widget-favorite-cards[<?php echo $widget_number; ?>][title_line_1]" value="<?php echo esc_attr($title_line_1); ?>">
                        </div>
                    </div>
                </div>
                
                <!-- Title Line 2 field -->
                <div class="acf-field acf-field-text" data-name="title_line_2" data-type="text">
                    <div class="acf-label">
                        <label>Title [line 2]</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-input-wrap">
                            <input type="text" name="widget-favorite-cards[<?php echo $widget_number; ?>][title_line_2]" value="<?php echo esc_attr($title_line_2); ?>">
                        </div>
                    </div>
                </div>
                
                <!-- Left Image field -->
                <div class="acf-field acf-field-image" data-name="left_image" data-type="image">
                    <div class="acf-label">
                        <label>Left Image</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-image-uploader<?php echo !empty($left_image) ? ' has-value' : ''; ?>" data-preview_size="medium" data-library="all" data-mime_types="">
                            <input type="hidden" name="widget-favorite-cards[<?php echo $widget_number; ?>][left_image]" value="<?php echo esc_attr($left_image); ?>">
                            <div class="show-if-value image-wrap" style="max-width: 300px">
                                <?php if (!empty($left_image)): 
                                    $image_url = wp_get_attachment_image_url($left_image, 'medium');
                                    $image_alt = get_post_meta($left_image, '_wp_attachment_image_alt', true);
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
                
                <!-- Favorite Cards Repeater field -->
                <div class="acf-field acf-field-repeater" data-name="favorite_cards" data-type="repeater">
                    <div class="acf-label">
                        <label>Favorite Cards</label>
                    </div>
                    <div class="acf-input">
                        <div class="acf-repeater -table" data-min="0" data-max="0">
                            <table class="acf-table">
                                <thead>
                                    <tr>
                                        <th class="acf-row-handle"></th>
                                        <th class="acf-th" data-name="fc_card_option">Card Option</th>
                                        <th class="acf-row-handle"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($favorite_cards)): ?>
                                        <?php foreach ($favorite_cards as $i => $card): ?>
                                            <tr class="acf-row" data-id="row-<?php echo $i; ?>">
                                                <td class="acf-row-handle order">
                                                    <span class="acf-row-number"><?php echo $i + 1; ?></span>
                                                </td>
                                                <td class="acf-field acf-field-select" data-name="fc_card_option">
                                                    <div class="acf-input">
                                                        <select name="widget-favorite-cards[<?php echo $widget_number; ?>][favorite_cards][<?php echo $i; ?>][fc_card_option]">
                                                            <?php
                                                            // Get credit cards from options
                                                            $credit_cards = get_field('credit_cards', 'option');
                                                            if ($credit_cards) {
                                                                foreach ($credit_cards as $card_index => $credit_card) {
                                                                    $selected = ($card['fc_card_option'] == $card_index) ? 'selected' : '';
                                                                    echo '<option value="' . esc_attr($card_index) . '" ' . $selected . '>' . esc_html($credit_card['cci_card_name']) . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="acf-row-handle remove">
                                                    <a class="acf-icon -plus small" href="#" data-event="add-row"></a>
                                                    <a class="acf-icon -minus small" href="#" data-event="remove-row"></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr class="acf-row" data-id="row-0">
                                            <td class="acf-row-handle order">
                                                <span class="acf-row-number">1</span>
                                            </td>
                                            <td class="acf-field acf-field-select" data-name="fc_card_option">
                                                <div class="acf-input">
                                                    <select name="widget-favorite-cards[<?php echo $widget_number; ?>][favorite_cards][0][fc_card_option]">
                                                        <?php
                                                        // Get credit cards from options
                                                        $credit_cards = get_field('credit_cards', 'option');
                                                        if ($credit_cards) {
                                                            foreach ($credit_cards as $card_index => $credit_card) {
                                                                echo '<option value="' . esc_attr($card_index) . '">' . esc_html($credit_card['cci_card_name']) . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="acf-row-handle remove">
                                                <a class="acf-icon -plus small" href="#" data-event="add-row"></a>
                                                <a class="acf-icon -minus small" href="#" data-event="remove-row"></a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="acf-actions">
                                <a class="acf-button button button-primary" href="#" data-event="add-row">Add Row</a>
                            </div>
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
                            <input type="text" name="widget-favorite-cards[<?php echo $widget_number; ?>][cta_label]" value="<?php echo esc_attr($cta_label); ?>">
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
                            <input type="url" name="widget-favorite-cards[<?php echo $widget_number; ?>][cta_url]" value="<?php echo esc_url($cta_url); ?>">
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
                        <select name="widget-favorite-cards[<?php echo $widget_number; ?>][background_type]">
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