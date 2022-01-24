<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indikator extends CI_Controller {
    var $isUserLoggedIn	=	false;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$isUserLoggedIn 		=	$this->admin->isLogin();
		$this->isUserLoggedIn	=	$isUserLoggedIn;
	}
    public function listIndikator(){
        $this->load->model('IndikatorModel', 'indikator');

        $draw       =   $this->input->get('draw');

        $select 	=	'pT.indikatorId, pT.kodeIndikator, pT.namaIndikator, perny.kodeSubStandar, perny.namaPernyataan, perny.kodePernyataan, sS.namaSubStandar, sS.linkStandarSPMI, s.namaStandar';
        
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

                $selectArray        =   explode(',', $select);
                $options['like']    =   [
                    'column'    =>  $selectArray,
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
                    ['table' => 'pernyataan perny', 'condition' => 'perny.kodePernyataan=pT.kodePernyataan'],
                    ['table' => 'substandar sS', 'condition' => 'sS.kodeSubStandar=perny.kodeSubStandar'],
                    ['table' => 'standarspmi s', 'condition' => 's.kodeStandar=sS.kodeStandar']
                ];
            }
        }

        $listIndikator    =   $this->indikator->getIndikator(null, $options);

        $recordsTotal   =   $this->indikator->getNumberOfData();

        $response   =   [
            'listIndikator'    =>  $listIndikator, 
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
                'pageTitle'     =>  'Indikator',
                'detailUser'    =>  $detailUser
            ];
            $this->load->view(adminViews('spmi/indikator/index'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('indikator'))));
        }
    }
    public function process_delete(){
        $statusHapus 	=	false;
        $messageHapus	=	null;

        if($this->isUserLoggedIn){
            $this->load->library('CustomValidation', null, 'cV');
            $rules 	=	[
                ['name' => 'idIndikator', 'label' => 'ID Indikator', 'rule' => 'required|trim|numeric|greater_than_equal_to[1]']
            ];
            $validation 	=	$this->cV->validation($rules);

            $validationStatus 	=	$validation['status'];
            $validationMessage 	=	$validation['message'];
            
            if($validationStatus){
                $this->load->model('IndikatorModel', 'indikator');

                $idIndikator 		=	$this->input->post('idIndikator');
                $deleteIndikator 	=	$this->indikator->deleteIndikator($idIndikator);

                $statusHapus	=	$deleteIndikator['statusDelete'];
                $messageHapus   =   $deleteIndikator['messageDelete'];
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
    public function add($idIndikator = null){
        if($this->isUserLoggedIn){
            $this->load->library('Path');
            $this->load->library('CustomForm', null, 'cF');
            $this->load->model('IndikatorModel', 'indikator');
            $this->load->model('PernyataanModel', 'pernyataan');

            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $detailIndikator    =   false;
            $pageTitle      	=   'Add New Indikator';
            
            if(!is_null($idIndikator)){		
                $detailIndikator    =   $this->indikator->getIndikator($idIndikator);
                $pageTitle      	=   'Edit Data Indikator | '.strtoupper($detailIndikator['namaIndikator']);
            }

            $dataPage   =   [
                'detailIndikator'   =>    $detailIndikator,
                'pageTitle'		    =>   $pageTitle,
                'detailUser'	    =>   $detailUser,
                'path'              =>    $this->path
            ];

            $this->load->view(adminViews('spmi/indikator/add'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('user/add'))));
        }
    }
    public function process_save($idIndikator = null){
        $statusSave 	=	false;
        $messageSave	=	null;

        if($this->isUserLoggedIn){
            $this->load->model('IndikatorModel', 'indikator');
            $this->load->library('CustomValidation', null, 'cV');

            $validationRules	=	[
                ['name' => 'pernyataan', 'label' => 'Pernyataan', 'rule' => 'required|trim', 'field' => 'kodePernyataan'],
                ['name' => 'kodeIndikator', 'label' => 'Kode Indikator', 'rule' => 'required|trim', 'field' => 'kodeIndikator'],
                ['name' => 'namaIndikator', 'label' => 'Nama Indikator', 'rule' => 'required|trim', 'field' => 'namaIndikator']
            ];

            $validation 		=	$this->cV->validation($validationRules);
            $validationStatus	=	$validation['status'];
            $validationMessage	=	$validation['message'];

            if($validationStatus){				
                $dataIndikator 	=	[];
                foreach($validationRules as $rule){
                    $name 	=	$rule['name'];
                    $field 	=	$rule['field'];

                    if(!is_null($field)){
                        $value 	=	$this->input->post($name);
                        $dataIndikator[$field]	=	$value;
                    }
                }

                if(is_null($idIndikator)){
                    $dataIndikator['userid']	=	$this->isUserLoggedIn;
                    $dataIndikator['createdDate']    =   now();
                }

                $saveIndikator =	$this->indikator->saveIndikator($idIndikator, $dataIndikator);
                $statusSave 	=	($saveIndikator)? true : false;
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
