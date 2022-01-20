<?php
	class LanggananModel extends CI_Model{
        var $exportToExcel      =   'excel';
        var $exportScopeAll     =   'all';

		public function __construct(){
            $this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelLangganan     =   $this->tabel->langganan;

            $this->db->select('id');
            $getNumberOfData    =   $this->db->get($tabelLangganan);

            return $getNumberOfData->num_rows();
        }
        public function getLangganan($id = null, $options = null){
            $tabelLangganan     =   $this->tabel->langganan;

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
            $getLangganan   =   $this->db->get($tabelLangganan);

            if(!is_null($id)){
                $langganan  =   ($getLangganan->num_rows() >= 1)? $getLangganan->row_array() : false;
            }else{
                $langganan  =   ($getLangganan->num_rows() >= 1)? $getLangganan->result_array() : [];
                
                if($useSingleRow){
                    if(count($langganan) >= 1){
	                   $langganan 	=	$langganan[0];
                    }else{
                        $langganan    =   false;
                    }
	            }
            }

            return $langganan;
        }
        public function saveLangganan($idLangganan = null, $dataLangganan = null){
            $tabelLangganan    =   $this->tabel->langganan;
                
            if(is_null($dataLangganan)){
                extract($_POST);
                
                $dataLangganan	=	[
                	'nama'		=>	$nama,
                	'telepon'	=>	$telepon,
                	'email'	   =>	$email
                ];
            }
            
            if(is_null($idLangganan)){
                $saveLangganan       =   $this->db->insert($tabelLangganan, $dataLangganan);
                $idLangganan         =   $this->db->insert_id();

                $isUpdate       =   false;
            }else{
                $this->db->where('id', $idLangganan);
                $saveLangganan   =   $this->db->update($tabelLangganan, $dataLangganan);

                $isUpdate   =   true;
            }

            return ($saveLangganan)? $idLangganan : false;
        }
        public function deleteLangganan($idLangganan = null){
            $tabelLangganan    =   $this->tabel->langganan;

        	$statusDeleteLangganan	=	false;

        	if(!is_null($idLangganan)){
                $detailLangganan     =   $this->getLangganan($idLangganan, ['select' => 'id']);

                if($detailLangganan !== false){
    	            $this->db->where('id', $idLangganan);
    	            $deleteLangganan     =   $this->db->delete($tabelLangganan);

    	            $statusDeleteLangganan 	=	($deleteLangganan)? true : false;
                }
			}

            return $statusDeleteLangganan;
        }
	}
?>