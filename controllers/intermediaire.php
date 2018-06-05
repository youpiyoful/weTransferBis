<?php 

require_once('models/request.php');
require_once('utils/param.php');
require_once 'vendor/autoload.php';


$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array('cache' => false));

$regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/";

if (isset($_POST['message']) && !empty($_POST['message']) && isset($_POST['expediteur']) && !empty($_POST['expediteur']) && isset($_POST['destinataire']) && !empty($_POST['destinataire']) && isset($_FILES) && !empty($_FILES)){
	if(preg_match($regex, trim($_POST['expediteur'])) && preg_match($regex, trim($_POST['destinataire']))){
			$mailExp = htmlEntities($_POST['expediteur']);
			$mailDest = htmlEntities($_POST['destinataire']);

			$fileName = $_FILES['upFile']['name'];
			$fileMessage = htmlEntities($_POST['message']);
			$fileSize = $_FILES['upFile']['size'];
			$fileType = $_FILES['upFile']["type"];
			$time = time();
			$fileLink = 'http://yoanf.promo-17.codeur.online/weTransferBis/assets/medias/files/'.$time.$fileName;
			$path = $_SERVER['DOCUMENT_ROOT'].'/weTransferBis/assets/medias/files/'.$time.$fileName;

			// fonction insérer l'email de l'expéditeur

			$idExp = addEXpMail($mailExp);

			//fonction qui insère les infos à propos du fichier envoyé

			$idFile = insertDoc($fileName, $fileMessage, $fileSize, $fileLink);
			//fonction insérer le destinataire

			$idDest = addDestMail($mailDest);

			//fonction de hachage

			$codeUrl = hash('adler32', time());

			//url de la page de téléchargement

			$urlPageDl = "download/".$codeUrl."/";


			// var_dump($urlPageDl);

			//fonction pour insérer tous les id propre au mail dans la table de liaison

			tableLink($idDest, $idFile, $idExp, $urlPageDl);
		   
		    $redirection = true;

		    move_uploaded_file($_FILES['upFile']['tmp_name'], $path);

			$allInfos = linkAll($urlPageDl);

			// echo "<br><br><br>";

			// var_dump($allInfos);


			// envoie du mail au destinataire

		    $to = $mailDest; 
		    $subject = 'un mail de e-post';
		    $message = $twig->render('destinataire.html', array('allInfos' => $allInfos, 'urlPageDl' => $urlPageDl));;
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
			$message = $twig->render('expediteur.html', array('allInfos' => $allInfos, 'urlPageDl' => $urlPageDl));
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <yf@yoan-fornari.fr>' . "\r\n";
			$headers .= 'Cc: myboss@example.com' . "\r\n";
			
			mail($to,$subject,$message,$headers);
				
			header("Location: reception");

		}else{
			$errorPreg = "e-mail est incorrecte";
			echo $twig->render('home.html', array('errorPreg' => $errorPreg));

		}

	
}else{

	$errorEmpt = "veuillez remplir tous les champs";
	echo $twig->render('home.html', array('errorEmpt' => $errorEmpt));
	header('Location: home');

}

// var_dump($_FILES);



// $fileLink

// var_dump($_POST);
// echo "<br>";
// var_dump($_FILES);

