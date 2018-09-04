<?php
/**
* api
*/
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
// реализовать возвращение  коллекции обьекта ( возвращает  все  обьекты  указанного типа, работает  при условии  , если в $data придет  только $obj [{},{},{},{}] query=get&data={"obj":"user_status"} ) -   выбраю  все  id создаю обьекты
			$data= json_decode($request['data']);

			if($data->class == 'user' && $data->data->id == 'current')
			{
				echo json_encode($_SESSION['user'],JSON_UNESCAPED_UNICODE);
			}
			else
			{
				$object= new $data->class((array)$data->data);	
				echo json_encode($object,JSON_UNESCAPED_UNICODE);
			}


			break;

			case 'set':
			$object= new $data->class((array)$data->data);	
			echo json_encode($object,JSON_UNESCAPED_UNICODE);
// если  обьеукт  создался  то :
			
// {"id":"1"}
//{"status":"error"}			
			break;

			default:
			echo "ошибка";
			break;
		}	
	}
}
?>