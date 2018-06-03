<!--
	autor: Markovic Milos, 0097/2012
		   Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class Koordinator_model extends CI_Model{
		//konstruktor
		public function __construct(){
			$this->load->database();
		}
		//Unos predmeta
		public function unosPredmeta(){
			$data = array(
				'ime' => $this->input->post('ime'),
				'nastavnik' => $this->input->post('nastavnik'),
				'skolskaGodina' => $this->input->post('skolskaGodina'),
				'kabineti' => $this->input->post('kabineti'),
				'skolaId' => $this->input->post('skola')
				
				
			);
			
			return $this->db->insert('predmet', $data);
		}
		
		//uzmi skole iz baze
		public function getNastavnikIds(){
			$nastavnik = $this->db->get("nastavnik");
			return $nastavnik;
		}
		
		public function izmenaPredmeta($predmet){
			$data = array(
				
				'ime' => $this->input->post('ime'),
				'nastavnik' => $this->input->post('nastavnik'),
				'skolskaGodina' => $this->input->post('skolskaGodina'),
				'kabineti' => $this->input->post('kabineti')
				
			);
			$predmet = $this->input->post('predmet');
			
			$this->db->where('id', $predmet);
			$this->db->update('predmet', $data);
		}
		
		//uzmi korisnike iz baze 
		public function getUsers(){
			$users = $this->db->get("users");
			return $users;
		}
		
		//unosPredmeta
		public function unosCasova(){
			$data = array(
				'odeljenjeId' => $this->input->post('odeljenje'),
				'dan' => $this->input->post('dan'),
				'brojCasa' => $this->input->post('brojCasa'),
				'nastavnikId' => $this->input->post('nastavnik'),
				'kabinet' => $this->input->post('kabinet'),
				'predmetId' => $this->input->post('predmet')
			);
			
			return $this->db->insert('raspored', $data);
		}
    
		public function listOfStudents() {
			  $query = $this->db->get("predmet");
		   return $query;
		}
		
		public function getNastavnike(){
			
			
			$result = $this->db->get('nastavnik');
			$id = $result->row(0)->id;
			
			
			
			$query = $this->db->get_where('users', array('id'=>$id));  ////////////////////// SVEeeeeeeeeee
			return $query;
		}
		
		
	
		public function getSkole(){
			$query = $this->db->get('skola');
			return $query;
		}
		
		public function getOdeljenja(){
			$query = $this->db->get('odeljenje');
			return $query;
		}
		
		public function getPredmete(){
			$query = $this->db->get('predmet');
			return $query;
		}
		
		public function brisanjePredmeta($ime,$skolaid){
			$query = $this->db->get_where('predmet', array('ime' => $ime));
			$query = $this->db->get_where('predmet', array('skolaid' => $skolaid));
			if(empty($query->row_array())){
				return false;
			}
			else{
				$this->db->where('ime', $ime);
				$this->db->where('skolaid', $skolaid);
				$this->db->delete('predmet');
				return true;
			} 
		}
		
		//dodaj novog nastavnika
		public function dodajNastavnika($enc_password){
			$data = array(
				'name' => $this->input->post('name'),
				'surname' => $this->input->post('surname'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => $enc_password
			);
			$this->db->insert('users', $data);
			
			$this->db->where('username', $this->input->post('username'));
			$this->db->where('password', $enc_password);
			$result = $this->db->get('users');
			$id = $result->row(0)->id;
			$this->dodajNastavnikaId($id);
			
			return $id;
		}
		
		//dodaj novog nastavnika
		public function dodajUcenika($enc_password){
			$data = array(
				'name' => $this->input->post('name'),
				'surname' => $this->input->post('surname'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => $enc_password,
//				'odeljenjeId' => $this->input->post('odeljenje')
			);
			$this->db->insert('users', $data);
			
			$this->db->where('username', $this->input->post('username'));
			$this->db->where('password', $enc_password);
			$result = $this->db->get('users');
			$id = $result->row(0)->id;
			$this->dodajUcenikaId($id);
			
			return $id;
		}

		//dodaj nastavnika i identifikator skole
		public function dodajNastavnikaId($userid){
			$dataNastavnik = array(
				'id' => $userid,
				'skolaId' => $this->input->post('skola')
				
			);
			
			$this->db->insert('nastavnik', $dataNastavnik);
		}	
		//dodaj nastavnika i identifikator skole
		public function dodajUcenikaId($userid){
			$dataUcenik = array(
				'id' => $userid,
				'skolaId' => $this->input->post('skola'),
				'odeljenjeId' => $this->input->post('odeljenje')
			);
			
			$this->db->insert('ucenik', $dataUcenik);
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
		//dodaj novu vest
		public function novaVest($skola_id){
			$data = array(
				'naslov' => $this->input->post('naslov'),
				'text' => $this->input->post('text'),
				'userLevel' => $this->session->userdata('user_level'),
				'skolaId' => $skola_id
			);
			
			return $this->db->insert('vesti', $data);
		}
		//izbrisi sve vesti od trenutnog koordinatora
		public function deleteVesti($id){
			$this->db->where('skolaId', $id);
			$this->db->delete('vesti');
		}
		//dohvati id skole trenutnog koordinatora
		public function getSkolaId($id){
			$this->db->where('id', $id);
			$result = $this->db->get('koordinator');
			return $result->row(0)->skolaId;
		}

	}