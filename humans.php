<?php session_start();
require 'admin/config.php'; 
require 'functions.php'; 

	$h = 0;
	if (isset($_GET['h'])) {
		$h = $_GET['h'];

		if($h<0 || $h>16){
			header('Location: index.php');
		}
	}

require 'views/header.php';
require 'views/humans.view.php';
 ?>