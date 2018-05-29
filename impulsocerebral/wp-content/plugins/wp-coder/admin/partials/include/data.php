<?php if ( ! defined( 'ABSPATH' ) ) exit; 
$act = (isset($_REQUEST["act"])) ? $_REQUEST["act"] : '';
if ($act == "update") {
	$recid = $_REQUEST["id"];
	$result = $wpdb->get_row("SELECT * FROM $data WHERE id=$recid");
	if ($result){
        $id = $result->id;
        $title = $result->title;
		$param = unserialize($result->param);		
		$btn = "Update";
        $hidval = 2;
    }
}
else if ($act == "duplicate") {
	$recid = $_REQUEST["id"];
	$result = $wpdb->get_row("SELECT * FROM $data WHERE id=$recid");
	if ($result){
        $id = "";
        $title = "";
        $param = unserialize($result->param);				
		$btn = "Save";
        $hidval = 1;
    }
}
 else {
    $btn = "Save";
    $id = "";
	$param['item_user'] = 1;
	$param['lang'] = '';
	$param['show'] = '';
    $title = "";		
    $hidval = 1;
	
}

?>