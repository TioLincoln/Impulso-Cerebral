<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	$license = trim( get_option( 'wow_license_key_'.self::PREF ) );
	$api_params = array(
		'edd_action'=> 'deactivate_license',
		'license' 	=> $license,
		'item_name' => urlencode( $this->name ), 
		'url'       => home_url()
	);
	$response = wp_remote_post( WOW_ESTORE, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );			
	// decode the license data
	$license_data = json_decode( wp_remote_retrieve_body( $response ) );	
	// $license_data->license will be either "deactivated" or "failed"
	if( $license_data->license == 'deactivated' ) {
		delete_option( 'wow_license_status_'.self::PREF );			
	}				
?>
