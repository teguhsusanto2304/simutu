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

		$blogOptions    =   [
	        'select'    =>  'permalink, title, foto, createdAt',
	        'limit'     =>  5
	    ];
	    $newestBlogs    =   $this->blog->getBlog(null, $blogOptions);

		$dataPage 	=	[
			'listHero'		=>	$listHero,
			'listKonten'	=>	$listKonten,
			'newestBlogs'	=>	$newestBlogs,
			'path'			=>	$this->path	
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
	public function resizeImageGaleri(){
		$this->load->model('GaleriModel', 'galeri');
		$this->load->library('Unggah');
		$this->load->library('Path');

		$uploadGambarGaleri 	=	$this->path->uploadGambarGaleri;

		$allGaleri 	=	$this->galeri->getGaleri(null, ['select' => 'foto']);
		foreach($allGaleri as $galeri){
			$fileName 		=	$galeri['foto'];

            $sourceImage    =   $uploadGambarGaleri.'/'.$fileName;
			$imageSize 		=	getimagesize($sourceImage);

			list($width, $height) 	=	$imageSize;

            $destination    =   $uploadGambarGaleri.'/compress/'.$fileName;
            $this->unggah->resizeImage($sourceImage, $destination, $width / 2, $height / 2);
		}
	}

	public function resizeImageBlog(){
		$this->load->model('BlogModel', 'blog');
		$this->load->library('Unggah');
		$this->load->library('Path');

		$uploadGambarBlog 	=	$this->path->uploadGambarBlog;

		$allBlog 	=	$this->blog->getBlog(null, ['select' => 'foto']);
		foreach($allBlog as $blog){
			$fileName 		=	$blog['foto'];

            $sourceImage    =   $uploadGambarBlog.'/'.$fileName;
			$imageSize 		=	getimagesize($sourceImage);

			list($width, $height) 	=	$imageSize;

            $destination    =   $uploadGambarBlog.'/compress/'.$fileName;
            $this->unggah->resizeImage($sourceImage, $destination, $width / 2, $height / 2);
		}
	}
}
