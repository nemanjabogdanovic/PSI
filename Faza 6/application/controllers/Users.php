<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php 
	class Users extends CI_Controller{
		//registracija korisnika
		public function register(){
			$data['title'] = 'Registracija';
			
			$this->form_validation->set_rules('name', 'Ime', 'required');
			$this->form_validation->set_rules('surname', 'Prezime', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('username', 'KorisnickoIme', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Sifra', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			}
			else{
				$enc_password = md5($this->input->post('password'));
				$this->user_model->register($enc_password);
				
				$this->session->set_flashdata('user_registered', 'Uspesno unet nalog');
				
				redirect('users/login');
			}
		}
		//logovanje korisnika
		public function login(){
			$data['title'] = 'Login';
			
			$this->form_validation->set_rules('username', 'KorisnickoIme', 'required');
			$this->form_validation->set_rules('password', 'Sifra', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			}
			else{
				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));
				$user_id = $this->user_model->login($username, $password);
				$user_level = $this->user_model->userLevel($user_id);
				
				if($user_id){
					$user_data = array(
						'user_id' => $user_id,
						'username' => $username,
						'logged_in' => true,
						'user_level' => $user_level
					);
					
					$this->session->set_userdata($user_data);
					
					$this->session->set_flashdata('user_loggedin', 'Uspesan login');
					redirect('users/login');					
				}
				else{
					$this->session->set_flashdata('login_failed', 'Pogresan login');
					redirect('users/login');
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
			$this->form_validation->set_message('check_username_exists', 'Korisnicko ime je zauzeto');
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