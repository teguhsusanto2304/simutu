<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubStandart extends CI_Controller {
    var $isUserLoggedIn	=	false;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$isUserLoggedIn 		=	$this->admin->isLogin();
		$this->isUserLoggedIn	=	$isUserLoggedIn;
	}
    public function listSubStandart(){
        $this->load->model('SubStandartModel', 'subStandart');

        $draw       =   $this->input->get('draw');

        $select 	=	'subStandarId, kodeStandar, kodeSubStandar, namaSubStandar, linkStandarSPMI';
        
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
                    'column'    =>  ['kodeStandar', 'kodeSubStandar', 'namaSubStandar', 'linkStandarSPMI'],
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

        $listSubStandart    =   $this->subStandart->getSubStandart(null, $options);

        $recordsTotal   =   $this->subStandart->getNumberOfData();

        $response   =   [
            'listSubStandart'       	=>  $listSubStandart, 
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
                'pageTitle'     =>  'Sub Standart',
                'detailUser'   =>  $detailUser
            ];
            $this->load->view(adminViews('spmi/substandart/index'), $dataPage);
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
                ['name' => 'idSubStandart', 'label' => 'ID Sub Standart', 'rule' => 'required|trim|numeric|greater_than_equal_to[1]']
            ];
            $validation 	=	$this->cV->validation($rules);

            $validationStatus 	=	$validation['status'];
            $validationMessage 	=	$validation['message'];
            
            if($validationStatus){
                $this->load->model('SubStandartModel', 'subStandart');

                $idSubStandart 		=	$this->input->post('idSubStandart');
                $deleteSubStandart 	=	$this->subStandart->deleteSubStandart($idSubStandart);

                $statusHapus	=	$deleteSubStandart['statusDelete'];
                $messageHapus   =   $deleteSubStandart['messageDelete'];
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
    public function add($subStandartId = null){
        if($this->isUserLoggedIn){
            $this->load->library('Path');
            $this->load->library('CustomForm', null, 'cF');
            $this->load->model('StandartModel', 'standart');

            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $detailSubStandart    	=   false;
            $pageTitle      	=   'Add New Sub Standart';
            
            if(!is_null($subStandartId)){		
                $this->load->model('SubStandartModel', 'subStandart');

                $detailSubStandart    =   $this->subStandart->getSubStandart($subStandartId);
                $pageTitle      	=   'Edit Data Sub Standar | '.strtoupper($detailSubStandart['kodeSubStandar']);
            }

            $dataPage   =   [
                'detailSubStandart'   =>    $detailSubStandart,
                'pageTitle'		      =>   $pageTitle,
                'detailUser'	      =>   $detailUser,
                'path'                =>    $this->path
            ];

            $this->load->view(adminViews('spmi/substandart/add'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('user/add'))));
        }
    }
    public function process_save($subStandartId = null){
        $statusSave 	=	false;
        $messageSave	=	null;

        if($this->isUserLoggedIn){
            $this->load->model('SubStandartModel', 'subStandart');
            $this->load->library('CustomValidation', null, 'cV');

            $validationRules	=	[
                ['name' => 'kodeStandar', 'label' => 'Kode Standart', 'rule' => 'required|trim', 'field' => 'kodeStandar'],
                ['name' => 'kodeSubStandar', 'label' => 'Kode Sub Standart', 'rule' => 'required|trim', 'field' => 'kodeSubStandar'],
                ['name' => 'namaSubStandar', 'label' => 'Nama Standart', 'rule' => 'required|trim', 'field' => 'namaSubStandar'],
                ['name' => 'linkSubStandar', 'label' => 'Link Standart', 'rule' => 'required|trim', 'field' => 'linkStandarSPMI']
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

                if(is_null($subStandartId)){
                    $dataStandart['userid']	=	$this->isUserLoggedIn;
                    $dataStandart['createdDate']    =   now();
                }

                $saveSubStandart 		=	$this->subStandart->saveSubStandart($subStandartId, $dataStandart);
                $statusSave 	=	($saveSubStandart)? true : false;
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
