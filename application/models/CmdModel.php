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

	function getCommandments() {
		$this->db->select('number, title, description, url')->from('commandments');

		$query = $this->db->get();

		return $query->result();
	}

	function getTranslations() {
		$this->db->select('txt, english')->from('textSpeak');

		$query = $this->db->get();

		return $query->result();
	}

}
?>