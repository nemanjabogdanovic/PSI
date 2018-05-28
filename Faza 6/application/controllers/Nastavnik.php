<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Nastavnik extends CI_Controller{
		public function view($page = 'home'){
			if(!file_exists(APPPATH.'views/nastavnik/'.$page.'.php')){
				show_404();
			}
			
			if(!$this->session->userdata('user_level') === 'nastavnik'){
				redirect('users/login');
			}
			
			$data['title'] = ucfirst($page);
			
			$this->load->view('templates/header');
			$this->load->view('nastavnik/'.$page, $data);
			$this->load->view('templates/footer');
		}
	}