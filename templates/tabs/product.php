<div id="product-page-settings" class="tab-pane">
    <form method="post" action="">
        <input type="hidden" name="action" value="wc_text_replace_save_product_page_settings">
        <?php wp_nonce_field('wc_text_replace_product_nonce'); ?>
        <h2><?php echo __('Product Page Settings', 'wc-text-replace'); ?></h2>
        <?php
        // Product Page Settings Array
        $product_page_settings = get_option('wc_text_replace_product_page', array());

        // Define the input fields and their labels with placeholders
        $input_fields = array(
            'flash_sale_text' => __('Flash Sale Text', 'wc-text-replace'),
            'add_to_cart_button_text' => __('Add to Cart Button Text', 'wc-text-replace'),
            'availability_text' => __('Availability Text', 'wc-text-replace'),
            'product_description' => __('Product Description', 'wc-text-replace'),
            'additional_information_tab_title' => __('Additional Information Tab Title', 'wc-text-replace'),
            'reviews_tab_title' => __('Reviews Tab Title', 'wc-text-replace'),
            'select_options_button_text' => __('Select Options Button Text', 'wc-text-replace'),
            'read_more_button_text' => __('Read More Button Text', 'wc-text-replace'),
            'out_of_stock_label' => __('Out of Stock Label', 'wc-text-replace'),
            'in_stock_label' => __('In Stock Label', 'wc-text-replace'),
            'availability_text_label' => __('Availability Text', 'wc-text-replace'),
            'product_category_label' => __('Product Category Label', 'wc-text-replace'),
            'product_tags_label' => __('Product Tags Label', 'wc-text-replace'),
            'related_products_title' => __('Related Products Title', 'wc-text-replace'),
            'upsells_title' => __('Upsells Title', 'wc-text-replace'),
            'cross_sells_title' => __('Cross-Sells Title', 'wc-text-replace'),
        );

        // Loop through the input fields and create the form elements
        foreach ($input_fields as $option_name => $label) {
            $value = isset($product_page_settings[$option_name]) ? sanitize_text_field($product_page_settings[$option_name]) : '';
            ?>
            <div class="form-group">
                <label for="<?php echo $option_name; ?>"><?php echo $label; ?>:</label>
                <input type="text" class="form-control" id="<?php echo $option_name; ?>" name="wc_text_replace_product_page[<?php echo $option_name; ?>]" value="<?php echo esc_attr($value); ?>">
            </div>
        <?php } ?>
        <!-- Add more input fields for Product Page Settings as needed -->
        <?php submit_button(__('Save Changes', 'wc-text-replace'), 'primary', 'product_page'); ?>
    </form>

</div>
