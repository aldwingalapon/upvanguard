<?php
/**
 * Plugin Name: WooCommerce
 * Plugin URI: https://woocommerce.com/
 * Description: An e-commerce toolkit that helps you sell anything. Beautifully.
 * Version: 2.6.14
 * Author: WooThemes
 * Author URI: https://woocommerce.com
 * Requires at least: 4.4
 * Tested up to: 4.7
 *
 * Text Domain: woocommerce
 * Domain Path: /i18n/languages/
 *
 * @package WooCommerce
 * @category Core
 * @author WooThemes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'WooCommerce' ) ) :

/**
 * Main WooCommerce Class.
 *
 * @class WooCommerce
 * @version	2.6.0
 */
final class WooCommerce {

	/**
	 * WooCommerce version.
	 *
	 * @var string
	 */
	public $version = '2.6.14';

	/**
	 * The single instance of the class.
	 *
	 * @var WooCommerce
	 * @since 2.1
	 */
	protected static $_instance = null;

	/**
	 * Session instance.
	 *
	 * @var WC_Session
	 */
	public $session = null;

	/**
	 * Query instance.
	 *
	 * @var WC_Query
	 */
	public $query = null;

	/**
	 * Product factory instance.
	 *
	 * @var WC_Product_Factory
	 */
	public $product_factory = null;

	/**
	 * Countries instance.
	 *
	 * @var WC_Countries
	 */
	public $countries = null;

	/**
	 * Integrations instance.
	 *
	 * @var WC_Integrations
	 */
	public $integrations = null;

	/**
	 * Cart instance.
	 *
	 * @var WC_Cart
	 */
	public $cart = null;

	/**
	 * Customer instance.
	 *
	 * @var WC_Customer
	 */
	public $customer = null;

	/**
	 * Order factory instance.
	 *
	 * @var WC_Order_Factory
	 */
	public $order_factory = null;

	/**
	 * Main WooCommerce Instance.
	 *
	 * Ensures only one instance of WooCommerce is loaded or can be loaded.
	 *
	 * @since 2.1
	 * @static
	 * @see WC()
	 * @return WooCommerce - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 * @since 2.1
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'woocommerce' ), '2.1' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 * @since 2.1
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'woocommerce' ), '2.1' );
	}

	/**
	 * Auto-load in-accessible properties on demand.
	 * @param mixed $key
	 * @return mixed
	 */
	public function __get( $key ) {
		if ( in_array( $key, array( 'payment_gateways', 'shipping', 'mailer', 'checkout' ) ) ) {
			return $this->$key();
		}
	}

	/**
	 * WooCommerce Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'woocommerce_loaded' );
	}

	/**
	 * Hook into actions and filters.
	 * @since  2.3
	 */
	private function init_hooks() {
		register_activation_hook( __FILE__, array( 'WC_Install', 'install' ) );
		add_action( 'after_setup_theme', array( $this, 'setup_environment' ) );
		add_action( 'after_setup_theme', array( $this, 'include_template_functions' ), 11 );
		add_action( 'init', array( $this, 'init' ), 0 );
		add_action( 'init', array( 'WC_Shortcodes', 'init' ) );
		add_action( 'init', array( 'WC_Emails', 'init_transactional_emails' ) );
		add_action( 'init', array( $this, 'wpdb_table_fix' ), 0 );
		add_action( 'switch_blog', array( $this, 'wpdb_table_fix' ), 0 );
	}

	/**
	 * Define WC Constants.
	 */
	private function define_constants() {
		$upload_dir = wp_upload_dir();

		$this->define( 'WC_PLUGIN_FILE', __FILE__ );
		$this->define( 'WC_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'WC_VERSION', $this->version );
		$this->define( 'WOOCOMMERCE_VERSION', $this->version );
		$this->define( 'WC_ROUNDING_PRECISION', 4 );
		$this->define( 'WC_DISCOUNT_ROUNDING_MODE', 2 );
		$this->define( 'WC_TAX_ROUNDING_MODE', 'yes' === get_option( 'woocommerce_prices_include_tax', 'no' ) ? 2 : 1 );
		$this->define( 'WC_DELIMITER', '|' );
		$this->define( 'WC_LOG_DIR', $upload_dir['basedir'] . '/wc-logs/' );
		$this->define( 'WC_SESSION_CACHE_GROUP', 'wc_session_id' );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param  string $name
	 * @param  string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'ajax' :
				return defined( 'DOING_AJAX' );
			case 'cron' :
				return defined( 'DOING_CRON' );
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	/**
	 * Check the active theme.
	 *
	 * @since  2.6.9
	 * @param  string $theme Theme slug to check
	 * @return bool
	 */
	private function is_active_theme( $theme ) {
		return $theme === get_template();
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {
		include_once( 'includes/class-wc-autoloader.php' );
		include_once( 'includes/wc-core-functions.php' );
		include_once( 'includes/wc-widget-functions.php' );
		include_once( 'includes/wc-webhook-functions.php' );
		include_once( 'includes/class-wc-install.php' );
		include_once( 'includes/class-wc-geolocation.php' );
		include_once( 'includes/class-wc-download-handler.php' );
		include_once( 'includes/class-wc-comments.php' );
		include_once( 'includes/class-wc-post-data.php' );
		include_once( 'includes/class-wc-ajax.php' );

		if ( $this->is_request( 'admin' ) ) {
			include_once( 'includes/admin/class-wc-admin.php' );
		}

		if ( $this->is_request( 'frontend' ) ) {
			$this->frontend_includes();
		}

		if ( $this->is_request( 'frontend' ) || $this->is_request( 'cron' ) ) {
			include_once( 'includes/class-wc-session-handler.php' );
		}

		if ( $this->is_request( 'cron' ) && 'yes' === get_option( 'woocommerce_allow_tracking', 'no' ) ) {
			include_once( 'includes/class-wc-tracker.php' );
		}

		include_once( 'includes/class-wc-query.php' ); // The main query class
		include_once( 'includes/class-wc-api.php' ); // API Class
		include_once( 'includes/class-wc-auth.php' ); // Auth Class
		include_once( 'includes/class-wc-post-types.php' ); // Registers post types
		include_once( 'includes/abstracts/abstract-wc-data.php' );				 // WC_Data for CRUD
		include_once( 'includes/abstracts/abstract-wc-payment-token.php' ); // Payment Tokens
		include_once( 'includes/abstracts/abstract-wc-product.php' ); // Products
		include_once( 'includes/abstracts/abstract-wc-order.php' ); // Orders
		include_once( 'includes/abstracts/abstract-wc-settings-api.php' ); // Settings API (for gateways, shipping, and integrations)
		include_once( 'includes/abstracts/abstract-wc-shipping-method.php' ); // A Shipping method
		include_once( 'includes/abstracts/abstract-wc-payment-gateway.php' ); // A Payment gateway
		include_once( 'includes/abstracts/abstract-wc-integration.php' ); // An integration with a service
		include_once( 'includes/class-wc-product-factory.php' ); // Product factory
		include_once( 'includes/class-wc-payment-tokens.php' ); // Payment tokens controller
		include_once( 'includes/gateways/class-wc-payment-gateway-cc.php' ); // CC Payment Gateway
		include_once( 'includes/gateways/class-wc-payment-gateway-echeck.php' ); // eCheck Payment Gateway
		include_once( 'includes/class-wc-countries.php' ); // Defines countries and states
		include_once( 'includes/class-wc-integrations.php' ); // Loads integrations
		include_once( 'includes/class-wc-cache-helper.php' ); // Cache Helper
		include_once( 'includes/class-wc-https.php' ); // https Helper

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			include_once( 'includes/class-wc-cli.php' );
		}

		$this->query = new WC_Query();
		$this->api   = new WC_API();
	}

	/**
	 * Include required frontend files.
	 */
	public function frontend_includes() {
		include_once( 'includes/wc-cart-functions.php' );
		include_once( 'includes/wc-notice-functions.php' );
		include_once( 'includes/wc-template-hooks.php' );
		include_once( 'includes/class-wc-template-loader.php' );                // Template Loader
		include_once( 'includes/class-wc-frontend-scripts.php' );               // Frontend Scripts
		include_once( 'includes/class-wc-form-handler.php' );                   // Form Handlers
		include_once( 'includes/class-wc-cart.php' );                           // The main cart class
		include_once( 'includes/class-wc-tax.php' );                            // Tax class
		include_once( 'includes/class-wc-shipping-zones.php' );                 // Shipping Zones class
		include_once( 'includes/class-wc-customer.php' );                       // Customer class
		include_once( 'includes/class-wc-shortcodes.php' );                     // Shortcodes class
		include_once( 'includes/class-wc-embed.php' );                          // Embeds

		if ( $this->is_active_theme( 'twentyseventeen' ) ) {
			include_once( 'includes/theme-support/class-wc-twenty-seventeen.php' );
		}
	}

	/**
	 * Function used to Init WooCommerce Template Functions - This makes them pluggable by plugins and themes.
	 */
	public function include_template_functions() {
		include_once( 'includes/wc-template-functions.php' );
	}

	/**
	 * Init WooCommerce when WordPress Initialises.
	 */
	public function init() {
		// Before init action.
		do_action( 'before_woocommerce_init' );

		// Set up localisation.
		$this->load_plugin_textdomain();

		// Load class instances.
		$this->product_factory = new WC_Product_Factory();                      // Product Factory to create new product instances
		$this->order_factory   = new WC_Order_Factory();                        // Order Factory to create new order instances
		$this->countries       = new WC_Countries();                            // Countries class
		$this->integrations    = new WC_Integrations();                         // Integrations class

		// Session class, handles session data for users - can be overwritten if custom handler is needed.
		if ( $this->is_request( 'frontend' ) || $this->is_request( 'cron' ) ) {
			$session_class  = apply_filters( 'woocommerce_session_handler', 'WC_Session_Handler' );
			$this->session  = new $session_class();
		}

		// Classes/actions loaded for the frontend and for ajax requests.
		if ( $this->is_request( 'frontend' ) ) {
			$this->cart     = new WC_Cart();                                    // Cart class, stores the cart contents
			$this->customer = new WC_Customer();                                // Customer class, handles data such as customer location
		}

		$this->load_webhooks();

		// Init action.
		do_action( 'woocommerce_init' );
	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/woocommerce/woocommerce-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/woocommerce-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'woocommerce' );

		load_textdomain( 'woocommerce', WP_LANG_DIR . '/woocommerce/woocommerce-' . $locale . '.mo' );
		load_plugin_textdomain( 'woocommerce', false, plugin_basename( dirname( __FILE__ ) ) . '/i18n/languages' );
	}

	/**
	 * Ensure theme and server variable compatibility and setup image sizes.
	 */
	public function setup_environment() {
		/**
		 * @deprecated 2.2 Use WC()->template_path()
		 */
		$this->define( 'WC_TEMPLATE_PATH', $this->template_path() );

		$this->add_thumbnail_support();
		$this->add_image_sizes();
	}

	/**
	 * Ensure post thumbnail support is turned on.
	 */
	private function add_thumbnail_support() {
		if ( ! current_theme_supports( 'post-thumbnails' ) ) {
			add_theme_support( 'post-thumbnails' );
		}
		add_post_type_support( 'product', 'thumbnail' );
	}

	/**
	 * Add WC Image sizes to WP.
	 *
	 * @since 2.3
	 */
	private function add_image_sizes() {
		$shop_thumbnail = wc_get_image_size( 'shop_thumbnail' );
		$shop_catalog	= wc_get_image_size( 'shop_catalog' );
		$shop_single	= wc_get_image_size( 'shop_single' );

		add_image_size( 'shop_thumbnail', $shop_thumbnail['width'], $shop_thumbnail['height'], $shop_thumbnail['crop'] );
		add_image_size( 'shop_catalog', $shop_catalog['width'], $shop_catalog['height'], $shop_catalog['crop'] );
		add_image_size( 'shop_single', $shop_single['width'], $shop_single['height'], $shop_single['crop'] );
	}

	/**
	 * Get the plugin url.
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Get the template path.
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'woocommerce_template_path', 'woocommerce/' );
	}

	/**
	 * Get Ajax URL.
	 * @return string
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}

	/**
	 * Return the WC API URL for a given request.
	 *
	 * @param string $request
	 * @param mixed $ssl (default: null)
	 * @return string
	 */
	public function api_request_url( $request, $ssl = null ) {
		if ( is_null( $ssl ) ) {
			$scheme = parse_url( home_url(), PHP_URL_SCHEME );
		} elseif ( $ssl ) {
			$scheme = 'https';
		} else {
			$scheme = 'http';
		}

		if ( strstr( get_option( 'permalink_structure' ), '/index.php/' ) ) {
			$api_request_url = trailingslashit( home_url( '/index.php/wc-api/' . $request, $scheme ) );
		} elseif ( get_option( 'permalink_structure' ) ) {
			$api_request_url = trailingslashit( home_url( '/wc-api/' . $request, $scheme ) );
		} else {
			$api_request_url = add_query_arg( 'wc-api', $request, trailingslashit( home_url( '', $scheme ) ) );
		}

		return esc_url_raw( apply_filters( 'woocommerce_api_request_url', $api_request_url, $request, $ssl ) );
	}

	/**
	 * Load & enqueue active webhooks.
	 *
	 * @since 2.2
	 */
	private function load_webhooks() {
		if ( false === ( $webhooks = get_transient( 'woocommerce_webhook_ids' ) ) ) {
			$webhooks = get_posts( array(
				'fields'         => 'ids',
				'post_type'      => 'shop_webhook',
				'post_status'    => 'publish',
				'posts_per_page' => -1
			) );
			set_transient( 'woocommerce_webhook_ids', $webhooks );
		}
		foreach ( $webhooks as $webhook_id ) {
			$webhook = new WC_Webhook( $webhook_id );
			$webhook->enqueue();
		}
	}

	/**
	 * WooCommerce Payment Token Meta API and Term/Order item Meta - set table names.
	 */
	public function wpdb_table_fix() {
		global $wpdb;
		$wpdb->payment_tokenmeta    = $wpdb->prefix . 'woocommerce_payment_tokenmeta';
		$wpdb->order_itemmeta       = $wpdb->prefix . 'woocommerce_order_itemmeta';
		$wpdb->tables[]             = 'woocommerce_payment_tokenmeta';
		$wpdb->tables[]             = 'woocommerce_order_itemmeta';

		if ( get_option( 'db_version' ) < 34370 ) {
			$wpdb->woocommerce_termmeta = $wpdb->prefix . 'woocommerce_termmeta';
			$wpdb->tables[]             = 'woocommerce_termmeta';
		}
	}

	/**
	 * Get Checkout Class.
	 * @return WC_Checkout
	 */
	public function checkout() {
		return WC_Checkout::instance();
	}

	/**
	 * Get gateways class.
	 * @return WC_Payment_Gateways
	 */
	public function payment_gateways() {
		return WC_Payment_Gateways::instance();
	}

	/**
	 * Get shipping class.
	 * @return WC_Shipping
	 */
	public function shipping() {
		return WC_Shipping::instance();
	}

	/**
	 * Email Class.
	 * @return WC_Emails
	 */
	public function mailer() {
		return WC_Emails::instance();
	}
}

endif;

/**
 * Main instance of WooCommerce.
 *
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @since  2.1
 * @return WooCommerce
 */
function WC() {
	return WooCommerce::instance();
}

// Global for backwards compatibility.
$GLOBALS['woocommerce'] = WC();
