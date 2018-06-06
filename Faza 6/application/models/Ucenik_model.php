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
		//dohvati ocene trenutnog ucenika
		public function getOcene($id){
			$this->db->where('ucenikId', $id);
			$result = $this->db->get('ocena');
			return $result;
		}
		//dohvati predmete skole trenutnog ucenika
		public function getPredmete($id){
			$this->db->where('skolaId', $id);
			$result = $this->db->get('predmet');
			return $result;
		}
		
		public function dohvati_raspored(){
		$user_id = $this->session->userdata('user_id');
		$this->db->where('id',$user_id);
		$query = $this->db->get('ucenik');
		$ucenik = $query->row();
		$this->db->where('odeljenjeId', $ucenik->odeljenjeId);
		$query = $this->db->get('raspored');
		$result = $query->result();
		return $result;
	}
	
	public function dohvati_ime_predmeta($predmetId){
		$this->db->where('id', $predmetId);
		$query = $this->db->get('predmet');
		$predmet = $query->row();
		$result = $predmet->ime;
		return $result;
		
	}
	
	public function dohvati_oznaku_odeljenja($odeljenjeId){
		$this->db->where('id', $odeljenjeId);
		$query = $this->db->get('odeljenje');
		$odeljenje = $query->row();
		$result = $odeljenje->oznaka;
		return $result;
	}
	
	public function dohvati_ime_i_prezime($user_id){
		$this->db->where('id',$user_id);
		$query = $this->db->get('users');
		return $query->row();
	}
	}