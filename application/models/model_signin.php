<?php 
	class Model_Signin extends Model
	{
		public function get_data()
		{	
			include("data.php");
			$data['nav']['nav_signin'] = 'active';
			$data['url'] = 'signin';
			$data['page'] = [
				'title' => $arr_lang['signin']
			];

			$data['errors'] = [
		        	'name' => '',
					'pass' => ''
		        ];
		    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
		        $login = trim(strip_tags($_POST['name']));
		        $password = trim(strip_tags($_POST['password']));
		        
		        if($login && $password){
		        	$hash = password_hash($password, PASSWORD_DEFAULT);
		        	$test = $pdo->prepare("SELECT * FROM users WHERE login = :login");
			        $test->bindParam(':login', $login);
			        $test->execute();
			        $t = $test->fetchAll();
			       /* echo '<pre>';
					print_r($t);
					echo '<pre>';*/ 
			        if (!$t) {
			            $data['errors']['name'] = ' <span class="text-danger">* Неверное имя пользователя/пароль</span>';
			            $data['errors']['pass'] = ' <span class="text-danger">* Неверное имя пользователя/пароль</span>';
			        }
			        else{
			        	$_SESSION['user'] = $login;
						header('Location: http://'.$_SERVER['HTTP_HOST'] . '/');
						exit;
			        }
			        
		        }

		        // проверка логина
		        if (!($login)) {
		            $data['errors']['name'] = ' <span class="text-danger">* Поле не заполнено</span>';
		        }
		         // проверка пароля
		        if (!($password)) {
		            $data['errors']['pass'] = ' <span class="text-danger">* Поле не заполнено</span>';
		        }
	
		    }



			return $data;
		}
	}
 ?>