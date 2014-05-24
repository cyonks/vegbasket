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
	<div class="title">价格列表</div>
	<div class="content" id="container">
  <div id="tb_content">
    <!-- all you need with Tablecloth is a regular, well formed table. No need for id's, class names... -->
    <table cellspacing="0" cellpadding="0">
            <thead>
            <tr>
              <th scope="col">日期
              <!--
                  <input id="sdate" class="Wdate" type="text" onClick="WdatePicker()">
              -->
              </th>

              <th scope="col">市场</th>
              <th scope="col">产品</th>
              <th scope="col">类别</th>
              <th scope="col">价格</th>
              <th scope="col">发布者</th>
              <th scope="col">数据来源</th>
            </tr>
            </thead>
            <tbody id="tbody">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" id="tb_body">
              <td><a href="" target="_blank"><?php echo ($vo["pdate"]); ?></a></td>
              <td><?php echo ($vo["market_name"]); ?></td>
              <td><a href="__URL__/../Product/index/pname/<?php echo ($vo["product_name"]); ?>/mname/<?php echo ($vo["market_name"]); ?>" target="_blank"><?php echo ($vo["product_name"]); ?></a></td>
              <td><?php echo ($vo["category_name"]); ?></td>
              <td><?php echo ($vo["product_price"]); ?></td>
              <td><a href="" target="_blank"><?php echo ($vo["publisher"]); ?></a></td>
              <td><?php echo ($vo["datasource"]); ?></td> 
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
    </table>
    <div class="result page" id="page"><?php echo ($page); ?></div>
    
  </div>
</div>
</div>
</body>
</html>