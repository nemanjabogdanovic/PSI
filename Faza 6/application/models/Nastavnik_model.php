<?php
	class Nastavnik_model extends CI_Model{
		//konstruktor
		public function __construct(){
			$this->load->database();
		}

		//ovde moramo izbaciti spisak svih ucenika iz baze



		public function listaOdeljenja() {
			$query = $this->db->query("SELECT odeljenje.oznaka, odeljenje.id FROM odeljenje");
			return $query;
		}

		public function listaSkola() {
			$query = $this->db->query("SELECT skola.ime, skola.id FROM skola");
			return $query;
		}

		public function dohvati() {
		$user_id = $this->session->userdata('user_id');
		$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka, odeljenje.id,
																			skola.ime
																			FROM skola, users, ucenik, odeljenje, nastavnik
																			WHERE ucenik.skolaId = skola.id
																			AND users.id = ucenik.id
																			AND ucenik.odeljenjeId = odeljenje.id
																			AND nastavnik.id = '{$user_id}'
																			AND ucenik.skolaId = nastavnik.skolaId"  );

					if (isset($_POST['search'])) {

						//ako su popunjene sve 3
							if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['odeljenje'])) {
						$novoIme = $_POST['name'];
						$novoPrezime = $_POST['surname'];
						$novoOdeljenje = $_POST['odeljenje'];

						$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id
																				FROM skola, users, ucenik, odeljenje, nastavnik WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
																				AND ucenik.skolaId = skola.id  AND  users.surname = '{$novoPrezime}' AND  users.name = '{$novoIme}'
																				AND  odeljenje.id = '{$novoOdeljenje}'
																				AND nastavnik.id = '{$user_id}'
																				AND ucenik.skolaId = nastavnik.skolaId" );

						}


							//ime, Prezime

									else if (!empty($_POST['name']) && !empty($_POST['surname']) ) {
											$novoIme = $_POST['name'];
											$novoPrezime = $_POST['surname'];

											$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id
																																	FROM skola, users, ucenik, odeljenje, nastavnik
																																	WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
																																	AND ucenik.skolaId = skola.id
																																	AND  users.surname = '{$novoPrezime}'
																																	AND  users.name = '{$novoIme}'
																																	AND nastavnik.id = '{$user_id}'
																																	AND ucenik.skolaId = nastavnik.skolaId" );

																																	}


//ime, odeljenje
							else if (!empty($_POST['name']) && !empty($_POST['odeljenje']) ) {
							$novoIme = $_POST['name'];

							$novoOdeljenje = $_POST['odeljenje'];

						 $query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id
												FROM skola, users, ucenik, odeljenje,nastavnik WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
												AND ucenik.skolaId = skola.id
												AND  users.name = '{$novoIme}'
												AND  odeljenje.id = '{$novoOdeljenje}'
												AND nastavnik.id = '{$user_id}'
												AND ucenik.skolaId = nastavnik.skolaId" );

}


//prezime, odeljenje

						else if (!empty($_POST['surname']) && !empty($_POST['odeljenje'])) {

								$novoPrezime = $_POST['surname'];
								$novoOdeljenje = $_POST['odeljenje'];

								$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id
									 FROM skola, users, ucenik, odeljenje, nastavnik WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
												AND ucenik.skolaId = skola.id  AND  users.surname = '{$novoPrezime}'
												AND  odeljenje.id = '{$novoOdeljenje}' AND nastavnik.id = '{$user_id}'
												AND ucenik.skolaId = nastavnik.skolaId'" );
}



else if (!empty($_POST['name'])) {
$novoIme = $_POST['name'];

$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id
												FROM nastavnik, skola, users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
												AND ucenik.skolaId = skola.id   AND  users.name = '{$novoIme}' AND nastavnik.id = '{$user_id}'
												AND ucenik.skolaId = nastavnik.skolaId" );
}

else if (!empty($_POST['surname'])) {
$novoPrezime = $_POST['surname'];
$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM nastavnik, skola,users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
														AND ucenik.skolaId = skola.id AND  users.surname = '{$novoPrezime}' AND nastavnik.id = '{$user_id}'
														AND ucenik.skolaId = nastavnik.skolaId" );

}
else if (!empty($_POST['odeljenje'])) {
$novoOdeljenje = $_POST['odeljenje'];
$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM nastavnik, skola,users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
														AND ucenik.skolaId = skola.id AND  odeljenje.id = '{$novoOdeljenje}' AND nastavnik.id = '{$user_id}'
														AND ucenik.skolaId = nastavnik.skolaId" );

}

}



	return $query;
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
		//dohvati id skole trenutnog nastavnika
		public function getSkolaId($id){
			$this->db->where('id', $id);
			$result = $this->db->get('nastavnik');
			return $result->row(0)->skolaId;
		}




		public function dohvatiOdeljenje() {
			$user_id = $this->session->userdata('user_id');
			$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,odeljenje.oznaka,
																				skola.ime
																 FROM skola, users, ucenik, odeljenje, nastavnik
																 WHERE ucenik.skolaId = skola.id
																 AND users.id = ucenik.id
																 AND ucenik.odeljenjeId = odeljenje.id
																 AND nastavnik.id = '{$user_id}'
																 AND ucenik.skolaId = nastavnik.skolaId"

															 );

			if (isset($_POST['search1'])) {

			if (!empty($_POST['od'])) {
					$novoOdeljenje = $_POST['od'];
			    $user_id = $this->session->userdata('user_id');
					$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime
																			FROM skola,users, ucenik, odeljenje, nastavnik
																			WHERE users.id = ucenik.id
																			AND ucenik.odeljenjeId = odeljenje.id
																			AND ucenik.skolaId = skola.id
																			AND nastavnik.id = '{$user_id}'
																			AND odeljenje.id = '{$novoOdeljenje}'
																			AND ucenik.skolaId = nastavnik.skolaId" );

					}


		}

			return $query;
	}





		public function unosIzostanka(){
				if (isset($_POST['search_izostanak'])) {

					if (!empty($_POST['iz'])) {$idUcenika = $_POST['iz'];};

					$postojiIzostanak = $this->db->query("SELECT izostanci.id, izostanci.ucenikId, izostanci.brojIzostanaka, ucenik.id FROM izostanci, ucenik WHERE izostanci.ucenikId = '{$idUcenika}' ");



					if ($postojiIzostanak->num_rows() == 0) {

						$data = array(
									'id' => 0,
									'ucenikId' => $idUcenika,
									'brojIzostanaka' => 1,
						);

			    return $this->db->insert('izostanci', $data);



		}
		else {
  		return $this->db->query("UPDATE izostanci SET  brojIzostanaka = brojIzostanaka + 1 WHERE ucenikId = $idUcenika");
		}
		}
	}

	public function dohvati_raspored(){
		$user_id = $this->session->userdata('user_id');
		$this->db->where('nastavnikId', $user_id);
		$query = $this->db->get('raspored');
		$result = $query->result();
		return $result;
	}

	public function dohvati_ime_predmeta($predmetId){
		$this->db->where('id', $predmetId);
		$query = $this->db->get('predmet');
		$predmet = $query->row();
		$result = $predmet->ime;
		return $result;

	}

	public function dohvati_oznaku_odeljenja($odeljenjeId){
		$this->db->where('id', $odeljenjeId);
		$query = $this->db->get('odeljenje');
		$odeljenje = $query->row();
		$result = $odeljenje->oznaka;
		return $result;
	}



	public function upisCasa() {
			$user_id = $this->session->userdata('user_id');
      $query = $this->db->query("SELECT predmet.ime, predmet.id FROM predmet, nastavnik WHERE nastavnik. id = '{$user_id}' AND predmet.nastavnik = '{$user_id}' AND predmet.skolaId = nastavnik.skolaId ");
			if(isset($_POST['upisiCas'])) {


				$data = array(
					'predmetId' => $_POST['predmet'],
					'tema' => $_POST['temaCasa'],
					'redniBroj' => $_POST['redniBroj'],
					'komentari' => $_POST['komentar'],
				 );

       $query = $this->db->insert('cas', $data);
			 $query = $this->db->query("SELECT predmet.ime, predmet.id FROM predmet, nastavnik WHERE nastavnik. id = '{$user_id}' AND predmet.nastavnik = '{$user_id}' AND predmet.skolaId = nastavnik.skolaId ");

			}

			return $query;

	}
	
	public function dohvati_ime_i_prezime($user_id){
		$this->db->where('id',$user_id);
		$query = $this->db->get('users');
		return $query->row();
	}



}
