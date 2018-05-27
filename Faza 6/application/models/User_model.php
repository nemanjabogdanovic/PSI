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