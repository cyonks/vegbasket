<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="__PUBLIC__/ueditor/themes/default/ueditor.css"/>
	<script type="text/javascript" src="__PUBLIC__/ueditor/editor_config.js"></script>
	<script type="text/javascript" src="__PUBLIC__/ueditor/editor_all.js"></script>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/admin.css" />
	<title>添加新闻</title>
</head>
<body>
<div id="main">
	<div class="title">分类列表</div>
	<div class="content">
 		<h2>新文章</h2>
			<br></br>
	
   	<!-- 实例化百度编辑器 -->

   	<form action="__URL__/AddNews"  method="post">
   		<p class="subtit">新闻标题</p>
		<div>
			<select id="selType">
				<option value="0">请选择</option>
				<option value="1">原创</option>
				<option value="2">转载</option>
				<option value="4">翻译</option>
			</select>
			<input type="text" id="txtTitle" name="subject" style="width:560px; height:20px; float:left;" maxlength="100" value="<?php echo ($article_item["subject"]); ?>"/>
		</div>
		<br></br>
		<p class="subtit">新闻内容</p>
	    <div id="myEditor">
			<script type="text/javascript">
				var editor = new baidu.editor.ui.Editor({
				    initialContent: '<?php echo ($article_item["message"]); ?>'
				});
				editor.render("myEditor");
			</script>
		</div>
		<br></br>
		<input type="hidden" value="<?php echo ($article_item["id"]); ?>" name="id"/>
		<input type="submit" value="添加新闻"/>
	</form>
    <div class="clear"></div>

    </div>
    </div>
</body>
</html>