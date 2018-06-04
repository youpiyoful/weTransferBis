<?php 

require_once('models/request.php');
require_once('utils/param.php');
require_once 'vendor/autoload.php';


$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array('cache' => false));

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

$allInfos = linkAll($urlPageDl);

echo "<br><br><br>";

var_dump($allInfos);


// envoie du mail au destinataire

if(isset($_POST)){
    $to = $mailDest; 
    $subject = 'un mail de e-post';
    $message = $twig->render('destinataire.html', array('allInfos' => $allInfos));;
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <yf@yoan-fornari.fr>' . "\r\n";
    $headers .= 'Cc: myboss@example.com' . "\r\n";
    
    mail($to,$subject,$message,$headers);

// envoie du mail a l'expéditeur

	$to = $mailExp; 
	$subject = 'un mail de e-post';
	$message = $twig->render('expediteur.html', array('allInfos' => $allInfos));
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <yf@yoan-fornari.fr>' . "\r\n";
	$headers .= 'Cc: myboss@example.com' . "\r\n";
	
	mail($to,$subject,$message,$headers);
}
	
header("Location: reception");