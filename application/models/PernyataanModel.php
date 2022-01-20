<?php
	class PernyataanModel extends CI_Model{
		public function __construct(){
			$this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelPernyataan        =   $this->tabel->pernyataan;

            $this->db->select('pernyataanId');
            $allData    =   $this->db->get($tabelPernyataan);

            return $allData->num_rows();
        }
		public function getPernyataan($idPernyataan = null, $options = null){
            $tabelPernyataan        =   $this->tabel->pernyataan;

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
            if(!is_null($idPernyataan)){
                $this->db->where('pT.pernyataanId', $idPernyataan);
            }

            if($orderByOptions === false){
                $this->db->order_by('pT.pernyataanId', 'desc');
            }
            $getPernyataan    =    $this->db->get($tabelPernyataan.' pT'); //pT = primary table (tabel utama)

            if(!is_null($idPernyataan)){
                $pernyataan  =   ($getPernyataan->num_rows() >= 1)? $getPernyataan->row_array() : false;
            }else{
                $pernyataan  =   ($getPernyataan->num_rows() >= 1)? $getPernyataan->result_array() : [];
                
                if($useSingleRow){
                    if(count($pernyataan) >= 1){
                        $pernyataan  =   $pernyataan[0];
                    }else{
                        $pernyataan  =   false;
                    }
                }
            }

            return $pernyataan;
        }
        public function savePernyataan($idPernyataan = null, $dataPernyataan = null){
            $tabelPernyataan    =   $this->tabel->pernyataan;
                
            if(is_null($dataPernyataan)){
                extract($_POST);
            
                $dataPernyataan   =   [
                    'pernyataanId'      =>  $pernyataanId,
                    'kodeSubStandar'    =>  $kodeSubStandar,
                    'kodePernyataan'    =>  $kodePernyataan,  
                    'namaPernyataan'    =>  $namaPernyataan,  
                    'userid'            =>  $userid,  
                    'createdDate' => now()
                ];
            }

            if(is_null($idPernyataan)){
                $savePernyataan  =   $this->db->insert($tabelPernyataan, $dataPernyataan);
                $idPernyataan    =   $this->db->insert_id();

                $isUpdate   =   false;
            }else{
                $this->db->where('pernyataanId', $idPernyataan);
                $savePernyataan  =   $this->db->update($tabelPernyataan, $dataPernyataan);
                $isUpdate   =   true;
            }

            return ($savePernyataan)? $idPernyataan : false;
        }
        public function deletePernyatan($idPernyataan = null){
            $statusDelete   =   false;
            $messageDelete  =   null;

            $tabelStandart     =   $this->tabel->standart;

            //cek ke indikator
            // if(!is_null($idPernyataan)){
            //     $options        =   [
            //         'select'        =>  'kodeSubStandar',
            //         'useSingleRow'  =>  true
            //     ];
            //     $detailSubStandart =   $this->getPernyataan($idPernyataan, $options);

            //     if($detailSubStandart !== false){
            //         $kodeSubStandar    =   $detailSubStandart['kodeSubStandar'];

            //         $this->load->model('SubStandartModel', 'subStandart');

            //         $options        =   [
            //             'select'    =>  'pernyataanId',
            //             'where'     =>  [
            //                 'kodeSubStandar'   =>  $kodeSubStandar
            //             ]
            //         ];
            //         $pernyataan    =   $this->subStandart->getPernyataan(null, $options);

            //         if(count($pernyataan) <= 0){
            //             $this->db->where('standarId', $idPernyataan);
            //             $deleteStandart  =   $this->db->delete($tabelStandart);

            //             $statusDelete   =   ($deleteStandart)? true : false;
            //         }else{
            //             $messageDelete  =   'Maaf, data sudah memiliki relasi!';
            //         }
            //     }else{
            //         $messageDelete  =   'Data Standart tidak ditemukan!';
            //     }
            // }else{
            //     $messageDelete  =   'ID Standart tidak ada!';
            // }

            return ['statusDelete' => $statusDelete, 'messageDelete' => $messageDelete];
        }
	}
?>