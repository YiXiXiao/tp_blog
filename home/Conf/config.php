<?php
	$inc=include './config.inc.php';
	
	$con=array(
		'DEFAULT_MODULE'=>'Home',
		'DEFAULT_ACTION'=>'index',
		'URL_MODEL'=>'2',
	);
	
	return array_merge($inc,$con);
?>