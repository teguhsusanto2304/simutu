<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	var $isUserLoggedIn;

	public function __construct(){
		parent::__construct();
		
		$isLogin 	=	$this->user->isLogin();
		$this->isUserLoggedIn	=	$isLogin;
	}
	public function index(){
		if($this->isUserLoggedIn){
			$this->load->library('CustomForm', null, 'cF');

			$userOptions 	=	[
				'select'	=>	'nama, foto, idUniversitas, level'
			];
			$detailUser 	=	$this->user->getUser($this->isUserLoggedIn, $userOptions);
			
			$dataPage 	=	[
				'detailUser'	=>	$detailUser
			];
			$this->load->view(userViews('index'), $dataPage);
		}else{
			redirect('auth/login');
		}
	}
	// public function login(){
	// 	$this->load->view(userViews('login'));
	// }
	// public function user_profil(){
	// 	$this->load->view(userViews('profil'));
	// }
}
