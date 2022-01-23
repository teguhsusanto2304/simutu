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
        $this->load->model('PenetapanDetailModel', 'penetapanDetail');

        $draw       =   $this->input->get('draw');

        $select     =   'pT.penetapanId, pen.pelaksana, pen.waktuPelaksanaan, pen.idAuditor, pen.waktuPenilaian, pS.namaProgramStudi, pS.programStudiCode, per.namaPeriode, per.tahunPeriode, per.mulaiPelaksanaan, per.akhirPelaksanaan, s.namaStandar, s.kodeStandar, sS.namaSubStandar, sS.kodeSubStandar, sS.linkStandarSPMI, perny.namaPernyataan, perny.kodePernyataan, i.namaIndikator, i.kodeIndikator, iD.namaIndikatorDokumen';
        
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

                $columns            =   explode(',', $select);

                $options['like']    =   [
                    'column'    =>  $columns,
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

        $auditorQS  =   $this->input->get('auditor');
        $kpsQS      =   $this->input->get('kps');
        if(!is_null($auditorQS) || !is_null($kpsQS)){
            if(!empty($auditorQS) || !empty($kpsQS)){
                if(!is_null($auditorQS)){
                    if(!empty($auditorQS)){
                        $auditorID  =   trim($auditorQS);
                        $idUser     =   $auditorID;
                    }
                }
                if(!is_null($kpsQS)){
                    if(!empty($kpsQS)){
                        $kpsID  =   trim($kpsQS);
                        $idUser     =   $kpsID;
                    }
                }

                $detailUser  =   $this->user->getUser($idUser, ['select' => 'idprogramstudi']);
                $prodiUser   =   $detailUser['idprogramstudi'];

                $options['where']['pS.idprogramstudi']  =   $prodiUser;
            }
        }

        $joinWithProdiAndPeriodeQS    =   $this->input->get('joinWithProdiAndPeriode');
        if(!is_null($joinWithProdiAndPeriodeQS)){
            if(!empty($joinWithProdiAndPeriodeQS)){
                $joinWithProdiAndPeriode    =   ($joinWithProdiAndPeriodeQS === 'true');
                if($joinWithProdiAndPeriode){
                    $this->load->library('Tabel');
                    $tabel              =   $this->tabel;

                    $tabelPeriode       =   $tabel->periode;
                    $tabelPenetapan     =   $tabel->penetapan;
                    $tabelProgramStudi  =   $tabel->programStudi;

                    $tabelStandart          =   $tabel->standart;
                    $tabelSubStandart       =   $tabel->subStandart;
                    $tabelPernyataan        =   $tabel->pernyataan;
                    $tabelIndikator         =   $tabel->indikator;
                    $tabelIndikatorDokumen  =   $tabel->indikatorDokumen;

                    $options['join']    =   [
                        ['table' => $tabelPenetapan.' pen', 'condition' => 'pen.penetapanid=pT.penetapanId'],
                        ['table' => $tabelPeriode.' per', 'condition' => 'per.idPeriode=pen.periode'],
                        ['table' => $tabelProgramStudi.' pS', 'condition' => 'pS.idprogramstudi=pen.idprogramstudi'],
                        ['table' => $tabelIndikatorDokumen.' iD', 'condition' => 'iD.indikatorDokumenId=pT.indikatorDokumen'],
                        ['table' => $tabelIndikator.' i', 'condition' => 'i.kodeIndikator=iD.kodeIndikator'],
                        ['table' => $tabelPernyataan.' perny', 'condition' => 'perny.kodePernyataan=i.kodePernyataan'],
                        ['table' => $tabelSubStandart.' sS', 'condition' => 'sS.kodeSubStandar=perny.kodeSubStandar'],
                        ['table' => $tabelStandart.' s', 'condition' => 's.kodeStandar=sS.kodeStandar']
                    ];
                }
            }
        }

        $listPenetapan  =   $this->penetapanDetail->getPenetapanDetail(null, $options);

        if(count($listPenetapan) >= 1){
            foreach($listPenetapan as $indexData => $penetapan){
                if(array_key_exists('pelaksana', $penetapan)){
                    $idPelaksana        =   $penetapan['pelaksana'];

                    if(!empty($idPelaksana)){
                        $detailPelaksana    =   $this->user->getUser($idPelaksana, ['select' => 'concat_ws(" ", firstName, lastName) as namaPelaksana']);
                        $listPenetapan[$indexData]['pelaksanaan'] =   $detailPelaksana;
                    }
                }
                if(array_key_exists('idAuditor', $penetapan)){
                    $idPenilai          =   $penetapan['idAuditor'];

                    if(!empty($idPenilai)){
                        $detailPenilai      =   $this->user->getUser($idPenilai, ['select' => 'concat_ws(" ", firstName, lastName) as namaPenilai']);
                        $listPenetapan[$indexData]['penilaian'] =   $detailPenilai;
                    }
                }
            }
        }

        $recordsTotal   =   $this->penetapanDetail->getNumberOfData();

        $response   =   [
            'listPenetapan'     =>  $listPenetapan, 
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
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
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
                $this->load->library('Tabel');
                $this->load->model('PenetapanModel', 'penetapan');
                $this->load->model('ProgramStudiModel', 'prodi');

                $tabel          =   $this->tabel;
                $tabelProdi     =   $tabel->programStudi;

                $detailUserOptions  =   [
                    'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                    'join'      =>  [
                        ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                    ]
                ];
                $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

                $detailPenetapan    =   $this->penetapan->getPenetapan($idPenetapan);

                $detailProdi        =   $this->prodi->getProgramStudi($detailPenetapan['idprogramstudi']);

                $userOptions        =   [
                    'select'    =>  'pT.userid, concat_ws(" ", firstName, lastName) as fullName, pT.nip, pS.namaProgramStudi, pS.programStudiCode',
                    'join'      =>  [
                        ['table' => $tabelProdi.' pS', 'condition' => 'pS.idprogramstudi=pT.idprogramstudi']
                    ],
                    'where'     =>  [
                        'role'  =>  3
                    ]
                ];
                $listAuditor        =   $this->user->getUser(null, $userOptions);

                $dataPage   =   [
                    'pageTitle'         =>  'Penetapan Auditor (Pilih Auditor)',
                    'detailUser'        =>  $detailUser,
                    'detailPenetapan'   =>  $detailPenetapan,
                    'listAuditor'       =>  $listAuditor,
                    'detailProdi'       =>  $detailProdi
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
                $tabelIndikator     =   $this->tabel->indikator;
                $tabelPenetapan     =   $this->tabel->penetapan;
                $tabelPernyataan    =   $this->tabel->pernyataan;
                $tabelSubStandart   =   $this->tabel->subStandart;
                $tabelStandart      =   $this->tabel->standart;

                $detailUserOptions  =   [
                    'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                    'join'      =>  [
                        ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                    ]
                ];
                $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

                $detailPenetapan    =   $this->penetapan->getPenetapan($idPenetapan);
   
                $penetapanDetailOptions     =   [
                    'select'    =>  'pT.*, i.namaIndikator, iD.kodeIndikator, iD.namaIndikatorDokumen, s.namaStandar, s.kodeStandar, sS.namaSubStandar, sS.kodeSubStandar, sS.linkStandarSPMI, pe.namaPernyataan, pe.kodePernyataan, i.namaIndikator, i.kodeIndikator',
                    'join'      =>  [
                        ['table' => $tabelIndikatorDokumen.' iD', 'condition' => 'iD.indikatorDokumenId=pT.indikatorDokumen'],
                        ['table' => $tabelPenetapan.' p', 'condition' => 'p.penetapanid=pT.penetapanId'],
                        ['table' => $tabelIndikator.' i', 'condition' => 'i.kodeIndikator=iD.kodeIndikator'],
                        ['table' => $tabelPernyataan.' pe', 'condition' => 'pe.kodePernyataan=i.kodePernyataan'],
                        ['table' => $tabelSubStandart.' sS', 'condition' => 'sS.kodeSubStandar=pe.kodeSubStandar'],
                        ['table' => $tabelStandart.' s', 'condition' => 's.kodeStandar=sS.kodeStandar']
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
                ['name' => 'idPenetapan', 'label' => 'ID Penetapan', 'rule' => 'required|trim|numeric', 'field' => null]
            ];

            $validation         =   $this->cV->validation($validationRules);
            $validationStatus   =   $validation['status'];
            $validationMessage  =   $validation['message'];

            if($validationStatus){      
                $idPenetapan        =   $this->input->post('idPenetapan');
                $idPenetapanDetail  =   $this->input->post('idPenetapanDetail');
                $linkProdi          =   $this->input->post('linkProdi');
                $catatan            =   $this->input->post('catatan');

                if(!is_null($linkProdi)){
                    if(!empty($linkProdi)){
                        if(is_array($linkProdi)){
                            if(count($linkProdi) >= 1){
                                $this->load->model('PenetapanDetailModel', 'penetapanDetail');
                                $this->load->model('PenetapanModel', 'penetapan');

                                foreach($linkProdi as $indexData => $linkProdiItem){
                                    $dataPenetapanDetail    =   [
                                        'catatan'   =>  $catatan[$indexData],
                                        'linkProdi' =>  $linkProdi[$indexData]
                                    ];

                                    $dataPenetapan  =   [
                                        'pelaksana'         =>  $this->isUserLoggedIn,
                                        'waktuPelaksanaan'  =>  now()
                                    ];
                                    $savePenetapan  =   $this->penetapan->savePenetapan($idPenetapan, $dataPenetapan);

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

                $tabel  =   $this->tabel;
                $tabelIndikatorDokumen      =   $tabel->indikatorDokumen;
                $tabelIndikator             =   $tabel->indikator;
                $tabelPenetapan             =   $tabel->penetapan;
                $tabelPernyataan            =   $tabel->pernyataan;
                $tabelSubStandart           =   $tabel->subStandart;
                $tabelStandart              =   $tabel->standart;

                $detailUserOptions  =   [
                    'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                    'join'      =>  [
                        ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                    ]
                ];
                $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

                $detailPenetapan    =   $this->penetapan->getPenetapan($idPenetapan);

                $penetapanDetailOptions     =   [
                    'select'    =>  'pT.*, iD.kodeIndikator, iD.namaIndikatorDokumen, s.namaStandar, s.kodeStandar, sS.namaSubStandar, sS.kodeSubStandar, sS.linkStandarSPMI, pe.namaPernyataan, pe.kodePernyataan, i.namaIndikator, i.kodeIndikator',
                    'join'      =>  [
                        ['table' => $tabelIndikatorDokumen.' iD', 'condition' => 'iD.indikatorDokumenId=pT.indikatorDokumen'],
                        ['table' => $tabelPenetapan.' p', 'condition' => 'p.penetapanid=pT.penetapanId'],
                        ['table' => $tabelIndikator.' i', 'condition' => 'i.kodeIndikator=iD.kodeIndikator'],
                        ['table' => $tabelPernyataan.' pe', 'condition' => 'pe.kodePernyataan=i.kodePernyataan'],
                        ['table' => $tabelSubStandart.' sS', 'condition' => 'sS.kodeSubStandar=pe.kodeSubStandar'],
                        ['table' => $tabelStandart.' s', 'condition' => 's.kodeStandar=sS.kodeStandar']
                    ],
                    'where'     =>  [
                        'pT.penetapanId'   =>  $idPenetapan
                    ]
                ];
                $listItemPenetapan          =   $this->penetapanDetail->getPenetapanDetail(null, $penetapanDetailOptions);

                $penilaianOptions   =   [
                    'select'    =>  'idPenilaian, namaPenilaian, warna, bobot'
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

                                $dataPenetapan  =   [
                                    'idAuditor'         =>  $this->isUserLoggedIn,
                                    'waktuPenilaian'    =>  now()
                                ];
                                $savePenetapan  =   $this->penetapan->savePenetapan($idPenetapan, $dataPenetapan);
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
