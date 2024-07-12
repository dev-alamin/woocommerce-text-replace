<?php 
namespace ADS\WTC\Forms;

use ADS\WTC\Interface\Page;
use ADS\WTC\Traits\Validate_Input;

class ThankYou implements Page {
    use Validate_Input;

    public function fire_hook(): void
    {
        // Hook into WooCommerce actions and filters to modify the Thank You page
        
        add_filter('woocommerce_thankyou_order_received_text', [$this, 'modify_order_received_title'], 10, 2);
        
        add_filter('woocommerce_thankyou_order_details_heading', [$this, 'modify_order_details_section_title']);
        
        add_filter('woocommerce_thankyou_order_details_before_order_table', [$this, 'modify_order_details_text'], 10, 2);
        
        add_filter('woocommerce_thankyou_customer_details_heading', [$this, 'modify_customer_details_section_title']);
        
        add_filter('woocommerce_thankyou_customer_details_before_customer', [$this, 'modify_customer_details_text'], 10, 2);
        
        add_filter('woocommerce_thankyou_order_details_after_order_table', [$this, 'modify_order_summary_section_title']);
        
        add_filter('woocommerce_thankyou_order_subtotal', [$this, 'modify_order_summary_subtotal_text'], 10, 2);
        
        add_filter('woocommerce_thankyou_order_total', [$this, 'modify_order_summary_total_text'], 10, 2);
        
        add_filter('woocommerce_thankyou_order_shipping', [$this, 'modify_order_summary_shipping_text'], 10, 2);
        
        add_filter('woocommerce_thankyou_order_payment_method', [$this, 'modify_order_summary_payment_text'], 10, 2);
        
    }

    public function submit_form(): void {
        // Check if the form has been submitted
        if (isset($_POST['thankyou_page'])) {

            // Verify nonce
            if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'wc_text_replace_save_thank_you_page_settings_nonce')) {
                wp_die('Security check failed. Please try again.');
            }

            // Check user capabilities
            if (!current_user_can('manage_options')) {
                wp_die(__('You do not have permission to save this form.', 'wc-text-replace'));
            }

            // Sanitize and validate form data
            $thank_you_page_settings = array();

            // List of fields to sanitize
            $fields_to_sanitize = array(
                'order_received_title',
                'order_details_section_title',
                'order_details_text'          => array(
                    'order_number',
                    'order_date',
                    'payment_method'
                ),
                'customer_details_section_title',
                'customer_details_text'        => array(
                    'name',
                    'email'
                ),
                'order_summary_section_title',
                'order_summary_subtotal_text',
                'order_summary_total_text',
                'order_summary_shipping_text',
                'order_summary_payment_text'
            );

            // Sanitize each field
            foreach ($fields_to_sanitize as $field => $label) {
                if (is_array($label)) {
                    foreach ($label as $sub_field) {
                        if (isset($_POST['wc_text_replace_settings']['thank_you_page_settings'][$field][$sub_field])) {
                            $thank_you_page_settings[$field][$sub_field] = sanitize_text_field($_POST['wc_text_replace_settings']['thank_you_page_settings'][$field][$sub_field]);
                        }
                    }
                } else {
                    if (isset($_POST['wc_text_replace_settings']['thank_you_page_settings'][$label])) {
                        $thank_you_page_settings[$label] = sanitize_text_field($_POST['wc_text_replace_settings']['thank_you_page_settings'][$label]);
                    }
                }
            }

            // Save the sanitized settings
            update_option('wc_text_replace_settings', ['thank_you_page_settings' => $thank_you_page_settings]);
        }
    }

    // Methods to modify the respective fields
    public function modify_order_received_title($text, $order) {
        $settings = get_option('wc_text_replace_settings');
        return isset($settings['thank_you_page_settings']['order_received_title']) ? $settings['thank_you_page_settings']['order_received_title'] : $text;
    }

    public function modify_order_details_section_title($heading) {
        $settings = get_option('wc_text_replace_settings');
        return isset($settings['thank_you_page_settings']['order_details_section_title']) ? $settings['thank_you_page_settings']['order_details_section_title'] : $heading;
    }

    public function modify_order_details_text($text, $order) {
        $settings = get_option('wc_text_replace_settings');
        if (isset($settings['thank_you_page_settings']['order_details_text'])) {
            foreach ($settings['thank_you_page_settings']['order_details_text'] as $key => $value) {
                $text = str_replace("{" . $key . "}", $order->$key, $value);
            }
        }
        return $text;
    }

    public function modify_customer_details_section_title($heading) {
        $settings = get_option('wc_text_replace_settings');
        return isset($settings['thank_you_page_settings']['customer_details_section_title']) ? $settings['thank_you_page_settings']['customer_details_section_title'] : $heading;
    }

    public function modify_customer_details_text($text, $order) {
        $settings = get_option('wc_text_replace_settings');
        if (isset($settings['thank_you_page_settings']['customer_details_text'])) {
            foreach ($settings['thank_you_page_settings']['customer_details_text'] as $key => $value) {
                $text = str_replace("{" . $key . "}", $order->$key, $value);
            }
        }
        return $text;
    }

    public function modify_order_summary_section_title($heading) {
        $settings = get_option('wc_text_replace_settings');
        return isset($settings['thank_you_page_settings']['order_summary_section_title']) ? $settings['thank_you_page_settings']['order_summary_section_title'] : $heading;
    }

    public function modify_order_summary_subtotal_text($text, $order) {
        $settings = get_option('wc_text_replace_settings');
        return isset($settings['thank_you_page_settings']['order_summary_subtotal_text']) ? str_replace('{order_subtotal}', $order->get_subtotal(), $settings['thank_you_page_settings']['order_summary_subtotal_text']) : $text;
    }

    public function modify_order_summary_total_text($text, $order) {
        $settings = get_option('wc_text_replace_settings');
        return isset($settings['thank_you_page_settings']['order_summary_total_text']) ? str_replace('{order_total}', $order->get_total(), $settings['thank_you_page_settings']['order_summary_total_text']) : $text;
    }

    public function modify_order_summary_shipping_text($text, $order) {
        $settings = get_option('wc_text_replace_settings');
        return isset($settings['thank_you_page_settings']['order_summary_shipping_text']) ? str_replace('{order_shipping}', $order->get_shipping_total(), $settings['thank_you_page_settings']['order_summary_shipping_text']) : $text;
    }

    public function modify_order_summary_payment_text($text, $order) {
        $settings = get_option('wc_text_replace_settings');
        return isset($settings['thank_you_page_settings']['order_summary_payment_text']) ? str_replace('{order_payment_method}', $order->get_payment_method_title(), $settings['thank_you_page_settings']['order_summary_payment_text']) : $text;
    }
}
