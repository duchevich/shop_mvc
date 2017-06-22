<?php 
	class Model_Catalog extends Model
	{
		public function get_data()
		{	
			include("data.php");
			$data['nav']['nav_catalog'] = 'active';
			$data['url'] = '/catalog';
			$data['page'] = [
				'title' => $arr_lang['nav2']
			];
			
			
			return $data;
		}
	}
 ?>