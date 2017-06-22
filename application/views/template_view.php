<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>MyShop | <?=$data['page']['title']?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
	<header>
		<div class="header">
			<h1>MyShop</h1>
		</div>
		<div class="languages">
			<a class="flag ru" href="<?=$data['url']?>?language=ru"></a>
            <a class="flag ua" href="<?=$data['url']?>?language=ua"></a>
            <a class="flag en" href="<?=$data['url']?>?language=en"></a>
		</div>
	</header>
	<hr>
	<nav>
		<div class="menu left">
			<a class="<?=$data['nav']['nav_main']?>" href="/"><?=$data['lang']['nav1']?></a>
			<a class="<?=$data['nav']['nav_catalog']?>" href="/catalog"><?=$data['lang']['nav2']?></a>
			<a class="<?=$data['nav']['nav_info']?>" href="/info"><?=$data['lang']['nav3']?></a>
			<a class="<?=$data['nav']['nav_contacts']?>" href="/contacts"><?=$data['lang']['nav4']?></a>
		</div>
		<div class="menu right">
			<a class="<?=$data['nav']['nav_signin']?>" href="/<?php echo (isset($_SESSION['user'])) ? 'exit' : 'signin';?>"><?php echo (!isset($_SESSION['user'])) ? $data['lang']['signin'] : $data['lang']['exit']?></a>
			<a class="<?=$data['nav']['nav_signup']?>" href="/signup"><?=$data['lang']['signup']?></a>
		</div>
	</nav>
	<hr>
	<div class="line"></div>
	<main>
		<div class="row">
			<div class="col-lg-3">
				<ul class="nav nav-aside">
				<?php 
					$cats = $data['cats'];
					/*echo '<pre>';
					print_r($cats);
					echo '</pre>';*/

					//echo '<ul class="nav">' . build_tree($cats, 0) . '</ul>';
					echo build_tree($cats, 0);

					function build_tree($cats, $parent_id, $only_parent = false){
						
					    if(is_array($cats) and isset($cats[$parent_id])){
					        $tree = '<ul>';
					        if($only_parent==false){
					            foreach($cats[$parent_id] as $cat){
					                $tree .= '<li><a href="#">'.$cat['name_category'];
						            $tree .=  build_tree($cats,$cat['id_category']);
						            $tree .= '</a></li>';
					            }
					        }elseif(is_numeric($only_parent)){
					            $cat = $cats[$parent_id][$only_parent];
					            $tree .= '<li>'.$cat['name'].' #'.$cat['id'];
					            $tree .=  build_tree($cats,$cat['id']);
					            $tree .= '</li>';
					        }
					        $tree .= '</ul>';
					    }
					    else return null;
					    return $tree;
					}
				?>
					 
			</div>
			<div class="col-lg-9">
				<p class="hello"><?=$data['lang']['hello'] .' '. $data['lang']['user']?></p>

				<?php 
					include 'application/views/'.$content_view; 
					echo '<pre>';
					print_r($cats);
					echo '</pre>';
				?>

			</div>
		</div>
		
	</main>
	<footer>
	<div class="footer">
		<p>&copy; 2017<p>
	</div>
		
	</footer>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="/js/js.js" type="text/javascript"></script>
</html>