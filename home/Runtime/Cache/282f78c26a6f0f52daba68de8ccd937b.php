<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>菜篮子查询网</title>
<!-- paste this code into your webpage -->
<link href="__PUBLIC__/tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
<link rel='stylesheet' href='__PUBLIC__/css/index.css' type='text/css'/>

<script type="text/javascript" src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="__PUBLIC__/tablecloth/tablecloth.js"></script>
<!-- end -->
<style>
body { margin:0; padding:0; background:#FFFDFD; font:70% Arial, Helvetica, sans-serif; color:#555; line-height:150%; text-align:left; }
a { text-decoration:none; color:#057fac; }
a:hover { text-decoration:none; color:#999; }
h1 { font-size:140%; margin:0 20px; line-height:80px; }
h2 { font-size:120%; }
#container { margin:0 auto; width:900px; background:#fff; padding-bottom:20px; }
#content { margin:0 20px; }

</style>
</head>
<body>
<div class="whole_page2">
  <div class="C_top">
  <div class="C_logo"><a href="/vegbasket" title="菜篮子查询网">菜篮子查询网</a></div>
  <div class="C_search">
  <form action="__URL__/../Search/searchkw" method="post" name="DJmyform" id="DJmyform">
    <div class="C_searchTxt">
      <input type="text" name="SearchKey" id="SearchKey" autocomplete="off" class="C" value="请输入产品名称或产品编号查询" onfocus="if(this.value=='请输入产品名称或产品编号查询') this.value='';" onblur="if(this.value=='') this.value='请输入产品名称或产品编号查询';" />
    </div>
    <div class="C_searchBtn">
      <input name="" type="submit" id="DJSearchSubmit" value="搜索" class="btn"/>
    </div>
    </form>
    <div class="search_key">热门查询:&nbsp;<a href="http://www.yaopinwu.com/price_search.php?SearchKey=参片" target="_blank">本地菜心</a> <a href="http://www.yaopinwu.com/price_search.php?SearchKey=糖浆" target="_blank">白菜</a> <a href="http://www.yaopinwu.com/price_search.php?SearchKey=注射液" target="_blank">鸡蛋</a>
    </div>
  </div>
</div>

<div>
<div id="container">
  <h1>查询结果</h1>
  <div id="tb_content">
    <!-- all you need with Tablecloth is a regular, well formed table. No need for id's, class names... -->
    
<h2 id="result_title">您查询的是：<span id="kw"><?php echo ($keyword); ?></span>,共有<?php echo ($count); ?>条记录</h2>
    <table cellspacing="0" cellpadding="0">
      <tr>
        <th>日期</th>
        <th>市场</th>
        <th>产品</th>
        <th>类别</th>
        <th>价格</th>
        <th>发布者</th>
        <th>数据来源</th>
      </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td><a href="" target="_blank"><?php echo ($vo["pdate"]); ?></a></td>
      <td><?php echo ($vo["market_name"]); ?></td>
      <td><?php echo ($vo["product_name"]); ?></td>
      <td><?php echo ($vo["category_name"]); ?></td>
      <td><?php echo ($vo["product_price"]); ?></td>
      <td><?php echo ($vo["publisher"]); ?></td>
      <td><?php echo ($vo["datasource"]); ?></td> 
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <div class="result page" id="page"><?php echo ($page); ?></div>
    <!-- <div>P:<?php echo ($parameter); ?></div> -->
    
  </div>
</div>
</div>
</body>
</html>