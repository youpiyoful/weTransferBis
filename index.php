<?php

$url = explode('/', $_SERVER['REQUEST_URI'], 4);

// j'ai supprimé la limite car le array_supprimait de toute façon le dernier élément même si c'était inférieur a 5
if(count($url) > 3){
   array_pop($url);
 }

$path = implode('/', $url);

switch ($path){
case '/weTransferBis':
case '/weTransferBis/':
require_once('controllers/home.php');
break;

case '/weTransferBis/intermediaire':
case '/weTransferBis/intermediaire/':
require_once('controllers/intermediaire.php');
break;


case '/weTransferBis/reception':
case '/weTransferBis/reception/':
require_once('controllers/reception.php');
break;

case '/weTransferBis/download':
case '/weTransferBis/download/':
require_once('controllers/download.php');
break;

default:
require_once('controllers/404-error.php');
break;
}