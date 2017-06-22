<?php 
	class Controller_Info extends Controller
	{
		function __construct()
		{
			$this->model = new Model_Info();
			$this->view = new View();
		}

		function action_index()
		{	
			$data = $this->model->get_data();
			$this->view->generate('info_view.php', 'template_view.php', $data);
		}
	}
 ?>