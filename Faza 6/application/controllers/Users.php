<!--
	autor: Nemanja Bogdanovic, 2012/0533
-->
<?php 
	class Users extends CI_Controller{
		//logovanje korisnika
		public function login(){
			$data['title'] = 'Login';
			
			
			$this->form_validation->set_rules('username', 'KorisnickoIme', 'required');
			$this->form_validation->set_rules('password', 'Lozinka', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			}
			else{
				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));
				$user_id = $this->user_model->login($username, $password);
				
				if($user_id){
					$user_level = $this->user_model->userLevel($user_id);
					
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
		//resetovanje sifre
		public function reset(){
			$data['title'] = 'Promena lozinke';
			
			$this->form_validation->set_rules('old_password', 'Stara Lozinka', 'required');
			$this->form_validation->set_rules('new_password', 'Nova Lozinka', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/reset', $data);
				$this->load->view('templates/footer');
			}
			else{
				$enc_password_old = md5($this->input->post('old_password'));
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
		//zaboravljena sifra
		public function forgotten(){
			$data['title'] = 'Zaboravljena lozinka';
			
			$this->form_validation->set_rules('email', 'Email', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/forgotten', $data);
				$this->load->view('templates/footer');
			}
			else{
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
		//logout korisnika
		public function logout(){
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('user_level');
			
			$this->session->set_flashdata('user_loggedout', 'Uspesan logout');
			redirect('users/login');
			
		}
		//provera da li je korisnicko ime u upotrebi pri registraciji korisnika
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'Korisničko ime je zauzeto');
			if($this->user_model->check_username_exists($username)){
				return true;
			}
			else {
				return false;
			}
		}
		//provera da li je email u upotrebi pri registraciji korisnika
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'Email je u upotrebi');
			if($this->user_model->check_email_exists($email)){
				return true;
			}
			else {
				return false;
			}
		}
	}