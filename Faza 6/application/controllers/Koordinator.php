<!--
	autor: Nemanja Bogdanovic, 2012/0533
		   Markovic Milos, 0096/2012
		   
	Koordinator kontroler – kontroler klasa u kojoj se nalaze sve funkcije koje koristi koordinator
	
	@version: 1.16
-->
<?php
	class Koordinator extends CI_Controller{
		
		//pocetna strana
		public function index(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Početna - Vesti';
			/**
			* @var array $data['vesti'] - prosledjivanje vesti
			*/
			$data['vesti'] = $this->Koordinator_model->getVestiAdmin();
			/**
			* @var array $data['vestiSkola'] - prosledjivanje vesti za skolu trenutnog koordinatora
			*/			
			$data['vestiSkola'] = $this->Koordinator_model->getVesti($this->Koordinator_model->getSkolaId($this->session->userdata('user_id')));
			
			
			$this->load->view('templates/header');
			$this->load->view('koordinator/index', $data);
			$this->load->view('templates/footer');
		}

		
		//Strana predmeti
		public function predmeti() {
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			/**
			*	Ucitavanje modela
			*/
			$this->load->model('Koordinator_model');
			/**
			*	@var array $data["fetch_data"] - Dohvata predmete za skolu kojoj je dodeljen koordinator
			*/
			$data["fetch_data"] = $this->Koordinator_model->listOfStudents($skola);
			/**
			*	@var array $data['nastavnici'] - Dohvata sve korisnike
			*/			
			$data['nastavnici'] = $this->Koordinator_model->getNastavnikeForPredmet();
			/**
			*	@var array $data['users']- Dohvata sve korisnike
			*/			
			$data['users'] = $this->Koordinator_model->getUsers();
			/**
			*	@var array $data['skole'] - Dohvata sve skole
			*/			
			$data['skole'] = $this->Koordinator_model->getSkole();
			
			$this->load->view('templates/header');
			$this->load->view('koordinator/predmeti', $data);
			$this->load->view('templates/footer');
		}
		
		
		//Unos predmeta
		public function unosPredmeta(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	Ucitavanje modela
			*/
			$this->load->model('Koordinator_model');
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Unos predmeta';
			
			$this->form_validation->set_rules('ime', 'Ime predmeta', 'required');
			$this->form_validation->set_rules('skolskaGodina', 'Skolska godina', 'required');
			$this->form_validation->set_rules('kabineti', 'Kabinet', 'required');
			/**
			*	@var array $data['nastavnici'] - Dohvata sve nastavnike za zadatu skolu
			*/						
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike($skola);
			/**
			*	@var array $data['skole'] - Dohvata sve skole
			*/			
			$data['skole'] = $this->Koordinator_model->getSkole();
			/**
			*	@var array $data['users']- Dohvata sve korisnike
			*/			
			$data['users'] = $this->Koordinator_model->getUsers();
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/			
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/unosPredmeta', $data);
				$this->load->view('templates/footer');
			}
			else{
				//Unos predmeta za skolu kojoj je dodeljen koordinator
				$this->Koordinator_model->unosPredmeta($skola);
				$this->session->set_flashdata('unet_predmet', 'Uspešno unet predmet');
				redirect('koordinator/predmeti');
			}
		}		


		//Brisanje predmeta
		public function brisanjePredmeta(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			/**
			*	Ucitavanje modela
			*/			
			$this->load->model('Koordinator_model');
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Brisanje predmeta';		
			/**
			*	@var string $data['predmeti'] - dohvata predmete za zadatu skolu
			*/			
			$data['predmeti'] = $this->Koordinator_model->getPredmete($skola);
			/**
			*	@var array $data['skole'] - Dohvata sve skole
			*/	
			$data['skole'] = $this->Koordinator_model->getSkole();


			/**
			*	@var string $ime - dohvata uneseno
			*/
			$ime = $this->input->post('ime');
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			$this->form_validation->set_rules('ime', 'Ime predmeta', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/brisanjePredmeta', $data);
				$this->load->view('templates/footer');
			}
			else{
			//Brisanje izabranog predmeta za skolu kojoj je dodeljen koordinator	
			$this->Koordinator_model->brisanjePredmeta($ime,$skola);		
				$this->session->set_flashdata('izbrisan_predmet', 'Uspešno izbrisan predmet');
				redirect('koordinator/predmeti');
			
			}
		}			

		//Izmena predmeta
		public function izmenaPredmeta(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			/**
			*	Ucitavanje modela
			*/
			$this->load->model('Koordinator_model');
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Izmena predmeta';
			$this->form_validation->set_rules('ime', 'Ime predmeta', 'required');
			$this->form_validation->set_rules('skolskaGodina', 'Skolska godina', 'required');
			$this->form_validation->set_rules('kabineti', 'Kabinet', 'required');
			/**
			*	@var string $data['predmeti'] - dohvata predmete za zadatu skolu
			*/				
			$data['predmeti'] = $this->Koordinator_model->getPredmete($skola);
			/**
			*	@var array $data['nastavnici'] - Dohvata sve nastavnike za zadatu skolu
			*/
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike($skola);
			/**
			*	@var array $data['users']- Dohvata sve korisnike
			*/
			$data['users'] = $this->Koordinator_model->getUsers();
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/izmenaPredmeta', $data);
				$this->load->view('templates/footer');
			}
			else{
				/**
				*	@var array $predmet- Dohvata sve izabrani predmet
				*/
				$predmet = $this->input->post('predmet');
				//Izmena izabranog predmeta
				$this->Koordinator_model->izmenaPredmeta($predmet);
				$this->session->set_flashdata('izmenjen_predmet', 'Uspešno izmenjen predmet');
				redirect('koordinator/predmeti');
			
			}	
		}

		//Strana raspored
		public function raspored(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/			
			$data['title'] = 'Raspored';
			/**
			*	Ucitavanje modela
			*/			
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

		//Prikaz rasporeda za izabrano odeljenje @Aleksandar Milic
		public function prikazRasporedaO(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Prikaz rasporeda';
			/**
			*	Ucitavanje modela
			*/			
			$this->load->model('Koordinator_model');
			
			$this->load->helper('form');
			$this->load->library('table');
			/**
			*	@var array $data['odeljenja'] - Dohvata sva odeljenja
			*/				
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();
			/**
			*	@var array $odeljenje- Izabrano odeljenje
			*/			
			$odeljenje = $this->input->post('odeljenje');
			
			$raspored = $this->Koordinator_model->dohvati_raspored($odeljenje);
			$user_id = $this->session->userdata('user_id');
			$koordinator = $this->Koordinator_model->dohvati_ime_i_prezime($user_id);
			$data['ime'] = $koordinator->name;
			$data['prezime'] = $koordinator->surname;
			$data['odeljenje'] = $this->Koordinator_model->dohvati_oznaku_odeljenja($odeljenje);
			$data['ponedeljak'] = array(
				1 => '',
				2 => '',
				3 => '',
				4 => '',
				5 => '',
				6 => '',
				7 => '',
				8 => '',
				9 => '',
				10 => '',
				11 => ''
			);
			$data['utorak'] = array(
				1 => '',
				2 => '',
				3 => '',
				4 => '',
				5 => '',
				6 => '',
				7 => '',
				8 => '',
				9 => '',
				10 => '',
				11 => ''
			);
			$data['sreda'] = array(
				1 => '',
				2 => '',
				3 => '',
				4 => '',
				5 => '',
				6 => '',
				7 => '',
				8 => '',
				9 => '',
				10 => '',
				11 => ''
			);
			$data['cetvrtak'] = array(
				1 => '',
				2 => '',
				3 => '',
				4 => '',
				5 => '',
				6 => '',
				7 => '',
				8 => '',
				9 => '',
				10 => '',
				11 => ''
			);
			$data['petak'] = array(
				1 => '',
				2 => '',
				3 => '',
				4 => '',
				5 => '',
				6 => '',
				7 => '',
				8 => '',
				9 => '',
				10 => '',
				11 => ''
			);
			foreach($raspored as $ras){
				if($ras->dan == 'ponedeljak') $data['ponedeljak'][$ras->brojCasa] = 'Cas: ' . $this->Koordinator_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet;
				if($ras->dan == 'utorak') $data['utorak'][$ras->brojCasa] = 'Cas: ' . $this->Koordinator_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet;
				if($ras->dan == 'sreda') $data['sreda'][$ras->brojCasa] = 'Cas: ' . $this->Koordinator_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet;
				if($ras->dan == 'cetvrtak') $data['cetvrtak'][$ras->brojCasa] = 'Cas: ' . $this->Koordinator_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet;
				if($ras->dan == 'petak') $data['petak'][$ras->brojCasa] = 'Cas: ' . $this->Koordinator_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet;
				
				
			}		
			$this->load->view('templates/header');
			$this->load->view('koordinator/prikazRasporedaO', $data);
			$this->load->view('templates/footer');
		}

		
		//Unos casova
		public function unosCasova() {			
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Unos Casova';		
			/**
			*	Ucitavanje modela
			*/			
			$this->load->model('Koordinator_model');
			
			$this->form_validation->set_rules('dan', 'Dan', 'required');
			$this->form_validation->set_rules('brojCasa', 'Broj Casa', 'required');
			$this->form_validation->set_rules('kabinet', 'Kabinet', 'required');
			/**
			*	@var array $data['odeljenja'] - Dohvata sva odeljenja
			*/				
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();	
			/**
			*	@var array $data['nastavnici'] - Dohvata sve nastavnike za zadatu skolu
			*/			
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike($skola);	
			/**
			*	@var string $data['predmeti'] - dohvata predmete za zadatu skolu
			*/				
			$data['predmeti'] = $this->Koordinator_model->getPredmete($skola);
			/**
			*	@var array $data['users']- Dohvata sve korisnike
			*/
			$data['users'] = $this->Koordinator_model->getUsers();
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/unosCasova', $data);
				$this->load->view('templates/footer');
			}
			else{
				
				//Unos casova
				$this->Koordinator_model->unosCasova();
				$this->session->set_flashdata('unet_cas', 'Uspešno unet čas');
				redirect('koordinator/raspored');
			}
			
		}

		//Brisanje casova
		public function brisanjeCasova(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	Ucitavanje modela
			*/
			$this->load->model('Koordinator_model');
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Brisanje Casova';
			
			$this->form_validation->set_rules('dan', 'Dan', 'required');
			$this->form_validation->set_rules('cas', 'Cas', 'required');
			/**
			*	@var array $data['odeljenja'] - Dohvata sva odeljenja
			*/				
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/brisanjeCasova', $data);
				$this->load->view('templates/footer');
			}
			else{
				/**
				*	@var array $odeljenje- Izabrano odeljenje
				*/	
				$odeljenje = $this->input->post('odeljenje');
				/**
				*	@var string $dan- Unet dan
				*/	
				$dan = $this->input->post('dan');
				/**
				*	@var int $cas- Unet cas
				*/	
				$cas = $this->input->post('cas');
				//Brisanje casova
				if($this->Koordinator_model->brisanjeCasova($odeljenje,$dan,$cas)){
					$this->session->set_flashdata('izmenjen_predmet', 'Uspešno obrisan čas');
					redirect('koordinator/raspored');
				}
				else{
					
					redirect('koordinator/index');
				}
			}
		}


		//Pocetna strana za uredjivanje naloga
		public function uredjivanje(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Uređivanje naloga';
			/**
			*	Ucitavanje modela
			*/
			$this->load->model('Koordinator_model');
			/**
			*	@var array $data['nastavnici'] - Dohvata sve nastavnike za zadatu skolu
			*/
			$data['nastavnici'] = $this->Koordinator_model->getNastavnikIds($skola);
			/**
			*	@var array $data['skole'] - Dohvata sve skole
			*/	
			$data['skole'] = $this->Koordinator_model->getSkole();
			/**
			*	@var array $data['users']- Dohvata sve korisnike
			*/
			$data['users'] = $this->Koordinator_model->getUsers();
			
			

				$this->load->view('templates/header');
				$this->load->view('koordinator/uredjivanje', $data);
				$this->load->view('templates/footer');

			
		}


		//dodavanje novog nastavnika
		public function noviNalog(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/			
			$data['title'] = 'Novi nastavnik';
			/**
			*	Ucitavanje modela
			*/
			$this->load->model('Koordinator_model');
			$this->form_validation->set_rules('name', 'Ime', 'required');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('username', 'KorisnickoIme', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Lozinka', 'required');
			/**
			*	@var array $data['skole'] - Dohvata sve skole
			*/				
			$data['skole'] = $this->Koordinator_model->getSkole();
			
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/noviNalog', $data);
				$this->load->view('templates/footer');
			}
			else{
				/**
				*	@var string $enc_password - md5 enkripcija unete lozinke
				*/
				$enc_password = md5($this->input->post('password'));
				//Dodavanje nastavnika
				$this->Koordinator_model->dodajNastavnika($enc_password,$skola);
				
				$this->session->set_flashdata('user_registered', 'Uspešno unet nalog');
				
				redirect('koordinator/uredjivanje');
			}
		}


		//Izmena naloga nastavnika
		public function izmenaNaloga(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/		
			$data['title'] = 'Izmena naloga nastavnika';
			/**
			*	Ucitavanje modela
			*/
			$this->load->model('Koordinator_model');
			
			$this->form_validation->set_rules('name', 'Ime', 'required');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			/**
			*	@var array $data['nastavnici'] - Dohvata sve nastavnike za zadatu skolu
			*/			
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike($skola);
			/**
			*	@var array $data['users']- Dohvata sve korisnike
			*/
			$data['users'] = $this->Koordinator_model->getUsers();
			
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/izmenaNaloga', $data);
				$this->load->view('templates/footer');
			}
			else{
				/**
				*	@var array $nastavnik- Izabran nastavnik
				*/
				$nastavnik = $this->input->post('nastavnik');
				//Izmena naloga nastavnika
				$this->Koordinator_model->izmenaNaloga($nastavnik);
				
				$this->session->set_flashdata('user_registered', 'Uspešno izmenjen nalog');
				
				redirect('koordinator/uredjivanje');
			}
		}	


		//Brisanje naloga nastavnika
		public function brisanjeNaloga(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			/**
			*	Ucitavanje modela
			*/
			$this->load->model('Koordinator_model');	
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/			
			$data['title'] = 'Brisanje Naloga';		
			/**
			*	@var array $data['nastavnici'] - Dohvata sve nastavnike za zadatu skolu
			*/						
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike($skola);
			/**
			*	@var array $data['users']- Dohvata sve korisnike
			*/
			$data['users'] = $this->Koordinator_model->getUsers();
	
			$this->load->view('templates/header');
			$this->load->view('koordinator/brisanjeNaloga', $data);
			$this->load->view('templates/footer');				
			/**
			*	@var array $nastavnik- Izabran nastavnik
			*/				
			$nastavnik = $this->input->post('nastavnik');
			//Brisanje naloga nastavnika
			if($this->Koordinator_model->brisanjeNaloga($nastavnik)){
				$this->session->set_flashdata('izbrisan_nastavnik', 'Uspešno izbrisan nalog nastavnika!');
				redirect('koordinator/uredjivanje');
			}
		}		
		
		
		//Dodavanje novog ucenika
		public function noviNalogU(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/			
			$data['title'] = 'Novi ucenik';
			/**
			*	Ucitavanje modela
			*/
			$this->load->model('Koordinator_model');
			$this->form_validation->set_rules('name', 'Ime', 'required');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('username', 'KorisnickoIme', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Lozinka', 'required');
			/**
			*	@var array $data['odeljenja'] - Dohvata sva odeljenja
			*/	
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();
			/**
			*	@var array $data['skole'] - Dohvata sve skole
			*/				
			$data['skole'] = $this->Koordinator_model->getSkole();
			
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/noviNalogU', $data);
				$this->load->view('templates/footer');
			}
			else{
				/**
				*	@var string $enc_password - md5 enkripcija unete lozinke
				*/
				$enc_password = md5($this->input->post('password'));
				//Dodavanje naloga ucenika
				$this->Koordinator_model->dodajUcenika($enc_password,$skola);
				
				$this->session->set_flashdata('user_registered', 'Uspešno unet nalog');
				
				redirect('koordinator/uredjivanje');
			}
		}


		//Izmena naloga ucenika
		public function izmenaNalogaU(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/			
			$data['title'] = 'Izmena naloga ucenika ';
			/**
			*	Ucitavanje modela
			*/
			$this->load->model('Koordinator_model');
			
			$this->form_validation->set_rules('name', 'Ime');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			/**
			*	@var string $data['ucenici'] - dohvata ucenike za zadatu skolu
			*/				
			$data['ucenici'] = $this->Koordinator_model->getUcenike($skola);
			/**
			*	@var array $data['users']- Dohvata sve korisnike
			*/
			$data['users'] = $this->Koordinator_model->getUsers();
			/**
			*	@var array $data['odeljenja'] - Dohvata sva odeljenja
			*/	
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/izmenaNalogaU', $data);
				$this->load->view('templates/footer');
			}
			else{
				/**
				*	@var array $ucenik- Izabran ucenik
				*/
				$ucenik = $this->input->post('ucenik');
				/**
				*	@var array $odeljenje- Izabrano odeljenje
				*/				
				$odeljenje = $this->input->post('odeljenje');
				//Izmena naloga ucenika
				$this->Koordinator_model->izmenaNalogaU($ucenik,$odeljenje);
				
				$this->session->set_flashdata('user_registered', 'Uspešno izmenjen nalog');
				
				redirect('koordinator/uredjivanje');
			}
		}	


		//Brisanje naloga ucenika
		public function brisanjeNalogaU(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var int $skola - dohvatanje ID-a skole ulogovanog koordinatora
			*/
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			/**
			*	Ucitavanje modela
			*/			
			$this->load->model('Koordinator_model');
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/			
			$data['title'] = 'Brisanje Naloga učenika';	
			/**
			*	@var string $data['ucenici'] - dohvata ucenike za zadatu skolu
			*/						
			$data['ucenici'] = $this->Koordinator_model->getUcenike($skola);
			/**
			*	@var array $data['users']- Dohvata sve korisnike
			*/
			$data['users'] = $this->Koordinator_model->getUsers();
	
			$this->load->view('templates/header');
			$this->load->view('koordinator/brisanjeNalogaU', $data);
			$this->load->view('templates/footer');				
			/**
			*	@var array $ucenik- Izabran ucenik
			*/				
			$ucenik = $this->input->post('ucenik');
			//Brisanje naloga ucenika
			if($this->Koordinator_model->brisanjeNalogaU($ucenik)){
				$this->session->set_flashdata('izbrisan_ucenik', 'Uspešno izbrisan nalog učenika!');
				redirect('koordinator/uredjivanje');
			}
		}

		
		//Dodaj novu vest
		public function novaVest(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
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
				$this->load->view('koordinator/novaVest', $data);
				$this->load->view('templates/footer');
			}
			else{
				$this->Koordinator_model->novaVest($this->Koordinator_model->getSkolaId($this->session->userdata('user_id')));
				
				$this->session->set_flashdata('vest_uspesno_dodata', 'Uspešno dodata vest!');
				
				redirect('koordinator');
			}
		}
		
		
		//Izbrisi sve vesti napravljene od strane koordinatora
		public function izbrisiVesti(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$this->Koordinator_model->deleteVesti($this->Koordinator_model->getSkolaId($this->session->userdata('user_id')));
			$this->session->set_flashdata('vesti_izbrisane', 'Uspešno izbrisane vesti od: '.ucfirst($this->session->userdata('user_level')));
			redirect('koordinator');
		}
		

		//DODATI///////////////////////////////////////////////////////////////////
		public function view($page = 'home'){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			if(!file_exists(APPPATH.'views/koordinator/'.$page.'.php')){
				show_404();
			}
			
			if(!$this->session->userdata('user_level') === 'koordinator'){
				redirect('koordinator/home');
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/			
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
		

			
		
	}