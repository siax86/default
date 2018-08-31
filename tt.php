<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/system/declaration.php';
$a= get_declared_classes();
//$b= class_exists();
	echo '<pre>';
	print_r($a);
	echo '</pre>';	

?>