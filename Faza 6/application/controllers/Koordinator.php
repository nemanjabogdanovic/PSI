<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Koordinator extends CI_Controller{
		
		

public function predmeti() {
$this->load->model('Koordinator_model');
   $data["fetch_data"] = $this->Koordinator_model->listOfStudents();

   $this->load->view('templates/header');
   $this->load->view('koordinator/predmeti', $data);
   $this->load->view('templates/footer');
  }
		
		public function index(){
			$data['title'] = 'Pocetna';
			$this->load->view('templates/header');
			$this->load->view('koordinator/index', $data);
			$this->load->view('templates/footer');
		}
		
		
		
		public function raspored(){
			$data['title'] = 'raspored';
			$this->load->view('templates/header');
			$this->load->view('koordinator/raspored', $data);
			$this->load->view('templates/footer');
		}
		
		public function uredjivanje(){
			$data['title'] = 'uredjivanje';
			$this->load->view('templates/header');
			$this->load->view('koordinator/uredjivanje', $data);
			$this->load->view('templates/footer');
		}
		
		public function izmenaPredmeta(){
			$data['title'] = 'Izmena Predmeta';
			$this->load->view('templates/header');
			$this->load->view('koordinator/izmenaPredmeta', $data);
			$this->load->view('templates/footer');
		}
		
		
		
		public function unosPredmeta(){
			$data['title'] = 'Unos';
			$this->form_validation->set_rules('ime', 'Ime predmeta', 'required');
			$this->form_validation->set_rules('nastavnik', 'Nastavnik', 'required');
			$this->form_validation->set_rules('skolskaGodina', 'Skolska godina', 'required');
			$this->form_validation->set_rules('kabineti', 'Kabinet', 'required');
			
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('koordinator/unosPredmeta', $data);
				$this->load->view('templates/footer');
			}
			else{
				$this->load->model('Koordinator_model');
				$this->Koordinator_model->unosPredmeta();
				
				
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
	}