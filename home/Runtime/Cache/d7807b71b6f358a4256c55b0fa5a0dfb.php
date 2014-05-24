<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>菜篮子最新动态</title>
</head>
<body>
	<?php if(is_array($newslist)): $i = 0; $__LIST__ = $newslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nl): $mod = ($i % 2 );++$i;?><p><a href="__URL__/newsdetail/newsid/<?php echo ($nl["news_id"]); ?>"><?php echo ($nl["news_title"]); ?></a></p><?php endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>