<!--
	autor: Nemanja Bogdanovic, 2012/0533
-->
<?php 
	/**
	*	Users - klasa za logovanje registrovanog korisnika, slanja nove lozinke na e-mail i promene lozinke
	*
	*	@version 1.0
	*/
	class Users extends CI_Controller{
		/**
		*	Logovanje korisnika, postavljanje session userdata i preusmeravanje na specificnu pocetnu stranicu
		*/
		public function login(){
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Login';
			
			$this->form_validation->set_rules('username', 'KorisnickoIme', 'required');
			$this->form_validation->set_rules('password', 'Lozinka', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			}
			else{
				/**
				*	@var string $username - korisnicko ime pravilno uneseno u formu
				*/
				$username = $this->input->post('username');
				/**
				*	@var string $password - lozinka pravilno unesena u formu
				*/
				$password = md5($this->input->post('password'));
				/**
				*	@var string $user_id - id korisnika iz tabele users 
				*/
				$user_id = $this->user_model->login($username, $password);
				
				if($user_id){
					/**
					*	@var string $user_level - nivo korisnika
					*/
					$user_level = $this->user_model->userLevel($user_id);
					/**
					*	@var array $user_data(string, string, boolean, string) - postavka userdata
					*/
					$user_data = array(
						'user_id' => $user_id,
						'username' => $username,
						'logged_in' => true,
						'user_level' => $user_level
					);
					
					$this->session->set_userdata($user_data);
					$this->session->set_flashdata('user_loggedin', 'Uspešan login');
					redirect($user_level);
				}
				else{
					$this->session->set_flashdata('login_failed', 'Pogrešan login');
					redirect('users/login');
				}
			}
		}
		/**
		*	Funkcija promene lozinke
		*/
		public function reset(){
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Promena lozinke';
			
			$this->form_validation->set_rules('old_password', 'Stara Lozinka', 'required');
			$this->form_validation->set_rules('new_password', 'Nova Lozinka', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/reset', $data);
				$this->load->view('templates/footer');
			}
			else{
				/**
				*	@var string $enc_password_old - md5 enkriptovana trenutna lozinka korisnika
				*/
				$enc_password_old = md5($this->input->post('old_password'));
				/**
				*	@var string $enc_password_new - md5 enkriptovana nova zeljena lozinka korisnika
				*/
				$enc_password_new = md5($this->input->post('new_password'));
				
				if(!$this->user_model->reset($enc_password_old, $enc_password_new)){
					$this->session->set_flashdata('reset_failed', 'Stara lozinka nije ispravna!');
					redirect('users/reset');
				}
				else{
					$this->session->set_flashdata('reset_success', 'Uspešno promenjena lozinka!');
					redirect($this->session->userdata('user_level'));
				}
			}
		}
		/**
		*	Funkcija sistema zaboravljene sifre - salje novu lozinku na unetu e-mail adresu
		*/
		public function forgotten(){
			/**
			*	@var string $data['title'] - prosledjivanje naziva stranice
			*/
			$data['title'] = 'Zaboravljena lozinka';
			
			$this->form_validation->set_rules('email', 'Email', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/forgotten', $data);
				$this->load->view('templates/footer');
			}
			else{
				/**
				*	@var string $email - e-mail adresa na koju treba poslati novu lozinku (ukoliko je u sistemu)
				*/
				$email = $this->input->post('email');
				if($this->user_model->checkEmail($email)){
					$this->session->set_flashdata('forgotten_success', 'Nova lozinka poslata na e-mail!');
					redirect('users/login');
				}
				else{
					$this->session->set_flashdata('forgotten_fail', 'Pogrešno unet e-mail!');
					redirect('users/forgotten');
				}
			}
		}
		/**
		*	Funkcija za logout korisnika, vraca korisnika na pocetnu stranicu i brise userdata podatke
		*/
		public function logout(){
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('user_level');
			
			$this->session->set_flashdata('user_loggedout', 'Uspešan logout');
			redirect('users/login');
		}
	}