<?php 
namespace app\admin\controller;
use think\Controller;

class IndexController extends CommonController {

	public function index() {
		return $this->fetch('index/index');
	}

	public function top() {
		return $this->fetch('index/top');
	}

	public function left() {
		return $this->fetch('index/left');
	}

	public function main() {
		return $this->fetch('index/main');
	}


}




 ?>