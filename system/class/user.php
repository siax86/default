<?php
/**
* класс пользователя системы
*/
class user extends main
{
	
	function __construct($data)
	{
		parent::__construct($data,__CLASS__);
		parent::registr(__CLASS__,'group',$this->id);
	}

	public static function auth($data)
	{
		$sql=
		"SELECT `id` FROM `testsystem`.`user`  WHERE `login`= :login AND `password` = :password";
		db::init();
		$id=db::init()->getObj($sql,$data);
		return $id;
	}



}
?>