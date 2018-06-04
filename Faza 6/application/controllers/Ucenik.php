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
		//ocene
		public function ocene(){
			$data['title'] = 'Ocene';
			$ocene = $this->Ucenik_model->getOcene($this->session->userdata('user_id'));
			$num_of_ocena = $ocene->num_rows();
			$predmeti = $this->Ucenik_model->getPredmete($this->Ucenik_model->getSkolaId($this->session->userdata('user_id')));
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
			$data['ocene'] = $ocene->result();
			
			$this->load->view('templates/header');
			$this->load->view('ucenik/ocene', $data);
			$this->load->view('templates/footer');
		}
	}