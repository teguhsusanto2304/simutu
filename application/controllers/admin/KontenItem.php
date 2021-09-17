<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class KontenItem extends CI_Controller {
		var $isAdminLoggedIn;

		public function __construct(){
			parent::__construct();
			
			$isLogin 	=	$this->admin->isLogin();
			$this->isAdminLoggedIn	=	$isLogin;
		}
	    public function listKontenItem($idMasterKonten = null){
	        if($this->isAdminLoggedIn){
	            $this->load->model('KontenItemModel', 'kontenItem');

	            $draw       =   $this->input->get('draw');

	            $start      =   $this->input->get('start');
	            $start      =   (!is_null($start))? $start : 0;

	            $length  =   $this->input->get('length');
	            $length  =   (!is_null($length))? $length : 10;

	            $search         =   $this->input->get('search');

	            $options        =   [
	                'select'            =>  'id, foto, nama, harga, diskon, rating, deskripsi, createdBy',
	                'limit'             =>  $length,
	                'limitStartFrom'    =>  $start
	            ];
                
                if(!is_null($idMasterKonten)){
                    if(!empty($idMasterKonten)){
                        $options['where']['idKonten']   =   $idMasterKonten;
                    }
                }
	            
	            if(!is_null($search)){
	                if(is_array($search)){
	                    $searchValue        =   $search['value'];
	                    $options['like']    =   [
	                        'column'    =>  ['nama', 'deskripsi', 'harga', 'diskon'],
	                        'value'     =>  $searchValue
	                    ];
	                }
	            }

	            $listKontenItem    =   $this->kontenItem->getKontenItem(null, $options);

				if(count($listKontenItem) >= 1){
					foreach($listKontenItem as $indexData => $konten){
						if(array_key_exists('createdBy', $konten)){
							$adminOptions	=	[
								'select'	=>	'nama, foto'
							];
							$detailAdmin 	=	$this->admin->getAdmin($konten['createdBy'], $adminOptions);

							$listKontenItem[$indexData]['detailAdmin']	=	$detailAdmin;
						}

                        if(array_key_exists('id', $konten)){
                            $listKontenItem[$indexData]['id']       =   (int) $konten['id'];
                        }
                        if(array_key_exists('harga', $konten)){
                            $listKontenItem[$indexData]['harga']    =   (int) $konten['harga'];
                        }
                        if(array_key_exists('diskon', $konten)){
                            $listKontenItem[$indexData]['diskon']   =   (int) $konten['diskon'];
                        }
                        if(array_key_exists('rating', $konten)){
                            $listKontenItem[$indexData]['rating']   =   (int) $konten['rating'];
                        }
					}
				}

	            $recordsTotal   =   $this->kontenItem->getNumberOfData();

	            $response   =   [
	                'dataKontenItem'    =>  $listKontenItem, 
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
			$statusHapusKontenItem 	=	false;
			$messageHapusKontenItem	=	null;

			if($this->isAdminLoggedIn){
				$this->load->library('form_validation', null, 'fV');

				$this->fV->set_rules('idKontenItem', 'ID Konten Item', 'required|trim|numeric|greater_than_equal_to[1]');
				
				if($this->fV->run()){
					$this->load->model('KontenItemModel', 'kontenItem');
                    
                    $idKontenItem   =   $this->input->post('idKontenItem');
                    $hapusKonten    =   $this->kontenItem->deleteKontenItem($idKontenItem);

                    $statusHapusKontenItem  =   $hapusKonten;
				}else{
					$messageHapusKontenItem	=	$this->fV->error_string();
				}

				$response	=	[
					'statusHapusKontenItem'	    =>	$statusHapusKontenItem,
					'messageHapusKontenItem'	=>	$messageHapusKontenItem
				];

				header('Content-Type:application/json');
				echo json_encode($response);
			}
		}
        public function process_save($idKontenItem = null){
            $statusSave =   false;
            $message    =   null;

            if($this->isAdminLoggedIn){
                $this->load->library('form_validation', null, 'fV');

                $this->fV->set_rules('idKonten', 'ID Konten Master', 'required|trim|numeric|greater_than_equal_to[1]');
                $this->fV->set_rules('nama', 'Nama', 'required|trim');
                $this->fV->set_rules('rating', 'Rating', 'required|trim|exact_length[1]|numeric|greater_than_equal_to[1]|less_than_equal_to[5]');
                $this->fV->set_rules('harga', 'Harga', 'required|trim|numeric|greater_than_equal_to[1]');
                $this->fV->set_rules('diskon', 'Diskon', 'required|trim|numeric|greater_than_equal_to[0]');
                if($this->fV->run()){
                    $idKonten   =   $this->input->post('idKonten');
                    $nama       =   $this->input->post('nama');
                    $rating     =   $this->input->post('rating');
                    $harga      =   $this->input->post('harga');
                    $diskon     =   $this->input->post('diskon');
                    $deskripsi  =   $this->input->post('deskripsi');
                    
                    $dataKonten     =   [
						'idKonten'	=>	$idKonten,
                        'nama'      =>  $nama,
                        'rating'    =>  $rating,
                        'harga'     =>  $harga,
                        'diskon'    =>  $diskon,
                        'deskripsi' =>  $deskripsi
                    ];

                    if(!is_null($idKontenItem)){
                        $dataKonten['updatedBy']  =   $this->isAdminLoggedIn;
                        $dataKonten['updatedAt']  =   now();
                    }else{
                        $dataKonten['createdBy']  =  $this->isAdminLoggedIn;
                    }

                    $this->load->model('KontenItemModel', 'kontenItem');
                    $save   =   $this->kontenItem->saveKontenItem($idKontenItem, $dataKonten);

                    $statusSave =   ($save)? true : false;
                }else{
                    $message    =   $this->fV->error_string();
                }
            }

            header('Content-Type:application/json');
            echo    json_encode(['statusSave' => $statusSave, 'message' => $message]);
        }
	}