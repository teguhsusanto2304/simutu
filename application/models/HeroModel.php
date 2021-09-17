<?php
	class HeroModel extends CI_Model{
		public function __construct(){
            $this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelHero     =   $this->tabel->hero;

            $this->db->select('id');
            $getNumberOfData    =   $this->db->get($tabelHero);

            return $getNumberOfData->num_rows();
        }
        public function getHero($id = null, $options = null){
            $tabelHero     =   $this->tabel->hero;

            $orderByOptions     =   false;
            $useSingleRow 		=	false;
            if(!is_null($options)){
                if(is_array($options)){
                    if(array_key_exists('select', $options)){
                        $select     =   $options['select'];
                        $this->db->select($select);
                    }
                    if(array_key_exists('where', $options)){
                        $where  =   $options['where'];
                        $this->db->where($where);
                    }
                    if(array_key_exists('whereGroup', $options)){
                        $whereGroup     =   $options['whereGroup'];
                        if(is_array($whereGroup)){
                            $this->db->group_start();

                            if(array_key_exists('operator', $whereGroup) && array_key_exists('where', $whereGroup)){
                                $operator       =   $whereGroup['operator'];
                                $whereCondition =   $whereGroup['where'];   
                                
                                if($operator === 'or'){
                                    if(is_array($whereCondition)){
                                        if(count($whereCondition) >= 1){
                                            foreach($whereCondition as $index => $wC){
                                                if($index == 0){
                                                    $this->db->where($wC);
                                                }else{
                                                    $this->db->or_where($wC);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            
                            $this->db->group_end();
                        }
                    }
                    if(array_key_exists('where_not_in', $options)){
                        $whereNotIn  =   $options['where_not_in'];
                        $whereNotInColumn   =   $whereNotIn['column'];
                        $whereNotInValues   =   $whereNotIn['values'];

                        $this->db->where_not_in($whereNotInColumn, $whereNotInValues);
                    }
                    if(array_key_exists('limit', $options)){
                        $limit              =   $options['limit'];
                        $limitStartFrom     =   (array_key_exists('limitStartFrom', $options))? $options['limitStartFrom'] : false;

                        if($limitStartFrom !== false){
                            $this->db->limit($limit, $limitStartFrom);
                        }else{
                            $this->db->limit($limit);
                        }
                    }
                    if(array_key_exists('where_in', $options)){
                        $whereInColumn  =   $options['where_in']['column'];
                        $whereInValues  =   $options['where_in']['values'];
                        
                        $this->db->where_in($whereInColumn, $whereInValues);
                    }
                    if(array_key_exists('like', $options)){
                        $like  =   $options['like'];
                        if(is_array($like)){
                            $column     =   $like['column'];
                            $value      =   $like['value'];
                            
                            $this->db->group_start();

                            if(is_array($column)){
                                foreach($column as $indexData => $kolom){
                                    if($indexData == 0){
                                        $this->db->like($kolom, $value);
                                    }else{
                                        $this->db->or_like($kolom, $value);
                                    }
                                }
                            }
                            if(is_string($column)){
                                $this->db->like($column, $value);
                            }

                            $this->db->group_end();
                        }
                    }
                    if(array_key_exists('order_by', $options)){
                        $orderBy    =   $options['order_by'];
                        if(is_array($orderBy)){
                            $orderByOptions =   true;

                            $orderByColumn          =   $orderBy['column'];
                            $orderByOrientation     =   $orderBy['orientation'];
                            
                            $this->db->order_by($orderByColumn, $orderByOrientation);
                        }
                    }
                    if(array_key_exists('useSingleRow', $options)){
                    	$useSingleRow 	=	$options['useSingleRow'];
                    }
                }
            }

            if(!is_null($id)){
                $this->db->where('id', $id);
            }
            
            if($orderByOptions === false){
                $this->db->order_by('id', 'desc');
            }
            $getHero   =   $this->db->get($tabelHero);

            if(!is_null($id)){
                $hero  =   ($getHero->num_rows() >= 1)? $getHero->row_array() : false;
            }else{
                $hero  =   ($getHero->num_rows() >= 1)? $getHero->result_array() : [];
                
                if($useSingleRow){
                    if(count($hero) >= 1){
	                   $hero 	=	$hero[0];
                    }else{
                        $hero    =   false;
                    }
	            }
            }

            return $hero;
        }
        public function deleteHeroImage($imagePath){
            if(file_exists($imagePath)){
                if(is_file($imagePath)){
                    unlink($imagePath);
                }
            }
        }
        public function saveHero($idHero = null, $dataHero = null){
            $tabelHero    =   $this->tabel->hero;
                
            if(is_null($dataHero)){
                extract($_POST);

                $this->load->library('session');
                $activeAdminID  =   $this->session->userdata('id');

                $dataHero	=	[
                	'judul'     =>	$judul,
                	'deskripsi'	=>	$deskripsi,
                    'urutan'    =>  $urutan
                ];

                if(is_null($idHero)){
                    $dataHero['createdBy']  =   $activeAdminID;
                }else{
                    date_default_timezone_set('Asia/Jakarta');

                    $dataHero['updatedBy']  =   $activeAdminID;
                    $dataHero['updatedAt']  =   date('Y-m-d H:i:s');
                }
            }
            
            if(is_null($idHero)){
                $saveHero   =   $this->db->insert($tabelHero, $dataHero);
                $idHero     =   $this->db->insert_id();

                $isUpdate   =   false;
            }else{
                $this->db->where('id', $idHero);
                $saveHero   =   $this->db->update($tabelHero, $dataHero);

                $isUpdate   =   true;
            }

            if($saveHero !== false){                
                if(isset($_FILES['foto'])){
                    $img   =   $_FILES['foto'];
                    if($img !== false){
                        $this->load->library('DefaultImage');

                        $defaultHeroImage    =   $this->defaultimage->hero;
                        $uploadGambarHero    =   $this->path->uploadGambarHero;

                        if($isUpdate){
                            $detailHero     =   $this->getHero($idHero, ['select' => 'foto']);
                            $oldHeroImage   =   $detailHero['foto'];

                            if(strtolower($oldHeroImage) !== strtolower($defaultHeroImage)){
                                $realImagePath      =   $uploadGambarHero.'/'.$oldHeroImage;
                                $compressImagePath  =   $uploadGambarHero.'/compress/'.$oldHeroImage;

                                $this->deleteHeroImage($realImagePath);
                                $this->deleteHeroImage($compressImagePath);
                            }
                        }

                        $this->load->library('Unggah');

                        $fileType       =   $img['type'];
                        $fileTypeArray  =   explode('/', $fileType);
                        $ekstensiFile   =   $fileTypeArray[1];

                        $fileName   =   'Hero_'.$idHero.'_'.date('Ymd').'_'.date('His').'.'.$ekstensiFile;

                        $config     =   $this->unggah->configUnggah($uploadGambarHero, 1024 * 5, 1024 * 5, 2048, 'jpg|jpeg|png', $fileName);
                        $this->load->library('upload', $config);
                        if($this->upload->do_upload('foto')){
                            $this->db->where('id', $idHero);
                            $saveHeroImage      =   $this->db->update($tabelHero, ['foto' => $fileName]);

                            $sourceImage    =   $uploadGambarHero.'/'.$fileName;
                            $destination    =   $uploadGambarHero.'/compress/'.$fileName;
                            $this->unggah->resizeImage($sourceImage, $destination, 300, 300);
                        }
                    }
                }
            }

            return ($saveHero)? $idHero : false;
        }
        public function deleteHero($idHero = null){
            $tabelHero    =   $this->tabel->hero;

        	$statusDeleteHero    =	false;

        	if(!is_null($idHero)){
                $detailHero      =   $this->getHero($idHero, ['select' => 'foto']);

                if($detailHero !== false){
                    $this->load->library('DefaultImage');

                    $defaultHeroImage   =   $this->defaultimage->hero;
                    $fotoHero           =   $detailHero['foto'];

                    if(strtolower($fotoHero) !== strtolower($defaultHeroImage)){
                        $uploadGambarHero   =   $this->path->uploadGambarHero;

                        $this->deleteHeroImage($uploadGambarHero.'/'.$fotoHero);
                        $this->deleteHeroImage($uploadGambarHero.'/compress/'.$fotoHero);
                    }

    	            $this->db->where('id', $idHero);
    	            $deleteHero     =   $this->db->delete($tabelHero);

    	            $statusDeleteHero 	=	($deleteHero)? true : false;
                }
			}

            return $statusDeleteHero;
        }
	}
?>