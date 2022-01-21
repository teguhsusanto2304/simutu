<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    var $isUserLoggedIn	=	false;

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');

		$isUserLoggedIn 		=	$this->user->isLogin();
		$this->isUserLoggedIn	=	$isUserLoggedIn;
	}
    public function spmi(){
        if($this->isUserLoggedIn){
            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $dataPage   =   [
                'pageTitle'     =>  'Laporan SPMI',
                'detailUser'    =>  $detailUser
            ];
            $this->load->view(adminViews('laporan/spmi'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('laporan/spmi'))));
        }
    }
    public function prodi(){
        if($this->isUserLoggedIn){
            
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('laporan/prodi'))));
        }
    }
    public function listSPMI(){
        if($this->isUserLoggedIn){
            $this->load->model('StandartModel', 'standart');

            $draw       =   $this->input->get('draw');

            $select     =   'pT.namaStandar, pT.kodeStandar, sS.namaSubStandar, sS.linkStandarSPMI, sS.kodeSubStandar, p.namaPernyataan, p.kodePernyataan, i.namaIndikator, i.kodeIndikator, iD.namaIndikatorDokumen';
            
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
                        'column'    =>  ['pT.namaStandar', 'pT.kodeStandar', 'sS.namaSubStandar', 'sS.linkStandarSPMI', 'sS.kodeSubStandar', 'p.namaPernyataan', 'p.kodePernyataan', 'i.namaIndikator', 'i.kodeIndikator', 'iD.namaIndikatorDokumen'],
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

            $options['join']    =   [
                ['table' => 'substandar sS', 'condition' => 'sS.kodeStandar=pT.kodeStandar'],
                ['table' => 'pernyataan p', 'condition' => 'p.kodeSubStandar=sS.kodeSubStandar'],
                ['table' => 'indikator i', 'condition' => 'i.kodePernyataan=p.kodePernyataan'],
                ['table' => 'indikatordokumen iD', 'condition' => 'iD.kodeIndikator=i.kodeIndikator']
            ];

            $listSPMI    =   $this->standart->getStandart(null, $options);

            $recordsTotal   =   $this->standart->getNumberOfData();

            $response   =   [
                'listSPMI'          =>  $listSPMI, 
                'draw'              =>  $draw,
                'recordsFiltered'   =>  $recordsTotal,
                'recordsTotal'      =>  $recordsTotal
            ];

            header('Content-Type:application/json');
            echo json_encode($response);
        }
    } 
}
