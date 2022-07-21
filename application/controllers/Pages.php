<?php 
	class Pages extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('date', 'url'));
			$this->load->view('template/titles');
		}
		public function index($page = "index"){
			if (file_exists(APPPATH.'views/index.php')) {
        $data['js_path'] = base_url().'assets/js/';
        $data['css_path'] = base_url().'assets/css/';
        $data['img_path'] = base_url().'assets/img/';
				$data['title'] = $GLOBALS['title'][$page]; // Variable que se toma de templates/titles
				$data['description'] = $GLOBALS['description'][$page]; // Variable que se toma de templates/titles
				$data['keywords'] = $GLOBALS['keywords'][$page]; // Variable que se toma de templates/titles
				$data['page'] = $page;
				$this->load->view('template/header', $data);
				if (file_exists(APPPATH.'views/template/menu.php')) {
					$this->load->view('template/menu');
				}
				$this->load->view($page);
				if (file_exists(APPPATH.'views/template/footer.php')) {
					$this->load->view('template/footer');
				}
				if (file_exists(APPPATH.'views/template/scripts.php')){
					$this->load->view('template/scripts');
				}
				$this->load->view('template/Close');
			}else{
				$this->load->view('welcome_message');
			}
			if (!file_exists(APPPATH.'views/'.$page.'.php')) { show_404();}
		}
		function nueva_visita(){
			$this->load->model('Enviar_estadisticas');
			$this->Enviar_estadisticas->registrar_visita();
			$this->Enviar_estadisticas->registrar_frecuencia();
		}
	}
?>