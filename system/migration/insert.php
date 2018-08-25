<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/system/class/db.php';
db::init();
$sql="INSERT INTO `testsystem`.`user`(`name`, `surname`, `middlename`, `login`, `password`, `status`,`user_status`) VALUES (:name, :surname, :middlename, :login, :password, :status, :user_status)";
$param = array(
	'name' => 'Иван'.rand(1,100),
	'surname' => 'Иванов'.rand(1,100),
	'middlename' => 'Иванович'.rand(1,100),
	'login' => 'ivan'.rand(1,100),
	'password' => 'pass'.rand(1,100),
	'status' => '0',
	'user_status' => '0'
);
$id=db::init()->insert($sql,$param);
echo 'insert id: '.$id.'<br>';
?>