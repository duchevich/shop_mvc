<?php 
	/*$arr_lang = [
			'ru' =>[
				'nav1' => 'Главная',
				'nav2' => 'Каталог',
				'nav3' => 'Полезная информация',
				'nav4' => 'Контакты',
				'signin' => 'Вход',
				'signup' => 'Регистрация', 
				'hello' => 'Привет, ',
				'guest' => 'гость'
			],
			'ua' =>[
				'nav1' => 'Головна',
				'nav2' => 'Каталог',
				'nav3' => 'Корисна інформація',
				'nav4' => 'Контакти',
				'signin' => 'Вхід',
				'signup' => 'Реєстрація', 
				'hello' => 'Привіт, ',
				'guest' => 'гість'
			],
			'en' =>[
				'nav1' => 'Main',
				'nav2' => 'Catalog',
				'nav3' => 'Helpful information',
				'nav4' => 'Contacts',
				'signin' => 'Sign In',
				'signup' => 'Sign Up', 
				'hello' => 'Hello, ',
				'guest' => 'guest'
			]
		];
		$arr_sign = [
			'ru' =>[
				'name' => 'имя',
				'email' => 'электронная почта',
				'password' => 'пароль',
				'password1' => 'контрольный пароль',
				'submit' => 'Отправить'
			],
			'ua' =>[
				'name' => 'ім\'я',
				'email' => 'електронна пошта',
				'password' => 'пароль',
				'password1' => 'пароль повторно',
				'submit' => 'Надіслати'
			],
			'en' =>[
				'name' => 'name',
				'email' => 'email',
				'password' => 'password',
				'password1' => 'password again',
				'submit' => 'Submit'
			]
		];*/

	// подключение к базе данных
	$host = '127.0.0.1';
	$db = 'parser_nimpha';
	$user = 'root';
	$pass = '';
	$charset = 'utf8';
	$dsn = "mysql: host=$host; dbname=$db; charset=$charset";
	$opt = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);

    // старт сессии
	if (!isset($_SESSION)) {
		session_start();
		//$_SESSION['user'] = 'guest';
	}
	/*if (!isset($_SESSION['user'])) {
		$_SESSION['user'] = 'guest';
	}*/
	// смена языка сайта и язык по умолчанию
	if (!isset($_SESSION['language'])) {
		$_SESSION['language'] = 'ru';
	}

	if (isset($_REQUEST['language'])) {
		$lang_get = strtolower(strip_tags(trim($_REQUEST['language'])));
		$query = $pdo->prepare("SELECT * FROM languages WHERE id_language = :id_language");
		$query->bindParam(':id_language', $lang_get);
		$query->execute();
		$q = $query->fetchAll();
		if(!$q){
			$_SESSION['language'] = 'ru';
		}
		else{
			$_SESSION['language'] = $lang_get;
		}
		
	}
	$arr_lang = parse_ini_file('dict/'.$_SESSION['language'].'.ini');
	
	
	//  подсветка меню навигации по сайту
	$data['nav'] = [
		'nav_main' => '',
		'nav_catalog' => '',
		'nav_info' => '',
		'nav_contacts' => '',
		'nav_signin' => '',
		'nav_signup' => ''
	];
	$data['page'] = '';
	$data['lang'] = $arr_lang;

	if(isset($_SESSION['user'])){
		$data['lang']['user'] = $_SESSION['user'];
	}

	$c = $pdo->prepare("SELECT parent_id, id_category, name_category FROM cat_name WHERE id_language = :id_language");
	$c->bindParam(':id_language', $_SESSION['language']);
	$c->execute();
	$cat = $c->fetchAll(PDO::FETCH_ASSOC);
	$cats = [];
	foreach ($cat as $cs){
		//$catalog['par_id'][] = $cats['parent_id'];
		$cats_ID[$cs['id_category']][] = $cs;
        $cats[$cs['parent_id']][$cs['id_category']] =  $cs;
	}

	$data['cat_id'] = $cats_ID;
	$data['cats'] = $cats;


 ?>