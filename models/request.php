<?php

require_once('utils/bdd.php');


//Requête pour insérer le document à envoyer 
function insertDoc($nom,$message,$taille, $date, $lien){
    global $bdd;
    $response = $bdd->prepare("INSERT into fichier(`nom_f`,`message_f`, `taille_f`, `date_f`, `lien_f`) VALUES (:nom, :messageMail,:taille, CURRENT_TIMESTAMP, :lien)");
    $response->bindParam(":nom",$nom);
    $response->bindParam(":messageMail",$message);
    $response->bindParam(":taille",$taille);
    $response->bindParam(":date",$date);
    $response->bindParam(":lien",$lienURL);
    $response->execute();
    $result = $response->lastinsertId();
    return $result; 
}    

// Requête pour afficher les informations du document
function showDoc($nom,$message,$taille, $date, $lien){
    global $bdd;
    $response = $bdd->prepare("SELECT * FROM fichier(`nom_f`,`message_f`, `taille_f`, `date_f`, `lien_f`) VALUES (:nom, :messageMail,:taille, CURRENT_TIMESTAMP, :lien)");
    $response->bindParam(":nom",$nom);
    $response->bindParam(":messageMail",$message);
    $response->bindParam(":taille",$taille);
    $response->bindParam(":date",$date);
    $response->bindParam(":lien",$lienURL);
    $response->execute();
    $result=$response->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}


// 1- Requête pour insérer l'adresse mail du destinataire

function addDestMail($mailDest){
    global $bdd;
    $response = $bdd->prepare("INSERT INTO destinataire(`mail_d') VALUES (:mailDest)");
    $response->bindParam(":mailDest",$mailDest);
    $response->execute();
    $result = $response->lastinsertId();

    return $result;
}


// 2- Requête pour insérer l'adresse mail de l'expéditeur

function addExpMail($mailExp){
    global $bdd;
    $response = $bdd->prepare("INSERT INTO expediteur(`mail_ex') VALUES (:mailExp)");
    $response->bindParam(":mailExp",$mailExp);
    $response->execute();
    $result = $response->lastinsertId();

    return $result; 
}


// 3- Requête pour ["à définir"]


// 4- Requête pour supprimer les données mails
//L'idéal serait de pouvoir regrouper les 2 en cascade pour tout supprimer d'un coup

function removeDestMail(){
    global $bdd;
    $response = $bdd->prepare("DELETE FROM destinataire");
    $response->execute();

    $result=$response->fetchAll(PDO::FETCH_ASSOC);

    return $result;  
}


function removeExpMail(){
    global $bdd;
    $response = $bdd->prepare("DELETE FROM expediteur");
    $response->execute();
    $result=$response->fetchAll(PDO::FETCH_ASSOC);

    return $result; 
}

//requête insérer dans table de liaison

function tableLink($id_d, $id_f, $id_ex){
    global $bdd;
    $response = $bdd->prepare("INSERT INTO liaison_fi_ex_dest('id_f', 'id_ex', 'id_d') VALUE (:id_f,   :id_ex,  :id_d");
    $response->bindParam(":id_f", $id_f, PDO::PARAM_INT);
    $response->bindParam(":id_f", $id_f, PDO::PARAM_INT);
    $response->bindParam(":id_f", $id_f, PDO::PARAM_INT);

    $response->execute();
    // $result = $response->lastinsertId();

    
    // return $result;
}


//