<?php 
	class Model_Contacts extends Model
	{
		public function get_data()
		{	
			include("data.php");
			$data['nav']['nav_contacts'] = 'active';
			$data['url'] = '/contacts';
			$data['page'] = [
				'title' => $arr_lang['nav4']
			];
			return $data;
		}
	}
 ?>