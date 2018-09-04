<?php
/**
* родительский класс
*/
class main 
{
	function __construct($data,$class)
	{
		if($data['id'] != '')
		{
			if(count($data) == 1)
			{
				//select and create
				db::init();
				$sql = "SELECT * FROM `".$GLOBALS['config']['db_name']."`.`".$class."` WHERE `id` = :id";
				//добавить try coutch конструкцию
				$obj = db::init()->getObj($sql,$data);

				// проверить не равен ли $obj = false? если равен то обработать ошибку
				foreach ($obj as $key => $value) 
				{
					if(class_exists($key))
					{
						$this->$key = new $key(array('id'=>$value));
					}
					else
					{
						$this->$key = $value; 
					};
				}
			}
			else
			{
				//update
			};
		}
		else
		{
			//insert, get new id and create obj by id (constructor)
		};
	}

	function registr($class,$related,$id)
	{
		db::init();
		$sql = "SELECT `".$related."` AS `id` FROM `".$GLOBALS['config']['db_name']."`.`registr_".$class."_".$related."` WHERE `".$class."` = :".$class;
		$param = array($class => $id);
		$ids = db::init()->getAll($sql,$param);

		$this->$related = array();

		foreach ($ids as $id) 
		{
			$this->$related[] = new $related($id);
		};		
	}

	function insert()
	{

	}

	function update()
	{

	}
}
?>