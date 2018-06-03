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

			$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka, odeljenje.id,
																				skola.ime FROM skola, users, ucenik, odeljenje WHERE ucenik.skolaId = skola.id AND users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id" );

						if (isset($_POST['search'])) {

							//ako su popunjene sve 4
								if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['odeljenje']) && !empty($_POST['skola']) ) {
							$novoIme = $_POST['name'];
							$novoPrezime = $_POST['surname'];
							$novoOdeljenje = $_POST['odeljenje'];
							$novaSkola = $_POST['skola'];
							$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola, users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
																					AND ucenik.skolaId = skola.id  AND  users.surname = '{$novoPrezime}' AND  users.name = '{$novoIme}'
																					AND  odeljenje.id = '{$novoOdeljenje}'
																					AND  ucenik.skolaId = '{$novaSkola}'" );

							}


          //ime, prezime, skola
						else if  (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['skola']) ) {
					$novoIme = $_POST['name'];
					$novoPrezime = $_POST['surname'];

					$novaSkola = $_POST['skola'];
					$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola, users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
																			AND ucenik.skolaId = skola.id  AND  users.surname = '{$novoPrezime}' AND  users.name = '{$novoIme}'
																		AND  ucenik.skolaId = '{$novaSkola}'" );
				}

				//ime, prezime, odeljenje
					else if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['odeljenje'])) {
				$novoIme = $_POST['name'];
				$novoPrezime = $_POST['surname'];
				$novoOdeljenje = $_POST['odeljenje'];

				$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola, users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
																		AND ucenik.skolaId = skola.id  AND  users.surname = '{$novoPrezime}' AND  users.name = '{$novoIme}'
																		AND  odeljenje.id = '{$novoOdeljenje}'" );
			}

			//ime, skola, odeljenje
			else if (!empty($_POST['name']) && !empty($_POST['odeljenje']) && !empty($_POST['skola']) ) {
		$novoIme = $_POST['name'];

		$novoOdeljenje = $_POST['odeljenje'];
		$novaSkola = $_POST['skola'];
		$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola, users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
																AND ucenik.skolaId = skola.id  AND  users.name = '{$novoIme}'
																AND  odeljenje.id = '{$novoOdeljenje}'
																AND  ucenik.skolaId = '{$novaSkola}'" );
	}
 //prezime, skola, odeljenje
	else if (!empty($_POST['surname']) && !empty($_POST['odeljenje']) && !empty($_POST['skola']) ) {

$novoPrezime = $_POST['surname'];
$novoOdeljenje = $_POST['odeljenje'];
$novaSkola = $_POST['skola'];
$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola, users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
														AND ucenik.skolaId = skola.id  AND  users.surname = '{$novoPrezime}'
														AND  odeljenje.id = '{$novoOdeljenje}'
														AND  ucenik.skolaId = '{$novaSkola}'" );
}

//ime, Prezime

else if (!empty($_POST['name']) && !empty($_POST['surname']) ) {
$novoIme = $_POST['name'];
$novoPrezime = $_POST['surname'];

$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola, users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
													AND ucenik.skolaId = skola.id  AND  users.surname = '{$novoPrezime}' AND  users.name = '{$novoIme}'" );

}

//ime, skola
else if (!empty($_POST['name']) &&  !empty($_POST['skola']) ) {
$novoIme = $_POST['name'];
$novaSkola = $_POST['skola'];
$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola, users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
													AND ucenik.skolaId = skola.id  AND  users.name = '{$novoIme}'
													AND  ucenik.skolaId = '{$novaSkola}'" );

}
//ime, odeljenje
else if (!empty($_POST['name']) && !empty($_POST['odeljenje']) ) {
$novoIme = $_POST['name'];

$novoOdeljenje = $_POST['odeljenje'];

$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola, users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
													AND ucenik.skolaId = skola.id  AND  users.name = '{$novoIme}'
													AND  odeljenje.id = '{$novoOdeljenje}'" );

}

//prezime, skola
else if ( !empty($_POST['surname']) &&  !empty($_POST['skola']) ) {

$novoPrezime = $_POST['surname'];
$novaSkola = $_POST['skola'];

$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola, users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
													AND ucenik.skolaId = skola.id  AND  users.surname = '{$novoPrezime}'
										 		  AND  ucenik.skolaId = '{$novaSkola}'" );
}
//prezime, odeljenje

else if (!empty($_POST['surname']) && !empty($_POST['odeljenje'])) {

$novoPrezime = $_POST['surname'];
$novoOdeljenje = $_POST['odeljenje'];
$novaSkola = $_POST['skola'];
$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola, users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
													AND ucenik.skolaId = skola.id  AND  users.surname = '{$novoPrezime}'
													AND  odeljenje.id = '{$novoOdeljenje}'" );
}

//skola, odeljenje
else if  (!empty($_POST['odeljenje']) && !empty($_POST['skola']) ) {

$novoOdeljenje = $_POST['odeljenje'];
$novaSkola = $_POST['skola'];
$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola, users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
													AND ucenik.skolaId = skola.id
													AND  odeljenje.id = '{$novoOdeljenje}'
													AND  ucenik.skolaId = '{$novaSkola}'" );
}

else if (!empty($_POST['name'])) {
$novoIme = $_POST['name'];

$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola, users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
													AND ucenik.skolaId = skola.id   AND  users.name = '{$novoIme}'" );
}

else if (!empty($_POST['surname'])) {
	$novoPrezime = $_POST['surname'];
	$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola,users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
															AND ucenik.skolaId = skola.id AND  users.surname = '{$novoPrezime}'" );

	}
else if (!empty($_POST['odeljenje'])) {
	$novoOdeljenje = $_POST['odeljenje'];
	$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola,users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
															AND ucenik.skolaId = skola.id AND  odeljenje.id = '{$novoOdeljenje}'" );

	}
else 	if (!empty($_POST['odeljenje'])) {
		$novoOdeljenje = $_POST['odeljenje'];
		$query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola,users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
																AND ucenik.skolaId = skola.id AND  odeljenje.id = '{$novoOdeljenje}'" );

		}
 else if (!empty($_POST['skola'])) {
		 $novaSkola = $_POST['skola'];
		 $query = $this->db->query("SELECT users.id,users.name,users.surname,users.username,users.email,ucenik.id,odeljenje.oznaka,skola.ime, odeljenje.id FROM skola,users, ucenik, odeljenje WHERE users.id = ucenik.id AND ucenik.odeljenjeId = odeljenje.id
															 AND ucenik.skolaId = skola.id	AND  ucenik.skolaId = '{$novaSkola}'" );

		 }
}



		return $query;
	}
}
