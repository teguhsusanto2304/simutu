<?php
	class KeranjangModel extends CI_Model{
        var $cartCodeKey    =   'cartCode';

		public function __construct(){
            $this->load->library('Tabel');
		}
        public function getCartCode(){
            $this->load->helper('cookie');

            $cartCode   =   get_cookie($this->cartCodeKey);
            if(is_null($cartCode)){
                $uniqID =   date('His');
                
                $detikSatuHari  =   3600 * 24 * 30;
                set_cookie($this->cartCodeKey, $uniqID, $detikSatuHari);

                $cartCode   =   $uniqID;
            }

            return $cartCode;
        }
        public function deleteCartCode(){
            $this->load->helper('cookie');

            delete_cookie($this->cartCodeKey);
        }
        public function getNumberOfData(){
            $tabelKeranjang     =   $this->tabel->keranjang;

            $this->db->select('id');
            $getNumberOfData    =   $this->db->get($tabelKeranjang);

            return $getNumberOfData->num_rows();
        }
        public function getKeranjang($id = null, $options = null){
            $tabelKeranjang     =   $this->tabel->keranjang;

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
            $getKeranjang   =   $this->db->get($tabelKeranjang);

            if(!is_null($id)){
                $keranjang  =   ($getKeranjang->num_rows() >= 1)? $getKeranjang->row_array() : false;
            }else{
                $keranjang  =   ($getKeranjang->num_rows() >= 1)? $getKeranjang->result_array() : [];
                
                if($useSingleRow){
                    if(count($keranjang) >= 1){
	                   $keranjang 	=	$keranjang[0];
                    }else{
                        $keranjang    =   false;
                    }
	            }
            }

            return $keranjang;
        }
        public function saveKeranjang($idKeranjang = null, $dataKeranjang = null){
            $tabelKeranjang    =   $this->tabel->keranjang;
                
            if(is_null($dataKeranjang)){
                extract($_POST);

                $this->load->library('session');
                $activeAdminID  =   $this->session->userdata('id');

                $dataKeranjang	=	[
                	'cartCode'      =>	$cartCode,
                	'idKontenItem'	=>	$idKontenItem,
                    'harga'         =>  $harga,
                    'diskon'        =>  $diskon,
                    'quantity'      =>  $quantity
                ];

                if(is_null($idKeranjang)){
                    $dataKeranjang['createdBy']  =   $activeAdminID;
                }else{
                    date_default_timezone_set('Asia/Jakarta');

                    $dataKeranjang['updatedBy']  =   $activeAdminID;
                    $dataKeranjang['updatedAt']  =   date('Y-m-d H:i:s');
                }
            }
            
            if(is_null($idKeranjang)){
                $saveKeranjang       =   $this->db->insert($tabelKeranjang, $dataKeranjang);
                $idKeranjang    =   $this->db->insert_id();

                $isUpdate   =   false;
            }else{
                $this->db->where('id', $idKeranjang);
                $saveKeranjang   =   $this->db->update($tabelKeranjang, $dataKeranjang);

                $isUpdate   =   true;
            }

            return ($saveKeranjang)? $idKeranjang : false;
        }
        public function deleteKeranjang($idKeranjang = null){
            $tabelKeranjang         =   $this->tabel->keranjang;

        	$statusDeleteKeranjang  =	false;

        	if(!is_null($idKeranjang)){
                $this->db->where('id', $idKeranjang);
                $deleteKeranjang        =   $this->db->delete($tabelKeranjang);

                $statusDeleteKeranjang 	=	($deleteKeranjang)? true : false;
			}

            return $statusDeleteKeranjang;
        }
	}
?>