<?php
/*
* Author: Elizabeth Conway
* Assignment: WE4.0 Server-side Web Development, Digital Skills Academy
* Student ID: D11122173
* Date : 2016/07/31
* Ref: https://en.wikipedia.org/wiki/Ten_Commandments
*/
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CommandCtrl class - the Controller in the MVC architecture.
 * This class contains the main logic for this Web Service.
 * It exposes two endpoints via its getCommandments() and getTranslations() methods.
 * Each endpoint will give a JSON object containing commandments and translations respectively.
 * Invoking the default behaviour of this class via http://localhost/ServerSide/Assessment/WebService
 * will call the index() method which take you to a page where you can call the methods of this class.
 *
 * @author liz
 *
 */
class CommandCtrl extends CI_Controller {

	/**
	 * This is the constructor method of this class
	 * It call the parent classes constructor (CI_Controller)
	 */
	function CommandCtrl() {
		parent::__construct();

		/* URL helper is autoloaded in config/autoload.php */
		// Loading url helper
		//$this->load->helper('url');
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
	 * map to /index.php/CommandCtrl/<method_name>
	 *  - or -
	 *  to /CommandCtrl/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {

		/* Deliberately cause a 404 error
		 * This will invoke the customer 404 error controller
		 * and display the custom 404 error page */
		$this->load->view('CommandView');
	}

	/**
	 * This function retrieves commandments from the CmdModel's getCommandments() function.
	 * It send any arguments to the CmdModel's getCommandments() function,
	 * which allows a subset of the commandments to be returned.
	 * It strips out any null descriptions and accumulates all the commandments into an array.
	 * It then sends this commandments array to the CmdView view.
	 *
	 * Maps to the following EndPoints
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/CommandCtrl/getCommandments
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/commandments
	 * 		http://localhost/ServerSide/Assessment/WebService/commandments
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/commandments/x/y where x and y are between 1 and 11 inclusive
	 * 		http://localhost/ServerSide/Assessment/WebService/commandments/x/y where x and y are between 1 and 11 inclusive
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/commandments/z where z is between 1 and 11 inclusive
	 * 		http://localhost/ServerSide/Assessment/WebService/commandments/z where z is between 1 and 11 inclusive
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

	}

	/**
	 * This function retrieves translations from the CmdModel's getTranslations() function.
	 * It captures any arguments using PHP's get_func_args() function.
	 * It uses get_func_args() rather than using formal parameters because we need to treat
	 * arguments containing a forward slash as one argument, however CodeIgniter will split
	 * any argument containing a forward slash into 2 or more arguments.
	 * This function combines any arguments containing slashes that were split up by CodeIgniter
	 * into a single argument.
	 * It then replaces any %20 into a space character in the argument.
	 *
	 * It send any argument to the CmdModel's getTranslations() function,
	 * which allows a single translation to be returned.
	 * It accumulates all the translations into an array.
	 * It then sends this translations array to the TxtView view.
	 *
	 * Maps to the following EndPoint
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/CommandCtrl/getTranslations
	 * 		http://localhost/ServerSide/Assessment/WebService/CommandCtrl/getTranslations
	 * 		http://localhost/ServerSide/Assessment/WebService/index.php/translations
	 * 		http://localhost/ServerSide/Assessment/WebService/translations
	 */
	//public function getTranslations($textSpeak = null) {
	public function getTranslations() {
		/* Words ending in a forward slash (e.g. "w/")
		 * cannot be found in this method because of the special nature of forward slashes
		 * in RESTful APIs
		 */

		/**
		 * REF :	http://stackoverflow.com/questions/14635692/codeigniter-how-to-capture-slashes-in-route-and-pass-to-controller
		 * Retrieve the arguments from 'func_get_args()'
		 * Required since some text Speak contains forward slashes ('/') E.g. "w/end"
		 * This should be one argument but is passed into getTranslations() function
		 * as two (or more) by CodeIgniter.
		 **/
		$textSpeak = implode("/", func_get_args());

		/*	Replace '%20' with a space	*/
		$textSpeak = str_replace("%20", " ", $textSpeak);

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

		/*
		 * Pass the translations into the view
		 * and display them
		 */
		$this->load->view('TxtView', $data);

	}

}
