<?php
// 本类为网站首页Action
class IndexAction extends Action {

   	public function index() {
		import("@.ORG.Page");       //导入分页类
    	$Priceinfo= M('priceinfo');	//priceinfo为数据库视图
    	$City=M('city');
    	$Category=M('category');

    	//获取页面传递参数
		$current_date=$_REQUEST['date'];
		$category=$_REQUEST['category'];

		$city=$_REQUEST['city'];			
		$keyword=$_REQUEST['keyword'];

		// $this->parameter=$category;
		$category=iconv("GB2312","UTF-8",$category);
		$city=iconv("GB2312","UTF-8",$city);
		$keyword=iconv("GB2312","UTF-8",$keyword);

	    $test='date='.$current_date."&city=".$city."&category="
	    	.$category."&keyword=".$keyword;

		$category=stripslashes(urldecode($category));
		$category=urldecode($category);
		$city=urldecode($city);
		$keyword=urldecode($keyword);
	    $test2='date='.$current_date."&city=".$city."&category=".$category."&keyword=".$keyword;

		if(!$category)
		{
			$category="蔬菜";
		}
		if(!$city)
		{
			$city="广州";
		}
    	if(!$current_date)
    	{
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

    	$condition1['city_name']=array('neq',$city);

    	$condition2['category_name']=array('neq',$category);
	    $this->select_city=$city;
	    $this->select_cate=$category;
    	$this->listcity=$City->where($condition1)->select();
    	$this->listcate=$Category->where($condition2)->select();
    	$this->listnews=$this->getNewsList();
    	$this->listsearch=$this->getSearchList();

    	$count=$Priceinfo->where($map)->count();

        // $show       = $Page->show();// 分页显示输出
        $list=$Priceinfo->where($map)->select();
	    $this->assign('date',$current_date);
	    $parame='date='.$current_date."&city=".urlencode($city)."&category="
	    	.urlencode($category)."&keyword=".urlencode($keyword);
	    // $this->parameter=$test;	
	    // $this->parameter2=$test2;
		$param = array(
			'result'=>$list,			//分页用的数组或sql
			'listvar'=>'list',			//分页循环变量
			'listRows'=>10,			//每页记录数
			'parameter'=>$parame,//url分页后继续带的参数
			'target'=>'tb_content',	//ajax更新内容的容器id，不带#
			'pagesId'=>'page',		//分页后页的容器id不带# target和pagesId同时定义才Ajax分页
			'template'=>'Index:table',//ajax更新模板
		);
		// $this->parameter3=$param['parameter'];
		$this->page($param);
		$this->display();
	}
	private function getNewsList(){
		$News=M('news');
		$newslist=$News->limit(5)->order('public_date desc')->select();
		return $newslist;
	}
	private function getSearchList(){
		$Product=M('product');
		$searchlist=$Product->limit(4)->order('search_count desc')->select();
		return $searchlist;
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