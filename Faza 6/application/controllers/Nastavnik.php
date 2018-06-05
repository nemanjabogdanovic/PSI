<!--
	autor: Nemanja Bogdanovic, 2012/0533
		   Dragana Svrkota
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
			$data['title'] = 'Početna - Vesti';
			$data['vesti'] = $this->Nastavnik_model->getVestiAdmin();
			$data['vestiSkola'] = $this->Nastavnik_model->getVesti($this->Nastavnik_model->getSkolaId($this->session->userdata('user_id')));


			$this->load->view('templates/header');
			$this->load->view('nastavnik/index', $data);
			$this->load->view('templates/footer');
		}

		public function view($page = 'home'){
			if(!file_exists(APPPATH.'views/nastavnik/'.$page.'.php')){
				show_404();
			}

			if(!$this->session->userdata('user_level') === 'nastavnik'){
				redirect('users/login');
			}

			$data['title'] = ucfirst($page);

			$this->load->view('templates/header');
			$this->load->view('nastavnik/'.$page, $data);
			$this->load->view('templates/footer');

		}

		public function ucenici() {
			$data["fetch_data"] = $this->Nastavnik_model->dohvati();
			$data["odeljenja"] = $this->Nastavnik_model->listaOdeljenja();
			$data["skole"] = $this->Nastavnik_model->listaSkola();
			$this->load->view('templates/header');
			$this->load->view('nastavnik/ucenici', $data);
			$this->load->view('templates/footer');
		}

		public function kalendar() {
			
			$this->load->helper('form');
			$this->load->library('table');
			
			$raspored = $this->Nastavnik_model->dohvati_raspored();
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


		public function izostanci() {
				$data["odeljenja"] = $this->Nastavnik_model->listaOdeljenja();
				$data["fetch_data"] = $this->Nastavnik_model->dohvatiOdeljenje();
				$data["ucenici"] = $this->Nastavnik_model->dohvatiIdUcenika(); 
							$data["skole"] = $this->Nastavnik_model->listaSkola();
							$data["uneto"] = $this->Nastavnik_model->unosIzostanka();


				$this->load->view('templates/header');
  			$this->load->view('nastavnik/izostanci', $data);
  			$this->load->view('templates/footer');
		}
	}
