<?php
namespace ADS\WTC;
use ADS\WTC\Admin;
use ADS\WTC\Assets;
use ADS\WTC\Forms\Product;
use ADS\WTC\Forms\General;
use ADS\WTC\Forms\ThankYou;

class Text_Replace{

    private static string $version = '1.0';

    /**
     * Constructor method for the Text_Replace class.
     * Initializes the plugin and sets up the required hooks.
     */
    private function __construct() {
        load_plugin_textdomain( 'Plugin Slug', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        $this->init();
    }

    /**
     * Returns the singleton instance of the Text_Replace class.
     *
     * @return Text_Replace The singleton instance of the Text_Replace class.
     */
    public static function get_instance(): Text_Replace {
        static $instance = null;

        if( ! $instance ){
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Initializes the plugin by defining constants and setting up hooks.
     *
     * @return void
     */
    private function init(): void {
        $this->define_constants();
        $product = new Product();
        $general = new General();
        $thanku  = new ThankYou();

        // Initialize the Admin Notice class to display admin notices.
        new Assets();
        
        // Conditionally load admin-related or frontend-related functionality.
        if(is_admin()){
            // Add admin-related functionality here.
            new Admin();
            $product->submit_form();
            $general->submit_form();
            $thanku->submit_form();
        } else {
            // Add frontend-related functionality here.
            $product->fire_hook();
            $general->fire_hook();
            $thanku->fire_hook();
        }
    }

    /**
     * Defines constants used throughout the plugin.
     *
     * @return void
     */
    private function define_constants(): void {
        define( 'WTC_VERSION', self::$version );
        define( 'WTC_PLUGIN', plugin_dir_path( dirname( __FILE__ ) ) );
        define( 'WTC_PLUGIN_URL', plugin_dir_url( dirname( __FILE__ ) ) );
        define( 'WTC_PLUGIN_ASSET', WTC_PLUGIN_URL . '/assets/'  );
        define( 'WTC_PLUGIN_PATH', plugin_dir_path( dirname( __FILE__ ) ) );
    }

}



