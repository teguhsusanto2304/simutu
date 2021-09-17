<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function process_add(){
        $statusAddCart  =   false;
        $message        =   null;

        $this->load->library('form_validation', null, 'fV');

		$this->load->model('KontenItemModel', 'kontenItem');

        $this->fV->set_rules('idKontenItem', 'ID Konten Item', 'required|trim|numeric|greater_than_equal_to[1]');
		if($this->fV->run()){
            $idKontenItem   =   $this->input->post('idKontenItem');

            $detailKontenItem   =   $this->kontenItem->getKontenItem($idKontenItem, ['select' => 'harga, diskon']);

            if($detailKontenItem !== false){
                $this->load->model('KeranjangModel', 'keranjang');

                $cartCode       =   $this->keranjang->getCartCode();

                $options            =   [
                    'select'    =>  'id, quantity',
                    'where'     =>  [
                        'cartCode'      =>  $cartCode,
                        'idKontenItem'  =>  $idKontenItem
                    ],
                    'useSingleRow'  =>  true
                ];
                $existInCart    =   $this->keranjang->getKeranjang(null, $options);
                $isExistInCart  =   ($existInCart !== false);

                $idKeranjang    =   ($isExistInCart)? $existInCart['id'] : null;
                $quantity       =   ($isExistInCart)? $existInCart['quantity'] + 1 : 1;

                $dataKeranjang  =   [
                    'cartCode'      =>  $cartCode,
                    'idKontenItem'  =>  $idKontenItem,
                    'harga'         =>  $detailKontenItem['harga'],
                    'diskon'        =>  $detailKontenItem['diskon'],
                    'quantity'      =>  $quantity
                ];

                $saveKeranjang  =   $this->keranjang->saveKeranjang($idKeranjang, $dataKeranjang);
                
                if($saveKeranjang){
                    $statusAddCart  =   true;
                }else{
                    $message    =   'Server gagal menambahkan data ke keranjang!';
                }
            }else{
                $message    =   'Produk tidak terdaftar di sistem! Kemungkinan sudah dihapus oleh admin!';
            }
        }else{
            $message    =   $this->fV->error_string();
        }

        header('Content-Type:application/json');

        $response   =   [
            'statusAddCart' =>  $statusAddCart,
            'message'       =>  $message
        ];
        echo json_encode($response);
	}
	public function process_addAll(){
        $statusAddCart  =   false;
        $message        =   null;

        $this->load->library('form_validation', null, 'fV');

		$this->load->model('KontenItemModel', 'kontenItem');

        $this->fV->set_rules('idKonten', 'ID Konten', 'required|trim|numeric|greater_than_equal_to[1]');
		if($this->fV->run()){
            $this->load->model('KeranjangModel', 'keranjang');

            $cartCode   =   $this->keranjang->getCartCode();

            $idKonten   =   $this->input->post('idKonten');

            $kontenItemOptions  =   [
                'select'    =>  'id, harga, diskon',
                'where'     =>  ['idKonten' => $idKonten]
            ];
            $listKontenItem   =   $this->kontenItem->getKontenItem(null, $kontenItemOptions);

            foreach($listKontenItem as $kontenItem){
                $detailKontenItem   =   $this->kontenItem->getKontenItem($kontenItem['id'], ['select' => 'harga, diskon']);

                $options            =   [
                    'select'    =>  'id, quantity',
                    'where'     =>  [
                        'cartCode'      =>  $cartCode,
                        'idKontenItem'  =>  $kontenItem['id']
                    ],
                    'useSingleRow'  =>  true
                ];
                $existInCart    =   $this->keranjang->getKeranjang(null, $options);
                $isExistInCart  =   ($existInCart !== false);

                $idKeranjang    =   ($isExistInCart)? $existInCart['id'] : null;
                $quantity       =   ($isExistInCart)? $existInCart['quantity'] + 1 : 1;

                $dataKeranjang  =   [
                    'cartCode'      =>  $cartCode,
                    'idKontenItem'      =>  $kontenItem['id'],
                    'harga'         =>  $detailKontenItem['harga'],
                    'diskon'        =>  $detailKontenItem['diskon'],
                    'quantity'      =>  $quantity
                ];

                $saveKeranjang  =   $this->keranjang->saveKeranjang($idKeranjang, $dataKeranjang);
                
                if($saveKeranjang){
                    $statusAddCart  =   true;
                }else{
                    $message    =   'Server gagal menambahkan data ke keranjang!';
                }
            }
        }else{
            $message    =   $this->fV->error_string();
        }

        header('Content-Type:application/json');

        $response   =   [
            'statusAddCart' =>  $statusAddCart,
            'message'       =>  $message
        ];
        echo json_encode($response);
	}
    public function process_delete(){
        $statusDeleteCart   =   false;
        $message            =   null;

        $this->load->library('form_validation', null, 'fV');

		$this->load->model('KontenItemModel', 'kontenItem');

        $this->fV->set_rules('idKeranjang', 'ID Keranjang', 'required|trim|numeric|greater_than_equal_to[1]');
		if($this->fV->run()){
            $idKeranjang   =   $this->input->post('idKeranjang');

            $this->load->model('KeranjangModel', 'keranjang');
            $deleteKeranjang    =   $this->keranjang->deleteKeranjang($idKeranjang);

            if($deleteKeranjang){
                $statusDeleteCart   =   true;
            }else{
                $message    =   'Server gagal menghapus data keranjang!';
            }
        }else{
            $message    =   $this->fV->error_string();
        }

        header('Content-Type:application/json');

        $response   =   [
            'statusDeleteCart'  =>  $statusDeleteCart,
            'message'           =>  $message
        ];
        echo json_encode($response);
    }
    public function process_checkout(){
        $statusCheckout =   false;
        $message        =   null;
        $data           =   null;

        $this->load->library('form_validation', null, 'fV');

        $this->fV->set_rules('cartCode', 'Kode Keranjang', 'required|trim|numeric|greater_than_equal_to[1]');
		if($this->fV->run()){
            $cartCode   =   $this->input->post('cartCode');

            $this->load->helper('cookie');
            $this->load->model('KontenItemModel', 'kontenItem');
            $this->load->model('KeranjangModel', 'keranjang');

            $options        =   [
                'select'    =>  'id, idKontenItem, harga, diskon, quantity',
                'where'     =>  ['cartCode' => $cartCode]
            ];
            $listKeranjang  =   $this->keranjang->getKeranjang(null, $options);

            $noUrut         =   1;
            $pesanWhatsapp  =   'Hai kak,%0aSaya mau pesan barang dengan pesanan sebagai berikut ini ya :%0a%0a';
            foreach($listKeranjang as $keranjang){
                $kontenItemOptions  =   ['select' => 'nama'];
                $detailKontenItem   =   $this->kontenItem->getKontenItem($keranjang['idKontenItem'], $kontenItemOptions);

                $nama       =   $detailKontenItem['nama'];
                $quantity   =   $keranjang['quantity'];
                
                $pesanWhatsapp   .=  $noUrut.'. '.$nama.' *'.$quantity.'pcs* %0a';
                $noUrut++;

                $this->keranjang->deleteKeranjang($keranjang['id']);
            }

            $this->keranjang->deleteCartCode();

            $statusCheckout =   true;
            $data   =   ['linkWhatsapp' => 'https://api.whatsapp.com/send?phone=6281265397877&text='.$pesanWhatsapp];
        }else{
            $message    =   $this->fV->error_string();
        }

        header('Content-Type:application/json');

        $response   =   [
            'statusCheckout'    =>  $statusCheckout,
            'message'           =>  $message,
            'data'              =>  $data
        ];
        echo json_encode($response);
    }
    public function process_increment(){
        $statusIncrement    =   false;
        $message            =   null;
        $currentQuantity    =   null;
        $currentTotalHarga  =   null;

        $this->load->library('form_validation', null, 'fV');
        
        $this->fV->set_rules('idKeranjang', 'ID Keranjang', 'required|trim|numeric|greater_than_equal_to[1]');
        $this->fV->set_rules('quantity', 'Kuantitas', 'required|trim|numeric');
		
        if($this->fV->run()){
            $this->load->model('KeranjangModel', 'keranjang');
            $changeToThisQuantity   =   false;

            $changeToThisQuantityPOST   =   $this->input->post('changeToThisQuantity');
            if(!is_null($changeToThisQuantityPOST) && !empty($changeToThisQuantityPOST)){
                $changeToThisQuantity   =   ($changeToThisQuantityPOST === 'true');
            }
        
            $idKeranjang    =   $this->input->post('idKeranjang');
            $quantity       =   $this->input->post('quantity');

            $detailKeranjang    =   $this->keranjang->getKeranjang($idKeranjang, ['select' => 'quantity, harga, diskon']);
            $oldQuantity        =   $detailKeranjang['quantity'];
            $harga              =   $detailKeranjang['harga'];
            $diskon             =   $detailKeranjang['diskon'];

            $dataKeranjang  =   [
                'quantity'  =>  ($changeToThisQuantity)? $quantity : ($oldQuantity + $quantity)
            ];
            $updateQuantity     =   $this->keranjang->saveKeranjang($idKeranjang, $dataKeranjang);
            $statusIncrement    =   ($updateQuantity)? true : false;

            if($statusIncrement){
                $currentQuantity    =   $dataKeranjang['quantity'];
                $currentTotalHarga  =   $currentQuantity * ($harga - $diskon);
            }
        }else{
            $message    =   $this->fV->error_string();
        }

        header('Content-Type:application/json');

        $response   =   [
            'statusIncrement'   =>  $statusIncrement,
            'message'           =>  $message,
            'currentQuantity'   =>  $currentQuantity,
            'currentTotalHarga' =>  'Rp. '.number_format($currentTotalHarga)
        ];
        echo json_encode($response);
    }
}
