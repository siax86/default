<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/system/class/db.php';
$sql = "SELECT * FROM `testsystem`.`config` WHERE `id` = :id";
$param = array('id'=>1);
$config = db::init()->getObj($sql,$param);

echo '<pre>';
print_r($config);
echo '</pre>';

$sql = "SELECT * FROM `testsystem`.`components` WHERE `config` = :config";
$param = array('config'=>$config->id);
$components = db::init()->getAll($sql,$param);

echo '<pre>';
print_r($components);
echo '</pre>';

$config->components = array();
foreach ($components as $component) 
{

	$tmp_component = new stdClass();
	$tmp_component->name = $component['name'];
	$tmp_component->access = array();

	$sql = "SELECT * FROM `testsystem`.`access` WHERE `components` = :components";
	$param = array('components'=>$component['id']);
	$access = db::init()->getAll($sql,$param);

	echo '<pre>';
	print_r($access);
	echo '</pre>';

	foreach ($access as $ca) 
	{
		$tmp_component->access[] = $ca['access'];
	};

	$config->components[$component['signature']] = $tmp_component;

};

echo '<pre>';
print_r($config);
echo "</pre>";

echo json_encode($config, JSON_UNESCAPED_UNICODE);

?>