<?php
require './login.inc.php';
require './init.inc.php';
 /**
  *价格管理
  */
 class PriceAction extends Action{

 	/**
 	 *
 	 */
 	public function index(){
 		import("@.ORG.Page");
 		$Priceinfo=M('priceinfo');
 		$list=$Priceinfo->select();

 		$param = array(
			'result'=>$list,			//分页用的数组或sql
			'listvar'=>'list',			//分页循环变量
			'listRows'=>10,			//每页记录数
			'parameter'=>'',//url分页后继续带的参数
			'target'=>'tb_content',	//ajax更新内容的容器id，不带#
			'pagesId'=>'page',		//分页后页的容器id不带# target和pagesId同时定义才Ajax分页
			'template'=>'ptable',//ajax更新模板
		);
		// $this->parameter3=$param['parameter'];
		$this->page($param);
		$this->display();
 	}

 	/**
 	*向页面price传递参数
 	*当前日期、分类列表、城市、市场列表、产品列表
 	*/
 	public function price(){
 		$this->today=date('Y-m-d',time());
 		$Category=M('category');
 		$City=M('city');

 		$this->categorylist=$Category->select();
 		$this->citylist=$City->select();

 		$first_city=$this->citylist[0]['city_name'];

 		//获取city_id
 		$map1['city_name']=array('eq',$first_city);
 		$result=$City->where($map1)->find();
 		$city_id=$result['city_id'];

 		//获取第一个城市的所有市场
 		$Market=M('market');
 		$map2['city_id']=array('eq',$city_id);
 		$this->marketlist=$Market->where($map2)->select();

 		//获取第一个分类的ID
 		$first_category=$this->categorylist[0]['category_name'];
 		$condition1['category_name']=array('eq',$first_category);
 		$result=$Category->where($condition1)->find();
 		$category_id=$result['category_id'];
 		//获取第一个分类的所有产品
 		$Product=M('product');
 		$condition2['category_id']=array('eq',$category_id);
 		$this->productlist=$Product->where($condition2)->select();

 		$this->display('addprice');
 	}
 	public function addPrice(){
 		$price=M('price');

 		//test data
 		// $date='2014-03-28';
 		// $market_name='广州4区2市菜篮子平均零售价格';
 		// $product_name='本地菜心';
 		// $product_price=20.00;
 		$datasource="广州物价局";
 		$publisher='admin';

 		//receive data
 		$date=$_REQUEST['date'];
 		if(empty($date))
 		{
 			$this->price();
 			return;
 		}
 		$market_name=$_REQUEST['mname'];
 		$product_name=$_REQUEST['pname'];
 		$product_price=(int)$_REQUEST['price'];
 		$datasource=$_REQUEST['datasource'];
 		$publisher=$_REQUEST['publisher'];
 		

 		$data['pdate']=$date;
 		$data['market_id']=$this->GetMID($market_name);
 		$data['product_id']=$this->GetPID($product_name);
 		$data['product_price']=$product_price;
 		$data['datasource']=$datasource;
 		$data['publisher']=$publisher;


 		$result=$price->add($data);
 		if($result){
		    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
		    $this->success('新增成功', 'price');
		 } else {
		    //错误页面的默认跳转页面是返回前一页，通常不需要设置
		    $this->error('新增失败');
		 }
 		// $this->display('index');
 	}

 	private function GetMID($market_name){
 		$Market=M('market');

 		$map['market_name']=array('eq',$market_name);
 		$result=$Market->where($map)->find();
 		return $result['market_id'];
 	}

 	private function GetPID($product_name){
 		$Product=M('product');

 		$map['product_name']=array('eq',$product_name);
 		$result=$Product->where($map)->find();
 		return $result['product_id'];
 	}

 	/**
 	*使用Ajax异步获取市场列表
 	*/
 	public function getmarket(){
 		$city_name=$_REQUEST['city'];
 		$City=M('city');
 		$map1['city_name']=array('eq',$city_name);
 		$result=$City->where($map1)->find();
 		$city_id=$result['city_id'];

 		$Market=M('market');
 		$map2['city_id']=array('eq',$city_id);
 		$result=$Market->where($map2)->select();
 		if($result){
 			$this->ajaxReturn($result,"新增成功！",1);
 		}else{
 			$this->ajaxReturn(0,"新增错误！",0);
 		}
 	}

 	/**
 	*异步获取产品列表
 	*/
 	public function getproduct(){
 		$category_name=$_REQUEST['category'];
 		$Category=M('category');

 		$map1['category_name']=array('eq',$category_name);
 		$result=$Category->where($map1)->find();
 		$category_id=$result['category_id'];

 		$Product=M('product');
 		$map2['category_id']=array('eq',$category_id);
 		$result=$Product->where($map2)->select();
 		if($result){
 			$this->ajaxReturn($result,"获取产品列表成功！",1);
 		}else{
 			$this->ajaxReturn(0,"无法获取数据！",0);
 		} 		
 	}



 	/**
	  +----------------------------------------------------------
	 * 分页函数 支持sql和数据集分页 sql请用 buildSelectSql()函数生成
	  +----------------------------------------------------------
	 * @access public
	  +----------------------------------------------------------
	 * @param array   $result 排好序的数据集或者查询的sql语句
	 * @param int       $totalRows  每页显示记录数 默认21
	 * @param string $listvar    赋给模板遍历的变量名 默认list
	 * @param string $parameter  分页跳转的参数
	 * @param string $target  分页后点链接显示的内容id名
	 * @param string $pagesId  分页后点链接元素外层id名
	 * @param string $template ajaxlist的模板名
	 * @param string $url ajax分页自定义的url
	  +----------------------------------------------------------
	 */
	public function page($param) {
		extract($param);
		import("@.ORG.Page");
		//总记录数
		$flag = is_string($result);
		$listvar = $listvar ? $listvar : 'list';
		$listRows = $listRows? $listRows : 21;
		if ($flag)
			$totalRows = M()->table($result . ' a')->count();
		else
			$totalRows = ($result) ? count($result) : 1;
		//创建分页对象
		if ($target && $pagesId)
			$p = new Page($totalRows, $listRows, $parameter, $url,$target, $pagesId);
		else
			$p = new Page($totalRows, $listRows, $parameter,$url);
		//抽取数据
		if ($flag) {
			$result .= " LIMIT {$p->firstRow},{$p->listRows}";
			$voList = M()->query($result);
		} else {
			$voList = array_slice($result, $p->firstRow, $p->listRows);
		}
		$pages = C('PAGE');//要ajax分页配置PAGE中必须theme带%ajax%，其他字符串替换统一在配置文件中设置，
		//可以使用该方法前用C临时改变配置
		foreach ($pages as $key => $value) {
			$p->setConfig($key, $value); // 'theme'=>'%upPage% %linkPage% %downPage% %ajax%'; 要带 %ajax%
		}
		//分页显示
		$page = $p->show();
		//模板赋值
		$this->assign($listvar, $voList);
		$this->assign("page", $page);
		if ($this->isAjax()) {//判断ajax请求
			layout(false);
			$template = (!$template) ? 'ajaxlist' : $template;
			exit($this->fetch($template));
		}
		return $voList;
	} 	
 }