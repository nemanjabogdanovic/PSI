<!--
	autor: Nemanja Bogdanovic, 2012/0533
-->
<?php
	/**
	*	User_model - klasa modela za logovanje registrovanog korisnika, slanja nove lozinke na e-mail i promene lozinke
	*
	*	@version 1.0
	*/
	class User_model extends CI_Model{
		/**
		*	Konstruktor klase, ucitava bazu podataka
		*/
		public function __construct(){
			$this->load->database();
		}
		/**
		*	Login korisnika
		*	
		*	@param string $username - korisnicko ime
		*	@param string $password - lozinka
		*
		*	@return int || boolean
		*/
		public function login($username, $password){
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			/**
			*	@var array $result - rezultat pretrage tabele users za dat username i password
			*/
			$result = $this->db->get('users');
			
			if($result->num_rows() == 1){
				return $result->row(0)->id;
			}
			else{
				return false;
			}
		}
		/**
		*	Provera nivoa korisnika
		*
		*	@param int $id - id korisnika za koga vracamo nivoa
		*
		*	@return string
		*/
		public function userLevel($id){
			$this->db->where('id', $id);
			/**
			*	@var array $result - rezultat pretrage tabela administrator, koordinator, nastavnik ili ucenik za dat id
			*/
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
		/**
		*	Promena lozinke
		*
		*	@param string $enc_password_old - trenutna lozinka ulogovanog korisnika
		*	@param string $enc_password_new - nova zeljena lozinka
		*
		*	@return boolean
		*/
		public function reset($enc_password_old, $enc_password_new){
			/**
			*	@var string $username - korisnicko ime trenutnog ulogovanog korisnika
			*/
			$username = $this->session->userdata('username');
			
			$this->db->where('username', $username);
			$this->db->where('password', $enc_password_old);
			/**
			*	@var array $result - rezultat pretrage tabele users za dat username i password
			*/
			$result = $this->db->get('users');
			/**
			*	@var array $new - postavka nove lozinke
			*/
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
		/**
		*	Provera da li je email vezan za neki nalog pri zaboravljenoj lozinci
		*
		*	@param string $email - email adresa koju treba proveriti
		*
		*	@return boolean
		*/
		public function checkEmail($email){
			/**
			*	@var array $result - rezultat pretrage tabele users za datu email adresu
			*/
			$result = $this->db->get_where('users', array('email' => $email));
			if(empty($result->row_array())){
				return false;
			}
			else{
				return true;
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
		
	}