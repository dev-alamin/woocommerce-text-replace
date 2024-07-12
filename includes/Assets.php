<?php
namespace ADS\WTC;

class Assets {

    public function __construct() {
//        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_assets'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
    }

    /**
     * Enqueue frontend assets (styles and scripts)
     */
    public function enqueue_frontend_assets() {

        // Enqueue frontend styles
        wp_enqueue_style('wc_text_replace-frontend', WTC_PLUGIN_ASSET, 'css/frontend.css', array(), WTC_VERSION);

        // Enqueue frontend script with jQuery dependency
        wp_enqueue_script('wc_text_replace-frontend', WTC_PLUGIN_ASSET, 'js/frontend.js', array('jquery'), WTC_VERSION, true);
    }

    /**
     * Enqueue admin assets (styles and scripts)
     */
    public function enqueue_admin_assets($hook) {
        if (strpos($hook, 'wc_text_replace') !== false) {

            // Enqueue admin styles
            wp_enqueue_style('wc_text_replace-bootstrap', WTC_PLUGIN_ASSET . 'admin/css/bootstrap.min.css', array(), WTC_VERSION);
            wp_enqueue_style('wc_text_replace-admin', WTC_PLUGIN_ASSET . 'admin/css/admin.css', array(), WTC_VERSION);
        
            // Enqueue admin script with jQuery dependency
            wp_enqueue_script('jquery');
            wp_enqueue_script('wc_text_replace-admin', WTC_PLUGIN_ASSET . 'admin/js/bootstrap.min.js', array('jquery'), WTC_VERSION, true);
        }
        
    }
}
