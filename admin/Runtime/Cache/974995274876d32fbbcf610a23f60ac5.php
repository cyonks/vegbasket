<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/admin.css" />
<link href="__PUBLIC__/tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />

	<title></title>
</head>
<body>
<div id="main">
	<div class="title">分类列表</div>
	<div class="content">
	<table width="98%" cellpadding="0" cellspacing="0" class="mytab">
	  <tr>
        <th>编号</th>
        <th>分类名称</th>
        <th>分类描述</th>
      </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td><?php echo ($vo["category_id"]); ?></td>
      <td><?php echo ($vo["category_name"]); ?></td>
      <td><?php echo ($vo["category_desc"]); ?></td> 
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>

	</table>
	</div>
</div>
</body>
</html>