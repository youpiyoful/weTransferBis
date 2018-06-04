<?php

 $url = explode('/', $_SERVER['REQUEST_URI'], 5);

<<<<<<< HEAD
// j'ai supprimé la limite car le array_supprimait de toute façon le dernier élément même si c'était inférieur a 5
if(count($url) > 3){
   array_pop($url);
 }

=======
// // j'ai supprimé la limite car le array_supprimait de toute façon le dernier élément même si c'était inférieur a 5
 if(count($url) > 4){
    array_pop($url);
}

//  var_dump($url);
// echo "<br>";
// var_dump($url);
// echo "<br>";
>>>>>>> fa115ab4998459ba99496afe13d6b10115521dfa
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