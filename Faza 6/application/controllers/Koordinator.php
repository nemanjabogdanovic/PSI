<!--
	autori: Markovic Milos, 0096/2012
			Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Koordinator extends CI_Controller{
		//pocetna strana
		public function index(){
			$data['title'] = 'Početna - Vesti';
			$data['vesti'] = $this->Koordinator_model->getVestiAdmin();
			$data['vestiSkola'] = $this->Koordinator_model->getVesti($this->Koordinator_model->getSkolaId($this->session->userdata('user_id')));
			
			
			$this->load->view('templates/header');
			$this->load->view('koordinator/index', $data);
			$this->load->view('templates/footer');
		}
		//dodaj novu vest
		public function novaVest(){
			$data['title'] = 'Nova Vest';
			
			
			$this->form_validation->set_rules('naslov', 'Naslov', 'required');
			$this->form_validation->set_rules('text', 'Tekst', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/novaVest', $data);
				$this->load->view('templates/footer');
			}
			else{
				$this->Koordinator_model->novaVest($this->Koordinator_model->getSkolaId($this->session->userdata('user_id')));
				
				$this->session->set_flashdata('vest_uspesno_dodata', 'Uspešno dodata vest!');
				
				redirect('koordinator');
			}
		}
		//izbrisi sve vesti napravljene od strane koordinatora
		public function izbrisiVesti(){
			$this->Koordinator_model->deleteVesti($this->Koordinator_model->getSkolaId($this->session->userdata('user_id')));
			$this->session->set_flashdata('vesti_izbrisane', 'Uspešno izbrisane vesti od: '.ucfirst($this->session->userdata('user_level')));
			redirect('koordinator');
		}
		
		

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
			
			$this->load->model('Koordinator_model');
			
			$this->form_validation->set_rules('dan', 'Dan', 'required');
			$this->form_validation->set_rules('brojCasa', 'Broj Casa', 'required');
			$this->form_validation->set_rules('kabinet', 'Kabinet', 'required');
			
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();				
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike();		
			$data['predmeti'] = $this->Koordinator_model->getPredmete();
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/unosCasova', $data);
				$this->load->view('templates/footer');
			}
			else{
				
				
				$this->Koordinator_model->unosCasova();
				
				
				redirect('koordinator/index');
			}
			
		}
		
		public function noviNalog(){
			$data['title'] = 'Novi nalog';
			$this->load->view('templates/header');
			$this->load->view('koordinator/noviNalog', $data);
			$this->load->view('templates/footer');
		}
		
		
		
		public function raspored(){
			
			$data['title'] = 'Raspored';
			
			$this->load->model('Koordinator_model');
			
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();
			
			
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/Raspored', $data);
				$this->load->view('templates/footer');
			}
			else{
				
				
				$this->Koordinator_model->raspored();
				
				
				redirect('koordinator/index');
			}
		}
		
		public function prikazRasporeda(){
			$data['title'] = 'Prikaz rasporeda';
			$this->load->view('templates/header');
			$this->load->view('koordinator/prikazRasporeda', $data);
			$this->load->view('templates/footer');
		}
		
		//uredjivanje naloga
		public function uredjivanje(){
			$data['title'] = 'Uređivanje naloga';
			$this->load->model('Koordinator_model');
			$data['nastavnici'] = $this->Koordinator_model->getNastavnikIds();
			$data['skole'] = $this->Koordinator_model->getSkole();
			$data['users'] = $this->Koordinator_model->getUsers();
			
			
		//	if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/uredjivanje', $data);
				$this->load->view('templates/footer');
		//	}
		//	else{
		//		$this->izmenaKoordinatora($this->input->post('koord_lista'));
		//	}
			
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
		
		
		public function brisanjeCasova(){
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