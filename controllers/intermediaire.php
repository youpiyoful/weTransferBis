<?php 

require_once('models/request.php');
require_once('utils/param.php');


$mailExp = $_POST['expediteur'];
$mailDest = $_POST['destinataire'];

$fileName = $_FILES['upFile']['name'];
$fileMessage = $_POST['message'];
$fileSize = $_FILES['upFile']['size'];
$fileType = $_FILES['upFile']["type"];
$fileLink = $_SERVER['DOCUMENT_ROOT'].'/weTransferBis/assets/medias/files/'.$fileName;
var_dump($_FILES);



// $fileLink

// var_dump($_POST);
// echo "<br>";
// var_dump($_FILES);

// fonction insérer l'email de l'expéditeur

$idExp = addEXpMail($mailExp);

//fonction qui insère les infos à propos du fichier envoyé

$idFile = insertDoc($fileName, $fileMessage, $fileSize, $fileLink);
//fonction insérer le destinataire

$idDest = addDestMail($mailDest);

//fonction de hachage

$codeUrl = hash('adler32', time());

//url de la page de téléchargement

$urlPageDl = "download/".$codeUrl;


//fonction pour insérer tous les id propre au mail dans la table de liaison

tableLink($idDest, $idFile, $idExp, $urlPageDl);

if (isset($_FILES['upFile'])){
    
    $redirection = true;

    $path = $_SERVER['DOCUMENT_ROOT'].'/weTransferBis/assets/medias/files/'.$fileName;
    move_uploaded_file($_FILES['upFile']['tmp_name'], $path);
}





// var_dump($_POST);
// $allInfos = linkAll($_GET['url']);

// var_dump($allInfos);

// // envoie du mail au destinataire

// if(isset($mailExp){
//     $to = '$mailDest'; 
//     $subject = 'test-destinataire';
//     $message = 'blablabla';
//     $header = 'MIME version 1.0\r\n';
//     $header .= 'Content-type: text/html; charset=UTF-8\r\n';
//     mail($to,$subject,$message,$header);
// // envoie du mail a l'expéditeur
// } else if(isset($_POST['mail-exp'])){
//     mail($mailExp,'test-expediteur','blablabla');
// }
	
// header("Location: reception");