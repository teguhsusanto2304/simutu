<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ErrorPage extends CI_Controller {
	public function pageNotFound(){
        $this->load->view('errorPage/pageNotFound');
	}
}
