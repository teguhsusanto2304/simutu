<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndikatorDokumen extends CI_Controller {
    var $isUserLoggedIn	=	false;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$isUserLoggedIn 		=	$this->admin->isLogin();
		$this->isUserLoggedIn	=	$isUserLoggedIn;
	}
    public function listIndikatorDokumen(){
        $this->load->model('IndikatorDokumenModel', 'indikatorDokumen');

        $draw       =   $this->input->get('draw');

        $select 	=	'pT.indikatorDokumenId, pT.namaIndikatorDokumen, i.kodeIndikator, i.namaIndikator, perny.kodeSubStandar, perny.namaPernyataan, perny.kodePernyataan, sS.namaSubStandar, sS.linkStandarSPMI, s.namaStandar';
        
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
                    ['table' => 'indikator i', 'condition' => 'i.kodeIndikator=pT.kodeIndikator'],
                    ['table' => 'pernyataan perny', 'condition' => 'perny.kodePernyataan=i.kodePernyataan'],
                    ['table' => 'substandar sS', 'condition' => 'sS.kodeSubStandar=perny.kodeSubStandar'],
                    ['table' => 'standarspmi s', 'condition' => 's.kodeStandar=sS.kodeStandar']
                ];
            }
        }

        $listIndikatorDokumen    =   $this->indikatorDokumen->getIndikatorDokumen(null, $options);

        $recordsTotal   =   $this->indikatorDokumen->getNumberOfData();

        $response   =   [
            'listIndikatorDokumen'  =>  $listIndikatorDokumen, 
            'draw'                  =>  $draw,
            'recordsFiltered'       =>  $recordsTotal,
            'recordsTotal'          =>  $recordsTotal
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
                'pageTitle'     =>  'Indikator Dokumen',
                'detailUser'   =>  $detailUser
            ];
            $this->load->view(adminViews('spmi/indikatorDokumen/index'), $dataPage);
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
                ['name' => 'idIndikatorDokumen', 'label' => 'ID Indikator Dokumen', 'rule' => 'required|trim|numeric|greater_than_equal_to[1]']
            ];
            $validation 	=	$this->cV->validation($rules);

            $validationStatus 	=	$validation['status'];
            $validationMessage 	=	$validation['message'];
            
            if($validationStatus){
                $this->load->model('IndikatorDokumenModel', 'indikatorDokumen');

                $idIndikatorDokumen 	   =	$this->input->post('idIndikatorDokumen');
                $deleteIndikatorDokumen    =	$this->indikatorDokumen->deleteIndikatorDokumen($idIndikatorDokumen);

                $statusHapus	=	$deleteIndikatorDokumen['statusDelete'];
                $messageHapus   =   $deleteIndikatorDokumen['messageDelete'];
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
    public function add($idIndikatorDokumen = null){
        if($this->isUserLoggedIn){
            $this->load->library('Path');
            $this->load->library('CustomForm', null, 'cF');
            $this->load->model('IndikatorModel', 'indikator');
            $this->load->model('IndikatorDokumenModel', 'indikatorDokumen');

            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $detailIndikatorDokumen   =   false;
            $pageTitle      	=   'Add New Indikator Dokumen';
            
            if(!is_null($idIndikatorDokumen)){		
                $detailIndikatorDokumen    =   $this->indikatorDokumen->getIndikatorDokumen($idIndikatorDokumen);
                $pageTitle      	=   'Edit Data Indikator Dokumen | '.strtoupper($detailIndikatorDokumen['namaIndikatorDokumen']);
            }

            $dataPage   =   [
                'detailIndikatorDokumen'   =>    $detailIndikatorDokumen,
                'pageTitle'		      =>   $pageTitle,
                'detailUser'	      =>   $detailUser,
                'path'                =>    $this->path
            ];

            $this->load->view(adminViews('spmi/indikatorDokumen/add'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('spmi/indikatordokumen/add'))));
        }
    }
    public function process_save($idIndikatorDokumen = null){
        $statusSave 	=	false;
        $messageSave	=	null;

        if($this->isUserLoggedIn){
            $this->load->model('IndikatorDokumenModel', 'indikatorDokumen');
            $this->load->library('CustomValidation', null, 'cV');

            $validationRules	=	[
                ['name' => 'namaIndikatorDokumen', 'label' => 'Kode Sub Standart', 'rule' => 'required|trim', 'field' => 'namaIndikatorDokumen'],
                ['name' => 'indikator', 'label' => 'Kode Pernyataan', 'rule' => 'required|trim', 'field' => 'kodeIndikator']
            ];

            $validation 		=	$this->cV->validation($validationRules);
            $validationStatus	=	$validation['status'];
            $validationMessage	=	$validation['message'];

            if($validationStatus){				
                $dataIndikatorDokumen 	=	[];
                foreach($validationRules as $rule){
                    $name 	=	$rule['name'];
                    $field 	=	$rule['field'];

                    if(!is_null($field)){
                        $value 	=	$this->input->post($name);
                        $dataIndikatorDokumen[$field]	=	$value;
                    }
                }

                if(is_null($idIndikatorDokumen)){
                    $dataIndikatorDokumen['userid']	=	$this->isUserLoggedIn;
                    $dataIndikatorDokumen['createdDate']    =   now();
                }

                $saveIndikatorDokumen =	$this->indikatorDokumen->saveIndikatorDokumen($idIndikatorDokumen, $dataIndikatorDokumen);
                $statusSave 	=	($saveIndikatorDokumen)? true : false;
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
