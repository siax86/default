<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/system/declaration.php';


$user = new user(array('id'=>$_REQUEST['id']));

echo '<pre>';
print_r($user);
echo '</pre>';

?>