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

            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $dataPage   =   [
                'pageTitle'     =>  'Penetapan Auditor (List Penetapan)',
                'detailUser'    =>  $detailUser
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
}
