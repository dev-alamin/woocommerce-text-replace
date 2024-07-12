<?php
namespace ADS\WTC\Forms;
use ADS\WTC\Interface\Page;
use ADS\WTC\Traits\Validate_Input;

class Product implements Page {

    use Validate_Input;

    public function fire_hook():void{
        // Hook into WooCommerce filters to modify the product page
        add_filter('woocommerce_sale_flash', [ $this, 'modify_flash_sale_text' ], 10, 3);

        add_filter('woocommerce_product_single_add_to_cart_text', [ $this, 'modify_add_to_cart_button_text' ]);

        add_filter('woocommerce_get_stock_html', [ $this, 'modify_availability_text' ], 10, 2);

        add_filter('woocommerce_product_description_heading', [ $this, 'modify_product_description' ]);

        add_filter('woocommerce_product_description_tab_title', [ $this, 'modify_product_description' ]);

        add_filter('woocommerce_product_additional_information_heading', [ $this, 'modify_additional_information_tab_title' ]);

        add_filter('woocommerce_product_additional_information_tab_title', [ $this, 'modify_additional_information_tab_title' ]);

        add_filter('woocommerce_product_reviews_tab_title', [ $this, 'modify_reviews_tab_title' ]);

        add_filter('woocommerce_dropdown_variation_attribute_options_args', [ $this, 'modify_select_options_button_text' ], 15 );
        
        add_filter('woocommerce_product_read_more_description', [ $this, 'modify_read_more_button_text' ]);
        
        add_filter('woocommerce_product_out_of_stock_text', [ $this, 'modify_out_of_stock_label' ]);
        
        add_filter('woocommerce_product_in_stock_text', [ $this, 'modify_in_stock_label' ]);
        
        add_filter('woocommerce_get_availability', [ $this, 'modify_availability_text_label' ], 10, 2);
        
        add_filter('woocommerce_product_category_heading', [ $this, 'modify_product_category_label' ]);
        
        add_filter('woocommerce_product_tag_heading', [ $this, 'modify_product_tags_label' ]);
        
        add_filter('woocommerce_related_products_heading', [ $this, 'modify_related_products_title' ]);
        
        add_filter('woocommerce_upsell_display_args', [ $this, 'modify_upsells_title' ]);
        
        add_filter('woocommerce_cross_sells_display_args', [ $this, 'modify_cross_sells_title' ]);
    }

    // Function to handle form submission and save data
    public function submit_form():void {
        // Check if the form has been submitted
        if (isset($_POST['product_page'])) {

            if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'wc_text_replace_product_nonce' ) ) {
                wp_die('Security check failed. Please try again.');
            }
    
            if ( ! current_user_can( 'manage_options' ) ) {
                wp_die( __('You do not have permission to save this form.', 'wc-text-replace') );
            }

            // Sanitize and validate form data
            $product_page_settings = array();

            // List of fields to sanitize
            $fields_to_sanitize = array(
                'flash_sale_text',
                'add_to_cart_button_text',
                'availability_text',
                'product_description',
                'additional_information_tab_title',
                'reviews_tab_title',
                'select_options_button_text',
                'read_more_button_text',
                'out_of_stock_label',
                'in_stock_label',
                'availability_text_label',
                'product_category_label',
                'product_tags_label',
                'related_products_title',
                'upsells_title',
                'cross_sells_title',
            );

            foreach ($fields_to_sanitize as $field) {
                $product_page_settings[$field] = $this->sanitize( $_POST['wc_text_replace_product_page'][$field] );
            }
       
        
            // Now you have the form values in the $product_page_settings array
            // You can use them to update the respective options or perform other actions.
            // For example:
            update_option('wc_text_replace_product_page', $product_page_settings);
        }

    }

      // Function to modify product page based on saved options


    // Functions to handle modifications for each option using filter hooks
    public function modify_flash_sale_text($html, $post, $product) {
        $product_page_settings = get_option('wc_text_replace_product_page', array());
        $flash_sale_text       = isset($product_page_settings['flash_sale_text']) ? $product_page_settings['flash_sale_text'] : '';
    
        if (!empty($flash_sale_text)) {
            // Modify the flash sale text
            $html = '<span class="onsale">' . esc_html($flash_sale_text) . '</span>';
        }
    
        return $html;
    }
    
    public function modify_add_to_cart_button_text($text) {
        $product_page_settings   = get_option('wc_text_replace_product_page', array());
        $add_to_cart_button_text = isset($product_page_settings['add_to_cart_button_text']) ? $product_page_settings['add_to_cart_button_text'] : '';
    
        if (!empty($add_to_cart_button_text)) {
            // Modify the "Add to Cart" button text
            $text = esc_html($add_to_cart_button_text);
        }
    
        return $text;
    }
    
    public function modify_availability_text($availability, $product) {
        $product_page_settings = get_option('wc_text_replace_product_page', array());
        $availability_text     = isset($product_page_settings['availability_text']) ? $product_page_settings['availability_text'] : '';
    
        if (!empty($availability_text)) {
            // Modify the availability text
            $availability = esc_html($availability_text);
        }
    
        return $availability;
    }
    
    public function modify_product_description($content) {
        $product_page_settings = get_option('wc_text_replace_product_page', array());
        $product_description   = isset($product_page_settings['product_description']) ? $product_page_settings['product_description'] : '';
    
        if (!empty($product_description)) {
            // Modify the product description
            $content = esc_html($product_description);
        }
    
        return $content;
    }
    
    public function modify_additional_information_tab_title($title) {
        $product_page_settings            = get_option('wc_text_replace_product_page', array());
        $additional_information_tab_title = isset($product_page_settings['additional_information_tab_title']) ? $product_page_settings['additional_information_tab_title'] : '';
    
        if (!empty($additional_information_tab_title)) {
            // Modify the additional information tab title
            $title = esc_html($additional_information_tab_title);
        }
    
        return $title;
    }
    
    public function modify_reviews_tab_title($title) {
        $product_page_settings = get_option('wc_text_replace_product_page', array());
        $reviews_tab_title     = isset($product_page_settings['reviews_tab_title']) ? $product_page_settings['reviews_tab_title'] : '';
    
        if ( ! empty( $reviews_tab_title )) {
            // Modify the reviews tab title
            $title = esc_html( $reviews_tab_title );
        }
    
        return $title;
    }
    
    public function modify_select_options_button_text( $args ) {
        $product_page_settings      = get_option('wc_text_replace_product_page', array());
        $select_options_button_text = isset($product_page_settings['select_options_button_text']) ? $product_page_settings['select_options_button_text'] : '';
    
        if ( ! empty( $select_options_button_text ) ) {
            // Modify the select options button text
            $args['show_option_none'] = __( $select_options_button_text, 'woocommerce' ); // Change 'Select an option' to your custom text
        }
    
        return $args;
    }
    
    public function modify_read_more_button_text($text) {
        $product_page_settings = get_option('wc_text_replace_product_page', array());
        $read_more_button_text = isset($product_page_settings['read_more_button_text']) ? $product_page_settings['read_more_button_text'] : '';
    
        if (!empty($read_more_button_text)) {
            // Modify the read more button text
            $text = esc_html($read_more_button_text);
        }
    
        return $text;
    }
    
    public function modify_out_of_stock_label($text) {
        $product_page_settings = get_option('wc_text_replace_product_page', array());
        $out_of_stock_label    = isset($product_page_settings['out_of_stock_label']) ? $product_page_settings['out_of_stock_label'] : '';
    
        if (!empty($out_of_stock_label)) {
            // Modify the out of stock label
            $text = esc_html($out_of_stock_label);
        }
    
        return $text;
    }

    public function modify_in_stock_label($text) {
        $product_page_settings = get_option('wc_text_replace_product_page', array());
        $in_stock_label        = isset($product_page_settings['in_stock_label']) ? $product_page_settings['in_stock_label'] : '';
    
        if (!empty($in_stock_label)) {
            // Modify the in stock label
            $text = esc_html($in_stock_label);
        }
    
        return $text;
    }
    
    public function modify_availability_text_label($availability, $product) {
        $product_page_settings   = get_option('wc_text_replace_product_page', array());
        $availability_text_label = isset($product_page_settings['availability_text_label']) ? $product_page_settings['availability_text_label'] : '';
    
        if (!empty($availability_text_label)) {
            // Modify the availability text label
            $availability['availability'] = esc_html($availability_text_label);
        }
    
        return $availability;
    }
    
    public function modify_product_category_label($text) {
        $product_page_settings  = get_option('wc_text_replace_product_page', array());
        $product_category_label = isset($product_page_settings['product_category_label']) ? $product_page_settings['product_category_label'] : '';
    
        if (!empty($product_category_label)) {
            // Modify the product category label
            $text = esc_html($product_category_label);
        }
    
        return $text;
    }
    
    public function modify_product_tags_label($text) {
        $product_page_settings = get_option('wc_text_replace_product_page', array());
        $product_tags_label    = isset($product_page_settings['product_tags_label']) ? $product_page_settings['product_tags_label'] : '';
    
        if (!empty($product_tags_label)) {
            // Modify the product tags label
            $text = esc_html($product_tags_label);
        }
    
        return $text;
    }
    
    public function modify_related_products_title($text) {
        $product_page_settings  = get_option('wc_text_replace_product_page', array());
        $related_products_title = isset($product_page_settings['related_products_title']) ? $product_page_settings['related_products_title'] : '';
    
        if (!empty($related_products_title)) {
            // Modify the related products title
            $text = esc_html($related_products_title);
        }
    
        return $text;
    }
    
    public function modify_upsells_title($args) {
        $product_page_settings = get_option('wc_text_replace_product_page', array());
        $upsells_title         = isset($product_page_settings['upsells_title']) ? $product_page_settings['upsells_title'] : '';
    
        if (!empty($upsells_title)) {
            // Modify the upsells title
            $args['title'] = esc_html($upsells_title);
        }
    
        return $args;
    }
    
    public function modify_cross_sells_title($args) {
        $product_page_settings = get_option('wc_text_replace_product_page', array());
        $cross_sells_title     = isset($product_page_settings['cross_sells_title']) ? $product_page_settings['cross_sells_title'] : '';
    
        if (!empty($cross_sells_title)) {
            // Modify the cross-sells title
            $args['title'] = esc_html($cross_sells_title);
        }
    
        return $args;
    }
    
}
