<?php
	/*
	autor: Nemanja Bogdanovic, 2012/0533
	@version 1.0
	*/
	
	class Login extends CI_Controller{
		//stranica
		public function view($page = 'login'){
			if(!file_exists(APPPATH.'views/login/'.$page.'.php')){
				show_404();
			}
			
			$data['title'] = ucfirst($page);
			
			$this->load->view('templates/header');
			$this->load->view('login/'.$page, $data);
			$this->load->view('templates/footer');
		}
		
		//login
		/*
		public function login(){
			$data['title'] = 'Sign In';
			$this->form_validation->set_rules('korisnickoIme', 'Korisnicko_Ime', 'required');
			$this->form_validation->set_rules('sifra', 'Sifra', 'required');
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('login/login', $data);
				$this->load->view('templates/footer');
			} else {
				
				// Get username
				$username = $this->input->post('korisnickoIme');
				// Get and encrypt the password
				$password = md5($this->input->post('sifra'));
				// Login user
				$user_id = $this->user_model->login($username, $password);
				if($user_id){
					// Create session
					$user_data = array(
						'idKorisnika' => $user_id,
						'korisnickoIme' => $username,
						'logged_in' => true
					);
					$this->session->set_userdata($user_data);
					// Set message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');
					redirect('posts');
				} else {
					// Set message
					$this->session->set_flashdata('login_failed', 'Login is invalid');
					redirect('users/login');
				}		
			}
		}
		*/
	}