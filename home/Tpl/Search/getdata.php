<?php
	
	header("Content-type:text/html;charset=gb2312");
	//数据库配置信息(用户名,密码，数据库名，表前缀等)
	$cfg_dbhost = "localhost:3300";
	$cfg_dbuser =	"root";
	$cfg_dbpwd = "123456";
	$cfg_dbname = "veg_basket";
	$cfg_dbprefix = "";

	$link = mysql_connect($cfg_dbhost,$cfg_dbuser,$cfg_dbpwd);
	mysql_select_db($cfg_dbname);
	mysql_query("set names gbk");
	//防止乱码
	$keywords = iconv("utf-8","gb2312//IGNORE",$_POST['keywords']);
	//匹配输入的关键字相关的标题，并按点击量排名，点击越多的排最前面
	// $sql = "select title from ".$cfg_dbprefix."article where title like '%".$keywords."%' order by click desc limit 0,9;";
	//echo $sql;
	$sql="select product_name from product where product_name like '%".$keywords."%' limit 0,9;";
	$res = mysql_query($sql,$link);
	
	$mNums = mysql_num_rows($res);
	//echo $mNums;
	$row=mysql_fetch_array($res);
	if($mNums<1){
		echo "no";
		exit();
	}else if($mNums==1){
		//返回json数据
		echo "[{'keywords':'".iconv_substr($row['product_name'],0,14,"gbk")."'}]";
	}else{
		$result="[{'keywords':'".iconv_substr($row['product_name'],0,14,"gbk")."'}";
		while($row=mysql_fetch_array($res)){
			$result.=",{'keywords':'".iconv_substr($row['product_name'],0,14,"gbk")."'}";
		}
		$result.=']';
		echo $result;
	}
	mysql_free_result($res);

?>

