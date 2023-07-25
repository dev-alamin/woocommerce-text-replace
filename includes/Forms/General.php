<?php
namespace ADS\WTC\Forms;

use ADS\WTC\Interface\Page;
use ADS\WTC\Traits\Validate_Input;

class General implements Page
{
    use Validate_Input;

    public function fire_hook(): void
    {

        // Hook into WooCommerce filters to modify the General Settings Tab
        add_filter('woocommerce_product_related_products_heading', array($this, 'modify_related_product_title'));
        add_filter('woocommerce_product_upsells_products_heading', array($this, 'modify_cross_sells_columns'));
        add_filter('woocommerce_product_cross_sells_products_heading', array($this, 'modify_upsell_display_args'));
        add_filter('woocommerce_product_filter_text', array($this, 'modify_filter_products_label'));
        add_filter('woocommerce_product_show_more_text', array($this, 'modify_show_more_products_label'));
        add_filter('woocommerce_product_show_less_text', array($this, 'modify_show_less_products_label'));
        add_filter('woocommerce_proceed_to_checkout', array($this, 'modify_proceed_to_payment_label'));
        add_filter('woocommerce_checkout_terms_and_conditions_text', array($this, 'modify_terms_and_conditions_label'));
        add_filter('gettext', array($this, 'modify_coupon_code_label'), 20, 3);
        add_filter('gettext', [ $this, 'modify_coupon_button_text'], 20,3 );
    }

    // Function to handle form submission and save data
    public function submit_form(): void
    {
        // Check if the form has been submitted
        if (isset($_POST['general_page'])) {

            if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'wc_text_replace_general_nonce')) {
                wp_die('Security check failed. Please try again.');
            }

            if (!current_user_can('manage_options')) {
                wp_die(__('You do not have permission to save this form.', 'wc-text-replace'));
            }

            $general_settings_fields = array();
            // Fields for general settings
            $general_settings_fields = array(
                'related_product_title',
                'cross_sells_title',
                'upsells_title',
                'filter_products_label',
                'show_more_products_label',
                'show_less_products_label',
                'proceed_to_payment_label',
                'terms_and_conditions_label',
                'coupon_code_label',
                'modify_coupon_button_text',
                // Add more fields as needed
            );

            // Sanitize and validate form data for general settings
            $general_settings = array();
            foreach ($general_settings_fields as $field) {
                $general_settings[$field] = $this->sanitize($_POST['wc_text_replace_general_page'][$field]);
            }
            
            // Now you have the form values in the $general_settings array
            // You can use them to update the respective options or perform other actions.
            // For example:
            update_option('wc_text_replace_general_page', $general_settings);
        }
    }

    public function modify_related_product_title( $new_text )
    {
        $general_settings = get_option('wc_text_replace_general_page', array());
        $related_product_title = isset($general_settings['related_product_title']) ? $general_settings['related_product_title'] : '';
    
        // Provide a default value for the related product title
        $default_related_title = __('Related products', 'wc-text-replace');
    
        // Use the custom related product title if available, otherwise use the default
        $new_text = !empty($related_product_title) ? esc_html__($related_product_title, 'wtc-text-replace') : $default_related_title;
    
        return $new_text;
    }
    
    public function modify_cross_sells_columns($modified_text)
    {
        $general_settings = get_option('wc_text_replace_general_page', array());
        $cross_sells_text = isset($general_settings['cross_sells_title']) ? sanitize_text_field($general_settings['cross_sells_title']) : '';
    
        // Provide a default value for the custom cross sells title
        $default_cross_sells_title = __( 'You may also like…', 'wc-text-replace' );
        // Use the custom cross sells title if available, otherwise use the default
        $modified_text = !empty($cross_sells_text) ? esc_html__($cross_sells_text, 'wtc-text-replace') : $default_cross_sells_title;
    
        return $modified_text;
    }
    

    public function modify_upsell_display_args($args)
    {
        $general_settings = get_option('wc_text_replace_general_page', array());
        $upsells_title = isset($general_settings['upsells_title']) ? sanitize_text_field($general_settings['upsells_title']) : __( 'You may be interested in&hellip;', 'wc-text-replace') ;

        if (!empty($upsells_title)) {
            // Modify the upsells title
            $args['title'] = esc_html($upsells_title);
        }

        return $args;
    }

    public function modify_filter_products_label($label)
    {
        $general_settings = get_option('wc_text_replace_general_page', array());
        $filter_products_label = isset($general_settings['filter_products_label']) ? sanitize_text_field($general_settings['filter_products_label']) : '';

        if (!empty($filter_products_label)) {
            // Modify the filter products label
            $label = esc_html($filter_products_label);
        }

        return $label;
    }

    public function modify_show_more_products_label($label)
    {
        $general_settings = get_option('wc_text_replace_general_page', array());
        $show_more_products_label = isset($general_settings['show_more_products_label']) ? sanitize_text_field($general_settings['show_more_products_label']) : '';

        if (!empty($show_more_products_label)) {
            // Modify the show more products label
            $label = esc_html($show_more_products_label);
        }

        return $label;
    }

    public function modify_show_less_products_label($label)
    {
        $general_settings = get_option('wc_text_replace_general_page', array());
        $show_less_products_label = isset($general_settings['show_less_products_label']) ? $general_settings['show_less_products_label'] : '';

        if (!empty($show_less_products_label)) {
            // Modify the "Show Less Products" label
            $label = esc_html($show_less_products_label);
        }

        return $label;
    }

    public function modify_proceed_to_payment_label($label)
    {
        $general_settings = get_option('wc_text_replace_general_page', array());
        $proceed_to_payment_label = isset($general_settings['proceed_to_payment_label']) ? $general_settings['proceed_to_payment_label'] : '';

        if (!empty($proceed_to_payment_label)) {
            // Modify the "Proceed to Payment" label
            $label = esc_html($proceed_to_payment_label);
        }

        return $label;
    }

    public function modify_terms_and_conditions_label($label)
    {
        $general_settings = get_option('wc_text_replace_general_page', array());
        $terms_and_conditions_label = isset($general_settings['terms_and_conditions_label']) ? $general_settings['terms_and_conditions_label'] : '';

        if (!empty($terms_and_conditions_label)) {
            // Modify the "Terms and Conditions" label
            $label = esc_html($terms_and_conditions_label);
        }

        return $label;
    }

    public function modify_coupon_code_label($translated_text, $text, $label)
    {
        // Check if the translated text is related to the coupon label
        if ($text === 'Coupon code') {
            $general_settings = get_option('wc_text_replace_general_page', array());
            $coupon_code_label = isset($general_settings['coupon_code_label']) ? $general_settings['coupon_code_label'] : '';
    
            // Modify the coupon label text here as per your requirement
            if (!empty($coupon_code_label)) {
                $translated_text = esc_html($coupon_code_label);
            }
        }
    
        return $translated_text;
    }
    

    public function modify_coupon_button_text($translated_text, $text, $label)
    {
        if ($text === 'Apply coupon') {
            $general_settings = get_option('wc_text_replace_general_page', array());
            $modify_coupon_button_text = isset($general_settings['modify_coupon_button_text']) ? $general_settings['modify_coupon_button_text'] : '';
            
            if (!empty($modify_coupon_button_text)) {
                // Modify the "Apply coupon" button text
                $translated_text = esc_html($modify_coupon_button_text);
            }
        }
        
        return $translated_text;
    }
    


}