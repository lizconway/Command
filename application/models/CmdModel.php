<?php
class CmdModel extends CI_Model {

	function CmdModel() {
		parent::__construct();
		/**
		 * There is no constructor with the class name in Model.php
		 * so forced to go with the __construct() naming convention
		 */
		//parent::CI_Model();
		//parent::Model();
	}

	function getCommandments($from, $to) {
		$this->db->select('number, title, description, url')->from('commandments');

		$higher = max($from, $to);
		$lower = min($from, $to);

		if($lower > 0 && $lower < 11) {
			$this->db->where('number >=', $lower);
		}
		if($higher > 0 && $higher < 11) {
			$this->db->where('number <=', $higher);
		}

		if($from > $to) {
			$order = 'DESC';
		} else {
			$order = 'ASC';
		}
		$this->db->order_by('number', $order);

		$query = $this->db->get();

		return $query->result();
	}

	function getTranslations($textSpeak) {
// 		echo "Text Speak :  $textSpeak";
		$this->db->select('txt, english')->from('textSpeak');

		$query = $this->db->get();

		return $query->result();
	}

}
?>