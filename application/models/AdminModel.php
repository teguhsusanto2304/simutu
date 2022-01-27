<?php
	class AdminModel extends CI_Model{
		public function __construct(){
			$this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelAdmin        =   $this->tabel->admin;

            $this->db->select('userid');
            $allData    =   $this->db->get($tabelAdmin);

            return $allData->num_rows();
        }
        public function isLogin(){
            $this->load->library('session');
            $idAdmin    =   $this->session->userdata('id');
            
            return (!is_null($idAdmin))? $idAdmin : false;
        }
		public function getAdmin($idAdmin = null, $options = null){
            $tabelAdmin        =   $this->tabel->admin;

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
            if(!is_null($idAdmin)){
                $this->db->where('userid', $idAdmin);
            }

            if($orderByOptions === false){
                $this->db->order_by('userid', 'desc');
            }
            $getAdmin    =    $this->db->get($tabelAdmin);

            if(!is_null($idAdmin)){
                $admin  =   ($getAdmin->num_rows() >= 1)? $getAdmin->row_array() : false;
            }else{
                $admin  =   ($getAdmin->num_rows() >= 1)? $getAdmin->result_array() : [];
                
                if($useSingleRow){
                    if(count($admin) >= 1){
                        $admin  =   $admin[0];
                    }else{
                        $admin  =   false;
                    }
                }
            }

            return $admin;
        }
        public function deleteAdminImage($imagePath){
            if(file_exists($imagePath)){
                if(is_file($imagePath)){
                    unlink($imagePath);
                }
            }
        }
        public function saveAdmin($idAdmin = null, $dataAdmin = null){
            $tabelAdmin    =   $this->tabel->admin;
                
            if(is_null($dataAdmin)){
                extract($_POST);
            
                $dataAdmin =   [
                    'nama'          =>  $nama,
                    'alamat'        =>  $alamat,
                    'email'         =>  $email,
                    'telepon'       =>  $telepon,
                    'username'      =>  $username,
                    'password'      =>  md5($password)
                ];

                if(!is_null($idAdmin)){
                    $dataAdmin['updatedBy']     =   $this->isLogin();
                    $dataAdmin['updatedAt']     =   date('Y-m-d H:i:s');
                }else{
                    $dataAdmin['createdBy']     =   $this->isLogin();   
                }
            }

            if(is_null($idAdmin)){
                $saveAdmin  =   $this->db->insert($tabelAdmin, $dataAdmin);
                $idAdmin    =   $this->db->insert_id();
                $isUpdate   =   false;
            }else{
                $this->db->where('userid', $idAdmin);
                $saveAdmin  =   $this->db->update($tabelAdmin, $dataAdmin);
                $isUpdate   =   true;
            }

            if(isset($_FILES['img'])){
                $img   =   $_FILES['img'];
                if($img !== false){
                    $uploadGambarAdmin     =   $this->path->uploadGambarAdmin;

                    if($isUpdate){
                        $this->load->library('DefaultImage');
                        $defaultAdminImage  =   $this->defaultimage->admin;

                        $detailAdmin    =   $this->getAdmin($idAdmin, ['select' => 'foto']);
                        $oldAdminImage  =   $detailAdmin['foto'];

                        if(strtolower($oldAdminImage) != strtolower($defaultAdminImage)){
                            $realImagePath      =   $uploadGambarAdmin.'/'.$oldAdminImage;
                            $compressImagePath  =   $uploadGambarAdmin.'/compress/'.$oldAdminImage;

                            $deleteOldRealAdminImage       =   $this->deleteAdminImage($realImagePath);
                            $deleteOldCompressAdminImage   =   $this->deleteAdminImage($compressImagePath);
                        }
                    }

                    $this->load->library('Unggah');

                    $fileType       =   $img['type'];
                    $fileTypeArray  =   explode('/', $fileType);
                    $ekstensiFile   =   $fileTypeArray[1];

                    $fileName   =   'Admin_'.$idAdmin.'_'.date('Ymd').'_'.date('His').'.'.$ekstensiFile;

                    $maxWidth   =   1024*5;
                    $maxHeight  =   1024*5;
                    $maxSize    =   1024*5;

                    $config     =   $this->unggah->configUnggah($uploadGambarAdmin, $maxWidth, $maxHeight, $maxSize, 'jpg|jpeg|png', $fileName);
                    $this->load->library('upload', $config);
                    if($this->upload->do_upload('img')){
                        
                        $this->db->where('userid', $idAdmin);
                        $ubahGambarAdmin   =   $this->db->update($tabelAdmin, ['foto' => $fileName]);

                        $sourceImage    =   $uploadGambarAdmin.'/'.$fileName;
                        $destination    =   $uploadGambarAdmin.'/compress/'.$fileName;

                        list($width, $height)   =   getimagesize($sourceImage);

                        $this->unggah->resizeImage($sourceImage, $destination, $width/2, $height/2);
                    }
                }
            }

            return ($saveAdmin)? $idAdmin : false;
        }
        public function deleteAdmin($idAdmin = null){
            $statusDelete   =   false;
            $tabelAdmin     =   $this->tabel->admin;

            if(!is_null($idAdmin)){
                $this->db->where('userid', $idAdmin);
                $deleteAdmin  =   $this->db->delete($tabelAdmin);

                $statusDelete   =   ($deleteAdmin)? true : false;
            }

            return $statusDelete;
        }
        public function entityHasBeenUsedByAnotherAdmin($idAdmin, $entity = null){
            $tabelAdmin     =   $this->tabel->admin;

            if(!is_null($entity)){
                if(is_array($entity)){
                    $this->db->where('userid !=', $idAdmin);
                    $this->db->where($entity);
                    $get    =   $this->db->get($tabelAdmin);

                    return ($get->num_rows() >= 1);
                }
            }
            return false;
        }
	}
?>