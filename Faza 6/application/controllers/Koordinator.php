<!--
	autor: Nemanja Bogdanovic, 2012/0533
		   Markovic Milos, 0096/2012
	@version: 1.0
-->
<?php
	class Koordinator extends CI_Controller{
		
		

		public function predmeti() {
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));

			$this->load->model('Koordinator_model');
			
			$data["fetch_data"] = $this->Koordinator_model->listOfStudents($skola);
			
			$data['nastavnici'] = $this->Koordinator_model->getNastavnikeForPredmet();
			
			$data['users'] = $this->Koordinator_model->getUsers();
			$data['skole'] = $this->Koordinator_model->getSkole();
			$this->load->view('templates/header');
			$this->load->view('koordinator/predmeti', $data);
			$this->load->view('templates/footer');
		}
		
		


		
		//pocetna strana
		public function index(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$data['title'] = 'Početna - Vesti';
			$data['vesti'] = $this->Koordinator_model->getVestiAdmin();
			$data['vestiSkola'] = $this->Koordinator_model->getVesti($this->Koordinator_model->getSkolaId($this->session->userdata('user_id')));
			
			
			$this->load->view('templates/header');
			$this->load->view('koordinator/index', $data);
			$this->load->view('templates/footer');
		}
		

		
		
		//dodaj novu vest
		public function novaVest(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
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
		
		
		
		public function raspored(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			
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
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
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
	//			$this->Koordinator_model->prikazRasporeda();
				
				
	//			redirect('koordinator/index');
	//		}
		}
		
		public function prikazRasporedaO(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$data['title'] = 'Prikaz rasporeda';
			
			$this->load->model('Koordinator_model');
			
			$this->load->helper('form');
			$this->load->library('table');
			
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();
		
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
		

		
		//uredjivanje naloga
		public function uredjivanje(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			$data['title'] = 'Uređivanje naloga';
			$this->load->model('Koordinator_model');
			$data['nastavnici'] = $this->Koordinator_model->getNastavnikIds($skola);
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
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			
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
				$this->Koordinator_model->dodajNastavnika($enc_password,$skola);
				
				$this->session->set_flashdata('user_registered', 'Uspešno unet nalog');
				
				redirect('koordinator/index');
			}
		}
		
		//Izmena nastavnika
		public function izmenaNaloga(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
		
			$data['title'] = 'Izmena naloga nastavnika';
			$this->load->model('Koordinator_model');
			
			$this->form_validation->set_rules('name', 'Ime', 'required');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike($skola);
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
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			
			$data['title'] = 'Izmena naloga ucenika ';
			$this->load->model('Koordinator_model');
			
			$this->form_validation->set_rules('name', 'Ime');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			
			$data['ucenici'] = $this->Koordinator_model->getUcenike($skola);
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
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			
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
				$this->Koordinator_model->dodajUcenika($enc_password,$skola);
				
				$this->session->set_flashdata('user_registered', 'Uspešno unet nalog');
				
				redirect('koordinator/index');
			}
		}
		

		

		
		
		public function brisanjeCasova(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
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
					$this->session->set_flashdata('izmenjen_predmet', 'Uspešno obrisan čas');
					redirect('koordinator/raspored');
				}
				else{
					
					redirect('koordinator/index');
				}
			}
		}
		
		
		
		public function unosPredmeta(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$this->load->model('Koordinator_model');
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			$data['title'] = 'Unos predmeta';
			
			$this->form_validation->set_rules('ime', 'Ime predmeta', 'required');
			$this->form_validation->set_rules('skolskaGodina', 'Skolska godina', 'required');
			$this->form_validation->set_rules('kabineti', 'Kabinet', 'required');
			
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike($skola);
			$data['skole'] = $this->Koordinator_model->getSkole();
			$data['users'] = $this->Koordinator_model->getUsers();
			
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/unosPredmeta', $data);
				$this->load->view('templates/footer');
			}
			else{
				
				$this->Koordinator_model->unosPredmeta($skola);
				$this->session->set_flashdata('unet_predmet', 'Uspešno unet predmet');
				redirect('koordinator/predmeti');
			}
		}
	
		public function unosCasova() {			
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			$data['title'] = 'Unos Casova';			
			$this->load->model('Koordinator_model');
			
			$this->form_validation->set_rules('dan', 'Dan', 'required');
			$this->form_validation->set_rules('brojCasa', 'Broj Casa', 'required');
			$this->form_validation->set_rules('kabinet', 'Kabinet', 'required');
			
			$data['odeljenja'] = $this->Koordinator_model->getOdeljenja();				
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike($skola);		
			$data['predmeti'] = $this->Koordinator_model->getPredmete($skola);
			$data['users'] = $this->Koordinator_model->getUsers();
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/unosCasova', $data);
				$this->load->view('templates/footer');
			}
			else{
				
				
				$this->Koordinator_model->unosCasova();
				$this->session->set_flashdata('unet_cas', 'Uspešno unet čas');
				redirect('koordinator/raspored');
			}
			
		}
		
		public function izmenaPredmeta(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			$this->load->model('Koordinator_model');
			$data['title'] = 'Izmena predmeta';
			$this->form_validation->set_rules('ime', 'Ime predmeta', 'required');
			$this->form_validation->set_rules('skolskaGodina', 'Skolska godina', 'required');
			$this->form_validation->set_rules('kabineti', 'Kabinet', 'required');
			
			$data['predmeti'] = $this->Koordinator_model->getPredmete($skola);
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike($skola);
			$data['users'] = $this->Koordinator_model->getUsers();
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/izmenaPredmeta', $data);
				$this->load->view('templates/footer');
			}
			else{
				$predmet = $this->input->post('predmet');
			
				$this->Koordinator_model->izmenaPredmeta($predmet);
				$this->session->set_flashdata('izmenjen_predmet', 'Uspešno izmenjen predmet');
				redirect('koordinator/index');
			
			}	
		}
		
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
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			$this->load->model('Koordinator_model');
			$data['title'] = 'Brisanje predmeta';		
			
			$data['predmeti'] = $this->Koordinator_model->getPredmete($skola);
			$data['skole'] = $this->Koordinator_model->getSkole();

	//		$this->load->view('templates/header');
	//	    $this->load->view('koordinator/brisanjePredmeta', $data);
	//		$this->load->view('templates/footer');

			$ime = $this->input->post('ime');
	//		$skolaid = $this->input->post('skolaid');
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			$this->form_validation->set_rules('ime', 'Ime predmeta', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/brisanjePredmeta', $data);
				$this->load->view('templates/footer');
			}
			else{
			$this->Koordinator_model->brisanjePredmeta($ime,$skola);		
				$this->session->set_flashdata('izbrisan_predmet', 'Uspešno izbrisan predmet');
				redirect('koordinator/predmeti');
			
			}
		}		
		
		public function brisanjeNaloga(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));

			$this->load->model('Koordinator_model');			
			$data['title'] = 'Brisanje Naloga';		
						
			$data['nastavnici'] = $this->Koordinator_model->getNastavnike($skola);
			$data['users'] = $this->Koordinator_model->getUsers();
	
			$this->load->view('templates/header');
			$this->load->view('koordinator/brisanjeNaloga', $data);
			$this->load->view('templates/footer');				
				
			$nastavnik = $this->input->post('nastavnik');
		//	die($nastavnik);
			if($this->Koordinator_model->brisanjeNaloga($nastavnik)){
				$this->session->set_flashdata('izbrisan_nastavnik', 'Uspešno izbrisan nalog nastavnika!');
				redirect('koordinator/uredjivanje');
			}
		}
			
		public function brisanjeNalogaU(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'koordinator'){
				redirect($this->session->userdata['user_level']);
			}
			$skola = $this->Koordinator_model->getSkolaKoord($this->session->userdata('user_id'));
			
			$this->load->model('Koordinator_model');			
			$data['title'] = 'Brisanje Naloga učenika';		
						
			$data['ucenici'] = $this->Koordinator_model->getUcenike($skola);
			$data['users'] = $this->Koordinator_model->getUsers();
	
			$this->load->view('templates/header');
			$this->load->view('koordinator/brisanjeNalogaU', $data);
			$this->load->view('templates/footer');				
				
			$ucenik = $this->input->post('ucenik');
		//	die($nastavnik);
			if($this->Koordinator_model->brisanjeNalogaU($ucenik)){
				$this->session->set_flashdata('izbrisan_ucenik', 'Uspešno izbrisan nalog učenika!');
				redirect('koordinator/uredjivanje');
			}
		}		
	}