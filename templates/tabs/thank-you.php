<div id="thank-you-page-settings" class="tab-pane">
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="wc_text_replace_save_thank_you_page_settings">
        <?php wp_nonce_field('wc_text_replace_save_thank_you_page_settings_nonce', 'wc_text_replace_thank_you_page_settings_nonce'); ?>
        <h2><?php echo __('Thank You Page Settings', 'wc-text-replace'); ?></h2>
        <?php
        // Thank You Page Settings Array
        $thank_you_page_settings = get_option('wc_text_replace_settings', array());

        // Define the input fields and their labels with placeholders
        $input_fields = array(
            'order_received_title' => __('Order Received Title', 'wc-text-replace'),
            'order_details_section_title' => __('Order Details Section Title', 'wc-text-replace'),
            'order_details_text' => array(
                'order_number' => __('Order Number:', 'wc-text-replace') . ' {order_number}',
                'order_date' => __('Order Date:', 'wc-text-replace') . ' {order_date}',
                'payment_method' => __('Payment Method:', 'wc-text-replace') . ' {payment_method}',
            ),
            'customer_details_section_title' => __('Customer Information', 'wc-text-replace'),
            'customer_details_text' => array(
                'name' => __('Name:', 'wc-text-replace') . ' {billing_first_name} {billing_last_name}',
                'email' => __('Email:', 'wc-text-replace') . ' {billing_email}',
            ),
            'order_summary_section_title' => __('Order Summary', 'wc-text-replace'),
            'order_summary_subtotal_text' => __('Subtotal:', 'wc-text-replace') . ' {order_subtotal}',
            'order_summary_total_text' => __('Total:', 'wc-text-replace') . ' {order_total}',
            'order_summary_shipping_text' => __('Shipping:', 'wc-text-replace') . ' {order_shipping}',
            'order_summary_payment_text' => __('Payment Method:', 'wc-text-replace') . ' {order_payment_method}',
        );

        // Loop through the input fields and create the form elements
        foreach ($input_fields as $option_name => $label) {
            if (is_array($label)) {
                echo '<div class="form-group">';
                echo '<label>' . $option_name . ':</label><br>';
                foreach ($label as $sub_option_name => $sub_label) {
                    $value = isset($thank_you_page_settings['thank_you_page_settings'][$option_name][$sub_option_name]) ? sanitize_text_field($thank_you_page_settings['thank_you_page_settings'][$option_name][$sub_option_name]) : '';
                    echo '<input type="text" class="form-control" name="wc_text_replace_settings[thank_you_page_settings][' . $option_name . '][' . $sub_option_name . ']" value="' . esc_attr($value) . '" placeholder="' . $sub_label . '"><br>';
                }
                echo '</div>';
            } else {
                $value = isset($thank_you_page_settings['thank_you_page_settings'][$option_name]) ? sanitize_text_field($thank_you_page_settings['thank_you_page_settings'][$option_name]) : '';
                echo '<div class="form-group">';
                echo '<label for="' . $option_name . '">' . $label . ':</label>';
                echo '<input type="text" class="form-control" id="' . $option_name . '" name="wc_text_replace_settings[thank_you_page_settings][' . $option_name . ']" value="' . esc_attr($value) . '" placeholder="' . $label . '">';
                echo '</div>';
            }
        }
        ?>
        <!-- Add more input fields for Thank You Page Settings as needed -->
        <?php submit_button(__('Save Changes', 'wc-text-replace')); ?>
    </form>
</div>
