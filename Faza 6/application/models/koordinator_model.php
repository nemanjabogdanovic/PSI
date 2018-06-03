<!--
	autor: Markovic Milos, 0097/2012
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
		

	}