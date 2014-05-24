<?php

require './init.inc.php';
 /**
  * 后台处理
  *
  */
 class IndexAction extends Action{

 	function index(){
		header('Content-Type:text/html;charset=utf-8');		
		session_start();
		if (!isset($_SESSION['uname'])){
			$path = explode('/',__URL__,-1);
			$path = join('/',$path);
			header('Location:'.$path.'/Login');
		}else{
		//如果登录成功			
			$this->display();
		}

 	}

 	//批量生成拼音
 	public function testpinyin(){
 		import("@.ORG.First");
 		import("@.ORG.ChineseSpell");
 		$Product=M('product');
		$ff=new First();
		$cs=new ChineseSpell();
 		$result=$Product->select();
 		for($i=0;$i<count($result);$i++){
 			$pinyin="";
 			$pname=$result[$i]['product_name'];
 			$pinyin=$ff->pinyin_long($pname);
			$str=iconv("UTF-8","GB2312//IGNORE",$pname);
			$pinyin.=','.$cs->getChineseSpells($str);
 			$Product->where('product_id='.$result[$i]['product_id'])->setField('pinyin',$pinyin);
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