<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/system/class/db.php';
db::init();

$sql="DROP DATABASE IF EXISTS testsystem";
try {
	$query=db::init()->query($sql);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';	
};

$sql="create database testsystem CHARACTER SET utf8 COLLATE utf8_unicode_ci";
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
`testsystem`.`user_status` 
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

//--создание таблицы  `пользователи`
$sql=
"CREATE TABLE 
`testsystem`.`user` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`name` varchar(100) NOT NULL COMMENT 'Имя пользователя',
	`surname` varchar(100) NOT NULL COMMENT 'Фамилия  пользователя',
	`middlename` varchar(100) NOT NULL COMMENT 'Отчество  пользователя', 
	`login` varchar(50) NOT NULL COMMENT 'Имя входа в систему тестирования', 
	`password` varchar(50) NOT NULL COMMENT 'Пароль',
	`user_status` int(11) NULL  COMMENT 'Сатус  ползователя( активен или  нет )', 
	`delmark` int(11) NULL COMMENT 'скрытие при удалении, для сохранения статистики за прошлые периоды', 
	PRIMARY KEY (id),
	FOREIGN KEY (`user_status`) REFERENCES `user_status`(`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
	INDEX (`user_status`)
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
`testsystem`.`user_group` 
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
`testsystem`.`user_group_user_registr` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`group_name` int(11) NULL COMMENT 'id группы пользователей',
	`user` int(11) NULL COMMENT 'id пользователя',
	PRIMARY KEY (id),
	INDEX (`group_name`),
	INDEX (`user`),
	FOREIGN KEY (`group_name`) REFERENCES `user_group`(`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
	FOREIGN KEY (`user`) REFERENCES `user`(`id`) ON DELETE SET NULL ON UPDATE NO ACTION
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
`testsystem`.`test` 
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
`testsystem`.`question` 
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
`testsystem`.`answer` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`text` varchar(100) NOT NULL COMMENT 'ответы',
	`question` int(11) NULL COMMENT 'ссылка на вопрос',
	`flag` boolean COMMENT 'правильный/неправильный',
	`delmark` int(11) NULL COMMENT 'скрытие при удалении, для сохранения статистики за прошлые периоды', 
	PRIMARY KEY (id),
	INDEX (`text`),
	FOREIGN KEY (`question`) REFERENCES `question`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
`testsystem`.`test_question_registr` 
( 
	`id` int(11) NOT NULL auto_increment COMMENT 'Идентификатор', 
	`question` int(11) NOT NULL COMMENT 'идентификатор вопроса',
	`test` int(11) NOT NULL COMMENT 'идентификатор ответа',
	PRIMARY KEY (id),
	INDEX (`question`),
	INDEX (`test`),
	
	FOREIGN KEY (`question`) REFERENCES `question`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (`test`) REFERENCES `test`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
`testsystem`.`statistiks`
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
	FOREIGN KEY (`user`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (`test`) REFERENCES `test`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
`testsystem`.`st_question`
(
	`id` INT NOT NULL AUTO_INCREMENT COMMENT 'идентификатор' ,
	`statistiks` INT NULL DEFAULT NULL COMMENT 'id теста' ,
	`t_start` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'время начала  теста' ,
	`t_stop` TIMESTAMP NULL COMMENT 'время конца теста' ,
	PRIMARY KEY  (`id`),
	INDEX  (`statistiks`),
	FOREIGN KEY (`statistiks`) REFERENCES `statistiks`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
`testsystem`.`st_answer`
(
	`id` INT NOT NULL AUTO_INCREMENT COMMENT 'идентификатор' ,
	`st_question` INT NULL DEFAULT NULL COMMENT 'id статистики по вопросам' ,
	`answer` INT NULL DEFAULT NULL COMMENT 'id ответа' ,
	`flag` boolean COMMENT 'флаг установленный на ответе в момент прохождения',
	PRIMARY KEY  (`id`),
	INDEX  (`st_question`),
	INDEX  (`answer`),
	FOREIGN KEY (`st_question`) REFERENCES `st_question`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (`answer`) REFERENCES `answer`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
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