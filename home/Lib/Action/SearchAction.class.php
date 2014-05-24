<?php
	class SearchAction extends Action{

		//根据关键字搜索产品名字
		public function searchkw(){
			
			// $sql = "CALL search_product('".$SearchKey."',".$Page->firstRow.",".$Page->listRows.")";
			// $model = M("");
			// $this->data = $model -> query($sql);			
		   	$Product= M('priceinfo');
	    	import('ORG.Util.Page');
	    	$keyword=$_REQUEST['SearchKey'];
	    	$keyword = stripslashes(urldecode($keyword));
			$keyword = urldecode($keyword);

	    	// dump($_REQUEST['SearchKey']);
	    	$condition['product_name']=array('like','%'.$_REQUEST['SearchKey'].'%');
	    	$count=$Product->where($condition)->count();
	    	// $parameter='SearchKey='.urlencode($_REQUEST['SearchKey']);
	    	$Page=new Page($count,20);

	    	$parameter=array();
	    	$parameter['SearchKey']=$keyword;
	    	$Page->parameter=U(MODULE_NAME.'/'.ACTION_NAME,"?SearchKey=".$parameter);
	    	// dump($Page->parameter);

	    	$this->count=$count;
	    	$limit=$Page->firstRow.','.$Page->listRows;
	        $list=$Product->where($condition)->limit($limit)->select();
	        $show= $Page->show();// 分页显示输出
		    // $Page->parameter.="&SearchKey=".$SearchKey;
		    $this->assign('page',$show);// 赋值分页输出
		    $this->assign('list',$list);// 赋值数据集
		    $this->display(); // 输出模板
		}
		public function index(){
			import("@.ORG.Page");       //导入分页类
	    	$Product= M('priceinfo');
	    	$MCity=M('city');
	    	$MCategory=M('category');

			$current_date=$_REQUEST['date'];
			$category=$_REQUEST['category'];		
			$city=$_REQUEST['city'];		
			$keyword=$_REQUEST['keyword'];

			$category=iconv("GB2312","UTF-8",$category);
			$city=iconv("GB2312","UTF-8",$city);
			$keyword=iconv("GB2312","UTF-8",$keyword);

		    $test='date='.$current_date."&city=".$city."&category="
		    	.$category."&keyword=".$keyword;
			$category=stripslashes(urldecode($category));
			$category=urldecode($category);
			$city=urldecode($city);
			$keyword=urldecode($keyword);


			if($category=="不限")
			{
				$category=null;
			}
	    	if(!$current_date)
	    	{
	    	    // 默认当前日期
		    	$current_date=date('Y-m-d',time());    		
	    	}		
			$map['pdate']=array('eq',$current_date);
			if($keyword)
			{
				$map['product_name']=array('like','%'.$keyword.'%');				
			}
			if($category)
			{
				$map['category_name']=array('eq',$category);
			}	
			if($city)
			{
				$map['city_name']=array('eq',$city);
			}

		    $test2='date='.$current_date."&city=".$city."&category=".$category."&keyword=".$keyword;

			$this->parameter=$test2;

			$this->UpdateCount($keyword);

	    	$count=$Product->where($map)->count();
	    	// $Page=new Page($count,10);
	    	if(!$count)$count=0;
	    	$this->count=$count;

	    	$condition1['city_name']=array('neq',$city);

	    	$condition2['category_name']=array('neq',$category);

	    	$this->listcity=$MCity->where($condition1)->select();
	    	$this->listcate=$MCategory->where($condition2)->select();
	    	if($category==null||$category=='不限'){
	    		$this->listcate=$MCategory->select();
	    	}
	    	$this->city=$city;
	    	$this->category=$category;
	    	if(!$city)$this->city="广州";
	    	if(!$category)$this->category="不限";

	        // $show       = $Page->show();// 分页显示输出
	        $list=$Product->where($map)->select();
		    $this->assign('date',$current_date);
		    $parame='date='.$current_date."&city=".urlencode($city)."&category="
		    	.urlencode($category)."&keyword=".urlencode($keyword);
		    // $this->parameter=$test;	
		    // $this->parameter2=$test2;
		    $this->keyword=$keyword;
		    $this->listsearch=$this->getSearchList();
			$param = array(
				'result'=>$list,			//分页用的数组或sql
				'listvar'=>'list',			//分页循环变量
				'listRows'=>10,			//每页记录数
				'parameter'=>$parame,//url分页后继续带的参数
				'target'=>'tb_content',	//ajax更新内容的容器id，不带#
				'pagesId'=>'page',		//分页后页的容器id不带# target和pagesId同时定义才Ajax分页
				'template'=>'Search:table',//ajax更新模板
			);
			// $this->parameter3=$param['parameter'];
			$this->page($param);
			$this->display();
		}

		//获取热门搜索前4
		private function getSearchList(){
			$Product=M('product');
			$searchlist=$Product->limit(4)->order('search_count desc')->select();
			return $searchlist;
		}
		//修改产品搜索次数
		private function UpdateCount($keyword){
			$Product=M('product');
			$map['product_name']=array('eq',$keyword);
			$result=$Product->where($map)->find();
			if($result){
				$pid=$result['product_id'];		
				$count=$Product->where('product_id='.$pid)->setInc('search_count',1);
			}
			return;
		}
		//获取关键词列表
		public function getdata(){
			header("Content-type:text/html;charset=gb2312");
			$Product=M('product');
			$keywords = iconv("utf-8","gb2312//IGNORE",$_POST['keywords']);
			// $keywords=$_REQUEST['keywords'];
			$map['product_name']=array('like',$keywords);
			$result=$Product->where($map)->limit(10)->select();
			if($result){
				$data="[{'keywords':'".$result[0]['product_name']."'}";
				for($i=1;$i<10;$i++){
					$data.=",{'keywords':'".$result[$i]['product_name']."'}";
				}
				$data.="]";
			}
			$data="[{'keywords':'".count($result)."'},{'keywords':'".$result[1]['product_name']."'}]";
			echo $data;
			// $this->ajaxReturn($result,"获取产品列表成功！",1);
		}

		public function search(){
			$priceinfo=M('priceinfo');
			// $keyword="菜心";
			// $current_date="2014-03-23";
			// $category="蔬菜";
			// $city="广州";
			$current_date=$_GET['date'];
			$category=$_GET['category'];
			$city=$_GET['city'];
			if($category=="不限")
			{
				$category=null;
			}
			$map['pdate']=array('eq',$current_date);
			if($keyword)
			{
				$map['product_name']=array('like','%'.$keyword.'%');				
			}
			if($category)
			{
				$map['category_name']=array('eq',$category);
			}	
			if($city)
			{
				$map['city_name']=array('eq',$city);
			}

			$list=$priceinfo->where($map)->limit($limit)->select();
	        // $show= $Page->show();// 分页显示输出
			// $this->assign('list',$list);
			// $this->display('searchkw');
			if($list){
				$this->ajaxReturn($list,'登陆成功',1);
			}else{
				$this->ajaxReturn('no','登陆失败',0);
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
?>