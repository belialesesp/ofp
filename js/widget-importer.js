(function($) {
    // Wait for ACF to initialize
    acf.add_action('ready', function() {
        // Listen for changes to the widget area field
        acf.addAction('load_field/name=selected_widget', function(field) {
            // Get the widget area field
            var $widget_area_field = $('[data-key="field_widget_area"]').find('select');
            
            // Update the selected widget field when the widget area changes
            $widget_area_field.on('change', function() {
                // Get the new widget area value
                var widget_area = $(this).val();
                
                // Reset the selected widget field
                field.val('');
                
                // Trigger an update to the selected widget field
                acf.doAction('refresh', field.$el);
            });
        });
    });
})(jQuery);