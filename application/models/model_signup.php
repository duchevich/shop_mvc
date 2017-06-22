<?php 
	class Model_Signup extends Model
	{
		public function get_data()
		{	
			include("data.php");
			$data['nav']['nav_signup'] = 'active';
			$data['url'] = 'signup';
			$data['page'] = [
				'title' => $arr_lang['signup']
			];

			$err_name = "";
			$err_email = "";
			$err_pass = "";
			$err_pass1 = "";
			$data['errors'] = [
		        	'name' => $err_name,
					'email' => $err_email,
					'pass' => $err_pass,
					'pass1' => $err_pass1
		        ];

			if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
		        $login = trim(strip_tags($_POST['name']));
		        $email = trim(strip_tags($_POST['email']));
		        $password = trim(strip_tags($_POST['password']));
		        $password1 = trim(strip_tags($_POST['password1']));

		        // проверка логина
		        if (!($login)) {
		            $err_name = ' <span class="text-danger">* Поле не заполнено</span>';
		        }
		        else if (mb_strlen($login) > 20) {
		            $err_name = ' <span class="text-danger">* Слишком длинный логин</span>';
		        }
		        else if (mb_strlen($login) < 3) {
		            $err_name = ' <span class="text-danger">* Слишком короткий логин</span>';
		        }
		        else{
		        	$test = $pdo->prepare("SELECT * FROM users WHERE login = :login");
			        $test->bindParam(':login', $login);
			        $test->execute();
			        $t = $test->fetchAll();
			        if ($t) {
			            $err_name = ' <span class="text-danger">* Пользователь с таким логином уже зарегистрирован</span>';
			        }
		        }
		       
		        $needle = ' ';
		        $needle1 = ';';
		        $needle2 = ',';
		        $needle3 = '@';
		        $lat_t = preg_match('/[а-яё]/iu', $email);


		        // проверка почты
		        if (!($email)) {
		            $err_email = ' <span class="text-danger">* Поле не заполнено</span>';
		        }
		        // проверка почты на запрещенные символы
		        else if (stristr($email, $needle) || stristr($email, $needle1) || stristr($email, $needle2) || !stristr($email, $needle3)) {
		            $err_email = ' <span class="text-danger">* Некорректное значение e-mail</span>';
		        }
		        // проверка почты на кириллицу
		        else if ($lat_t) {
		            $err_email = ' <span class="text-danger">* Адрес почты содержит кириллицу</span>';
		        }
		        else{
		        	$test = $pdo->prepare("SELECT * FROM users WHERE email = :email");
			        $test->bindParam(':email', $email);
			        $test->execute();
			        $t = $test->fetchAll();
			        if ($t) {
			            $err_email = ' <span class="text-danger">* Пользователь с такой почтой уже зарегистрирован</span>';
			        }
		        }

		        // проверка пароля
		        if (!($password)) {
		            $err_pass = ' <span class="text-danger">* Поле не заполнено</span>';
		        }
		        else if (!($password1)) {
		            $err_pass1 = ' <span class="text-danger">* Поле не заполнено</span>';
		        }
		        else if (mb_strlen($password) < 5) {
		            $err_pass = ' <span class="text-danger">* Слишком короткий пароль</span>';
		        }
		        else if (!($password === $password1)) {
		            $err_pass = ' <span class="text-danger">* Пароли не совпадают</span>';
		        }
		        // запись в бд
		        if(!strlen($err_name) && !strlen($err_email) && !strlen($err_pass) && !strlen($err_pass1)){
		        	$hash = password_hash($password, PASSWORD_DEFAULT);
		            $access = 1;
		            $write = $pdo->prepare("INSERT INTO users (login, email, password, access) VALUES (:login, :email, :password, :access)");
		            $write->bindParam(':login', $login);
		            $write->bindParam(':email', $email);
		            $write->bindParam(':password', $hash);
		            $write->bindParam(':access', $access);
		            $write->execute();
		            echo '<h3>Вы зарегистрировались</h3>';
		            session_start();
		            $_SESSION['user'] = $login;
		        }
		        $data['errors'] = [
		        	'name' => $err_name,
					'email' => $err_email,
					'pass' => $err_pass,
					'pass1' => $err_pass1
		        ];
		        $data['user'] = $_SESSION['user'];
			}
			return $data;
		}
	}
 ?>