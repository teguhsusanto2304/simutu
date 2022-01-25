<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periode extends CI_Controller {
    var $isUserLoggedIn	=	false;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$isUserLoggedIn 		=	$this->admin->isLogin();
		$this->isUserLoggedIn	=	$isUserLoggedIn;
	}
    public function listPeriode(){
        $this->load->model('PeriodeModel', 'periode');

        $draw       =   $this->input->get('draw');

        $select 	=	'pT.idPeriode, pT.namaPeriode, pT.tahunPeriode, pT.mulaiPelaksanaan, pT.akhirPelaksanaan, pT.mulaiPenilaian, pT.akhirPenilaian';
        
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

        $listPeriode    =   $this->periode->getPeriode(null, $options);

        $recordsTotal   =   $this->periode->getNumberOfData();

        $response   =   [
            'listPeriode'       =>  $listPeriode, 
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
                'pageTitle'                 =>  'Periode',
                'detailUser'                =>  $detailUser
            ];
            $this->load->view(adminViews('periode/index'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('periode'))));
        }
    }
    public function process_delete(){
        $statusHapus 	=	false;
        $messageHapus	=	null;

        if($this->isUserLoggedIn){
            $this->load->library('CustomValidation', null, 'cV');
            $rules 	=	[
                ['name' => 'idPeriode', 'label' => 'ID Periode', 'rule' => 'required|trim|numeric|greater_than_equal_to[1]']
            ];
            $validation 	=	$this->cV->validation($rules);

            $validationStatus 	=	$validation['status'];
            $validationMessage 	=	$validation['message'];
            
            if($validationStatus){
                $this->load->model('PeriodeModel', 'periode');

                $idPeriode 		=	$this->input->post('idPeriode');
                $deletePeriode 	=	$this->periode->deletePeriode($idPeriode);

                $statusHapus	=	$deletePeriode['statusDelete'];
                $messageHapus   =   $deletePeriode['messageDelete'];
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
    public function add($idPeriode = null){
        if($this->isUserLoggedIn){
            $this->load->library('CustomForm', null, 'cF');
            $this->load->model('PeriodeModel', 'periode');

            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $detailPeriode  =   false;
            $pageTitle      =   'Add New Periode';
            
            if(!is_null($idPeriode)){		
                $detailPeriode  =   $this->periode->getPeriode($idPeriode);
                $pageTitle      =   'Edit Data Periode | '.strtoupper($detailPeriode['namaPeriode']);
            }

            $dataPage   =   [
                'detailPeriode' =>   $detailPeriode,
                'pageTitle'	    =>   $pageTitle,
                'detailUser'    =>   $detailUser
            ];

            $this->load->view(adminViews('periode/add'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('periode/add'))));
        }
    }
    public function process_save($idPeriode = null){
        $statusSave 	=	false;
        $messageSave	=	null;

        if($this->isUserLoggedIn){
            $this->load->model('PeriodeModel', 'periode');
            $this->load->library('CustomValidation', null, 'cV');

            $validationRules	=	[
                ['name' => 'tahunPeriode', 'label' => 'Tahun Periode', 'rule' => 'required|trim', 'field' => 'tahunPeriode'],
                ['name' => 'namaPeriode', 'label' => 'Nama Periode', 'rule' => 'required|trim', 'field' => 'namaPeriode'],
                ['name' => 'mulaiPelaksanaan', 'label' => 'Mulai Pelaksanaan', 'rule' => 'required|trim', 'field' => 'mulaiPelaksanaan'],
                ['name' => 'akhirPelaksanaan', 'label' => 'Akhir Pelaksanaan', 'rule' => 'required|trim', 'field' => 'akhirPelaksanaan'],
                ['name' => 'mulaiPenilaian', 'label' => 'Mulai Penilaian', 'rule' => 'required|trim', 'field' => 'mulaiPenilaian'],
                ['name' => 'akhirPenilaian', 'label' => 'Akhir Penilaian', 'rule' => 'required|trim', 'field' => 'akhirPenilaian']
            ];

            $validation 		=	$this->cV->validation($validationRules);
            $validationStatus	=	$validation['status'];
            $validationMessage	=	$validation['message'];

            if($validationStatus){				
                $dataPeriode 	=	[];
                foreach($validationRules as $rule){
                    $name 	=	$rule['name'];
                    $field 	=	$rule['field'];

                    if(!is_null($field)){
                        $value 	=	$this->input->post($name);
                        $dataPeriode[$field]	=	$value;
                    }
                }

                if(is_null($idPeriode)){
                    $dataPeriode['userid']	=	$this->isUserLoggedIn;
                    $dataPeriode['createdDate']    =   now();
                }

                $savePeriode =	$this->periode->savePeriode($idPeriode, $dataPeriode);
                $statusSave 	=	($savePeriode)? true : false;
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
