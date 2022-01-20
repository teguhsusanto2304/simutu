<?php
	class FAQModel extends CI_Model{
		public function __construct(){
            $this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelFAQ     =   $this->tabel->faq;

            $this->db->select('id');
            $getNumberOfData    =   $this->db->get($tabelFAQ);

            return $getNumberOfData->num_rows();
        }
        public function getFAQ($id = null, $options = null){
            $tabelFAQ     =   $this->tabel->faq;

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
            $getFAQ   =   $this->db->get($tabelFAQ);

            if(!is_null($id)){
                $faq  =   ($getFAQ->num_rows() >= 1)? $getFAQ->row_array() : false;
            }else{
                $faq  =   ($getFAQ->num_rows() >= 1)? $getFAQ->result_array() : [];
                
                if($useSingleRow){
                    if(count($faq) >= 1){
	                   $faq 	=	$faq[0];
                    }else{
                        $faq    =   false;
                    }
	            }
            }

            return $faq;
        }
        public function saveFAQ($idFAQ = null, $dataFAQ = null){
            $tabelFAQ    =   $this->tabel->faq;
                
            if(is_null($dataFAQ)){
                extract($_POST);

                $this->load->library('session');
                $activeAdminID  =   $this->session->userdata('id');

                $dataFAQ	=	[
                	'title'		=>	$title,
                	'content'	=>	$content
                ];

                if(is_null($idFAQ)){
                    $dataFAQ['createdBy']  =   $activeAdminID;
                }else{
                    date_default_timezone_set('Asia/Jakarta');

                    $dataFAQ['updatedBy']  =   $activeAdminID;
                    $dataFAQ['updatedAt']  =   date('Y-m-d H:i:s');
                }
            }
            
            if(is_null($idFAQ)){
                $saveFAQ       =   $this->db->insert($tabelFAQ, $dataFAQ);
                $idFAQ         =   $this->db->insert_id();
            }else{
                $this->db->where('id', $idFAQ);
                $saveFAQ   =   $this->db->update($tabelFAQ, $dataFAQ);
            }

            return ($saveFAQ)? $idFAQ : false;
        }
        public function deleteFAQ($idFAQ = null){
            $tabelFAQ    =   $this->tabel->faq;

        	$statusDeleteFAQ	=	false;

        	if(!is_null($idFAQ)){
                $this->db->where('id', $idFAQ);
                $deleteFAQ     =   $this->db->delete($tabelFAQ);

                $statusDeleteFAQ 	=	($deleteFAQ)? true : false;
			}

            return $statusDeleteFAQ;
        }
	}
?>