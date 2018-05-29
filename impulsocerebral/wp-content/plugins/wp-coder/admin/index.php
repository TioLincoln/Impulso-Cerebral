<?php 
	/**
		* Admin Pages
		*
		* @package     
		* @subpackage  
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       2.2
	*/
	
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	$name = $this->name;	
	$pluginname = $this->pluginname;
	$version = $this->version;
	global $wow_company_plugin;	
	$wow_company_plugin = true;		
	$license = get_option( 'wow_license_key_'.self::PREF );
	$status = get_option( 'wow_license_status_'.self::PREF );
	include_once( 'partials/main.php' );
	
	// plugin sctyles	
	wp_enqueue_style( $this->pluginname.'-style', $this->pluginurl . 'admin/css/style.css',false, $this->version);	
		
	// plugin scripts		
	wp_enqueue_script($this->pluginname.'-script', $this->pluginurl . 'admin/js/script.js', array('jquery'), $this->version);
	wp_enqueue_media ();
	
	// icon style
	wp_enqueue_style( $this->pluginname.'-icon', $this->pluginurl . 'asset/fontawesome/fontawesome.min.css', array(), '4.7.0' );
	

	
	
	
	