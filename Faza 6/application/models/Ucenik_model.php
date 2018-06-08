<!--
	autor: Nemanja Bogdanovic, 2012/0533
		   Aleksandar Milic
-->
<?php
	/**
	*	Ucenik_model - klasa modela svih funkcija Ucenika
	*
	*	@version 1.0
	*/
	class Ucenik_model extends CI_Model{
		/**
		*	Konstruktor klase, ucitava bazu podataka
		*/
		public function __construct(){
			$this->load->database();
		}
		/**
		*	Dohvati sve vesti postavljene od strane Administratora
		*
		*	@return array
		*/
		public function getVestiAdmin(){
			$this->db->where('skolaId', 0);
			/**
			*	@var array $result - rezultat pretrage tabele vesti za dat skolaId
			*/
			$result = $this->db->get('vesti');
			return $result->result_array();
		}
		/**
		*	Dohvati sve vesti za trenutnu skolu
		*
		*	@return array
		*/
		public function getVesti($id){
			$this->db->where('skolaId', $id);
			/**
			*	@var array $result - rezultat pretrage tabele vesti za dat skolaId
			*/
			$result = $this->db->get('vesti');
			return $result->result_array();
		}
		/**
		*	Dohvati id skole ucenika na koji pokazuje ulazni parametar id
		*
		*	@param int $id - id ucenika 
		*
		*	@return array
		*/
		public function getSkolaId($id){
			$this->db->where('id', $id);
			/**
			*	@var array $result - rezultat pretrage tabele ucenik za dat id
			*/
			$result = $this->db->get('ucenik');
			return $result->row(0)->skolaId;
		}
		/**
		*	Dohvati ocene ucenika na koji pokazuje ulazni parametar id
		*
		*	@param int $id - id ucenika 
		*
		*	@return array
		*/
		public function getOcene($id){
			$this->db->where('ucenikId', $id);
			/**
			*	@var array $result - rezultat pretrage tabele ocena za dat id
			*/
			$result = $this->db->get('ocena');
			return $result;
		}
		/**
		*	Dohvati predmete skole ucenika na koji pokazuje ulazni parametar id
		*
		*	@param int $id - id ucenika 
		*
		*	@return array
		*/
		public function getPredmete($id){
			$this->db->where('skolaId', $id);
			/**
			*	@var array $result - rezultat pretrage tabele predmet za dat id
			*/
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