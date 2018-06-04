<?php

 $url = explode('/', $_SERVER['REQUEST_URI'], 5);

// // j'ai supprimé la limite car le array_supprimait de toute façon le dernier élément même si c'était inférieur a 5
 if(count($url) > 4){
    array_pop($url);
}

//  var_dump($url);
// echo "<br>";
// var_dump($url);
// echo "<br>";
$path = implode('/', $url);
var_dump($path);

switch ($path){
case '/projets/weTransferBis':
case '/projets/weTransferBis/':
require_once('controllers/home.php');
break;

case '/projets/weTransferBis/intermediaire':
case '/projets/weTransferBis/intermediaire/':
require_once('controllers/intermediaire.php');
break;


case '/projets/weTransferBis/reception':
case '/projets/weTransferBis/reception/':
require_once('controllers/reception.php');
break;

case '/projets/weTransferBis/download':
case '/projets/weTransferBis/download/':
require_once('controllers/download.php');
break;

default:
require_once('controllers/404-error.php');
break;
}