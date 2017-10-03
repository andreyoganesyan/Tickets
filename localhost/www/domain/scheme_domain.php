<?php
	class Scheme {
		public $name;
		public $seats = array();
		public function __construct($name, $seats){
			$this->name = $name;
			$this->seats=$seats;
		}
	}


?>