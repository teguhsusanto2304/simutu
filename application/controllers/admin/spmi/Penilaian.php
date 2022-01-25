<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {
    var $isUserLoggedIn	=	false;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$isUserLoggedIn 		=	$this->admin->isLogin();
		$this->isUserLoggedIn	=	$isUserLoggedIn;
	}
    public function listPenilaian(){
        $this->load->model('MasterPenilaianModel', 'penilaian');

        $draw       =   $this->input->get('draw');

        $select 	=	'idPenilaian, namaPenilaian, warna, bobot';
        
        $selectQS 	=	$this->input->get('select');
        if(!is_null($selectQS) && !empty($selectQS)){
            $select 	=	trim($selectQS);
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
                    'column'    =>  ['namaPenilaian', 'warna'],
                    'value'     =>  $searchValue
                ];
            }
        }
        
        $whereQS 	=	$this->input->get('where');
        if(!is_null($whereQS) && !empty($whereQS)){
            $where			=	trim($whereQS);
            $whereArray 	=	json_decode($where, true);

            $options['where']	=	$whereArray;
        }

        $joinQS 	=	$this->input->get('join');
        if(!is_null($joinQS) && !empty($joinQS)){
            $join			=	trim($joinQS);
            $joinArray 		=	json_decode($join, true);

            $options['join']	=	$joinArray;
        }

        $listPenilaian    =   $this->penilaian->getPenilaian(null, $options);

        $recordsTotal   =   $this->penilaian->getNumberOfData();

        $response   =   [
            'listPenilaian'       	=>  $listPenilaian, 
            'draw'              =>  $draw,
            'recordsFiltered'   =>  $recordsTotal,
            'recordsTotal'      =>  $recordsTotal
        ];

        header('Content-Type:application/json');
        echo json_encode($response);
    }
    public function index(){
        if($this->isUserLoggedIn){
            $this->load->library('Path');

            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $dataPage   =   [
                'pageTitle'     =>  'Penilaian',
                'detailUser'   =>  $detailUser
            ];
            $this->load->view(adminViews('spmi/penilaian/index'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('blog'))));
        }
    }
    public function process_delete(){
        $statusHapus 	=	false;
        $messageHapus	=	null;

        if($this->isUserLoggedIn){
            $this->load->library('CustomValidation', null, 'cV');

            $rules 	=	[
                ['name' => 'idPenilaian', 'label' => 'ID Penilaian', 'rule' => 'required|trim|numeric|greater_than_equal_to[1]']
            ];
            $validation 	=	$this->cV->validation($rules);

            $validationStatus 	=	$validation['status'];
            $validationMessage 	=	$validation['message'];
            
            if($validationStatus){
                $this->load->model('MasterPenilaianModel', 'penilaian');

                $idPenilaian 		=	$this->input->post('idPenilaian');
                $deletePenilaian 	=	$this->penilaian->deletePenilaian($idPenilaian);

                $statusHapus	=	$deletePenilaian['statusDelete'];
                $messageHapus   =   $deletePenilaian['messageDelete'];
            }else{
                $messageHapus	=	$validationMessage;
            }

            $response	=	[
                'statusHapus'	=>	$statusHapus,
                'messageHapus'	=>	$messageHapus
            ];

            header('Content-Type:application/json');
            echo json_encode($response);
        }
    }
    public function add($idPenilaian = null){
        if($this->isUserLoggedIn){
            $this->load->library('Path');
            $this->load->library('CustomForm', null, 'cF');
            
           $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $detailPenilaian    	=   false;
            $pageTitle      	=   'Add New Penilaian';
            
            if(!is_null($idPenilaian)){		
                $this->load->model('MasterPenilaianModel', 'penilaian');

                $detailPenilaian    =   $this->penilaian->getPenilaian($idPenilaian);
                $pageTitle      	=   'Edit Data Blog | '.strtoupper($detailPenilaian['namaPenilaian']);
            }

            $dataPage   =   [
                'detailPenilaian'   	=>  $detailPenilaian,
                'pageTitle'		=>	$pageTitle,
                'detailUser'	=>	$detailUser,
                'path'          =>  $this->path
            ];

            $this->load->view(adminViews('spmi/penilaian/add'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('user/add'))));
        }
    }
    public function process_save($idPenilaian = null){
        $statusSave 	=	false;
        $messageSave	=	null;

        if($this->isUserLoggedIn){
            $this->load->model('MasterPenilaianModel', 'penilaian');
            $this->load->library('CustomValidation', null, 'cV');

            $validationRules	=	[
                ['name' => 'namaPenilaian', 'label' => 'Nama Penilaian', 'rule' => 'required|trim', 'field' => 'namaPenilaian'],
                ['name' => 'warna', 'label' => 'warna', 'rule' => 'required|trim', 'field' => 'warna'],
                ['name' => 'bobot', 'label' => 'Bobot', 'rule' => 'required|trim', 'field' => 'bobot']
            ];

            $validation 		=	$this->cV->validation($validationRules);
            $validationStatus	=	$validation['status'];
            $validationMessage	=	$validation['message'];

            if($validationStatus){				
                $dataPenilaian 	=	[];
                foreach($validationRules as $rule){
                    $name 	=	$rule['name'];
                    $field 	=	$rule['field'];

                    if(!is_null($field)){
                        $value 	=	$this->input->post($name);
                        $dataPenilaian[$field]	=	$value;
                    }
                }

                if(is_null($idPenilaian)){
                    $dataPenilaian['userid']	=	$this->isUserLoggedIn;
                    $dataPenilaian['createdDate']    =   now();
                }

                $savePenilaian 		=	$this->penilaian->savePenilaian($idPenilaian, $dataPenilaian);
                $statusSave 	=	($savePenilaian)? true : false;
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
}
