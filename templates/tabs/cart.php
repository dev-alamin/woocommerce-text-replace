<div id="cart-page-settings" class="tab-pane">
    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
        <input type="hidden" name="action" value="wc_text_replace_save_cart_page_settings">
        <?php wp_nonce_field('wc_text_replace_save_cart_page_settings_nonce', 'wc_text_replace_cart_page_settings_nonce'); ?>
        <h2><?php echo __('Cart Page Settings', 'wc-text-replace'); ?></h2>
        <?php
        // Cart Page Settings Array
        $cart_page_settings = get_option('wc_text_replace_settings', array());

        // Define the input fields and their labels with placeholders
        $input_fields = array(
            'cart_title' => __('Cart Title', 'wc-text-replace'),
            'empty_cart_message' => __('Empty Cart Message', 'wc-text-replace'),
            'cart_subtotal_text' => __('Cart Subtotal Text', 'wc-text-replace'),
            'cart_total_text' => __('Cart Total Text', 'wc-text-replace'),
            'cart_empty_button_text' => __('Cart Empty Button Text', 'wc-text-replace'),
            'update_cart_button_text' => __('Update Cart Button Text', 'wc-text-replace'),
            'proceed_to_checkout_button_text' => __('Proceed to Checkout Button Text', 'wc-text-replace'),
        );

        // Loop through the input fields and create the form elements
        foreach ($input_fields as $option_name => $label) {
            $value = isset($cart_page_settings[$option_name]) ? sanitize_text_field($cart_page_settings[$option_name]) : '';
            ?>
            <div class="form-group">
                <label for="<?php echo $option_name; ?>"><?php echo $label; ?>:</label>
                <input type="text" class="form-control" id="<?php echo $option_name; ?>" name="wc_text_replace_settings[<?php echo $option_name; ?>]" value="<?php echo esc_attr($value); ?>" placeholder="<?php echo esc_attr($label); ?>">
            </div>
        <?php } ?>
        <!-- Add more input fields for Cart Page Settings as needed -->
        <?php submit_button(__('Save Changes', 'wc-text-replace')); ?>
    </form>
</div>
