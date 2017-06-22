<?php 
	class Model_Main extends Model
	{
		public function get_data()
		{	
			include("data.php");
			$data['nav']['nav_main'] = 'active';
			$data['url'] = '/';
			$data['page'] = [
				'title' => $arr_lang['nav1']
			];
			return $data;
		}
	}
 ?>