<?php

	require_once 'vendor/autoload.php';
	require_once('models/request.php');


	$loader = new Twig_Loader_Filesystem('./views');
	$twig = new Twig_Environment($loader, array('cache' => false));

	// $getLink = getLink();

	// var_dump($_FILES);
	echo $twig->render('reception.html');