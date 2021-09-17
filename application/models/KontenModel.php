<?php
	class KontenModel extends CI_Model{
		public function __construct(){
            $this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelKonten     =   $this->tabel->konten;

            $this->db->select('id');
            $getNumberOfData    =   $this->db->get($tabelKonten);

            return $getNumberOfData->num_rows();
        }
        public function getKonten($id = null, $options = null){
            $tabelKonten     =   $this->tabel->konten;

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
            $getKonten   =   $this->db->get($tabelKonten);

            if(!is_null($id)){
                $konten  =   ($getKonten->num_rows() >= 1)? $getKonten->row_array() : false;
            }else{
                $konten  =   ($getKonten->num_rows() >= 1)? $getKonten->result_array() : [];
                
                if($useSingleRow){
                    if(count($konten) >= 1){
	                   $konten 	=	$konten[0];
                    }else{
                        $konten    =   false;
                    }
	            }
            }

            return $konten;
        }
        public function saveKonten($idKonten = null, $dataKonten = null){
            $tabelKonten    =   $this->tabel->konten;
                
            if(is_null($dataKonten)){
                extract($_POST);

                $this->load->library('session');
                $activeAdminID  =   $this->session->userdata('id');

                $dataKonten =   [
                    'page'              =>  $page,
                    'namaDivisi'        =>  $namaDivisi,
                    'deskripsiDivisi'   =>  $deskripsiDivisi,
                    'urutan'            =>  $urutan
                ];

                if(is_null($idKonten)){
                    $dataKonten['createdBy']  =   $activeAdminID;
                }else{
                    $dataKonten['updatedBy']  =   $activeAdminID;
                    $dataKonten['updatedAt']  =   now();
                }
            }
            
            if(is_null($idKonten)){
                $saveKonten =   $this->db->insert($tabelKonten, $dataKonten);
                $idKonten   =   $this->db->insert_id();

                $isUpdate   =   false;
            }else{
                $this->db->where('id', $idKonten);
                $saveKonten   =   $this->db->update($tabelKonten, $dataKonten);

                $isUpdate   =   true;
            }

            return ($saveKonten)? $idKonten : false;
        }
        public function deleteKonten($idKonten = null){
            $tabelKonten    =   $this->tabel->konten;

        	$statusDeleteKonten    =	false;

        	if(!is_null($idKonten)){
                $this->db->where('id', $idKonten);
                $deleteKonten     =   $this->db->delete($tabelKonten);

                $statusDeleteKonten     =   ($deleteKonten)? true : false;
			}

            return $statusDeleteKonten;
        }
	}
?>