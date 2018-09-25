<?php
//http://test.site/JSON/test3.php?query=get&data={"obj":"registr","data":{"name":"registr_user_group","user":"1"}}
include_once $_SERVER['DOCUMENT_ROOT'].'/system/declaration.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/system/config/config.current.php';
switch ($_REQUEST['query'])
{
	case 'get':
	$data= json_decode($_REQUEST['data']);
	$sql="SELECT * FROM `".$GLOBALS['config']['db_name']."`.`".$data->data->name."` where `user`= ".$data->data->user."";
	db::init();
	try	
	{
		$ids=db::init()->getAll($sql);
	}
	catch(Exception $e)
	{
		echo '<pre>';
		print_r($e);
		echo '</pre>';
	}
	$result = array();
	foreach ($ids as $id)
	{
		$result[] = $id;
	};
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
?>