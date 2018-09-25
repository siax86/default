<?php
/**
* universal registr
*/
class registr
{

	function __construct($request)
	{
		
		/*switch ($_REQUEST['query'])
		{
			case 'get':*/

			$data= json_decode($_REQUEST['data']);
			if(isset($data->data)) 
			{
				if ($data->data->name=='registr_user_group')
					//?query=get&data={"class":"registr","data":{"name":"registr_user_group","user":"1"}}
				{
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
				}
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
				}
				
				
			}
		//};
	}
}	
?>