<?php

class NewsAction extends Action{

	public function index(){
		$News=M('news');
		$this->newslist=$News->order('public_date desc')->select();
		$this->display();
	}

	public function newsdetail(){
		$news_id=$_REQUEST['newsid'];
		$News=M('news');
		$map['news_id']=array('eq',$news_id);
		$this->detail=$News->where($map)->find();
		$this->display();
	}
}

?>