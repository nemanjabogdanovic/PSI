<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Ucenik extends CI_Controller{
		//pocetna strana
		public function index(){
			$data['title'] = 'Početna - Vesti';
			$data['vesti'] = $this->Ucenik_model->getVestiAdmin();
			$data['vestiSkola'] = $this->Ucenik_model->getVesti($this->Ucenik_model->getSkolaId($this->session->userdata('user_id')));
			
			
			$this->load->view('templates/header');
			$this->load->view('ucenik/index', $data);
			$this->load->view('templates/footer');
		}
	}