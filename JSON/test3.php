<?php


//http://test.site/JSON/test3.php?query=get&data={"obj":"registr","data":{"name":"registr_user_group","user":"1"}}
include_once $_SERVER['DOCUMENT_ROOT'].'/system/config/config.current.php';
switch ($_REQUEST['query'])
{
	case 'get':
	$data= json_decode($_REQUEST['data']);
	print_r($data);
	if ($data->data->user=='1') 
	{
	echo 'все гуд';	# code...
	}
	//	print_r($data->[0]->user);

	/*$sql="SELECT * from `".$GLOBALS['config']['db_name']."`.`$data(name)` where `$data(user)`";
	db::init();
				try {
					$ids=db::init()->getAll($sql);
				} catch(Exception $e) {
					echo '<pre>';
					print_r($e);
					echo '</pre>';

				}
				
				$result = array();
				foreach ($ids as $id)
				{
					$result[] = new $data->class($id);
				};
				echo json_encode($result,JSON_UNESCAPED_UNICODE);



	


	/*foreach ($data as $user)
	{
	//	echo $user;
	}


	print_r ($data);
echo '<pre>';
	print_r($data);
	echo '</pre>';


	echo '<pre>';
	print_r($data);
	echo '</pre>';
	break;*/

}

?>