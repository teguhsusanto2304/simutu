<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pernyataan extends CI_Controller {
    var $isUserLoggedIn	=	false;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$isUserLoggedIn 		=	$this->admin->isLogin();
		$this->isUserLoggedIn	=	$isUserLoggedIn;
	}
    public function listPernyataan(){
        $this->load->model('PernyataanModel', 'pernyataan');

        $draw       =   $this->input->get('draw');

        $select 	=	'pT.pernyataanId, pT.kodeSubStandar, pT.namaPernyataan, pT.kodePernyataan, sS.namaSubStandar, sS.linkStandarSPMI, s.namaStandar';
        
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
                    'column'    =>  ['pT.kodePernyataan', 'pT.namaPernyataan', 'pT.kodeSubStandar'],
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

        $withStandart   =   $this->input->get('withStandart');
        if(!is_null($withStandart) && !empty($withStandart)){
            $withStandart           =   trim($withStandart);

            $withStandart   =   ($withStandart === 'true');
            if($withStandart){
                $options['join']    =   [
                    ['table' => 'substandar sS', 'condition' => 'sS.kodeSubStandar=pT.kodeSubStandar'],
                    ['table' => 'standarspmi s', 'condition' => 's.kodeStandar=sS.kodeStandar']
                ];
            }
        }

        $listPernyataan    =   $this->pernyataan->getPernyataan(null, $options);

        $recordsTotal   =   $this->pernyataan->getNumberOfData();

        $response   =   [
            'listPernyataan'    =>  $listPernyataan, 
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
                'pageTitle'     =>  'Pernyataan',
                'detailUser'   =>  $detailUser
            ];
            $this->load->view(adminViews('spmi/pernyataan/index'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('pernyataan'))));
        }
    }
    public function process_delete(){
        $statusHapus 	=	false;
        $messageHapus	=	null;

        if($this->isUserLoggedIn){
            $this->load->library('CustomValidation', null, 'cV');
            $rules 	=	[
                ['name' => 'idPernyataan', 'label' => 'ID Pernyataan', 'rule' => 'required|trim|numeric|greater_than_equal_to[1]']
            ];
            $validation 	=	$this->cV->validation($rules);

            $validationStatus 	=	$validation['status'];
            $validationMessage 	=	$validation['message'];
            
            if($validationStatus){
                $this->load->model('PernyataanModel', 'subStandart');

                $idPernyataan 		=	$this->input->post('idPernyataan');
                $deletePernyataan 	=	$this->pernyataan->deletePernyataan($idPernyataan);

                $statusHapus	=	$deletePernyataan['statusDelete'];
                $messageHapus   =   $deletePernyataan['messageDelete'];
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
    public function add($idPernyataan = null){
        if($this->isUserLoggedIn){
            $this->load->library('Path');
            $this->load->library('CustomForm', null, 'cF');
            $this->load->model('PernyataanModel', 'pernyataan');
            $this->load->model('SubStandartModel', 'subStandart');

            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $detailPernyataan   =   false;
            $pageTitle      	=   'Add New Pernyataan';
            
            if(!is_null($idPernyataan)){		
                $detailPernyataan    =   $this->pernyataan->getPernyataan($idPernyataan);
                $pageTitle      	=   'Edit Data Pernyataan | '.strtoupper($detailPernyataan['namaPernyataan']);
            }

            $dataPage   =   [
                'detailPernyataan'   =>    $detailPernyataan,
                'pageTitle'		      =>   $pageTitle,
                'detailUser'	      =>   $detailUser,
                'path'                =>    $this->path
            ];

            $this->load->view(adminViews('spmi/pernyataan/add'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('user/add'))));
        }
    }
    public function process_save($idPernyataan = null){
        $statusSave 	=	false;
        $messageSave	=	null;

        if($this->isUserLoggedIn){
            $this->load->model('PernyataanModel', 'pernyataan');
            $this->load->library('CustomValidation', null, 'cV');

            $validationRules	=	[
                ['name' => 'kodeSubStandar', 'label' => 'Kode Sub Standart', 'rule' => 'required|trim', 'field' => 'kodeSubStandar'],
                ['name' => 'kodePernyataan', 'label' => 'Kode Pernyataan', 'rule' => 'required|trim', 'field' => 'kodePernyataan'],
                ['name' => 'namaPernyataan', 'label' => 'Nama Pernyataan', 'rule' => 'required|trim', 'field' => 'namaPernyataan']
            ];

            $validation 		=	$this->cV->validation($validationRules);
            $validationStatus	=	$validation['status'];
            $validationMessage	=	$validation['message'];

            if($validationStatus){				
                $dataPernyataan 	=	[];
                foreach($validationRules as $rule){
                    $name 	=	$rule['name'];
                    $field 	=	$rule['field'];

                    if(!is_null($field)){
                        $value 	=	$this->input->post($name);
                        $dataPernyataan[$field]	=	$value;
                    }
                }

                if(is_null($idPernyataan)){
                    $dataPernyataan['userid']	=	$this->isUserLoggedIn;
                    $dataPernyataan['createdDate']    =   now();
                }

                $savePernyataan =	$this->pernyataan->savePernyataan($idPernyataan, $dataPernyataan);
                $statusSave 	=	($savePernyataan)? true : false;
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
