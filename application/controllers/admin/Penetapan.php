<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penetapan extends CI_Controller {
    var $isUserLoggedIn	=	false;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$isUserLoggedIn 		=	$this->admin->isLogin();
		$this->isUserLoggedIn	=	$isUserLoggedIn;
	}
    public function listPenetapan(){
        $this->load->model('PenetapanModel', 'penetapan');

        $draw       =   $this->input->get('draw');

        $select     =   'pT.penetapanid, pS.namaProgramStudi, pS.programStudiCode, p.namaPeriode, p.tahunPeriode, p.mulaiPelaksanaan, p.akhirPelaksanaan';
        
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
                    'column'    =>  ['pS.programStudiCode', 'pS.namaProgramStudi'],
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

        $joinWithProdiAndPeriodeQS    =   $this->input->get('joinWithProdiAndPeriode');
        if(!is_null($joinWithProdiAndPeriodeQS)){
            if(!empty($joinWithProdiAndPeriodeQS)){
                $joinWithProdiAndPeriode    =   ($joinWithProdiAndPeriodeQS === 'true');
                if($joinWithProdiAndPeriode){
                    $this->load->library('Tabel');
                    $tabelPeriode       =   $this->tabel->periode;
                    $tabelProgramStudi  =   $this->tabel->programStudi;

                    $options['join']    =   [
                        ['table' => $tabelPeriode.' p', 'condition' => 'p.idPeriode=pT.periode'],
                        ['table' => $tabelProgramStudi.' pS', 'condition' => 'pS.idprogramstudi=pT.idprogramstudi']
                    ];
                }
            }
        }

        $listPenetapan    =   $this->penetapan->getPenetapan(null, $options);

        $recordsTotal   =   $this->penetapan->getNumberOfData();

        $response   =   [
            'listPenetapan'    =>  $listPenetapan, 
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
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $dataPage   =   [
                'pageTitle'                 =>  'Program Studi',
                'detailUser'                =>  $detailUser,
                'loadedFrom'                =>  $this->prodi->loadedFrom_penetapan,
                'loadedFrom_programStudi'   =>  $this->prodi->loadedFrom_programStudi,
                'loadedFrom_penetapan'      =>  $this->prodi->loadedFrom_penetapan
            ];
            $this->load->view(adminViews('programStudi/index'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('penetapan'))));
        }
    }
    public function auditor(){
        if($this->isUserLoggedIn){
            $this->load->library('Path');
            $this->load->model('PenetapanModel', 'penetapan');

            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $dataPage   =   [
                'pageTitle'                 =>  'Penetapan Auditor (List Penetapan)',
                'detailUser'                =>  $detailUser,
                'loadedFrom'                =>  $this->penetapan->loadedFrom_penetapan,
                'loadedFrom_pelaksanaan'    =>  $this->penetapan->loadedFrom_pelaksanaan,
                'loadedFrom_penilaian'      =>  $this->penetapan->loadedFrom_penilaian
            ];
            $this->load->view(adminViews('penetapan/listPenetapan'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('penetapan/auditor'))));
        }
    }
    public function setAuditor($idPenetapan = null){
        if($this->isUserLoggedIn){
           if(!is_null($idPenetapan)){
                 $this->load->library('Path');
                $this->load->model('PenetapanModel', 'penetapan');

                $detailUserOptions  =   [
                    'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName',
                    'join'      =>  [
                        ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                    ]
                ];
                $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

                $detailPenetapan    =   $this->penetapan->getPenetapan($idPenetapan);

                $userOptions        =   [
                    'select'    =>  'userid, concat_ws(" ", firstName, lastName) as fullName, nip',
                    'where'     =>  [
                        'role'  =>  3
                    ]
                ];
                $listAuditor        =   $this->user->getUser(null, $userOptions);

                $dataPage   =   [
                    'pageTitle'         =>  'Penetapan Auditor (Pilih Auditor)',
                    'detailUser'        =>  $detailUser,
                    'detailPenetapan'   =>  $detailPenetapan,
                    'listAuditor'       =>  $listAuditor
                ];
                $this->load->view(adminViews('penetapan/setAuditor'), $dataPage);
           }
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('penetapan/setAuditor/'.$idPenetapan))));
        }
    }
    public function process_setAuditor(){
        $statusSetAuditor     =   false;
        $messageSetAuditor    =   null;

        if($this->isUserLoggedIn){
            $this->load->library('CustomValidation', null, 'cV');

            $validationRules    =   [
                ['name' => 'idPenetapan', 'label' => 'ID Penetapan', 'rule' => 'required|trim|numeric', 'field' => 'idPenetapan'],
                ['name' => 'auditor[]', 'label' => 'Auditor', 'rule' => 'required|trim|numeric', 'field' => null]
            ];

            $validation         =   $this->cV->validation($validationRules);
            $validationStatus   =   $validation['status'];
            $validationMessage  =   $validation['message'];

            if($validationStatus){      
                $idPenetapan    =   $this->input->post('idPenetapan');
                $auditor        =   $this->input->post('auditor');

                if(!is_null($auditor)){
                    if(!empty($auditor)){
                        if(is_array($auditor)){
                            if(count($auditor) >= 1){
                                $this->load->database();
                                $this->load->library('Tabel');

                                $tabelAudit     =   $this->tabel->audit;

                                foreach($auditor as $auditorItem){
                                    $dataAudit  =   [
                                        'idPenetapan'   =>  $idPenetapan,
                                        'auditor'       =>  $auditorItem,
                                        'userid'        =>  $this->isUserLoggedIn
                                    ];

                                    $saveAudit  =   $this->db->insert($tabelAudit, $dataAudit);
                                }
                                $statusSetAuditor   =   true;
                            }else{
                                $messageSetAuditor  =   'Tidak ada auditor yang dipilih!';
                            }
                        }
                    }
                }
            }else{
                $messageSetAuditor    =   $validationMessage;
            }

            $response   =   [
                'statusSetAuditor'    =>  $statusSetAuditor,
                'messageSetAuditor'   =>  $messageSetAuditor
            ];

            header('Content-Type:application/json');
            echo json_encode($response);
        }
    }
    public function pelaksanaan($idPenetapan = null){
        if($this->isUserLoggedIn){
           if(!is_null($idPenetapan)){
                $this->load->library('Path');
                $this->load->library('Tabel');
                $this->load->model('PenetapanModel', 'penetapan');
                $this->load->model('PenetapanDetailModel', 'penetapanDetail');

                $detailActiveUser       =   $this->user->getUser($this->isUserLoggedIn, ['select' => 'idprogramstudi']);
                $idProgramStudiUser     =   $detailActiveUser['idprogramstudi'];     

                $tabelIndikatorDokumen      =   $this->tabel->indikatorDokumen;
                $tabelPenetapan      =   $this->tabel->penetapan;

                $detailUserOptions  =   [
                    'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName',
                    'join'      =>  [
                        ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                    ]
                ];
                $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

                $detailPenetapan    =   $this->penetapan->getPenetapan($idPenetapan);
   
                $penetapanDetailOptions     =   [
                    'select'    =>  'pT.*, iD.kodeIndikator, iD.namaIndikatorDokumen',
                    'join'      =>  [
                        ['table' => $tabelIndikatorDokumen.' iD', 'condition' => 'iD.indikatorDokumenId=pT.indikatorDokumen'],
                        ['table' => $tabelPenetapan.' p', 'condition' => 'p.penetapanid=pT.penetapanId']
                    ],
                    'where'     =>  [
                        'pT.penetapanId'       =>  $idPenetapan,
                        'p.idprogramstudi'  =>  $idProgramStudiUser
                    ]
                ];
                $listItemPenetapan          =   $this->penetapanDetail->getPenetapanDetail(null, $penetapanDetailOptions);

                $dataPage   =   [
                    'pageTitle'         =>  'Pelaksanaan',
                    'detailUser'        =>  $detailUser,
                    'detailPenetapan'   =>  $detailPenetapan,
                    'listItemPenetapan' =>  $listItemPenetapan
                ];
                $this->load->view(adminViews('penetapan/pelaksanaan'), $dataPage);
           }
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('penetapan/setAuditor/'.$idPenetapan))));
        }
    }
    public function process_setPelaksanaan(){
        $statusSave     =   false;
        $messageSave    =   null;

        if($this->isUserLoggedIn){
            $this->load->library('CustomValidation', null, 'cV');

            $validationRules    =   [
                ['name' => 'idPenetapanDetail[]', 'label' => 'ID Penetapan', 'rule' => 'required|trim|numeric', 'field' => null],
                ['name' => 'linkProdi[]', 'label' => 'Link Prodi', 'rule' => 'required|trim', 'field' => null],
                ['name' => 'catatan[]', 'label' => 'Catatan', 'rule' => 'required|trim', 'field' => null]
            ];

            $validation         =   $this->cV->validation($validationRules);
            $validationStatus   =   $validation['status'];
            $validationMessage  =   $validation['message'];

            if($validationStatus){      
                $idPenetapanDetail  =   $this->input->post('idPenetapanDetail');
                $linkProdi          =   $this->input->post('linkProdi');
                $catatan            =   $this->input->post('catatan');

                if(!is_null($linkProdi)){
                    if(!empty($linkProdi)){
                        if(is_array($linkProdi)){
                            if(count($linkProdi) >= 1){
                                $this->load->model('PenetapanDetailModel', 'penetapanDetail');

                                foreach($linkProdi as $indexData => $linkProdiItem){
                                    $dataPenetapanDetail    =   [
                                        'catatan'   =>  $catatan[$indexData],
                                        'linkProdi' =>  $linkProdi[$indexData]
                                    ];

                                    $idData     =   $idPenetapanDetail[$indexData];
                                    $save       =   $this->penetapanDetail->savePenetapanDetail($idData, $dataPenetapanDetail);
                                }

                                $statusSave   =   true;
                            }else{
                                $messageSave  =   'Tidak ada link prodi yang ditentukan!';
                            }
                        }
                    }
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
    public function penilaian($idPenetapan = null){
        if($this->isUserLoggedIn){
           if(!is_null($idPenetapan)){
                $this->load->library('Path');
                $this->load->library('Tabel');
                $this->load->model('PenetapanModel', 'penetapan');
                $this->load->model('PenetapanDetailModel', 'penetapanDetail');
                $this->load->model('PenilaianModel', 'penilaian');

                $tabelIndikatorDokumen      =   $this->tabel->indikatorDokumen;

                $detailUserOptions  =   [
                    'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName',
                    'join'      =>  [
                        ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                    ]
                ];
                $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

                $detailPenetapan    =   $this->penetapan->getPenetapan($idPenetapan);

                $penetapanDetailOptions     =   [
                    'select'    =>  'pT.*, iD.kodeIndikator, iD.namaIndikatorDokumen',
                    'join'      =>  [
                        ['table' => $tabelIndikatorDokumen.' iD', 'condition' => 'iD.indikatorDokumenId=pT.indikatorDokumen']
                    ],
                    'where'     =>  [
                        'penetapanId'   =>  $idPenetapan
                    ]
                ];
                $listItemPenetapan          =   $this->penetapanDetail->getPenetapanDetail(null, $penetapanDetailOptions);

                $penilaianOptions   =   [
                    'select'    =>  'idPenilaian, namaPenilaian'
                ];
                $listPenilaian  =   $this->penilaian->getPenilaian(null, $penilaianOptions);

                $dataPage   =   [
                    'pageTitle'         =>  'Penilaian',
                    'detailUser'        =>  $detailUser,
                    'detailPenetapan'   =>  $detailPenetapan,
                    'listItemPenetapan' =>  $listItemPenetapan,
                    'listPenilaian'     =>  $listPenilaian
                ];
                $this->load->view(adminViews('penetapan/penilaian'), $dataPage);
           }
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('penetapan/setAuditor/'.$idPenetapan))));
        }
    }
    public function process_setPenilaian(){
        $statusSave     =   false;
        $messageSave    =   null;

        if($this->isUserLoggedIn){
            $this->load->library('CustomValidation', null, 'cV');

            $validationRules    =   [
                ['name' => 'idPenetapanDetail[]', 'label' => 'ID Penetapan Detail', 'rule' => 'required|trim|numeric', 'field' => null],
                ['name' => 'penilaian[]', 'label' => 'Penilaian', 'rule' => 'required|trim', 'field' => null],
                ['name' => 'keterangan[]', 'label' => 'Keterangan', 'rule' => 'required|trim', 'field' => null],
                ['name' => 'idPenetapan', 'label' => 'ID Penetapan', 'rule' => 'required|trim', 'field' => null]
            ];

            $validation         =   $this->cV->validation($validationRules);
            $validationStatus   =   $validation['status'];
            $validationMessage  =   $validation['message'];

            if($validationStatus){      
                $idPenetapanDetail  =   $this->input->post('idPenetapanDetail');
                $penilaian          =   $this->input->post('penilaian');
                $keterangan            =   $this->input->post('keterangan');

                if(!is_null($penilaian)){
                    if(!empty($penilaian)){
                        if(is_array($penilaian)){

                            if(count($penilaian) >= 1){
                                $idPenetapan    =   $this->input->post('idPenetapan');
                                
                                $this->load->model('PenetapanDetailModel', 'penetapanDetail');
                                $this->load->model('PenetapanModel', 'penetapan');

                                foreach($penilaian as $indexData => $penilaianItem){
                                    $dataPenetapanDetail    =   [
                                        'keterangan'   =>  $keterangan[$indexData],
                                        'penilaian'     =>  $penilaian[$indexData]
                                    ];

                                    $idData     =   $idPenetapanDetail[$indexData];
                                    $save       =   $this->penetapanDetail->savePenetapanDetail($idData, $dataPenetapanDetail);
                                }

                                $savePenetapan  =   $this->penetapan->savePenetapan($idPenetapan, ['idAuditor' => $this->isUserLoggedIn]);
                                $statusSave   =   true;
                            }else{
                                $messageSave  =   'Tidak ada link prodi yang ditentukan!';
                            }
                        }
                    }
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
}
