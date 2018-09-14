<?php
/**
* api
*/
include_once $_SERVER['DOCUMENT_ROOT'].'/system/config/config.current.php';

class api 
{
	
	function __construct($request)
	{
		switch ($request['query']) {
			
			case 'auth':
			$id = user::auth((array)json_decode($request['data']));
			if($id)
			{
				$_SESSION['user'] = new user((array)$id);

				echo json_encode($_SESSION['user'],JSON_UNESCAPED_UNICODE);
			}
			else
			{
				echo '{"status":"error","decription":"пользователь не найден"}';
			}
			break;

			case 'get':


			$data= json_decode($request['data']);

			if(isset($data->data)) 
			{
				if($data->class == 'user' && $data->data->id == 'current')
				{
					echo json_encode($_SESSION['user'],JSON_UNESCAPED_UNICODE); 
				}
				else
				{
					$object= new $data->class((array)$data->data);	

					echo json_encode($object,JSON_UNESCAPED_UNICODE);
				};
			}
			else
			{
				$sql=
				"SELECT `id` FROM `".$GLOBALS['config']['db_name']."`.`".$data->class."`";
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

			};





			break;

			case 'set':
			$data= json_decode($request['data']);
			$object= new $data->class((array)$data->data);	
			echo json_encode($object,JSON_UNESCAPED_UNICODE);
			break;

			default:
			echo "ошибка";
			break;
		}	
	}
}
?>