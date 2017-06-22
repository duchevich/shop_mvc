<?php 
	class Model_Info extends Model
	{
		public function get_data()
		{	
			include("data.php");
			$data['nav']['nav_info'] = 'active';
			$data['url'] = 'info';
			$data['page'] = [
				'title' => $arr_lang['nav3']
			];
			return $data;
		}
	}
 ?>