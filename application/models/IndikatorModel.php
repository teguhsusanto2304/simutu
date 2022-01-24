<?php
	class IndikatorModel extends CI_Model{
		public function __construct(){
			$this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelIndikator        =   $this->tabel->indikator;

            $this->db->select('indikatorId');
            $allData    =   $this->db->get($tabelIndikator);

            return $allData->num_rows();
        }
		public function getIndikator($indikator = null, $options = null){
            $tabelIndikator        =   $this->tabel->indikator;

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
            if(!is_null($indikator)){
                $this->db->where('pT.indikatorId', $indikator);
            }

            if($orderByOptions === false){
                $this->db->order_by('pT.indikatorId', 'desc');
            }
            $getIndikator    =    $this->db->get($tabelIndikator.' pT'); //pT = primary table (tabel utama)

            if(!is_null($indikator)){
                $indikator  =   ($getIndikator->num_rows() >= 1)? $getIndikator->row_array() : false;
            }else{
                $indikator  =   ($getIndikator->num_rows() >= 1)? $getIndikator->result_array() : [];
                
                if($useSingleRow){
                    if(count($indikator) >= 1){
                        $indikator  =   $indikator[0];
                    }else{
                        $indikator  =   false;
                    }
                }
            }

            return $indikator;
        }
        public function saveIndikator($idIndikator = null, $dataIndikator = null){
            $tabelIndikator    =   $this->tabel->indikator;
                
            if(is_null($dataIndikator)){
                extract($_POST);
            
                $dataIndikator   =   [
                    'kodePernyataan'        =>  $kodePernyataan,
                    'kodeIndikator'         =>  $kodeIndikator,
                    'namaIndikatorDokumen'  =>  $namaIndikatorDokumen,
                    'userid'                =>  $this->user->isLogin(),
                    'createdDate'           =>  now()
                ];
            }

            if(is_null($idIndikator)){
                $saveIndikatorDokumen  =   $this->db->insert($tabelIndikator, $dataIndikator);
                $idIndikator    =   $this->db->insert_id();

                $isUpdate   =   false;
            }else{
                $this->db->where('indikatorId', $idIndikator);
                $saveIndikatorDokumen  =   $this->db->update($tabelIndikator, $dataIndikator);
                $isUpdate   =   true;
            }

            return ($saveIndikatorDokumen)? $idIndikator : false;
        }
        public function deleteIndikator($indikator = null){
            $statusDelete   =   false;
            $messageDelete  =   null;

            $tabelIndikator     =   $this->tabel->indikator;

            // cek ke indikator
            // if(!is_null($indikator)){
            //     $options        =   [
            //         'select'        =>  'kodeSubStandar',
            //         'useSingleRow'  =>  true
            //     ];
            //     $detailSubStandart =   $this->getIndikator($indikator, $options);

            //     if($detailSubStandart !== false){
            //         $kodeSubStandar    =   $detailSubStandart['kodeSubStandar'];

            //         $this->load->model('SubStandartModel', 'subStandart');

            //         $options        =   [
            //             'select'    =>  'indikatorId',
            //             'where'     =>  [
            //                 'kodeSubStandar'   =>  $kodeSubStandar
            //             ]
            //         ];
            //         $indikator    =   $this->subStandart->getIndikator(null, $options);

            //         if(count($indikator) <= 0){
                        $this->db->where('indikatorId', $indikator);
                        $deleteStandart  =   $this->db->delete($tabelIndikator);

                        $statusDelete   =   ($deleteStandart)? true : false;
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