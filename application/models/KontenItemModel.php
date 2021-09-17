<?php
	class KontenItemModel extends CI_Model{
		public function __construct(){
            $this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelKontenItem    =   $this->tabel->kontenItem;

            $this->db->select('id');
            $getNumberOfData    =   $this->db->get($tabelKontenItem);

            return $getNumberOfData->num_rows();
        }
        public function getKontenItem($id = null, $options = null){
            $tabelKontenItem     =   $this->tabel->kontenItem;

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
            $getKontenItem   =   $this->db->get($tabelKontenItem);

            if(!is_null($id)){
                $kontenItem  =   ($getKontenItem->num_rows() >= 1)? $getKontenItem->row_array() : false;
            }else{
                $kontenItem  =   ($getKontenItem->num_rows() >= 1)? $getKontenItem->result_array() : [];
                
                if($useSingleRow){
                    if(count($kontenItem) >= 1){
	                   $kontenItem 	=	$kontenItem[0];
                    }else{
                        $kontenItem    =   false;
                    }
	            }
            }

            return $kontenItem;
        }        
        public function deleteKontenItemImage($imagePath){
            if(file_exists($imagePath)){
                if(is_file($imagePath)){
                    unlink($imagePath);
                }
            }
        }
        public function saveKontenItem($idKontenItem = null, $dataKontenItem = null){
            $tabelKontenItem    =   $this->tabel->kontenItem;
                
            if(is_null($dataKontenItem)){
                extract($_POST);

                $this->load->library('session');
                $activeAdminID  =   $this->session->userdata('id');

                $dataKontenItem =   [
                    'nama'      =>  $nama,
                    'rating'    =>  $rating,
                    'harga'     =>  $harga,
                    'diskon'    =>  $diskon,
                    'deskripsi' =>  $deskripsi
                ];

                if(is_null($idKontenItem)){
                    $dataKontenItem['createdBy']  =   $activeAdminID;
                }else{
                    $dataKontenItem['updatedBy']  =   $activeAdminID;
                    $dataKontenItem['updatedAt']  =   now();
                }
            }
            
            if(is_null($idKontenItem)){
                $saveKontenItem =   $this->db->insert($tabelKontenItem, $dataKontenItem);
                $idKontenItem   =   $this->db->insert_id();

                $isUpdate   =   false;
            }else{
                $this->db->where('id', $idKontenItem);
                $saveKontenItem   =   $this->db->update($tabelKontenItem, $dataKontenItem);

                $isUpdate   =   true;
            }
            
            if($saveKontenItem !== false){                
                if(isset($_FILES['foto'])){
                    $img   =   $_FILES['foto'];
                    if($img !== false){
                        $this->load->library('DefaultImage');

                        $defaultKontenItemImage    =   $this->defaultimage->kontenItem;
                        $uploadGambarKontenItem    =   $this->path->uploadGambarKontenItem;

                        if($isUpdate){
                            $detailKontenItem   =   $this->getKontenItem($idKontenItem, ['select' => 'foto']);
                            $oldKontenItemImage =   $detailKontenItem['foto'];

                            if(strtolower($oldKontenItemImage) !== strtolower($defaultKontenItemImage)){
                                $realImagePath      =   $uploadGambarKontenItem.'/'.$oldKontenItemImage;
                                $compressImagePath  =   $uploadGambarKontenItem.'/compress/'.$oldKontenItemImage;

                                $this->deleteKontenItemImage($realImagePath);
                                $this->deleteKontenItemImage($compressImagePath);
                            }
                        }

                        $this->load->library('Unggah');

                        $fileType       =   $img['type'];
                        $fileTypeArray  =   explode('/', $fileType);
                        $ekstensiFile   =   $fileTypeArray[1];

                        $fileName   =   'KontenItem_'.$idKontenItem.'_'.date('Ymd').'_'.date('His').'.'.$ekstensiFile;

                        $config     =   $this->unggah->configUnggah($uploadGambarKontenItem, 1024 * 5, 1024 * 5, 2048, 'jpg|jpeg|png', $fileName);
                        $this->load->library('upload', $config);
                        if($this->upload->do_upload('foto')){
                            $this->db->where('id', $idKontenItem);
                            $saveKontenItemImage      =   $this->db->update($tabelKontenItem, ['foto' => $fileName]);

                            $sourceImage    =   $uploadGambarKontenItem.'/'.$fileName;
                            $destination    =   $uploadGambarKontenItem.'/compress/'.$fileName;
                            $this->unggah->resizeImage($sourceImage, $destination, 200, 200);
                        }
                    }
                }
            }

            return ($saveKontenItem)? $idKontenItem : false;
        }
        public function deleteKontenItem($idKontenItem = null){
            $tabelKontenItem    =   $this->tabel->kontenItem;

        	$statusDeleteKontenItem    =	false;

        	if(!is_null($idKontenItem)){
                $detailKontenItem      =   $this->getKontenItem($idKontenItem, ['select' => 'foto']);

                if($detailKontenItem !== false){
                    $this->load->library('DefaultImage');

                    $defaultKontenItemImage =   $this->defaultimage->kontenItem;
                    $fotoKontenItem         =   $detailKontenItem['foto'];

                    if(strtolower($fotoKontenItem) !== strtolower($defaultKontenItemImage)){
                        $uploadGambarKontenItem   =   $this->path->uploadGambarKontenItem;

                        $this->deleteKontenItemImage($uploadGambarKontenItem.'/'.$fotoKontenItem);
                        $this->deleteKontenItemImage($uploadGambarKontenItem.'/compress/'.$fotoKontenItem);
                    }

    	            $this->db->where('id', $idKontenItem);
    	            $deleteKontenItem     =   $this->db->delete($tabelKontenItem);

    	            $statusDeleteKontenItem 	=	($deleteKontenItem)? true : false;
                }
			}

            return $statusDeleteKontenItem;
        }
	}
?>