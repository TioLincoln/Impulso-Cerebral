
jQuery(document).ready(function($) {
	
	language();
	usersroles();
	showchange();

});
function showchange(){	
	var show = jQuery('[name="param[show]"]').val();
	if (show == 'posts' || show == 'pages' || show == 'expost' || show == 'expage'|| show == 'taxonomy'){
		jQuery('#id_post').css('display', '');
		jQuery('#shortcode').css('display', 'none');
	}
	else if (show == 'shortecode'){
		jQuery('#shortcode').css('display', '');
		jQuery('#id_post').css('display', 'none');
	}
	else {
		jQuery('#shortcode').css('display', 'none');
		jQuery('#id_post').css('display', 'none');
	}		
	if (show == 'taxonomy'){
		jQuery('#taxonomy').css('display', '');
	}
	else{
		jQuery('#taxonomy').css('display', 'none');
	}
}
function language(){
	if (jQuery('[name="param[depending_language]"]').is(':checked')){
		jQuery('#language').css('display', '');
	}
	else {
		jQuery('#language').css('display', 'none');
	}
}

function usersroles(){
	var users = jQuery('input[name="param[item_user]"]:checked').val();	
	if (users == 2){
		jQuery('#users_roles').css('display', '');
	}
	else{
		jQuery('#users_roles').css('display', 'none');
	}
	
}

function itemadd(menu){  
 		
	var item = '<div class="wow-admin-col include-file"> <div class="wow-admin-col-3"> Type of file:<br/> <select name="param[include][]"> <option>css</option> <option>js</option> </select> </div> <div class="wow-admin-col-6"> URL to file:<br/> <input type="text" value="" name="param[include_file][]" > </div> </div>';	
	jQuery(item).appendTo("#include_file");	
	
}
function itemremove(menu){		
	jQuery("div.include-file").last().remove();
}