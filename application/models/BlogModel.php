<?php
	class BlogModel extends CI_Model{
		public function __construct(){
            $this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelBlog     =   $this->tabel->blog;

            $this->db->select('id');
            $getNumberOfData    =   $this->db->get($tabelBlog);

            return $getNumberOfData->num_rows();
        }
        public function getBlog($id = null, $options = null){
            $tabelBlog     =   $this->tabel->blog;

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
            $getBlog   =   $this->db->get($tabelBlog);

            if(!is_null($id)){
                $blog  =   ($getBlog->num_rows() >= 1)? $getBlog->row_array() : false;
            }else{
                $blog  =   ($getBlog->num_rows() >= 1)? $getBlog->result_array() : [];
                
                if($useSingleRow){
                    if(count($blog) >= 1){
	                   $blog 	=	$blog[0];
                    }else{
                        $blog    =   false;
                    }
	            }
            }

            return $blog;
        }
        public function deleteBlogImage($imagePath){
            if(file_exists($imagePath)){
                if(is_file($imagePath)){
                    unlink($imagePath);
                }
            }
        }
        public function generatePermalink($title = null){
            $permalink  =   '';
            if(!is_null($title)){
                $titleLC    =   strtolower($title);

                $permalink  =   str_replace(' ', '-', $titleLC);
                $permalink  =   preg_replace('/[^A-Za-z0-9\-]/', '', $permalink);
            }
            return $permalink;
        }
        public function saveBlog($idBlog = null, $dataBlog = null){
            $tabelBlog    =   $this->tabel->blog;
                
            if(is_null($dataBlog)){
                extract($_POST);

                $this->load->library('session');
                $activeAdminID  =   $this->session->userdata('id');
                
                $permalink  =   $this->generatePermalink($title);

                $dataBlog	=	[
                	'title'		=>	$title,
                	'content'	=>	$content,
                	'permalink'	=>	$permalink
                ];

                if(is_null($idBlog)){
                    $dataBlog['createdBy']  =   $activeAdminID;
                }else{
                    date_default_timezone_set('Asia/Jakarta');

                    $dataBlog['updatedBy']  =   $activeAdminID;
                    $dataBlog['updatedAt']  =   date('Y-m-d H:i:s');
                }
            }
            
            if(is_null($idBlog)){
                $saveBlog       =   $this->db->insert($tabelBlog, $dataBlog);
                $idBlog         =   $this->db->insert_id();

                $isUpdate       =   false;
            }else{
                $this->db->where('id', $idBlog);
                $saveBlog   =   $this->db->update($tabelBlog, $dataBlog);

                $isUpdate   =   true;
            }

            if($saveBlog !== false){
                $statusSaveBlog =   true;
                
                if(isset($_FILES['img'])){
                    $img   =   $_FILES['img'];
                    if($img !== false){
                        $this->load->library('DefaultImage');
                        $this->load->library('Path');

                        $defaultBlogImage   =   $this->defaultimage->blog;
                        $uploadGambarBlog   =   $this->path->uploadGambarBlog;

                        if($isUpdate){
                            $detailBlog     =   $this->getBlog($idBlog, ['select' => 'foto']);
                            $oldBlogImage   =   $detailBlog['foto'];

                            if(strtolower($oldBlogImage) !== strtolower($defaultBlogImage)){
                                $realImagePath      =   $uploadGambarBlog.'/'.$oldBlogImage;
                                $compressImagePath  =   $uploadGambarBlog.'/compress/'.$oldBlogImage;

                                $this->deleteBlogImage($realImagePath);
                                $this->deleteBlogImage($compressImagePath);
                            }
                        }

                        $this->load->library('Unggah');

                        $fileType       =   $img['type'];
                        $fileTypeArray  =   explode('/', $fileType);
                        $ekstensiFile   =   $fileTypeArray[1];

                        $fileName   =   'Blog_'.$idBlog.'_'.date('Ymd').'_'.date('His').'.'.$ekstensiFile;

                        $config     =   $this->unggah->configUnggah($uploadGambarBlog, 1024 * 5, 1024 * 5, 2048, 'jpg|jpeg|png', $fileName);
                        $this->load->library('upload', $config);
                        if($this->upload->do_upload('img')){
                            $this->db->where('id', $idBlog);
                            $saveBlogImage      =   $this->db->update($tabelBlog, ['foto' => $fileName]);

                            $sourceImage    =   $uploadGambarBlog.'/'.$fileName;
                            $destination    =   $uploadGambarBlog.'/compress/'.$fileName;

                            list($width, $height)   =   getimagesize($sourceImage);
                            $this->unggah->resizeImage($sourceImage, $destination, $width / 2, $height / 2);
                        }
                    }
                }
            }

            return ($saveBlog)? $idBlog : false;
        }
        public function deleteBlog($idBlog = null){
            $tabelBlog    =   $this->tabel->blog;

        	$statusDeleteBlog	=	false;

        	if(!is_null($idBlog)){
                $detailBlog     =   $this->getBlog($idBlog, ['select' => 'foto']);

                if($detailBlog !== false){
                    $this->load->library('DefaultImage');

                    $defaultBlogImage   =   $this->defaultimage->blog;
                    $fotoBlog           =   $detailBlog['foto'];

                    if(strtolower($fotoBlog) !== strtolower($defaultBlogImage)){
                        $this->load->library('Path');
                        $uploadGambarBlog   =   $this->path->uploadGambarBlog;

                        $this->deleteBlogImage($uploadGambarBlog.'/'.$fotoBlog);
                        $this->deleteBlogImage($uploadGambarBlog.'/compress/'.$fotoBlog);
                    }

    	            $this->db->where('id', $idBlog);
    	            $deleteBlog     =   $this->db->delete($tabelBlog);

    	            $statusDeleteBlog 	=	($deleteBlog)? true : false;
                }
			}

            return $statusDeleteBlog;
        }
	}
?>