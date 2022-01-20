<?php
	class StandartModel extends CI_Model{
		public function __construct(){
			$this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelStandart        =   $this->tabel->standart;

            $this->db->select('standarId');
            $allData    =   $this->db->get($tabelStandart);

            return $allData->num_rows();
        }
		public function getStandart($idStandart = null, $options = null){
            $tabelStandart        =   $this->tabel->standart;

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
            if(!is_null($idStandart)){
                $this->db->where('pT.standarId', $idStandart);
            }

            if($orderByOptions === false){
                $this->db->order_by('pT.standarId', 'desc');
            }
            $getStandart    =    $this->db->get($tabelStandart.' pT'); //pT = primary table (tabel utama)

            if(!is_null($idStandart)){
                $standart  =   ($getStandart->num_rows() >= 1)? $getStandart->row_array() : false;
            }else{
                $standart  =   ($getStandart->num_rows() >= 1)? $getStandart->result_array() : [];
                
                if($useSingleRow){
                    if(count($standart) >= 1){
                        $standart  =   $standart[0];
                    }else{
                        $standart  =   false;
                    }
                }
            }

            return $standart;
        }
        public function saveStandart($idStandart = null, $dataStandart = null){
            $tabelStandart    =   $this->tabel->standart;
                
            if(is_null($dataStandart)){
                extract($_POST);
            
                $dataStandart   =   [
                    'standarId'     =>  $standarId,
                    'kodeStandar'   =>    $kodeStandar,
                    'namaStandar'   =>    $namaStandar,
                    'userid'        =>     $userid,
                    'createdDate'   =>  now()
                ];
            }

            if(is_null($idStandart)){
                $saveStandart  =   $this->db->insert($tabelStandart, $dataStandart);
                $idStandart    =   $this->db->insert_id();

                $isUpdate   =   false;
            }else{
                $this->db->where('standarId', $idStandart);
                $saveStandart  =   $this->db->update($tabelStandart, $dataStandart);
                $isUpdate   =   true;
            }

            return ($saveStandart)? $idStandart : false;
        }
        public function deleteStandart($idStandart = null){
            $statusDelete   =   false;
            $messageDelete  =   null;

            $tabelStandart     =   $this->tabel->standart;

            if(!is_null($idStandart)){
                $options        =   [
                    'select'        =>  'kodeStandar',
                    'useSingleRow'  =>  true
                ];
                $detailStandart =   $this->getStandart($idStandart, $options);

                if($detailStandart !== false){
                    $kodeStandar    =   $detailStandart['kodeStandar'];

                    $this->load->model('SubStandartModel', 'subStandart');

                    $options        =   [
                        'select'    =>  'subStandarId',
                        'where'     =>  [
                            'kodeStandar'   =>  $kodeStandar
                        ]
                    ];
                    $subStandart    =   $this->subStandart->getSubStandart(null, $options);

                    if(count($subStandart) <= 0){
                        $this->db->where('standarId', $idStandart);
                        $deleteStandart  =   $this->db->delete($tabelStandart);

                        $statusDelete   =   ($deleteStandart)? true : false;
                    }else{
                        $messageDelete  =   'Maaf, data sudah memiliki relasi!';
                    }
                }else{
                    $messageDelete  =   'Data Standart tidak ditemukan!';
                }
            }else{
                $messageDelete  =   'ID Standart tidak ada!';
            }

            return ['statusDelete' => $statusDelete, 'messageDelete' => $messageDelete];
        }
	}
?>