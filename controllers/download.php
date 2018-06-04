<?php

require_once 'vendor/autoload.php';
require_once ('models/request.php');

$loader = new Twig_Loader_Filesystem('./views');
$twig = new Twig_Environment($loader, array('cache' => false));

var_dump($_GET['url_file']);

$allInfosDl = linkAll($_GET['url_file']);

var_dump($allInfosDl);

echo $twig->render('download.html', array('allinfos'=>$allInfosDl));

