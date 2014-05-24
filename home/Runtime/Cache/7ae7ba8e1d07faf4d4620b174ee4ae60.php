<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ($detail['news_title']); ?></title>
</head>
<body>
	<div>
		<h1><?php echo ($detail['news_title']); ?></h1>
		<p><?php echo ($detail['public_date']); ?></p>
		<p><?php echo ($detail['publisher']); ?></p>		
		<div id="content_news"><?php echo ($detail['news_content']); ?></div>		
	</div>

</body>
</html>