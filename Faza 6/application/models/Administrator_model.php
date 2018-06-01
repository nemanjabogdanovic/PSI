<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Administrator_model extends CI_Model{
		//konstruktor
		public function __construct(){
			$this->load->database();
		}
		//dohvati sve vesti
		public function getVesti(){
			$query = $this->db->get('vesti');
			return $query->result_array();
		}
		//dodaj novu vest
		public function novaVest(){
			$data = array(
				'naslov' => $this->input->post('naslov'),
				'text' => $this->input->post('text'),
				'userLevel' => $this->session->userdata('user_level')
			);
			
			return $this->db->insert('vesti', $data);
		}
		//izbrisi sve vesti od administratora
		public function deleteVesti(){
			$this->db->where('userLevel', $this->session->userdata('user_level'));
			$this->db->delete('vesti');
		}
	}