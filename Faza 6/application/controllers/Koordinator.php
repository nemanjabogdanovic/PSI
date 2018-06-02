<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Koordinator extends CI_Controller{
		
		

		public function predmeti() {
			$this->load->model('Koordinator_model');
			$data["fetch_data"] = $this->Koordinator_model->listOfStudents();
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike();
			$data['skole'] = $this->Koordinator_model->getSkole();
			$this->load->view('templates/header');
			$this->load->view('koordinator/predmeti', $data);
			$this->load->view('templates/footer');
		}
		
		

		public function unosCasova() {
			
			$data['title'] = 'Unos';
			$this->form_validation->set_rules('odeljenje', 'Odeljenje', 'required');
			$this->form_validation->set_rules('dan', 'Dan', 'required');
			$this->form_validation->set_rules('brojCasa', 'Broj Casa', 'required');
			$this->form_validation->set_rules('nastavnik', 'Nastavnik', 'required');
			$this->form_validation->set_rules('kabinet', 'Kabinet', 'required');
			$this->form_validation->set_rules('predmet', 'Predmet', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/unosCasova', $data);
				$this->load->view('templates/footer');
			}
			else{
				$this->load->model('Koordinator_model');
				$this->Koordinator_model->unosCasova();
				
				
				redirect('koordinator/index');
			}
			
		}
		
		public function index(){
			$data['title'] = 'Pocetna';
			$this->load->view('templates/header');
			$this->load->view('koordinator/index', $data);
			$this->load->view('templates/footer');
		}
		
		public function noviNalog(){
			$data['title'] = 'Novi nalog';
			$this->load->view('templates/header');
			$this->load->view('koordinator/noviNalog', $data);
			$this->load->view('templates/footer');
		}
		
		
		
		public function raspored(){
			$data['title'] = 'raspored';
			$this->load->view('templates/header');
			$this->load->view('koordinator/raspored', $data);
			$this->load->view('templates/footer');
		}
		
	//	public function unosCasova(){
	//		$data['title'] = 'Unos časova';
	//		$this->load->view('templates/header');
	//		$this->load->view('koordinator/unosCasova', $data);
	//		$this->load->view('templates/footer');
	//	}
		
		public function uredjivanje(){
			$data['title'] = 'uredjivanje';
			$this->load->view('templates/header');
			$this->load->view('koordinator/uredjivanje', $data);
			$this->load->view('templates/footer');
		}
		
		public function izmenaPredmeta(){
			$this->load->model('Koordinator_model');
			$data['title'] = 'Izmena predmeta';
			$this->form_validation->set_rules('ime', 'Ime predmeta', 'required');
			$this->form_validation->set_rules('skolskaGodina', 'Skolska godina', 'required');
			$this->form_validation->set_rules('kabineti', 'Kabinet', 'required');
			$data['predmeti'] = $this->Koordinator_model->getPredmete();
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike();
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/izmenaPredmeta', $data);
				$this->load->view('templates/footer');
			}
			else{
				$predmet = $this->input->post('predmet');
				$this->Koordinator_model->izmenaPredmeta($predmet);
					
				redirect('koordinator/index');
			
			}	
		}
		
				//brisanje predmeta
		public function brisanjePredmeta(){
			$this->load->model('Koordinator_model');
			$data['title'] = 'Brisanje predmeta';
			
			$this->form_validation->set_rules('ime', 'ime', 'required');
			
			$data['skole'] = $this->Koordinator_model->getSkole();
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/brisanjePredmeta', $data);
				$this->load->view('templates/footer');
			}
			else{
				$ime = $this->input->post('ime');
				$skolaid = $this->input->post('skolaid');
				if($this->Koordinator_model->brisanjePredmeta($ime,$skolaid)){
					
					redirect('koordinator/index');
				}
				else{
					
					redirect('koordinator/index');
				}
			}
		}
		
		
		
		public function unosPredmeta(){
			$this->load->model('Koordinator_model');
			
			$data['title'] = 'Unos predmeta';
			
			$this->form_validation->set_rules('ime', 'Ime predmeta', 'required');
			$this->form_validation->set_rules('skolskaGodina', 'Skolska godina', 'required');
			$this->form_validation->set_rules('kabineti', 'Kabinet', 'required');
			
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike();
			$data['skole'] = $this->Koordinator_model->getSkole();
			
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/unosPredmeta', $data);
				$this->load->view('templates/footer');
			}
			else{
				
				$this->Koordinator_model->unosPredmeta();
				
				
				redirect('koordinator/index');
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