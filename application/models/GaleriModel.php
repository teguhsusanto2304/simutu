<?php
	class GaleriModel extends CI_Model{
		public function __construct(){
			$this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelGaleri        =   $this->tabel->galeri;

            $this->db->select('id');
            $allData    =   $this->db->get($tabelGaleri);

            return $allData->num_rows();
        }
		public function getGaleri($idGaleri = null, $options = null){
            $tabelGaleri        =   $this->tabel->galeri;

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
            if(!is_null($idGaleri)){
                $this->db->where('id', $idGaleri);
            }

            if($orderByOptions === false){
                $this->db->order_by('id', 'desc');
            }
            $getGaleri    =    $this->db->get($tabelGaleri);

            if(!is_null($idGaleri)){
                $galeri  =   ($getGaleri->num_rows() >= 1)? $getGaleri->row_array() : false;
            }else{
                $galeri  =   ($getGaleri->num_rows() >= 1)? $getGaleri->result_array() : [];
                
                if($useSingleRow){
                    if(count($galeri) >= 1){
                        $galeri  =   $galeri[0];
                    }else{
                        $galeri  =   false;
                    }
                }
            }

            return $galeri;
        }
        public function deleteGaleriImage($imagePath){
            if(file_exists($imagePath)){
                if(is_file($imagePath)){
                    unlink($imagePath);
                }
            }
        }
        public function saveGaleri($idGaleri = null, $dataGaleri = null){
            $tabelGaleri    =   $this->tabel->galeri;
                
            if(is_null($dataGaleri)){
                extract($_POST);
            
                $this->load->library('session');
                $activeAdminID  =   $this->session->userdata('id');

                $dataGaleri =   [
                    'judul'     =>  $judul,
                    'deskripsi' =>  $deskripsi
                ];

                if(is_null($idGaleri)){
                    $dataBlog['createdBy']  =   $activeAdminID;
                }else{
                    date_default_timezone_set('Asia/Jakarta');

                    $dataBlog['updatedBy']  =   $activeAdminID;
                    $dataBlog['updatedAt']  =   now();
                }
            }

            if(is_null($idGaleri)){
                $saveGaleri  =   $this->db->insert($tabelGaleri, $dataGaleri);
                $idGaleri    =   $this->db->insert_id();
                $isUpdate   =   false;
            }else{
                $this->db->where('id', $idGaleri);
                $saveGaleri  =   $this->db->update($tabelGaleri, $dataGaleri);
                $isUpdate   =   true;
            }

            if(isset($_FILES['foto'])){
                $foto   =   $_FILES['foto'];
                if($foto !== false){
                    $uploadGambarGaleri     =   $this->path->uploadGambarGaleri;

                    if($isUpdate){
                        $this->load->library('DefaultImage');
                        $defaultGaleriImage  =   $this->defaultimage->galeri;

                        $detailGaleri       =   $this->getGaleri($idGaleri, ['select' => 'foto']);
                        $oldGaleriImage     =   $detailGaleri['foto'];

                        if(strtolower($oldGaleriImage) != strtolower($defaultGaleriImage)){
                            $realImagePath      =   $uploadGambarGaleri.'/'.$oldGaleriImage;
                            $compressImagePath  =   $uploadGambarGaleri.'/compress/'.$oldGaleriImage;

                            $deleteOldRealGaleriImage       =   $this->deleteGaleriImage($realImagePath);
                            $deleteOldCompressGaleriImage   =   $this->deleteGaleriImage($compressImagePath);
                        }
                    }

                    $this->load->library('Unggah');

                    $fileType       =   $foto['type'];
                    $fileTypeArray  =   explode('/', $fileType);
                    $ekstensiFile   =   $fileTypeArray[1];

                    $fileName   =   'Galeri_'.$idGaleri.'_'.date('Ymd').'_'.date('His').'.'.$ekstensiFile;

                    $maxWidth   =   1024*3;
                    $maxHeight  =   1024*3;
                    $maxSize    =   2048;

                    $config     =   $this->unggah->configUnggah($uploadGambarGaleri, $maxWidth, $maxHeight, $maxSize, 'jpg|jpeg|png', $fileName);
                    $this->load->library('upload', $config);
                    if($this->upload->do_upload('foto')){
                        
                        $this->db->where('id', $idGaleri);
                        $ubahGambarGaleri   =   $this->db->update($tabelGaleri, ['foto' => $fileName]);

                        $sourceImage    =   $uploadGambarGaleri.'/'.$fileName;
                        $destination    =   $uploadGambarGaleri.'/compress/'.$fileName;
                        
                        list($width, $height)   =   getimagesize($sourceImage);
                        $this->unggah->resizeImage($sourceImage, $destination, $width / 2, $height / 2);
                    }
                }
            }

            return ($saveGaleri)? $idGaleri : false;
        }
        public function deleteGaleri($idGaleri = null){
            $statusDelete   =   false;
            $tabelGaleri    =   $this->tabel->galeri;

            if(!is_null($idGaleri)){
                $detailGaleri   =   $this->getGaleri($idGaleri, ['select' => 'foto']);

                if($detailGaleri !== false){
                    $this->load->library('DefaultImage');

                    $defaultGaleriImage     =   $this->defaultimage->galeri;
                    $fotoGaleri             =   $detailGaleri['foto'];

                    if($defaultGaleriImage !== $fotoGaleri){
                        $realImagePath      =   $this->path->uploadGambarGaleri.'/'.$fotoGaleri;
                        $compressImagePath  =   $this->path->uploadGambarGaleri.'/compress/'.$fotoGaleri;

                        $this->deleteGaleriImage($realImagePath);
                        $this->deleteGaleriImage($compressImagePath);
                    }

                    $this->db->where('id', $idGaleri);
                    $deleteGaleri   =   $this->db->delete($tabelGaleri);

                    $statusDelete   =   ($deleteGaleri)? true : false;
                }
            }

            return $statusDelete;
        }
        public function getFoto($idGaleri = null, $fotoOptions = null){
            $getFoto     =   null;

            if(!is_null($idGaleri)){
                if(!empty($idGaleri)){
                    $idGaleri   =   trim($idGaleri);

                    $this->load->model('FotoModel', 'foto');
                    
                    $getFotoOptions   =   [
                        'select'    =>  'foto, nama',
                        'where'     =>  ['idGaleri' => $idGaleri]
                    ];
                    if(!is_null($fotoOptions)){
                        $getFotoOptions =   array_merge($getFotoOptions, $fotoOptions);
                    }
                    $getFoto          =   $this->foto->getFoto(null, $getFotoOptions);
                }
            }
            return $getFoto;
        }
	}
?>