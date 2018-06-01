<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Nastavnik extends CI_Controller{



		public function __construct() {
	    parent::__construct();
	    $this->load->model('Nastavnik_model');
	  }

		public function index() {
			$data['title'] = 'Nastavnik';

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

			$data["fetch_data"] = $this->Nastavnik_model->listOfStudents();

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
