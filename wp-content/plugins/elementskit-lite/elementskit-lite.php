<?php
defined( 'ABSPATH' ) || exit;

/**
 * Plugin Name: ElementsKit Lite
 * Description: The most advanced addons for Elementor with tons of widgets, Header builder, Footer builder, Mega menu builder, layout pack and powerful custom controls.
 * Plugin URI: https://products.wpmet.com/elementskit
 * Author: Wpmet
 * Version: 2.0.12
 * Author URI: https://wpmet.com/
 *
 * Text Domain: elementskit-lite
 *
 * ElementsKit is a powerful addon for Elementor page builder.
 * It includes most comprehensive modules, such as "header footer builder", "mega menu",
 * "layout installer", "quick form builder" etc under the hood.
 * It has a tons of widgets to create any sites with an ease. It has some most unique
 * and powerful custom controls for elementor, such as "image picker", "ajax select", "widget area".
 *
 */

final class ElementsKit_Lite{
	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	static function version(){
		return '2.0.12';
	}

	/**
	 * Package type
	 *
	 * @since 1.1.0
	 * @var string The plugin purchase type [pro/ free].
	 */
	static function package_type(){
		return apply_filters( 'elementskit/core/package_type', 'free' );
	}

	/**
	 * Product ID
	 *
	 * @since 1.2.6
	 * @var string The plugin ID in our server.
	 */
	static function product_id(){
		return '9';
	}

	/**
	 * Author Name
	 *
	 * @since 1.3.1
	 * @var string The plugin author.
	 */
	static function author_name(){
		return 'Wpmet';
	}

	/**
	 * Store Name
	 *
	 * @since 1.3.1
	 * @var string The store name: self site, envato.
	 */
	static function store_name(){
		return 'wordpressorg';
	}

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	static function min_el_version(){
		return '2.4.0';
	}

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	static function min_php_version(){
		return '7.0';
	}

	/**
	 * Plugin file
	 *
	 * @since 1.0.0
	 * @var string plugins's root file.
	 */
	static function plugin_file(){
		return __FILE__;
	}

	/**
	 * Plugin url
	 *
	 * @since 1.0.0
	 * @var string plugins's root url.
	 */
	static function plugin_url(){
		return trailingslashit(plugin_dir_url( __FILE__ ));
	}

	/**
	 * Plugin dir
	 *
	 * @since 1.0.0
	 * @var string plugins's root directory.
	 */
	static function plugin_dir(){
		return trailingslashit(plugin_dir_path( __FILE__ ));
	}

    /**
     * Plugin's widget directory.
     *
     * @since 1.0.0
     * @var string widget's root directory.
     */
	static function widget_dir(){
		return self::plugin_dir() . 'widgets/';
	}

    /**
     * Plugin's widget url.
     *
     * @since 1.0.0
     * @var string widget's root url.
     */
	static function widget_url(){
		return self::plugin_url() . 'widgets/';
	}


    /**
     * API url
     *
     * @since 1.0.0
     * @var string for license, layout notification related functions.
     */
	static function api_url(){
		return 'https://api.wpmet.com/public/';
	}

    /**
     * Account url
     *
     * @since 1.2.6
     * @var string for plugin update notification, user account page.
     */
	static function account_url(){
		return 'https://account.wpmet.com';
	}

    /**
     * Plugin's module directory.
     *
     * @since 1.0.0
     * @var string module's root directory.
     */
	static function module_dir(){
		return self::plugin_dir() . 'modules/';
	}

    /**
     * Plugin's module url.
     *
     * @since 1.0.0
     * @var string module's root url.
     */
	static function module_url(){
		return self::plugin_url() . 'modules/';
	}


    /**
     * Plugin's lib directory.
     *
     * @since 1.0.0
     * @var string lib's root directory.
     */
	static function lib_dir(){
		return self::plugin_dir() . 'libs/';
	}

    /**
     * Plugin's lib url.
     *
     * @since 1.0.0
     * @var string lib's root url.
     */
	static function lib_url(){
		return self::plugin_url() . 'libs/';
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		// Load the main static helper class.
		require_once self::plugin_dir() . 'libs/notice/notice.php'; // new notice system
		require_once self::plugin_dir() . 'libs/banner/init.php'; // new notice system
		require_once self::plugin_dir() . 'libs/announcements/init.php'; // new announcements system
		require_once self::plugin_dir() . 'libs/pro-awareness/init.php'; // pro menu class file
		require_once self::plugin_dir() . 'helpers/utils.php';
		
		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );
		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ), 100 );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'elementskit-lite', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {
		
		// init notice class
		\Oxaim\Libs\Notice::init();

		// init pro menu class
		\Wpmet\Libs\Pro_Awareness\Init::init();

		// Check if Elementor installed and activated.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_head', array( $this, 'missing_elementor' ) );
			return;
		}

		// Check for required PHP version.
		if ( version_compare( PHP_VERSION, self::min_php_version(), '<' ) ) {
			add_action( 'admin_head', array( $this, 'failed_php_version' ) );
			return;
		}
		// Once we get here, We have passed all validation checks so we can safely include our plugin.

		// Register ElementsKit_Lite widget category
		add_action('elementor/init', [$this, 'elementor_widget_category']);

		add_action( 'elementor/init', function(){
			if(class_exists('ElementsKit') && !class_exists('ElementsKit_Comp')){
				return;
			}

			// adding backward classes and mathods for older 14 number themes.
			require_once self::plugin_dir() . 'compatibility/backward/plugin-class-backward-compatibility.php';
			require_once self::plugin_dir() . 'compatibility/backward/utils-backward-compablity.php';

			// Load the Plugin class, it's the core class of ElementsKit_Lite.
			require_once self::plugin_dir() . 'plugin.php';

			// adding backward classes and mathods for older 14 number themes.
			require_once self::plugin_dir() . 'compatibility/backward/module-list.php';
			require_once self::plugin_dir() . 'compatibility/backward/widget-list.php';
		});

	}



	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have required Elementor.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function missing_elementor() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		$btn = [
            'default_class' => 'button',
            'class' => 'button-primary ', // button-primary button-secondary button-small button-large button-link
        ];

		if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
			$btn['text'] = esc_html__('Activate Elementor', 'elementskit-lite');
			$btn['url'] = wp_nonce_url( 'plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php' );
		} else {
			$btn['text'] = esc_html__('Install Elementor', 'elementskit-lite');
			$btn['url'] = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
		}

		\Oxaim\Libs\Notice::instance('elementskit-lite', 'unsupported-elementor-version')
		->set_type('error')
		->set_message(sprintf( esc_html__( 'ElementsKit requires Elementor version %1$s+, which is currently NOT RUNNING.', 'elementskit-lite' ), self::min_el_version() ))
		->set_button($btn)
		->call();
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function failed_php_version() {
		\Oxaim\Libs\Notice::instance('elementskit-lite', 'unsupported-php-version')
		->set_type('error')
		->set_message(sprintf( esc_html__( 'ElementsKit requires PHP version %1$s+, which is currently NOT RUNNING on this server.', 'elementskit-lite' ), self::min_php_version() ))
		->call();
	}

    /**
     * Rewrite flush.
     *
     * @since 1.0.7
     * @access public
     */
	public static function flush_rewrites(){

		require_once self::module_dir() . 'dynamic-content/cpt.php';

		new ElementsKit_Lite\Modules\Dynamic_Content\Cpt();

		flush_rewrite_rules();
	}
    /**
     * Add category.
     *
     * Register custom widget category in Elementor's editor
     *
     * @since 1.0.0
     * @access public
     */
    public function elementor_widget_category($widgets_manager){
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'elementskit',
			[
				'title' =>esc_html__( 'ElementsKit', 'elementskit-lite' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
        \Elementor\Plugin::$instance->elements_manager->add_category(
            'elementskit_headerfooter',
            [
                'title' =>esc_html__( 'ElementsKit Header Footer', 'elementskit-lite' ),
                'icon' => 'fa fa-plug',
            ],
            1
        );
	}
}

new ElementsKit_Lite();

register_activation_hook( __FILE__, 'ElementsKit_Lite::flush_rewrites' );
