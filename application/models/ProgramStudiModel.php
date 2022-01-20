<?php
	class ProgramStudiModel extends CI_Model{
		public function __construct(){
			$this->load->library('Tabel');
		}
        public function getNumberOfData(){
            $tabelProgramStudi        =   $this->tabel->programStudi;

            $this->db->select('idprogramstudi');
            $allData    =   $this->db->get($tabelProgramStudi);

            return $allData->num_rows();
        }
		public function getProgramStudi($idProgramStudi = null, $options = null){
            $tabelProgramStudi        =   $this->tabel->programStudi;

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
            if(!is_null($idProgramStudi)){
                $this->db->where('pT.idprogramstudi', $idProgramStudi);
            }

            if($orderByOptions === false){
                $this->db->order_by('pT.idprogramstudi', 'desc');
            }
            $getProgramStudi    =    $this->db->get($tabelProgramStudi.' pT'); //pT = primary table (tabel utama)

            if(!is_null($idProgramStudi)){
                $programStudi  =   ($getProgramStudi->num_rows() >= 1)? $getProgramStudi->row_array() : false;
            }else{
                $programStudi  =   ($getProgramStudi->num_rows() >= 1)? $getProgramStudi->result_array() : [];
                
                if($useSingleRow){
                    if(count($programStudi) >= 1){
                        $programStudi  =   $programStudi[0];
                    }else{
                        $programStudi  =   false;
                    }
                }
            }

            return $programStudi;
        }
        public function saveProgramStudi($idProgramStudi = null, $dataProgramStudi = null){
            $tabelProgramStudi    =   $this->tabel->programStudi;
                
            if(is_null($dataProgramStudi)){
                extract($_POST);

                $this->load->model('UserModel', 'user');
            
                $dataProgramStudi   =   [
                    'idprogramstudi'    =>  $idprogramstudi,
                    'programStudiCode'  =>  $programStudiCode,
                    'jurusanKode'   =>  $jurusanKode,
                    'namaProgramStudi'  =>  $namaProgramStudi,
                    'tglBerdiri'    =>  $tglBerdiri,
                    'numberSK'  =>  $numberSK,
                    'jenjang'   =>  $jenjang,
                    'peringkatAkreditasi'   =>  $peringkatAkreditasi,
                    'noSKBANPT' =>  $noSKBANPT,
                    'tglexp'    =>  $tglexp,
                    'userid'    =>  $this->user->isLogin(),
                    'createdDate'   =>  now()
                ];
            }

            if(is_null($idProgramStudi)){
                $saveProgramStudi  =   $this->db->insert($tabelProgramStudi, $dataProgramStudi);
                $idProgramStudi    =   $this->db->insert_id();

                $isUpdate   =   false;
            }else{
                $this->db->where('idprogramstudi', $idProgramStudi);
                $saveProgramStudi  =   $this->db->update($tabelProgramStudi, $dataProgramStudi);
                $isUpdate   =   true;
            }

            return ($saveProgramStudi)? $idProgramStudi : false;
        }
        public function deleteProgramStudi($idProgramStudi = null){
            $statusDelete   =   false;
            $messageDelete  =   null;

            $tabelProgramStudi     =   $this->tabel->programStudi;

            //cek ke indikator
            // if(!is_null($idProgramStudi)){
            //     $options        =   [
            //         'select'        =>  'kodeSubStandar',
            //         'useSingleRow'  =>  true
            //     ];
            //     $detailSubStandart =   $this->getProgramStudi($idProgramStudi, $options);

            //     if($detailSubStandart !== false){
            //         $kodeSubStandar    =   $detailSubStandart['kodeSubStandar'];

            //         $this->load->model('SubStandartModel', 'subStandart');

            //         $options        =   [
            //             'select'    =>  'idprogramstudi',
            //             'where'     =>  [
            //                 'kodeSubStandar'   =>  $kodeSubStandar
            //             ]
            //         ];
            //         $programStudi    =   $this->subStandart->getProgramStudi(null, $options);

            //         if(count($programStudi) <= 0){
            //             $this->db->where('standarId', $idProgramStudi);
            //             $deleteStandart  =   $this->db->delete($tabelProgramStudi);

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