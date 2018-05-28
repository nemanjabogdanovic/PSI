<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Administrator extends CI_Controller{
		public function view($page = 'home'){
			if(!file_exists(APPPATH.'views/administrator/'.$page.'.php')){
				show_404();
			}
			
			if(!$this->session->userdata('user_level') === 'administrator'){
				redirect('users/login');
			}
			
			$data['title'] = ucfirst($page);
			
			$this->load->view('templates/header');
			$this->load->view('administrator/'.$page, $data);
			$this->load->view('templates/footer');
		}
	}