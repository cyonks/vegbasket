<?php
require './login.inc.php';
require './init.inc.php';
 /**
  *产品管理
  */
class ProductAction extends Action{

	/**
	 *产品列表
	 */
	public function index(){
 		import("@.ORG.Page");
 		$Product=M('product');
 		$list=$Product->select();

 		$param = array(
			'result'=>$list,			//分页用的数组或sql
			'listvar'=>'list',			//分页循环变量
			'listRows'=>10,			//每页记录数
			'parameter'=>'',//url分页后继续带的参数
			'target'=>'tb_content',	//ajax更新内容的容器id，不带#
			'pagesId'=>'page',		//分页后页的容器id不带# target和pagesId同时定义才Ajax分页
			'template'=>'Admin:ptable',//ajax更新模板
		);
		// $this->parameter3=$param['parameter'];
		$this->page($param);
		$this->display();
	}

	/**
	 *添加产品
	 */
	public function addProduct(){
 		import("@.ORG.First");
 		import("@.ORG.ChineseSpell");

 		$pname=$_REQUEST['pname'];
 		$cname=$_REQUEST['cname'];
 		$pdesc=$_REQUEST['pdesc'];
 		if(empty($pname)||empty($cname))
 		{
 			$Category=M('category');
 			$this->list=$Category->select();
 			$this->display('addproduct');
 			return;
 		}
 		$ff=new First();
		$pinyin=$ff->pinyin_long($pname);
		
		$ff=new ChineseSpell();
		$str=iconv("UTF-8","GB2312//IGNORE",$pname);
		$pinyin.=','.$ff->getChineseSpells($str);

 		$pimg=$pname.'.jpg';
 		$cid=$this->GetCID($cname);
 		$Product=M('product');
 		$data['product_name']=$pname;
 		$data['category_id']=$cid;
 		//判断数据库是否已存在
 		if($Product->where($data)->find())
 		{
 			$this->error('该产品已存在');
 			return;
 		}
 		$data['product_desc']=$pdesc;
 		$data['product_img']=$pimg;
 		$data['pinyin']=$pinyin;

 		$result=$Product->add($data);
 		if($result){
		    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
		    $this->success('新增成功', 'addProduct');
		 } else {
		    //错误页面的默认跳转页面是返回前一页，通常不需要设置
		    $this->error('新增失败');
		 }

		 //上传图片
 		if(is_uploaded_file($_FILES['imgfile']['tmp_name'])){

 			if(!eregi('image/jpeg', $_FILES['imgfile']['type'])){
 				$this->test="not img";
 				// $this->display('product');
 			}
 			else{
 				$filename=$_FILES['imgfile']['name'];
 				if(move_uploaded_file($_FILES['imgfile']['tmp_name'], dirname(dirname(dirname(__FILE__))).'/public/images/pimg/'.iconv("UTF-8","gb2312",$pimg))){
 					$this->test="no img";
 					// $this->success('新增成功', 'product');
 				}else{
 					$this->test="n img";
 					// $this->error('新增失败');
 				}
 			}
 		}
 		// $this->display('product');
	}

 	private function GetCID($category_name){
 		$Category=M('category');

 		$map['category_name']=array('eq',$category_name);
 		$result=$Category->where($map)->find();
 		return $result['category_id'];
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