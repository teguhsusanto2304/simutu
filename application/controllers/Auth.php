<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Auth extends CI_Controller {
		var $isUserLoggedIn;

		public function __construct(){
			parent::__construct();
			
			$isLogin 	=	$this->user->isLogin();
			$this->isUserLoggedIn	=	$isLogin;
		}
		public function login(){
			if(!$this->isUserLoggedIn){
				$this->load->library('CustomForm', null, 'cF');
				$this->load->view(userViews('auth/login'));
			}else{
				redirect(site_url());
			}
		}
		public function doLogin(){
			$statusLogin 	=	false;
			$message 		=	null;

			if(!$this->isUserLoggedIn){
				$this->load->library('form_validation', null, 'fV');

				$this->fV->set_rules('username', 'Username', 'required|trim');
				$this->fV->set_rules('password', 'Password', 'required');

				if($this->fV->run()){
					$username 	=	$this->input->post('username');
					$password 	=	$this->input->post('password');
					
					$userOptions 	=	[
						'select'	=>	'id',
						'where'		=>	[
							'password'	=>	md5($password)
						],
						'whereGroup'    =>  [
							'operator'  =>  'or',
							'where'     =>  [['username' => $username], ['email' => $username]]
						],
						'useSingleRow'	=>	true
					];
					$getUser 	=	$this->user->getUser(null, $userOptions);
					if($getUser !== false){
						$idUser 	=	$getUser['id'];

						$this->load->library('session');
						$this->session->set_userdata('idUser', $idUser);

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
			echo json_encode(['statusLogin' => $statusLogin, 'message' => $message]);
		}
	}