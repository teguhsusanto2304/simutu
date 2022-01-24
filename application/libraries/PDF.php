<?php 
	use Dompdf\Dompdf;

	class PDF extends Dompdf{
		public $fileName;
		protected $ci;

		public function __construct(){
			parent::__construct();
			$this->ci 	=	get_instance();
		}
		public function loadView($viewPath, $viewData = []){
			$ci 	=	$this->ci;

			$fileName 	=	(empty($this->fileName))? 'Laporan.pdf' : $this->fileName;

			$html 	=	$ci->load->view($viewPath, $viewData, true);
			$this->load_html($html);
			$this->render();
			$this->stream($fileName, ['Attachment' => false]);
		}
	}
?>