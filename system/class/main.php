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
				};
			}
			else
			{
				self::update($data,$class);
			};
		}
		else
		{
			self::insert($data,$class);
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

	function insert($data,$class)
	{

		$sql = "INSERT INTO `".$GLOBALS['config']['db_name']."`.`".$class."` (";
		$values = "(";

		foreach ($data as $key => $value) 
		{
			if($key != 'id')
			{
				if(class_exists($key))
				{
					$this->$key = new $key(array('id'=>$value));
				}
				else
				{
					$this->$key = $value; 
				};

				$sql .= "`".$key."`,";
				$values .= ":".$key.",";
			};
		};

		$sql = substr($sql, 0,-1).") VALUES ".substr($values, 0,-1).")";

		try 
		{
			unset($data['id']);
			$id = db::init()->insert($sql,$data);
			$this->id = $id;
		} 
		catch (Exception $e) 
		{
			echo '<pre>';
			print_r($e);
			echo '</pre>';
		};


	}

	function update($data,$class)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		$sql = "UPDATE `".$GLOBALS['config']['db_name']."`.`".$class."` SET ";
		foreach ($data as $key => $value) 
		{
			if(class_exists($key))
			{
				$this->$key = new $key(array('id'=>$value));
			}
			else
			{
				$this->$key = $value; 
			};

			if ($key != 'id') 
			{
				$sql .= "`".$key."`=:".$key.",";
			};	
		};

		$sql = substr($sql, 0,-1)." WHERE `id` = :id";

		try 
		{
			$id = db::init()-> update($sql,$data);
		} 
		catch (Exception $e) 
		{
			echo '<pre>';
			print_r($e);
			echo '</pre>';
			//логирование ошибки $e
		};
	}
}
?>