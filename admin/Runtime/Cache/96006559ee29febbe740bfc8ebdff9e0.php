<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<!-- paste this code into your webpage -->
<link href="__PUBLIC__/tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
<link rel='stylesheet' href='__PUBLIC__/css/index.css' type='text/css'/>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/admin.css" />
</head>
<body>
<div id="main">
	<div class="title">新闻列表</div>
	<div class="content" id="container">
	  <div id="tb_content">
	    <!-- all you need with Tablecloth is a regular, well formed table. No need for id's, class names... -->
	    <table cellspacing="0" cellpadding="0">
      <tr>
        <th>编号</th>
        <th>题目</th>
        <th>发布日期</th>
        <th>发布者</th>
      </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td><?php echo ($vo["news_id"]); ?></td>
      <td><?php echo ($vo["news_title"]); ?></td>
      <td><?php echo ($vo["public_date"]); ?></td>
      <td><?php echo ($vo["publisher"]); ?></td> 
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <div class="result page" id="page"><?php echo ($page); ?></div>
	    
	  </div>
	</div>
</div>
</body>
</html>