<div id="archive-page-settings" class="tab-pane">
    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
        <input type="hidden" name="action" value="wc_text_replace_save_archive_page_settings">
        <?php wp_nonce_field('wc_text_replace_save_archive_page_settings_nonce', 'wc_text_replace_archive_page_settings_nonce'); ?>
        <h2><?php echo __('Archive/Shop Page Settings', 'wc-text-replace'); ?></h2>
        <?php
        // Archive/Shop Page Settings Array
        $archive_page_settings = get_option('archive_page_settings', array());

        // Define the input fields and their labels
        $input_fields = array(
            'category_title' => __('Category Title', 'wc-text-replace'),
            'product_title' => __('Product Title', 'wc-text-replace'),
            'product_price' => __('Product Price', 'wc-text-replace'),
            'sale_price_label' => __('Sale Price Label', 'wc-text-replace'),
            'out_of_stock_label' => __('Out of Stock Label', 'wc-text-replace'),
            'pagination_text' => __('Pagination Text', 'wc-text-replace'),
            'sorting_options_labels' => __('Sorting Options Labels', 'wc-text-replace'),
        );

        // Loop through the input fields and create the form elements
        echo '<div class="input-wrapper">';
        foreach ($input_fields as $option_name => $label) {
            $value = isset($archive_page_settings[$option_name]) ? sanitize_text_field($archive_page_settings[$option_name]) : '';
            ?>
            <div class="form-group">
                <label for="<?php echo $option_name; ?>"><?php echo $label; ?>:</label>
                <input type="text" class="form-control" id="<?php echo $option_name; ?>" name="archive_page_settings[<?php echo $option_name; ?>]" value="<?php echo $value; ?>">
            </div>
        <?php } ?>
        </div>
        <!-- Add more input fields for Archive/Shop Page Settings as needed -->
        <?php submit_button(__('Save Changes', 'wc-text-replace')); ?>
    </form>
</div>
