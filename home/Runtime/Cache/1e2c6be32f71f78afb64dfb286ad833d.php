<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Navigation Effect Using jQuery</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/styles.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/sliding_effect.js"></script>
</head>
<body>
<div id="navigation-block"> <img src="__PUBLIC__/images/background.jpg" id="hide" />
 
  <ul id="sliding-navigation">
    <li class="sliding-element">
      <h3>后台管理</h3>
    </li>
    <li class="sliding-element"><a href="category.html" target="mainframe">添加分类</a></li>
    <li class="sliding-element"><a href="__URL__/listcategory/display/product" target="mainframe">添加产品</a></li>
    <li class="sliding-element"><a href="__URL__/price" target="mainframe">发布价格</a></li>
   <li class="sliding-element"><a href="__URL__/news" target="mainframe">发布新闻</a></li>
	<li class="sliding-element"><a href="__URL__/listcategory/display/listcategory" target="mainframe">分类列表</a></li>
	<li class="sliding-element"><a href="__URL__/listproduct" target="mainframe">产品列表</a></li>
	<li class="sliding-element"><a href="__URL__/listprice" target="mainframe">价格列表</a></li>

  </ul>
</div>

</body>
</html>