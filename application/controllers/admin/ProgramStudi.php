<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProgramStudi extends CI_Controller {
    var $isUserLoggedIn	=	false;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$isUserLoggedIn 		=	$this->admin->isLogin();
		$this->isUserLoggedIn	=	$isUserLoggedIn;
	}
    public function listProgramStudi(){
        $this->load->model('ProgramStudiModel', 'prodi');

        $draw       =   $this->input->get('draw');

        $select 	=	'pT.programStudiCode, pT.namaProgramStudi, pT.numberSK, pT.peringkatAkreditasi, pT.noSKBANPT, pT.idprogramstudi';
        
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
                    'column'    =>  ['pT.programStudiCode', 'pT.namaProgramStudi', 'pT.numberSK', 'pT.peringkatAkreditasi', 'pT.noSKBANPT'],
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

        $listProgramStudi    =   $this->prodi->getProgramStudi(null, $options);

        $recordsTotal   =   $this->prodi->getNumberOfData();

        $response   =   [
            'listProgramStudi'    =>  $listProgramStudi, 
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
            $this->load->model('ProgramStudiModel', 'prodi');

            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $dataPage   =   [
                'pageTitle'                 =>  'Program Studi',
                'detailUser'                =>  $detailUser,
                'loadedFrom'                =>  $this->prodi->loadedFrom_programStudi,
                'loadedFrom_programStudi'   =>  $this->prodi->loadedFrom_programStudi,
                'loadedFrom_penetapan'      =>  $this->prodi->loadedFrom_penetapan
            ];
            $this->load->view(adminViews('programStudi/index'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('programstudi'))));
        }
    }
    public function process_delete(){
        $statusHapus 	=	false;
        $messageHapus	=	null;

        if($this->isUserLoggedIn){
            $this->load->library('CustomValidation', null, 'cV');
            $rules 	=	[
                ['name' => 'idProgramStudi', 'label' => 'ID Program Studi', 'rule' => 'required|trim|numeric|greater_than_equal_to[1]']
            ];
            $validation 	=	$this->cV->validation($rules);

            $validationStatus 	=	$validation['status'];
            $validationMessage 	=	$validation['message'];
            
            if($validationStatus){
                $this->load->model('ProgramStudiModel', 'prodi');

                $idProgramStudi 		=	$this->input->post('idProgramStudi');
                $deleteProgramStudi 	=	$this->prodi->deleteProgramStudi($idProgramStudi);

                $statusHapus	=	$deleteProgramStudi['statusDelete'];
                $messageHapus   =   $deleteProgramStudi['messageDelete'];
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
    public function add($idProgramStudi = null){
        if($this->isUserLoggedIn){
            $this->load->library('Path');
            $this->load->library('CustomForm', null, 'cF');
            $this->load->model('ProgramStudiModel', 'prodi');

            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $detailProdi   =   false;
            $pageTitle      	=   'Add New Prodi';
            
            if(!is_null($idProgramStudi)){		
                $detailProdi    =   $this->prodi->getProgramStudi($idProgramStudi);
                $pageTitle      	=   'Edit Data Prodi | '.strtoupper($detailProdi['namaProgramStudi']);
            }

            $dataPage   =   [
                'detailProdi'   =>    $detailProdi,
                'pageTitle'		      =>   $pageTitle,
                'detailUser'	      =>   $detailUser,
                'path'                =>    $this->path
            ];

            $this->load->view(adminViews('programStudi/add'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('programstudi/add'))));
        }
    }
    public function process_save($idProgramStudi = null){
        $statusSave 	=	false;
        $messageSave	=	null;

        if($this->isUserLoggedIn){
            $this->load->model('ProgramStudiModel', 'prodi');
            $this->load->library('CustomValidation', null, 'cV');

            $validationRules	=	[
                ['name' => 'kodeSubStandar', 'label' => 'Kode Sub Standart', 'rule' => 'required|trim', 'field' => 'kodeSubStandar'],
                ['name' => 'programStudiCode', 'label' => 'Kode Studi Code', 'rule' => 'required|trim', 'field' => 'programStudiCode'],
                ['name' => 'namaProgramStudi', 'label' => 'Nama Program Studi', 'rule' => 'required|trim', 'field' => 'namaProgramStudi']
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

                if(is_null($idProgramStudi)){
                    $dataStandart['userid']	=	$this->isUserLoggedIn;
                    $dataStandart['createdDate']    =   now();
                }

                $saveProgramStudi =	$this->prodi->saveProgramStudi($idProgramStudi, $dataStandart);
                $statusSave 	=	($saveProgramStudi)? true : false;
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
    public function penetapan($idProgramStudi = null){
        if($this->isUserLoggedIn){
            $this->load->library('Path');
            $this->load->library('Tabel');
            $this->load->library('CustomForm', null, 'cF');
            $this->load->model('ProgramStudiModel', 'prodi');
            $this->load->model('IndikatorDokumenModel', 'indikatorDokumen');
            $this->load->model('PeriodeModel', 'periode');
            $this->load->model('SubStandartModel', 'subStandart');

            $tabel  =   $this->tabel;
            $tabelStandart      =   $tabel->standart;
            $tabelSubStandart   =   $tabel->subStandart;
            $tabelPernyataan    =   $tabel->pernyataan;
            $tabelIndikator     =   $tabel->indikator;

            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);
   
            $detailProdi    =   $this->prodi->getProgramStudi($idProgramStudi);
            $pageTitle      =   'Edit Data Prodi | '.strtoupper($detailProdi['namaProgramStudi']);

            $subStandarIdQS             =   $this->input->get('subStandarId');
            $indikatorDokumenOptions    =   [
                'select'    =>  'pT.namaIndikatorDokumen, pT.indikatorDokumenId, s.namaStandar, s.kodeStandar, sS.kodeSubStandar, sS.namaSubStandar, p.namaPernyataan, p.kodePernyataan, i.namaIndikator, i.kodeIndikator',
                'join'      =>  [
                    ['table' => $tabelIndikator.' i', 'condition' => 'i.kodeIndikator=pT.kodeIndikator'],
                    ['table' => $tabelPernyataan.' p', 'condition' => 'p.kodePernyataan=i.kodePernyataan'],
                    ['table' => $tabelSubStandart.' sS', 'condition' => 'sS.kodeSubStandar=p.kodeSubStandar'],
                    ['table' => $tabelStandart.' s', 'condition' => 's.kodeStandar=sS.kodeStandar']
                ]
            ];
            if(!is_null($subStandarIdQS)){
                if(!empty($subStandarIdQS)){
                    $subStandarId   =   trim($subStandarIdQS);

                    $indikatorDokumenOptions['where']    =   ['sS.subStandarId' => $subStandarId];
                }
            }

            $indikatorDokumen   =   $this->indikatorDokumen->getIndikatorDokumen(null, $indikatorDokumenOptions);

            $periodeOptions    =   [
                'select'    =>  'namaPeriode, idPeriode'
            ];
            $listPeriode   =   $this->periode->getPeriode(null, $periodeOptions);

            $listSubStandartOptions =   [
                'select'    =>  'namaSubStandar, subStandarId'
            ];

            $listSubStandart        =   $this->subStandart->getSubStandart(null, $listSubStandartOptions);

            $dataPage   =   [
                'detailProdi'       =>  $detailProdi,
                'pageTitle'         =>  $pageTitle,
                'detailUser'        =>  $detailUser,
                'path'              =>  $this->path,
                'indikatorDokumen'  =>  $indikatorDokumen,
                'listPeriode'       =>  $listPeriode,
                'listSubStandart'   =>  $listSubStandart,
                'subStandarIdQS'    =>  $subStandarIdQS
            ];

            $this->load->view(adminViews('programStudi/penetapan'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('programstudi/penetapan'))));
        }
    }
    public function process_savePenetapan($idPenetapan = null){
        $statusSave     =   false;
        $messageSave    =   null;

        if($this->isUserLoggedIn){
            $this->load->model('PenetapanModel', 'penetapan');
            $this->load->library('CustomValidation', null, 'cV');

            $validationRules    =   [
                ['name' => 'idProdi', 'label' => 'ID Prodi', 'rule' => 'required|trim', 'field' => 'idprogramstudi'],
                ['name' => 'periode', 'label' => 'Periode', 'rule' => 'required|trim', 'field' => 'periode'],
                ['name' => 'indikatorDokumen[]', 'label' => 'Indikator Dokumen', 'rule' => 'required|trim', 'field' => null]
            ];

            $validation         =   $this->cV->validation($validationRules);
            $validationStatus   =   $validation['status'];
            $validationMessage  =   $validation['message'];

            if($validationStatus){              
                $dataPenetapan   =   [];
                foreach($validationRules as $rule){
                    $name   =   $rule['name'];
                    $field  =   $rule['field'];

                    if(!is_null($field)){
                        $value  =   $this->input->post($name);
                        $dataPenetapan[$field]   =   $value;
                    }
                }

                if(is_null($idPenetapan)){
                    $dataPenetapan['userid'] =   $this->isUserLoggedIn;
                    $dataPenetapan['createdDate']    =   now();
                }

                $savePenetapan = $this->penetapan->savePenetapan($idPenetapan, $dataPenetapan);
                if($savePenetapan){
                    $idPenetapan    =   $savePenetapan;

                    $indikatorDokumen   =   $this->input->post('indikatorDokumen');
                    if(is_array($indikatorDokumen)){
                        if(count($indikatorDokumen) >= 1){
                            $this->load->model('PenetapanDetailModel', 'penetapanDetail');

                            foreach($indikatorDokumen as $indikatorDokumenItem){
                                $dataPenetapanDetail    =   [
                                    'penetapanId'       =>  $idPenetapan,
                                    'indikatorDokumen'    =>  $indikatorDokumenItem
                                ];

                                $savePenetapanDetail    =   $this->penetapanDetail->savePenetapanDetail(null, $dataPenetapanDetail);
                            }
                        }
                    }

                    $statusSave     =   true;
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
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('programstudi/penetapan'))));
        }
    }
}
