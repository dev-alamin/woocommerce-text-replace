<div id="checkout-page-settings" class="tab-pane">
    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
        <input type="hidden" name="action" value="wc_text_replace_save_checkout_page_settings">
        <?php wp_nonce_field('wc_text_replace_save_checkout_page_settings_nonce', 'wc_text_replace_checkout_page_settings_nonce'); ?>
        <h2><?php echo __('Checkout Page Settings', 'wc-text-replace'); ?></h2>
        <?php
        // Checkout Page Settings Array
        $checkout_page_settings = get_option('wc_text_replace_settings', array());

        // Define the input fields and their labels with placeholders
        $input_fields = array(
            'checkout_title' => __('Checkout Title', 'wc-text-replace'),
            'order_review_title' => __('Order Review Title', 'wc-text-replace'),
            'billing_details_section_title' => __('Billing Details Section Title', 'wc-text-replace'),
            'shipping_details_section_title' => __('Shipping Details Section Title', 'wc-text-replace'),
            'order_notes_label' => __('Order Notes Label', 'wc-text-replace'),
            'order_review_subtotal_text' => __('Order Review Subtotal Text', 'wc-text-replace'),
            'order_review_total_text' => __('Order Review Total Text', 'wc-text-replace'),
            'order_review_place_order_button_text' => __('Order Review Place Order Button Text', 'wc-text-replace'),
            // Add more fields as needed
        );

        // Loop through the input fields and create the form elements
        foreach ($input_fields as $option_name => $label) {
            $value = isset($checkout_page_settings[$option_name]) ? sanitize_text_field($checkout_page_settings[$option_name]) : '';
            ?>
            <div class="form-group">
                <label for="<?php echo $option_name; ?>"><?php echo $label; ?>:</label>
                <input type="text" class="form-control" id="<?php echo $option_name; ?>" name="wc_text_replace_settings[<?php echo $option_name; ?>]" value="<?php echo esc_attr($value); ?>" placeholder="<?php echo esc_attr($label); ?>">
            </div>
        <?php } ?>
        <!-- Add more input fields for Checkout Page Settings as needed -->
        <?php submit_button(__('Save Changes', 'wc-text-replace')); ?>
    </form>
</div>
