<?php
/**
* родительский класс
*/
class main 
{
	function __construct($data,$class)
	{
		if(isset($data['id']))
		{
			if(count($data) == 1)
			{
				//select and create
				db::init();
				$sql = "SELECT * FROM `testsystem`.`".$class."` WHERE `id` = :id";
				//добавить try coutch конструкцию
				$obj = db::init()->getObj($sql,$data);

				// проверить не равен ли $obj = false? если равен то обработать ошибку
				echo '<pre>';
				print_r($obj);
				echo '</pre>';
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
				//create and update
			};
		}
		else
		{
			//insert, get new id and create obj by id (constructor)
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