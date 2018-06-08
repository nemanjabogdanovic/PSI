<!--
	autor: Nemanja Bogdanovic, 2012/0533
		   Dragana Svrkota, 2015/0485
			 Aleksandar Milic,
			 Milos Markovic,
	@version: 1.0
-->
<?php
	class Nastavnik extends CI_Controller{
		public function __construct() {
	    parent::__construct();
	    $this->load->model('Nastavnik_model');
		}

		//pocetna strana
		public function index(){
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'nastavnik'){
				redirect($this->session->userdata['user_level']);
			}
			$data['title'] = 'Početna - Vesti';
			$data['vesti'] = $this->Nastavnik_model->getVestiAdmin();
			$data['vestiSkola'] = $this->Nastavnik_model->getVesti($this->Nastavnik_model->getSkolaId($this->session->userdata('user_id')));


			$this->load->view('templates/header');
			$this->load->view('nastavnik/index', $data);
			$this->load->view('templates/footer');
		}

		//spisak ucenika kojima nastavnik koji se ulogovao predaje, prikazuju se ime, prezime i odeljenje
		public function ucenici() {
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'nastavnik'){
				redirect($this->session->userdata['user_level']);
			}
			$data["fetch_data"] = $this->Nastavnik_model->dohvati();
			$data["odeljenja"] = $this->Nastavnik_model->listaOdeljenja();
			$data["skole"] = $this->Nastavnik_model->listaSkola();
			$this->load->view('templates/header');
			$this->load->view('nastavnik/ucenici', $data);
			$this->load->view('templates/footer');
		}

		//prikazuje se raspored casova nastavnika koji se ulogovao
		public function kalendar() {
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'nastavnik'){
				redirect($this->session->userdata['user_level']);
			}

			$this->load->helper('form');
			$this->load->library('table');

			$raspored = $this->Nastavnik_model->dohvati_raspored();
			$user_id = $this->session->userdata('user_id');
			$nastavnik = $this->Nastavnik_model->dohvati_ime_i_prezime($user_id);
			$data['ime'] = $nastavnik->name;
			$data['prezime'] = $nastavnik->surname;
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
				if($ras->dan == 'ponedeljak') $data['ponedeljak'][$ras->brojCasa] = 'Cas: ' . $this->Nastavnik_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet .'<br> Odeljenje: ' . $this->Nastavnik_model->dohvati_oznaku_odeljenja($ras->odeljenjeId);
				if($ras->dan == 'utorak') $data['utorak'][$ras->brojCasa] = 'Cas: ' . $this->Nastavnik_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet .'<br> Odeljenje: ' . $this->Nastavnik_model->dohvati_oznaku_odeljenja($ras->odeljenjeId);
				if($ras->dan == 'sreda') $data['sreda'][$ras->brojCasa] = 'Cas: ' . $this->Nastavnik_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet .'<br> Odeljenje: ' . $this->Nastavnik_model->dohvati_oznaku_odeljenja($ras->odeljenjeId);
				if($ras->dan == 'cetvrtak') $data['cetvrtak'][$ras->brojCasa] = 'Cas: ' . $this->Nastavnik_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet .'<br> Odeljenje: ' . $this->Nastavnik_model->dohvati_oznaku_odeljenja($ras->odeljenjeId);
				if($ras->dan == 'petak') $data['petak'][$ras->brojCasa] = 'Cas: ' . $this->Nastavnik_model->dohvati_ime_predmeta($ras->predmetId) . '<br> Kabinet: ' . $ras->kabinet .'<br> Odeljenje: ' . $this->Nastavnik_model->dohvati_oznaku_odeljenja($ras->odeljenjeId);

			}

			$this->load->view('templates/header');
			$this->load->view('nastavnik/kalendar', $data);
			$this->load->view('templates/footer');
		}

		//unos izostanka od strane nastavnika
		public function izostanci() {
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'nastavnik'){
				redirect($this->session->userdata['user_level']);
			}
				$data["odeljenja"] = $this->Nastavnik_model->listaOdeljenja();
				$data["fetch_data"] = $this->Nastavnik_model->dohvatiOdeljenje();
;
							$data["skole"] = $this->Nastavnik_model->listaSkola();
							$data["uneto"] = $this->Nastavnik_model->unosIzostanka();


				$this->load->view('templates/header');
  			$this->load->view('nastavnik/izostanci', $data);
  			$this->load->view('templates/footer');
		}

		//upis casa od strane nastavnika
		public function upis() {
			if(session_status() == PHP_SESSION_NONE){
				redirect('login');
			}
			else if($this->session->userdata['user_level'] != 'nastavnik'){
				redirect($this->session->userdata['user_level']);
			}
			$data["predmeti"] = $this->Nastavnik_model->upisCasa();

			$this->load->view('templates/header');
			$this->load->view('nastavnik/upis', $data);
			$this->load->view('templates/footer');
		}

		//prikaz i unos ocena za odredjenog ucenika od strane nastavnika
		public function ocene() {
			/**
			*	@var array $data[''odeljenja''] - dohvatanje odeljenja
			*/
				$data["odeljenja"] = $this->Nastavnik_model->listaOdeljenja();
			/**
			*	@var array $data[''predmeti''] - dohvatanje predmeta za zadatog nastavnika
			*/
				$data['predmeti'] = $this->Nastavnik_model->getPredmete($this->session->userdata('user_id'));
			/**
			*	@var array $data[''predmeti''] - dohvatanje predmeta za zadatog nastavnika
			*/
				$data['predmetiSelect'] = $this->Nastavnik_model->getPredmete($this->session->userdata('user_id'));
			/**
			*	@var array $ocene - dohvatanje ocena
			*/
				$ocene = $this->Nastavnik_model->dohvatiOcene();
			/**
			*	@var string $broj_ocena - broj ocena
			*/
				$broj_ocena = $ocene->num_rows();

				for($i = 0; $i < 	$broj_ocena; $i++){
					for($j = $i+1; $j < 	$broj_ocena; $j++){
						if($ocene->row($j)->ucenikId === $ocene->row($i)->ucenikId){
							$ocene->row($i)->ocena = $ocene->row($i)->ocena.', '.$ocene->row($j)->ocena;
							$ocene->row($j)->ucenikId = $ocene->row($broj_ocena-1)->ucenikId;
							$ocene->row($j)->ocena = $ocene->row($broj_ocena-1)->ocena;

							$ocene->row($broj_ocena-1)->ucenikId = 0;
							$broj_ocena--;
							$j--;
						}
					}
				}
				/**
				*	@var array $data['ocene'] - selektovane ocene
				*/
				$data['ocene'] = $ocene->result();
				/**
				*	@var array $data["fetch_data"] - odeljenja
				*/
				$data["fetch_data"] = $this->Nastavnik_model->dohvatiOdeljenje();
				/**
				*	@var array $data["ucenici"]  - ucenici
				*/
				$data["ucenici"] = $this->Nastavnik_model->dohvatiOdeljenje();
				/**
				*	@var array $data["skole"]  - skole
				*/
				$data["skole"] = $this->Nastavnik_model->listaSkola();

				$this->form_validation->set_rules('ocena', 'Ocena', 'required');
				/**
				*	@var int $ocena  - unesena ocena
				*/
				$ocena = $this->input->post('ocena');
				/**
				*	@var int $predmet  - unesen predmet
				*/
				$predmet = $this->input->post('predmet');

					if($this->form_validation->run() === FALSE){
						$this->load->view('templates/header');
						$this->load->view('nastavnik/ocene', $data);
						$this->load->view('templates/footer');

					}
				else{
						//unosenje ocene
						$this->Nastavnik_model->unosOcene();

						redirect('nastavnik/ocene');
						$this->load->view('templates/header');
						$this->load->view('nastavnik/ocene', $data);
						$this->load->view('templates/footer');
				}
		}


		public function brisanjeOcene() {
				/**
				*	@var array $odeljenja - odeljenja
				*/
				$data["odeljenja"] = $this->Nastavnik_model->listaOdeljenja();
				/**
				*	@var array $predmeti - predmeti
				*/
				$data['predmeti'] = $this->Nastavnik_model->getPredmete($this->session->userdata('user_id'));
				/**
				*	@var array $fetch_data - odeljenja
				*/
				$data["fetch_data"] = $this->Nastavnik_model->dohvatiOdeljenje();
				/**
				*	@var array $ucenici - ucenici
				*/
				$data["ucenici"] = $this->Nastavnik_model->dohvatiOdeljenje();
				/**
				*	@var array $skole - skole
				*/
				$data["skole"] = $this->Nastavnik_model->listaSkola();
				/**
				*	@var array $predmetiSelect - predmetiSelect
				*/
				$data['predmetiSelect'] = $this->Nastavnik_model->getPredmete($this->session->userdata('user_id'));
				/**
				*	@var array $ocene - ocene
				*/				
				$ocene = $this->Nastavnik_model->dohvatiOcene();
				/**
				*	@var int $broj_ocena - broj ocena
				*/
				$broj_ocena = $ocene->num_rows();

				for($i = 0; $i < 	$broj_ocena; $i++){
					for($j = $i+1; $j < 	$broj_ocena; $j++){
						if($ocene->row($j)->ucenikId === $ocene->row($i)->ucenikId){
							$ocene->row($i)->ocena = $ocene->row($i)->ocena.', '.$ocene->row($j)->ocena;
							$ocene->row($j)->ucenikId = $ocene->row($broj_ocena-1)->ucenikId;
							$ocene->row($j)->ocena = $ocene->row($broj_ocena-1)->ocena;

							$ocene->row($broj_ocena-1)->ucenikId = 0;
							$broj_ocena--;
							$j--;
						}
					}
				}
				/**
				*	@var int $ocena - unesena ocene
				*/	
				$ocena = $this->input->post('ocena');
				/**
				*	@var int $predmet - unesen predmet
				*/				
				$predmet = $this->input->post('predmet');
									$data['ocene'] = $ocene->result();

				$this->form_validation->set_rules('ime', 'Ime', 'required');

					if($this->form_validation->run() === FALSE){

						$this->load->view('templates/header');
						$this->load->view('nastavnik/brisanjeOcene', $data);
						$this->load->view('templates/footer');


					}
				else{
						//koordinator kontroler funkcija za brisanje ocene za izabrani predmet i ucenika
						$this->brisanje();


						$this->load->view('templates/header');
						$this->load->view('nastavnik/brisanjeOcene', $data);
						$this->load->view('templates/footer');
				}
		}

		public function brisanje() {
				/**
				*	@var  $predmet - globalna promenljiva
				*/			
				global $predmet;
				/**
				*	@var  $ucenik - globalna promenljiva
				*/
				global $ucenik;
						/**
						*	@var int $predmet - ID unesenog predmeta
						*/			
						$predmet = $this->input->post('ime');
						/**
						*	@var int $ucenik - ID unesenog ucenika
						*/	
						$ucenik = $this->input->post('iz');
				/**
				*	@var  $data['ocene'] - dohvata ocene za zadati predmet zadatog ucenika
				*/
				$data['ocene'] = $this->Nastavnik_model->getOcene($predmet,$ucenik);



				$this->form_validation->set_rules('ocena', 'Ocena', 'required');


					if($this->form_validation->run() === FALSE){
						$this->load->view('templates/header');
						$this->load->view('nastavnik/brisanje', $data);
						$this->load->view('templates/footer');

					}
				else{
						/**
						*	@var int $ocena - unesena ocena
						*/				
						$ocena = $this->input->post('ocena');
						
						//brisanje izabrane ocene
						$this->Nastavnik_model->brisanje($ocena);

						redirect('nastavnik/ocene');

				}
		}

	}
