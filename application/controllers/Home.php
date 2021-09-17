<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->load->model('HeroModel', 'hero');
		$this->load->model('KontenModel', 'konten');

		$this->load->model('KontenItemModel', 'kontenItem');
		$this->load->library('DefaultImage');

		$heroOptions 	=	[
			'select'	=>	'id, foto, judul, deskripsi',
			'order_by'	=>	[
				'column'		=>	'urutan',
				'orientation'	=>	'asc'
			]
		];
		$listHero 		=	$this->hero->getHero(null, $heroOptions);

		$listKonten 	=	$this->konten->getKonten();

		$dataPage 	=	[
			'listHero'		=>	$listHero,
			'listKonten'	=>	$listKonten
		];
        $this->load->view('index', $dataPage);
	}
	public function keranjang(){
		$this->load->model('KeranjangModel', 'keranjang');
		$this->load->model('KontenItemModel', 'kontenItem');

		$cartCode 	=	$this->keranjang->getCartCode();

		$keranjangOptions	=	[	
			'where'		=>	['cartCode' => $cartCode]
		];	
		$listKeranjang 		=	$this->keranjang->getKeranjang(null, $keranjangOptions);

		$dataPage	=	[
			'listKeranjang'	=>	$listKeranjang,
			'cartCode'		=>	$cartCode
		];
		$this->load->view('keranjang', $dataPage);
	}
}
