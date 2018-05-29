<?php
	/**
		* Plugin Name:       WP Coder
		* Plugin URI:        https://wordpress.org/plugins/wp-coder/
		* Description:       Add custom CSS, HTML, JavaScript on your website page
		* Version:           1.0
		* Author:            Wow-Company
		* Author URI:        https://wow-estore.com/
		* License:           GPL-2.0+
		* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
	*/
	
	if ( ! defined( 'WPINC' ) ) {die;}
	// Declaration Wow-Company class
	if( !class_exists( 'Wow_Company' )) {
		require_once plugin_dir_path( __FILE__ ) . 'asset/class-wow-company.php';			
	}	
	if( !class_exists( 'WOW_DATA' )) {
		require_once plugin_dir_path( __FILE__ ) . 'include/class/data.php';
	}
	if( !class_exists( 'JavaScriptPacker' )) {
		require_once plugin_dir_path( __FILE__ ) . 'include/class/packer.php';
	}	
	
	// Plugin Folder Path.
	if ( ! defined( 'WPCODER_PLUGIN_DIR' ) ) {
		define( 'WPCODER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
	}
	
	// Plugin Folder URL.
	if ( ! defined( 'WPCODER_PLUGIN_URL' ) ) {
		define( 'WPCODER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	}
	
	// Uninstall plugin
	register_uninstall_hook( __FILE__, array( 'Coder_Class', 'uninstall' ) );
	// Declaration of the plugin class
	if( !class_exists( 'Coder_Class' ) ) {
		class Coder_Class
		{	
			const PREF = 'coder';
			public static function uninstall() {				
				global $wpdb;
				$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wow_".self::PREF );
			}
			function __construct() {
				$this->name = 'WP Coder';
				$this->menuname = 'WP Coder';
				$this->version = '1.0';				
				$this->pluginname = dirname(plugin_basename(__FILE__));
				$this->plugindir = plugin_dir_path( __FILE__ );
				$this->pluginurl = plugin_dir_url( __FILE__ );	
				$this->shortcode = 'WP-Coder';
				
				// activate & diactivate
				register_activation_hook( __FILE__, array($this, 'plugin_activate' ) );
				register_deactivation_hook( __FILE__, array($this, 'plugin_deactivate') );				
				// admin pages
				add_action( 'admin_menu', array($this, 'add_menu_page') );
				// show on front end
				
				if( !class_exists( 'Coder_Class_Extension' ) ) {
					add_shortcode($this->shortcode, array($this, 'shortcode') );				
				}
								
				// admin links
				add_filter( 'plugin_row_meta', array($this, 'row_meta'), 10, 4 );
				add_filter( 'plugin_action_links', array($this, 'action_links'), 10, 2 );
				// check asset folder
				add_filter( 'admin_init', array($this, 'asset_folder') );
				
			}
			// Activate & diactivate
			function plugin_activate() {
				require_once plugin_dir_path( __FILE__ ) . 'include/activator.php';	
			}
			function plugin_deactivate() {	
				require_once plugin_dir_path( __FILE__ ) . 'include/deactivator.php';
			}
			// AdminPanel
			function add_menu_page() {
				add_submenu_page('wow-company', $this->name.' version '.$this->version, $this->menuname, 'manage_options', $this->pluginname, array( $this, 'plugin_admin' ));
			}
			function plugin_admin() {
				require_once plugin_dir_path( __FILE__ ) . 'admin/index.php';
			}		
			// Show on Front end
			function shortcode($atts) {
				require plugin_dir_path( __FILE__ ) . 'public/shortcode.php';
			}
			function display() {
				require plugin_dir_path( __FILE__ ) . 'public/display.php';
			}
			
						
			// Admin links
			function row_meta( $meta, $plugin_file ){
				if( false === strpos( $plugin_file, basename(__FILE__) ) )
				return $meta;
				$meta[] = '<a href="https://www.facebook.com/wowaffect/" target="_blank">Join us on Facebook</a>';
				return $meta;
			}
			function action_links( $actions, $plugin_file ){
				if( false === strpos( $plugin_file, basename(__FILE__) ) )
				return $actions;
				$settings_link = '<a href="admin.php?page='. $this->pluginname .'">Settings</a>'; 
				array_unshift( $actions, $settings_link ); 
				return $actions; 
			}
			// check asset folder
			function asset_folder(){
				$path = plugin_dir_path( __FILE__ ).'asset';
				if (!is_writable($path)) {
					echo "<div class='error' id='message'><p>Please set the 775 access rights (chmod 775) for the '".$path."</p> </div>";
				} 
			}
			
		}
				
	}
	
	function wow_coder() {
		$plugin = new Coder_Class();
		return $plugin;
	}	
	// Get Running.
	wow_coder();
	
	