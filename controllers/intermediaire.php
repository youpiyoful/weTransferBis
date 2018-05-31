<?php 


require_once 'vendor/autoload.php';
require_once('models/request.php');

$loader = new Twig_Loader_Filesystem('./views');
$twig = new Twig_Environment($loader, array('cache' => false));


// fonction récupérer l'expéditeur

// fonction récupérer le destinataire

// fonction récupérer le message

// fonction récupérer le fichier

var_dump($_POST);

echo $twig->render('reception.html');

header("Location: weTransfertBis/reception");
