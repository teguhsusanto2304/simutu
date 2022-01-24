<?php
	class IndikatorDokumenModel extends CI_Model{
		public function __construct(){
			$this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelIndikatorModel        =   $this->tabel->indikatorDokumen;

            $this->db->select('indikatorDokumenId');
            $allData    =   $this->db->get($tabelIndikatorModel);

            return $allData->num_rows();
        }
		public function getIndikatorDokumen($idIndikatorDokumen = null, $options = null){
            $tabelIndikatorModel        =   $this->tabel->indikatorDokumen;

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
            if(!is_null($idIndikatorDokumen)){
                $this->db->where('pT.indikatorDokumenId', $idIndikatorDokumen);
            }

            if($orderByOptions === false){
                $this->db->order_by('pT.indikatorDokumenId', 'desc');
            }
            $getIndikatorDokumen    =    $this->db->get($tabelIndikatorModel.' pT'); //pT = primary table (tabel utama)

            if(!is_null($idIndikatorDokumen)){
                $indikatorDokumen  =   ($getIndikatorDokumen->num_rows() >= 1)? $getIndikatorDokumen->row_array() : false;
            }else{
                $indikatorDokumen  =   ($getIndikatorDokumen->num_rows() >= 1)? $getIndikatorDokumen->result_array() : [];
                
                if($useSingleRow){
                    if(count($indikatorDokumen) >= 1){
                        $indikatorDokumen  =   $indikatorDokumen[0];
                    }else{
                        $indikatorDokumen  =   false;
                    }
                }
            }

            return $indikatorDokumen;
        }
        public function saveIndikatorDokumen($idIndikatorDokumen = null, $dataIndikatorDokumen = null){
            $tabelIndikatorModel    =   $this->tabel->indikatorDokumen;
                
            if(is_null($dataIndikatorDokumen)){
                extract($_POST);
            
                $dataIndikatorDokumen   =   [
                    'indikatorDokumenId'    =>  $indikatorDokumenId,
                    'kodeIndikator' =>  $kodeIndikator,
                    'namaIndikatorDokumen'  =>  $namaIndikatorDokumen,
                    'userid'    =>  $this->user->isLogin(),
                    'createdDate'   =>  now()
                ];
            }

            if(is_null($idIndikatorDokumen)){
                $saveIndikatorDokumen  =   $this->db->insert($tabelIndikatorModel, $dataIndikatorDokumen);
                $idIndikatorDokumen    =   $this->db->insert_id();

                $isUpdate   =   false;
            }else{
                $this->db->where('indikatorDokumenId', $idIndikatorDokumen);
                $saveIndikatorDokumen  =   $this->db->update($tabelIndikatorModel, $dataIndikatorDokumen);
                $isUpdate   =   true;
            }

            return ($saveIndikatorDokumen)? $idIndikatorDokumen : false;
        }
        public function deleteIndikatorDokumen($idIndikatorDokumen = null){
            $statusDelete   =   false;
            $messageDelete  =   null;

            $tabelIndikatorDokumen     =   $this->tabel->indikatorDokumen;

            //cek ke indikator
            // if(!is_null($idIndikatorDokumen)){
            //     $options        =   [
            //         'select'        =>  'kodeSubStandar',
            //         'useSingleRow'  =>  true
            //     ];
            //     $detailSubStandart =   $this->getIndikatorDokumen($idIndikatorDokumen, $options);

            //     if($detailSubStandart !== false){
            //         $kodeSubStandar    =   $detailSubStandart['kodeSubStandar'];

            //         $this->load->model('SubStandartModel', 'subStandart');

            //         $options        =   [
            //             'select'    =>  'indikatorDokumenId',
            //             'where'     =>  [
            //                 'kodeSubStandar'   =>  $kodeSubStandar
            //             ]
            //         ];
            //         $indikatorDokumen    =   $this->subStandart->getIndikatorDokumen(null, $options);

            //         if(count($indikatorDokumen) <= 0){
                        $this->db->where('indikatorDokumenId', $idIndikatorDokumen);
                        $deleteIndikatorDokumen  =   $this->db->delete($tabelIndikatorDokumen);

                        $statusDelete   =   ($deleteIndikatorDokumen)? true : false;
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