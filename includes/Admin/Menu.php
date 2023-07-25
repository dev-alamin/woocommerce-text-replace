<?php
namespace ADS\WTC\Admin;

class Menu{
    public function __construct(){
        add_action('admin_menu', [ $this, 'menu_callbak']);
        add_filter('plugin_action_links', [ $this, 'action'], 10, 2 );
    }

    public function menu_callbak(){
        add_submenu_page(
            'woocommerce', // Parent Menu Slug (WooCommerce)
            'WC text replace', // Page Title
            'WC text replace', // Menu Title
            'manage_options', // Capability required to access the page
            'wc_text_replace', // Menu Slug
            [ $this, 'menu_page' ]// Callback function to render the page content
        );
    }

	public function menu_page(){
		include WTC_PLUGIN_PATH . 'templates/settings.php';
	}

    public function action( $links, $file ){
        if ($file === 'wc-preset-design/wc-preset-design.php') {
            $settings_link = '<a href="' . admin_url('admin.php?page=wc_product_preset_design') . '">'. _e('Settings', 'wtc').'</a>';
            array_unshift($links, $settings_link);
        }
        return $links;
    }
}