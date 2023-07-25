<?php
namespace ADS\WTC\Admin;

class Notice{

    public function __construct(){
        // Check if WooCommerce is installed and active
        if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            add_action( 'admin_notices', [ $this, 'html'] );
        }
    }

    // WooCommerce install notice
    public function html() {
        ?>
        <div class="notice notice-error">
            <p>
                <?php
                printf(
                    /* translators: %s is the URL to install WooCommerce */
                    esc_html__(
                        'Woocommerce text replace requires WooCommerce to be installed and activated. Please %sinstall WooCommerce%s to use this plugin.',
                        'wtc'
                    ),
                    '<a href="' . esc_url( admin_url( 'plugin-install.php?tab=plugin-information&plugin=woocommerce&TB_iframe=true&width=772&height=600' ) ) . '">',
                    '</a>'
                );
                ?>
            </p>
        </div>
        <?php
    }

}