<?php 

require_once('models/request.php');


$mailExp = $_POST['expediteur'];
$mailDest = $_POST['destinataire'];

$fileName = $_FILES['upFile']['name'];
$fileMessage = $_POST['message'];
$fileSize = $_FILES['upFile']['size'];
$fileType = $_FILES['upFile']["type"];
// $fileLink




// var_dump($_POST);
// echo "<br>";
// var_dump($_FILES);

// fonction insérer l'email de l'expéditeur

$idExp = addEXpMail($mailExp);

//fonction qui insère les infos à propos du fichier envoyé

$idFile = insertDoc($fileName, $fileMessage, $fileSize);
//fonction insérer le destinataire

$idDest = addDestMail($mailDest);


//fonction pour insérer tous les id propre au mail dans la table de liaison

tableLink($idDest, $idFile, $idExp);



header("Location: reception");
