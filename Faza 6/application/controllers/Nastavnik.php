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
			$data['title'] = 'Kalendar';
			$this->load->view('templates/header');
			$this->load->view('nastavnik/kalendar');
			$this->load->view('templates/footer');
		}
	}
