<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Ucenik_model extends CI_Model{
		//konstruktor
		public function __construct(){
			$this->load->database();
		}
		//dohvati sve vesti od administratora
		public function getVestiAdmin(){
			$this->db->where('skolaId', 0);
			$query = $this->db->get('vesti');
			return $query->result_array();
		}
		//dohvati sve vesti za trenutnu skolu
		public function getVesti($id){
			$this->db->where('skolaId', $id);
			$query = $this->db->get('vesti');
			return $query->result_array();
		}
		//dohvati id skole trenutnog ucenika
		public function getSkolaId($id){
			$this->db->where('id', $id);
			$result = $this->db->get('ucenik');
			return $result->row(0)->skolaId;
		}
	}