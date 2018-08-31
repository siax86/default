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

				echo '<pre>';
				print_r($_SESSION);
				echo '</pre>';

				echo json_encode($_SESSION['user'],JSON_UNESCAPED_UNICODE);
			}
			else
			{
				echo '{"status":"error","decription":"пользователь не найден"}';
			}
			break;

			default:
			echo "ошибка";
			break;
		}	
	}
}
?>