<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
    public function index(){
        $this->load->model('BlogModel', 'blog');
        $this->load->library('Path');

        $start      =   $this->input->get('start');
        $start      =   (!is_null($start))? $start : 0;

        $length     =   $this->input->get('length');
        $length     =   (!is_null($length))? $length : 10;

        $search     =   $this->input->get('search');

        $select     =   'id, foto, title, permalink, createdBy, createdAt, updatedBy, updatedAt';
        $selectQS   =   $this->input->get('selectQS');
        if(!is_null($selectQS)){
            $select     =   $selectQS;
        }

        $options    =   [
            'select'            =>  $select,
            'limit'             =>  $length,
            'limitStartFrom'    =>  $start
        ];

        $searchQS   =   '';
        if(!is_null($search)){
            if(is_array($search)){
                $searchValue        =   $search['value'];
                $options['like']    =   [
                    'column'    =>  ['title', 'permalink', 'content'],
                    'value'     =>  $searchValue
                ];

                $searchQS    =   $searchValue;
            }
        }

        $listBlog           =   $this->blog->getBlog(null, $options);

        $dataPage   =   [
            'pageTitle' =>  'Blog',
            'listBlog'  =>  $listBlog,
            'path'      =>  $this->path
        ];
        $this->load->view(userViews('blog/index'), $dataPage);
    }
    public function read($permalink = null){
        if(!is_null($permalink)){
            $detailBlog     =   false;
            $pageTitle      =   'Blog';

            if($permalink !== null){
                $this->load->model('BlogModel', 'blog');
                
                $options    =   [
                    'where'         =>  ['permalink' => $permalink],
                    'useSingleRow'  =>  true
                ];

                $detailBlog      =   $this->blog->getBlog(null, $options);  
                
                if($detailBlog !== false){
                    $this->load->library('Path');
                    $this->load->model('AdminModel', 'admin');

                    $pageTitle      =   strtoupper($detailBlog['title']);

                    $detailCreator                  =   $this->admin->getAdmin($detailBlog['createdBy'], ['select' => 'nama, foto']);
                    $detailBlog['detailCreator']    =   $detailCreator;
                    
                    if(!is_null($detailBlog['updatedAt'])){
                        $detailUpdater                  =   $this->admin->getAdmin($detailBlog['updatedBy'], ['select' => 'nama, foto']);
                        $detailBlog['detailUpdater']    =   $detailUpdater;
                    }

                    $dataPage   =   [
                        'detailBlog'    =>  $detailBlog,
                        'pageTitle'     =>  $pageTitle,
                        'path'          =>  $this->path
                    ];
        
                    $this->load->view(userViews('blog/readBlog'), $dataPage);
                }else{
                    $this->load->view('errorPage/pageNotFound');
                }
            }else{
                $this->load->view('errorPage/pageNotFound');
            }
        }else{
            $this->load->view('errorPage/pageNotFound');
        }
    }
}
