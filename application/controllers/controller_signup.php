<?php 
	class Controller_Signup extends Controller
	{
		function __construct()
		{
			$this->model = new Model_Signup();
			$this->view = new View();
		}

		function action_index()
		{	
			$data = $this->model->get_data();
			$this->view->generate('signup_view.php', 'template_view.php', $data);
		}
	}
 ?>