<?php
/**
 * Plugin Name: Woocommerce Text Replace
 * Plugin URI:  https://almn.me/wtc
 * Description: This plugin will help you to replace the common text of woocommerce page like product page, shop page, cart page, checkout page, thank you page.
 * Version:     1.0
 * Author:      Al Amin
 * Author URI:  https://almn.me
 * Text Domain: woocommerce-text-replace
 * Domain Path: /languages
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package     WoocommerceTextReplace
 * @author      Al Amin
 * @copyright   2023 AwesomeDigitalSolution
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 *
 * Prefix:      WTC
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

require_once __DIR__ . '/vendor/autoload.php';

add_action( 'plugins_loaded', 'WTC_plugin_init' );

/**
 * Initialize the Woocommerce Product Page Design Plugin.
 *
 * This function is called on the 'plugins_loaded' action hook and serves as the entry point
 * to initiate the Woocommerce Product Page Design plugin. It loads the main class for the plugin,
 * which handles all the core functionalities.
 *
 * @since 1.0
 *
 * @return void
 */
function WTC_plugin_init(): void {
    // Call the main class of the Woocommerce Product Page Design plugin.
    // The main class is responsible for managing all the features and functionalities.
    \ADS\WTC\Text_Replace::get_instance();
}


// Modify the cross-sells products section title
function modify_cross_sells_title($title) {
    // Replace 'You may also like' with your custom title
    $custom_title = 'Your Custom Title';
    return $custom_title;
}
add_filter('woocommerce_product_related_products_heading', 'modify_cross_sells_title');
