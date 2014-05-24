<?php
require './login.inc.php';
require './init.inc.php';
class WebconfigAction extends Action{
	public function index(){
		$this->display();
	}
}