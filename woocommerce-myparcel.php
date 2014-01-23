<?php
/*
Plugin Name: WooCommerce MyParcel
Plugin URI: http://www.myparcel.nl
Description: Export your WooCommerce orders to MyParcel (www.myparcel.nl) and print labels directly from the WooCommerce admin
Author: Ewout Fernhout
Author URI: http://www.wpovernight.com
Version: 1.3.2
Text Domain: wcmyparcel

License: GPLv3 or later
License URI: http://www.opensource.org/licenses/gpl-license.php
*/

if ( !class_exists( 'WooCommerce_MyParcel_Export' ) ) {
	class WooCommerce_MyParcel_Export {
	
		/**
		 * Construct.
		 */
		 		
		public function __construct() {
	
			// Load textdomain
			add_action( 'plugins_loaded', array( &$this, 'languages' ), 0 );
	
			// Load custom styles & scripts
			add_action( 'admin_enqueue_scripts', array( &$this, 'add_admin_styles_scripts' ) );
			
			$this->includes();
			register_activation_hook( __FILE__, array( 'WC_MyParcel_Settings', 'default_settings' ) );
			$this->settings = new WC_MyParcel_Settings();
			$this->export = new WC_MyParcel_Export();
			$this->writepanel = new WC_MyParcel_Writepanel();
			$this->nlpostcodefields = new WC_NLPostcode_Fields();
		}
	
		/**
		 * Load the main plugin classes and functions
		 */
		public function includes() {
			include_once( 'includes/wcmyparcel-settings.php' );
			include_once( 'includes/wcmyparcel-export.php' );
			include_once( 'includes/wcmyparcel-writepanel.php' );
			include_once( 'includes/wcmyparcel-nlpostcode-fields.php' );
		}
		
	
		/**
		 * Load translations.
		 */
		public function languages() {
			load_plugin_textdomain( 'wcmyparcel', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}
	
		/**
		 * Load admin styles & scripts.
		 */
		function add_admin_styles_scripts(){
		 	global $post_type;
			if( $post_type == 'shop_order' ) {
				wp_enqueue_script( 'thickbox' );
				wp_enqueue_style( 'thickbox' );
				wp_enqueue_script( 'wcmyparcel-export', plugin_dir_url(__FILE__) . 'js/wcmyparcel-script.js', array( 'jquery', 'thickbox' ) );

				if ( version_compare( WOOCOMMERCE_VERSION, '2.1', '<=' ) ) {
					// Old versions
					wp_register_style( 'wcmyparcel-admin-styles', plugins_url( '/css/wcmyparcel-admin-styles.css', __FILE__ ), array(), '', 'all' );
				} else {
					// WC 2.1+, MP6 style with larger buttons
					wp_register_style( 'wcmyparcel-admin-styles', plugins_url( '/css/wcmyparcel-admin-styles-wc21.css', __FILE__ ), array(), '', 'all' );
				}				

				wp_enqueue_style( 'wcmyparcel-admin-styles' );  
			}
		}
	
	}
}

/**
 * WooCommerce fallback notice.
 *
 * @return string Fallack notice.
 */
function wcmyparcel_fallback_notice() {
	$message = '<div class="error">';
		$message .= '<p>' . sprintf( __( 'WooCommerce MyParcel export depends on <a href="%s">WooCommerce</a> to work!' , 'wcmyparcel' ), 'http://wordpress.org/extend/plugins/woocommerce/' ) . '</p>';
	$message .= '</div>';

	echo $message;
}

/**
 * Check if WooCommerce is active.
 *
 * Ref: http://wcdocs.woothemes.com/codex/extending/create-a-plugin/.
 */
$blog_plugins = get_option( 'active_plugins', array() );
$site_plugins = get_site_option( 'active_sitewide_plugins', array() ); // Multisite

if ( in_array( 'woocommerce/woocommerce.php', $blog_plugins ) || isset( $site_plugins['woocommerce/woocommerce.php'] ) ) {
	$wcmyparcelexport = new WooCommerce_MyParcel_Export();
} else {
	add_action( 'admin_notices', 'wcmyparcel_fallback_notice' );
}