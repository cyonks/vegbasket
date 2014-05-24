<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.head { 
			background-color:#222; 
			height:100% ; 
			width:100%; 
			position:absolute;
		}
		body { 
			background-color:Yellow;
			margin:0px; 
			padding:0px; 
			overflow:hidden;
		}
		.title{
			text-align: center;
			color:white;
		}
		.logout{
			margin-top: 10px;
			margin-right: 30px;
			display: inline-block;
			float: right;
			color:white;			
		}
		a{
			text-decoration: none;
			color: red;
		}
		.title{
			margin-top: 10px;
			margin-left: 50px;
			text-align: center;
			font-size: 18px;
			display: inline-block;
		}
	</style>
</head>
<body>
	<div class="head">
	  <div class="title">菜篮子后台管理</div>
	  <div class="logout">[<a href="__URL__/logout" target="_top">退出</a>]</div>

	</div>
	
</body>
</html>