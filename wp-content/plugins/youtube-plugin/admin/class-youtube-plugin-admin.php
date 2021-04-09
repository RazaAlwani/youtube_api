<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       razaalwani.ga
 * @since      1.0.0
 *
 * @package    Youtube_Plugin
 * @subpackage Youtube_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Youtube_Plugin
 * @subpackage Youtube_Plugin/admin
 * @author     Raza <asda@gmail.com>
 */
class Youtube_Plugin_Admin {

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
		 * defined in Youtube_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Youtube_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/youtube-plugin-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'bootstrap-css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

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
		 * defined in Youtube_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Youtube_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/youtube-plugin-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'js-style', plugin_dir_url( __FILE__ ) . 'js/bootstrap.bundle.min.js', array( 'jquery' ), $this->version, false );

	}


	 /**
	 * Our custom admin menu.
	 *
	 * @since    1.0.0
	 */
	

	 public function youtube_admin_page(){
		//returns views
		require_once 'partials/youtube-plugin-admin-display.php';
	 }


	public function add_admin_menu(){
		add_menu_page('Youtube', 'Youtube', 'manage_options' , 'youtube-page' , array( $this, 'youtube_admin_page' ) , 'dashicons-tickets' , 250);
		add_submenu_page( 'youtube-page', 'Youtube', 'Youtube-submenu', 'manage_options', 'sub-menu', array( $this, 'youtube_admin_subpage' )); 
	}

	 public function youtube_admin_subpage(){
		//returns views
		require_once 'partials/youtube-plugin-submenu-display.php';
	 }

	 /**
	 * Our custom form for admin.
	 *
	 * @since    1.0.0
	 */

	 public function register_form_admin(){
//register all form information
		register_setting('our_custom_set' , 'YoutubeAPIKey');

		register_setting('our_custom_set' , 'YoutubeChannelID');

		

	 }


	 
	}