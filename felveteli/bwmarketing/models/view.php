<?php
if (!defined('SERVER_ROOT'))
	exit('No direct script access allowed');
class View_Model {
	private $data = array();
	
	private $render = FALSE;
	
	public function __construct($template) {
		$file = 'views/' . strtolower($template) . '.php';
		
		if (file_exists($file)) {
			$this->render = $file;
		}		
	}
	
	public function assign($variable , $value) {
		$this->data[$variable] = $value;
	}
	
	public function __destruct() {
		$data = $this->data;
		
		if (!empty($this->render)) {
			include($this->render);
		}
	}

}
