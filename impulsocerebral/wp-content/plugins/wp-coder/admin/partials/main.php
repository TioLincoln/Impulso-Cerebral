<?php if ( ! defined( 'ABSPATH' ) ) exit;
	global $wpdb;
	$data = $wpdb->prefix . "wow_".self::PREF;
	$info = (isset($_REQUEST["info"])) ? $_REQUEST["info"] : '';
	if ($info == "saved") {
		echo "<div class='updated' id='message'><p><strong>Record Added</strong>.</p></div>";
	}
	if ($info == "update") {
		echo "<div class='updated' id='message'><p><strong>Record Updated</strong>.</p></div>";
	}
	if ($info == "del") {
		$delid = $_GET["did"];
		$wpdb->query("delete from " . $data . " where id=" . $delid);
		$file_style = $this->plugindir.'asset/css/style-'.$delid.'.css';
		$file_script = $this->plugindir.'asset/js/script-'.$delid.'.js';
		if (file_exists($file_style)) {
			wp_delete_file($file_style);
		}
		if (file_exists($file_script)) {
			wp_delete_file($file_script);
		}	
		echo "<div class='updated' id='message'><p><strong>Record Deleted</strong>.</p></div>";
	}
	
	$tool = (isset($_REQUEST["tool"])) ? sanitize_text_field($_REQUEST["tool"]) : 'list';		
	$tabs = array(
	'list' => array('List','fa-list'), 
	'add' => array('Add new','fa-plus'),
	'extension' => array('Extension','fa-arrows-alt'),	
	'support' => array('Support','fa-life-ring'),
	'join_us' => array('Join Us','fa-facebook'),
			
	); 
	
?>
<div class="wow">
    <span class="wow-plugin-title"><?php echo $name; ?></span> <span class="wow-plugin-version">(version <?php echo $version; ?>)</span>
	<?php echo '<ul class="wow-admin-menu">';
		foreach( $tabs as $tab => $tab_name ){
			$class = ( $tab == $tool ) ? 'active' : '';			
			echo "<li><a class='$class' href='?page=".$pluginname."&tool=$tab'>$tab_name[0] <i class='fa $tab_name[1]'></i></a></li> ";		
		}
		echo '</ul>';
		echo '<p style="padding-bottom: 5px;margin-bottom:30px;"><span class="dashicons dashicons-star-filled"></span>&nbsp;&nbsp; Please rate <a href="https://wordpress.org/plugins/modal-window/reviews/?rate=5#new-post" target="_blank">us on WordPress.org</a>. With your help our products can become better!</p>';
		
		if( $tool == 'list'){		
			echo '</div>';
			include_once ($tool.'.php'); 
		}
		elseif($tool == 'extension'){
			if(class_exists( 'Coder_Class_Extension' )){
				do_action('wp_coder_extension_page');
			}
			else {
				include_once ($tool.'.php'); 
				echo '</div>';				
			}	
			
		}
		else {			
			include_once ($tool.'.php'); 
			echo '</div>';
		}
		
	?>
