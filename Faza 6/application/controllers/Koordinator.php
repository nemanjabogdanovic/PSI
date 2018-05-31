<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Koordinator extends CI_Controller{
		
		public function unosPredmeta(){
			$data['title'] = 'Unos';
			die('asdasd');
			$this->form_validation->set_rules('ime', 'Ime predmeta', 'required');
			$this->form_validation->set_rules('nastavnik', 'Nastavnik', 'required');
			$this->form_validation->set_rules('skolskaGodina', 'Skolska godina', 'required');
			$this->form_validation->set_rules('kabineti', 'Kabinet', 'required');
			
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/unosPredmeta', $data);
				$this->load->view('templates/footer');
			}
			else{
				
				$this->koordinator_model->unosPredmeta();
				
				
				redirect('koordinator/home');
			}
		}
		
		public function view($page = 'home'){
			if(!file_exists(APPPATH.'views/koordinator/'.$page.'.php')){
				show_404();
			}
			
			if(!$this->session->userdata('user_level') === 'koordinator'){
				redirect('koordinator/home');
			}
			
			$data['title'] = ucfirst($page);
			
			$this->load->view('templates/header');
			$this->load->view('koordinator/'.$page, $data);
			$this->load->view('templates/footer');
		}
	}