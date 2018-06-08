<!--
	autor: Nemanja Bogdanovic, 2012/0533
-->
<?php
	/**
	*	Ucenik - klasa za funkcionalnosti korisnika Ucenik
	*
	*	@version 1.0
	*/
	class Ucenik extends CI_Controller{
		/**
		*	Pocetna strana sa najnovijim vestima
		*/
		public function index(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'ucenik'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Početna - Vesti';
			/**
			*	@var array $data['vesti'] - prosledjivanje vesti
			*/
			$data['vesti'] = $this->Ucenik_model->getVestiAdmin();
			/**
			* @var array $data['vestiSkola'] - prosledjivanje vesti za skolu trenutnog ucenika
			*/		
			$data['vestiSkola'] = $this->Ucenik_model->getVesti($this->Ucenik_model->getSkolaId($this->session->userdata('user_id')));

			$this->load->view('templates/header');
			$this->load->view('ucenik/index', $data);
			$this->load->view('templates/footer');
		}
		/**
		*	Funkcija za prikaz liste predmeta i ocena iz tih predmeta
		*/
		public function ocene(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'ucenik'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Ocene';
			/**
			*	@var array $ocene - lista svih ocena trenutno ulogovanog ucenika
			*/
			$ocene = $this->Ucenik_model->getOcene($this->session->userdata('user_id'));
			/**
			*	@var int $num_of_ocena - broj redova u promenjivoj $ocene
			*/
			$num_of_ocena = $ocene->num_rows();
			/**
			*	@var array $predmeti - lista svih predmeta trenutno ulogovanog ucenika
			*/
			$predmeti = $this->Ucenik_model->getPredmete($this->Ucenik_model->getSkolaId($this->session->userdata('user_id')));
			/**
			*	@var int $num_of_predmeta - broj redova u promenjivoj $predmeti
			*/
			$num_of_predmeta = $predmeti->num_rows();

			for($i = 0; $i < $num_of_ocena; $i++){
				for($j = $i+1; $j < $num_of_ocena; $j++){
					if($ocene->row($j)->predmetId === $ocene->row($i)->predmetId){
						$ocene->row($i)->ocena = $ocene->row($i)->ocena.', '.$ocene->row($j)->ocena;
						$ocene->row($j)->predmetId = $ocene->row($num_of_ocena-1)->predmetId;
						$ocene->row($j)->ocena = $ocene->row($num_of_ocena-1)->ocena;
						$ocene->row($num_of_ocena-1)->predmetId = 0;
						$num_of_ocena--;
						$j--;
					}
				}
				for($k = 0; $k < $num_of_predmeta; $k++){
					if($ocene->row($i)->predmetId === $predmeti->row($k)->id){
						$ocene->row($i)->predmetId = $predmeti->row($k)->ime;
						break;
					}
				}
			}
			/**
			*	@var array $data['ocene'] - prosledjivanje niza ocena
			*/
			$data['ocene'] = $ocene->result();
			
			$this->load->view('templates/header');
			$this->load->view('ucenik/ocene', $data);
			$this->load->view('templates/footer');
		}
		/**
		*	Kontakt nastavnika preko e-mail forme
		*/
		public function kontakt(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'ucenik'){
				redirect($this->session->userdata['user_level']);
			}
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Kontaktiraj nastavnika';
			/**
			*	@var string $data['predmeti'] - prosledjivanje predmeta koje slusa trenutno ulogovan ucenik
			*/
			$data['predmeti'] = $this->Ucenik_model->getPredmete($this->Ucenik_model->getSkolaId($this->session->userdata('user_id')));

			$this->form_validation->set_rules('naslov', 'Naslov', 'required');
			$this->form_validation->set_rules('text', 'Tekst', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('ucenik/kontakt', $data);
				$this->load->view('templates/footer');
			}
			else{
				$this->session->set_flashdata('poruka_poslata', 'Uspešno poslata poruka!');
				redirect('ucenik/kontakt');
			}
		}

		public function raspored(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'ucenik'){
				redirect($this->session->userdata['user_level']);
			}
			$this->load->helper('form');
			$this->load->library('table');

			$raspored = $this->Ucenik_model->dohvati_raspored();
			$user_id = $this->session->userdata('user_id');
			$ucenik = $this->Ucenik_model->dohvati_ime_i_prezime($user_id);
			$data['ime'] = $ucenik->name;
			$data['prezime'] = $ucenik->surname;
			$data['odeljenje'] = $this->Ucenik_model->dohvati_oznaku_odeljenja($raspored[1]->odeljenjeId);
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
				if($ras->dan == 'ponedeljak') $data['ponedeljak'][$ras->brojCasa] = 'Cas: ' . $this->Ucenik_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet;
				if($ras->dan == 'utorak') $data['utorak'][$ras->brojCasa] = 'Cas: ' . $this->Ucenik_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet;
				if($ras->dan == 'sreda') $data['sreda'][$ras->brojCasa] = 'Cas: ' . $this->Ucenik_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet;
				if($ras->dan == 'cetvrtak') $data['cetvrtak'][$ras->brojCasa] = 'Cas: ' . $this->Ucenik_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet;
				if($ras->dan == 'petak') $data['petak'][$ras->brojCasa] = 'Cas: ' . $this->Ucenik_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet;

			}

			$this->load->view('templates/header');
			$this->load->view('ucenik/raspored', $data);
			$this->load->view('templates/footer');
		}
	}
