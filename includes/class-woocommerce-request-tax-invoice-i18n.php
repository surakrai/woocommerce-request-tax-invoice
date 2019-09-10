<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       -
 * @since      1.0.0
 *
 * @package    Woocommerce_Request_Tax_Invoice
 * @subpackage Woocommerce_Request_Tax_Invoice/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woocommerce_Request_Tax_Invoice
 * @subpackage Woocommerce_Request_Tax_Invoice/includes
 * @author     - <->
 */
class Woocommerce_Request_Tax_Invoice_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woocommerce-request-tax-invoice',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
