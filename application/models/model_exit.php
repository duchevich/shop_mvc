<?php 
	class Model_Exit extends Model
	{
		public function get_data()
		{	
			
			include("data.php");
			unset($_SESSION['user']);
			$data['lang']['user'] = $arr_lang['user'];
			$data['nav']['nav_main'] = 'active';
			$data['url'] = '/';
			$data['page'] = [
				'title' => $arr_lang['nav1']
			];
			return $data;
		}
	}
 ?>