<?php
	class FotoModel extends CI_Model{
		public function __construct(){
			$this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelFoto        =   $this->tabel->foto;

            $this->db->select('id');
            $allData    =   $this->db->get($tabelFoto);

            return $allData->num_rows();
        }
		public function getFoto($idFoto = null, $options = null){
            $tabelFoto        =   $this->tabel->foto;

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
            if(!is_null($idFoto)){
                $this->db->where('id', $idFoto);
            }

            if($orderByOptions === false){
                $this->db->order_by('id', 'desc');
            }
            $getFoto    =    $this->db->get($tabelFoto);

            if(!is_null($idFoto)){
                $foto  =   ($getFoto->num_rows() >= 1)? $getFoto->row_array() : false;
            }else{
                $foto  =   ($getFoto->num_rows() >= 1)? $getFoto->result_array() : [];
                
                if($useSingleRow){
                    if(count($foto) >= 1){
                        $foto  =   $foto[0];
                    }else{
                        $foto  =   false;
                    }
                }
            }

            return $foto;
        }
        public function deleteFotoImage($imagePath){
            if(file_exists($imagePath)){
                if(is_file($imagePath)){
                    unlink($imagePath);
                }
            }
        }
        public function saveFoto($idFoto = null, $dataFoto = null){
            $tabelFoto    =   $this->tabel->foto;
                
            if(is_null($dataFoto)){
                extract($_POST);
            
                $this->load->library('session');
                $activeAdminID  =   $this->session->userdata('id');

                $dataFoto =   [
                    'nama'          =>  $nama,
                    'keterangan'    =>  $keterangan,
                    'idGaleri'      =>  $idGaleri
                ];

                if(is_null($idFoto)){
                    $dataFoto['createdBy']  =   $activeAdminID;
                }else{
                    date_default_timezone_set('Asia/Jakarta');

                    $dataFoto['updatedBy']  =   $activeAdminID;
                    $dataFoto['updatedAt']  =   now();
                }
            }

            if(is_null($idFoto)){
                $saveFoto  =   $this->db->insert($tabelFoto, $dataFoto);
                $idFoto    =   $this->db->insert_id();

                $isUpdate   =   false;
            }else{
                $this->db->where('id', $idFoto);
                $saveFoto  =   $this->db->update($tabelFoto, $dataFoto);
                $isUpdate   =   true;
            }

            if(isset($_FILES['foto'])){
                $foto   =   $_FILES['foto'];
                if($foto !== false){
                    $uploadGambarFoto     =   $this->path->uploadGambarFoto;

                    if($isUpdate){
                        $this->load->library('DefaultImage');
                        $defaultFotoImage  =   $this->defaultimage->foto;

                        $detailFoto     =   $this->getFoto($idFoto, ['select' => 'foto']);
                        $oldFotoImage   =   $detailFoto['foto'];

                        if(strtolower($oldFotoImage) !== strtolower($defaultFotoImage)){
                            $realImagePath      =   $uploadGambarFoto.'/'.$oldFotoImage;
                            $compressImagePath  =   $uploadGambarFoto.'/compress/'.$oldFotoImage;

                            $this->deleteFotoImage($realImagePath);
                            $this->deleteFotoImage($compressImagePath);
                        }
                    }

                    $this->load->library('Unggah');

                    $fileType       =   $foto['type'];
                    $fileTypeArray  =   explode('/', $fileType);
                    $ekstensiFile   =   $fileTypeArray[1];

                    $fileName   =   'Foto_'.$idFoto.'_'.date('Ymd').'_'.date('His').'.'.$ekstensiFile;

                    $maxWidth   =   1024*3;
                    $maxHeight  =   1024*3;
                    $maxSize    =   2048;

                    $config     =   $this->unggah->configUnggah($uploadGambarFoto, $maxWidth, $maxHeight, $maxSize, 'jpg|jpeg|png', $fileName);
                    $this->load->library('upload', $config);
                    if($this->upload->do_upload('foto')){
                        
                        $this->db->where('id', $idFoto);
                        $ubahGambarFoto   =   $this->db->update($tabelFoto, ['foto' => $fileName]);

                        $sourceImage    =   $uploadGambarFoto.'/'.$fileName;
                        $destination    =   $uploadGambarFoto.'/compress/'.$fileName;
                        $this->unggah->resizeImage($sourceImage, $destination, 200, 100);
                    }
                }
            }

            return ($saveFoto)? $idFoto : false;
        }
        public function deleteFoto($idFoto = null){
            $statusDelete   =   false;
            $tabelFoto      =   $this->tabel->foto;

            if(!is_null($idFoto)){
                $detailFoto   =   $this->getFoto($idFoto, ['select' => 'foto']);

                if($detailFoto !== false){
                    $this->load->library('DefaultImage');

                    $defaultFotoImage   =   $this->defaultimage->foto;
                    $fotoFoto           =   $detailFoto['foto'];

                    if($defaultFotoImage !== $fotoFoto){
                        $realImagePath      =   $this->path->uploadGambarFoto.'/'.$fotoFoto;
                        $compressImagePath  =   $this->path->uploadGambarFoto.'/compress/'.$fotoFoto;

                        $this->deleteFotoImage($realImagePath);
                        $this->deleteFotoImage($compressImagePath);
                    }

                    $this->db->where('id', $idFoto);
                    $deleteFoto   =   $this->db->delete($tabelFoto);

                    $statusDelete   =   ($deleteFoto)? true : false;
                }
            }

            return $statusDelete;
        }
	}
?>