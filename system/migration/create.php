<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/system/class/db.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/system/config/config.current.php';
db::init();

$sql="DROP DATABASE IF EXISTS `".$GLOBALS['config']['db_name']."`";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};

$sql="CREATE DATABASE `".$GLOBALS['config']['db_name']."` CHARACTER SET utf8 COLLATE utf8_unicode_ci";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};
//------------------------------------------------БЛОК конфигурация
//----создание таблицы конфиг
$sql=
"CREATE TABLE 
`".$GLOBALS['config']['db_name']."`.`config` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`name` varchar(100) NOT NULL COMMENT 'наименование конфигурации',
	PRIMARY KEY (id)
) 
COLLATE 'utf8_general_ci'
ENGINE=InnoDB
COMMENT 'конфигурация'";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';
};

//----создание таблицы компонентс

$sql=
"CREATE TABLE 
`".$GLOBALS['config']['db_name']."`.`components` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`config` int(11) NULL COMMENT 'идентификатор конфигурации',
	`name` varchar(100) NOT NULL COMMENT 'имя компонента',
	`signature` varchar(100) NOT NULL COMMENT 'сигнатура компонента',
	PRIMARY KEY (id),
	FOREIGN KEY (`config`) REFERENCES `".$GLOBALS['config']['db_name']."`.`config`(`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
	INDEX (`config`)
) 
COLLATE 'utf8_general_ci'
ENGINE=InnoDB
COMMENT 'компоненты для конфигурации'";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';
};
	//----создание таблицы конфиг компонентс_композитион
$sql=
"CREATE TABLE 
`".$GLOBALS['config']['db_name']."`.`access` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`components` int(11) NULL COMMENT 'идентификатор конфигурации',
	`access` int(1) NULL COMMENT 'идентификатор конфигурации',
	PRIMARY KEY (id),
	FOREIGN KEY (`components`) REFERENCES `".$GLOBALS['config']['db_name']."`.`components`(`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
	INDEX (`components`)
) 
COLLATE 'utf8_general_ci'
ENGINE=InnoDB
COMMENT 'права доступа к компонентам'";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';
};


//________________________________________________БЛОК ПОЛЬЗОВАТЕЛЯ

//---создание таблицы `Разбиение пользователей по группам`
$sql=
"CREATE TABLE 
`".$GLOBALS['config']['db_name']."`.`user_status` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`name` varchar(100) NOT NULL COMMENT 'наименование статуса',
	`color` varchar(100) NOT NULL COMMENT 'цвет статуса',
	PRIMARY KEY (id)
) 
COLLATE 'utf8_general_ci'
ENGINE=InnoDB
COMMENT 'статус активности пользователя'";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';
};

//---создание таблицы `роли пользователей`
$sql=
"CREATE TABLE 
`".$GLOBALS['config']['db_name']."`.`role` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`name` varchar(100) NOT NULL COMMENT 'наименование статуса',
	`delmark` int(11) NULL COMMENT 'скрытие при удалении, для сохранения статистики за прошлые периоды', 

	PRIMARY KEY (id)
) 
COLLATE 'utf8_general_ci'
ENGINE=InnoDB
COMMENT 'роль пользователя'";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';
};
//--создание таблицы  `пользователи`
$sql=
"CREATE TABLE 
`".$GLOBALS['config']['db_name']."`.`user` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`name` varchar(100) NOT NULL COMMENT 'Имя пользователя',
	`surname` varchar(100) NOT NULL COMMENT 'Фамилия  пользователя',
	`middlename` varchar(100) NOT NULL COMMENT 'Отчество  пользователя', 
	`login` varchar(50) NOT NULL COMMENT 'Имя входа в систему тестирования', 
	`password` varchar(50) NOT NULL COMMENT 'Пароль',
	`user_status` int(11) NULL  COMMENT 'Сатус  ползователя( активен или  нет )',
	`role` int(11) NULL  COMMENT 'роль  ползователя',  
	`config` int(11) NULL  COMMENT 'конфиг id',  
	`delmark` int(11) NULL COMMENT 'скрытие при удалении, для сохранения статистики за прошлые периоды', 
	PRIMARY KEY (id),
	FOREIGN KEY (`user_status`) REFERENCES `".$GLOBALS['config']['db_name']."`.`user_status`(`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
	FOREIGN KEY (`role`) REFERENCES `".$GLOBALS['config']['db_name']."`.`role`(`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
	FOREIGN KEY (`config`) REFERENCES `".$GLOBALS['config']['db_name']."`.`config`(`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
	INDEX (`user_status`),
	INDEX (`role`),
	INDEX (`config`)
) 
COLLATE 'utf8_general_ci'
ENGINE=InnoDB
COMMENT 'Пользователи'";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};

//---создание таблицы `группы пользователей`
$sql=
"CREATE TABLE 
`".$GLOBALS['config']['db_name']."`.`group` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`name` varchar(100) NOT NULL COMMENT 'Имя пользователя',
	`delmark` int(11) NULL COMMENT 'Сатус  ползователя( скрытие при удалении, для сохранения статистики за прошлые периоды)', 
	PRIMARY KEY (id),
	INDEX (`name`)
) 
COLLATE 'utf8_general_ci'
ENGINE=InnoDB
COMMENT 'Группы пользователей'";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};


//---создание таблицы `Разбиение пользователей по группам`
$sql=
"CREATE TABLE 
`".$GLOBALS['config']['db_name']."`.`registr_user_group` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`group` int(11) NULL COMMENT 'id группы пользователей',
	`user` int(11) NULL COMMENT 'id пользователя',
	PRIMARY KEY (id),
	INDEX (`group`),
	INDEX (`user`),
	FOREIGN KEY (`group`) REFERENCES `".$GLOBALS['config']['db_name']."`.`group`(`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
	FOREIGN KEY (`user`) REFERENCES `".$GLOBALS['config']['db_name']."`.`user`(`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) 
COLLATE 'utf8_general_ci'
ENGINE=InnoDB
COMMENT 'Разбиение пользователей по группам'";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};


//------------------------------------------------БЛОК ВОПРОСЫ-ОТВЕТЫ  ТЕСТИРОВАНИЯ
//--_создание таблицы `название теста`
$sql=
"CREATE TABLE 
`".$GLOBALS['config']['db_name']."`.`test` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`name` varchar(100) NOT NULL COMMENT 'название теста',
	`delmark` int(11) NULL COMMENT 'скрытие при удалении, для сохранения статистики за прошлые периоды', 
	PRIMARY KEY (id),
	INDEX (`name`)
) 
COLLATE 'utf8_general_ci'
ENGINE=InnoDB
COMMENT 'Название теста'";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};

//--_создание таблицы `вопросы для теста`
$sql=
"CREATE TABLE 
`".$GLOBALS['config']['db_name']."`.`question` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`name` varchar(100) NOT NULL COMMENT 'название вопроса',
	`delmark` int(11) NULL COMMENT 'скрытие при удалении, для сохранения статистики за прошлые периоды', 
	PRIMARY KEY (id),
	INDEX (`name`)
) 
COLLATE 'utf8_general_ci'
ENGINE=InnoDB
COMMENT 'вопросы для теста'";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};



//--_создание таблицы `ответы к тесту`
$sql=
"CREATE TABLE 
`".$GLOBALS['config']['db_name']."`.`answer` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`text` varchar(100) NOT NULL COMMENT 'ответы',
	`question` int(11) NULL COMMENT 'ссылка на вопрос',
	`flag` boolean COMMENT 'правильный/неправильный',
	`delmark` int(11) NULL COMMENT 'скрытие при удалении, для сохранения статистики за прошлые периоды', 
	PRIMARY KEY (id),
	INDEX (`text`),
	FOREIGN KEY (`question`) REFERENCES `".$GLOBALS['config']['db_name']."`.`question`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) 
COLLATE 'utf8_general_ci'
ENGINE=InnoDB
COMMENT 'ответы для тестов'";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};

//--_создание таблицы `добавление ответов к вопросу`
$sql=
"CREATE TABLE 
`".$GLOBALS['config']['db_name']."`.`test_question_registr` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`question` int(11) NOT NULL COMMENT 'идентификатор вопроса',
	`test` int(11) NOT NULL COMMENT 'идентификатор ответа',
	PRIMARY KEY (id),
	INDEX (`question`),
	INDEX (`test`),
	
	FOREIGN KEY (`question`) REFERENCES `".$GLOBALS['config']['db_name']."`.`question`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (`test`) REFERENCES `".$GLOBALS['config']['db_name']."`.`test`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) 
COLLATE 'utf8_general_ci'
ENGINE=InnoDB
COMMENT 'добавляем  ответы к вопросу'";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};

//------------------------------------------------БЛОК СТАТИСТИКА ТЕСТА
//----таблица общей статистики
$sql=
"CREATE TABLE
`".$GLOBALS['config']['db_name']."`.`statistiks`
(
	`id` INT NOT NULL AUTO_INCREMENT COMMENT 'идентификатор' ,
	`user` INT NULL DEFAULT NULL COMMENT 'id пользователя' ,
	`test` INT NULL DEFAULT NULL COMMENT 'id теста' ,
	`t_start` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'время начала  теста' ,
	`t_stop` TIMESTAMP NULL COMMENT 'время конца теста' ,
	`flag` BOOLEAN NOT NULL COMMENT 'сдан или не сдан' ,
	`error_count` INT NOT NULL COMMENT 'количество ошибок' ,
	`total_count` INT NOT NULL COMMENT 'общее количество ответов' ,
	`max_error_count` INT NOT NULL COMMENT 'максимальное количество ошибок' ,
	PRIMARY KEY  (`id`),
	INDEX  (`user`),
	INDEX  (`test`),
	FOREIGN KEY (`user`) REFERENCES `".$GLOBALS['config']['db_name']."`.`user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (`test`) REFERENCES `".$GLOBALS['config']['db_name']."`.`test`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = InnoDB
COMMENT 'статистика'";

try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};
//--- таблица статистики-вопросы 
$sql=
"CREATE TABLE
`".$GLOBALS['config']['db_name']."`.`st_question`
(
	`id` INT NOT NULL AUTO_INCREMENT COMMENT 'идентификатор' ,
	`statistiks` INT NULL DEFAULT NULL COMMENT 'id теста' ,
	`t_start` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'время начала  теста' ,
	`t_stop` TIMESTAMP NULL COMMENT 'время конца теста' ,
	PRIMARY KEY  (`id`),
	INDEX  (`statistiks`),
	FOREIGN KEY (`statistiks`) REFERENCES `".$GLOBALS['config']['db_name']."`.`statistiks`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = InnoDB
COMMENT 'статистика по ответам'";

try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};
//--- таблица статистики-оветы 
$sql=
"CREATE TABLE
`".$GLOBALS['config']['db_name']."`.`st_answer`
(
	`id` INT NOT NULL AUTO_INCREMENT COMMENT 'идентификатор' ,
	`st_question` INT NULL DEFAULT NULL COMMENT 'id статистики по вопросам' ,
	`answer` INT NULL DEFAULT NULL COMMENT 'id ответа' ,
	`flag` boolean COMMENT 'флаг установленный на ответе в момент прохождения',
	PRIMARY KEY  (`id`),
	INDEX  (`st_question`),
	INDEX  (`answer`),
	FOREIGN KEY (`st_question`) REFERENCES `".$GLOBALS['config']['db_name']."`.`st_question`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (`answer`) REFERENCES `".$GLOBALS['config']['db_name']."`.`answer`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = InnoDB
COMMENT 'статистика по ответам'";

try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};

?>