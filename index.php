<?php
	//项目主入口文件,负责项目的初始化
	define('THINK_PATH','./ThinkPHP/');
	define('APP_PATH','./home');
	define('APP_NAME','home');
	
	require THINK_PATH.'ThinkPHP.php';
	
	APP::run();
?>