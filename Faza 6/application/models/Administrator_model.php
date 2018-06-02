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
		//dodaj novu skolu
		public function novaSkola(){
			$data = array(
				'ime' => $this->input->post('ime'),
				'adresa' => $this->input->post('adresa'),
				'grad' => $this->input->post('grad')
			);
			
			return $this->db->insert('skola', $data);
		}
		//uzmi skole iz baze
		public function getSkole(){
			$query = $this->db->get("skola");
			return $query;
		}
		//uzmi skolu sa datim id iz baze
		public function getSkolaPrekoId($id){
			$this->db->where('id', $id);
			$query = $this->db->get('skola');
			$result = array (
				'ime' => $query->row(0)->ime,
				'adresa' => $query->row(0)->adresa,
				'grad' => $query->row(0)->grad
			);
			
			$data = array(
				'id' => $id
			);
			
			$this->db->empty_table('help');
			$this->db->insert('help', $data);
			
			return $result;
		}
		//izmeni skolu
		public function updateSkolu(){
			$data = array(
				'ime' => $this->input->post('ime'),
				'adresa' => $this->input->post('adresa'),
				'grad' => $this->input->post('grad')
			);
			
			$id_help = $this->db->get('help');
			$id = $id_help->row(0)->id;
			
			$this->db->where('id', $id);
			$this->db->update('skola', $data);		
		}
		//dodaj novog koordinatora
		public function dodajKoordinatora($enc_password){
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
			$this->dodajKoordinatoraId($id);
			
			return $id;
		}
		//dodaj koordinatora i identifikator skole
		public function dodajKoordinatoraId($userid){
			$dataKoordinator = array(
				'id' => $userid,
				'skolaId' => $this->input->post('skola')
			);
			
			$this->db->insert('koordinator', $dataKoordinator);
		}		
		//uzmi skole iz baze
		public function getKoordinatorIds(){
			$koordinator = $this->db->get("koordinator");
			return $koordinator;
		}
		//uzmi korisnike iz baze 
		public function getUsers(){
			$users = $this->db->get("users");
			return $users;
		}
		//izmeni koordinatora
		public function updateKoordinatora(){
			$data = array(
				'name' => $this->input->post('name'),
				'surname' => $this->input->post('surname'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
			);
			
			$id_help = $this->db->get('help');
			$id = $id_help->row(0)->id;
			
			$this->db->where('id', $id);
			$this->db->update('users', $data);		
		}
		//uzmi koordinatora sa datim id iz baze
		public function getKoordinatoraPrekoId($id){
			$this->db->where('id', $id);
			$query = $this->db->get('users');
			$result = array (
				'name' => $query->row(0)->name,
				'surname' => $query->row(0)->surname,
				'email' => $query->row(0)->email,
				'username' => $query->row(0)->username
			);
			
			$data = array(
				'id' => $id
			);
			
			$this->db->empty_table('help');
			$this->db->insert('help', $data);
			
			return $result;
		}
	}