<?php
	class Nastavnik_model extends CI_Model{
		//konstruktor
		public function __construct(){
			$this->load->database();
		}

    //ovde moramo izbaciti spisak svih ucenika iz baze

    public function listOfStudents() {
      $query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id FROM users, ucenik WHERE users.id = ucenik.id" );
			return $query;
    }


	}
