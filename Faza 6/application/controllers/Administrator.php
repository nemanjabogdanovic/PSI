<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Administrator extends CI_Controller{
		//pocetna strana
		public function index(){
			$data['title'] = 'Početna - Vesti';
			
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
		//pregled skoli
		public function skole(){
			$data['title'] = 'Škole';
			
			$this->load->view('templates/header');
			$this->load->view('administrator/skole', $data);
			$this->load->view('templates/footer');
		}
		//unos nove skole
		public function unosSkole(){
			$data['title'] = 'Unos nove škole';
			
			$this->form_validation->set_rules('ime', 'Ime', 'required');
			$this->form_validation->set_rules('adresa', 'Adresa', 'required');
			$this->form_validation->set_rules('grad', 'Grad', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('administrator/unosSkole', $data);
				$this->load->view('templates/footer');
			}
			else{
				$this->Administrator_model->novaSkola();
				
				$this->session->set_flashdata('skola_uspesno_dodata', 'Uspešno dodata škola!');
				
				redirect('administrator');
			}
		}
		public function uredjivanje(){
			$data['title'] = 'Uređivanje naloga';
			
			$this->load->view('templates/header');
			$this->load->view('administrator/uredjivanje', $data);
			$this->load->view('templates/footer');
		}
		public function noviKoordinator(){
			$data['title'] = 'Dodaj novog koordinatora';
			
			$this->form_validation->set_rules('name', 'Ime', 'required');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('username', 'KorisnickoIme', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Lozinka', 'required');
			
			$data['skole'] = $this->Administrator_model->getSkole();
			
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('administrator/noviKoordinator', $data);
				$this->load->view('templates/footer');
			}
			else{
				$enc_password = md5($this->input->post('password'));
				$this->Administrator_model->dodajKoordinatora($enc_password);
				
				$this->session->set_flashdata('user_registered', 'Uspešno unet nalog');
				
				redirect('administrator/uredjivanje');
			}
		}
		//provera da li je korisnicko ime u upotrebi pri registraciji korisnika
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'Korisničko ime je zauzeto');
			if($this->user_model->check_username_exists($username)){
				return true;
			}
			else {
				return false;
			}
		}
		//provera da li je email u upotrebi pri registraciji korisnika
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'Email je u upotrebi');
			if($this->user_model->check_email_exists($email)){
				return true;
			}
			else {
				return false;
			}
		}
	}