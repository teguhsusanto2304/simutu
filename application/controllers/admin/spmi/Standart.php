<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Standart extends CI_Controller {
    var $isUserLoggedIn	=	false;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$isUserLoggedIn 		=	$this->admin->isLogin();
		$this->isUserLoggedIn	=	$isUserLoggedIn;
	}
    public function listStandart(){
        $this->load->model('StandartModel', 'standart');

        $draw       =   $this->input->get('draw');

        $select 	=	'standarId, kodeStandar, namaStandar';
        
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
        
        $noLimit        =   $this->input->get('noLimit');
        if(!is_null($noLimit)){
            if(!empty($noLimit)){
                $noLimit    =   trim($noLimit);

                if($noLimit === 'true'){
                    unset($options['limit']);
                    unset($options['limitStartFrom']);
                }
            }
        }

        if(!is_null($search)){
            if(is_array($search)){
                $searchValue        =   $search['value'];
                $options['like']    =   [
                    'column'    =>  ['kodeStandar', 'namaStandar'],
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

        $listStandart    =   $this->standart->getStandart(null, $options);

        $recordsTotal   =   $this->standart->getNumberOfData();

        $response   =   [
            'listStandart'       	=>  $listStandart, 
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
                'pageTitle'     =>  'Standart',
                'detailUser'   =>  $detailUser
            ];
            $this->load->view(adminViews('spmi/standart/index'), $dataPage);
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
                ['name' => 'idStandart', 'label' => 'ID Standart', 'rule' => 'required|trim|numeric|greater_than_equal_to[1]']
            ];
            $validation 	=	$this->cV->validation($rules);

            $validationStatus 	=	$validation['status'];
            $validationMessage 	=	$validation['message'];
            
            if($validationStatus){
                $this->load->model('StandartModel', 'standart');

                $idStandart 		=	$this->input->post('idStandart');
                $deleteStandart 	=	$this->standart->deleteStandart($idStandart);

                $statusHapus	=	$deleteStandart['statusDelete'];
                $messageHapus   =   $deleteStandart['messageDelete'];
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
    public function add($idStandart = null){
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

            $detailStandart    	=   false;
            $pageTitle      	=   'Add New Standart';
            
            if(!is_null($idStandart)){		
                $this->load->model('StandartModel', 'standart');

                $detailStandart    =   $this->standart->getStandart($idStandart);
                $pageTitle      	=   'Edit Data Blog | '.strtoupper($detailStandart['kodeStandar']);
            }

            $dataPage   =   [
                'detailStandart'   	=>  $detailStandart,
                'pageTitle'		=>	$pageTitle,
                'detailUser'	=>	$detailUser,
                'path'          =>  $this->path
            ];

            $this->load->view(adminViews('spmi/standart/add'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('user/add'))));
        }
    }
    public function process_save($idStandart = null){
        $statusSave 	=	false;
        $messageSave	=	null;

        if($this->isUserLoggedIn){
            $this->load->model('StandartModel', 'standart');
            $this->load->library('CustomValidation', null, 'cV');

            $validationRules	=	[
                ['name' => 'namaStandar', 'label' => 'Nama Standart', 'rule' => 'required|trim', 'field' => 'namaStandar'],
                ['name' => 'kodeStandar', 'label' => 'Kode Standart', 'rule' => 'required|trim', 'field' => 'kodeStandar']
            ];

            $validation 		=	$this->cV->validation($validationRules);
            $validationStatus	=	$validation['status'];
            $validationMessage	=	$validation['message'];

            if($validationStatus){				
                $dataStandart 	=	[];
                foreach($validationRules as $rule){
                    $name 	=	$rule['name'];
                    $field 	=	$rule['field'];

                    if(!is_null($field)){
                        $value 	=	$this->input->post($name);
                        $dataStandart[$field]	=	$value;
                    }
                }

                if(is_null($idStandart)){
                    $dataStandart['userid']	=	$this->isUserLoggedIn;
                    $dataStandart['createdDate']    =   now();
                }

                $saveStandart 		=	$this->standart->saveStandart($idStandart, $dataStandart);
                $statusSave 	=	($saveStandart)? true : false;
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
