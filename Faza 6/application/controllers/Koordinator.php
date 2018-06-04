<!--
	autor: Nemanja Bogdanovic, 2012/0533
		   Markovic Milos, 0096/2012
	@version: 1.0
-->
<?php
	class Koordinator extends CI_Controller{
		
		

		public function predmeti() {
			$this->load->model('Koordinator_model');
			
			$data["fetch_data"] = $this->Koordinator_model->listOfStudents();
			
			$data['nastavnici'] = $this->Koordinator_model->getNastavnikeForPredmet();
			
			$data['users'] = $this->Koordinator_model->getUsers();
			$data['skole'] = $this->Koordinator_model->getSkole();
			$this->load->view('templates/header');
			$this->load->view('koordinator/predmeti', $data);
			$this->load->view('templates/footer');
		}
		
		


		
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
		
		
		
		public function raspored(){
			
			$data['title'] = 'Raspored';
			
			$this->load->model('Koordinator_model');			
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/raspored', $data);
				$this->load->view('templates/footer');
			}
			else{				
				$this->Koordinator_model->raspored();	
				
				redirect('koordinator/index');
				
			}
		}
		
		public function prikazRasporeda(){
			$data['title'] = 'Prikaz rasporeda';
			
			$this->load->model('Koordinator_model');
			
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();
			
			$odeljenje = $this->input->post('odeljenje');

			
	//		if($this->form_validation->run() === FALSE){
	//			$this->load->view('templates/header');
	//			$this->load->view('koordinator/prikazRasporeda', $data);
	//			$this->load->view('templates/footer');
				
	//		}
	//		else{
				
	//			die('test');
				$this->prikazRasporedaO();
				
				
	//			redirect('koordinator/index');
	//		}
		}
		
		public function prikazRasporedaO(){
			$data['title'] = 'Prikaz rasporeda';
			
			$this->load->model('Koordinator_model');
			$data["fetch_data_o"] = $this->Koordinator_model->getOdeljenje();
			
			$data['rasporedi'] = $this->Koordinator_model->getRasporede();
		
			$odeljenje = $this->input->post('odeljenje');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/prikazRasporedaO', $data);
				$this->load->view('templates/footer');
			}
			else{
				
				
				$this->Koordinator_model->raspored();
				
				
				redirect('koordinator/index');
			}
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

		//dodavanje novog nastavnika
		public function noviNalog(){
			
			$data['title'] = 'Novi nastavnik';
			$this->load->model('Koordinator_model');
			$this->form_validation->set_rules('name', 'Ime', 'required');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('username', 'KorisnickoIme', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Lozinka', 'required');
			
			$data['skole'] = $this->Koordinator_model->getSkole();
			
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/noviNalog', $data);
				$this->load->view('templates/footer');
			}
			else{
				$enc_password = md5($this->input->post('password'));
				$this->Koordinator_model->dodajNastavnika($enc_password);
				
				$this->session->set_flashdata('user_registered', 'Uspešno unet nalog');
				
				redirect('koordinator/index');
			}
		}
		
		//Izmena nastavnika
		public function izmenaNaloga(){
			
			$data['title'] = 'Izmena naloga nastavnika';
			$this->load->model('Koordinator_model');
			
			$this->form_validation->set_rules('name', 'Ime', 'required');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike();
			$data['users'] = $this->Koordinator_model->getUsers();
			
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/izmenaNaloga', $data);
				$this->load->view('templates/footer');
			}
			else{
				$nastavnik = $this->input->post('nastavnik');
				
				$this->Koordinator_model->izmenaNaloga($nastavnik);
				
				$this->session->set_flashdata('user_registered', 'Uspešno izmenjen nalog');
				
				redirect('koordinator/index');
			}
		}
		//Izmena nastavnika
		public function izmenaNalogaU(){
			
			$data['title'] = 'Izmena naloga ucenika ';
			$this->load->model('Koordinator_model');
			
			$this->form_validation->set_rules('name', 'Ime');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			
			$data['ucenici'] = $this->Koordinator_model->getUcenike();
			$data['users'] = $this->Koordinator_model->getUsers();
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/izmenaNalogaU', $data);
				$this->load->view('templates/footer');
			}
			else{
				$ucenik = $this->input->post('ucenik');
				$odeljenje = $this->input->post('odeljenje');
				$this->Koordinator_model->izmenaNalogaU($ucenik,$odeljenje);
				
				$this->session->set_flashdata('user_registered', 'Uspešno izmenjen nalog');
				
				redirect('koordinator/index');
			}
		}
		
		//dodavanje novog nastavnika
		public function noviNalogU(){
			
			$data['title'] = 'Novi ucenik';
			$this->load->model('Koordinator_model');
			$this->form_validation->set_rules('name', 'Ime', 'required');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('username', 'KorisnickoIme', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Lozinka', 'required');
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();				
			$data['skole'] = $this->Koordinator_model->getSkole();
			
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/noviNalogU', $data);
				$this->load->view('templates/footer');
			}
			else{
				$enc_password = md5($this->input->post('password'));
				$this->Koordinator_model->dodajUcenika($enc_password);
				
				$this->session->set_flashdata('user_registered', 'Uspešno unet nalog');
				
				redirect('koordinator/index');
			}
		}
		

		

		
		
		public function brisanjeCasova(){
			$this->load->model('Koordinator_model');
			$data['title'] = 'Brisanje Casova';
			
			$this->form_validation->set_rules('dan', 'Dan', 'required');
			$this->form_validation->set_rules('cas', 'Cas', 'required');
			
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/brisanjeCasova', $data);
				$this->load->view('templates/footer');
			}
			else{
				$odeljenje = $this->input->post('odeljenje');
				$dan = $this->input->post('dan');
				$cas = $this->input->post('cas');
	//			$skolaid = $this->input->post('skolaid');
				if($this->Koordinator_model->brisanjeCasova($odeljenje,$dan,$cas)){
					
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
			$data['users'] = $this->Koordinator_model->getUsers();
			
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
	
		public function unosCasova() {			
			$data['title'] = 'Unos Casova';			
			$this->load->model('Koordinator_model');
			
			$this->form_validation->set_rules('dan', 'Dan', 'required');
			$this->form_validation->set_rules('brojCasa', 'Broj Casa', 'required');
			$this->form_validation->set_rules('kabinet', 'Kabinet', 'required');
			
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();				
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike();		
			$data['predmeti'] = $this->Koordinator_model->getPredmete();
			$data['users'] = $this->Koordinator_model->getUsers();
			
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
		
		public function izmenaPredmeta(){
			$this->load->model('Koordinator_model');
			$data['title'] = 'Izmena predmeta';
			$this->form_validation->set_rules('ime', 'Ime predmeta', 'required');
			$this->form_validation->set_rules('skolskaGodina', 'Skolska godina', 'required');
			$this->form_validation->set_rules('kabineti', 'Kabinet', 'required');
			
			$data['predmeti'] = $this->Koordinator_model->getPredmete();
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike();
			$data['users'] = $this->Koordinator_model->getUsers();
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/izmenaPredmeta', $data);
				$this->load->view('templates/footer');
			}
			else{
				$predmet = $this->input->post('predmet');
		//		$nastavnik = $this->input->post('nastavnik');
				$this->Koordinator_model->izmenaPredmeta($predmet);
					
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
		
		//brisanje predmeta
		public function brisanjePredmeta(){
			$this->load->model('Koordinator_model');
			$data['title'] = 'Brisanje predmeta';		
			
			$data['predmeti'] = $this->Koordinator_model->getPredmete();
			$data['skole'] = $this->Koordinator_model->getSkole();

			$this->load->view('templates/header');
		    $this->load->view('koordinator/brisanjePredmeta', $data);
			$this->load->view('templates/footer');

			$ime = $this->input->post('ime');
			$skolaid = $this->input->post('skolaid');

			if($this->Koordinator_model->brisanjePredmeta($ime,$skolaid)){					
				redirect('koordinator/index');
			}
		}		
		
		public function brisanjeNaloga(){
			$this->load->model('Koordinator_model');			
			$data['title'] = 'Brisanje Naloga';		
						
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike();
			$data['users'] = $this->Koordinator_model->getUsers();
	
			$this->load->view('templates/header');
			$this->load->view('koordinator/brisanjeNaloga', $data);
			$this->load->view('templates/footer');				
				
			$nastavnik = $this->input->post('nastavnik');
		//	die($nastavnik);
			if($this->Koordinator_model->brisanjeNaloga($nastavnik)){
			
				redirect('koordinator/index');
			}
		}
			
		public function brisanjeNalogaU(){
			$this->load->model('Koordinator_model');			
			$data['title'] = 'Brisanje Naloga učenika';		
						
			$data['ucenici'] = $this->Koordinator_model->getUcenike();
			$data['users'] = $this->Koordinator_model->getUsers();
	
			$this->load->view('templates/header');
			$this->load->view('koordinator/brisanjeNalogaU', $data);
			$this->load->view('templates/footer');				
				
			$ucenik = $this->input->post('ucenik');
		//	die($nastavnik);
			if($this->Koordinator_model->brisanjeNalogaU($ucenik)){
			
				redirect('koordinator/index');
			}
					
			
				

				
				

		}		
	}