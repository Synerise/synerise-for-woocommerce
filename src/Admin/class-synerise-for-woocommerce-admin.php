<?php

namespace Synerise\Integration\Admin;

use Synerise\Integration\Synerise_For_Woocommerce;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Synerise\Integration
 */
class Synerise_For_Woocommerce_Admin {

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
	public function enqueue_styles($hook) {

		wp_enqueue_style($this->plugin_name, plugins_url( 'synerise-for-woocommerce/assets/css/global.css' ), array(), false );

		/**
		 * Enqueue assets only on the admin page
		 */
		if ('toplevel_page_synerise' != $hook) {
			return;
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook) {
		$synerise_pages = ['toplevel_page_synerise', 'synerise_page_synerise/settings', 'admin_page_synerise/wizard'];

		/**
		 * Enqueue assets only on the admin page
		 */
		if (!in_array($hook, $synerise_pages)) {
			return;
		}

		wp_enqueue_script( $this->plugin_name, SYNERISE_FOR_WOOCOMMERCE_BUILD_URL . $this->plugin_name.'-admin.js', array(), time(), false );
		wp_localize_script( $this->plugin_name, 'rest', [
			'url' => get_rest_url().$this->plugin_name.'/v1/',
			'dashboard_url' => menu_page_url('synerise', false),
			'nonce' => wp_create_nonce( 'wp_rest' )
		]);
	}

	/**
	 * Register admin menu page.
	 *
	 * @since 1.0.0
	 */
	public function add_admin_menu() {
		//Dashboard Page
		add_menu_page(
			__('Synerise', $this->plugin_name),
			__('Synerise', $this->plugin_name),
			'manage_options',
			'synerise',
			function () {
				echo '<div id="'.$this->plugin_name.'-root"></div>';
			},
			plugins_url( 'synerise-for-woocommerce/assets/images/synerise_icon.png' )
		);
		//Settings Page
		add_submenu_page(
			'synerise',
			'Settings',
			'Settings',
			'manage_options',
			'synerise/settings',
			function () {
				echo '<div id="'.$this->plugin_name.'-root"></div>';
			}
		);
		//Wizard Page
		add_submenu_page(
			null,
			'Wizard',
			null,
			'manage_options',
			'synerise/wizard',
			function () {
				echo '<div id="'.$this->plugin_name.'-root"></div>';
			}
		);
	}

	/**
	 * On admin page load.
	 *
	 * @since 1.0.0
	 */
	public function admin_page_load() {
		if($GLOBALS['plugin_page'] !== 'synerise/wizard') {
			$this->redirect_if_not_configured();
		}

		remove_action( 'admin_notices', 'update_nag', 3 );
	}

	private function redirect_if_not_configured() {
		if(!Synerise_For_Woocommerce::is_plugin_configured()) {
			wp_redirect( menu_page_url('synerise/wizard') );
			exit;
		}
	}

}
