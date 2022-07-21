<?php 
	class Email extends CI_Controller{
		public function index(){
            $this->load->library('email');

			$this->email->clear();
			$this->email->from($_POST['from']);
			$this->email->to($_POST['to']);
			$this->email->cc($_POST['cc']);
			$this->email->bcc($_POST['bcc']);

			$this->email->subject($_POST['subject']);
			$this->email->message($_POST['message']);
			$this->email->send();

			echo "Email realizado!";
		}
	}
?>