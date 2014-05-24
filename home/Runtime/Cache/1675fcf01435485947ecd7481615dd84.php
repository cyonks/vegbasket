<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta  http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>添加分类</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/admin.css">
</head>
<body>
   <div class="formdiv">
	  <form  enctype="multipart/form-data" class="inform" action="__URL__/../Admin/AddCategory" method="post">
		<p>
			<input  type="text" name="cname" placeholder="类名"/>

		</p>	
		<p>
			<textarea name="cdesc" cols="60" rows="20" placeholder="分类描述"></textarea>
		</p>

	   
		<input class="submit" type="submit" value="提交"/>
	   </form>

	</div>
</body>
</html>