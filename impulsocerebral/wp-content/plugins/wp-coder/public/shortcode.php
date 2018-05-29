<?php 
	/**
		* Shortcode
		*
		* @package     Public
		* @subpackage  
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       2.1
	*/
	
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	extract(shortcode_atts(array('id' => ""), $atts));		
	global $wpdb;
	$table = $wpdb->prefix . 'wow_'.self::PREF;    
	$sSQL = $wpdb->prepare("select * from $table WHERE id = %d", $id);
	$arrresult = $wpdb->get_results($sSQL); 	
	if (count($arrresult) > 0) {
		foreach ($arrresult as $key => $val) {
			$param = unserialize($val->param);
			ob_start();
			include( 'partials/public.php' );			
			$coder = ob_get_contents();
			ob_end_clean();
			
			$path_style = $this->plugindir.'/asset/css/style-'.$val->id.'.css';
			$path_script = $this->plugindir.'/asset/js/script-'.$val->id.'.js';
			$file_style = $this->plugindir.'/admin/partials/generator/style.php';
			$file_script = $this->plugindir.'/admin/partials/generator/script.php';
			if (file_exists($file_style) && !file_exists($path_style)){
				ob_start();
				include ($file_style);
				$content_style = ob_get_contents();
				ob_end_clean();
				file_put_contents($path_style, $content_style);
			}			
			if (file_exists($file_script) && !file_exists($path_script)){
				ob_start();
				include ($file_script);
				$content_script = ob_get_contents();
				$packer = new JavaScriptPacker($content_script, 'Normal', true, false);
				$packed = $packer->pack();
				ob_end_clean();
				file_put_contents($path_script, $packed);				
			}
			
			echo $coder;
			$time = !empty($param['time']) ? $param['time'] : '';
			if (file_exists($path_style) && !empty($param['content_css']) ) {
				wp_enqueue_style( $this->pluginname.'-'.$val->id, $this->pluginurl. 'asset/css/style-'.$val->id.'.css', array(), $time);	
			}
			if (file_exists($path_script) && !empty($param['content_js']) ) {					
				wp_enqueue_script( $this->pluginname.'-'.$val->id, $this->pluginurl. 'asset/js/script-'.$val->id.'.js', array( 'jquery' ), $time );
			}
			
			$count_include = !empty($param['include']) ? count($param['include']) : 0;
			if ($count_include > 0){
				for ($i = 0; $i < $count_include; $i++) {
					if( $param['include'][$i] == 'css' && !empty($param['include_file'][$i]) ) {						
						wp_enqueue_style( $this->pluginname.'-'.$val->id.'-css-'.$i, $param['include_file'][$i], array(), $this->version);
					}
					elseif( $param['include'][$i] == 'js' && !empty($param['include_file'][$i]) ) {
						wp_enqueue_script( $this->pluginname.'-'.$val->id.'-js-'.$i, $param['include_file'][$i], array( 'jquery' ), $this->version );
					}
					
				}
			}
			
			
			
		}
		
	} 
	
return ;	