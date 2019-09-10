<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              -
 * @since             0.0.1
 * @package           Woocommerce_Request_Tax_Invoice
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Request Tax Invoice
 * Plugin URI:        -
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           0.0.1
 * Author:            -
 * Author URI:        -
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-request-tax-invoice
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 0.0.1 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOOCOMMERCE_REQUEST_TAX_INVOICE_VERSION', '0.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-request-tax-invoice-activator.php
 */
function activate_woocommerce_request_tax_invoice() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-request-tax-invoice-activator.php';
	Woocommerce_Request_Tax_Invoice_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-request-tax-invoice-deactivator.php
 */
function deactivate_woocommerce_request_tax_invoice() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-request-tax-invoice-deactivator.php';
	Woocommerce_Request_Tax_Invoice_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocommerce_request_tax_invoice' );
register_deactivation_hook( __FILE__, 'deactivate_woocommerce_request_tax_invoice' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-request-tax-invoice.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_request_tax_invoice() {

	$plugin = new Woocommerce_Request_Tax_Invoice();
	$plugin->run();

}
run_woocommerce_request_tax_invoice();