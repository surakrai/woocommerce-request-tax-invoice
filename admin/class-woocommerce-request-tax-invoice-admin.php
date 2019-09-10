<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       -
 * @since      1.0.0
 *
 * @package    Woocommerce_Request_Tax_Invoice
 * @subpackage Woocommerce_Request_Tax_Invoice/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woocommerce_Request_Tax_Invoice
 * @subpackage Woocommerce_Request_Tax_Invoice/admin
 * @author     - <->
 */
class Woocommerce_Request_Tax_Invoice_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Request_Tax_Invoice_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Request_Tax_Invoice_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocommerce-request-tax-invoice-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Request_Tax_Invoice_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Request_Tax_Invoice_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocommerce-request-tax-invoice-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function override_woocommerce_setting_tabs($tabs){
    $tabs['shipping'] = __('Shipping', 'woocommerce-request-tax-invoice');
		return $tabs;
	}
 
	function filter_woocommerce_order_formatted_shipping_address( $fields, $order ) {

		if ( $shipping_tax_number = get_post_meta( $order->get_id(), '_shipping_tax_number', true )) {
			$fields['shipping_tax_number'] = $shipping_tax_number;
		}

		return $fields;

	}


	public function filter_woocommerce_formatted_address_replacements( $replacements, $address ) {
		$replacements['{shipping_tax_number}'] = isset($address['shipping_tax_number']) ? $address['shipping_tax_number'] : '';
		return $replacements;
	}

	public function filter_woocommerce_localisation_address_formats( $formats  ) { 

		$formats['TH'] = "{name}\n{company}\n{shipping_tax_number}\n{address_1}\n{address_2}\n{city}\n{state}\n{postcode}\n{country}";
		$formats['US']  = "{company}\n{name}\n{shipping_tax_number}\n{address_1}\n{address_2}\n{city}, {state_code} {postcode}\n{country}";

		return $formats;

	}

	public function filter_woocommerce_admin_shipping_fields( $fields ) { 

		$new_fields = array();

		foreach ( $fields as $key => $field ) {

			$new_fields[$key] = $field;

			if ( 'company' === $key ) {
				$new_fields['tax_number'] = array(
					'label' => __('Tax identification number', 'woocommerce-request-tax-invoice'),
					'show'  => false
				);
			}
		}
	
		return $new_fields;

	}

	function admin_notices_warning() {

    $screen = get_current_screen();

    if ( is_admin() && $screen->id == 'shop_order' ) {
			global $post;

			if ( get_post_meta( $post->ID, '_shipping_tax_number', true ) ) {
				$class = 'notice notice-warning';
				$message = __('Customer needs a tax invoice.', 'woocommerce-request-tax-invoice');
				printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
			}

		}
	}

}



