<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Administrator extends CI_Controller{
		//pocetna strana
		public function index(){
			$data['title'] = 'Pocetna';
			
			$data['vesti'] = $this->Administrator_model->getVesti();
			
			$this->load->view('templates/header');
			$this->load->view('administrator/index', $data);
			$this->load->view('templates/footer');
		}
		//dodaj novu vest
		public function novaVest(){
			$data['title'] = 'Nova Vest';
			
			
			$this->form_validation->set_rules('naslov', 'Naslov', 'required');
			$this->form_validation->set_rules('text', 'Tekst', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('administrator/novaVest', $data);
				$this->load->view('templates/footer');
			}
			else{
				$this->Administrator_model->novaVest();
				
				$this->session->set_flashdata('vest_uspesno_dodata', 'Uspešno dodata vest!');
				
				redirect('administrator');
			}
		}
		//izbrisi sve vesti napravljene od strane administratora
		public function izbrisiVesti(){
			$this->Administrator_model->deleteVesti();
			$this->session->set_flashdata('vesti_izbrisane', 'Uspešno izbrisane vesti od: '.ucfirst($this->session->userdata('user_level')));
			redirect('administrator');
		}
		
		
		public function skole(){
			$data['title'] = 'Pocetna';
			
			$this->load->view('templates/header');
			$this->load->view('administrator/skole', $data);
			$this->load->view('templates/footer');
		}
		public function uredjivanje(){
			$data['title'] = 'Pocetna';
			
			$this->load->view('templates/header');
			$this->load->view('administrator/uredjivanje', $data);
			$this->load->view('templates/footer');
		}
	}