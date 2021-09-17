<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Hero extends CI_Controller {
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
				$this->load->view(adminViews('hero/index'), $dataPage);
			}else{
				redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('hero/index'))));
			}
		}
	    public function listHero(){
	        if($this->isAdminLoggedIn){
	            $this->load->model('HeroModel', 'hero');

	            $draw       =   $this->input->get('draw');

	            $start      =   $this->input->get('start');
	            $start      =   (!is_null($start))? $start : 0;

	            $length  =   $this->input->get('length');
	            $length  =   (!is_null($length))? $length : 10;

	            $search         =   $this->input->get('search');

	            $options        =   [
	                'select'            =>  'id, foto, judul, deskripsi, urutan, createdBy',
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
	                        'column'    =>  ['foto', 'judul', 'deskripsi'],
	                        'value'     =>  $searchValue
	                    ];
	                }
	            }

	            $listHero    =   $this->hero->getHero(null, $options);

				if(count($listHero) >= 1){
					foreach($listHero as $indexData => $hero){
						if(array_key_exists('createdBy', $hero)){
							$adminOptions	=	[
								'select'	=>	'nama, foto'
							];
							$detailAdmin 	=	$this->admin->getAdmin($hero['createdBy'], $adminOptions);

							$listHero[$indexData]['detailAdmin']	=	$detailAdmin;
						}
					}
				}

	            $recordsTotal   =   $this->hero->getNumberOfData();

	            $response   =   [
	                'dataHero' 	        =>  $listHero, 
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
			$statusHapusHero 	=	false;
			$messageHapusHero	=	null;

			if($this->isAdminLoggedIn){
				$this->load->library('form_validation', null, 'fV');

				$this->fV->set_rules('idHero', 'ID Hero', 'required|trim');
				
				if($this->fV->run()){
					$idHero	=	$this->input->post('idHero');

					$this->load->model('HeroModel', 'hero');
					$hapusHero 	=	$this->hero->deleteHero($idHero);

					$statusHapusHero 	=	$hapusHero;
				}else{
					$messageHapusHero	=	$this->fV->error_string();
				}

				$response	=	[
					'statusHapusHero'	=>	$statusHapusHero,
					'messageHapusHero'	=>	$messageHapusHero
				];

				header('Content-Type:application/json');
				echo json_encode($response);
			}
		}
		public function add($idHero = null){
			if($this->isAdminLoggedIn){
				$this->load->model('HeroModel', 'hero');
				$this->load->library('CustomForm', null, 'cF');
				
				$detailAdminOptions	=	['select' => 'nama, foto'];
				$detailAdmin 	    =	$this->admin->getAdmin($this->isAdminLoggedIn, $detailAdminOptions);
	
				$detailHero =   false;
				$pageName   =   'Add New Hero';
				
				if(!is_null($idHero)){					
					$detailHero =   $this->hero->getHero($idHero);
					$pageName   =   'Edit Data Hero | '.strtoupper($detailHero['judul']);
				}
	
				$dataPage   =   [
					'detailHero'   	=>  $detailHero,
					'pageName'      =>	$pageName,
					'detailAdmin'	=>	$detailAdmin
				];
	
				$this->load->view(adminViews('hero/add'), $dataPage);
			}else{
				redirect(adminControllers('auth/login?nextRoute='.site_url(adminControllers('hero/add'))));
			}
		}
        public function process_save($idHero = null){
            $statusSave =   false;
            $message    =   null;

            if($this->isAdminLoggedIn){
                $this->load->library('form_validation', null, 'fV');

                $this->fV->set_rules('judul', 'Judul', 'required|trim');
                $this->fV->set_rules('urutan', 'Urutan', 'required|trim');
                $this->fV->set_rules('deskripsi', 'Deskripsi', 'required|trim');
                if($this->fV->run()){
                    $judul      =   $this->input->post('judul');
                    $urutan     =   $this->input->post('urutan');
                    $deskripsi  =   $this->input->post('deskripsi');
                    
                    $dataHero   =   [
                        'judul'     =>  $judul,
                        'deskripsi' =>  $deskripsi,
                        'urutan'    =>  $urutan
                    ];

                    if(!is_null($idHero)){
                        $dataHero['updatedBy']  =   $this->isAdminLoggedIn;
                        $dataHero['updatedAt']  =   now();
                    }else{
                        $dataHero['createdBy']  =  $this->isAdminLoggedIn;
                    }

                    $this->load->model('HeroModel', 'hero');
                    $save   =   $this->hero->saveHero($idHero, $dataHero);

                    $statusSave     =   ($save)? true : false;
                }else{
                    $message    =   $this->fV->error_string();
                }
            }

            header('Content-Type:application/json');
            echo    json_encode(['statusSave' => $statusSave, 'message' => $message]);
        }
	}