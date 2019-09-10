<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       -
 * @since      1.0.0
 *
 * @package    Woocommerce_Request_Tax_Invoice
 * @subpackage Woocommerce_Request_Tax_Invoice/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woocommerce_Request_Tax_Invoice
 * @subpackage Woocommerce_Request_Tax_Invoice/public
 * @author     - <->
 */
class Woocommerce_Request_Tax_Invoice_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocommerce-request-tax-invoice-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocommerce-request-tax-invoice-public.js', array( 'jquery' ), $this->version, false );

	}

	public function translate_woocommerce_strings( $translated_text , $untranslated_text, $domain ) {
	
		if ( $domain == 'woocommerce') {
	
			switch( $untranslated_text ) {

				case 'Billing details':
					$translated_text = __( 'Shipping address', 'woocommerce-request-tax-invoice' );
					break;

				case 'Billing Details':
					$translated_text = __( 'Shipping address', 'woocommerce-request-tax-invoice' );
					break;
					
				case 'Billing':
					$translated_text = __( 'Shipping address', 'woocommerce-request-tax-invoice' );
					break;
	
				case 'Billing address':
					$translated_text = __( 'Shipping address', 'woocommerce-request-tax-invoice' );
					break;
				
				case 'Billing Address 2':
					$translated_text = __( 'Shipping address', 'woocommerce-request-tax-invoice' );
					break;
	
				case 'Ship to a different address?':
					$translated_text = __( 'Need a tax invoice?', 'woocommerce-request-tax-invoice' );
					break;
					
				case 'Shipping %s':
					$translated_text = __( 'Tax invoice %s', 'woocommerce-request-tax-invoice' );
					break;

				case 'Shipping':
					$translated_text = __( 'Tax invoice address', 'woocommerce-request-tax-invoice' );
					break;

				case 'Shipping address':
					$translated_text = __( 'Tax invoice address', 'woocommerce-request-tax-invoice' );
					break;

				case 'Shipping Address 2':
					$translated_text = __( 'Tax invoice address', 'woocommerce-request-tax-invoice' );
					break;

				case 'Ship to':
					$translated_text = __( 'Tax invoice address', 'woocommerce-request-tax-invoice' );
					break;					
			}
	
		}
	
		return $translated_text;
	
	}

	// Our hooked in function - $fields is passed via the filter!
	public function filter_woocommerce_checkout_fields( $fields ) {

		$new_fields = array();

		foreach ( $fields['shipping'] as $key => $field ) {

			$new_fields[$key] = $field;
			if ( 'shipping_company' === $key ) $new_fields['shipping_tax_number'] = $this->tax_number_field();

		}

		$fields['shipping'] = $new_fields;
		
		return $fields;
	}
	
	public function filter_woocommerce_shipping_fields( $fields ) {

		$new_fields = array();

		foreach ( $fields as $key => $field ) {

			$new_fields[$key] = $field;
			if ( 'shipping_company' === $key ) 	$new_fields['shipping_tax_number'] = $this->tax_number_field();

		}
		
		return $new_fields;

	}

	public function filter_woocommerce_my_account_my_address_formatted_address( $fields, $customer_id, $type ) { 

		if ( $type == 'shipping' ) {
			$fields['shipping_tax_number'] = get_user_meta( $customer_id, 'shipping_tax_number', true );
		}

		return $fields;
	}

	public function tax_number_field() {
		return array(
			'label'        => __('Tax identification number', 'woocommerce-request-tax-invoice'),
			'required'     => true,
			'class'        => array('form-row-wide'),
			'clear'        => true
		);
	}

}
