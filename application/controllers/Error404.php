<?php
/*
 * REF :  http://www.thephpcode.com/blog/view/how-to-create-custom-404-page-with-codeigniter.html
 */
class Error404 extends CI_Controller {

	public function Error404() {
		parent::__construct();
	}

	public function index() {
		$this->output->set_status_header('404');

		$this->load->view('templates/cmd_header');
		$this->load->view('Error404View');
		$this->load->view('templates/cmd_header');
	}
}
?>