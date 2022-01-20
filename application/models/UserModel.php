<?php
	class UserModel extends CI_Model{
		public function __construct(){
			$this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelUser        =   $this->tabel->user;

            $this->db->select('userid');
            $allData    =   $this->db->get($tabelUser);

            return $allData->num_rows();
        }
        public function isLogin(){
            $this->load->library('session');
            $idUser    =   $this->session->userdata('id');
            
            return (!is_null($idUser))? $idUser : false;
        }
		public function getUser($idUser = null, $options = null){
            $tabelUser        =   $this->tabel->user;

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
                    if(array_key_exists('join', $options)){
                        $join   =   $options['join'];

                        if(is_array($join)){
                            if(count($join) >= 1){
                                foreach($join as $joinItem){
                                    if(array_key_exists('table', $joinItem) && array_key_exists('condition', $joinItem)){
                                        $tableToJoin    =   $joinItem['table'];
                                        $condition      =   $joinItem['condition'];
                                        $type           =   (array_key_exists('type', $joinItem))? $joinItem['type'] : 'left';
            
                                        $this->db->join($tableToJoin, $condition, $type);
                                    }
                                }
                            }
                        }
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
            if(!is_null($idUser)){
                $this->db->where('pT.userid', $idUser);
            }

            if($orderByOptions === false){
                $this->db->order_by('pT.userid', 'desc');
            }
            $getUser    =    $this->db->get($tabelUser.' pT'); //pT = primary table (tabel utama)

            if(!is_null($idUser)){
                $user  =   ($getUser->num_rows() >= 1)? $getUser->row_array() : false;
            }else{
                $user  =   ($getUser->num_rows() >= 1)? $getUser->result_array() : [];
                
                if($useSingleRow){
                    if(count($user) >= 1){
                        $user  =   $user[0];
                    }else{
                        $user  =   false;
                    }
                }
            }

            return $user;
        }
        public function deleteUserImage($imagePath){
            if(file_exists($imagePath)){
                if(is_file($imagePath)){
                    unlink($imagePath);
                }
            }
        }
        public function saveUser($idUser = null, $dataUser = null){
            $tabelUser    =   $this->tabel->user;
                
            if(is_null($dataUser)){
                extract($_POST);
            
                $dataUser   =   [
                    'userid' => $userid,
                    'nip' =>    $nip,
                    'nidn' =>   $nidn,
                    'firstName' =>  $firstName,
                    'lastName' =>   $lastName,
                    'frontTitle' => $frontTitle,
                    'endTitle' =>   $endTitle,
                    'gender' => $gender,
                    'tanggalLahir' =>   $tanggalLahir,
                    'pascasarjana' =>   $pascasarjana,
                    'jabatan' =>    $jabatan,
                    'email' =>  $email,
                    'password' =>   $password,
                    'token' =>  $token,
                    'imageProfile' =>   $imageProfile,
                    'role' =>   $role,
                    'idprogramstudi' => $idprogramstudi,
                    'createdDate'   => $createdDate
                ];
            }

            if(is_null($idUser)){
                $saveUser  =   $this->db->insert($tabelUser, $dataUser);
                $idUser    =   $this->db->insert_id();

                $isUpdate   =   false;
            }else{
                $this->db->where('userid', $idUser);
                $saveUser  =   $this->db->update($tabelUser, $dataUser);
                $isUpdate   =   true;
            }

            if(isset($_FILES['img'])){
                $img   =   $_FILES['img'];
                if($img !== false){
                    $uploadGambarUser     =   $this->path->uploadGambarUser;

                    if($isUpdate){
                        $this->load->library('DefaultImage');
                        $defaultUserImage  =   $this->defaultimage->user;

                        $detailUser    =   $this->getUser($idUser, ['select' => 'imageProfile']);
                        $oldUserImage  =   $detailUser['imageProfile'];

                        if(strtolower($oldUserImage) != strtolower($defaultUserImage)){
                            $realImagePath      =   $uploadGambarUser.'/'.$oldUserImage;
                            $compressImagePath  =   $uploadGambarUser.'/compress/'.$oldUserImage;

                            $deleteOldRealUserImage       =   $this->deleteUserImage($realImagePath);
                            $deleteOldCompressUserImage   =   $this->deleteUserImage($compressImagePath);
                        }
                    }

                    $this->load->library('Unggah');

                    $fileType       =   $img['type'];
                    $fileTypeArray  =   explode('/', $fileType);
                    $ekstensiFile   =   $fileTypeArray[1];

                    $fileName   =   'User_'.$idUser.'_'.date('Ymd').'_'.date('His').'.'.$ekstensiFile;

                    $maxWidth   =   1024*5;
                    $maxHeight  =   1024*5;
                    $maxSize    =   1024*5;

                    $config     =   $this->unggah->configUnggah($uploadGambarUser, $maxWidth, $maxHeight, $maxSize, 'jpg|jpeg|png', $fileName);
                    $this->load->library('upload', $config);
                    if($this->upload->do_upload('img')){
                        
                        $this->db->where('userid', $idUser);
                        $ubahGambarUser   =   $this->db->update($tabelUser, ['imageProfile' => $fileName]);

                        $sourceImage    =   $uploadGambarUser.'/'.$fileName;
                        $destination    =   $uploadGambarUser.'/compress/'.$fileName;

                        list($width, $height)   =   getimagesize($sourceImage);

                        $this->unggah->resizeImage($sourceImage, $destination, $width/2, $height/2);
                    }
                }
            }

            return ($saveUser)? $idUser : false;
        }
        public function deleteUser($idUser = null){
            $statusDelete   =   false;
            $tabelUser     =   $this->tabel->user;

            if(!is_null($idUser)){
                $this->db->where('id', $idUser);
                $deleteUser  =   $this->db->delete($tabelUser);

                $statusDelete   =   ($deleteUser)? true : false;
            }

            return $statusDelete;
        }
        public function entityHasBeenUsedByAnotherUser($idUser, $entity = null){
            $tabelUser     =   $this->tabel->user;

            if(!is_null($entity)){
                if(is_array($entity)){
                    $this->db->where('id !=', $idUser);
                    $this->db->where($entity);
                    $get    =   $this->db->get($tabelUser);

                    return ($get->num_rows() >= 1);
                }
            }
            return false;
        }
	}
?>