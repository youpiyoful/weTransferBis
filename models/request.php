<?php

require_once('utils/bdd.php');


// Requête pour selectionner le document à envoyer et l'insérer

function addDoc($nom,$message,$taille, $date, $lien){
    global $bdd;
    $response = $bdd->prepare("SELECT * FROM fichier(`nom_f`,`message_f`, `taille_f`, `date_f`, `lien_f`) VALUES (:nom, :messageMail,:taille, CURRENT_TIMESTAMP, :lien)");
    $response->bindParam(":nom",$nom);
    $response->bindParam(":messageMail",$message);
    $response->bindParam(":taille",$taille);
    $response->bindParam(":date",$date);
    $response->bindParam(":lien",$lienURL);
    $response->execute();
    return "true"; 
}



// 1- Requête pour insérer l'adresse mail du destinataire

function addDestMail($mailDest){
    global $bdd;
    $response = $bdd->prepare("INSERT INTO destinataire(`mail_d') VALUES (:mailDest)");
    $response->bindParam(":mailDest",$mailDest);
    $response->execute();
    return "true"; 
}


// 2- Requête pour insérer l'adresse mail de l'expéditeur

function addExpMail($mailExp){
    global $bdd;
    $response = $bdd->prepare("INSERT INTO expediteur(`mail_ex') VALUES (:mailExp)");
    $response->bindParam(":mailExp",$mailExp);
    $response->execute();
    return "true"; 
}


// 3- Requête pour ["a définir"]


// 4- Requête pour supprimer les données mails
//L'idéal serait de pouvoir regrouper les 2 en cascade pour tout supprimer d'un coup

function removeDestMail(){
    global $bdd;
    $response = $bdd->prepare("DELETE FROM destinataire");
    $response->execute();
    return "true"; 
}


function removeExpMail(){
    global $bdd;
    $response = $bdd->prepare("DELETE FROM expediteur");
    $response->execute();
    return "true"; 
}

