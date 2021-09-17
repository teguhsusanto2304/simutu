<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller {
		var $isAdminLoggedIn;

		public function __construct(){
			parent::__construct();
			
			$isLogin 	=	$this->admin->isLogin();

			$this->isAdminLoggedIn	=	$isLogin;
		}
		public function index(){
			if($this->isAdminLoggedIn){
				$detailAdminOptions	=	['select' => 'nama, foto'];
				$detailAdmin 	=	$this->admin->getAdmin($this->isAdminLoggedIn, $detailAdminOptions);

				$dataPage	=	['detailAdmin' => $detailAdmin];
				$this->load->view(adminViews('index'), $dataPage);
			}else{
				redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('index'))));
			}
		}
	}