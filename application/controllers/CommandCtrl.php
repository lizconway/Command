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
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/CommandCtrl
	 *	- or -
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/CommandCtrl/index
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
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/commandments
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/commandments/x/y where x and y are between 1 and 11 inclusive
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/commandments/z where z is between 1 and 11 inclusive
	 */
	public function getCommandments($from = 0, $to = 0) {
		$this->load->model('CmdModel', 'cmdData', true);

		$data['commandments'] = array();
		$cmdmts['commandments'] = array();

		/**
		 * TEST values for $from & $to
		 */
		/* $from = 3;
		$to = 8; */
		/* Descending Test
		 * $from = 8;
		$to = 3; */
		/* Test if the same number
		 *  $from = 5;
		$to = 5; */

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
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/translations
	 */
	/* public function getTranslations() {
		$this->load->model('CmdModel', 'cmdData', true);

		$data['translations'] = array();
		$translate['textSpeak'] = array();

		// Retrieve data model
		foreach($this->cmdData->getTranslations(null) as $txt) {
			$translation = array('txt' => $txt->txt, 'english' => $txt->english);
			array_push($translate['textSpeak'], $translation);
		}
		array_push($data['translations'], $translate);

		$this->load->view('TxtView', $data);

	} */

	/**
	 * Maps to the following EndPoint
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/Command/getTranslations
	 * 		http://localhost/ServerSide/Assessment/WebService/translations
	 */
	public function getTranslations($textSpeak = null) {
		$this->load->model('CmdModel', 'cmdData', true);

		$data['translations'] = array();
		$translate['textSpeak'] = array();

		/**
		 * Retrieve model data
		 */
		foreach($this->cmdData->getTranslations($textSpeak) as $txt) {
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

}
