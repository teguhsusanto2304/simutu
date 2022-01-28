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
            $this->load->model('LaporanModel', 'laporan');

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
            $this->load->model('LaporanModel', 'laporan');
            
            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $dataPage   =   [
                'pageTitle'     =>  'Laporan Prodi',
                'detailUser'    =>  $detailUser
            ];
            $this->load->view(adminViews('laporan/prodi'), $dataPage);
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
    public function listProdiDocument($id){
        if($this->isUserLoggedIn){
            $this->db->select('indikatordokumen.namaIndikatorDokumen,penetapandetailspmi.status,penetapandetailspmi.penilaian,penetapandetailspmi.catatan');
            $this->db->where('penetapanId',$id);
            $this->db->join('indikatordokumen','penetapandetailspmi.indikatorDokumen=indikatordokumen.indikatorDokumenId','INNER');
            $response = [];
            foreach( $this->db->get('penetapandetailspmi')->result() as $row){
                array_push($response,
                array('doc'=>$row->namaIndikatorDokumen,
                      'status'=>$row->status,
                      'penilaian'=>$row->penilaian,
                      'catatan'=>$row->catatan));
            }
            header('Content-Type:application/json');
            echo json_encode($response);
        }
    }
    public function listProdi(){
        if($this->isUserLoggedIn){
            $this->load->model('PenetapanModel', 'penetapan');

            $draw       =   $this->input->get('draw');

            $select     =   'pT.penetapanId,p.namaPeriode, p.tahunPeriode, concat_ws(" ", u.firstName, u.lastName) as auditorName,  pStudy.namaProgramStudi, pStudy.programStudiCode';
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
                        //'column'    =>  ['p.namaPeriode', 'p.tahunPeriode', 'iD.namaIndikatorDokumen'],
                        'column'    =>  ['p.namaPeriode', 'p.tahunPeriode'],
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
                ['table' => 'periode p', 'condition' => 'p.idPeriode=pT.periode'],
                ['table' => 'user u', 'condition' => 'u.userid=pT.idAuditor'],
                //['table' => 'penetapandetailspmi pD', 'condition' => 'pD.penetapanId=pT.penetapanid'],
                //['table' => 'indikatordokumen iD', 'condition' => 'iD.indikatorDokumenId=pD.indikatorDokumen'],
                ['table' => 'programstudi pStudy', 'condition' => 'pStudy.idprogramstudi=pT.idprogramstudi'],
            ];

            $listProdi    =   $this->penetapan->getPenetapan(null, $options);

            $recordsTotal   =   $this->penetapan->getNumberOfData();

            $response   =   [
                'listProdi'         =>  $listProdi, 
                'draw'              =>  $draw,
                'recordsFiltered'   =>  $recordsTotal,
                'recordsTotal'      =>  $recordsTotal
            ];

            header('Content-Type:application/json');
            echo json_encode($response);
        }
    }
    public function formCetak($jenisLaporan = null){
        if($this->isUserLoggedIn){
            $this->load->model('LaporanModel', 'laporan');
            $this->load->model('StandartModel', 'standart');
            
            $detailUserOptions  =   [
                'select'    =>  'pT.lastName, pT.firstName, pT.imageProfile, r.roleName, pT.role',
                'join'      =>  [
                    ['table' => 'role r', 'condition' => 'r.roleid=pT.role']
                ]
            ];
            $detailUser     =   $this->user->getUser($this->isUserLoggedIn, $detailUserOptions);

            $listStandart   =   $this->standart->getStandart(null, ['select' => 'namaStandar, kodeStandar']);

            $dataPage   =   [
                'pageTitle'     =>  'Form Cetak Laporan Prodi',
                'detailUser'    =>  $detailUser,
                'listStandart'  =>  $listStandart
            ];
            $this->load->view(adminViews('laporan/formCetak_spmi'), $dataPage);
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('laporan/formCetak/'.$jenisLaporan))));
        }
    }
    public function prosescetak($jenisLaporan = null){
         if($this->isUserLoggedIn){
            $this->load->model('LaporanModel', 'laporan');
            $this->load->model('StandartModel', 'standart');
            
            $this->load->library('PDF');

            $laporan        =   $this->laporan;
            $jenis_spmi     =   $laporan->laporan_spmi;
            if($jenisLaporan === $jenis_spmi){
                ini_set('memory_limit', '-1');
                ini_set('max_execution_time', 300);

                $standar            =   $this->input->post('standar');
                $subStandar         =   $this->input->post('subStandar');
                $pernyataan         =   $this->input->post('pernyataan');
                $indikator          =   $this->input->post('indikator');
                $indikatorDokumen   =   $this->input->post('indikatorDokumen');


                $standartOptions    =   [
                    'select'    =>  'iD.namaIndikatorDokumen, i.kodeIndikator, i.namaIndikator, perny.kodeSubStandar, perny.namaPernyataan, perny.kodePernyataan, sS.namaSubStandar, sS.linkStandarSPMI, pT.namaStandar, pT.kodeStandar',
                    'join'  =>  [
                        ['table' => 'substandar sS', 'condition' => 'sS.kodeStandar=pT.kodeStandar'],
                        ['table' => 'pernyataan perny', 'condition' => 'perny.kodeSubStandar=sS.kodeSubStandar'],
                        ['table' => 'indikator i', 'condition' => 'i.kodePernyataan=perny.kodePernyataan'],
                        ['table' => 'indikatordokumen iD', 'condition' => 'iD.kodeIndikator=i.kodeIndikator']
                    ]
                ];

                if(!empty($standar)){
                    $standartOptions['where']['pT.kodeStandar']          =   trim($standar);
                }
                if(!empty($subStandar)){
                    $standartOptions['where']['sS.kodeSubStandar']      =   trim($subStandar);
                }
                if(!empty($pernyataan)){
                    $standartOptions['where']['perny.kodePernyataan']   =   trim($pernyataan);
                }
                if(!empty($indikator)){
                    $standartOptions['where']['i.kodeIndikator']        =   trim($indikator);
                }
                if(!empty($indikatorDokumen)){
                    $standartOptions['where']['iD.indikatorDokumenId']  =   trim($indikatorDokumen);
                }
                

                $listStandart       =   $this->standart->getStandart(null, $standartOptions);

                $pdf    =   $this->pdf;
                $pdf->setPaper('A4', 'landscape');
                $pdf->fileName  =   strtoupper('LaporanSPMI_'.now().'.pdf');

                $pdfData    =   [
                    'pageTitle'     =>  $pdf->fileName,
                    'listStandart'  =>  $listStandart
                ];
                $pdf->loadView(adminViews('laporan/spmi_pdf'), $pdfData);
            }
        }else{
            redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('laporan/prosescetak/'.$jenisLaporan))));
        }
    }
}
