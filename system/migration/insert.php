<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/system/declaration.php';
db::init();
$col_status=1;
$col_user=1;
$col_group=5;
$col_test=5;
$col_question=5;
$col_answer=10;
$col_role=3;
$t_start = mktime(0,0,0,2006,1,1); 
$t_end  = time(); 

/*---------заполнение справочника статус */

$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`user_status`(`name`,`color`) VALUES (:name, :color)";
for ($i=0; $i < $col_status; $i++)
{	
	$param = array(
		'name' => 'Статус'.$i,
		'color' => '1'
	);

	$id=db::init()->insert($sql,$param);
	echo 'insert id: '.$id.'<br>';
};
echo '-----------------------------------статус: '.$i.'<br>';


/*---------заполнение справочника роли */

$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`role`(`name`,`delmark`) VALUES (:name, :delmark)";
for ($i=0; $i < $col_user; $i++)
{	
	$param = array(
		'name' => 'роль'.$i,
		'delmark' => '1'
	);

	$id=db::init()->insert($sql,$param);
	echo 'insert id: '.$id.'<br>';
};
echo '-----------------------------------role: '.$i.'<br>';

/*---------заполнение справочника конфиг */
$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`config`(`name`) VALUES (:name)";
for ($i=0; $i < $col_question; $i++)
{	
	$param = array(
		'name' =>'конфигурация'.$i
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------config: '.$i.'<br>';


/*---------заполнение справочника пользователи */
$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`user`(`name`, `surname`, `middlename`, `login`, `password`, `delmark`,`user_status`,`role`,`config`) VALUES (:name, :surname, :middlename, :login, :password, :delmark, :user_status, :role, :config)";
for ($i=0; $i < $col_user; $i++)
{
	$param = array(
		'name' => 'Иван'.rand(1,100),
		'surname' => 'Иванов'.rand(1,100),
		'middlename' => 'Иванович'.rand(1,100),
		'login' => ($i+1),
		'password' => ($i+1),
		'user_status' => rand(1,($col_status)), /* это id юзерстатуса*/
		'delmark' => '0',
		'role'=> rand(1,$col_user),
		'config'=>1 //rand(1,5)
	);

	$id=db::init()->insert($sql,$param);
	echo 'insert id_: '.$id.'<br>';
};
echo '-----------------------------------пользователи: '.$i.'<br>';

/*---------заполнение справочника группы пользователей */
$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`group`(`name`,`delmark`) VALUES (:name, :delmark)";
for ($i=0; $i < $col_group; $i++)
{	
	$param = array(
		'name' => 'Группа_'.$i,
		'delmark' => '0'
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------группы: '.$i.'<br>';

/*---------заполнение справочника роли пользователей */
$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`role`(`name`,`delmark`) VALUES (:name, :delmark)";
for ($i=1; $i < ($col_role+1); $i++)
{	
	$param = array(
		'name' => 'роль'.$i,
		'delmark' => '0'
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------роли: '.$i.'<br>';


/*---------заполнение справочника тесты */
$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`test`(`name`,`delmark`) VALUES (:name, :delmark)";
for ($i=0; $i < $col_test; $i++)
{	
	$param = array(
		'name' => 'Тест_'.$i,
		'delmark' => '0'
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------тесты: '.$i.'<br>';


/*---------заполнение справочника вопросы */
$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`question`(`name`,`delmark`) VALUES (:name, :delmark)";
for ($i=0; $i < $col_question; $i++)
{	
	$param = array(
		'name' => 'сколько будет'.$i.'+'.$i,
		'delmark' => '0'
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------вопросы: '.$i.'<br>';
/*---------заполнение test_question_registr */
$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`test_question_registr`(`question`,`test`) VALUES (:question, :test)";
for ($i=0; $i < $col_question; $i++)
{	
	$param = array(
		'question' => rand(1,$col_question),
		'test' => rand(1,$col_test)
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------test_question_registr: '.$i.'<br>';

/*---------заполнение registr_user_group */
$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`registr_user_group`(`group`,`user`) VALUES (:group, :user)";
for ($i=0; $i < $col_group; $i++)
{	
	$param = array(
		'group' => ($i+1),
		'user' => rand(1,$col_user)
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------test_question_registr: '.$i.'<br>';

/*---------заполнение справочника ответы */
$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`answer`(`text`,`question`,`flag`,`delmark`) VALUES (:text, :question, :flag, :delmark)";
for ($i=0; $i < $col_answer; $i++)
{	
	$param = array(
		'text' => 'ответ:'.$i,
		'question' => rand(1,$col_question),
		'flag' => rand(0,1),
		'delmark' => '0'
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------ответы: '.$i.'<br>';

/*---------заполнение справочника статистикс */
$start = mktime(0,0,0,2006,1,1); 
echo '----------qwerty-----------'.$start.'<br>';
$end  = time(); 
$randomStamp = rand($start,$end); 
$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`statistiks`(`user`,`test`,`t_start`,`t_stop`,`flag`,`error_count`,`total_count`,`max_error_count`) VALUES (:user,:test,:t_start,:t_stop,:flag,:error_count,:total_count,:max_error_count)";
for ($i=0; $i < $col_test; $i++)
{	
	$param = array(
		'user' => rand(1,$col_user),
		'test' => rand(1,$col_test),
		't_start' => date("Y-m-d H:i:s",rand($t_start,$t_end)),
		't_stop' => date("Y-m-d H:i:s",rand($t_start,$t_end)),
		'flag' => rand(0,1),
		'error_count' => rand(1,$col_answer),
		'total_count' => rand(1,$col_answer),
		'max_error_count' => rand(1,$col_answer),
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------статистика ститистикс: '.$i.'<br>';

/*---------заполнение справочника статистика-вопросы */

$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`st_question`(`statistiks`,`t_start`,`t_stop`) VALUES (:statistiks, :t_start, :t_stop)";
for ($i=0; $i < $col_question; $i++)
{	
	$param = array(
		'statistiks' => rand(1,$col_test),
		't_start' => date("Y-m-d H:i:s",rand($t_start,$t_end)),
		't_stop' => date("Y-m-d H:i:s",rand($t_start,$t_end))
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------статистика вопросы: '.$i.'<br>';

/*---------заполнение справочника статистика-ответы */
$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`st_answer`(`st_question`,`answer`,`flag`) VALUES (:st_question, :answer, :flag)";
for ($i=0; $i < $col_question; $i++)
{	
	$param = array(
		'st_question' => rand(1,$col_question),
		'answer' => rand(1,$col_answer),
		'flag' => rand(0,1)
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------статистика ответы: '.$i.'<br>';


/*----------заполнение таблицы components */
$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`components`(`config`,`name`,`signature`) VALUES (:config, :name, :signature)";
$tmp=array();
$tmp[]='пользователь';
$tmp[]='статус пользователя';
$tmp[]='группа пользователя';
$tmp[]='права доступа';
$tmp[]='роль';
$tmp[]='тест';
$tmp[]='вопросы';
$tmp[]='ответы';
$tmp1=array();
$tmp1[]='user';
$tmp1[]='user_status';
$tmp1[]='group';
$tmp1[]='access';
$tmp1[]='role';
$tmp1[]='test';
$tmp1[]='question';
$tmp1[]='answer';
for ($i=0; $i < 8; $i++)
	
{	
	$param = array(
		'config' =>rand(1,1),
		'name' => $tmp[$i],
		'signature' =>$tmp1[$i] // значение может быть так же user_status или group 
	);
	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------components1: '.$i.'<br>';

/*---------заполнение справочника `access */
$sql="INSERT INTO `".$GLOBALS['config']['db_name']."`.`access`(`components`,`access`) VALUES ( :components, :access)";
for ($i=1; $i < 4; $i++)
{	
	$param = array(
		'components' => 1, //rand(1,3),
		'access' => $i//rand(1,3)
	);
	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------access: '.$i.'<br>';

$sql= 
"SELECT `user`.`name`, `user_status`.`name` FROM `".$GLOBALS['config']['db_name']."`.`user`
LEFT JOIN
`".$GLOBALS['config']['db_name']."`.`user_status`
ON
`user`.`user_status` = `user_status`.`id`";
/*"CREATE VIEW list_user AS SELECT

`user`.`id`, 
`user`.`name`, 
`user`.`surname`, 
`user`.`middlename`, 
`user`.`login`, 
`user`.`password`, 
`user`.`user_status`,
`user_status`.`name` AS `user_status_name`,
`user`.`role`, 
`role`.`name` AS `role_name`,
`user`.`config`,
`config`.`name` AS `config_name`,
`user`.`delmark` 
FROM 
`".$GLOBALS['config']['db_name']."`.`user`
LEFT JOIN
`".$GLOBALS['config']['db_name']."`.`user_status`
ON
`user`.`user_status` = `user_status`.`id`,
LEFT JOIN
`".$GLOBALS['config']['db_name']."`.`role`
ON
`user`.`role` = `role`.`id`,
LEFT JOIN
`".$GLOBALS['config']['db_name']."`.`config`
ON
`user`.`config` = `config`.`id`;
ENGINE = InnoDB
COMMENT 'Вьюшка пользователя'";
*/


try {
	$query=db::init()->getall($sql);
	echo $sql;
	echo '________________';
	//echo $query;
    echo '<pre>';
	print_r($query);
	echo '</pre>';	
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};



?>