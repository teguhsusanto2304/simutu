<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->load->model('InformasiModel', 'informasi');

		$options 		=	[
			'select'	=>	'nama, link, keterangan'
		];
		$listInformasi 	=	$this->informasi->getInformasi(null, $options);

		$dataPage 	=	[
			'informasi'		=>	$this->informasi,
			'listInformasi'	=>	$listInformasi
		];
        $this->load->view(website('index'), $dataPage);
	}
}
