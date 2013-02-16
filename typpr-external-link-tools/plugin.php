<?php
/*
Plugin Name: Typpr External Link Tools
Plugin URI: http://typpr.com/wp/external-link-tools
Description: Allows you to: 1) Append an icon beside external links, 2) Manage nofollow for links in posts, sidebars, and comments, 3) Provide a branded frame above the linked external site to assist your readers in returning to your site via logo link and related posts links.
Version: 1.0
Author: Ryan Mueller
Author URI: http://creativenotice.com/about/
Author Email: development@networkingcreatively.com
License:

  Copyright 2013 Networking Creatively, LLC. (development@networkingcreatively.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * @author Ryan Mueller <development@networkingcreatively.com>
 * @link( http://typpr.com/wp/external-link-tools, Plugin Home)
 * @copyright 2013 Networking Creatively, LLC dba Typpr
 * @license http://opensource.org/licenses/GPL-2.0 GNU GPL2
 * @package WordPress\typpr_external_link_tools
 * @version GIT: 
 * @since 1.0 First launch
 */
class Typpr_External_Links {

	// Paramaters
	public $plugin_name;
	public $plugin_path;
	public $plugin_settings_group;
	 
	/**
	 * Constructor
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 * @since 1.0
	 */
	function __construct() {

		// Populate our setup
		$this->plugin_name           = __('Typpr External Link Tools', 'typpr-external-link-tools');
		$this->plugin_path           = plugin_dir_path(__FILE__);
		$this->plugin_settings_group = 'typpr_elt_settings_group';

		// Load plugin text domain
		add_action( 'init', array( $this, 'plugin_textdomain' ) );

		// Register admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
	
		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );

		// Register Settings
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		// Custom Settings Link on Plugins Page
		add_action( 'plugin_action_links', array( $this, 'add_plugin_action_links' ), 10, 2 );
		add_action( 'plugin_row_meta', array( $this, 'add_plugin_row_meta' ), 10, 2 );
	
		// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		register_uninstall_hook( __FILE__, array( $this, 'uninstall' ) );
		
		// General actions
	    add_action( 'admin_menu', array( $this, 'admin_menu' ) );

	    // General filters
	    add_filter( 'TODO', array( $this, 'filter_method_name' ) );

	} // end constructor

	// ------------------------------------------------
	// Plugin activate, deactivate and uninstall
	// ------------------------------------------------
	// These methods manage tasks needed when the site adminiter
	// activates, deactivates or uninstalls this plugin.
	// ------------------------------------------------
	
		/**
		 * activate
		 * Fired when the plugin is activated.
		 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
		 * @since 1.0
		 */
		public function activate( $network_wide ) {
			// TODO:	Define activation functionality here
		} // end activate
		
		/**
		 * deactivate
		 * Fired when the plugin is deactivated.
		 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
		 * @since 1.0
		 */
		public function deactivate( $network_wide ) {
			// TODO:	Define deactivation functionality here		
		} // end deactivate
		
		/**
		 * uninstall
		 * Fired when the plugin is uninstalled.
		 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
		 * @since   1.0
		 */
		public function uninstall( $network_wide ) {
			// TODO:	Define uninstall functionality here		
		} // end uninstall

		/**
		 * plugin_textdomain
		 * Loads the plugin text domain for translation
		 * @since 1.0
		 */
		public function plugin_textdomain() {
			$domain = 'typpr-external-link-tools';
			$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
			load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
			load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
		} // end plugin_textdomain

	// ------------------------------------------------
	// Register Resources
	// ------------------------------------------------
	// The following functions allow us to register customer styles and scripts
	// with WordPress for use in the admin and public parts of the site.
	// ------------------------------------------------

		/**
		 * register_admin_styles
		 * Registers and enqueues admin-specific styles.
		 * @since 1.0
		 */
		public function register_admin_styles() {
		
			// TODO:	Change 'plugin-name' to the name of your plugin
			wp_enqueue_style( 'typpr-elt-admin-styles', plugins_url( 'typpr-external-link-tools/css/admin.css' ) );
		
		} // end register_admin_styles

		/**
		 * register_admin_scripts
		 * Registers and enqueues admin-specific JavaScript.
		 * @since 1.0
		 */	
		public function register_admin_scripts() {
		
			// TODO:	Change 'plugin-name' to the name of your plugin
			wp_enqueue_script( 'typpr-elt-admin-script', plugins_url( 'typpr-external-link-tools/js/admin.js' ) );
		
		} // end register_admin_scripts
		
		/**
		 * register_plugin_styles
		 * Registers and enqueues plugin-specific styles.
		 * @since 1.0
		 */
		public function register_plugin_styles() {
		
			// TODO:	Change 'plugin-name' to the name of your plugin
			wp_enqueue_style( 'typpr-elt-plugin-styles', plugins_url( 'typpr-external-link-tools/css/display.css' ) );
		
		} // end register_plugin_styles
		
		/**
		 * register_plugin_scripts
		 * Registers and enqueues plugin-specific scripts.
		 * @since 1.0
		 */
		public function register_plugin_scripts() {
		
			// TODO:	Change 'plugin-name' to the name of your plugin
			wp_enqueue_script( 'typpr-elt-plugin-script', plugins_url( 'typpr-external-link-tools/js/display.js' ) );
		
		} // end register_plugin_scripts

	/*---------------------------------------------*
	 * Core Functions
	 *---------------------------------------------*/

	// ---------------------------------------------------
	// Setup Settings
	// ---------------------------------------------------
	// Here we manage our default plugin settings and the update of settings
	// from user input.
	// ---------------------------------------------------
	
		/**
		 * register_settings
		 * Provides for registering plugin settings with the WP settings API
		 * @return Void
		 * @since  0.1
		 */
		function register_settings() {
			//register our settings
			register_setting( $this->plugin_settings_group, 'new_option_name' );
			register_setting( $this->plugin_settings_group, 'some_other_option' );
			register_setting( $this->plugin_settings_group, 'option_etc' );
		} // end register_settings

	// ---------------------------------------------------
	// Plugin Menu methods
	// ---------------------------------------------------
	// Here we append the main menu link as well as add links to the plugin action links
	// and meta links.
	// ---------------------------------------------------

		/**
		 * add_plugin_action_links
		 * We may add some custom links to the plugin action menu on the installed plugins WP page.
		 * @param   Array  $links The existing array of lnks for the current plugin in the loop.
		 * @param   String $file  The file path of the current plugin in the loop.
		 * @return  Array
		 * @since   0.1
		 */
		function add_plugin_action_links( $links, $file ) {
			// check if the supplied file matches this plugin's file
			if( $file == plugin_basename( __FILE__ ) ){
				// let's create a new link element and append to the array of links
				$settings_link = '<a href="'. admin_url( '/options-general.php?page=typpr-external-link-tools' ) .'">' . __('Settings') . '</a>';
				array_push( $links, $settings_link );
			}
			return $links;
		} // end add_plugin_action_links

		/**
		 * add_plugin_row_meta
		 * We may add some custom links to the plugin meta menu on the installed plugins WP page.
		 * @param  Array  $links The existing array of links.
		 * @param  String $file  The file path.
		 * @return Array
		 * @since  0.1
		 */
		function add_plugin_row_meta( $links, $file ) {
			// check if the supplied file matches this plugin's file
			if( $file === plugin_basename( __FILE__ ) ){
				// Let's create new link element(s) and append to the array of links
				$support = '<a href="http://typpr.com/support">' . __('Typpr Support') . '</a>';
				array_push( $links, $support );
			}
			return $links;
		} // end add_plugin_row_meta

		/**
		 * admin_menu
		 * Creates a new admin menu item and link
		 * @return Void
		 * @since  1.0
		 */
		function admin_menu(){
			add_options_page(
				__('Typpr External Link Tools', 'typpr-external-link-tools'),
				__('Typpr External Link Tools', 'typpr-external-link-tools'),
				'manage_options',
				'typpr-external-link-tools',
				array($this, 'edit_options')
			);
		} // end admin_menu

	// --------------------------------------------------
	// Views
	// --------------------------------------------------
	// Here we manage various views which we might display for the user.
	// For this plugin it's quite likely that there will only be views
	// used for the administrator.
	// --------------------------------------------------

		/**
		 * edit_options
		 * This view includes the administror's plugin settings page.
		 * @return Void
		 * @since 0.1
		 * @uses $this->plugin_path
		 * @uses /views/admin.php
		 */
		function edit_options() {
			// include the admin options page
			include $this->plugin_path . '/views/admin.php';
		} // end edit_options
	
	// ---------------------------------------------------
	// Filters
	// ---------------------------------------------------
	// Here we supply filters to take action on content.
	// ---------------------------------------------------

		/**
		 * NOTE:  Filters are points of execution in which WordPress modifies data
		 *        before saving it or sending it to the browser.
		 *
		 *		  WordPress Filters: http://codex.wordpress.org/Plugin_API#Filters
		 *		  Filter Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
		 *
		 */
		function filter_method_name() {
		    // TODO:	Define your filter method here
		} // end filter_method_name
  
} // end class

/**
 * Instantiate the plugin
 * @var nc_external_link_tool
 */
$typpr_external_link_tool = new Typpr_External_Links();