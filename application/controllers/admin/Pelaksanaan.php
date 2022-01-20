<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelaksanaan extends CI_Controller {
    var $isUserLoggedIn	=	false;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$isUserLoggedIn 		=	$this->user->isLogin();
		$this->isUserLoggedIn	=	$isUserLoggedIn;
	}
    public function index(){
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
                'pageTitle'                 =>  'Pelaksanaan',
                'detailUser'                =>  $detailUser,
                'loadedFrom'                =>  $this->penetapan->loadedFrom_pelaksanaan,
                'loadedFrom_pelaksanaan'    =>  $this->penetapan->loadedFrom_pelaksanaan,
                'loadedFrom_penilaian'      =>  $this->penetapan->loadedFrom_penilaian
            ];
            $this->load->view(adminViews('penetapan/listPenetapan'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('penetapan'))));
        }
    }
    /*
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
    */
}
