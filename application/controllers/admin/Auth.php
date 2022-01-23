<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Auth extends CI_Controller {
		var $isAdminLoggedIn;

		public function __construct(){
			parent::__construct();
			
			$isLogin 	=	$this->user->isLogin();
			$this->isAdminLoggedIn	=	$isLogin;
		}
		public function login(){
			if(!$this->isAdminLoggedIn){
				$this->load->library('CustomForm', null, 'cF');
				$this->load->view(adminViews('auth/login'));
			}else{
				redirect(adminControllers());
			}
		}
		public function doLogin(){
			$statusLogin 	=	false;
			$message 		=	null;
			$userData 		=	null;

			if(!$this->isAdminLoggedIn){
				$this->load->library('form_validation', null, 'fV');

				$this->fV->set_rules('username', 'Username', 'required|trim');
				$this->fV->set_rules('password', 'Password', 'required');

				if($this->fV->run()){

					$username 	=	$this->input->post('username');
					$password 	=	$this->input->post('password');
					
					$userOptions 	=	[
						'select'	=>	'userid, role',
						'where'		=>	[
							'password'	=>	md5($password)
						],
						'whereGroup'    =>  [
							'operator'  =>  'or',
							'where'     =>  [['email' => $username]]
						],
						'useSingleRow'	=>	true
					];
					$getUser 	=	$this->user->getUser(null, $userOptions);
					if($getUser !== false){

						$idUser 	=	$getUser['userid'];

						$this->load->library('session');
						$this->session->set_userdata('id', $idUser);

						$userData 	=	$getUser;

						$statusLogin	=	true;

					}else{
						$message 	=	'Kombinasi Username dan Password Tidak Sesuai!';
					}
				}else{
					$message 	=	$this->fV->error_string();
				}
			}else{
				$statusLogin	=	true;
			}

			header('Content-Type:application/json');
			echo json_encode(['statusLogin' => $statusLogin, 'message' => $message, 'userData' => $userData]);
		}
		public function logout(){
			$this->load->library('session');
			$this->session->unset_userdata('id');
		
			redirect(adminControllers());
		}
		public function lupaPassword(){
			if(!$this->isAdminLoggedIn){
				$this->load->library('CustomForm', null, 'cF');
				$this->load->view(adminViews('auth/lupaPassword'));
			}else{
				redirect(adminControllers());
			}
		}
		public function process_recoveryPassword(){
			$status 	=	false;
			$message 	=	null;

			if(!$this->isAdminLoggedIn){
				$this->load->library('form_validation', null, 'fV');

				$this->fV->set_rules('usernameOrEmail', 'Username or Email', 'required|trim');

				if($this->fV->run()){
					$usernameOrEmail 	=	$this->input->post('usernameOrEmail');
					
					$adminOptions 	=	[
						'select'	=>	'id, nama, email',
						'whereGroup'    =>  [
							'operator'  =>  'or',
							'where'     =>  [['username' => $usernameOrEmail], ['email' => $usernameOrEmail]]
						],
						'useSingleRow'	=>	true
					];
					$getUser 	=	$this->user->getUser(null, $adminOptions);
					if($getUser !== false){
						$idAdmin 	=	$getUser['id'];
						$nama		=	$getUser['nama'];
						$email		=	$getUser['email'];

						$this->load->model('EmailModel', 'email');

						$stringRandom	=	rand(000000, 999999);
						$passwordBaru 	=	md5($stringRandom);

						$emailParams	=	[
							'subject'	=>	'Password Baru Anda',
							'body'		=>	'Hai admin TempeQu, password anda sudah diubah menjadi <b>'.$stringRandom.'</b>',
							'receivers'	=>	[
								['name'	=> $nama, 'email' => $email]
							]
						];
						$kirimEmail 	=	$this->email->sendEmail($emailParams);

						if($kirimEmail['statusSend']){
							$updatePasswordBaru	=	$this->user->saveAdmin($idAdmin, ['password' => $passwordBaru]);
							$status				=	true;
						}else{
							$message 	=	'Sistem tidak dapat mengirim email Password Baru! Hubungi developer di Whatsapp 082362249483! '.$kirimEmail['message'];
						}

					}else{
						$message 	=	'Username atau Email tidak terdaftar!';
					}
				}else{
					$message 	=	$this->fV->error_string();
				}
			}else{
				$status	=	true;
			}

			header('Content-Type:application/json');
			echo json_encode(['status' => $status, 'message' => $message]);
		}
	}