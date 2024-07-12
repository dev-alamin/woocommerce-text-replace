<!-- General Settings Tab -->
<div id="general-settings" class="tab-pane show active">
    <form method="post" action="">
        <input type="hidden" name="action" value="wc_text_replace_save_general_settings">
        <?php wp_nonce_field('wc_text_replace_general_nonce'); ?>
        <h2><?php echo __('General Settings', 'wc-text-replace'); ?></h2>
        <?php
        // General Settings Array
        $general_settings = get_option('wc_text_replace_general_page', array());

        // Define the input fields and their labels with placeholders
        $input_fields = array(
            'related_product_title' => __('Related Product Title', 'wc-text-replace'),
            'cross_sells_title' => __('Cross-Sells Title', 'wc-text-replace'),
            'upsells_title' => __('Upsells Title', 'wc-text-replace'),
            'filter_products_label' => __('Filter Products Label', 'wc-text-replace'),
            'show_more_products_label' => __('Show More Products Label', 'wc-text-replace'),
            'show_less_products_label' => __('Show Less Products Label', 'wc-text-replace'),
            'proceed_to_payment_label' => __('Proceed to Payment Label', 'wc-text-replace'),
            'terms_and_conditions_label' => __('Terms and Conditions Label', 'wc-text-replace'),
            'coupon_code_label' => __('Coupon Code Label', 'wc-text-replace'),
            'modify_coupon_button_text' => __('Modify Coupon Button Text', 'wc-text-replace'),
            // Add more fields as needed
        );

        // Loop through the input fields and create the form elements
        echo '<div class="input-wrapper">';
        foreach ($input_fields as $option_name => $label) {
            $value = isset($general_settings[$option_name]) ? sanitize_text_field($general_settings[$option_name]) : '';
            ?>
            <div class="form-group">
                <label for="<?php echo $option_name; ?>"><?php echo $label; ?>:</label>
                <input type="text" class="form-control" id="<?php echo $option_name; ?>" name="wc_text_replace_general_page[<?php echo $option_name; ?>]" value="<?php echo esc_attr($value); ?>">
            </div>
        <?php } ?>
        </div>
        <!-- Add more input fields for General Settings as needed -->
        <?php submit_button(__('Save Changes', 'wc-text-replace'), 'primary', 'general_page' ); ?>
    </form>
</div>
