<?php
@session_start();
if(isset($_REQUEST['client']))
{
	switch ($_REQUEST['client']) {
		case 'app':
			if(isset($_REQUEST['query']))
			{
				switch ($_REQUEST['query']) {
					case 'auth':
						$config = new stdClass();
						$config->components = array('user','user_group','user_status','test');
						$group1 = new stdClass();
						$group1->id = '1';
						$group1->name = 'Менеджер';
						$group2 = new stdClass();
						$group2->id = '2';
						$group2->name = 'Пользователь';

						$group = array();
						$group[] = $group1;
						$group[] = $group2;

						$_SESSION['user'] = new stdClass();
						$_SESSION['user']->id = 1;
						$_SESSION['user']->name = 'Иван';
						$_SESSION['user']->group = $group;
						$_SESSION['user']->config = $config;

						$json = json_encode($_SESSION['user'],JSON_UNESCAPED_UNICODE);

						echo $json;
						break;
					
					case 'get':
						$config = new stdClass();
						/*1 - read, 2 -write, 3 - run*/
						$config->components = array(
							'config' => array(
								'name'=>'Конфигурация',
								'access' => array(1,3)
							),
							'user' =>array(
								'name'=>'Пользователи',
								'access' => array(1,2,3)
							),
							'user_group' =>array(
								'name'=>'Группы пользователей',
								'access' => array(1,2,3)
							),
							'user_status' =>array(
								'name'=>'Статус пользователей',
								'access' => array(1,2,3)
							),
							'test' =>array(
								'name'=>'Тесты',
								'access' => array(1,2,3)
							)
						);
						$group1 = new stdClass();
						$group1->id = '1';
						$group1->name = 'Менеджер';
						$group2 = new stdClass();
						$group2->id = '2';
						$group2->name = 'Пользователь';

						$group = array();
						$group[] = $group1;
						$group[] = $group2;

						$_SESSION['user'] = new stdClass();
						$_SESSION['user']->id = 1;
						$_SESSION['user']->name = 'Иван';
						$_SESSION['user']->group = $group;
						$_SESSION['user']->config = $config;

						$json = json_encode($_SESSION['user'],JSON_UNESCAPED_UNICODE);

						echo $json;
						break;

					default:
						# code...
						break;
				}
			}
			else
			{
			echo '{"error":"2","description":"query error"}';
			};
			break;
		
		default:
			echo '{"error":"1","description":"client error"}';
			break;
	}
}
else
{

};

?>