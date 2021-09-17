<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Konten extends CI_Controller {
		var $isAdminLoggedIn;

		public function __construct(){
			parent::__construct();
			
			$isLogin 	=	$this->admin->isLogin();
			$this->isAdminLoggedIn	=	$isLogin;
		}
		public function index(){
			if($this->isAdminLoggedIn){
				$detailAdminOptions	=	['select' => 'nama, foto'];
				$detailAdmin 	=	$this->admin->getAdmin($this->isAdminLoggedIn, $detailAdminOptions);

				$dataPage	=	['detailAdmin' => $detailAdmin];
				$this->load->view(adminViews('konten/index'), $dataPage);
			}else{
				redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('konten/index'))));
			}
		}
	    public function listKonten(){
	        if($this->isAdminLoggedIn){
	            $this->load->model('KontenModel', 'konten');

	            $draw       =   $this->input->get('draw');

	            $start      =   $this->input->get('start');
	            $start      =   (!is_null($start))? $start : 0;

	            $length  =   $this->input->get('length');
	            $length  =   (!is_null($length))? $length : 10;

	            $search         =   $this->input->get('search');

	            $options        =   [
	                'select'            =>  'id, page, namaDivisi, deskripsiDivisi, createdBy',
                    'orderBy'           =>  [
                        'column'        =>  'urutan',
                        'orientation'   =>  'desc'
                    ],
	                'limit'             =>  $length,
	                'limitStartFrom'    =>  $start
	            ];
	            
	            if(!is_null($search)){
	                if(is_array($search)){
	                    $searchValue        =   $search['value'];
	                    $options['like']    =   [
	                        'column'    =>  ['namaDivisi', 'deskripsiDivisi'],
	                        'value'     =>  $searchValue
	                    ];
	                }
	            }

	            $listKonten    =   $this->konten->getKonten(null, $options);

				if(count($listKonten) >= 1){
					foreach($listKonten as $indexData => $konten){
						if(array_key_exists('createdBy', $konten)){
							$adminOptions	=	[
								'select'	=>	'nama, foto'
							];
							$detailAdmin 	=	$this->admin->getAdmin($konten['createdBy'], $adminOptions);

							$listKonten[$indexData]['detailAdmin']	=	$detailAdmin;
						}
					}
				}

	            $recordsTotal   =   $this->konten->getNumberOfData();

	            $response   =   [
	                'dataKonten'        =>  $listKonten, 
	                'draw'              =>  $draw,
	                'recordsFiltered'   =>  $recordsTotal,
	                'recordsTotal'      =>  $recordsTotal
	            ];

	            header('Content-Type:application/json');
	            echo json_encode($response);
	        }else{
	            redirect('auth/login');
	        }
	    }
		public function process_delete(){
			$statusHapusKonten 	=	false;
			$messageHapusKonten	=	null;

			if($this->isAdminLoggedIn){
				$this->load->library('form_validation', null, 'fV');

				$this->fV->set_rules('idKonten', 'ID Konten', 'required|trim');
				
				if($this->fV->run()){
					$this->load->model('KontenModel', 'konten');
                    
                    $idKonten       =   $this->input->post('idKonten');
                    $hapusKonten    =   $this->konten->deleteKonten($idKonten);

                    $statusHapusKonten  =   $hapusKonten;
				}else{
					$messageHapusKonten	=	$this->fV->error_string();
				}

				$response	=	[
					'statusHapusKonten'	    =>	$statusHapusKonten,
					'messageHapusKonten'	=>	$messageHapusKonten
				];

				header('Content-Type:application/json');
				echo json_encode($response);
			}
		}
		public function add($idKonten = null){
			if($this->isAdminLoggedIn){
				$this->load->model('KontenModel', 'konten');
				$this->load->library('CustomForm', null, 'cF');
				
				$detailAdminOptions	=	['select' => 'nama, foto'];
				$detailAdmin 	    =	$this->admin->getAdmin($this->isAdminLoggedIn, $detailAdminOptions);
	
				$detailKonten   =   false;
				$pageName       =   'Add New Konten';
				
				if(!is_null($idKonten)){					
					$detailKonten   =   $this->konten->getKonten($idKonten);
					$pageName       =   'Edit Data Konten | '.strtoupper($detailKonten['namaDivisi']);
				}
	
				$dataPage   =   [
					'detailKonten'  =>  $detailKonten,
					'pageName'      =>	$pageName,
					'detailAdmin'	=>	$detailAdmin
				];
	
				$this->load->view(adminViews('konten/add'), $dataPage);
			}else{
				redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('konten/add'))));
			}
		}
        public function process_save($idKonten = null){
            $statusSave =   false;
            $message    =   null;

            if($this->isAdminLoggedIn){
                $this->load->library('form_validation', null, 'fV');

                $this->fV->set_rules('page', 'Halaman', 'required|trim');
                $this->fV->set_rules('namaDivisi', 'Nama Divisi', 'required|trim');
                $this->fV->set_rules('deskripsiDivisi', 'Deskripsi Divisi', 'required|trim');
                $this->fV->set_rules('urutan', 'Urutan Divisi', 'required|trim');
                if($this->fV->run()){
                    $page               =   $this->input->post('page');
                    $namaDivisi         =   $this->input->post('namaDivisi');
                    $urutan             =   $this->input->post('urutan');
                    $deskripsiDivisi    =   $this->input->post('deskripsiDivisi');
                    
                    $dataKonten   =   [
                        'page'              =>  $page,
                        'namaDivisi'        =>  $namaDivisi,
                        'deskripsiDivisi'   =>  $deskripsiDivisi,
                        'urutan'            =>  $urutan
                    ];

                    if(!is_null($idKonten)){
                        $dataKonten['updatedBy']  =   $this->isAdminLoggedIn;
                        $dataKonten['updatedAt']  =   now();
                    }else{
                        $dataKonten['createdBy']  =  $this->isAdminLoggedIn;
                    }

                    $this->load->model('KontenModel', 'konten');
                    $save   =   $this->konten->saveKonten($idKonten, $dataKonten);

                    $statusSave =   ($save)? true : false;
                }else{
                    $message    =   $this->fV->error_string();
                }
            }

            header('Content-Type:application/json');
            echo    json_encode(['statusSave' => $statusSave, 'message' => $message]);
        }
		public function detail($idKonten = null){
			if($this->isAdminLoggedIn){
				if(!is_null($idKonten) && !empty($idKonten)){
					$detailAdminOptions	=	['select' => 'nama, foto'];
					$detailAdmin 	=	$this->admin->getAdmin($this->isAdminLoggedIn, $detailAdminOptions);

					$this->load->model('KontenModel', 'konten');
					$detailKonten 	=	$this->konten->getKonten($idKonten, ['select' => 'id, namaDivisi']);

					$dataPage	=	[
						'detailAdmin'	=>	$detailAdmin,
						'detailKonten'	=>	$detailKonten
					];
					$this->load->view(adminViews('konten/detail'), $dataPage);
				}
			}else{
				redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('konten/index'))));
			}
		}
		public function addItem($idKonten = null, $idKontenItem = null){
			if($this->isAdminLoggedIn){
				if(!is_null($idKonten) && !empty($idKonten)){
					$this->load->model('KontenModel', 'konten');
					$this->load->model('KontenItemModel', 'kontenItem');
					$this->load->library('CustomForm', null, 'cF');
					
					$detailAdminOptions	=	['select' => 'nama, foto'];
					$detailAdmin 	    =	$this->admin->getAdmin($this->isAdminLoggedIn, $detailAdminOptions);
		
					$detailKonten 	=	$this->konten->getKonten($idKonten, ['select' => 'id, namaDivisi']);

					$detailKontenItem   =   false;
					$pageName           =   'Add New Konten Item';
					
					if(!is_null($idKontenItem)){					
						$detailKontenItem   =   $this->kontenItem->getKontenItem($idKontenItem);
						$pageName           =   'Edit Data Konten Item | '.strtoupper($detailKontenItem['nama']);
					}
		
					$dataPage   =   [
						'detailKonten'		=>	$detailKonten,
						'detailKontenItem'  =>  $detailKontenItem,
						'pageName'          =>	$pageName,
						'detailAdmin'	    =>	$detailAdmin
					];
		
					$this->load->view(adminViews('kontenItem/add'), $dataPage);
				}
			}else{
				redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('kontenItem/add'))));
			}
		}
	}