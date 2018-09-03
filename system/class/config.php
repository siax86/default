
<?php
/**
* конфигурация пользователя
*/
class config
{
	
	function __construct($data)
	{
		$sql = "SELECT * FROM `testsystem`.`config` WHERE `id` = :id";
		$config = db::init()->getObj($sql,$data);

		//echo '<pre>';
		//print_r($config);
		//echo '</pre>';

		foreach ($config as $key => $value) 
		{
			$this->$key = $value;
		};

		$sql = "SELECT * FROM `testsystem`.`components` WHERE `config` = :config";
		$param = array('config'=>$config->id);
		$components = db::init()->getAll($sql,$param);

		//echo '<pre>';
		//print_r($components);
		//echo '</pre>';

		$this->components = array();

		foreach ($components as $component) 
		{

			$tmp_component = new stdClass();
			$tmp_component->name = $component['name'];
			$tmp_component->access = array();


			$sql = "SELECT * FROM `testsystem`.`access` WHERE `components` = :components";
			$param = array('components'=>$component['id']);
			$access = db::init()->getAll($sql,$param);

			//echo '<pre>';
			//print_r($access);
			//echo '</pre>';

			foreach ($access as $ca) 
			{
				$tmp_component->access[] = $ca['access'];
			};

			$this->components[$component['signature']] = $tmp_component;

		};

		//echo '<pre>';
		//print_r($config);
		//echo "</pre>";

		//echo json_encode($config, JSON_UNESCAPED_UNICODE);
	}
}

?>