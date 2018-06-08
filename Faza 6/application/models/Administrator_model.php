<!--
	autor: Nemanja Bogdanovic, 2012/0533
-->
<?php
	/**
	*	Administrator_model - klasa modela svih funkcija Administratora
	*
	*	@version 1.0
	*/
	class Administrator_model extends CI_Model{
		/**
		*	Konstruktor klase, ucitava bazu podataka
		*/
		public function __construct(){
			$this->load->database();
		}
		/**
		*	Dohvati sve vesti vezane samo za administratore
		*
		*	@return array
		*/
		public function getVesti(){
			$this->db->where('skolaId', 0);
			/**
			*	@var array $result - rezultat pretrage tabele vesti za dat skolaId
			*/
			$result = $this->db->get('vesti');
			return $result->result_array();
		}
		/**
		*	Funkcija dodavanja nove vesti
		*
		*	@return boolean
		*/
		public function novaVest(){
			/**
			*	@var array $data - postavka podataka nove vesti za bazu 
			*/
			$data = array(
				'naslov' => $this->input->post('naslov'),
				'text' => $this->input->post('text'),
				'userLevel' => $this->session->userdata('user_level'),
				'skolaId' => 0
			);
			
			return $this->db->insert('vesti', $data);
		}
		/**
		*	Brisanje svih vesti (samo od strane Administratorskih naloga)
		*/
		public function deleteVesti(){
			$this->db->where('userLevel', $this->session->userdata('user_level'));
			$this->db->delete('vesti');
		}
		/**
		*	Funkcija unosa nove skole u bazu
		*
		*	@return boolean
		*/
		//dodaj novu skolu
		public function novaSkola(){
			/**
			*	@var array $data - postavka podataka nove skole za bazu 
			*/
			$data = array(
				'ime' => $this->input->post('ime'),
				'adresa' => $this->input->post('adresa'),
				'grad' => $this->input->post('grad')
			);
			
			return $this->db->insert('skola', $data);
		}
		/**
		*	Dohvatanje liste svih skola unetih u bazu podataka
		*
		*	@return array
		*/
		public function getSkole(){
			/**
			*	@var array $result - rezultat selekcije tabele skola
			*/
			$result = $this->db->get("skola");
			return $result;
		}
		/**
		*	Dohvatanje skole sa datim id skole iz baze
		*
		*	@param int $id - id skole koju treba dohvatiti
		*/
		public function getSkolaPrekoId($id){
			$this->db->where('id', $id);
			/**
			*	@var array $query - rezultat selekcije tabele skola
			*/
			$query = $this->db->get('skola');
			/**
			*	@var array $result - rezultujuci niz sa podacima zeljene skole
			*/
			$result = array (
				'ime' => $query->row(0)->ime,
				'adresa' => $query->row(0)->adresa,
				'grad' => $query->row(0)->grad
			);
			/**
			*	@var array $data - pomocna promenjiva
			*/
			$data = array(
				'id' => $id
			);
			
			$this->db->empty_table('help');
			$this->db->insert('help', $data);
			
			return $result;
		}
		/**
		*	Izmena podataka tabele za odabranu skolu
		*/
		public function updateSkolu(){
			/**
			*	@var array $data - postavka novih podataka za skolu
			*/
			$data = array(
				'ime' => $this->input->post('ime'),
				'adresa' => $this->input->post('adresa'),
				'grad' => $this->input->post('grad')
			);
			/**
			*	@var int $id_help - pomocna promenjiva iz tabele help
			*/
			$id_help = $this->db->get('help');
			/**
			*	@var int $id - odabrani id skole pomocu promenjive $id_help
			*/
			$id = $id_help->row(0)->id;
			
			$this->db->where('id', $id);
			$this->db->update('skola', $data);		
		}
		/**
		*	Dodavanje novog korisnika (Koordinatora) u bazu podataka
		*
		*	@param string $enc_password - enrkiptovana lozinka za novi nalog
		*
		*	@return int
		*/
		public function dodajKoordinatora($enc_password){
			/**
			*	@var array $data - postavka podataka za novog korisnika (Koordinatora)
			*/
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
			/**
			*	@var array $result - rezultat selekcije iz tabele users
			*/
			$result = $this->db->get('users');
			/**
			*	@var int $id - id novog koordinatora unetog u bazu
			*/
			$id = $result->row(0)->id;
			$this->dodajKoordinatoraId($id);
			
			return $id;
		}
		/**
		*	Dodavanje (dodeljivanje) skole koordinatoru 
		*
		*	@param int $userid - id koordinatora
		*/
		public function dodajKoordinatoraId($userid){
			/**
			*	@var array $data - postavka podataka za unos u tabelu skola
			*/
			$data = array(
				'id' => $userid,
				'skolaId' => $this->input->post('skola')
			);
			
			$this->db->insert('koordinator', $data);
		}		
		/**
		*	Dohvatanje koordinatora iz baze podataka
		*
		*	@return array
		*/
		//uzmi skole iz baze
		public function getKoordinatorIds(){
			/**
			*	@var array $result - rezultat selekcije iz tabele koordinator
			*/
			$result = $this->db->get("koordinator");
			return $result;
		}
		/**
		*	Dohvatanje korisnika iz baze podataka
		*/
		public function getUsers(){
			/**
			*	@var array $result - rezultat selekcije iz tabele users
			*/
			$result = $this->db->get("users");
			return $result;
		}
		/**
		*	Izmena podataka odabranog korisnika (Koordinatora)
		*/
		public function updateKoordinatora(){
			/**
			*	@var array $data - postavka podataka za unos u tabelu korisnika
			*/
			$data = array(
				'name' => $this->input->post('name'),
				'surname' => $this->input->post('surname'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
			);
			/**
			*	@var int $id_help - pomocna promenjiva iz tabele help
			*/
			$id_help = $this->db->get('help');
			/**
			*	@var int $id - odabrani id koordinatora pomocu promenjive $id_help
			*/
			$id = $id_help->row(0)->id;
			
			$this->db->where('id', $id);
			$this->db->update('users', $data);		
		}
		/**
		*	Dohvatanje podataka koordinatora preko datog id korisnika
		*
		*	@param int $id - id koordinatora 
		*/
		public function getKoordinatoraPrekoId($id){
			$this->db->where('id', $id);
			/**
			*	@var array $query - rezultat selekcije iz tabele users sa datim id
			*/
			$query = $this->db->get('users');
			if($query->num_rows() == 1){
				/**
				*	@var array $result - rezultat pretrage, podaci trazenog koordinatora
				*/
				$result = array (
					'name' => $query->row(0)->name,
					'surname' => $query->row(0)->surname,
					'email' => $query->row(0)->email,
					'username' => $query->row(0)->username
				);
				/**
				*	@var array $data - pomocna promenjiva
				*/
				$data = array(
					'id' => $id
				);
				
				$this->db->empty_table('help');
				$this->db->insert('help', $data);
				
				return $result;
			}
		}
	}