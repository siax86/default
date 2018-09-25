<?php
/**
* universal registr
*/
include_once $_SERVER['DOCUMENT_ROOT'].'/system/config/config.current.php';

class registr
{

	function __construct($request)
	{
		
		switch ($request['query']) 
		{
			
			case 'get':
echo 'все так!';
			$data= json_decode($request['data']);

			
				if($data->obj == 'registr')
				{
					
					//echo json_encode($_SESSION['registr'],JSON_UNESCAPED_UNICODE); 
				}
				else
				{
					echo 'что-то пошло не так!';
				};
			
			
		};

	}	
}

?>