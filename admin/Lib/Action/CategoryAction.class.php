<?php
require './login.inc.php';
require './init.inc.php';
/**
 *分类管理
 */
class CategoryAction extends Action{
	/**
	 *分类首页，返回分类列表
	 */
	public function index(){
		$Category=M('category');
 		$this->list=$Category->select();
 		$this->display();
	}

	/**
	 *添加分类
	 */
	public function addCate(){
		$cname=$_REQUEST['cname'];
 		$cdesc=$_REQUEST['cdesc'];
 		if(empty($cname)||empty($cdesc)){
 			$this->display();
 			return;
 		}
 		$data['category_name']=$cname;
 		$data['category_desc']=$cdesc;
 		$map['category_name']=array('eq',$cname);
 		$Category=M('category');
 		if($Category->where($map)->find()){
 			$this->error('分类已经存在！');
 			return;
 		}
 		$result=$Category->add($data);
 		if($result){
 			$this->success('添加分类成功','category');
 		}else{
 			$this->error('添加分类失败');
 		}
	}
}