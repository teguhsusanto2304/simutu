<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    var $isAdminLoggedIn	=	false;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('AdminModel', 'admin');

		$isAdminLoggedIn 		=	$this->admin->isLogin();
		$this->isAdminLoggedIn	=	$isAdminLoggedIn;
	}
    public function listAdmin(){
        if($this->isAdminLoggedIn){
            $draw       =   $this->input->get('draw');

            $select     =   'id, foto, nama, alamat, email, telepon, username, createdAt, createdBy, updatedBy, updatedAt, isActive';
            
            $selectQS   =   $this->input->get('select');
            if(!is_null($selectQS) && !empty($selectQS)){
                $select     =   trim($selectQS);
            }

            $start      =   $this->input->get('start');
            $start      =   (!is_null($start))? $start : 0;

            $length     =   $this->input->get('length');
            $length     =   (!is_null($length))? $length : 10;

            $search         =   $this->input->get('search');

            $options        =   [
                'select'            =>  $select,
                'limit'             =>  $length,
                'limitStartFrom'    =>  $start
            ];
            
            if(!is_null($search)){
                if(is_array($search)){
                    $searchValue        =   $search['value'];
                    $options['like']    =   [
                        'column'    =>  ['nama', 'alamat', 'email', 'telepon', 'username'],
                        'value'     =>  $searchValue
                    ];
                }
            }
            
            $whereQS    =   $this->input->get('where');
            if(!is_null($whereQS) && !empty($whereQS)){
                $where          =   trim($whereQS);
                $whereArray     =   json_decode($where, true);

                $options['where']   =   $whereArray;
            }

            $joinQS     =   $this->input->get('join');
            if(!is_null($joinQS) && !empty($joinQS)){
                $join           =   trim($joinQS);
                $joinArray      =   json_decode($join, true);

                $options['join']    =   $joinArray;
            }

            $listAdmin    =   $this->admin->getAdmin(null, $options);

            if(count($listAdmin) >= 1){
                foreach($listAdmin as $indexData => $admin){
                    if(array_key_exists('createdBy', $admin)){
                        if(!is_null($admin['createdBy'])){
                            $creatorOptions =   [
                                'select'    =>  'nama, foto'
                            ];
                            $detailCreator  =   $this->admin->getAdmin($admin['createdBy'], $creatorOptions);

                            $listAdmin[$indexData]['detailCreator'] =   $detailCreator;
                        }
                    }
                    if(array_key_exists('updatedBy', $admin)){
                        if(!is_null($admin['updatedBy'])){
                            $updaterOptions =   [
                                'select'    =>  'nama, foto'
                            ];
                            $detailUpdater  =   $this->admin->getAdmin($admin['updatedBy'], $updaterOptions);

                            $listAdmin[$indexData]['detailUpdater'] =   $detailUpdater;
                        }
                    }
                }
            }

            $recordsTotal   =   $this->admin->getNumberOfData();

            $response   =   [
                'listAdmin'         =>  $listAdmin, 
                'draw'              =>  $draw,
                'recordsFiltered'   =>  $recordsTotal,
                'recordsTotal'      =>  $recordsTotal
            ];

            header('Content-Type:application/json');
            echo json_encode($response);
        }
    }
    public function index(){
        if($this->isAdminLoggedIn){            
            $detailAdminOptions	=	['select' => 'nama, foto'];
            $detailAdmin 	=	$this->admin->getAdmin($this->isAdminLoggedIn, $detailAdminOptions);

            $dataPage   =   [
                'pageTitle'     =>  'Administrator',
                'admin'         =>  $this->admin,
                'path'          =>  $this->path,
                'detailAdmin'   =>  $detailAdmin
            ];
            $this->load->view(adminControllers('admin/index'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('admin'))));
        }
    }
    public function process_toggleAktifNonAktif(){
        if($this->isAdminLoggedIn){      
            $status     =   false;
            $message    =   null;

            $this->load->library('CustomValidation', null, 'cV');

            $validationRules    =   [
                ['name' => 'idAdministrator', 'label' => 'ID Administrator', 'rule' => 'required|trim|greater_than_equal_to[1]']
            ];

            $validation         =   $this->cV->validation($validationRules);
            $validationStatus   =   $validation['status'];
            $validationMessage  =   $validation['message'];

            if($validationStatus){              
                $idAdministrator    =   $this->input->post('idAdministrator');

                $detailAdmin    =   $this->admin->getAdmin($idAdministrator, ['select' => 'isActive']);
                $isActive       =   ($detailAdmin['isActive'] == 1);

                $saveAdmin      =   $this->admin->saveAdmin($idAdministrator, ['isActive' => !$isActive]);
                if($saveAdmin){
                    $status     =   true;                    
                }else{
                    $message    =   'Gagal mengubah status aktif Administrator! Coba lagi!';
                }
            }else{
                $message    =   $validationMessage;
            }

            $response   =   [
                'status'    =>  $status,
                'message'   =>  $message
            ];

            header('Content-Type:application/json');
            echo json_encode($response);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('admin/process_toggleAktifNonAktif'))));
        }
    }
    public function add($idAdministrator = null){
        if($this->isAdminLoggedIn){
            $this->load->library('CustomForm', null, 'cF');
            
            $detailAdminOptions =   ['select' => 'nama, foto'];
            $detailAdmin    =   $this->admin->getAdmin($this->isAdminLoggedIn, $detailAdminOptions);

            $detailAdminUser    =   false;
            $pageTitle      =   'Add New Administrator';
            
            if(!is_null($idAdministrator)){      
                $detailAdminUser    =   $this->admin->getAdmin($idAdministrator);
                $pageTitle          =   'Edit Data Administrator | '.strtoupper($detailAdmin['nama']);
            }

            $dataPage   =   [
                'detailAdmin'       =>  $detailAdmin,
                'pageTitle'         =>  $pageTitle,
                'detailAdmin'       =>  $detailAdmin,
                'detailAdminUser'   =>  $detailAdminUser,
                'path'              =>  $this->path
            ];

            $this->load->view(adminViews('admin/add'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('admin/add'))));
        }
    }
    public function process_save($idAdministrator = null){
        $statusSave 	=	false;
        $messageSave	=	null;

        if($this->isAdminLoggedIn){
            $this->load->library('CustomValidation', null, 'cV');

            $validationRules	=	[
                ['name' => 'nama', 'label' => 'Nama Administrator', 'rule' => 'required|trim', 'field' => 'nama'],
                ['name' => 'telepon', 'label' => 'Nomor Telepon', 'rule' => 'required|trim|numeric|greater_than_equal_to[10]', 'field' => 'telepon'],
                ['name' => 'email', 'label' => 'Email', 'rule' => 'required|trim|valid_email', 'field' => 'email'],
                ['name' => 'username', 'label' => 'Username', 'rule' => 'required|trim', 'field' => 'username'],
                ['name' => 'alamat', 'label' => 'Alamat Lengkap', 'rule' => 'required|trim', 'field' => 'alamat']
            ];

            if(is_null($idAdministrator)){
                $passwordRules          =   ['name' => 'password', 'label' => 'Password', 'rule' => 'required|trim|min_length[8]', 'field' => 'password'];
                $passwordConfirmRules   =   ['name' => 'passwordConfirm', 'label' => 'Konfirmasi Password', 'rule' => 'required|trim|min_length[8]|matches[password]', 'field' => null];

                array_push($validationRules, $passwordRules);
                array_push($validationRules, $passwordConfirmRules);
            }

            $validation 		=	$this->cV->validation($validationRules);
            $validationStatus	=	$validation['status'];
            $validationMessage	=	$validation['message'];

            if($validationStatus){				
                $dataAdministrator 	=	[];
                foreach($validationRules as $rule){
                    $name 	=	$rule['name'];
                    $field 	=	$rule['field'];

                    if(!is_null($field)){
                        $value 	=	$this->input->post($name);
                        if($name === 'password'){
                            $value  =   md5($value);
                        }
                        $dataAdministrator[$field]	=	$value;
                    }
                }

                if(is_null($idAdministrator)){
                    $dataAdministrator['createdBy']	=	$this->isAdminLoggedIn;
                }else{
                    $dataAdministrator['updatedBy']	=	$this->isAdminLoggedIn;
                    $dataAdministrator['updatedAt']	=	now();
                }

                $saveAdmin 		=	$this->admin->saveAdmin($idAdministrator, $dataAdministrator);
                $statusSave 	=	($saveAdmin)? true : false;
            }else{
                $messageSave	=	$validationMessage;
            }

            $response	=	[
                'statusSave'	=>	$statusSave,
                'messageSave'	=>	$messageSave
            ];

            header('Content-Type:application/json');
            echo json_encode($response);
        }
    }
    public function profil(){
        if($this->isAdminLoggedIn){
            $this->load->library('CustomForm', null, 'cF');
            
            $idAdmin        =   $this->isAdminLoggedIn;
            $detailAdmin    =   $this->admin->getAdmin($idAdmin);

            $dataPage       =   [
                'detailAdmin'   =>  $detailAdmin
            ];
            $this->load->view(adminViews('profil'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('profil'))));
        }
    }   
    public function process_saveProfil(){
        $statusSave     =   false;
        $messageSave    =   null;

        if($this->isAdminLoggedIn){
            $this->load->library('CustomValidation', null, 'cV');
                        
            $validationRules    =   [
                ['name' => 'nama', 'label' => 'Nama', 'rule' => 'required|trim', 'field' => 'nama'],
                ['name' => 'username', 'label' => 'Username', 'rule' => 'required|trim', 'field' => 'username'],
                ['name' => 'email', 'label' => 'Email', 'rule' => 'required|trim|valid_email', 'field' => 'email'],
                ['name' => 'telepon', 'label' => 'Telepon', 'rule' => 'required|trim|numeric', 'field' => 'telepon'],
                ['name' => 'alamat', 'label' => 'Alamat', 'rule' => 'required|trim', 'field' => 'alamat']
            ];

            $validation         =   $this->cV->validation($validationRules);
            $validationStatus   =   $validation['status'];
            $validationMessage  =   $validation['message'];

            if($validationStatus){              
                $this->load->database();

               $isUsernameExist     =   $this->admin->entityHasBeenUsedByAnotherAdmin($this->isAdminLoggedIn, ['username' => $this->input->post('username')]);
                
                if(!$isUsernameExist){
                    $dataAdmin  =   [];
                    foreach($validationRules as $rule){
                        $name   =   $rule['name'];
                        $field  =   $rule['field'];

                        if(!is_null($field)){
                            $dataAdmin[$field]  =   $this->input->post($name);
                        }
                    }

                    $dataAdmin['updatedBy'] =   $this->isAdminLoggedIn;
                    $dataAdmin['updatedAt'] =   now();

                    $saveAdmin      =   $this->admin->saveAdmin($this->isAdminLoggedIn, $dataAdmin);
                    $statusSave     =   ($saveAdmin)? true : false;
                }else{
                    $messageSave    =   'Username has been used by another administrator account!';
                }
            }else{
                $messageSave    =   $validationMessage;
            }

            $response   =   [
                'statusSave'    =>  $statusSave,
                'messageSave'   =>  $messageSave
            ];

            header('Content-Type:application/json');
            echo json_encode($response);
        }
    }
    public function process_gantiPassword(){
        $statusGantiPassword    =   false;
        $messageGantiPassword   =   null;

        if($this->isAdminLoggedIn){
            $this->load->library('CustomValidation', null, 'cV');
                        
            $validationRules    =   [
                ['name' => 'passwordLama', 'label' => 'Password Lama', 'rule' => 'required|trim'],
                ['name' => 'passwordBaru', 'label' => 'Password Baru', 'rule' => 'required|trim|min_length[8]'],
                ['name' => 'konfirmasiPasswordBaru', 'label' => 'Konfirmasi Password Baru', 'rule' => 'required|trim|min_length[8]|matches[passwordBaru]'],
            ];

            $validation         =   $this->cV->validation($validationRules);
            $validationStatus   =   $validation['status'];
            $validationMessage  =   $validation['message'];

            if($validationStatus){  
                $passwordLama           =   $this->input->post('passwordLama');
                $passwordBaru           =   $this->input->post('passwordBaru');
                $konfirmasiPasswordBaru =   $this->input->post('konfirmasiPasswordBaru');

                $detailAdmin            =   $this->admin->getAdmin($this->isAdminLoggedIn, ['select' => 'password']);
                $passwordAdmin          =   $detailAdmin['password'];

                if($passwordAdmin === md5($passwordLama)){
                    $dataAdmin  =   [
                        'password'  =>  md5($konfirmasiPasswordBaru)
                    ];
                    $saveAdmin              =   $this->admin->saveAdmin($this->isAdminLoggedIn, $dataAdmin);
                    $statusGantiPassword    =   ($saveAdmin)? true : false;
                }else{
                    $messageGantiPassword   =   'Password lama tidak sesuai!';
                }
            }else{
                $messageGantiPassword   =   $validationMessage;
            }

            $response   =   [
                'statusGantiPassword'   =>  $statusGantiPassword,
                'messageGantiPassword'  =>  $messageGantiPassword
            ];

            header('Content-Type:application/json');
            echo json_encode($response);
        }
    }
}
