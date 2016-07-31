<?php
/*
* Author: Elizabeth Conway
* Assignment: WE4.0 Server-side Web Development, Digital Skills Academy
* Student ID: D11122173
* Date : 2016/07/31
* Ref: https://en.wikipedia.org/wiki/Ten_Commandments
*/

/**
 * CmdModel - the Model class in the MVC architecture.
 * It connects to the database specified in config/database.php
 * The database is autoloaded in config/autoload.php
 *
 * @author liz
 *
 */
class CmdModel extends CI_Model {

	/**
	 * This is the constructor method of this class
	 * It call the parent classes constructor (CI_Model)
	 */
	function CmdModel() {
		parent::__construct();
		/**
		 * There is no constructor with the class name in Model.php
		 * so forced to go with the __construct() naming convention
		 */
		//parent::CI_Model();
		//parent::Model();
	}

	/**
	 * This function retrieve commandment data from the database.
	 * A subset of the commandments to retrieve can be specified using the
	 * $from and $to parameters.
	 * If both parameters are zero then retrieve all the commandments
	 *
	 * @param integer $from - The start of the commandments to retrieve
	 * 							If this is zero - start with the first commandment
	 * @param integer $to - The end of the commandments to retrieve
	 * 							If this is zero - end with the last commandment
	 */
	function getCommandments($from, $to) {
		$this->db->select('number, title, description, url')->from('commandments');

		/*
		 * Allows for parameters to be added in reverse order
		 */
		$higher = max($from, $to);
		$lower = min($from, $to);

		if($lower != 0) {
			$this->db->where('number >=', $lower);
		}
		if($higher != 0) {
			$this->db->where('number <=', $higher);
		}

		/*
		 * If $from is higher than $to then retrieve the commandment in descending order.
		 */
		if($from > $to) {
			$order = 'DESC';
		} else {
			$order = 'ASC';
		}
		$this->db->order_by('number', $order);

		$query = $this->db->get();

		/* $qry = $this->db->last_query();
		echo "\n$qry\n"; */

		return $query->result();
	}

	/**
	 * This function retrieve translation data from the database.
	 * A single translation to retrieve can be specified using the $textSpeak parameter.
	 * If the parameter is null then retrieve all the translations
	 *
	 * @param String $textSpeak
	 */
	function getTranslations($textSpeak) {

		$this->db->select('txt, english')->from('textSpeak');

		if($textSpeak != null) {
			$this->db->where('txt', $textSpeak);
		}

		$query = $this->db->get();

		return $query->result();
	}

}
?>