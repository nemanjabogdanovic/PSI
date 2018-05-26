<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
<?php 
	class Users extends CI_Controller{
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
				
				redirect('login');
			}
		}
		function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'Korisnicko ime je zauzeto!');
			if($this->user_model->check_username_exists($username)){
				return true;
			}
			else {
				return false;
			}
		}
		function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'Email je u upotrebi!');
			if($this->user_model->check_email_exists($email)){
				return true;
			}
			else {
				return false;
			}
		}
	}