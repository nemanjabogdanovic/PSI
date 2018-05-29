<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php
	class User_model extends CI_Model{
		//konstruktor
		public function __construct(){
			$this->load->database();
		}
		//registracija korisnika
		public function register($enc_password){
			$data = array(
				'name' => $this->input->post('name'),
				'surname' => $this->input->post('surname'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => $enc_password
			);
			
			return $this->db->insert('users', $data);
		}
		//logovanje korisnika
		public function login($username, $password){
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			
			$result = $this->db->get('users');
			
			if($result->num_rows() == 1){
				return $result->row(0)->id;
			}
			else{
				return false;
			}
		}
		//provera nivoa korisnika
		public function userLevel($id){
			$this->db->where('id', $id);
			$result = $this->db->get('administrator');
			if($result->num_rows() == 1){
				return 'administrator';
			}
			
			$this->db->where('id', $id);
			$result = $this->db->get('koordinator');
			if($result->num_rows() == 1){
				return 'koordinator';
			}
			
			$this->db->where('id', $id);
			$result = $this->db->get('nastavnik');
			if($result->num_rows() == 1){
				return 'nastavnik';
			}
			
			$this->db->where('id', $id);
			$result = $this->db->get('ucenik');
			if($result->num_rows() == 1){
				return 'ucenik';
			}
			
			return false;
		}
		//resetovanje sifre
		public function reset($enc_password_old, $enc_password_new){
			$username = $this->session->userdata('username');
			
			$this->db->where('username', $username);
			$this->db->where('password', $enc_password_old);
			
			$result = $this->db->get('users');
			
			$new = array('password' => $enc_password_new);
			
			if($result->num_rows() == 1){
				$this->db->where('username', $username);
				$this->db->update('users', $new);
				return true;
			}
			else{
				return false;
			}
		}
		//provera da li je korisnicko ime u upotrebi pri registraciji korisnika
		public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));
			if(empty($query->row_array())){
				return true;
			}
			else{
				return false;
			} 
		}
		//provera da li je email u upotrebi pri registraciji korisnika
		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));
			if(empty($query->row_array())){
				return true;
			}
			else{
				return false;
			} 
		}
	}