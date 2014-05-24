<?php
session_start();
if (!isset($_SESSION['uname'])){
	$path = explode('/',__URL__,-1);
	$path = join('/',$path);
	header('Location:'.$path.'/Login');
	exit;
}else{
	if ($_SESSION['uname'] != 'admin'){
		exit;
	}
}