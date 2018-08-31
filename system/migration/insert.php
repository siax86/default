<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/system/class/db.php';
db::init();
$col_status=5;
$col_user=10;
$col_group=5;
$col_test=5;
$col_question=5;
$col_answer=10;
$col_role=3;
$t_start = mktime(0,0,0,2006,1,1); 
$t_end  = time(); 

/*---------заполнение справочника статус */

$sql="INSERT INTO `testsystem`.`user_status`(`name`,`color`) VALUES (:name, :color)";
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

/*---------заполнение справочника пользователи */
$sql="INSERT INTO `testsystem`.`user`(`name`, `surname`, `middlename`, `login`, `password`, `delmark`,`user_status`) VALUES (:name, :surname, :middlename, :login, :password, :delmark, :user_status)";
for ($i=0; $i < $col_user; $i++)
{
	$param = array(
		'name' => 'Иван'.rand(1,100),
		'surname' => 'Иванов'.rand(1,100),
		'middlename' => 'Иванович'.rand(1,100),
		'login' => 'ivan'.rand(1,100),
		'password' => 'pass'.rand(1,100),
		'user_status' => rand(1,($col_status)), /* это id юзерстатуса*/
		'delmark' => '0'
	);

	$id=db::init()->insert($sql,$param);
	echo 'insert id_: '.$id.'<br>';
};
echo '-----------------------------------пользователи: '.$i.'<br>';

/*---------заполнение справочника группы пользователей */
$sql="INSERT INTO `testsystem`.`user_group`(`name`,`delmark`) VALUES (:name, :delmark)";
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
$sql="INSERT INTO `testsystem`.`role`(`name`,`delmark`) VALUES (:name, :delmark)";
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
$sql="INSERT INTO `testsystem`.`test`(`name`,`delmark`) VALUES (:name, :delmark)";
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
$sql="INSERT INTO `testsystem`.`question`(`name`,`delmark`) VALUES (:name, :delmark)";
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
$sql="INSERT INTO `testsystem`.`test_question_registr`(`question`,`test`) VALUES (:question, :test)";
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

/*---------заполнение user_group_user_registr */
$sql="INSERT INTO `testsystem`.`user_group_user_registr`(`group_name`,`user`) VALUES (:group_name, :user)";
for ($i=0; $i < $col_question; $i++)
{	
	$param = array(
		'group_name' => rand(1,$col_group),
		'user' => rand(1,$col_user)
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------test_question_registr: '.$i.'<br>';

/*---------заполнение справочника ответы */
$sql="INSERT INTO `testsystem`.`answer`(`text`,`question`,`flag`,`delmark`) VALUES (:text, :question, :flag, :delmark)";
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
$end  = time(); 
$randomStamp = rand($start,$end); 
$sql="INSERT INTO `testsystem`.`statistiks`(`user`,`test`,`t_start`,`t_stop`,`flag`,`error_count`,`total_count`,`max_error_count`) VALUES (:user,:test,:t_start,:t_stop,:flag,:error_count,:total_count,:max_error_count)";
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

$sql="INSERT INTO `testsystem`.`st_question`(`statistiks`,`t_start`,`t_stop`) VALUES (:statistiks, :t_start, :t_stop)";
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
$sql="INSERT INTO `testsystem`.`st_answer`(`st_question`,`answer`,`flag`) VALUES (:st_question, :answer, :flag)";
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

/*---------заполнение справочника конфиг */
$sql="INSERT INTO `testsystem`.`config`(`name`) VALUES (:name)";
for ($i=0; $i < $col_question; $i++)
{	
	$param = array(
		'name' =>'конфигурация'.$i
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------config: '.$i.'<br>';

/*---------заполнение справочника таблица-доступов */
$sql="INSERT INTO `testsystem`.`components_composition_access`(`name`) VALUES (:name)";
for ($i=0; $i < 6; $i++)
{	
	$param = array(
		'name' =>'уровень доступа'.$i
	);

	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------доступы: '.$i.'<br>';

/*---------заполнение таблицы components */
$sql="INSERT INTO `testsystem`.`components`(`config`) VALUES (:config)";
for ($i=0; $i < 6; $i++)
{	
	$param = array(
		'config' =>rand(1,$col_question)
	);
	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------components1: '.$i.'<br>';

/*---------заполнение справочника components_composition */
$sql="INSERT INTO `testsystem`.`components_composition`(`name`,`components`,`access`) VALUES (:name, :components, :access)";
for ($i=0; $i < $col_user; $i++)
{	
	$param = array(
		'name' => 'композиция'.rand(1,$col_user),
		'components' => rand(1,6),
		'access' => rand(1,5)
	);
	$id=db::init()->insert($sql,$param);
	echo 'insertgr id: '.$id.'<br>';
};
echo '-----------------------------------components_composition: '.$i.'<br>';



?>