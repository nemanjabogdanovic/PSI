<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	/**
	*	Administrator - klasa za funkcionalnosti korisnika Administrator
	*
	*	@version 1.0
	*/
	class Administrator extends CI_Controller{
		/**
		*	Pocetna strana sa najnovijim vestima
		*/
		public function index(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Početna - Vesti';
			/**
			*	@var array $data['vesti'] - prosledjivanje vesti
			*/
			$data['vesti'] = $this->Administrator_model->getVesti();

			$this->load->view('templates/header');
			$this->load->view('administrator/index', $data);
			$this->load->view('templates/footer');
		}
		/**
		*	Dodavanje nove vesti od strane Administratora
		*/
		public function novaVest(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
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
		/**
		*	Brisanje svih vesti napravljene od strane Administratora - u bazi se cuvaju samo azurne vesti
		*/
		public function izbrisiVesti(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			$this->Administrator_model->deleteVesti();
			$this->session->set_flashdata('vesti_izbrisane', 'Uspešno izbrisane vesti od: '.ucfirst($this->session->userdata('user_level')));
			redirect('administrator');
		}
		/**
		*	Funkcija za pregled svih skola u sistemu
		*/
		public function skole(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Škole';
			/**
			*	@var array $data['skole'] - prosledjivanje podataka skola
			*/
			$data['skole'] = $this->Administrator_model->getSkole();
			
			$this->form_validation->set_rules('skola', 'Skola', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('administrator/skole', $data);
				$this->load->view('templates/footer');
			}
			else{
				$this->izmenaSkole($this->input->post('skola'));
			}
		}
		/**
		*	Funkcija za unos nove skole od strane Administratora
		*/
		public function unosSkole(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
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
				
				redirect('administrator/skole');
			}
		}
		/**
		*	Funkcija izmene podataka odabrane skole
		*
		*	$param int $skola - id skole za koju je potrebno promeniti podatke
		*/
		public function izmenaSkole($skola = null){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Izmena škole';
			
			if($skola !== null){
				/**
				*	@var string $data['skola'] - prosledjivanje podataka odabrane skole
				*/
				$data['skola'] = $this->Administrator_model->getSkolaPrekoId($skola);
			}
			$this->form_validation->set_rules('ime', 'Ime', 'required');
			$this->form_validation->set_rules('adresa', 'Adresa', 'required');
			$this->form_validation->set_rules('grad', 'Grad', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('administrator/izmenaSkole', $data);
				$this->load->view('templates/footer');
				
			}
			else{
				$this->Administrator_model->updateSkolu();
				$this->session->set_flashdata('skola_uspesno_izmenjena', 'Škola uspešno izmenjena!');
				redirect('administrator/skole');
			}
		}
		/**
		*	Funckija za pregled svih koordinatorskih naloga na sistemu
		*/
		public function uredjivanje(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Uređivanje naloga';
			/**
			*	@var array $data['koordinatori'] - prosledjivanje id koordinatora
			*/
			$data['koordinatori'] = $this->Administrator_model->getKoordinatorIds();
			/**
			*	@var array $data['skole'] - prosledjivanje skola
			*/
			$data['skole'] = $this->Administrator_model->getSkole();
			/**
			*	@var array $data['title'] - prosledjivanje korisnickih podataka
			*/
			$data['users'] = $this->Administrator_model->getUsers();
			/**
			*	@var global int $koordinator_id - id koordinatora za kog treba izmeniti podatke
			*/
			global $koordinator_id;
			
			$this->form_validation->set_rules('koord_lista', 'Koord_lista', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('administrator/uredjivanje', $data);
				$this->load->view('templates/footer');
			}
			else{
				$koordinator_id = $this->input->post('koord_lista');
				$this->izmenaKoordinatora();
			}
		}
		/**
		*	Funkcija za dodavanje novih korisnika (Koordinatora) od strane Administratora
		*/
		public function noviKoordinator(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Dodaj novog koordinatora';
			
			$this->form_validation->set_rules('name', 'Ime', 'required');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('username', 'KorisnickoIme', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Lozinka', 'required');
			/**
			*	@var array $data['skole'] - prosledjivanje podatka skola
			*/
			$data['skole'] = $this->Administrator_model->getSkole();
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('administrator/noviKoordinator', $data);
				$this->load->view('templates/footer');
			}
			else{
				/**
				*	@var string $enc_password - md5 enkripcija unete lozinke
				*/
				$enc_password = md5($this->input->post('password'));
				$this->Administrator_model->dodajKoordinatora($enc_password);
				
				$this->session->set_flashdata('user_registered', 'Uspešno unet nalog');
				
				redirect('administrator/uredjivanje');
			}
		}
		/**
		*	Funkcija izmene podataka odabranog koordinatora
		*/
		public function izmenaKoordinatora(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Izmena koordinatora';
			/**
			*	@var global int $koordinator_id - id koordinatora za kog treba izmeniti podatke
			*/
			global $koordinator_id;
			/**
			*	@var array $data['koordinator'] - prosledjivanje podataka odabranog koordinatora
			*/
			$data['koordinator'] = $this->Administrator_model->getKoordinatoraPrekoId($koordinator_id);
			
			$this->form_validation->set_rules('name', 'Ime', 'required');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('username', 'KorisnickoIme', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('administrator/izmenaKoordinatora', $data);
				$this->load->view('templates/footer');
			}
			else{
				$this->Administrator_model->updateKoordinatora();
				$this->session->set_flashdata('koordinator_uspesno_izmenjen', 'Koordinator uspešno izmenjen!');
				redirect('administrator/uredjivanje');
			}
		}
		/**
		*	Provera da li je korisnicko ime u upotrebi pri registraciji korisnika
		*
		*	@param string $username - korisnicko ime koje treba proveriti
		*
		*	@return boolean
		*/
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'Korisničko ime je zauzeto');
			if($this->user_model->check_username_exists($username)){
				return true;
			}
			else {
				return false;
			}
		}
		/**
		*	Provera da li je email u upotrebi pri registraciji korisnika
		*
		*	@param string $email - email adresa koju treba proveriti
		*
		*	@return boolean
		*/
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