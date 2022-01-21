<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller {
		var $isAdminLoggedIn;

		public function __construct(){
			parent::__construct();
			
			$isLogin 	=	$this->user->isLogin();

			$this->isAdminLoggedIn	=	$isLogin;
		}
		public function index(){
			if($this->isAdminLoggedIn){
				$detailUserOptions	=	[
					'select' 	=>	'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
					'join'		=>	[
						['table' => 'role r', 'condition' => 'r.roleid=pT.role']
					]
				];
				$detailUser 	=	$this->user->getUser($this->isAdminLoggedIn, $detailUserOptions);

				$jumlahUser	=	$this->user->getNumberOfData();
				$jumlahLangganan		=	0;
				$jumlahGaleri			=	0;
				$jumlahBlog				=	0;

				$dashboardSmallBox 	=	[
					['icon' => 'lni lni-users', 'bg' => 'bg-info', 'nameOfData' => 'Administrator', 'numberOfData' => $jumlahUser, 'seeMoreURL' => site_url(adminControllers('admin'))],
					['icon' => 'lni lni-user', 'bg' => 'bg-success', 'nameOfData' => 'Pelanggan', 'numberOfData' => $jumlahLangganan, 'seeMoreURL' => site_url(adminControllers('langganan'))],
					['icon' => 'lni lni-gallery', 'bg' => 'bg-warning', 'nameOfData' => 'Galeri', 'numberOfData' => $jumlahGaleri, 'seeMoreURL' => site_url(adminControllers('galeri'))],
					['icon' => 'lni lni-blogger', 'bg' => 'bg-danger', 'nameOfData' => 'Blog', 'numberOfData' => $jumlahBlog, 'seeMoreURL' => site_url(adminControllers('blog'))]
				];

				$dataPage	=	[
					'detailUser'		=>	$detailUser,
					'dashboardSmallBox'	=>	$dashboardSmallBox
				];
				$this->load->view(adminViews('index'), $dataPage);
			}else{
				redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers())));
			}
		}
	}