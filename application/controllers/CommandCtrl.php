<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include_once 'application/models/NewsArticle.php';

class CommandCtrl extends CI_Controller {

	function CommandCtrl() {
		parent::__construct();
		//$this->load->library('session');

		// Loading url helper
		$this->load->helper('url');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://localhost/index.php/news
	 *	- or -
	 * 		http://localhost/index.php/news/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://localhost/ServerSide/Assessment/WebService
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/command/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {

		/* echo "<div class='container'>";
		echo "    <h1>Yah Boo!</h1>";
		echo "    <p>From the index function</p>";
		echo "</div>"; */
		$this->load->view('CommandView');

	}

	/**
	 * Maps to the following EndPoint
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/Command/getCommandments
	 */
	public function getCommandments($from = 0, $to = 0) {
		$this->load->model('CmdModel', 'cmdData', true);

		$data['commandments'] = array();
		$cmdmts['commandments'] = array();

		/**
		 * TEST values for $from & $to
		 */
		$from = 3;
		$to = 8;
		/* $from = 8;
		$to = 3; */

		/**
		 * Retrieve model data
		 */
		foreach($this->cmdData->getCommandments($from, $to) as $cmd) {
			/*
			 * Remove null descriptions so that the Consumer does not have to deal with them
			 */
			if($cmd->description === null) {
				$commandment = array('number' => $cmd->number, 'title' => $cmd->title, 'url' => $cmd->url);
			} else {
				$commandment = array('number' => $cmd->number, 'title' => $cmd->title, 'description' =>$cmd->description, 'url' => $cmd->url);
			}
			array_push($cmdmts['commandments'], $commandment);
		}
		array_push($data['commandments'], $cmdmts);

		$this->load->view('CmdView', $data);

		/* $this->load->library('parser');

		$this->load->view('templates/cmd_header');
		$this->parser->parse('CmdView', $data);
		$this->load->view('templates/cmd_footer'); */
	}

	/**
	 * Maps to the following EndPoint
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/Command/getTranslations
	 */
	public function getTranslations() {
		$this->load->model('CmdModel', 'cmdData', true);

		$data['translations'] = array();
		$translate['textSpeak'] = array();

		/**
		 * Retrieve model data
		 */
		foreach($this->cmdData->getTranslations() as $txt) {
			$translation = array('txt' => $txt->txt, 'english' => $txt->english);
			array_push($translate['textSpeak'], $translation);
		}
		array_push($data['translations'], $translate);

// 		var_dump($data);
		$this->load->view('TxtView', $data);

		/* $this->load->library('parser');

		$this->load->view('templates/cmd_header');
		$this->parser->parse('TxtView', $data);
		$this->load->view('templates/cmd_footer'); */
		/* $this->output
			->set_content_type('application/json')
			->set_output(json_encode($data)); */
	}

	/**
	 * Maps to the following URL
	 * 		http://localhost/index.php/news/report
	 *	- or -
	 * Since this controller is NOT the default controller in
	 * config/routes.php, it's displayed at http://localhost/ServerSide/Assessment/WebService/report
	 */
	public function report() {
		$this->load->model('news_model', '', true);
		/**
		 * Read post data from the view
		 * and save it to the database
		 */
		$headline = $this->input->post('title' ,true);
		$article = $this->input->post('details', true);
		/** input->post returns null if the post item is not set
		 * So the following lines should be changed to reflect this
		 * i.e. test $headline and $article for null
		 */
		if(isset($_POST['title']) && isset($_POST['details'])) {
// 			echo "<br>title set<br>";
			if(!empty($_POST['title']) && !empty($_POST['details'])) {
				$this->news_model->insert_news($headline, $article);
			}
		}/*  else {
			echo "<br>title <strong>not</strong> set<br>";
		} */

		$this->load->view('templates/news_header');
		$this->load->view('reportNews');
		$this->load->view('templates/news_footer');
	}
}
