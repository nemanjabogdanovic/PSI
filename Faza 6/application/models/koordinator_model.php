<!--
	autor: Markovic Milos, 0097/2012
		   Nemanja Bogdanovic, 2012/0533
	
	Koordinator_model – model u kome se nalaze sve funkcije koje koristi koordinator kontroler za komunikaciju sa bazom
	
		   
	@version: 1.16
-->
<?php
	class Koordinator_model extends CI_Model{
		//konstruktor
		public function __construct(){
			$this->load->database();
		}
		//Unos predmeta za skolu kojoj je dodeljen koordinator
		public function unosPredmeta($skola){
			$data = array(
				'ime' => $this->input->post('ime'),
				'nastavnik' => $this->input->post('nastavnik'),
				'skolskaGodina' => $this->input->post('skolskaGodina'),
				'kabineti' => $this->input->post('kabineti'),
				'skolaId' => $skola				
			);			
			return $this->db->insert('predmet', $data);
		}
		
		//Dohvati id nastavnika iz baze za skolu kojoj je dodeljen koordinator
		public function getNastavnikIds($skola){
			$this->db->where('skolaId',$skola);
			$nastavnik = $this->db->get("nastavnik");
			return $nastavnik;
		}
		
		//Dohvati ucenike za skolu kojoj je dodeljen koordinator
		public function getUcenike($skola){
			$this->db->where('skolaId',$skola);
			$ucenik = $this->db->get("ucenik");
			return $ucenik;
		}
		
		//Izmena izabranog predmeta
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
		
		//Izmena izabranog naloga nastavnika
		public function izmenaNaloga($nastavnik){
			$data = array(
				
				'name' => $this->input->post('name'),
				'surname' => $this->input->post('surname'),
				'email' => $this->input->post('email')
				
			);
			$nastavnik = $this->input->post('nastavnik');
			
			$this->db->where('id', $nastavnik);
			$this->db->update('users', $data);
		}
		
		//Izmena izabranog naloga ucenika za izabrano odeljenje
		public function izmenaNalogaU($ucenik,$odeljenje){
			$data = array(
				
				'name' => $this->input->post('name'),
				'surname' => $this->input->post('surname'),
				'email' => $this->input->post('email')
				
			);
			$ucenik = $this->input->post('ucenik');
			
			$this->db->where('id', $ucenik);
			$this->db->update('users', $data);
			
			
			
			$data1 = array(
				
				'odeljenjeId' => $this->input->post('odeljenje')

				
			);
			$odeljenje = $this->input->post('ucenik');
			
			$this->db->where('id', $odeljenje);
			$this->db->update('ucenik', $data1);			
			
			
		}

	
		//Dohvati sve korisnike iz baze 
		public function getUsers(){
			$users = $this->db->get("users");
			return $users;
		}
		
		//Unos casova
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
		
		//Dohvati predmete za skolu kojoj je dodeljen koordinator
		public function listOfStudents($skola) {
			$this->db->where('skolaId',$skola);
			  $query = $this->db->get("predmet");
		   return $query;
		}
		
		//Dohvati nastavnike za skolu kojoj je dodeljen koordinator
		public function getNastavnike($skola){
			
		$this->db->where('skolaId',$skola);
		$query = $this->db->get('nastavnik');

			return $query;
		}
		
		//Dohvati sve korisnike
		public function getNastavnikeForPredmet(){
			$query = $this->db->get('users');
			return $query;
		}
		
		
		//Dohvati sve skole
		public function getSkole(){
			$query = $this->db->get('skola');
			return $query;
		}
		
		//Dohvati sva odeljenja
		public function getOdeljenja(){
			$query = $this->db->get('odeljenje');
			return $query;
		}
		
		//Visak?
		public function getRasporede(){
			$query = $this->db->get_where('raspored',array('brojCasa' => 1 ));
			return $query;
		}
		

		//Visak?
		public function getOdeljenje(){
			$this->db->where('odeljenjeId', '2');
			$this->db->where('dan', 'ponedeljak');
			$query = $this->db->get_where('raspored');
			return $query;
		}
		
		//Dohvati predmete za skolu kojoj je dodeljen koordinator
		public function getPredmete($skola){
			
			$this->db->where('skolaId', $skola);
			$query = $this->db->get('predmet');
			return $query;
		}
		
		//Brisanje izabranog predmeta za skolu kojoj je dodeljen koordinator
		public function brisanjePredmeta($ime,$skola){
			$query = $this->db->get_where('predmet', array('ime' => $ime));
			$query = $this->db->get_where('predmet', array('skolaid' => $skola));
			
			if(empty($query->row_array())){
				return false;
			}
			else{
				$this->db->where('id', $ime);
				$this->db->where('skolaid', $skola);
				$this->db->delete('predmet');
				
				return true;
				
			} 
		}

		//Brisanje izabranog casa
		public function brisanjeCasova($odeljenje,$dan,$cas){
			$query = $this->db->get_where('raspored', array('odeljenjeId' => $odeljenje));
			$query = $this->db->get_where('raspored', array('dan' => $dan));
			$query = $this->db->get_where('raspored', array('brojCasa' => $cas));
	//		$query = $this->db->get_where('predmet', array('skolaid' => $skolaid));
			
			if(empty($query->row_array())){
				return false;
			}
			else{
				$this->db->where('odeljenjeId', $odeljenje);
				$this->db->where('dan', $dan);
				$this->db->where('brojCasa', $cas);
				$this->db->delete('raspored');
				
				return true;
				
			} 
		}		
		
		//Brisanje izabranog naloga nastavnika
		public function brisanjeNaloga($nastavnik){
				
			$query = $this->db->get_where('users', array('id' => $nastavnik));			
	
			if(empty($query->row_array())){
				return false;			
			}
			else{
				$this->db->where('id', $nastavnik);	
				$this->db->delete('users');
				
				$this->db->where('id', $nastavnik);
				$this->db->delete('nastavnik');
				
				return true;				
			} 
		}

		//Brisanje izabranog naloga ucenika
		public function brisanjeNalogaU($ucenik){
				
			$query = $this->db->get_where('users', array('id' => $ucenik));
	
				
	
			if(empty($query->row_array())){
				return false;
			
			}
			else{
				$this->db->where('id', $ucenik);	
				$this->db->delete('users');
				
				$this->db->where('id', $ucenik);
				$this->db->delete('ucenik');
				
				return true;
				
			} 
		}
		
		
		//Dodaj novog nastavnika za skolu kojoj je dodeljen koordinator
		public function dodajNastavnika($enc_password,$skola){
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
			$this->dodajNastavnikaId($id,$skola);
			
			return $id;
		}
		
		//Dodaj novog ucenika za skolu kojoj je dodeljen koordinator
		public function dodajUcenika($enc_password,$skola){
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
			$this->dodajUcenikaId($id,$skola);
			
			return $id;
		}

		//dodaj nastavnika i identifikator skole
		public function dodajNastavnikaId($userid,$skola){
			$dataNastavnik = array(
				'id' => $userid,
				'skolaId' => $skola
				
			);
			
			$this->db->insert('nastavnik', $dataNastavnik);
		}	
		//dodaj nastavnika i identifikator skole
		public function dodajUcenikaId($userid,$skola){
			$dataUcenik = array(
				'id' => $userid,
				'skolaId' => $skola,
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
		//dohvati raspored za zadato odeljenje
		public function dohvati_raspored($odeljenje){
			$this->db->where('odeljenjeId', $odeljenje);
			$query = $this->db->get('raspored');
			$result = $query->result();
			return $result;
		}
		//dohvati ime predmeta
		public function dohvati_ime_predmeta($predmetId){
			$this->db->where('id', $predmetId);
			$query = $this->db->get('predmet');
			$predmet = $query->row();
			$result = $predmet->ime;
			return $result;
		}
		//dohvati oznaku odeljenja
		public function dohvati_oznaku_odeljenja($odeljenjeId){
			if ($odeljenjeId != null){
				$this->db->where('id', $odeljenjeId);
				$query = $this->db->get('odeljenje');
				$odeljenje = $query->row();
				$result = $odeljenje->oznaka;
				return $result;
			}
		}
		//dohvati ime i prezime
		public function dohvati_ime_i_prezime($user_id){
		$this->db->where('id',$user_id);
		$query = $this->db->get('users');
		return $query->row();
	}
		//dohvati skolu koordinatora
		public function getSkolaKoord($user_id){
		$this->db->where('id',$user_id);
		$query = $this->db->get('koordinator');
				$koordinator = $query->row();
				$result = $koordinator->skolaId;
				return $result;
	}	

	}