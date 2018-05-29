<?php if ( ! defined( 'ABSPATH' ) ) exit;
	include( 'list/class-list-table.php' );	
	$list_table = new Wow_List_Table($data, $this->pluginname, $this->shortcode);
	$list_table->prepare_items();
?>	 
<div class="wrap">		
	<form method="post" class="wow-login-table">		
		<?php			
			$list_table->search_box( 'Search', $this->pluginname );
			$list_table->display();
		?>		
		<input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />	
		<?php wp_nonce_field('wow_login_export_action','wow_login_export_field'); ?>
	</form>
</div>
