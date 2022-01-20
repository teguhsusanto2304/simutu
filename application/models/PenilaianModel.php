<?php
	class PenilaianModel extends CI_Model{
		public function __construct(){
			$this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelPenilaian        =   $this->tabel->penilaian;

            $this->db->select('idPenilaian');
            $allData    =   $this->db->get($tabelPenilaian);

            return $allData->num_rows();
        }
		public function getPenilaian($idPenilaian = null, $options = null){
            $tabelPenilaian        =   $this->tabel->penilaian;

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
            if(!is_null($idPenilaian)){
                $this->db->where('pT.idPenilaian', $idPenilaian);
            }

            if($orderByOptions === false){
                $this->db->order_by('pT.idPenilaian', 'desc');
            }
            $getPenilaian    =    $this->db->get($tabelPenilaian.' pT'); //pT = primary table (tabel utama)

            if(!is_null($idPenilaian)){
                $penilaian  =   ($getPenilaian->num_rows() >= 1)? $getPenilaian->row_array() : false;
            }else{
                $penilaian  =   ($getPenilaian->num_rows() >= 1)? $getPenilaian->result_array() : [];
               
                if($useSingleRow){
                    if(count($penilaian) >= 1){
                        $penilaian  =  $penilaian[0];
                    }else
                        $penilaian  =   false;
                    
                }
            }

            return $penilaian;
        }
        
        public function savePenilaian($idPenilaian = null, $dataRole = null){
            $tabelPenilaian    =   $this->tabel->penilaian;
                
            if(is_null($idPenilaian)){
                $savePenilaian  =   $this->db->insert($tabelPenilaian, $dataRole);
                $idPenilaian    =   $this->db->insert_id();

                $isUpdate   =   false;
            }else{
                $this->db->where('idPenilaian', $idPenilaian);
                $savePenilaian  =   $this->db->update($tabelPenilaian, $dataRole);
                $isUpdate   =   true;
            }

            return ($savePenilaian)? $idPenilaian : false;
        }
        public function deletePenilaian($idPenilaian = null){
            $statusDelete   =   false;
            $tabelPenilaian     =   $this->tabel->penilaian;

            if(!is_null($idPenilaian)){
                $this->db->where('id', $idPenilaian);
                $deletePenilaian  =   $this->db->delete($tabelPenilaian);

                $statusDelete   =   ($deletePenilaian)? true : false;
            }

            return $statusDelete;
        }
	}
?>