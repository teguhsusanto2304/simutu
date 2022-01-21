<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelaksanaan extends CI_Controller {
    var $isUserLoggedIn	=	false;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$isUserLoggedIn 		=	$this->user->isLogin();
		$this->isUserLoggedIn	=	$isUserLoggedIn;
	}
    public function index(){
        if($this->isUserLoggedIn){
            $this->load->library('Path');
            $this->load->model('PenetapanModel', 'penetapan');

            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $dataPage   =   [
                'pageTitle'                 =>  'Pelaksanaan',
                'detailUser'                =>  $detailUser,
                'loadedFrom'                =>  $this->penetapan->loadedFrom_pelaksanaan,
                'loadedFrom_pelaksanaan'    =>  $this->penetapan->loadedFrom_pelaksanaan,
                'loadedFrom_penilaian'      =>  $this->penetapan->loadedFrom_penilaian
            ];
            $this->load->view(adminViews('penetapan/listPenetapan'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('penetapan'))));
        }
    }
}
