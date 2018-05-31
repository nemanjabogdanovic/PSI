<!--
	autor: Markovic Milos, 0097/2012
	@version: 1.0
-->
<?php
	class koordinator_model extends CI_Model{
		//konstruktor
		public function __construct(){
			$this->load->database();
		}
		//registracija korisnika
		public function unosPredmeta(){
			$data = array(
				'ime' => $this->input->post('ime'),
				'nastavnik' => $this->input->post('nastavnik'),
				'skolskaGodina' => $this->input->post('skolskaGodina'),
				'kabineti' => $this->input->post('kabineti'),
			);
			
			return $this->db->insert('predmet', $data);
		}

	}