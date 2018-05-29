<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php include ('include/data.php'); ?>
<form action="admin.php?page=<?php echo $this->pluginname;?>" method="post">
	<div class="wowcolom">
		<div id="wow-leftcol">
			<input placeholder="Name is used only for admin purposes" type='text' name='title' value="<?php echo $title; ?>" class="wowbox" id="title">
			
			<div class="tab-box wow-admin">
				<ul class="tab-nav">
					<li><a href="#t1"><span class="fa fa-code"></span> HTML</a></li>
					<li><a href="#t2"><span class="fa fa-code"></span> CSS</a></li>
					<li><a href="#t3"><span class="fa fa-code"></span> JS</a></li>
					<li><a href="#t4"><span class="fa fa-files-o"></span> Include</a></li>
				</ul>
				<div class="tab-panels wp-coder">
					<div id="t1">
						<div class="itembox">
							<div class="item-title">
								<h3>HTML</h3>									
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-12">
									<textarea id="content_html" mode="html" name="param[content_html]" class="wp-coder">
										<?php if(!empty($param['content_html'])) { echo trim($param['content_html']); } ?>					
									</textarea>	
								</div>
							</div>							
						</div>						
					</div>
					<div id="t2">
						<div class="itembox">
							<div class="item-title">
								<h3>CSS</h3>	
								<small>Enter css code without tag 'style'</small>
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-12">
									<div class="code-mirror-before"><div>&lt;style type=&quot;text/css&quot;&gt;</div></div>
									<textarea id="content_css" mode="text/css" name="param[content_css]" class="wp-coder">
										<?php if(!empty($param['content_css'])) { echo trim($param['content_css']); } ?>					
									</textarea>	
									<div class="code-mirror-after"><div>&lt;/style&gt;</div></div>
								</div>
							</div>							
						</div>						
					</div>
					<div id="t3">
						<div class="itembox">
							<div class="item-title">
								<h3>JS</h3>		
								<small>Enter javascript code without tag 'script'</small>
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-12">
									<div class="code-mirror-before"><div>&lt;script type=&quot;text/javascript&quot;&gt;</div></div>
									<textarea id="content_js" mode="text/javascript" name="param[content_js]" class="wp-coder">
										<?php if(!empty($param['content_js'])) { echo trim($param['content_js']); } ?>					
									</textarea>
									<div class="code-mirror-after"><div>&lt;/script&gt;</div></div>
								</div>
							</div>							
						</div>						
					</div>
					
					<div id="t4">
						<div class="itembox">
							<div class="item-title">
								<h3>Include files</h3>										
							</div>
							<div id="include_file" >
								<?php $count_include = !empty($param['include']) ? count($param['include']) : 0; 
									if ($count_include > 0){
										for ($i = 0; $i < $count_include; $i++) { ?>
										<div class="wow-admin-col include-file">
											<div class="wow-admin-col-3">
												Type of file:<br/>
												<select name="param[include][<?php echo $i;?>]">
													<option <?php if($param['include'][$i]=='css') { echo 'selected="selected"'; } ?>>css</option>
													<option <?php if($param['include'][$i]=='js') { echo 'selected="selected"'; } ?>>js</option>
												</select>
											</div>
											<div class="wow-admin-col-6">
												URL to file:<br/>
												<input type="text" name="param[include_file][<?php echo $i;?>]" value="<?php echo $param['include_file'][$i]; ?>">
											</div>							
										</div>
										<?php	
										} 
									} 			
								?>
							</div>
							<div class="submit-bottom">
								<input type="button" value="Add new" class="formsub fully-rounded" onclick="itemadd()"> 
								<input type="button" class="formpreview fully-rounded" value="Delete last" onclick="itemremove()">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="wow-rightcol">
			<div class="wowbox">
				<h3>Publish</h3>
				<div class="wow-admin" style="display: block;">
					<div class="wow-admin" style="display: block;">
						<div class="wow-admin-col">
							<div class="wow-admin-col-6">
								<?php if ($id != ""){ echo '<p class="wowdel"><a href="admin.php?page='.$pluginname.'&info=del&did='.$id.'">Delete</a></p>';}; ?>
							</div>
							<div class="wow-admin-col-6 right">
								<p/>
								<input name="submit" id="submit" class="button button-primary" value="<?php echo $btn; ?>" type="submit">
							</div>
						</div>								
					</div>
				</div>
			</div>
			<div class="wowbox">
				<h3>Display</h3>
				<div class="inside wow-admin" style="display: block;">
					<?php 
						if(class_exists( 'Coder_Class_Extension' )){
							do_action('wp_coder_extensions');
						} 
						else{ ?>
						<div class="wow-admin-col wow-wrap">
							<div class="wow-admin-col-12">
								Show for users: <br/>
								<input type="radio" checked="checked"> All users <br />
								<input type="radio" disabled="disabled"> If a user logged in <a href='admin.php?page=<?php echo $pluginname;?>&tool=extension' title="Need Extension"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br />
								<input type="radio" disabled="disabled"> If user not logged <a href='admin.php?page=<?php echo $pluginname;?>&tool=extension' title="Need Extension"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a> 
							</div>							
							<div class="wow-admin-col-12">
								<input type="checkbox" disabled="disabled"> Depending on the language <a href='admin.php?page=<?php echo $pluginname;?>&tool=extension' title="Need Extension"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>
							</div>
							<div class="wow-admin-col-12">
								Insert on the website:<br/>							
								<select name='param[show]' onchange="showchange();" >
									<option value="shortecode">Where shortcode is inserted</option>									
								</select>	
								More functions in <a href='admin.php?page=<?php echo $pluginname;?>&tool=extension' title="Get More">Extension</a>
							</div>
							<div class="wow-admin-col-12" style="display:none;" id="shortcode">
								<b>[<?php echo $this->shortcode; ?> id=<?php echo $id; ?>]</b>
							</div>
						</div>
						
					<?php } ?>
				</div>
			</div>
			<div class="wowbox">
				<center><img src="<?php echo plugin_dir_url( __FILE__ ); ?>thankyou.png" alt=""  /></center>
				<hr/>
				<div class="wow-admin wow-plugins">
					<p>We will be very grateful if you <a href="https://wordpress.org/plugins/wp-coder/" target="_blank"><b>leave a review about the plugin</b></a>.</p>
					<p>If you have suggestions on how to improve the plugin or create a new plugin, write to us via the <a href="admin.php?page=<?php echo $pluginname;?>&tool=support" target="_blank"><b>support form</b></a></p>					
					<p>We really appreciate your reviews and suggestions for improving the plugin.</p>
					<p>					
					<b><em>Thank you for choosing the plugin from Wow-Company! </em></b></p>
					<em><b>Best Regards</b>,<br/>						
						<a href="https://wow-estore.com/" target="_blank">Wow-Company Team</a><br/>
						Dmytro Lobov<br/>
						<a href="mailto:support@wow-company.com">support@wow-company.com</a>
					</em>
					
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="param[time]" value="<?php echo time(); ?>" />
	<input type="hidden" name="add" value="<?php echo $hidval; ?>" />    
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="hidden" name="data" value="<?php echo $data; ?>" />
	<input type="hidden" name="page" value="<?php echo $this->pluginname;?>" />	
	<input type="hidden" name="plugdir" value="<?php echo $this->pluginname;?>" />		
	<?php wp_nonce_field('wow_plugin_action','wow_plugin_nonce_field'); ?>
</form>
