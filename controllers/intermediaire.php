<?php 


require_once 'vendor/autoload.php';
require_once('models/request.php');


$message = $_POST['message'];
$mailExp = $_POST['expediteur'];
$mailDest = $_POST['destinataire'];
$file = $_FILES['upFile'];

$size = filesize($file);
// fonction récupérer l'expéditeur

// fonction récupérer le destinataire

// fonction récupérer le message

// fonction récupérer le fichier

// var_dump($_POST);

// echo $twig->render('reception.html');

header("Location: reception");
