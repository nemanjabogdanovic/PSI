<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Ucenik extends CI_Controller{
		public function view($page = 'home'){
			if(!file_exists(APPPATH.'views/ucenik/'.$page.'.php')){
				show_404();
			}
			
			if(!$this->session->userdata('user_level') === 'ucenik'){
				redirect('users/login');
			}
			
			$data['title'] = ucfirst($page);
			
			$this->load->view('templates/header');
			$this->load->view('ucenik/'.$page, $data);
			$this->load->view('templates/footer');
		}
	}