<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Administrator extends CI_Controller{
		//pocetna strana
		public function index(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			$data['title'] = 'Početna - Vesti';
			$data['vesti'] = $this->Administrator_model->getVesti();

			$this->load->view('templates/header');
			$this->load->view('administrator/index', $data);
			$this->load->view('templates/footer');
		}
		//dodaj novu vest
		public function novaVest(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
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
		//pregled skoli
		public function skole(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			$data['title'] = 'Škole';
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
		//unos nove skole
		public function unosSkole(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
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
		//izmena skole
		public function izmenaSkole($skola = null){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			$data['title'] = 'Izmena škole';
			if($skola !== null){
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
		//uredjivanje naloga
		public function uredjivanje(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			$data['title'] = 'Uređivanje naloga';
			$data['koordinatori'] = $this->Administrator_model->getKoordinatorIds();
			$data['skole'] = $this->Administrator_model->getSkole();
			$data['users'] = $this->Administrator_model->getUsers();
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
		//dodavanje novog koordinatora
		public function noviKoordinator(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
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
		//izmena Koordinatora
		public function izmenaKoordinatora(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'administrator'){
				redirect($this->session->userdata['user_level']);
			}
			$data['title'] = 'Izmena koordinatora';
			global $koordinator_id;
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